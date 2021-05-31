# PHP之MVC学习

https://www.awaimai.com/128.html#32

>为了学习php框架所以就简单的来学习一下mvc框架吧！

## MVC定义：

MVC：model view controller（模型，视图，控制器）

- 视图：`我们能直观看到的web界面`
- 模型：`按要求从数据库取出数据`
- 控制器：`向系统发出指令的工具和帮手`

## MVC优势：

MVC（3 个层）的 3 个优势：
 （1）各司其职，互不干扰
 （2）有利于开发中的分工
 （3）有利于代码的重用

##  Demo:

`test.php`

```php
<?php
/*
第一步 浏览者  ->  调用控制器，对其发出指令
第二步 控制器  ->  按指令选择一个合适的模型
第三步 模型    ->  按控制器指令取相应的数据
第四步 控制器  ->  按指令选择相关的视图
第五步 视图    ->  把第三步取到的数据按用户想要的样子显示出来
*/
require_once('testController.class.php');
require_once('testModel.class.php');
require_once('testView.class.php');

$testController = new testController();
$testController ->show();
```

`testController.class.php`

```php
<?php
class testController{
    //控制器的作用是调用模型，并调用视图，将模型产生的数据传递给视图，并让相关的视图去显示
    function show(){
        $testModel = new testModel();
        $data = $testModel->get();
        $testView = new testView();
        $testView->dsiplay($data);
    }
}
```

`testModel.class.php`

```php
<?php
class testModel{
    //模型的作用是获得数据并且处理返回给数据
    function get(){
        return "hello world";
    }
}
```

`testView.class.php`

```php
<?php
class testView{
    //视图的作用是将取得的数据进行组织，美化等，并最终向用户终端输出
    function dsiplay($data){
        echo $data;
    }
}
```

## 单一入口机制:

单一入口机制：单一入口指在一个web应用程序中，所有的请求都是指向一个脚本文件，例如我们经常看到某一个网站所有的页面都是index.php?xxx这样的形式。所有对使用程序的访问都是必须通过这个入口。

##  Demo:

目录：

![image-20210115211145540](.img/1.png)

`index.php`

```php
<?php 
//url形式   index.php?controller=控制器名&method=方法名
//http://localhost/mvc/test/index.php?controller=test&method=show
error_reporting(0);
	require_once('function.php');

	$controllerAllow=array('test','index');
	$methodAllow=array('test','index','show');//设置白名单

	$controller = in_array(($_GET['controller']),$controllerAllow,true)?addslashes($_GET['controller']):'index';
	$method = in_array(($_GET['method']),$methodAllow,true)?addslashes($_GET['method']):'index';

	C($controller, $method);//调用控制器函数
 ?>
```

`function.php`

```php
<?php 
/*
eval()函数调用简单但是不安全
eval('$obj = new '.$name.'Model()');
可用下面代码代替：
$model = $name.'Model';
$obj = new $Model();
*/
 //这里有了function.php，我们就可以使用模型调用函数来实例化模型
	//控制器调用函数
	$Path='E:/XAMPP/htdocs/MVC/';
	function C($name, $method){//两个参数分别表示控制器名称和要执行的函数名称
		require_once($Path.'libs/Controller/'.$name.'Controller.class.php');//调用路径文件
		eval('$obj = new '.$name.'Controller();$obj->'.$method.'();');//eval函数用来将字符串转化为可执行的代码
	}
	//模型调用函数
	function M($name){//参数是模型文件的名称
		require_once($Path.'libs/Model/'.$name.'Model.class.php');
		eval('$obj = new '.$name.'Model();');
		return $obj;
	}
	//视图调用函数
	function V($name){//参数是视图文件的名称
		require_once($Path.'libs/View/'.$name.'View.class.php');
		eval('$obj = new '.$name.'View();');//视图类实例化
		return $obj;
	}
 ?>
```

`testController.class.php`

```php
<?php 
class testController{
	function show(){
		$testModel = M("test");//这里固定了model的方法 操作不方便不好
		$data = $testModel->get();//取到数据，暂存到$data中
		$testView = V("test");//创建一个视图实例
		$testView->display($data);
	}
}
?>
```

`testModel.class.php`

```php
<?php
class testModel{
    //模型的作用是获得数据并且处理返回给数据
    function get(){
        return "hello world";
    }
}
```

`testView,class.php`

```php
<?php
class testView{
    //视图的作用是将取得的数据进行组织，美化等，并最终向用户终端输出
    function display($data){
        echo $data;
    }
}
```

`通过调试可以看到程序执行的流程`
