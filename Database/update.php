<?php
	include 'connect.php';

	$id = (int)$_POST['id'];
	$name = $_POST['txt_name'];
	$roll = $_POST['txt_roll'];
	$address = $_POST['txt_address'];
	$year = $_POST['txt_year'];
	$grade = $_POST['txt_grade'];
	$fileName = $_FILES['image']['name'];
	$fileTmp = $_FILES['image']['tmp_name'];
	$file_ext = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
	$desti = rand().".".$file_ext;
	move_uploaded_file($fileTmp, "UserAvtar/".$desti);

	$docs = $con->findOne(['_id'=>$id]);
	$avtar = $docs['avtar'];
	$exactFile = 'UserAvtar/'.$avtar;
	if(file_exists($exactFile)){
		unlink($exactFile);
	}


	$con->updateOne(
		['_id'=>$id],
		['$set'=>['name'=>$name,'roll'=>$roll,'address'=>$address,'avtar'=>$desti,'passingYear'=>$year,'passingGrade'=>$grade]
		]
	);

?>