<?php
	//定义当前框架的目录地址，获取PC所在的目录地址
	$currentdir = dirname(__FILE__);
	//引入include.list.php文件
	include_once($currentdir.'/include.list.php');
	//循环数组，把数组里的几个地址都循环一遍，也即是引入一遍
	//paths为include.class.php里的一个变量，里面包含了各个文件的路径，因为之前已经引入该文件，所以等于该文件现在在本(pc.php)里面，所以可以直接使用$paths变量，
	//foreach遍历$paths变量内的数组，每次遍历都把值赋值给$path，且数组内的指针向前移一步，
	foreach($paths as $path){
		//引入include.class.php里的所有包含的文件，以便后面直接调用
		include_once($currentdir.'/'.$path);
	}
	//创建一个PC类(这个PC类，就是自己的框架，包含数据库连接、视图引擎、控制器引擎、方法引擎)，
	class PC{
		//定义一些静态属性，以便直接调用该变量
		public static $controller;
		public static $method;
		private static $config;
		//初始化DB引擎
		private static function init_db(){
			//DB::init指引用DB.class.php里的DB类的init()方法
			//mysql为要操作的数据库的名称,self::$config指调用自身的类(PC)内的$config变量，参数为config.php内的$config变量内的dbconfig数组内的值，数据库要用到的配置
			DB::init('mysql',self::$config['dbconfig']);
		}
		//初始化视图引擎
		private static function init_view(){
			//Smarty为视图引擎的名称，后面为要用的配置
			//调用VIEW.class.php文件内的VIEW类下的init()方法，
			VIEW::init('Smarty',self::$config['viewconfig']);
		}
		//以下两个静态函数，配置了默认控制器及默认方法名
		private static function init_controllor(){
			//初始化控制器，并给予一个默认值
			//self::$controller调用自身类(PC)的$controller变量内的值，$_GET['controller']用于接收传入值，若没有，则用默认值index,isset用于判定是否有值，而其中的函数daddslashes()为function.php内预定义好的函数，用去过滤特殊字符
			self::$controller = isset($_GET['controller'])?daddslashes($_GET['controller']):'index';
		}
		private static function init_method(){
			//初始化方法，并给予一个默认值
			self::$method = isset($_GET['method'])?daddslashes($_GET['method']):'index';
		}
		
		//通过run方法，来执行以上方法
		public static function run($config){
			//self::调用类本身，如第一个为调用自身类(PC)的$config静态变量，并给其赋值config.php文件里的$config变量内的值（config.php已经在index.php内被引入了，所以可以直接调用）
			self::$config = $config;
			//调用类本身的init_db()、init_view()、init_controller()、init_method()方法，
			self::init_db();
			self::init_view();
			self::init_controllor();
			self::init_method();
			//通过大C函数（function.php里定义好的函数），完成对控制器的实例化，以及使用控制器中的某个方法，通过控制器调用模型，调用视图，完成数据的输出
			//这里大C函数的意思，C(配置1,配置2)，调用自身PC类里的$controller变量指定的控制器及$method变量指定的方法
			C(self::$controller, self::$method);
		}
	}
?>﻿