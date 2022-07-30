<?php

	include_once 'databases/dbconnections.php';
	session_start();

	if (!isset($_SESSION['username'])) {
		
	}else{
		$username=$_SESSION['username'];
		$content=$_GET['content'];

		$sql="UPDATE `medicares` SET `description`='$content' where `username`='".$username."'";

		$result= mysqli_query($conn,$sql);

		if (!$result) {
			echo "Something went wrong !!".mysqli_error();
			
		}else{
			echo $content;
		}
	}

?>