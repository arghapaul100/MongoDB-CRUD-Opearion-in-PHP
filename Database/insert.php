<?php

	include 'connect.php';

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

	$count = rand(0,1000000000);

	$data = array(
		"avtar"=>$desti,
		"_id"=>$count,
		"name"=>$name,
		"roll"=>$roll,
		"address"=>$address,
		"passingYear"=>$year,
		"passingGrade"=>$grade
	);

	$con->insertOne($data);
?>