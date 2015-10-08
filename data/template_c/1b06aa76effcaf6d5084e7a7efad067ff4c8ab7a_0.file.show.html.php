<?php /* Smarty version 3.1.27, created on 2015-10-08 19:06:03
         compiled from "tpl\index\show.html" */ ?>
<?php
/*%%SmartyHeaderCode:2137556164e1b7915c2_32985536%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b06aa76effcaf6d5084e7a7efad067ff4c8ab7a' => 
    array (
      0 => 'tpl\\index\\show.html',
      1 => 1444302255,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2137556164e1b7915c2_32985536',
  'variables' => 
  array (
    'data' => 0,
    'about' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56164e1b821e69_00721019',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56164e1b821e69_00721019')) {
function content_56164e1b821e69_00721019 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2137556164e1b7915c2_32985536';
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>后台管理中心</title>
	
	<link rel="stylesheet" href="img/css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="img/css/ie.css" type="text/css" media="screen" />
	<?php echo '<script'; ?>
 src="img/js/html5.js"><?php echo '</script'; ?>
>
	<![endif]-->
	<?php echo '<script'; ?>
 src="img/js/jquery-1.5.2.min.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="img/js/hideshow.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="img/js/jquery.tablesorter.min.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="img/js/jquery.equalHeight.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
<?php echo '</script'; ?>
>

</head>


<body>
	<div id="page-bgtop">
		<div id="content">
			<div class="post">
				<p class="meta"><?php echo $_smarty_tpl->tpl_vars['data']->value['author'];?>
发布于<span><?php echo date('Y-m-d H:i:s',$_smarty_tpl->tpl_vars['data']->value['dateline']);?>
</span></p>
				<h2><a href="#"><?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
</a></h2>
				<div>
					<p><?php echo $_smarty_tpl->tpl_vars['data']->value['content'];?>
</p>
				</div>
			</div>
		</div>
	</div>
	
	<div>
		<a name="about">
			<ul>
				<li>
					<h2>关于我们</h2>
					<p><?php echo $_smarty_tpl->tpl_vars['about']->value;?>
</p>
				</li>
			</ul>
	</div>
</body>

</html><?php }
}
?>