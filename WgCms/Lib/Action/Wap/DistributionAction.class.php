<?php
class DistributionAction extends WapAction{
	private $my;
    public function __construct(){
        parent::_initialize();
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if(!strpos($agent,"icroMessenger")) {
			//echo '此功能只能在微信浏览器中使用';exit;
		}
		$token		= $this->token;
		$wecha_id	= $this->wecha_id;
		$my = M('Distribution_member')->where(array('token'=>$token,'wecha_id'=>$wecha_id))->find();
		//公司信息
		$company = M('company')->where(array('token'=>$this->token))->find();
		$this->assign('company',$company);

		$this->my = $my;
		$set = M('Distribution_set')->where(array('token'=>$token))->find();

		$this->assign('set',$set);
        $this->assign('my',$my);

		//判断是否登陆
		if(!$_COOKIE['login_user'] && ACTION_NAME !='register' && ACTION_NAME !='login' && ACTION_NAME !='test'){
			if(ACTION_NAME == 'generateQrcode' && $_GET['aid'] != ''){

			}else{
				$this->redirect(U('Distribution/login'));
			}
		}
		if($_COOKIE['login_user']){
			$account = D('Account')->where(array('username'=>$_COOKIE['login_user'],'delete'=>0))->relation(true)->find();
			if($account){
				if(!$account['wecha_id']){
    				$Wdata['wecha_id'] = $this->wecha_id;
					//更新wecha_id
					D('Account')->where(array('username'=>$_COOKIE['login_user']))->save($Wdata);
    			}
				$account['petname'] =base64_decode($account['petname']);
				$this->account = $account;
				$this->assign('account',$account);
			}else{
    			setcookie('login_user',NULL);
    			$this->error('请登陆',U('Distribution/login'));
			}
		}

        //标题赋值
        switch (ACTION_NAME) {
        	case 'index':
        		$title = '个人中心';
        		break;
        	
        	case 'myDistribution':
        		$title = '我的分店';
        		break;
        }
        $this->assign('title',$title);

        $url_par = $_SERVER['SERVER_ADDR'].$_SERVER['PHP_SELF'];
		$this->assign('url_par',$url_par);
    }
    //注册页面
    public function register(){
    	$from = $this->_get('from');
    	if(IS_POST){
    		$username = $this->_post('username');
    		$password = $this->_post('password');
			if($this->isExists($username)){
    			$this->error('微信号已存在');
    		}
    		if($this->randomAid()){
	    		$_POST['bindaid'] = $this->randomAid();
	    		if($this->account && $from == 'myshop'){
	    			$_POST['createid'] = $this->account['id'];
	    		}
    		}
    		if($this->account){
    			$this->insert('Account','/myShop');
    		}else{
    			$this->insert('Account','/login');
    		}
    	}else{
    		$this->display();
    	}
    }
    //下级账号列表
    public function accountList(){
    	$accounts = M('Distribution_account')->where(array('createid'=>$this->account['id'],'delete'=>0))->select();
    	$this->assign('list',$accounts);
    	$this->display();
    }
    //随机选取上级账号ID
    public function randomAid(){
    	$from = $this->_get('from');
    	//自己开通账号
    	if($this->account && $from == 'myshop'){
    		return $this->account['id'];
    	}
    	if($this->my && $this->my['id'] != 0){
	    	if($this->my['bindaid']){
	    		$bindaccount = D('Account')->where('id='.$this->my['bindaid'])->find();
	    		if($bindaccount['lid'] != 0){
	    			return $this->my['bindaid'];
	    		}else{
	    			return 0;
	    		}
	    	}else{
	    		return 0;
	    	}
    	}else{
    		$wecha_id = $this->_post('wecha_id');
    		$my = M('Distribution_memner')->where(array('wecha_id'=>$wecha_id))->find();
    		if($my['bindaid']){
	    		$bindaccount = D('Account')->where('id='.$my['bindaid'])->find();
	    		if($bindaccount['lid'] != 0){
	    			return $my['bindaid'];
	    		}else{
	    			return 0;
	    		}
	    	}else{
	    		return 0;
	    	}
    	}
    }
    //AJAX判断注册
    public function registerAjax(){
    	$username = $this->_post('username');
    	if(!$this->isExists($username)){
    		$this->ajaxReturn('','',1);
    	}else{
    		$this->ajaxReturn('','',2);//已存在该用户名
    	}
    }
    //判断账号是否存在
    public function isExists($username){
    	$db = M('distribution_account');
    	$account = $db->where(array('username'=>$username,'delete'=>0))->find();
    	if($account){
    		return true;
    	}else{
    		return false;
    	}
    }
    //登陆页面
    public function login(){
    	//dump($_COOKIE['login_user']);
    	// dump(session('login_user2'));
    	if(IS_POST){
    		$db = M('distribution_account');
    		$username = $this->_post('username');
    		$password = $this->_post('password');
    		$nologin = $this->_post('nologin');
    		if($username && $password){
    			$check = $this->loginin($username,$password);
    			if($check['status'] == 1){
    				if($nologin == 1){
    					// session('login_user',$username,60*60*24*3);
    					setcookie("login_user", $username, time()+3600*24*30);
    					// session('login_user2',$username,3600);
    					// session(array('login_user2'=>$username,'expire'=>5,'path'=>'/wg_qch/'));
    				}else{
    					setcookie("login_user", $username, time()+3600*24*1);
    				}

    				$this->success('登陆成功',U('Distribution/index'));
    			}else{
    				$this->error($check['info'],U('Distribution/index'));
    			}
    		}else{
    			$this->error('账号或密码不能为空');
    		}
    	}else{
    		//判断账号是够已经登陆
    		if($this->account){
    			$this->error('账号已经登陆',U('Distribution/index'));
    		}else{
	    		$this->display();
    		}
    	}
    }
    //退出登陆(AJAX)
    public function loginoutAjax(){
    	if($this->loginout($_COOKIE['login_user'])){
    		$this->success('成功退出',U('Distribution/login'));
    	}else{
    		$this->error('退出失败');
    	}
    }
    //登陆账号
    public function loginin($username,$password){
    	//判断账号是否存在
    	if(!$this->isExists($username)){
    		return array('info'=>'账号不存在','status'=>0);
    	}
    	if(!$this->judgeUserPwd($username,$password)){
    		return array('info'=>'密码错误','status'=>0);
    	}
    	//判断账号是否被登陆
    	// if(!$this->accoutnStatus($username)){
    	// 	return array('info'=>'账号已登陆','status'=>0);
    	// }
    	$db = D('Account');
    	if($this->my['id']){
    		//$condition['mid'] = $this->my['id'];
    		$data['mid'] = $this->my['id'];
    		// $data['ip'] = 0;
    	}else{
    		//$condition['ip'] = $_SERVER['SERVER_ADDR'];
    		//$data['ip'] = $_SERVER['SERVER_ADDR'];
    		// $data['mid'] = 0;
    	}
    	//删除以往登陆状态
    	//$condition['username'] = array('neq',$username);
    	// $db->where($condition)->save(array('mid'=>0,'ip'=>0));
    	
    	$account = $db->where(array('username'=>$username))->find();
    	if($account && !$account['wecha_id']){
    		$data['wecha_id'] = $this->wecha_id;
    	}

    	//记录现登陆人
    	$db->where(array('username'=>$username))->save($data);
    	return array('info'=>'登陆成功','status'=>1);
    }
    //判断密码正确性
    public function judgeUserPwd($username,$password){
    	$relpwd = M('Distribution_account')->where(array('username'=>$username))->getField("password");
    	if($relpwd != md5($password)){
    		return false;
    	}else{
    		return true;
    	}
    }
    //退出账号
    public function loginout($username){
    	$db = D('Account');
    	// if($this->my['id']){
    	// 	$data['mid'] = 0;
    	// }
    	setcookie('login_user',NULL);
    	// $result = $db->where(array('username'=>$username))->setField('mid',0);
    	return true;
    }
    //判断账号状态
    public function accoutnStatus($user){
    	$db = M('distribution_account');
    	if($db->where(array('username'=>$user))->getField('status') == 1){
    		return false;
    	}else{
    		return true;
    	}
    }
    //个人中心
	public function index(){
		$cart = M('ProductCart')->where(array('wecha_id'=>$this->wecha_id))->select();
		$cart_data = array();
		foreach ($cart as $k => $v) {
			if($v['paid'] == 0){
				$cart_data['unpaid'] >= 9 ? $cart_data['unpaid'] = 'N' : $cart_data['unpaid']++;
			}
			if($v['paid'] == 1 && $v['sent'] == 0 && $v['returnMoney'] ==0){
				$cart_data['unsent'] >= 9 ? 'N' : $cart_data['unsent']++;
			}
			if($v['paid'] == 1 && $v['sent'] == 1 && $v['receive'] == 0 && $v['returnMoney'] ==0){
				$cart_data['unreceive'] >= 9 ? 'N' : $cart_data['unreceive']++;
			}
			if($v['paid'] == 1 && $v['sent'] == 1 && $v['receive'] == 1 && $v['returnMoney'] ==0){
				$cart_data['finished'] >= 9 ? 'N' : $cart_data['finished']++;
			}
		}
		$this->assign('cart_data',$cart_data);
		$this->display();
	}
	//个人信息
	//个人信息
	public function myInfo(){
		if(IS_POST){
			$name = $this->_post('name');
			//姓名只能修改一次
			// if($name == 'nickname'){
			// 	if($this->account['editname'] == 1){
			// 		$this->ajaxReturn('','真实姓名只能修改一次',2);
			// 	}
			// }
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
			$r = M('Distribution_account')->where(array('id'=>$this->account['id']))->setField($data);
			if($r){
				if($name = 'nickname'){
					M('Distribution_account')->where(array('id'=>$this->account['id']))->setField('editname',1);
				}
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
		//设置一周修改一次
		$mytime=basename($this->my['headimgurl'],".jpg");
		$checktime=time()-86400*7;
		// if($mytime>$checktime){
		// 	$this->ajaxReturn("","",3);
		// }

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
			$pic=$z['0']['savepath'].$time.".jpg";
			M('Distribution_member')->where(array('wecha_id'=>$this->wecha_id))->setField('headimgurl',$pic);
			$this->ajaxReturn($pic,"",1);
		}else{
			$this->ajaxReturn("","",2);
		}
	}
	public function followScanner(){
		$this->display();
	}
	//我的地址
	public function myAddress(){
		$db=M("address_list");
		$condition = array(
			'mid' => $this->my['id'],
		);
		$list=$db->where($condition)->order('addtime desc')->select();
		if($list){
			$this->assign("list",$list);
		}
		if(session("quick_buy_address_url")){
			$this->assign("shopping",session("quick_buy_address_url"));//订单页面，方便返回付款
		}
		$this->display();
	}
	//令牌生成
	private function temTokenBuild(){
		$tokenName  = C('TOKEN_NAME');
		$tokenType  = C('TOKEN_TYPE');
		if(!isset($_SESSION[$tokenName])) {
		    $_SESSION[$tokenName]  = array();
		}
		// 标识当前页面唯一性
		$tokenKey   =  md5($_SERVER['REQUEST_URI']);
		if(isset($_SESSION[$tokenName][$tokenKey])) {// 相同页面不重复生成session
		    $tokenValue = $_SESSION[$tokenName][$tokenKey];
		}else{
		    $tokenValue = $tokenType(microtime(TRUE));
		    $_SESSION[$tokenName][$tokenKey]   =  $tokenValue;
		}
		return $tokenKey.'_'.$tokenValue;
	}
	//编辑地址(添加修改)
	public function editAddress(){
		$db = D("Address");
		if(IS_POST){
			$aid = $this->_post('id');
			$name = $this->_post('name');
			$token = $this->temTokenBuild();
			if($_POST['choose'] == 'on'){
				$_POST['choose'] = 1;
			}
			$_POST['addtime'] = time();
			if ($db->create() === false) {
			    $this->ajaxReturn('操作失败',$token,2);
			} else {
				if($aid){
					$id = $db->save();
				}else{
					$id = $db->add();
				}
			    if ($id == true) {
			    	if($_POST['choose'] == 1){
			    		$map['mid']=$this->my['id'];
			    		$map['id']=array("neq",$id);
			    		$map['choose']=1;
			    		$db->where($map)->setField("choose",0);
			    	}
			    	$this->ajaxReturn($aid,$token,1);
			    } else {
			    	$this->ajaxReturn('操作失败',$token,2);
			    }
			}
		}else{
			$id=$_GET["id"];
			if($id){
				$info=$db->where("id=".$id)->find();
				$this->assign("info",$info);
			}
			$this->display();
		}
	}
	//删除地址
	public function delAddress(){
		$id = $_GET["id"];
		$db = M("address_list");
		$result = $db->where(array("mid"=>$this->my['id'],'id'=>$id))->delete();
		if($result){
			$this->ajaxReturn('','操作成功',1);
		}else{
			$this->ajaxReturn('','操作失败',0);
		}
	}
	//选择默认地址(AJAX)
	public function chooseAdd(){
		$id=$_GET["id"];
		$db = M("address_list");
		$db->where(array("mid"=>$this->my['id'],'choose'=>1))->setField("choose",0);
		$result=$db->where(array("mid=".$this->my['id'],'id'=>$id))->setField("choose",1);
		if($result){
			$this->ajaxReturn("","设置成功",1);
		}else{
			$this->ajaxReturn("","设置失败",2);
		}
	}

	//我的分店
	public function myShop(){
		$data = array(
			'gold' => $this->statistical('gold',$this->account['id']),
			'ordernums' => $this->statistical('ordernums',$this->account['id']),
			'totalearn' => $this->statistical('totalearn',$this->account['id']),
		);
		$this->assign('info',$data);
		//判断有没有充值退款
		$hasrefund = M('LevelOrders')->where(array('bindaid'=>$this->account['id'],'return'=>array('eq',1)))->select();
		if($hasrefund){
			$this->assign('hasrefund',$hasrefund);
		}
		$this->display();
	}
	//团队管理
	public function myTeam(){
		// $team = $this->statisticalTeam((string)$this->account['id']);
		$team = D('Account')->where(array('bindaid'=>$this->account['id'],'delete'=>0))->relation(true)->select();
		$this->assign('list',$team);
		$this->display();
	}
	//我的团队
	public function myDistribution(){
		$id = $this->my['id'];
		$token = $this->token;
		$wecha_id = $this->wecha_id;
		/*if($this->my['distritime']==0){
			$access_token = $this->get_access_token();
			$set = M('Distribution_forward_set')->where(array('token'=>$token))->find();
			$data = '{"touser":"'.$wecha_id.'","msgtype":"news","news":{"articles":[{"title":"'.$set['fxtitle'].'","description":"'.$set['fxtext'].'","url":"'.$set['fxurl'].'","picurl":"'.$set['fxpic'].'"]}}';
			$result = $this->api_notice_increment('https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$access_token,$data);
			$url = U('Distribution/index',array('token'=>$token,'wecha_id'=>$wecha_id,'notBe'=>1));
			$this->redirect($url);//跳回
		}*/
		$db = M('Distribution_ordermoney');
		$order['status_0'] = $db->where(array('token'=>$token,'mid'=>$id,'status'=>0))->sum('offerMoney');//未付款
		$order['status_1'] = $db->where(array('token'=>$token,'mid'=>$id,'status'=>1))->sum('offerMoney');//已付款
		$order['status_2'] = $db->where(array('token'=>$token,'mid'=>$id,'status'=>2))->sum('offerMoney');//未收货
		$order['status_3'] = $db->where(array('token'=>$token,'mid'=>$id,'status'=>3))->sum('offerMoney');//已收货
		$order['status_-1'] = $db->where(array('token'=>$token,'mid'=>$id,'status'=>-1))->sum('offerMoney');//已退款
		$order['status_4'] = $db->where(array('token'=>$token,'mid'=>$id,'status'=>4))->sum('offerMoney');//已审核
		$distriCount = M('Distribution_member')->where(array('token'=>$token,'bindmid'=>$id,'distritime'=>array('neq',0)))->count();
		$orderNums = $db->where(array('token'=>$token,'mid'=>$id,'status'=>array('gt',0)))->count();
		$this->assign('orderNums',$orderNums);
		$this->assign('distriCount',$distriCount);
		$this->assign('order',$order);
		$this->display();
	}
	//充值页面
	public function topUp(){
		// if($this->account['lid'] == 0){
		// 	$this->error('非会员不能进行充值',U('Distribution/index'));
		// }
		//判断是否有下级退款充值
		// $hasrefund = M('LevelOrders')->where(array('bindaid'=>$this->account['id'],'return'=>array('neq',0),'type'=>1))->select();
		// if($hasrefund){
		// 	$this->assign('hasrefund',$hasrefund);
		// }
		$this->display();
	}
	//充值升级记录
	public function tpupRecord(){
		$db = D('LevelOrders');
		$type = $this->_get('type');
		$condition = array(
			'aid' => $this->account['id'],
			'type' => $type,
			'paid' => 1,
		);
		$records = $db->where($condition)->relation(true)->select();
		$this->assign('list',$records);
		$this->display();
	}
	//充值AJAX判断
	public function topupCondtionAjax(){
		$gold = $this->_post('gold');
		// $gold = $this->_get('gold');
		$con = $this->topupCondtion($gold);
		$this->ajaxReturn('',$con['info'],$con['status']);
	}
	/*
		*判断充值条件
		*$gold:充值金额
		*1： OK
	 */
	public function topupCondtion($gold){
		return array('status'=>1,'info'=>'');
	}
	//充值提交
	public function topupSubmit(){
		$gold = $this->_post('gold');
		$condition = $this->topupCondtion($gold);
		if($condition['status'] != 1){
			$this->error($condition['info']);
		}
		if($condition['status'] == 1){
			//插入充值订单表
			$orderid = substr($this->wecha_id, -1, 4) . date("YmdHis");
			$price = $gold;
			$_POST['orderid'] = $orderid;
			$_POST['price'] = $price;
			$_POST['type'] = 1;
			$_POST['aid'] = $this->account['id'];
			$_POST['bindaid'] = $this->account['bindaid'];
			$_POST['mid'] = $this->my['id'];
			$_POST['wecha_id'] = $this->my['wecha_id'];
			$db = D('LevelOrders');

			if ($db->create() === false) {
			    $this->error($db->getError());
			} else {
			    $result = $db->add();
			}
			if($result){
				$this->success('正在提交中...', U('Alipay/pay',array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'success' => 1, 'from'=> 'Distribution', 'orderName' => $orderid, 'single_orderid' => $orderid, 'price' => $price)));
			}else {
				$this->error('提交失败', U('Distribution/topUp'));
			}
		}
	}
	//累计销售
	public function followOrder(){
		$condition['mid'] = $this->my['id'];
		$condition['status'] = array('egt',1);
		$orderlist = M('Distribution_ordermoney')->where($condition)->order('id desc')->select();
		$order = M('Product_cart');
		$member = M('Distribution_member');
		foreach($orderlist as $key=>$value){
			$orderlist[$key]['orderid'] = $order->where('id='.$value['order_id'])->getField('orderid');
			$from_member = $member->where('id='.$value['from_mid'])->find();
			$orderlist[$key]['from_member'] = $from_member;
			if($from_member['fid']==$this->my['id']){
				$orderlist[$key]['typename'] = 'A分店';
			}
			if($from_member['sid']==$this->my['id']){
				$orderlist[$key]['typename'] = 'B分店';
			}
			if($from_member['tid']==$this->my['id']){
				$orderlist[$key]['typename'] = 'C分店';
			}
		}
		$this->assign('orderlist',$orderlist);
		$this->display();
	}
	//下级列表
	public function memberList(){
		$token		= $this->token;
		$type		= $this->_get('type');
		$wecha_id	= $this->wecha_id;
		if($type=='first'){
			$condition['fid'] = $this->my['id'];
			$flag = 1;
			$level = 'A';
		}
		if($type=='second'){
			$condition['sid'] = $this->my['id'];
			$flag = 1;
			$level = 'B';
		}
		if($type=='third'){
			$condition['tid'] = $this->my['id'];
			$flag = 1;
			$level = 'C';
		}
		if($flag!=1){
			exit('异常访问');
		}
		$condition['token'] = $token;
		//$condition['wecha_id'] = $wecha_id;
		$db = M('Distribution_member');
		$member = $db->where($condition)->order('id desc')->select();
		$this->assign('member',$member);
		$this->assign('level',$level);
		$this->display();
	}
	//正式A分店
	public function memberAllList(){
		$token		= $this->token;
		$wecha_id	= $this->wecha_id;
		/*$condition['fid'] = $this->my['id'];
		$condition['sid'] = $this->my['id'];
		$condition['tid'] = $this->my['id'];
		$condition['_logic'] = 'or';
		$map['_complex'] = $condition;*/
		$map['bindmid'] = $this->my['id'];
		$map['token'] = $token;
		$map['distritime'] = array('neq',0);
		//$condition['wecha_id'] = $wecha_id;
		$db = M('Distribution_member');
		$member = $db->where($map)->order('id desc')->select();
		$this->assign('member',$member);
		$this->display();
	}
	//下级分店数
	public function agentList(){
		$token		= $this->token;
		$mid		= $this->_get('mid');
		$type		= $this->_get('type');
		$wecha_id	= $this->wecha_id;
		if($type=='first'){
			$condition['fid'] = $mid;
			$flag = 1;
			$level = 'A';
		}
		if($type=='second'){
			$condition['sid'] = $mid;
			$flag = 1;
			$level = 'B';
		}
		if($type=='third'){
			$condition['tid'] = $mid;
			$flag = 1;
			$level = 'C';
		}
		if($flag!=1){
			exit('异常访问');
		}
		$condition['token'] = $token;
		//$condition['wecha_id'] = $wecha_id;
		$db = M('Distribution_member');
		$childmember = $db->where($condition)->order('id desc')->select();
		$this->assign('childmember',$childmember);
		$this->assign('level',$level);
		$this->display();
	}
	public function clickList(){
		$token		= $this->token;
		$wecha_id	= $this->wecha_id;
		$condition['token'] = $token;
		$condition['mid'] = $this->my['id'];
		$db = M('Distribution_click');
		$click = $db->where($condition)->order('id desc')->select();
		dump($click);
		$this->assign('click',$click);
		$this->display();
	}
	//普通A分店
	public function followList(){
		$token		= $this->token;
		$wecha_id	= $this->wecha_id;
		$condition['token'] = $token;
		$condition['bindmid'] = $this->my['id'];
		$db = M('Distribution_member');
		$follow = $db->where($condition)->order('id desc')->select();
		$this->assign('follow',$follow);
		$this->display();
	}
	//分店信息
	public function memberIndex(){
		$token		= $this->token;
		$id	= $this->_get('id');
		$wecha_id	= $this->wecha_id;
		$member = M('Distribution_member')->where(array('token'=>$token,'id'=>$id))->find();
		$db = M('Distribution_ordermoney');
		$member['first_member_totalMoney'] = $db->where(array('type'=>'fid','mid'=>$id,'token'=>$token,'status'=>array('gt',0)))->sum('orderMoney');
		$member['first_member_offerMoney'] = $db->where(array('type'=>'fid','mid'=>$id,'token'=>$token,'status'=>array('gt',0)))->sum('offerMoney');
		$member['second_member_totalMoney'] = $db->where(array('type'=>'sid','mid'=>$id,'token'=>$token,'status'=>array('gt',0)))->sum('orderMoney');
		$member['second_member_offerMoney'] = $db->where(array('type'=>'sid','mid'=>$id,'token'=>$token,'status'=>array('gt',0)))->sum('offerMoney');
		$member['third_member_totalMoney'] = $db->where(array('type'=>'tid','mid'=>$id,'token'=>$token,'status'=>array('gt',0)))->sum('orderMoney');
		$member['third_member_offerMoney'] = $db->where(array('type'=>'tid','mid'=>$id,'token'=>$token,'status'=>array('gt',0)))->sum('offerMoney');
		$offerMoney = $db->where(array('from_mid'=>$id,'mid'=>$this->my['id'],'token'=>$token,'status'=>4))->sum('offerMoney');
		$this->assign('offerMoney',$offerMoney);
		$this->assign('member',$member);
		$this->display();
	}
	public function getMoney(){
		$token	= $this->token;
		$wecha_id	= $this->wecha_id;
		// if($this->my['distritime']==0){
		// 	$url = U('Distribution/myDistribution',array('token'=>$token,'notBe'=>1));
		// 	$this->redirect($url);//跳回
		// 	exit();
		// }
		$id = $this->my['id'];
		$order['status_4'] = M('Distribution_ordermoney')->where(array('token'=>$token,'mid'=>$id,'status'=>4))->sum('offerMoney');//已审核
		$this->assign('order',$order);
		if(IS_POST){
			$name = $this->_post('name');
			$tele = $this->_post('tele');
			$bankname = $this->_post('bankname');
			$banknumber = $this->_post('banknumber');
			$aliname = $this->_post('aliname');
			$alinumber = $this->_post('alinumber');
			$money = intval($this->_post('money'));
			if($money<=0){
				$arr = array('success'=>-1,'info'=>'提现金额不能为零或负值');
				echo json_encode($arr);
				exit;
			}
			if($money>200){
				$arr = array('success'=>-1,'info'=>'每次提现金额不能超过200元');
				echo json_encode($arr);
				exit;
			}
			$classid = $this->_post('classid');
			$wecha_id	= $this->wecha_id;
			if($name!=''&&$tele!=''&&$money!=''){
				$data['name'] = $name;
				$data['tele'] = $tele;
				$data['bankName'] = $bankname;
				$data['bankNumber'] = $banknumber;
				$data['aliName'] = $aliname;
				$data['aliNumber'] = $alinumber;
				$data['mid'] = $this->my['id'];
				$data['wecha_id'] = $wecha_id;
				$data['money'] = $money*100;
				$data['token'] = $this->token;
				$data['applytime'] = time();
				if(($order['status_4']-$this->my['alreadyGetMoney'])<$money*100){
					$arr = array('success'=>-1,'info'=>'提现金额超出可提现值');
					echo json_encode($arr);
					exit;
				}
				if(M('Distribution_applystore')->add($data)){
					M('Distribution_member')->where('id='.$this->my['id'])->setInc('alreadyGetMoney',$money*100);
					$arr = array('success'=>1,'info'=>'提现申请成功，请等待审核');
					echo json_encode($arr);
					exit;
				}else{
					$arr = array('success'=>0,'info'=>'提现失败');
					echo json_encode($arr);
					exit;
				}
			}else{
				$arr = array('success'=>-1,'info'=>'所有内容不能为空');
				echo json_encode($arr);
				exit;
			}
		}else{
			$this->display();
		}
	}
	//我的收益
	public function getMoneyList(){
			// $status	= $this->_get('status');
			// if($status!=''){
			// 	$condition['status'] = $status;
			// }
			$condition['token'] = $this->token;
			$condition['wecha_id'] = $this->wecha_id;
			$list = M('Distribution_applystore')->where($condition)->order('id desc')->select();
			//$db = M('Distribution_member');
			foreach($list as $key=>$value){
				//未提现
				if($value['status']!=1){
					$notget+=$value['money']/100;
				}else{
					$get+=$value['money']/100;
				}
				//已提现
				// $info = $db->where('id='.$value['mid'])->field('nickname,headimgurl')->find();
				// $list[$key]['nickname'] = $info['nickname'];
				// $list[$key]['headimgurl'] = $info['headimgurl'];
			}
			$notget=sprintf("%.2f", $notget);
			$get=sprintf("%.2f", $get);
			$this->assign("notget",$notget);
			$this->assign("get",$get);
			$this->assign("title","我的收益");
			//$this->assign('list',$list);
			$this->display();
	}
	//我的账单
	public function myBill(){
		$db = M('Distribution_applystore');
		$list = $db->where(array('wecha_id'=>$this->wecha_id))->select();
		$this->assign('list',$list);
		$this->display();
	}
	public function getMoneyProcess(){
			$this->display();
	}
	public function myScanner(){
		$token = $this->token;
		$wecha_id = $this->wecha_id;
		$mid = $this->_get('mid');
		if($mid){
			$res = M('Distribution_forward_set')->where(array('token'=>$token))->find();
			if($mid==$this->my['id']){
				$memberCode = M('membercode')->where(array('token'=>$token,'wecha_id'=>$wecha_id))->find();
				if(!$memberCode){
					$code_url = $this->makeCode($token,$wecha_id,$mid);
				}else{
					$code_url = $memberCode['code_url'];
				}
				$from_member = $this->my;
				$this->assign('from_member',$from_member);
				$this->assign('code_url',$code_url);
				$this->assign('wecha_id',$wecha_id);
				$this->assign('res',$res);
				$this->display();
			}else{
				/*$follow = M('Newstore')->where(array('token'=>$token,'wecha_id'=>$wecha_id,'status'=>1))->find();
				if($follow){
					$res['follow'] = 1;
				}*/
				$click = M('Distribution_click')->where(array('token'=>$token,'wecha_id'=>$wecha_id))->find();
				if($click){
					$data['mid'] = $mid;
					$data['updatetime'] = time();
					M('Distribution_click')->where('id='.$click['id'])->save($data);
					M('Distribution_click')->where('id='.$click['id'])->setInc('count');
				}else{
					//$user_info = $this->get_user_info($wecha_id);
					//$data['nickname'] = $user_info['nickname'];
					//$data['headimgurl'] = $user_info['headimgurl'];
					$data['updatetime'] = time();
					$data['token'] = $token;
					$data['wecha_id'] = $wecha_id;
					$data['mid'] = $mid;
					$data['count'] = 1;
					$clickid = M('Distribution_click')->add($data);
					M('Distribution_member')->where('id='.$mid)->setInc('clickNums');
				}
				$memberCode = M('membercode')->where('mid='.$mid)->find();
				$from_member = M('Distribution_member')->where('id='.$mid)->find();
				if(!$memberCode){
					$code_url = $this->makeCode($token,$from_member['wecha_id'],$mid);
				}else{
					$code_url = $memberCode['code_url'];
				}
				$this->assign('code_url',$code_url);
				$this->assign('from_member',$from_member);
				$this->assign('res',$res);
				$this->display();
			}
		}else{
			$mid = M('Distribution_member')->where(array('token'=>$token,'wecha_id'=>$wecha_id))->getField('id');
			if($mid){
				$customeUrl = C('site_url').U('Distribution/myScanner',array('token'=>$token,'mid'=>$mid));
				header('Location:' . $customeUrl);
				exit();
			}else{
				$db = M('Distribution_member');
				$user_info = $this->get_user_info($wecha_id);
				$mydata['nickname'] = $user_info['nickname'];
				$mydata['headimgurl'] = $user_info['headimgurl'];
				$mydata['wecha_id'] = $wecha_id;
				$mydata['token'] = $token;
				$mydata['createtime'] = time();
				$mydata['status'] = 1;
				if($myid = $db->add($mydata)){
					//$set = M('Distribution_set')->where(array('token'=>$token))->find();
					if($my = $db->where(array('token'=>$this->token,'wecha_id'=>$wecha_id,'id'=>array('neq',$myid)))->find()){
						$db->where('id='.$myid)->delete();
						$myid = $my['id'];
					}
					$customeUrl = C('site_url').U('Distribution/myScanner',array('token'=>$token,'mid'=>$myid));
					header('Location:' . $customeUrl);
					exit();
				}else{
					exit('异常访问');
				}
			}
			/*$res = M('Distribution_forward_set')->where(array('token'=>$token))->find();
			$memberCode = M('membercode')->where(array('token'=>$token,'wecha_id'=>$wecha_id))->find();
			if(!$memberCode){
				$mid = M('Distribution_member')->where(array('token'=>$token,'wecha_id'=>$wecha_id))->getField('id');
				$code_url = $this->makeCode($token,$wecha_id,$mid);
			}else{
				$code_url = $memberCode['code_url'];
			}
			$this->assign('code_url',$code_url);
			$this->assign('wecha_id',$wecha_id);
			$this->assign('res',$res);
			$this->display();*/
		}
	}
	public function makeCode($token,$wecha_id,$mid){
		$api=M('Diymen_set')->where(array('token'=>$token))->find();
		//dump($api);
		if($api['appid']==false||$api['appsecret']==false){$this->error('必须先填写【AppId】【 AppSecret】');exit;}
		//获取微信认证

		$url_get='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$api['appid'].'&secret='.$api['appsecret'];
		$json=json_decode($this->curlGet($url_get));
		$qrcode_url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$json->access_token;
		//{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": 123}}}
		$data['action_name']='QR_LIMIT_SCENE';
		$data['action_info']['scene']['scene_id']=$mid;
		$data['action_info']['scene']['scene_id']=$mid;
		$post=$this->api_notice_increment($qrcode_url,json_encode($data));
		//if($post ==false ) $this->error('微信接口返回信息错误，请联系管理员');
		M('membercode')->where(array('token'=>$token,'wecha_id'=>$wecha_id))->delete();
		M('membercode')->add(array('token'=>$token,'wecha_id'=>$wecha_id,'mid'=>$mid,'code_url'=>$post));
		return $post;
	}
	function api_notice_increment($url, $data){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmpInfo = curl_exec($ch);
		$errorno=curl_errno($ch);
		if ($errorno) {
			//$this->error('发生错误：curl error'.$errorno);
			return array('rt'=>false,'errorno'=>$errorno);
		}else{

			$js=json_decode($tmpInfo,1);
			
			if (!$js['errcode']){
				return $js['ticket'];
			}else {
				/*$this->error('发生错误：错误代码'.$js['errcode'].',微信返回错误信息：'.$js['errmsg']);*/
				Log::write('发生错误：错误代码'.$js['errcode'].',微信返回错误信息：'.$js['errmsg'].'openid='.$data->touser,'ERR');
			}
		}
	}
	public function getqrCode(){
		$token = $this->token;
		$wecha_id = $this->wecha_id;
		$mid = $this->_get('mid');
		$data = C('site_url').U('Distribution/forward',array('token'=>$token,'mid'=>$mid));
		vendor("phpqrcode.phpqrcode");
		// 纠错级别：L、M、Q、H
		$level = 'L';
		// 点的大小：1到10,
		$size = 10;
		echo QRcode::png($data, false, $level, $size);
	}
	public function myBank(){
		if(IS_POST){
			$name = $this->_post('name');
			$bankName = $this->_post('bankName');
			$bankNumber = $this->_post('bankNumber');
			$tele = $this->_post('tele');
			$classid = $this->_post('classid');
			if($name!=''&&$bankName!=''&&$bankNumber!=''&&$tele!=''&&$classid!=''){
				$data['name'] = $name;
				$data['bankName'] = $bankName;
				$data['bankNumber'] = $bankNumber;
				$data['tele'] = $tele;
				$data['classid'] = $classid;
				$condition['token'] = $this->token;
				$condition['wecha_id'] = $this->wecha_id;
				if(M('Distribution_bank')->where($condition)->find()){
					if(M('Distribution_bank')->where($condition)->save($data)){
						$arr = array('success'=>1,'info'=>'信息保存成功');
						echo json_encode($arr);
						exit;
					}else{
						$arr = array('success'=>0,'info'=>'保存失败或信息未改动');
						echo json_encode($arr);
						exit;
					}
				}else{
					$data['token'] = $this->token;
					$data['wecha_id'] = $this->wecha_id;
					$data['lasttime'] = time();
					if(M('Distribution_bank')->add($data)){
						$arr = array('success'=>1,'info'=>'信息保存成功');
						echo json_encode($arr);
						exit;
					}else{
						$arr = array('success'=>0,'info'=>'保存失败');
						echo json_encode($arr);
						exit;
					}
				}
			}else{
				$arr = array('success'=>-1,'info'=>'所有内容不能为空');
				echo json_encode($arr);
				exit;
			}
		}else{
			$token = $this->token;
			$wecha_id = $this->wecha_id;
			$bank = M('Distribution_bank')->where(array('token'=>$token,'wecha_id'=>$wecha_id))->find();
			//所属区域
			if($bank['classid']){
				import ( "@.Org.TypeFile" );
				$tid = $bank['classid'];
				$TypeFile = new TypeFile ( 'ClassCity' ); //实例化分类类
				$result = $TypeFile->getPath ( $tid ); //获取分类路径
				$this->assign ( 'typeNumArr', $result );
			}
			$this->assign('bank',$bank);
			$this->display();
		}
	}
	public function intro(){
		$token = $this->token;
		$mid = $this->_get('mid');
		$wecha_id = $this->wecha_id;
		$res = M('Distribution_forward_set')->where(array('token'=>$token))->find();
		$follow = M('Newstore')->where(array('token'=>$token,'wecha_id'=>$wecha_id,'status'=>1))->find();
		if($follow){
			$res['follow'] = 1;
		}
		if($mid){//个人
			$click = M('Distribution_click')->where(array('token'=>$token,'wecha_id'=>$wecha_id))->find();
			if($click){
				$data['mid'] = $mid;
				$data['updatetime'] = time();
				M('Distribution_click')->where('id='.$click['id'])->save($data);
				M('Distribution_click')->where('id='.$click['id'])->setInc('count');
			}else{
				$user_info = $this->get_user_info($wecha_id);
				$data['nickname'] = $user_info['nickname'];
				$data['headimgurl'] = $user_info['headimgurl'];
				$data['updatetime'] = time();
				$data['token'] = $token;
				$data['wecha_id'] = $wecha_id;
				$data['mid'] = $mid;
				$data['count'] = 1;
				$clickid = M('Distribution_click')->add($data);
				M('Distribution_member')->where('id='.$mid)->setInc('clickNums');
			}
			$from_member = M('Distribution_member')->where('id='.$mid)->find();
			$this->assign('from_member',$from_member);
		}
		$this->assign('res',$res);
		$this->display();
	}
	//我的收藏
	public function collection(){
		$token = $this->token;
		$wecha_id = $this->wecha_id;
		$db = M('Product_collection');
		$where = array('token'=>$token,'wecha_id'=>$wecha_id);
		$list = $db->where($where)->order('id desc')->select();
		$productModel = M('Product');
		foreach($list as $key=>$value){
			$product = $productModel->where('id='.$value['productid'])->find();
			$list[$key]['product'] = $product;
		}
		$this->assign('list',$list);
		$this->display();
	}
	//判断个人资料完善度
	public function checkPersonalInfoPerfect($aid){
		$account = D('Account')->where('id='.$aid)->find();
		if(!$account['petname']||!$account['nickname']||!$account['tele']||$account['headimgurl'] == 'http://qchpt.b0.upaiyun.com/mhfcjx1421158741/2016/07/28/1469701369_ltmojad1p43nanvx.jpg' || $account['headimgurl'] == ''){
			return false;
		}else{
			return true;
		}
	}
	//推荐二维码
	public function generateQrcode(){
		$aid = $this->_get('aid');
		if($aid){
			$account = D('Account')->where('id='.$aid)->find();
			$account['petname'] =base64_decode($account['petname']);
			$this->assign('account',$account);
		}else{
			if($this->account['lid'] == 0){
				$this->error('请升级后获取二维码',U('Distribution/upgrade'));
			}
			if(!$this->checkPersonalInfoPerfect($this->account['id'])){
				$this->error('请完善个人资料',U('Distribution/index'));
			}
			if(!$this->account['wxcode']){
				$wxcode = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$this->makeCode($this->token,'',$this->account['id']);
				D('Account')->where('id='.$this->account['id'])->setField('wxcode',$wxcode);
				$this->account['wxcode'] = $wxcode;
				$this->assign('account',$this->account);
			}
		}
		// if($aid){
		// 	$img_src = D('Account')->where('id='.$aid)->getField('qrcode');
		// }else{
		// 	if(!$this->account['qrcode']){
		// 		session('uid',7);
		// 		$upyun = A('User/Upyun');
		// 		session('uid',NULL);
		// 		//拼接图片
		// 		$path = $this->qrcodecom();
		// 		$fh = fopen($path, 'r');
		// 		$dir_pic = '/'.$this->token.'/'.date('Y').'/'.date('m').'/'.date('d').'/'.$this->account['id'].'_'.time().'.jpg';
		// 		//判断存储到本地还是上传到云
		// 		$upload_type=C('upload_type')?C('upload_type'):'local';
		// 		if($upload_type == 'upyun'){
		// 			$result = $upyun->test($dir_pic, $fh);
		// 			$img_src = "http://".UNYUN_DOMAIN.$dir_pic;
		// 			unlink($path);
		// 		}else{
		// 			$img_src = C('site_url').'/'.$path;
		// 		}
		// 		fclose($fh);
		// 		$data = array(
		// 			'qrcode' => $img_src,
		// 		);
		// 		M('Distribution_account')->where('id='.$this->account['id'])->save($data);
		// 	}else{
		// 		$img_src = $this->account['qrcode'];
		// 	}
		// }
		// $this->assign('img',$img_src);
		$this->display();

	}
	//生成组合二维码
	public function qrcodecom(){
		// $qrcode=$this->makeCode($this->token,$this->wecha_id,$this->member['id']);
		// $qrcode='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$qrcode;
		$code = M('Membercode')->where(array('wecha_id'=>$this->wecha_id))->find();
		// $qrcode = $code['code_url']?'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$code['code_url']:'';
		import("@.ORG.ImageCombine");
		$arr=array(
			'dst' => 'uploads/qchbg.jpg',
	        // 'text' => '我是'.mb_substr($this->account['petname'],0,4,'utf-8'),
	        'text' => '我是'.$this->account['petname'],
			'fontsize' => 30,
	        'fontX' => 263,
			'fontY' => 462,
	        'qrcodesize' => 376,
	        'qrcodX' => 127,
	        'qrcodY' => 590,
	        'token' => $this->token,
	        'openid' => $this->wecha_id,
	        'id' => $this->account['id'],
			'path' => 'uploads/qrcode/',
			'img_src' => $this->account['headimgurl'],
			'headimgsize' => 130,
			'headX' => 122,
	        'headY' => 400,
		);
		$combine=new ImageCombine($arr);
		$qrcode=$combine->mergerImg();
		return $qrcode;
	}
	//店铺统计
	public function charts(){
		$this->assign('title','店铺统计');
		$this->display();
	}
	//获取店铺统计数据（AJAX）
	public function getChartsAjax(){
		$type = $this->_get('type');
		$days = $this->_get('days');
		$info=$this->getCharts($type,$days);
		if($info){
			$this->ajaxReturn($info,'',1);
		}else{
			$this->ajaxReturn("","",2);
		}
	}
	//店铺统计获取数据（访客数1，订单数2，佣金3）
	public function getCharts($type,$days){
		$info = array();
		switch ($type) {
			//访客数
			case '1':
				$list=M('Distribution_visitcount')->where(array('mid'=>$this->my['id']))->limit($days)->select();
				$str = $this->chartsDataHtml($list);
				$categories.="[";
				foreach ($list as $k => $v) {
					$categories.="'".date("m-d",$v['addtime'])."',";
				}
				$categories.="]";
				$data.="[";
				foreach ($list as $k => $v) {
					$data.=$v['count'].",";
					$count += $v['count'];
				}
				$data.="]";
				break;
			//订单数(下级所有人)
			case '2':
				$ids = $this->statisticalIds();
				// $member=M("Distribution_member")->field('wecha_id')->where(array('id'=>array('in',$ids)))->select();
				// $wecha_str = '('."'".$this->wecha_id."'";
				// foreach ($member as $k => $v) {
				// 	$wecha_str .=' ,'."'".$v['wecha_id']."'";
				// }
				// $wecha_str .= ')';
				if(!$ids){
					$ids = 0;
				}
				$sql = 'SELECT count(id) as count,time as addtime FROM `pigcms_product_cart` WHERE aid in ('.$ids.') and paid=1 group by year,month,day order by time asc limit '.$days;
				$list = M()->query($sql);
				$str = $this->chartsDataHtml($list);
				//$list = M("Product_cart")->where(array('wecha_id'=>$this->wecha_id,'paid'=>1))->select();
				$categories.="[";
				foreach ($list as $k => $v) {
					$categories.="'".date("m-d",$v['addtime'])."',";
				}
				$categories.="]";
				$data.="[";
				foreach ($list as $k => $v) {
					$data.=$v['count'].",";
					$count += $v['count'];
				}
				$data.="]";
				break;
			//金币收入
			case '3':
				$sql = 'SELECT SUM(gold) as count,addtime FROM `pigcms_distribution_earning` WHERE aid ='.$this->account['id'].' group by year,month,day order by addtime asc limit '.$days;
				$list = M()->query($sql);
				$str = $this->chartsDataHtml($list);
				//$list = M("Product_cart")->where(array('wecha_id'=>$this->wecha_id,'paid'=>1))->select();
				$categories.="[";
				foreach ($list as $k => $v) {
					$categories.="'".date("m-d",$v['addtime'])."',";
				}
				$categories.="]";
				$data.="[";
				foreach ($list as $k => $v) {
					$data.=($v['count']).",";
					$count += ($v['count']);
				}
				$data.="]";
				break;
			//现金收入
			case '4':
				$sql = 'SELECT SUM(earn) as count,addtime FROM `pigcms_distribution_earning` WHERE aid ='.$this->account['id'].' group by year,month,day order by addtime asc limit '.$days;
				$list = M()->query($sql);
				$str = $this->chartsDataHtml($list);
				//$list = M("Product_cart")->where(array('wecha_id'=>$this->wecha_id,'paid'=>1))->select();
				$categories.="[";
				foreach ($list as $k => $v) {
					$categories.="'".date("m-d",$v['addtime'])."',";
				}
				$categories.="]";
				$data.="[";
				foreach ($list as $k => $v) {
					$data.=($v['count']).",";
					$count += ($v['count']);
				}
				$data.="]";
				break;
		}
		$info[0]=$categories;
		$info[1]=$data;
		$info[2]=$count?$count:0;
		$info[3]=$str;
		return $info;
	}
	//拼接数据HTML
	public function chartsDataHtml($list){
		foreach ($list as $k => $v) {
			$str.="<div class='tongji2'>";
			$str.="<div class='tongji3'>".date('Y-m-d',$v['addtime'])."</div>";
			$str.="<div class='tongji3'>".$v['count']."</div>";
			$str.="<div class='clear'></div>";
			$str.="</div>";
		}
		return $str;
	}
	private function get_user_info($wecha_id){
		$access_str = $this->get_access_token();
		$info = $this->curlGet('https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_str.'&openid='.$wecha_id.'&lang=zh_CN');
		$infoarr = json_decode($info, 1);
		return $infoarr;
	}
	public function updateMyInfo(){
		$token = $this->token;
		$wecha_id = $this->wecha_id;
		$db = M('Distribution_member');
		$member = $db->where(array('token'=>$token,'wecha_id'=>$wecha_id))->field('id,updateInfoTime')->find();
		if($member&&$member['updateInfoTime']
		<strtotime(date('Y-m-d'))){
			$user_info = $this->
			get_user_info($wecha_id);
			if(!$user_info['errcode']){
				$data['nickname'] = $user_info['nickname'];
				$data['headimgurl'] = $user_info['headimgurl'];
				$data['updateInfoTime'] = time();
				$db->where('id='.$member['id'])->save($data);
			}
		}
		$this->redirect(U('Distribution/index',array('token'=>$token)));
	}
}?>