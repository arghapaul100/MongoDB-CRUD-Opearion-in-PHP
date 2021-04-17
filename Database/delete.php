<?php
	
	include 'connect.php';

	$id = (int)$_GET['id'];
	$documents = $con->findOne(['_id'=>$id]);

	$file = (string)$documents['avtar'];
	$exactFile = 'UserAvtar/'.$file;
	if(file_exists($exactFile)){
		unlink($exactFile);
	}

	$con->deleteOne(["_id"=>$id]);

	header("Location:index.php");
?>