<?php

	session_start();
	include_once ('databases/dbconnections.php');

	if (!isset($_SESSION['username'])) {
		header("Location:Logout.php");
	}else{
		$username=$_SESSION['username'];
		$post_id=$_GET['id'];
		$type=$_GET['typ'];
		$log_type='save';

		if ($conn->connect_error) {
			die($conn->connect_error);
		}else{

			$sar="INSERT INTO `sar_tb`(`username`,`post_id`,`type`,`log_type`) VALUES ('$username','$post_id','$type','$log_type')";
			$sar_res=mysqli_query($conn,$sar);

			if (!$sar_res) {
				echo myslqi_error($conn);
			}else{
				
			}

		}
	}

?>