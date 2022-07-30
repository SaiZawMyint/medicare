<?php

include_once ('databases/dbconnections.php');
include 'functions.php';
	session_start();

	if (!isset($_SESSION['username'])) {
		header("Location:Logout.php");
	}
	

	$username=$_SESSION['username'];
	$post_id=$_GET['post_id'];

		

	if (isset($_GET['sts'])) {
	$sql="SELECT * FROM post where post_id=?";

			if ($conn->connect_error) {
			die("Failed to connect : ".$conn->connect_error);
			}else{
			$stmt=$conn->prepare($sql);
			$stmt->bind_param("s",$post_id);
			$stmt->execute();
			$stmt_result=$stmt->get_result();
			$n_like=0;
			if ($stmt_result->num_rows>0) {
				$data=$stmt_result->fetch_assoc();
				$reciever=$data['poster_name'];
				$n_like=$data['likes'];
			}else{
				echo "Something wrong";
			}
			$update=" UPDATE `post` SET `likes`=$n_like+1 where `post_id`=$post_id";
			$insert="INSERT INTO likes(`giver`,`reciever`,`post_id`) VALUES ('$username','$reciever','$post_id')";

			$res_upd=mysqli_query($conn,$update);
			if (!$res_upd) {
				echo mysqli_error($conn);
			}else{
			}
			$res_ins=mysqli_query($conn,$insert);
			if (!$res_ins) {
				echo mysqli_error($conn);
			}else{

				$sar_sql="SELECT * FROM `post` where `post_id` = '$post_id' LIMIT 1";
				$sar_stmt=$conn->prepare($sar_sql);
				$sar_stmt->execute();
				$ress=$sar_stmt->get_result();

				if ($ress->num_rows > 0) {
					$data=$ress->fetch_assoc();

					$type=$data['type'].'/like';

					$sar="INSERT INTO `sar_tb`(`username`,`post_id`,`type`,`log_type`) VALUES ('$username','$post_id','$type','activity')";
					$sar_res=mysqli_query($conn,$sar);

					if (!$sar_res) {
						echo myslqi_error($conn);
					}else{
						
					}

				}

			}

		}
	
		

	}
	 if (isset($_GET['unsts'])) {
		$sql="SELECT * FROM post where post_id=?";

			if ($conn->connect_error) {
			die("Failed to connect : ".$conn->connect_error);
			}else{
			$stmt=$conn->prepare($sql);
			$stmt->bind_param("s",$post_id);
			$stmt->execute();
			$stmt_result=$stmt->get_result();
			$n_like=0;
			if ($stmt_result->num_rows>0) {
				$data=$stmt_result->fetch_assoc();
				$reciever=$data['poster_name'];
				$n_like=$data['likes'];
			}else{
				echo "Something wrong";
			}

		$sql="DELETE FROM `likes` WHERE `likes`.`giver` = '$username' and `likes`.`post_id`='$post_id';";
		$update="UPDATE `post` SET `likes`=$n_like-1 WHERE post_id=$post_id";
		mysqli_query($conn,$sql);
		mysqli_query($conn,$update);
			
		$sar_sql="SELECT * FROM `post` where `post_id` = '$post_id' LIMIT 1";
				$sar_stmt=$conn->prepare($sar_sql);
				$sar_stmt->execute();
				$ress=$sar_stmt->get_result();

				if ($ress->num_rows > 0) {
					$data=$ress->fetch_assoc();

					$type=$data['type'];

					$sar="DELETE FROM `sar_tb` WHERE `sar_tb`.`username` = '$username' and `sar_tb`.`post_id`='$post_id' and `sar_tb`.`type`='$type/like'";
					$sar_res=mysqli_query($conn,$sar);

					if (!$sar_res) {
						echo myslqi_error($conn);
					}else{
						
					}

				}

		}
		
	}
		$like=loadLike($post_id);
		if ($like>1) {
					$like=$like.'likes';
				}else{
					if ($like == 1) {
						$like=$like.'like';
					}
					else{
						$like='like';
					}
				}
		echo $like;

?>