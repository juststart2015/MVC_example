﻿<?php
	class indexController{
	
		private function showabout(){
			$data = M('about') -> aboutinfo();
			VIEW::assign(array('about' => $data));
		}
		
		function index(){
			$newsobj = M('news');
			$data = $newsobj -> get_news_list();
			$this -> showabout();
			//以下两语句，调用并注册显示模版
			VIEW::assign(array('data' => $data));
			VIEW::display('index/index.html');
		}
	
		function newsshow(){
			$data = M('news') -> getnewsinfo(intval($_GET['id']));
			$this -> showabout();
			VIEW::assign(array('data' => $data));
			VIEW::display('index/show.html');
		}
		

	}
?>