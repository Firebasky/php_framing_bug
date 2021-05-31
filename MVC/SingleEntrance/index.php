<?php 
//url形式   index.php?controller=控制器名&method=方法名
//http://localhost/mvc/test/index.php?controller=test&method=show
	require_once('function.php');

	$controllerAllow=array('test','index');
	$methodAllow=array('test','index','show');

	$controller = in_array(($_GET['controller']),$controllerAllow,true)?daddslashes($_GET['controller']):'index';
	$method = in_array(($_GET['method']),$methodAllow,true)?daddslashes($_GET['method']):'index';
	//echo $controller;
	C($controller, $method);//调用控制器函数
 ?>
