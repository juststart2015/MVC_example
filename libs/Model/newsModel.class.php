<?php
	class newsModel{

		public $_table = 'news';

		//取出所有新闻，并按时间倒序排列
		function findAll_orderby_dateline(){
			$sql = 'select * from '.$this->_table.' order by dateline desc';
			//讲sql语句传毒给findALL
			return DB::findAll($sql);
		}

		function findOne_by_id($id){
			$sql = 'select * from '.$this->_table.' where id='.$id;
			return DB::findOne($sql);
		}

		//通过id来删除新闻
		function del_by_id($id){
			return DB::del($this->_table, 'id='.$id);
		}
		
		//用于获取新闻总数
		function count(){
			//获取所有新闻数量的sql语句
			$sql = 'select count(*) from '.$this->_table;
			//第一个sql语句，第二个参数第一行开始取，第三个参数从第一个字段开始取
			return DB::findResult($sql, 0, 0);
		}

		//根据ID查询新闻信息
		public function getnewsinfo($id){
			//判断新闻ID是否为空
			if(empty($id)){
				//若为空，返回一个空数据，这里是空数组
				return array();
			}else{
				//intval转换成数字
				$id = intval($id);
				//查询新闻的sql语句
				$sql = 'select * from '.$this -> _table.' where id = '.$id;
				//通过findOne方法获取单条信息
				return DB::findOne($sql);
			}
		}
		
		//该方法
		function newssubmit($data){
			//extract函数转换数组键名对应键值
			extract($data);
			//判断标题、内容是否为空，若为空则提示不允许提交
			if(empty($title)||empty($content)){
				return 0;
			}
			//对传入的变量值进行特殊字符的转换
			$title = addslashes($title);
			$content = addslashes($content);
			$author = addslashes($author);
			$from = addslashes($from);
			//
			$data = array(
				'title' => $title,
				'content' => $content,
				'author' => $author,
				'from' => $from,
				'dateline' => time()
			);
			//判断若ID为空，则执行添加操作，若不为空，则执行修改操作
			//因ID为数据库自增长，新增时不可能有id
			if($_POST['id'] != ''){
				//update方法，传入修改表名，数据，以及对应id的值
				DB::update($this -> _table, $data, 'id = '.$id);
				return 2;
			}else{
				//insert方法，传入表名及要插入的数据
				DB::insert($this -> _table, $data);
				return 1;
			}
		}

		function insert($data){
			return DB::insert($this->_table, $data);
		}

		function update($data, $id){
			return DB::update($this->_table, $data, 'id='.$id);
		}
		
		//获取新闻列表，前台与后台共用此方法
		function get_news_list(){
			//使用findAll_orderby_dateline方法获取数据，
			$data = $this -> findAll_orderby_dateline();//此方法后台管理列表也使用了
			foreach($data as $k => $news){
				//对内容，mb_substr()函数截取200个字，strip_tags()函数去除html标签符，
				$data[$k]['content'] = mb_substr(strip_tags($data[$k]['content']),0,200);
				//date函数转换时间格式
				$data[$k]['dateline'] = date('Y-m-d H:i:s', $data[$k]['dateline']);
			}
			return $data;
		}
	}
?>