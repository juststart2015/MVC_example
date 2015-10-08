<?php
	//视图的作用是将取得的数据进行组织美化，并向用户输出

	//此句创建一个视图，以供使用
	class testView{
		//此句创建一个函数，以供调用
		function display($data){
			//进行美化排版，这里直接数据变量$data的值；
			echo "<hr>";
			echo $data;
		}
	}
?>