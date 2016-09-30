<?php  
	class AgentAction extends WapAction{
		private $my;
		private $agent;
		function __construct(){
			parent::_initialize();

			$my = M('Distribution_member')->where(array('token'=>$token,'wecha_id'=>$wecha_id))->find();
			$this->my = $my;


			$db = M('distribution_agent');
			if(!$_COOKIE['agent_login_user'] && ACTION_NAME !='login' && ACTION_NAME !='test'&& ACTION_NAME !='loginin'){
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
	    			$this->redirect(U('Agent/index'));
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
			$totalpay = D('Account')->where(array('agent'=>$this->agent['id']))->sum('black');
			$data = array(
				'lowernums' => D('Account')->where(array('agent'=>$this->agent['id']))->count(),
				'totalpay' => $totalpay,
				'totaltopup' => $totalpay + D('Account')->where(array('agent'=>$this->agent['id']))->sum('green'),
			);
			$this->assign('info',$data);
			//判断有没有充值退款
			$hasrefund = M('LevelOrders')->where(array('bindaid'=>$this->agent['id'],'return'=>array('eq',1)))->order('addtime desc')->select();
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
					$list = D('Earn')->where(array('gid'=>$this->agent['id'],'red'=>array('neq',0)))->order('id desc')->relation(true)->select();
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
				$type = $this->_post('type');
				$red = $this->_post('red');
				$code = $this->_post('code');
				$remark = $this->_post('remark');
				if($red > $this->agent['red']){
					$this->ajaxReturn('','红色咪豆不足',2);
				}
				//转账号
				if($type == 1){
					$db = D('Account');
					$account = $db->where(array('recommend'=>$code))->find();
					if($account){
						//相应账号增加红色咪豆
						$this->earnRecord($account['id'],0,$this->my['id'],0,$red,0,15,0,0,0,$this->agent['id'],$remark);
						//代理点减红色积分
						$re = $this->earnRecord(0,0,$this->my['id'],0,-$red,0,15,0,$this->agent['id'],0,0,$remark);
						if($re){
							$data = array(
								'fromgid' => $this->agent['id'],
								'intoId' => $account['id'],
								'red' => $red,
								'remark' => $remark,
								'addtime' => time(),
								'year' => date('Y',time()),
								'month' => date('m',time()),
								'day' => date('d',time()),
							);
							M('Distribution_transfer_records')->add($data);
							$content = '代理点'.$this->agent['name'].'向您转账'.$red.'红色咪豆';
							$this->sendupMessage($account['id'],'转账',$content,U('Agent/index'));
							$this->ajaxReturn($content,'转账成功',1);
						}else{
							$this->ajaxReturn('','转账失败',2);
						}
					}else{
						$this->ajaxReturn('','账号不存在',2);
					}
				}
				//转代理点
				if($type == 2){
					$db = M('Distribution_agent');
					$agent = $db->where(array('code'=>$code))->find();
					if($agent){
						if($agent['id'] == $this->agent['id']){
							$this->ajaxReturn('','不能给自己转',2);
						}
						//相应代理点增加红色咪豆
						$this->earnRecord(0,0,$this->my['id'],0,$red,0,16,0,$agent['id'],0,$this->agent['id'],$remark);
						//代理点减红色积分
						$re = $this->earnRecord(0,0,$this->my['id'],0,-$red,0,16,0,$this->agent['id'],0,0,$remark);
						if($re){
							$data = array(
								'fromgid' => $this->agent['id'],
								'gid' => $agent['id'],
								'red' => $red,
								'remark' => $remark,
								'addtime' => time(),
								'year' => date('Y',time()),
								'month' => date('m',time()),
								'day' => date('d',time()),
							);
							M('Distribution_transfer_records')->add($data);
							$content = '代理点'.$this->agent['name'].'向您转账'.$red.'红色咪豆';
							$this->sendToAgentMessage($agent['id'],'转账',$content,U('Agent/index'));
							$this->ajaxReturn($content,'转账成功',1);
						}else{
							$this->ajaxReturn('','转账失败',2);
						}
					}else{
						$this->ajaxReturn('','代理点不存在',2);
					}
				}
			}else{
				$this->display();
			}
		}
		//个人信息
		public function myInfo(){
			if(IS_POST){
				$name = $this->_post('name');
				$info = $this->_post('info');
				if($name == 'password'){
					$data = array(
						$name => md5($info),
					);
				}else{
					if($name =='petname'){
						$oinfo = $info;
						$info = base64_encode($info);
						$data = array(
							$name => $info,
							'petnamebak' => $oinfo,
						);
					}else{
						$data = array(
							$name => $info,
						);
					}
				}
				$data['updatetime'] = time();
				$r = M('Distribution_agent')->where(array('id'=>$this->agent['id']))->save($data);
				if($r){
					$this->ajaxReturn('','修改成功',1);
				}else{
					$this->ajaxReturn('','修改失败',2);
				}
			}else{
				$this->display();
			}
		}
		//AJAX上传图片(功能)
		public function headpic(){
			import("@.ORG.UploadFile");
			$time=time();
			$config = array(
					'savePath'      =>  'uploads/member/', //保存路径
					'thumb'             =>  true,
					'thumbMaxWidth'     =>  '400',// 缩略图最大宽度
					'thumbMaxHeight'    =>  '400',// 缩略图最大高度
					'thumbPath'         =>  'uploads/member/',// 缩略图保存路径
					'thumbRemoveOrigin' =>  true,// 是否移除原图
					'thumbFile'       =>  $time,// 缩略图前缀
					'thumbExt'			=>   'jpg',
			);
			//上传图片
			$upload=new UploadFile($config);
			$z=$upload->uploadOne($_FILES['shoplogo']);
			if($z){
				$pic=C('site_url').'/'.$z['0']['savepath'].$time.".jpg";
				M('Distribution_agent')->where(array('id'=>$this->agent['id']))->setField('headimgurl',$pic);
				$this->ajaxReturn($pic,"",1);
			}else{
				M('Distribution_agent')->where(array('id'=>$this->agent['id']))->setField('headimgurl',$this->agent['headimgurl']);
				$this->ajaxReturn("","",2);
			}
		}
		//判断旧密码
		public function judgeOldPwd(){
			$password = $this->_post('password');
			if(md5($password) == $this->agent['password']){
				$this->ajaxReturn('','',1);
			}else{
				$this->ajaxReturn('','密码错误',2);
			}
		}
		//转账记录
		public function transferRecord(){
			$condition = array(
				'gid' => $this->agent['id'],
				'fromgid' => $this->agent['id'],
				'_logic' => 'OR',
			);
			$list = D('Transfer')->where($condition)->relation(true)->order('addtime desc')->select();
			$this->assign('list',$list);
			$this->display();
		}
		//分红明细
		public function redRecord(){
			$list = D('Earn')->where(array('gid'=>$this->agent['id'],'status'=>3,'red'=>array('neq','0')))->relation(true)->order('addtime desc')->select();
			$this->assign('list',$list);
			$this->display();
		}
		//账号明细
		public function myTeam(){
			$db = D('Account');
			$aid = $this->_get('aid');
			if($aid){
				$condition['bindaid'] = $aid;
			}else{
				$condition['agent'] = $this->agent['id'];
			}
			$list = $db->where($condition)->order('addtime desc')->select();
			$this->assign('list',$list);
			$this->display();
		}
		public function mypic(){
			$this->display();
		}
		//下级下单记录
		public function lowerOrdersRecords(){
			$cart_list_db = D('ProductCartList');
			//获取下级账号ID
			$accounts = D('Account')->field('id')->where(array('agent'=>$this->agent['id']))->select();
			foreach ($accounts as $k => $v) {
				$ids .= $v['id'] . ',';
			}
			$ids = rtrim($ids,',');
			$condition = array(
				'aid' => array('in',$ids),
			);
			$list = $cart_list_db->where($condition)->relation(true)->order('time desc')->select();
			foreach ($list as $k => $v) {
				if($v['cart']['paid'] == 0){
					unset($list[$k]);
				}
			}
			$this->assign('list',$list);
			$this->display();
		}
		//充值记录
		public function topUpRecords(){
			$db = D('LevelOrders');
			//获取下级账号ID
			$accounts = D('Account')->field('id')->where(array('agent'=>$this->agent['id']))->select();
			foreach ($accounts as $k => $v) {
				$ids .= $v['id'] . ',';
			}
			$ids = rtrim($ids,',');
			$condition = array(
				'aid' => array('in',$ids),
				'paid' => 1,
			);
			$list = $db->where($condition)->order('addtime desc')->relation(true)->select();
			$this->assign('list',$list);

			$this->display();
		}
		function test(){
			// $db = D('Earn');
			// $condition['gid'] = array('neq',0);
			// $list = $db->where($condition)->select();
			// foreach ($list as $k => $v) {
			// 	if($v['gid'] != 0 && $v['red'] != 0){
			// 		M('Distribution_agent')->where(array('id'=>$v['gid']))->setInc('red',$v['red']);
			// 	}
			// }
		}
	}
?>