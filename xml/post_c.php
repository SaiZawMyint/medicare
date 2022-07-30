<?php

	include_once("databases/dbconnections.php");
	include 'functions.php';
	session_start();

	if (empty($_SESSION['username'])) {
		header("location: Login.php");
	}

	$username=$_SESSION['username'];
	$user_profile=$_SESSION['user_profile'];
	
	$type=isset($_GET['type']) ? $_GET['type'] : 'text';
	

	$poster_name=$_GET['poster_name'];
	$post_id=$_GET['post_id'];
	$comment=$_GET['comment'];
	if ($conn->connect_error) {
			die("Failed to connect : ".$conn->connect_error);
		}else{

			$ss="SELECT * FROM post where post_id=?";
			$stmt=$conn->prepare($ss);
			$stmt->bind_param("s",$post_id);
			$stmt->execute();
			$stmt_result=$stmt->get_result();
			$n_like=0;
			if ($stmt_result->num_rows>0) {
				$data=$stmt_result->fetch_assoc();
				$reciever=$data['poster_name'];
				$n_comment=$data['comments'];
			}else{
				echo "Something wrong";
			}
		//	$comment=mysqli_real_escape_string($comment);

			$update=" UPDATE `post` SET `comments`=$n_comment+1 where `post_id`=$post_id";


			$sql="INSERT INTO comment (`poster`,`post_id`,`user`,`comment`,`type`) values ('$poster_name','$post_id','$username','$comment','$type');";

			$res_upd=mysqli_query($conn,$update); 
			$res_int=mysqli_query($conn,$sql);
			if (!$res_upd || !$res_int) {
				echo mysqli_error($conn);
			}
			$sar_sql="SELECT * FROM `post` where `post_id` = '$post_id' LIMIT 1";
				$sar_stmt=$conn->prepare($sar_sql);
				$sar_stmt->execute();
				$ress=$sar_stmt->get_result();

				if ($ress->num_rows > 0) {
					$data=$ress->fetch_assoc();

					$type=$data['type'].'/comment';

					$sar="INSERT INTO `sar_tb`(`username`,`post_id`,`type`,`log_type`) VALUES ('$username','$post_id','$type','activity')";
					$sar_res=mysqli_query($conn,$sar);

					if (!$sar_res) {
						echo myslqi_error($conn);
					}else{
						
					}

				}
			load($post_id);
		}

?>