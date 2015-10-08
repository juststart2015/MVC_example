<?php
	error_reporting (E_ALL & ~E_DEPRECATED);
	
	class mysql{
		/*
		*报错函数
		*
		*@param string $error
		*/
		function err($error){
			die ("对不起，您的操作有误，错误原因为：".$error);//die有两种作用，输出和终止相当于echo 和 exit 的组合
		}
		/*
		*连接数据库
		*
		*@param string $config 配置数组 array($dbhost, $dbuser, $dbpsw, $dbname, $dbcharset)
		*@return bool 连接成功或不成功
		*/
		function connect($config){
			//extract将数组还原成变量
			extract($config);
			//判断连接是否成功
			if(!($con = mysql_connect($dbhost,$dbuser,$dbpsw))){
				$this -> err(mysql_error());
			}
			//判断是否成功选择到数据库
			if(!mysql_select_db($dbname,$con)){
				$this -> err(mysql_error());
			}
			//设置编码，
			mysql_query("set names".$dbcharset);
		}
		/*
		*执行sql语句
		*
		*@param string $sql
		*@return bool 返回执行成功、资源或执行失败
		*/
		function query($sql){
			if(!($query = mysql_query($sql))){
				$this -> err ($sql."<br />".mysql_error());
			}else{
				return $query;
			}
		}
		/*
		*列表
		*
		*@param source $query sql 语句通过mysql_query执行出来的资源
		*@param array 返回列表数组
		*/
		function findAll($query){
			//mysql_fetch_array函数把资源转换为数组，一次转换出一行出来
			while($rs = mysql_fetch_array($query,MYSQL_ASSOC)){
				$list[] = $rs;
			}
			//判断 $list是否存在，即是否取到值
			return isset($list)?$list:"";
		}
		/*
		*单条
		*
		*@param source $query sql 语句通过mysql_query执行出来的资源
		*return array 返回单条信息数组
		*/
		function findOne($query){
			$rs = mysql_fetch_array($query,MYSQL_ASSOC);
			return $rs;
		}
		/*
		*指定行的指定字段的值
		*
		*@param source $query sql语句通过mysql_query执行出来的资源
		*return array 返回指定行的指定字段的值
		*/
		function findResult($query,$row = 0,$field = 0){
			//mysql_result返回指定行指定字段的值
			$rs = mysql_result($query,$row,$field);
			return $rs;
		}
		/*
		*添加函数
		*
		*@param string $table 表名
		*@param array $arr 添加数组（包含字段和值的一维数组）
		*/
		function insert($table,$arr){
			//$sql = "insert into 表名(多个字段) values(多个值)";
			/*
			$arr = array(
				'a' => 1,
				'b' => 2,
				'c' => 3
			)
			*/
			foreach($arr as $key => $value){
				//mysql_real_escape_string
				$value = mysql_real_escape_string($value);
				$keyArr[] = "`".$key."`";//把$arr数组当众的键名保存到$keyArr数组当中
				//把$arr数组当中的键值保存到$valueArr当中，因为值多为字符串，而sql语句里面insert当中如果值是字符串的话要加单引号，所以这个地方要加上单引号(这个单引号是键盘上esc那个键上的单引号)
				$valueArr[] = "'".$value."'";
				}
				$keys = implode(",",$keyArr);//implode函数是把数组组合成字符串，implode(分隔符,数组)
				$values = implode(",",$valueArr);
				//sql插入语句，$sql = "insert into 表名(多个字段) values(多个值)";
				$sql = "insert into ".$table."(".$keys.") values (".$values.")"; 
				$this -> query($sql);//调用类自身的query(执行)方法执行这条sql语句，注：$this指代自身
				return mysql_insert_id();
		}
		/*
		*修改函数
		*
		*@param string $table 表名
		*@param array $arr 修改数组（包含字段和值的一维数组）
		*@param string $where 条件
		*/
		function update($table,$arr,$where){
			//update 表名 set 字段 = 字段值 where ......
			foreach ($arr as $key => $value){
				$value = mysql_real_escape_string($value);
				$keyAndvalueArr[] = "`".$key."`='".$value."'";
			}
			$keyAndvalues = implode(",",$keyAndvalueArr);
			$sql = "update ".$table." set ".$keyAndvalues." where ".$where;
			
			$this -> query($sql);
		}
		/*
		*删除函数
		*
		*@param string $table 表名
		*@param string $where 条件
		*/
		function del($table,$where){
			$sql = "delete from ".$table." where ".$where;
			$this -> query($sql);
		}
	}
?>