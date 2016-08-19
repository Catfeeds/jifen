<?php
class StoreAction extends WapAction{
	//public $token;
	public $product_model;
	public $product_cat_model;
	public $session_cart_name;
	public $my;
	public function _initialize() {
		parent::_initialize();
		
		$agent = $_SERVER['HTTP_USER_AGENT']; 
		if (!strpos($agent, "MicroMessenger")) {
			//	echo '此功能只能在微信浏览器中使用';exit;
		}
		$this->session_cart_name = 'session_cart_products_' . $this->token;
		$this->assign('token', $this->token);
		$this->assign('wecha_id', $this->wecha_id);
		$this->product_model = M('Product');
		$this->product_cat_model = M('Product_cat');
		$this->assign('staticFilePath', str_replace('./','/',THEME_PATH.'common/css/store'));
		//购物车
		$calCartInfo = $this->calCartInfo();
		$this->assign('totalProductCount', $calCartInfo[0]);
		$this->assign('totalProductFee', $calCartInfo[1]);
		$my = M('Distribution_member')->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
		$this->my = $my;
		$this->assign('my',$my);

		$company = M('company')->where(array('token'=>$this->token))->find();
		$this->assign('company',$company);

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
		$url_par = $_SERVER['SERVER_ADDR'].$_SERVER['PHP_SELF'];
		$this->assign('url_par',$url_par);
	}
	
	function remove_html_tag($str){  //清除HTML代码、空格、回车换行符
		//trim 去掉字串两端的空格
		//strip_tags 删除HTML元素
		$str = trim($str);
		$str = @preg_replace('/<script[^>]*?>(.*?)<\/script>/si', '', $str);
		$str = @preg_replace('/<style[^>]*?>(.*?)<\/style>/si', '', $str);
		$str = @strip_tags($str,"");
		$str = @ereg_replace("\t","",$str);
		$str = @ereg_replace("\r\n","",$str);
		$str = @ereg_replace("\r","",$str);
		$str = @ereg_replace("\n","",$str);
		$str = @ereg_replace(" ","",$str);
		$str = @ereg_replace("&nbsp;","",$str);
		return trim($str);
	}
	
	public function index() {
		if(!$this->my){
			$click = M('Distribution_click')->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
			if($click&&$click['mid']!=0){
				$from_member_info = M('Distribution_member')->where('id='.$click['mid'])->find();
				if($from_member_info){
					$this->assign('from_member_info',$from_member_info);
				}
			}
		}
		$cats = $this->product_cat_model->where(array('token' => $this->token))->order('sort asc,id asc')->select();
		foreach($cats as $key=>$value){
			$cats[$key]['products'] = $this->product_model->where(array('catid'=>$value['id'],'isopen'=>1))->limit(4)->order('sort desc,id DESC')->select();
		}
		//底部商品
		$bproducts=$this->product_model->limit(20)->where(array('isopen'=>1))->order('fakemembercount DESC,id desc')->select();
		$this->assign('bproducts',$bproducts);

		$res = M('Distribution_forward_set')->where(array('token'=>$this->token))->find();
		$banner = M('Product_banner')->where(array('token'=>$this->token))->order('sort desc,id asc')->select();
		$this->assign('banner',$banner);
		$guanggao = M('Product_guanggao')->where(array('token'=>$this->token))->order('sort desc,id asc')->select();
		$this->assign('guanggao',$guanggao);
		$this->assign('res',$res);
		$this->assign('totalNums',$totalNums);
		$this->assign('cats', $cats);
		$this->display();
	}
	//遍历显示价格
	public function showPrice($info,$type = ''){
		if(is_array($info)){
			foreach ($info as $k => $v) {
				if($v['lid']){
					$info[$k]['showprice'] = $info[$k]['price'];
				}else{
					if($type == 'saleprice'){
						$info[$k]['showprice'] = $info[$k]['price'] == 0 ? $this->showPrice($v['id'],$type) :$info[$k]['price'];
					}else{
						$info[$k]['showprice'] = $this->showPrice($v['id']) == 0 ? $info[$k][$this->myPrice()] :$this->showPrice($v['id']);
					}
				}
			}
			return $info;
		}else{//详情返回显示价格$info 为产品ID
			$detail = M('Product_detail')->where(array('pid'=>$info))->order('price asc')->find();
			if($detail){
				if($type == 'saleprice'){
					return $detail['price'];
				}else{
					return $detail[$this->myPrice()];
				}
			}
		}
	}
	//根据会员等级返回价格
	public function myPrice(){
		switch ($this->account['lid']) {
			case '1':
				return 'price';
				break;
			case '2':
				return 'price2';
				break;
			case '3':
				return 'price3';
				break;
			case '4':
				return 'price4';
				break;
			case '5':
				return 'price5';
				break;
			case '6':
				return 'price6';
				break;
			default:
				return 'price7';
				break;
		}
	}
	
	public function cats() {
		if(!$this->my){
			$click = M('Distribution_click')->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
			if($click&&$click['mid']!=0){
				$from_member_info = M('Distribution_member')->where('id='.$click['mid'])->find();
				if($from_member_info){
					$this->assign('from_member_info',$from_member_info);
				}
			}
		}
		$this->assign('metaTitle', '商品分类');
		$cats = $this->product_cat_model->where(array('token' => $this->token))->order('sort desc,id asc')->select();
		foreach($cats as $key=>$value){
			$cats[$key]['products'] = $this->product_model->where('catid='.$value['id'])->limit(8)->order('sort asc,id asc')->select();
		}
		$totalNums = $this->product_model->where(array('token' => $this->token))->count();
		$this->assign('totalNums',$totalNums);
		$this->assign('cats', $cats);
		$this->display();
	}
	/**
	 * 根据pid查找该类型下的子类型
	 */
	public function queryNextType() {
		$pid = $_POST ['pid'];
		$Type = M ( 'ClassCity' );
		$type = $Type->where ( 'pid=' . $pid )->select ();
		foreach ( $type as $key => $value ) {
			if ($Type->where ( 'pid=' . $value ['id'] )->field ( 'id' )->select ()) {
				$type [$key] ['next'] = 1;
			} else {
				$type [$key] ['next'] = 0;
			}
		}
		echo json_encode ( $type );
	}
	public function products() {
		if(!$this->my){
			$click = M('Distribution_click')->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
			if($click&&$click['mid']!=0){
				$from_member_info = M('Distribution_member')->where('id='.$click['mid'])->find();
				if($from_member_info){
					$this->assign('from_member_info',$from_member_info);
				}
			}
		}
		$where = array('token' => $this->token, 'groupon' => 0, 'dining' => 0);
		$catid = isset($_GET['catid']) ? intval($_GET['catid']) : 0;
		if ($catid) {
			$where['catid'] = array("in",$this->getCatIds($catid));
			$thisCat = $this->product_cat_model->where(array('id'=>$catid))->find();
			$this->assign('thisCat', $thisCat);
		}
		$where['isopen'] = 1;
		if (IS_POST){
			$key = $this->_post('search_name');
            $this->redirect('/index.php?g=Wap&m=Store&a=products&token=' . $this->token . '&keyword=' . $key);
		}
		if (isset($_GET['keyword'])){
            $where['name|intro|keyword'] = array('like', "%".$_GET['keyword']."%");
            $this->assign('isSearch', 1);
		}
		$count = $this->product_model->where($where)->count();
		$this->assign('count', $count); 
		//排序方式
		$method = isset($_GET['method']) && ($_GET['method']=='DESC' || $_GET['method']=='ASC') ? $_GET['method'] : 'DESC';
		$orders = array('time', 'discount', 'price', 'salecount');
		$order = isset($_GET['order']) && in_array($_GET['order'], $orders) ? $_GET['order'] : 'time';
		$this->assign('order', $order);
		$this->assign('method', $method);
        
		$name = isset($thisCat['name']) ? $thisCat['name'] . '列表' : "商品列表";
		$products = $this->product_model->where($where)->order("sort DESC,id DESC")->limit('0, 8')->select();
		$this->assign('products', $products);
		$this->assign('metaTitle', $name);
		$this->display();
	}
	
