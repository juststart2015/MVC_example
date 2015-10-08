<?php
	class authModel{
		private $auth = '';//当前登录管理员的信息
		
		public function __construct(){
			//判断$_SESSION['auth']是否存在且是否为空
			if(isset($_SESSION['auth'])&&(!empty($_SESSION['auth']))){
				//若存在，则对auth进行赋值
				$this -> auth = $_SESSION['auth'];
			}
		}
		
		public function loginsubmit(){//进行登录验证的一系列业务逻辑
			//判断用户名和密码是否为空
			if(empty($_POST['username'])||empty($_POST['password'])){
				return false;
			}
			//定义变量并根据获取的值进行赋值，用addslashes函数过滤
			$username = addslashes($_POST['username']);
			$password = addslashes($_POST['password']);
			//用户的验证操作，如果通过，则保存到auth里，
			if($this -> auth = $this -> checkuser($username, $password)){
				$_SESSION['auth'] = $this -> auth;
				return true;
			}else{
				return false;
			}
		}
		
		//用于在外部获取return出来的auth的值，
		public function getauth(){
			return $this -> auth;
		}
		
		public function logout(){
			//清除$_SESSION['auth']里的信息
			unset($_SESSION['auth']);
			$this -> showmessage('退出成功！', 'admin.php?controller=admin&method=login');
		}
		
		//通过用户名和密码检验登录用户
		private function checkuser($username, $password){
			//用大M函数调用admin模型，并实例化
			$adminobj = M('admin');
			//通过用户名获取用户信息
			$auth = $adminobj -> findOne_by_username($username);
			//判断用户信息($auth)信息是否为空，并验证用户密码与输入密码是否吻合
			if((!empty($auth))&&$auth['password'] == $password){
				return $auth;
			}else{
				return false;
			}
		}
		
		private function showmessage($info, $url){
			echo "<script>alert('$info');window.location.href='$url'</script>";
			exit;
		}
	}
?>