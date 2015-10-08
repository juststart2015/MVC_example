<?php
	$config = array(
		//存放视图配置，定义了smarty的左右边界符分别为{、},模版目录为tpl,模版文件为template_c
		'viewconfig' => array(
			'left_delimiter' => '{', 'right_delimiter' => '}', 'template_dir' => 'tpl', 'compile_dir' => 'data/template_c'),
		//存放数据库配置，数据库地址localhost,用户名user，密码sa，数据库名newsreport，数据库编码格式utf8
		'dbconfig' => array(
			'dbhost' => 'localhost', 'dbuser' => 'root', 'dbpsw' => 'sa', 'dbname' => 'newsreport', 'dbcharset' => 'utf8')
	);
?>