	private function getCatIds($catid){
		$cat=D("Product_cat")->where("id=".$catid)->find();
		if($cat['isfinal']==2){
			$cat2=D("Product_cat")->where("parentid=".$catid)->order("isfinal desc")->select();
			foreach ($cat2 as $k => $v) {
				$str.=$this->getCatIds($v['id']).",";
			}
		}
		return $str.$catid;
	}

	public function ajaxProducts(){
		$where=array('token'=>$this->token);
		if (isset($_GET['catid'])){
			$catid=intval($_GET['catid']);
			$where['catid'] = array("in",$this->getCatIds($catid));
		}
		$page = isset($_GET['page']) && intval($_GET['page'])>1 ? intval($_GET['page']) : 2;
		$pageSize = isset($_GET['pagesize']) && intval($_GET['pagesize']) > 1 ? intval($_GET['pagesize']) : 8;
		$where['isopen'] = 1;
		$method = isset($_GET['method']) && ($_GET['method']=='DESC' || $_GET['method']=='ASC') ? $_GET['method'] : 'DESC';
		$orders = array('time', 'discount', 'price', 'salecount');
		$order = isset($_GET['order']) && in_array($_GET['order'], $orders) ? $_GET['order'] : 'time';
		$start=($page-1) * $pageSize;
		$products = $this->product_model->where($where)->order("sort DESC,id DESC")->limit($start . ',' . $pageSize)->select();
		exit(json_encode(array('products' => $products)));
	}
	
	public function product() {
		if(!$this->my){
			$click = M('Distribution_click')->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
			if($click&&$click['mid']!=0){
				$from_member_info = M('Distribution_member')->where('id='.$click['mid'])->find();
				if($from_member_info){
					$this->assign('from_member_info',$from_member_info);
				}
			}
		}
		$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
		$where = array('token' => $this->token, 'id' => $id);
		$product = $this->product_model->where($where)->find();
		if (empty($product)) {
			$this->redirect(U('Store/products',array('token' => $this->token)));
		}
		
		$product['intro'] = isset($product['intro']) ? htmlspecialchars_decode($product['intro']) : '';
		$this->assign('product', $product);
		if($product['limit']==1&&(!$this->my||$this->my['distritime']==0)){//星级店主购买未达到条件
			$noRight = 1;
		}else{
			$noRight = 0;
		}
		$this->assign('noRight',$noRight);
		/*if($this->wecha_id=='oJbkIs0dySROFPx7Vf1gXU4rPFsM'){
			dump($product['limit']);
			dump($this->my);
			dump($noRight);
		}*/
		if ($product['endtime']){
			$leftSeconds = intval($product['endtime'] - time());
			$this->assign('leftSeconds', $leftSeconds);
		}
        $normsData = M("Norms")->where(array('catid' => $product['catid']))->select();
        foreach ($normsData as $row) {
        	$normsList[$row['id']] = $row['value'];
        }
        if($productCatData = M('Product_cat')->where(array('id' => $product['catid'], 'token' => $this->token))->find()) {
        	$this->assign('catData', $productCatData);
        }
		$colorDetail = $normsDeatail = $productDetail = array();
		$attributeData = M("Product_attribute")->where(array('pid' => $product['id']))->select();
		
		$productDetailData = M("Product_detail")->where(array('pid' => $product['id']))->select();
		foreach ($productDetailData as $p) {
			$p['formatName'] = $normsList[$p['format']];
			$p['colorName'] = $normsList[$p['color']];
			if($p['format']!=0){
				$formatData[$p['format']] = $productDetail[] = $p;
				$normsDetail[$p['format']][] = $p;
			}
			if($p['color']!=0){
				$colorData[$p['color']] = $productDetail[] = $p;
				$colorDetail[$p['color']][] = $p;
			}
		}
		//判断是否已收藏
		if(M('Product_collection')->where(array('productid'=>$id))->find()){
			$this->assign('collection',1);
		}

		$productimage = M("Product_image")->where(array('pid' => $product['id']))->select();
		$products = M("Product")->where(array('catid' => $product['catid']))->limit(8)->order('id desc')->select();
		$this->assign('products', $products);
		$this->assign('imageList', $productimage);
		$this->assign('productDetail', $productDetail);
		$this->assign('attributeData', $attributeData);
		$this->assign('normsDetail', $normsDetail);
		$this->assign('colorDetail', $colorDetail);
		$this->assign('formatData', $formatData);
		$this->assign('colorData', $colorData);
		$this->assign('metaTitle', $product['name']);
		//$product['intro'] = str_replace(array('&lt;','&gt;','&quot;','&amp;nbsp;'),array('<','>','"',' '), $product['intro']);
		//$intro = $this->remove_html_tag($product['intro']);
		//$intro = mb_substr($intro, 0, 30,'utf-8');
		//$this->assign('intro',$intro);
		
		
		
		
		//$page = isset($_GET['page']) ? max(intval($_GET['page']), 1) : 1;
		//$start = ($page - 1) * $offset;
		//$product_cart_model = M('product_cart');
		//$orders = $product_cart_model->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->limit($start, $offset)->order('time DESC')->select();
		
		
		$where = array('token' => $this->token, 'pid' => $id, 'isdelete' => 0);
		$product_model = M("Product_comment");
		$score      = $product_model->where($where)->sum('score');
		$count      = $product_model->where($where)->count();
		$comment = $product_model->where($where)->order('id desc')->limit("0, 10")->select();
		foreach ($comment as &$com) {
			$com['wecha_id'] = substr($com['wecha_id'], 0, 7) . "****";
		}
		
		$percent = "100%";
		if ($count) {
			$score = number_format($score / $count, 1);
			$percent =  number_format($score / 5, 2) * 100 . "%";
		}
		$totalPage = ceil($count / 10);
		$page = $totalPage > 1 ? 2 : 0;
		
		$this->assign('score', $score);
		$this->assign('num', $count);
		$this->assign('page', $page);
		$this->assign('comment', $comment);
		$this->assign('percent', $percent);
		$this->display();
	}
	
