<?php
	class adminController{
		
		public $auth='';
		
		public function __construct(){
			//判断当前是否已经登录 -> auth模型去处理
			//如果不是登录页，且没有登录，就要跳转到登录页
			$authobj = M('auth');
			//通过getauth方法，获取auth的值
			$this -> auth = $authobj -> getauth();
			//判断auth的值是否为空
			if(empty($this -> auth)&&(PC::$method != 'login')){
				$this -> showmessage('请登录后再操作','admin.php?controller=admin&method=login');
			}
		}
		
		//
		public function index(){
			//用大M函数实例化，并保存在$newsobj中
			$newsobj = M('news');
			//用count方法获取新闻总数，并保存在$newsnum中
			$newsnum = $newsobj->count();
			//用assign方法，把$newsnum变量注册到模版中去
			VIEW::assign(array('newsnum'=>$newsnum));
			//用display方法引入模版
			VIEW::display('admin/index.html');
		}
		
		public function login(){
			//显示登录界面
			if($_POST){
				//进行登录处理，登录处理业务逻辑放在admin auth
				//admin模型：从数据库里取用户信息，auth模型：进行用户信息的核对
				//把一系列登录处理操作拆分到新的方法里去
				$this -> checklogin();
			}else{
				VIEW::display('admin/login.html');
			}
		}
		
		public function logout(){
			$authobj = M('auth');
			$authobj -> logout();
			$this -> showmessage('退出成功！','admin.php?controller=admin&method=login');
		}

		public function newsadd(){
			//判断是否有post数据
			if(empty($_POST)){//若没有POST数据，就显示添加、修改的界面
				//读取旧信息，需要传递新闻id $_GET['id']，也就是如果有$_GET['id']说明是修改
				if(isset($_GET['id'])){
					$data = M('news') -> getnewsinfo($_GET['id']);
				}else{
					$data = array();
				}
				//$data = $this->getnewsinfo();
				//将$data注册进模版中
				VIEW::assign(array('data'=>$data));
				VIEW::display('admin/newsadd.html');
			}else{//否则进入添加、修改的处理程序
				$this -> newssubmit();
			}
		}
		
		private function newssubmit(){
			$newsobj = M('news');
			$result = $newsobj -> newssubmit($_POST);
			if($result == 0){
				$this->showmessage('操作失败！', 'admin.php?controller=admin&method=newsadd&id='.$_POST['id']);
			}
			if($result == 1){
				$this->showmessage('添加成功！', 'admin.php?controller=admin&method=newslist');
			}
			if($result == 2){
				$this -> showmessage('修改成功！ ','admin.php?controller=admin&method=newslist');
			}
		}

		public function newslist(){
			//实例化news模型
			$newsobj = M('news');
			//通过findAll_orderby_dateline()取出所有新闻保存给$data
			$data = $newsobj -> findAll_orderby_dateline();
			//把$data注册进模型中
			VIEW::assign(array('data'=>$data));
			VIEW::display('admin/newslist.html');
		}

		public function newsdel(){
			//判断是否得到文章id
			if(intval($_GET['id'])){
				$newsobj = M('news');
				$newsobj -> del_by_id(intval($_GET['id']));
				$this->showmessage('删除新闻成功！', 'admin.php?controller=admin&method=newslist');
			}
		}
		
		public function checklogin(){
			//通过大M函数实例化auth对象，并保存到$authobj中
			$authobj = M('auth');
			//直接使用loginsubmit方法
			if($authobj -> loginsubmit()){
				$this -> showmessage('登录成功！','admin.php?controller=admin&method=index');
			}else{
				$this -> showmessage('登录失败！','admin.php?controller=admin&method=login');
			}
		}
		
		private function getnewsinfo(){
			if(isset($_GET['id'])){
				$id = intval($_GET['id']);
				$newsobj = M('news');
				return $newsobj->findOne_by_id($id);
			}else{
				return array();
			}
		}

		private function getnewslist(){
			$newsobj = M('news');
			return $newsobj->findAll_orderby_dateline();
		}

		private function delnews(){
			$newsobj = M('news');
			return $newsobj->del_by_id($_GET['id']);
		}

		private function showmessage($info, $url){
			echo "<script>alert('$info');window.location.href='$url'</script>";
			exit;
		}
	}
?>