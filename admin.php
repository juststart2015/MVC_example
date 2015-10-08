<?php
	//编码设置
	header("Content-type:text/html; charset = utf-8");
	//开启session
	session_start();
	//引入配置文件
	require_once('config.php');
	//引入微框架
	require_once('framework/pc.php');
	//运行微框架
	PC::run($config);
?>