	public function getcomment()
	{
		$page = isset($_GET['page']) ? max(intval($_GET['page']), 1) : 1;
		$start = ($page - 1) * $offset;
		$offset = 10;
		$pid = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
		$where = array('token' => $this->token, 'pid' => $pid, 'isdelete' => 0);
		$product_model = M("Product_comment");
		$count = $product_model->where($where)->count();
		
		$comment = $product_model->where($where)->order('id desc')->limit($start, $offset)->select();
		foreach ($comment as &$com) {
			$com['wecha_id'] = substr($com['wecha_id'], 0, 7) . "****";
			$com['dateline'] = date("Y-m-d H:i", $com['dateline']);//substr($com['wecha_id'], 0, 7) . "****";
		}
		$totalPage = ceil($count / $offset);
		$page = $totalPage > $page ? intval($page + 1) : 0;
		exit(json_encode(array('error_code' => false, 'data' => $comment, 'page' => $page)));
	}
	
	/**
	 * 添加购物车
	 */
	public function addProductToCart() {
		$count = isset($_GET['count']) ? intval($_GET['count']) : 1;
		// if (empty($this->wecha_id)) {
		// 	echo false;
		// 	die;
		// }
		$carts = $this->_getCart();
		$id = intval($_GET['id']);
		$did = isset($_GET['did']) ? intval($_GET['did']) : 0;//商品的详细id,即颜色与尺寸
		$calCartInfo = $this->calCartInfo();
		$product_limitnum = M('Product')->where('id='.$id)->getField('limitnum');
		//判断购物车限购
		if(!$this->limitShopping($id)){
			echo 'limit|'.$product_limitnum;
			exit();
		}
		//判断直接购买限购
		if(!$this->judgePorductLimit($id,$count)){
			echo 'limit|'.$product_limitnum;
			exit();
		}

		if (isset($carts[$id])) {
			if ($did) {
				if (isset($carts[$id][$did])) {
					$carts[$id][$did]['count'] += $count;
				} else {
					$carts[$id][$did]['count'] = $count;
				}
			} else {
				$carts[$id] += $count;
			}
		} else {
			if ($did) {
				$carts[$id][$did]['count'] = $count;
			} else {
				$carts[$id] = $count;
			}
		}
		session($this->session_cart_name,serialize($carts));
		$calCartInfo = $this->calCartInfo();
		echo $calCartInfo[0].'|'.$calCartInfo[1];
	}
	//购物车判断限购（AJAX）
	public function checkLimitAjax(){
		$order_id = $this->_get('order_id');
		if($order_id){
			$info = M('Product_cart')->where('id='.$order_id)->getField('info');
		}
		if($info){
			$cart = unserialize($info);
		}else{
			$cart = $this->_getCart();
		}
		$check = $this->limitShoppingInfo($cart);
		if($check['status'] == 2){
			$this->ajaxReturn('',$check['info'],2);
		}else{
			$this->ajaxReturn('','',1);
		}
	}
	//判断限购(序列商品)
	public function limitShoppingInfo($info){
		foreach ($info as $k => $v) {
			$total = 0;
			if(is_array($v)){
				foreach ($v as $k2 => $v2) {
					$total += $v2['count'];
				}
			}else{
				$total = $v;
			}
			$product = M('Product')->field('limitnum,name,id')->where(array('id'=>$k))->find();
			if($total>$product['limitnum'] && $product['limitnum'] > 0){
				return array('data'=>$product['id'],'info'=>$product['name'].'的限购次数为'.$product['limitnum'],'status'=>2);
			}
		}
		return array('','',1);
	}
	//判断购物车里的限购(单个商品)
	public function limitShopping($pid){
		$cart = $this->_getCart();
		$limitnum = M('Product')->where('id='.$pid)->getField('limitnum');
		foreach ($cart as $k => $v) {
			$total = 0;
			if(is_array($v)){
				foreach ($v as $k2 => $v2) {
					$total += $v2['count'];
				}
			}else{
				$total = $v;
			}
			if($pid == $k && $total >= $limitnum && $limitnum > 0){
				return false;
			}
		}
		return true;
	}
	//判断商品限购次数
	public function judgePorductLimit($pid,$count){
		$limitnum = M('Product')->where('id='.$pid)->getField('limitnum');
		if($count > $limitnum && $limitnum > 0){
			return false;
		}else{
			return true;
		}
	}
	/**
	 * 添加收藏
	 */
	public function addCollection() {
		$wecha_id = $this->wecha_id;
		$token = $this->_get('token');
		$id = $this->_get('id');
		if($id!='' && !M('Product_collection')->where(array('productid'=>$id))->find()){
			if(M('Product_collection')->where(array('productid'=>$id))->find()){
				echo 1;
			}else{
				$data['productid'] = $id;
				$data['token'] = $token;
				$data['wecha_id'] = $wecha_id;
				$data['aid'] = $this->account['id'];
				$data['addtime'] = time();
				if(M('Product_collection')->add($data)){
					echo 2;
				}
			}
		}
	}
	/**
	 * 删除收藏
	 */
	public function delCollection() {
		$id = $this->_get('id');
		if($id!=''){
			if(M('Product_collection')->where(array('productid'=>$id,'aid'=>$this->account['id']))->delete()){
				echo 1;
			}else{
				echo 2;
			}
		}
	}
	
	private function calCartInfo($carts=''){
		$totalCount = $totalFee = 0;
		if (!$carts) {
			$carts = $this->_getCart();
		}
		$data = $this->getCat($carts);
		if (isset($data[1])) {
			foreach ($data[1] as $pid => $row) {
				$totalCount += $row['total'];
				$totalFee += $row['totalPrice'];
			}
		}
		
		return array($totalCount, $totalFee, $data[2]);
	}
	
	private function _getCart() {
		$session = session($this->session_cart_name);
		if (!isset($session)||!strlen($session)){
			$carts = array();
		} else {
			$carts=unserialize(session($this->session_cart_name));
		}
		return $carts;
	}
	
	/**
	 * 购物车列表
	 */
	public function cart(){
		if (empty($this->wecha_id)) {
			session($this->session_cart_name,null);
		}
		$totalCount = $totalFee = 0;
		$data = $this->getCat($this->_getCart());
		if (isset($data[1])) {
			foreach ($data[1] as $pid => $row) {
				$totalCount += $row['total'];
				$totalFee += $row['totalPrice'];
			}
		}
		$list = $data[0];
		
		$this->assign('products', $list);
		$this->assign('totalFee', $totalFee);
		$this->assign('totalCount', $totalCount);
		$this->assign('metaTitle','购物车');
		$this->display();
	}
	
	
	
