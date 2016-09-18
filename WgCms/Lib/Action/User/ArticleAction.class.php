<?php 
	class ArticleAction extends UserAction{
		//文章列表
		public function selfStudy(){
			$db = M('img');

			if($this->_post('name')!=''){
				$where['title'] = array('like','%'.$this->_post('name').'%');
			}
			$count=$db->where($where)->count();
			$page=new Page($count,25);
			$list = $db->where($where)->limit($page->firstRow.','.$page->listRows)->order('id desc')->select();


			$this->assign('page',$page->show());
			$this->assign('list',$list);
			$this->display();
		}
		/*文章增删改*/
		public function add(){
			if(IS_POST){
				$_POST['createtime']=time();
				$this->insert("article_list","/selfStudy");
			}else{
				$this->assign('info',$classid);
				$this->display("add");
			}
		}
		public function del(){
			$id=$this->_get("id");
			$db = M('article_list');
			if ($db->where("id=".$id)->delete()) {
			    $this->success('操作成功', U("Article/selfStudy",array("token"=>$this->token)));
			} else {
			    $this->error('操作失败', U("Article/selfStudy",array("token"=>$this->token)));
			}
		}
		public function set(){
			$db = M('article_list');
			if(IS_POST){
				$this->save("article_list","/selfStudy");
			}else{
				$id=$this->_get("id");
				$info=$db->where("id=".$id)->find();
				$this->assign('info',$classid);

				$this->assign("set",$info);
				$this->display("set");
			}
		}
		/*文章增删改*/

		//文章分类列表
		public function classify(){
			$db=D('article_class');
			$where['token']=session('token');
			$count=$db->where($where)->count();
			$page=new Page($count,25);
			$info=$db->where($where)->order('sorts desc')->limit($page->firstRow.','.$page->listRows)->select();
			$this->assign('page',$page->show());
			$this->assign('info',$info);
			$this->display();
		}
		/*文章分类增删改*/
		public function classifyEdit(){
			$db=D('article_class');
			if(IS_POST){
				$id = $_POST['id'];
				$_POST['token'] = session('token');
				if($id){//编辑
					$this->save("article_class","/classify");
				}else{//添加
					$this->insert("article_class","/classify");
				}
			}else{
				$id = $this->_get('id');
				if($id){
					$info = $db->where('id='.$id)->find();
					$this->assign('info',$info);
				}
				$this->display();
			}
		}
		public function classify_del(){
			$id=$this->_get("id");
			//判断分类戏还有没文章
			if(M('article_list')->where(array('classid'=>$id))->find()){
				$this->error('该分类下还有文章', U("Article/classify",array("token"=>$this->token)));
			}
			$db = M('article_class');
			if ($db->where("id=".$id)->delete()) {
			    $this->success('操作成功', U("Article/classify",array("token"=>$this->token)));
			} else {
				echo $db->getLastsql();
				exit();
			    $this->error('操作失败', U("Article/classify",array("token"=>$this->token)));
			}
		}
		/*文章分类增删改*/
	}
?>