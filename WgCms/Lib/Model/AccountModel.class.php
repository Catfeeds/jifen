<?php  
	class AccountModel extends RelationModel{
		public $my;
		protected function _initialize(){
			$this->my = M('Distribution_member')->where(array('wecha_id'=>$_SESSION['qchwecha_id']))->find();
		}
		protected $tableName = 'distribution_account';
		protected $_validate = array(
		    array('username','require','用户名不能为空！'),
		    array('password','require','密码不能为空！'),
		    array('repassword','require','重复密码不能为空！'),
		    array('repassword','password','确认密码不正确',0,'confirm'),
	    );
	    protected $_auto = array ( 
	    	array('password','md5',1,'function') ,
	        array('wecha_id','getWecha_id',1,'callback'),
	        array('year','getY',1,'callback'),
	        array('month','getM',1,'callback'),
	        array('day','getD',1,'callback'),
	        array('addtime','time',1,'function'),
	    );
	    protected $_link = array(
	    	'level' => array(
	    		'mapping_type' => BELONGS_TO,
	    		'class_name' => 'Distribution_level',
	    		'foreign_key' => 'lid',
	    		'mapping_fields' => 'name',
	    	),
	    	'member' => array(
	    		'mapping_type' => BELONGS_TO,
	    		'class_name' => 'Distribution_member',
	    		'foreign_key' => 'mid',
	    		'mapping_fields' => 'nickname,wecha_id',
	    	),
	    	'agent' => array(
	    		'mapping_type' => BELONGS_TO,
	    		'class_name' => 'Distribution_agent',
	    		'foreign_key' => 'agent',
	    	),
	    );
	    protected function getWecha_id(){
	    	return $this->my['wecha_id'];
	    }
	    protected function getY(){
	    	return date('Y',time());
	    }
	    protected function getM(){
	    	return date('m',time());
	    }
	    protected function getD(){
	    	return date('d',time());
	    }
	}
?>