	/**
	 * 计算一次购物的总的价格与数量
	 * @param array $carts
	 */
	public function getCat($carts = '')
	{
		$carts = empty($carts) ? $this->_getCart() : $carts;
		//邮费
		$mailPrice = 0;
		//商品的IDS
		$pids = array_keys($carts);
		
		//商品分类IDS
		$productList = $cartIds = array();
		if (empty($pids)) {
			return array(array(), array(), array());
		}
		
		$productdata = $this->product_model->where(array('id'=> array('in', $pids),'isopen'=>1))->select();
		foreach ($productdata as $p) {
			if (!in_array($p['catid'], $cartIds)) {
				$cartIds[] = $p['catid'];
			}
			$mailPrice = max($mailPrice, $p['mailprice']);
			$productList[$p['id']] = $p;
		}
		//商品规格参数值
		$catlist = $norms = array();
		if ($cartIds) {
			$normsdata = M('norms')->where(array('catid' => array('in', $cartIds)))->select();
			foreach ($normsdata as $r) {
				$norms[$r['id']] = $r['value'];
			}
			//商品分类
			$catdata = M('Product_cat')-> where(array('id' => array('in', $cartIds)))->select();
			foreach ($catdata as $cat) {
				$catlist[$cat['id']] = $cat;
			}
		}
		$dids = array();
		foreach ($carts as $pid => $rowset) {
			if (is_array($rowset)) {
				$dids = array_merge($dids, array_keys($rowset));
			}
		}
		//商品的详细
		$totalprice = 0;
		$data = array();
		if ($dids) {
			$dids = array_unique($dids);
			$detail = M('Product_detail')->where(array('id'=> array('in', $dids)))->select();
			foreach ($detail as $row) {
				$row['colorName'] = isset($norms[$row['color']]) ? $norms[$row['color']] : '';
				$row['formatName'] = isset($norms[$row['format']]) ? $norms[$row['format']] : '';
				$row['count'] = isset($carts[$row['pid']][$row['id']]['count']) ? $carts[$row['pid']][$row['id']]['count'] : 0;
				/*if ($this->fans['distritime'] > 0&&$row['vprice'] > 0) {
					$row['price'] = $row['vprice'] ? $row['vprice'] : $row['price'];
				}*/
				$productList[$row['pid']]['detail'][] = $row;
				$data[$row['pid']]['total'] = isset($data[$row['pid']]['total']) ? intval($data[$row['pid']]['total'] + $row['count']) : $row['count'];
				$data[$row['pid']]['totalPrice'] = isset($data[$row['pid']]['totalPrice']) ? intval($data[$row['pid']]['totalPrice'] + $row['count'] * $row['price']) : $row['count'] * $row['price'];//array('total' => $totalCount, 'totalPrice' => $totalFee);
				$totalprice += $data[$row['pid']]['totalPrice'];
			}
		}
		//商品的详细列表
		$list = array();
		foreach ($productList as $pid => $row) {
			if (!isset($data[$pid]['total'])) {
				$row['count'] = $data[$pid]['total'] = isset($carts[$pid]['count']) ? $carts[$pid]['count'] : (isset($carts[$pid]) && is_int($carts[$pid]) ? $carts[$pid] : 0);
				/*if ($this->fans['distritime'] > 0&&$row['vprice'] > 0) {
					$row['price'] = $row['vprice'] ? $row['vprice'] : $row['price'];
				}*/
				$data[$pid]['totalPrice'] = $data[$pid]['total'] * $row['price'];
				$totalprice += $data[$pid]['totalPrice'];
			}
			$row['formatTitle'] =  isset($catlist[$row['catid']]['norms']) ? $catlist[$row['catid']]['norms'] : '';
			$row['colorTitle'] =  isset($catlist[$row['catid']]['color']) ? $catlist[$row['catid']]['color'] : '';
			$list[] = $row;
		}
		if ($obj = M('Product_setting')->where(array('token' => $this->token))->find()) {
			if ($totalprice >= $obj['price']) $mailPrice = 0;
		}
		return array($list, $data, $mailPrice);
	}
	
	public function deleteCart(){
		$products=array();
		$ids=array();
		$carts=$this->_getCart();
		$did = isset($_GET['did']) ? intval($_GET['did']) : 0;
		$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
		if ($did) {
			unset($carts[$id][$did]);
			if (empty($carts[$id])) {
				unset($carts[$id]);
			}
		} else {
			unset($carts[$id]);
		}
		session($this->session_cart_name,serialize($carts));
		$this->ajaxReturn('','',1);
		// $this->redirect(U('Store/cart',array('token'=>$token)));
	}
	public function ajaxUpdateCart(){
		$count = isset($_GET['count']) ? intval($_GET['count']) : 1;
		$carts = $this->_getCart();
		$id = intval($_GET['id']);
		$did = isset($_GET['did']) ? intval($_GET['did']) : 0;
		if (isset($carts[$id])) {
			if ($did) {
				$carts[$id][$did]['count'] = $count;
			} else {
				$carts[$id] = $count;
			}
		} else {
			if ($did) {
				$carts[$id][$did]['count'] = $count;
			} else {
				$carts[$id] = $count;
			}
		}
		session($this->session_cart_name,serialize($carts));
		$calCartInfo = $this->calCartInfo();
		echo $calCartInfo[0].'|'.$calCartInfo[1];
	}
	
