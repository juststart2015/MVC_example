<?php /* Smarty version 3.1.27, created on 2015-10-08 13:03:26
         compiled from "tpl\index\index.html" */ ?>
<?php
/*%%SmartyHeaderCode:2099856164d7e02acc6_93396287%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '582ec9b926802535936711aced7500a86e7634d9' => 
    array (
      0 => 'tpl\\index\\index.html',
      1 => 1444302186,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2099856164d7e02acc6_93396287',
  'variables' => 
  array (
    'data' => 0,
    'news' => 0,
    'about' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56164d7e0d6af0_51767326',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56164d7e0d6af0_51767326')) {
function content_56164d7e0d6af0_51767326 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2099856164d7e02acc6_93396287';
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>主页</title>
	
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
			<!--  -->
			<?php
$_from = $_smarty_tpl->tpl_vars['data']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['news'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['news']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['news']->value) {
$_smarty_tpl->tpl_vars['news']->_loop = true;
$foreach_news_Sav = $_smarty_tpl->tpl_vars['news'];
?>
			<div class="post">
				<p class="meta"><?php echo $_smarty_tpl->tpl_vars['news']->value['author'];?>
发布于<span class="date"><?php echo $_smarty_tpl->tpl_vars['news']->value['dateline'];?>
</span></p>
				<h2 class="title"><a href="index.php?controller=index&method=newsshow&id=<?php echo $_smarty_tpl->tpl_vars['news']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['news']->value['title'];?>
</a></h2>
				<div class="entry">
					<p><?php echo $_smarty_tpl->tpl_vars['news']->value['content'];?>
</p>
				</div>
			</div>
			<?php
$_smarty_tpl->tpl_vars['news'] = $foreach_news_Sav;
}
?>
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