<?php
	class adminModel{
		//定义表名
		public $_table = 'admin';
		
		//取用户信息，通过用户名
		function findOne_by_username($username){
			$sql = 'select * from '.$this->_table.' where username = "'.$username.'"';
			return DB::findOne($sql);//findOne方法，寻找单条数据
		}
		
		//用户密码核对 --> auth模型
		
		function count(){
			$sql = 'select count(*) from '.$this->_table;
			return DB::findResult($sql, 0, 0);
		}
	}
?>