	public function ordersave() {
		//支付需要登陆
		if(!$this->account){
			$this->error('请登陆',U('Distribution/login'));
		}
		$row = array();
		$row['orderid'] = $orderid = substr($this->wecha_id, -1, 4) . date("YmdHis");
		//赋值地址
		$address = M('Address_list')->where(array('aid'=>$this->account['id'],'choose'=>1))->find();
		if($address){
			$row['province'] = $address['province'];
			$row['city'] = $address['city'];
			$row['county'] = $address['county'];
			$row['truename'] = $address['name'];
			$row['tel'] = $address['tele'];
			$row['address'] = $address['address'];
		}else{
			$this->error('请选择地址');
		}

		$row['idNumber'] = $this->_post('idNumber');
		$row['remark'] = $this->_request('remark');
		$row['token'] = $this->token;
		$row['wecha_id'] = $this->wecha_id;
		$row['waid'] = $this->account['id'];
		$row['time'] = $time = time();
		$row['paymode'] = isset($_GET['paymode']) ? intval($_GET['paymode']) : 1;
		$discount = 1;//折扣
		$normal_rt = 0;
		$normid = $this->_get('normid');


		$carts = $this->_getCart();
		if ($carts){
			$calCartInfo = $this->calCartInfo($carts);
			foreach ($carts as $pid => $rowset) {
				$total = 0;
				if (is_array($rowset)) {
					foreach ($rowset as $did => $ro) {
						$temp = M('Product_detail')->where(array('id' => $did, 'pid' => $pid))->find();//setDec('num', $ro['count']);
						if ($temp['num'] < $ro['count']) {
							$this->error('购买的量超过了库存');
						}
						$total += $ro['count'];
					}
				} else {
					$total = $rowset;
				}
				$tmp = M('product')->where(array('id' => $pid, 'num' => array('egt', $total)))->find();
				if(!$this->judgePorductLimit($pid,$total)){
					$this->error('商品超出购买次数');
				}
				if ($tmp['num'] < $total) {
					$this->error('购买的量超过了库存');
				}
			}
			
			$setting = M('Product_setting')->where(array('token' => $this->token))->find();
			$totalprice = $calCartInfo[1]*$discount + $calCartInfo[2];
			$row['total'] = $calCartInfo[0];
			if($row['paymode'] != 1){
				$row['integral'] = $totalprice;
			}else{
				$row['price'] = $totalprice;
			}

			$row['diningtype'] = 0;
			$row['buytime'] = '';
			$row['tableid'] = 0;
			$row['info'] = serialize($carts);
			$row['groupon']=0;
			$row['dining'] = 0;
			$row['year'] = date('Y');
			$row['month'] = date('m');
			$row['day'] = date('d');
			$row['hour'] = date('H');
			//订单激活状态
			$row['active'] = 1;
			//提交对象账号
			$row['bindaid'] = $this->account['bindaid'];
			//提交人
			if($my['id']){
				$row['mid'] = $this->my['id'];
			}
			$row['aid'] = $this->account['id'];
			$product_cart_model = M('product_cart');
			$normal_rt = $product_cart_model->add($row);
			//TODO 发货的短信提醒
			if ($normal_rt) { 
				//Sms::sendSms($this->token, "您的顾客{$userInfo['name']}刚刚下了一个订单，订单号：{$orderid}，请您注意查看并处理");
			}
		}
		if ($normal_rt){
			$product_model = M('product');
			$product_cart_list_model = M('product_cart_list');
			$crow = array();
			$tdata = $this->getCat($carts);
			foreach ($carts as $k => $c){
				$crow['cartid'] = $normal_rt;
				$crow['aid'] = $this->account['id'];
				$crow['productid'] = $k;
				$crow['price'] = $tdata[1][$k]['totalPrice']*$discount;//$c['price'];
				$crow['total'] = $tdata[1][$k]['total'];
				$crow['wecha_id'] = $row['wecha_id'];
				$crow['token'] = $row['token'];
				$crow['time'] = $time;
				$product_cart_list_model->add($crow);
			}
			
			//删除库存
			//增加已售
			foreach ($carts as $pid => $rowset) {
				$total = 0;
				if (is_array($rowset)) {
					foreach ($rowset as $did => $ro) {
						M('Product_detail')->where(array('id' => $did, 'pid' => $pid))->setDec('num', $ro['count']);
						$total += $ro['count'];
					}
				} else {
					$total = $rowset;
				}
				$product_model->where(array('id' => $pid))->setDec('num', $total);
				$product_model->where(array('id' => $pid))->setInc('fakemembercount', $total);
				//增加真实销量
				$product_model->where(array('id' => $pid))->setInc('salecount', $total);
			}
			session($this->session_cart_name,null);
			$alipayConfig = M('Alipay_config')->where(array('token' => $this->token))->find();
			if ($alipayConfig['open'] && $totalprice && $row['paymode'] == 1) {
				$this->success('正在提交中...', U('Alipay/pay',array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'success' => 1, 'from'=> 'Store', 'orderName' => $orderid, 'single_orderid' => $orderid, 'price' => $totalprice)));
			} else {
				if($this->memberPay($normal_rt)){
					$this->success('支付成功', U('Distribution/index'));
				}else{
					$this->error('积分余额不足', U('Distribution/index'));
				}
			}
		} else {
			$this->error('订单生成失败');
		} 
	}
	//判断会员金币余额
	public function myGold($pay){
		$db = M('Distribution_earning');
		$gold = $db->where(array('aid'=>$this->account['id']))->sum('green');
		if($gold < $pay){
			return false;
		}else{
			return true;
		}
	}
	//会员购买判断金币
	public function orderCartJudge(){
		$money = $this->_get('money');
		if($this->myGold($money)){
			$this->ajaxReturn('','',1);
		}else{
			$this->ajaxReturn('','金币不足',2);
		}
	}
	//会员金币支付订单
	public function memberPay($order_id){
		$cart = M('Product_cart')->where(array('id'=>$order_id))->find();
		log::write('order_id='.$order_id,'DEBUG');
		if($this->myGold($cart['integral'])){
			$type = $cart['lid'] == 0 ? 5:6;
			$this->earnRecord($this->account['id'],$cart['id'],$this->my['id'],-$cart['integral'],0,$cart['integral'],7);
			M('Product_cart')->where(array('id'=>$order_id))->save(array('buytime'=>time(),'paid'=>1));

			//发送支付信息
			$title="支付成功";
			$content = $this->sentMessageFormat($cart['id']);
			$url = U('Wap/Store/myOrders');
			$this->sendupMessage($cart['bindaid'],$title,$content,$url);
			return true;
		}else{
			return false;
		}
	}
	
	//我的订单立即支付
	public function payNow(){
		$order_id = $this->_get('id');
		$order = M('Product_cart')->where(array('id'=>$order_id))->find();

		$info = unserialize($order['info']);
		//判断商品是否下架
		foreach ($info as $k => $v) {
			$product = M('Product')->field('isopen,name')->where('id='.$k)->find();
			if($product['isopen'] == 0){
				$this->error($product['name'].'已经下架');
			}
		}
		$check = $this->limitShoppingInfo($info);
		if($check['status'] == 2){
			$this->error('商品超出购买次数');
		}
		if($order && $order['paid'] ==0){
			$orderid = substr($this->wecha_id, -1, 4) . date("YmdHis");
			M('Product_cart')->where(array('id'=>$order_id))->setField('orderid',$orderid);
			log::write('order_id1='.$order_id,'DEBUG');
			if($order['integral']){
				if($this->memberPay($order_id)){
					$this->success('支付成功');
				}else{
					$this->error('支付失败');
				}
			}else{
				$this->success('正在提交中...', U('Alipay/pay',array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'success' => 1, 'from'=> 'Store', 'orderName' => $orderid, 'single_orderid' => $orderid, 'price' => $totalprice)));
			}
		}else{
			$this->error('支付失败');
		}
	}
	
	public function orderCart() {
		if (empty($this->wecha_id)) {
			session($this->session_cart_name,null);
		}

		$totalCount = $totalFee = 0;
		$data = $this->getCat($this->_getCart());
		if (empty($data[0])) {
			$this->redirect(U('Store/cart', array('token' => $this->token)));
		}
		if (isset($data[1])) {
			foreach ($data[1] as $pid => $row) {
				$totalCount += $row['total'];
				$totalFee += $row['totalPrice'];
			}
		}
		if (empty($totalCount)) {
			$this->error('没有购买商品!', U('Store/cart', array('token' => $this->token)));
		}
		$list = $data[0];
		//判断积分
		$green = $this->statistical('green',$this->account['id']);
		$this->assign('green', $green);

		$this->assign('products', $list);
		$this->assign('totalFee', $totalFee);
		$this->assign('totalCount', $totalCount);
		$this->assign('mailprice', $data[2]);
		$this->assign('metaTitle', '购物车结算');
		$this->display();
	}
	
	public function my(){
		$offset = 5;
		$page = isset($_GET['page']) ? max(intval($_GET['page']), 1) : 1;
		$start = ($page - 1) * $offset;
		$product_cart_model = M('product_cart');
		$status = $this->_get('status');
		$where = array('token'=>$this->token,'wecha_id'=>$this->wecha_id, 'groupon' => 0, 'dining' => 0);
		if($status==0&&$status!=NULL){
			$where['paid'] = 0;
		}elseif($status==1){
			$where['paid'] = 1;
			$where['sent'] = 0;
		}elseif($status==2){
			$where['sent'] = 1;
			$where['receive'] = 0;
		}elseif($status==3){
			$where['receive'] = 1;
		}elseif($status==4){
			$where['returnMoney'] = 1;
		}
		$orders = $product_cart_model->where($where)->limit($start, $offset)->order('time DESC')->select();
		$count = $product_cart_model->where($where)->count();
		$list = array();
		if ($orders){
			foreach ($orders as $o){
				$products = unserialize($o['info']);
				$pids = array_keys($products);
				$o['productInfo'] = array();
				if ($pids) {
					$o['productInfo'] = M('product')->where(array('id' => array('in', $pids)))->select();
				}
				$list[] = $o;
			}
		}
		$totalpage = ceil($count / $offset);
		$this->assign('orders', $list);
		$this->assign('ordersCount', $count);
		$this->assign('totalpage', $totalpage);
		$this->assign('page', $page);
		$this->assign('metaTitle', '我的订单');
		
		//是否要支付
		$alipayConfig = M('Alipay_config')->where(array('token' => $this->token))->find();
		$this->assign('alipayConfig',$alipayConfig);
		$this->display();
	}
	
	public function myDetail(){
		$cartid = isset($_GET['cartid']) && intval($_GET['cartid'])? intval($_GET['cartid']) : 0;
		$product_cart_model = M('product_cart');

		$list = array();
		if ($cartObj = $product_cart_model->where(array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'id' => $cartid))->find()){
			$products = unserialize($cartObj['info']);
			$data = $this->getCat($products);
			$pids = array_keys($products);
			$cartObj['productInfo'] = array();
			if ($pids) {
				$cartObj['productInfo'] = M('product')->where(array('id' => array('in', $pids)))->select();
			}
			
			$totalCount = $totalFee = 0;
			if (isset($data[1])) {
				foreach ($data[1] as $pid => $row) {
					$totalCount += $row['total'];
					$totalFee += $row['totalPrice'];
				}
			}
			$list = $data[0];
			$commentList = array();
			//if ($cartObj['paid']) {
				$comment = M("Product_comment")->where(array('token' => $this->token, 'cartid' => $cartid, 'wecha_id' => $this->wecha_id))->select();
				foreach ($comment as $row) {
					$commentList[$row['pid']][$row['detailid']] = $row;
				}
			//}
			$alipayConfig = M('Alipay_config')->where(array('token' => $this->token))->find();
			foreach ($list as &$row) {
				if ($row['detail']) {
					foreach ($row['detail'] as &$r) {
						if (isset($commentList[$row['id']][$r['id']])) {
							$r['comment'] = 0;
						} else {
							$r['comment'] = $alipayConfig['open'] ? ($cartObj['paid'] ? 1 : 0) : 1;
						}
					}
				} else {
					if (isset($commentList[$row['id']][0])) {
						$r['comment'] = 0;
					} else {
						$r['comment'] = $cartObj['paid'] ? 1 : 0;
					}
				}
			}
			//echo "<pre/>";
			//print_r($list);die;
			//所属区域
			if($cartObj['classid']){
				import ( "@.Org.TypeFile" );
				$tid = $cartObj['classid'];
				$TypeFile = new TypeFile ( 'ClassCity' ); //实例化分类类
				$result = $TypeFile->getPathName ( $tid ); //获取分类路径
				$this->assign ( 'typeNumArr', $result );
			}
			$this->assign('commentList', $commentList);
			$this->assign('products', $list);
			$this->assign('totalFee', $totalFee);
			$this->assign('totalCount', $totalCount);
			$this->assign('mailprice', $data[2]);
			$this->assign('cartData', $cartObj);
			$this->assign('cartid', $cartid);
		}
		$this->assign('metaTitle', '我的订单');
		$this->display();
	}
	
	public function cancelCart(){
		$cartid = isset($_GET['cartid']) && intval($_GET['cartid'])? intval($_GET['cartid']) : 0;
		$product_model=M('product');
		$product_cart_model = M('product_cart');
		$product_cart_list_model = M('product_cart_list');
		$thisOrder = $product_cart_model->where(array('id'=> $cartid))->find();
		if (empty($thisOrder)) {
			exit(json_encode(array('error_code' => true, 'msg' => '没有此订单')));
		}
		$id = $thisOrder['id'];
		if (empty($thisOrder['paid'])) {
			//删除订单和订单列表
			$product_cart_model->where(array('id' => $cartid))->delete();
			$product_cart_list_model->where(array('cartid' => $cartid))->delete();
			//还原积分
			$userinfo_model = M('Distribution_member');
			$thisUser = $userinfo_model->where(array('token'=>$this->token,'wecha_id'=>$this->wecha_id))->find();
			$userinfo_model->where(array('id' => $thisUser['id']))->setInc('total_score', $thisOrder['score']);
			F('fans_token_wechaid', NULL);
			//商品销量做相应的减少
			$carts = unserialize($thisOrder['info']);
			//还原库存
			foreach ($carts as $pid => $rowset) {
				$total = 0;
				if (is_array($rowset)) {
					foreach ($rowset as $did => $row) {
						M('product_detail')->where(array('id' => $did, 'pid' => $pid))->setInc('num', $row['count']);
						$total += $row['count'];
					}
				} else {
					$total = $rowset;
				}
				$product_model->where(array('id' => $pid))->setInc('num', $total);
				$product_model->where(array('id' => $pid))->setDec('salecount', $total);
			}
			exit(json_encode(array('error_code' => false, 'msg' => '订单取消成功')));
		}
		exit(json_encode(array('error_code' => true, 'msg' => '购买成功的订单不能取消')));
	}
	public function returnCart(){
		$cartid = isset($_GET['cartid']) && intval($_GET['cartid'])? intval($_GET['cartid']) : 0;
		$product_model=M('product');
		$product_cart_model = M('product_cart');
		$product_cart_list_model = M('product_cart_list');
		$thisOrder = $product_cart_model->where(array('id'=> $cartid))->find();
		if (empty($thisOrder)) {
			exit(json_encode(array('error_code' => true, 'msg' => '没有此订单')));
		}
		$id = $thisOrder['id'];
		if ($thisOrder['paid']==1) {
			if ($thisOrder['sent']==0) {
				$data['returnMoney'] = 1;
				$data['returnReason'] = $this->_post('reason');
				if(M('product_cart')->where('id='.$cartid)->save($data)){
					exit(json_encode(array('error_code' => false, 'msg' => '申请退款成功,等待商家处理')));
				}
			}else{
				exit(json_encode(array('error_code' => true, 'msg' => '已发货订单不能申请退款')));
			}
		}else{
			exit(json_encode(array('error_code' => true, 'msg' => '未付款的订单不能申请退款')));
		}
	}
	public function delCart(){
		$cartid = isset($_GET['cartid']) && intval($_GET['cartid'])? intval($_GET['cartid']) : 0;
		$product_model=M('product');
		$product_cart_model = M('product_cart');
		$product_cart_list_model = M('product_cart_list');
		$thisOrder = $product_cart_model->where(array('id'=> $cartid))->find();
		if (empty($thisOrder)) {
			exit(json_encode(array('error_code' => true, 'msg' => '没有此订单')));
		}
		$id = $thisOrder['id'];
		if ($thisOrder['paid']==0) {
			if(M('product_cart')->where('id='.$cartid)->delete()){
				exit(json_encode(array('error_code' => false, 'msg' => '订单删除成功')));
			}
		}else{
			exit(json_encode(array('error_code' => true, 'msg' => '未付款的订单才能删除')));
		}
	}
	/*
	* 确认收货
	*
	*/
	public function getProduct(){
		$id = $this->_post('productid');
		$token = $this->_get('token');
		$wecha_id = $this->wecha_id;
		$product_cart_model = M('product_cart');
		if($product_cart_model->where(array('id'=>$id,'receive'=>0))->find()){
			$data['receive'] = 1;
			if($product_cart_model->where(array('id'=>$id,'receive'=>0))->save($data)){
				//订单处理
				/*$userInfo = M('Distribution_member')->where(array('wecha_id' => $this->wecha_id, 'token' => $this->token))->find();
				if($userInfo['distritime']==0){
					$datas['distritime'] = time();
					if(M('Distribution_member')->where(array('wecha_id' => $this->wecha_id, 'token' => $this->token))->save($datas)){
						$dataDistri['beDistri'] = 1;
						$product_cart_model->where(array('id'=>$id))->save($dataDistri);
						//消息通知
						$access_token = $this->get_access_token();
						$data1 = '{"touser":"'.$wecha_id.'","msgtype":"text","text":{"content":"亲：恭喜您已成为梦美春财富股东！立即行动！百万财富 轻松搞定！"}}';
						$result = $this->api_notice_increment('https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$access_token,$data1);
					}
				}*/
				$this->distriOrderStatus($this->token,$id,3);//已收货状态
				/*M('Distribution_member')->where(array('token' => $this->token, 'wecha_id' => $this->wecha_id))->setInc('orderNums');//订单累加*/
				exit(json_encode(array('error_code' => false, 'msg' => '确认收货成功')));
			}else{
				exit(json_encode(array('error_code' => true, 'msg' => '确认收货失败')));
			}
		}else{
			exit(json_encode(array('error_code' => true, 'msg' => '异常操作，确认收货失败')));
		}
	}
	private function get_user_info($wecha_id){
		$access_str = $this->get_access_token();
		$info = $this->curlGet('https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_str.'&openid='.$wecha_id.'&lang=zh_CN');
		Log::write('user_info='.$info,'DEBUG');
		$infoarr = json_decode($info, 1);
		return $infoarr;
	}
	public function autoHandle(){
		Log::write('autoHandle','DEBUG');
		$this->handleOrder();
	}
	private function handleOrder(){
		$product_cart_model = M('product_cart');
		//未付款订单超过一小时删除
		/*$condition['token'] = $this->token;
		$condition['paid'] = 0;
		$condition['time'] = array('lt',time()-3600);
		$product_cart_model->where($condition)->delete();*/
		//未确认订单7天后自动确认
		$data['receive'] = 1;
		$condition1['token'] = $this->token;
		$condition1['paid'] = 1;
		$condition1['sent'] = 1;
		$condition1['time'] = array('lt',time()-3600*24*7);
		$condition1['receive'] = 0;
		$order = $product_cart_model->where($condition1)->select();
		foreach($order as $key=>$value){
			if($product_cart_model->where(array('id'=>$value['id']))->save($data)){
				//订单处理
				$this->distriOrderStatus($order['token'],$value['id'],3);//已收货状态
			}
		}
	}
	public function updateOrder(){
		$product_cart_model = M('product_cart');
		$thisOrder = $product_cart_model->where(array('id'=>intval($_GET['id'])))->find();
		//检查权限
		if ($thisOrder['wecha_id']!=$this->wecha_id){
			exit();
		}
		$this->assign('thisOrder',$thisOrder);
		$carts = unserialize($thisOrder['info']);
		$totalCount = $totalFee = 0;
		$listNum = array();
		$data = $this->getCat($carts);
		if (isset($data[1])) {
			foreach ($data[1] as $pid => $row) {
				$totalCount += $row['total'];
				$totalFee += $row['totalPrice'];
				$listNum[$pid] = $row['total'];
			}
		}
		$list = $data[0];
		$this->assign('products', $list);
		$this->assign('totalFee', $totalFee);
		$this->assign('listNum', $listNum);
		$this->assign('metaTitle','修改订单');
		//是否要支付
		$alipayConfig = M('Alipay_config')->where(array('token' => $this->token))->find();
		$this->assign('alipayConfig', $alipayConfig);
		$this->display();
	}
	
	/**
	 * 评论
	 */
	public function comment()
	{
		$cartid = isset($_GET['cartid']) && intval($_GET['cartid'])? intval($_GET['cartid']) : 0;
		$pid = isset($_GET['pid']) ? intval($_GET['pid']) : 0;
		$detailid = isset($_GET['detailid']) ? intval($_GET['detailid']) : 0;
		$alipayConfig = M('Alipay_config')->where(array('token' => $this->token))->find();
		if ($cartObj = M("product_cart")->where(array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'id' => $cartid))->find()){
			if ($cartObj['paid'] == 0 && $alipayConfig['open']) {
				$this->error("您暂时还不能评论该商品");
			}
		} else {
			$this->error("您还没有购买此商品，暂时无法对其评论");
		}
		
		$this->assign('cartid', $cartid);
		$this->assign('detailid', $detailid);
		$this->assign('pid', $pid);
		$this->display();
	}
	
	public function commentSave()
	{
		$cartid = isset($_POST['cartid']) && intval($_POST['cartid'])? intval($_POST['cartid']) : 0;
		$pid = isset($_POST['pid']) ? intval($_POST['pid']) : 0;
		$detailid = isset($_POST['detailid']) ? intval($_POST['detailid']) : 0;
		$alipayConfig = M('Alipay_config')->where(array('token' => $this->token))->find();
		if ($cartObj = M("product_cart")->where(array('token' => $this->token, 'wecha_id' => $this->wecha_id, 'id' => $cartid))->find()){
			if ($cartObj['paid'] == 0 && $alipayConfig['open']) {
				$this->error("您暂时还不能评论该商品");
			}
			$data = array();
			if ($product = M("Product")->where(array('id' => $pid, 'token' => $this->token))->find()) {
				if ($detailid) {
					$products = unserialize($cartObj['info']);
					$result = $this->getCat($products);
					foreach ($result[0] as $row) {
						foreach ($row['detail'] as $d) {
							if ($d['id'] == $detailid) {
								$str = $row['colorTitle'] && $d['colorName'] ? $row['colorTitle'] . ":" . $d['colorName'] : '';
								$str .= $row['formatTitle'] && $d['formatName'] ? ", " . $row['formatTitle'] . ":" . $d['formatName'] : '';
								$data['productinfo'] = $str;
							}
						}
					}
				}
			} else {
				$this->error("此产品可能下架了，暂时无法对其评论");
			}
		} else {
			$this->error("您还没有购买此商品，暂时无法对其评论");
		}
		
		$comment = D("Product_comment");
		$data['cartid'] = $cartid;
		$data['pid'] = $pid;
		$data['detailid'] = $detailid;
		$data['score'] = $_POST['score'];
		$data['content'] = htmlspecialchars($_POST['content']);
		$data['token'] = $this->token;
		$data['wecha_id'] = $this->wecha_id;
		$data['truename'] = $cartObj['truename'];
		$data['tel'] = $cartObj['tel'];
		$data['__hash__'] = $_POST['__hash__'];
		$data['dateline'] = time();
		if (false !== $comment->create($data)) {
			unset($data['__hash__']);
			$comment->add($data);
			$this->success("评论成功", U('Store/myDetail',array('token' => $this->token,'cartid' => $cartid)));
		} else {
			$this->error($comment->error, U('Store/myDetail',array('token' => $this->token,'cartid' => $cartid)));
		}
	}
	public function deleteOrder(){
		$product_model=M('product');
		$product_cart_model=M('product_cart');
		$product_cart_list_model=M('product_cart_list');
		$thisOrder=$product_cart_model->where(array('id'=>intval($_GET['id'])))->find();
		//检查权限
		$id=$thisOrder['id'];
		if ($thisOrder['wecha_id']!=$this->wecha_id||$thisOrder['handled']==1){
			exit();
		}
		//删除订单和订单列表
		$product_cart_model->where(array('id'=>$id))->delete();
		$product_cart_list_model->where(array('cartid'=>$id))->delete();
		//商品销量做相应的减少
		$carts=unserialize($thisOrder['info']);
		foreach ($carts as $k=>$c){
			if (is_array($c)){
				$productid=$k;
				$price=$c['price'];
				$count=$c['count'];
				$product_model->where(array('id'=>$k))->setDec('salecount',$c['count']);
			}
		}
		$this->redirect(U('Store/my',array('token'=>$token)));
	}
	
	/**
	 * 支付成功后的回调函数
	 */
	public function payReturn() {
	   $orderid = $_GET['orderid'];
	   if ($order = M('Product_cart')->where(array('orderid' => $orderid, 'token' => $this->token))->find()) {
			//TODO 发货的短信提醒
			if ($order['paid']) {
				/*$data['distritime'] = time();
				M('Distribution_member')->where(array('wecha_id' => $this->wecha_id, 'token' => $this->token))->save($data);
				$userInfo = M('Distribution_member')->where(array('token' => $this->token, 'wecha_id' => $this->wecha_id))->find();
				$this->distriOrderStatus($this->token,$order['id'],1);
				M('Distribution_member')->where(array('token' => $this->token, 'wecha_id' => $this->wecha_id))->setInc('orderNums');//订单累加*/
				//Sms::sendSms($this->token, "您的顾客{$userInfo['name']}刚刚对订单号：{$orderid}的订单进行了支付，请您注意查看并处理");
			}
			$this->redirect(U('Store/my',array('token' => $this->token)));
	   }else{
	      exit('订单不存在');
	    }
	}
	/**
	 * distriOrder
	 */
	private function distriOrder($token,$order_id,$mid) {
		$member = M('Distribution_member')->where('id='.$mid)->find();
		//$order = M('Product_cart')->where('id='.$order_id)->field('price')->find();
		Log::write('order_id='.$order_id,'DEBUG');
		$list = M('Product_cart_list')->where('cartid='.$order_id)->select();
		$price = 0;
		$orderprice = 0;
		foreach($list as $key=>$value){
			$product = M('Product')->where('id='.$value['productid'])->field('offerprice,price')->find();
			$orderprice += $value['price'];
			$price += $product['price']*$value['total']*$product['offerprice']/100;
			//$price += $value['price']*$product['offerprice']/100;
		}
		$order['price'] = $price;
		
		$set = M('Distribution_set')->where(array('token'=>$token))->find();
		$data['from_mid'] = $mid;
		$data['token'] = $token;
		$data['order_id'] = $order_id;
		$data['orderMoney'] = $orderprice*100;
		$data['addtime'] = time();
		$data['status'] = 0;
		$data['year'] = date('Y');
		$data['month'] = date('m');
		$data['day'] = date('d');
		$data['hour'] = date('H');
		$db = M('Distribution_ordermoney');
		if($member['fid']!=0){//一级
			$data['mid'] = $member['fid'];
			$data['offerMoney'] = $order['price']*$set['firstPer'];
			$data['type'] = 'fid';
			$db->add($data);
		}
		if($member['sid']!=0){//二级
			$data['mid'] = $member['sid'];
			$data['offerMoney'] = $order['price']*$set['secondPer'];
			$data['type'] = 'sid';
			$db->add($data);
		}
		if($member['tid']!=0){//三级
			$data['mid'] = $member['tid'];
			$data['offerMoney'] = $order['price']*$set['thirdPer'];
			$data['type'] = 'tid';
			$db->add($data);
		}
	}
	/**
	 * distriOrderStatus
	 */
	private function distriOrderStatus($token,$order_id,$status) {
		$condition['order_id'] = $order_id;
		$condition['token'] = $token;
		$data['status'] = $status;
		$db = M('Distribution_ordermoney');
		$db->where($condition)->save($data);
	}
}

?>