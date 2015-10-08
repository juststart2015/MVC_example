<?php
	//创建DB类，在PHP里里面是一个全局变量
	class DB{
		//预定义一个静态变量$db,以便调用
		public static $db;
		
		//$dbtype,接收数据库类型数据，$config为接收的配置
		public static function init($dbtype, $config){
			//把获取到的$dbtype赋值给自身类(DB)的$db变量内
			//new $dbtype;实例化数据库类型，并保存在$db内
			self::$db = new $dbtype;
			//调用自身类的$db变量，并执行connect()方法，参数为$config内的参数
			//使用、执行$db的connect()方法
			self::$db -> connect($config);
		}
		
		//创建执行sql语句方法，语句为$sql变量内的值
		public static function query($sql){
			//使用、执行$db的query()方法，并返回返回结果
			return self::$db -> query($sql);
		}
		
		//查询所有的语句
		public static function findAll($sql){
			//把执行的查询结果保存在自身类内的$db变量内，并赋值给$query变量
			$query = self::$db -> query($sql);
			//执行$db里的findAll()方法，并返回结果
			return self::$db -> findAll($query);
		}
		
		public static function findOne($sql){
			$query = self::$db -> query($sql);
			return self::$db -> findOne($query);
		}
		
		public static function findResult($sql, $row = 0, $filed = 0){
			$query = self::$db -> query($sql);
			return self::$db -> findResult($query, $row, $filed);
		}
		
		public static function insert($table,$arr){
			return self::$db -> insert($table,$arr);
		}
		
		public static function update($table, $arr, $where){
			return self::$db -> update($table, $arr, $where);
		}
		
		public static function del($table,$where){
			return self::$db -> del($table,$where);
		}
	}
?>