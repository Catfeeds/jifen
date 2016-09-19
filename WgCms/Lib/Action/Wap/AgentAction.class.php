<?php  
	class AgentAction extends WapAction{
		private $my;
		private $agent;
		function __construct(){
			parent::_initialize();

			$my = M('Distribution_member')->where(array('token'=>$token,'wecha_id'=>$wecha_id))->find();
			$this->my = $my;


			$db = M('distribution_agent');
			if(!$_COOKIE['agent_login_user'] && ACTION_NAME !='login' && ACTION_NAME !='test'){
				$this->redirect(U('Agent/login'));
			}
			if($_COOKIE['agent_login_user']){
				$agent = $db->where(array('username'=>$_COOKIE['agent_login_user'],'delete'=>0))->find();
				if($agent['changpwd'] == 1){
					$db->where(array('username'=>$_COOKIE['agent_login_user'],'delete'=>0))->setField('changpwd',0);
					setcookie('agent_login_user',NULL);
					$this->error('请登陆',U('Agent/login'));
				}
				if($agent){
					if(!$agent['wecha_id']){
	    				$Wdata['wecha_id'] = $this->wecha_id;
						//更新wecha_id
						$db->where(array('username'=>$_COOKIE['agent_login_user']))->save($Wdata);
	    			}
					$agent['petname'] =base64_decode($agent['petname']);
					$this->agent = $agent;
					$this->assign('agent',$agent);
				}else{
	    			setcookie('agent_login_user',NULL);
	    			$this->error('请登陆',U('Agent/login'));
				}
			}
	        //标题赋值
	        switch (ACTION_NAME) {
	        	case 'index':
	        		$title = '我的分店';
	        		break;
	        }
	        $this->assign('title',$title);
	        $url_par = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
			$this->assign('url_par',$url_par);
		}
		function login(){
	    	if(IS_POST){
	    		$db = M('distribution_agent');
	    		$username = $this->_post('username');
	    		$password = $this->_post('password');
	    		$nologin = $this->_post('nologin');
	    		if($username && $password){
	    			$check = $this->loginin($username,$password);
	    			if($check['status'] == 1){
	    				if($nologin == 1){
	    					setcookie("agent_login_user", $username, time()+3600*24*30);
	    				}else{
	    					setcookie("agent_login_user", $username, time()+3600*24*1);
	    				}

	    				$this->success('登陆成功',U('Agent/index'));
	    			}else{
	    				$this->error($check['info'],U('Agent/index'));
	    			}
	    		}else{
	    			$this->error('账号或密码不能为空');
	    		}
	    	}else{
	    		//判断账号是够已经登陆
	    		if($this->agent){
	    			$this->error('账号已经登陆',U('Agent/index'));
	    		}else{
		    		$this->display();
	    		}
	    	}
		}
		//登陆账号
		public function loginin($username,$password){
			//判断账号是否存在
			if(!$this->agentIsExists($username)){
				return array('info'=>'账号不存在','status'=>0);
			}
			if(!$this->judgeAgentPwd($username,$password)){
				return array('info'=>'密码错误','status'=>0);
			}
			$db = M('distribution_agent');
			if($this->my['id']){
				$data['mid'] = $this->my['id'];
			}
			
			$agent = $db->where(array('username'=>$username))->find();
			if($agent && !$agent['wecha_id']){
				$data['wecha_id'] = $this->wecha_id;
			}

			//记录现登陆人
			$db->where(array('username'=>$username))->save($data);
			return array('info'=>'登陆成功','status'=>1);
		}
		//判断账号是否存在
		public function agentIsExists($username){
		    $db = M('distribution_agent');
		    $agent = $db->where(array('username'=>$username,'delete'=>0))->find();
		    if($agent){
		        return $agent['id'];
		    }else{
		        return false;
		    }
		}
		//判断密码正确性
		public function judgeAgentPwd($username,$password){
			$relpwd = M('distribution_agent')->where(array('username'=>$username))->getField("password");
			if($relpwd != md5($password)){
				return false;
			}else{
				return true;
			}
		}
		//退出登陆(AJAX)
		public function loginoutAjax(){
			if($this->loginout($_COOKIE['agent_login_user'])){
				$this->success('成功退出',U('Agent/login'));
			}else{
				$this->error('退出失败');
			}
		}
		//退出账号
		public function loginout($username){
			$db = M('distribution_agent');
			setcookie('agent_login_user',NULL);
			return true;
		}
		//我的分店
		public function index(){
			$data = array(
				'gold' => $this->statistical('gold',$this->agent['id']),
				'ordernums' => $this->statistical('ordernums',$this->agent['id']),
				'totalearn' => $this->statistical('totalearn',$this->agent['id']),
			);
			$this->assign('info',$data);
			//判断有没有充值退款
			$hasrefund = M('LevelOrders')->where(array('bindaid'=>$this->agent['id'],'return'=>array('eq',1)))->select();
			if($hasrefund){
				$this->assign('hasrefund',$hasrefund);
			}
			$this->display();
		}
		//我的收益
		public function getMoneyList(){
			//总红色收入
			$this->assign("title","我的红色咪豆");
			$this->display();
		}
		//收入明细
		public function earnDetails(){
			$type = $this->_get('type');
			switch ($type) {
				case 'red':
					$list = M('Distribution_earning')->where(array('gid'=>$this->agent['id'],'red'=>array('neq',0)))->order('id desc')->select();
					foreach ($list as $k => $v) {
						$list[$k]['earn'] = $v['red'];
					}
					$name = '红色咪豆';
					break;
				
			}
			$this->assign('list',$list);
			$this->assign('name',$name);
			$this->display();
		}
		//转账
		public function transfer(){
			if(IS_POST){
				$db = D('Account');
				$red = $this->_post('red');
				$code = $this->_post('code');
				$remark = $this->_post('remark');
				$account = $db->where(array('recommend'=>$code))->find();
				if($account){
					if($account['id'] == $this->account['id']){
						$this->ajaxReturn('','不能给自己转账',2);
					}
					$this->earnRecord($account['id'],0,$this->my['id'],0,$red,0,8,0,0,$this->account['id'],0,$remark);
					$re = $this->earnRecord($this->account['id'],0,$this->my['id'],0,-$red,0,8);
					if($re){
						$data = array(
							'rolloutId' => $this->account['id'],
							'intoId' => $account['id'],
							'red' => $red,
							'remark' => $remark,
							'addtime' => time(),
							'year' => date('Y',time()),
							'month' => date('m',time()),
							'day' => date('d',time()),
						);
						M('Distribution_transfer_records')->add($data);
						$content = '好友'.$this->account['username'].'向您转账'.$red.'红色咪豆';
						$this->sendupMessage($account['id'],'转账',$content,U('Distribution/index'));
						$this->ajaxReturn($content,'转账成功',1);
					}else{
						$this->ajaxReturn('','转账失败',2);
					}
				}else{
					$this->ajaxReturn('','账号不存在',2);
				}
			}else{
				$this->display();
			}
		}
	}
?>