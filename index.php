<?php
	header("Content-type:text/html; charset=utf-8");
	//设置当前时区
	date_default_timezone_set('Asia/Shanghai');
	require_once('config.php');
	require_once('framework/pc.php');
	PC::run($config);
?>