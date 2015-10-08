<?php
	//设置网页编码格式为utf-8
	header("Content-type:text/html; charset=utf-8");
	//设置当前时区
	date_default_timezone_set('Asia/Shanghai');
	//引入文件config.php、pc.php
	require_once('config.php');
	require_once('framework/pc.php');
	//执行PC文件内的run函数，参数为$config变量内的值
	PC::run($config);
?>