<?php 
class testController{
	function show(){
		$testModel = M("test");
		$data = $testModel->get();//取到数据，暂存到$data中
		$testView = V("test");//创建一个视图实例
		$testView->display($data);
	}
}
?>
