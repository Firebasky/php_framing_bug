<?php
/*
第一步 浏览者  ->  调用控制器，对其发出指令
第二步 控制器  ->  按指令选择一个合适的模型
第三步 模型    ->  按控制器指令取相应的数据
第四步 控制器  ->  按指令选择相关的视图
第五步 视图    ->  把第三步取到的数据按用户想要的样子显示出来
*/
require_once('./libs/Controller/testController.class.php');
require_once('./libs/Model/testModel.class.php');
require_once('./libs/View/testView.class.php');

$testController = new testController();
$testController ->show();
