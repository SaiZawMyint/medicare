<?php  
	include_once("databases/dbconnections.php");
	session_start();
	$username=$_GET['username'];
	$password=$_GET['password'];
	$_SESSION['username']=$username;
	$sql="SELECT * FROM medicares where username=?";

	if ($conn->connect_error) {
		die("Failed to connect : ".$conn->connect_error);
	}else{
		$stmt=$conn->prepare($sql);
		$stmt->bind_param("s",$username);
		$stmt->execute();
		$stmt_result=$stmt->get_result();

		if ($stmt_result->num_rows>0) {
			$data=$stmt_result->fetch_assoc();
			$src_prof=$data['profile'];
			$user_id=$data['id'];
			$gender = $data['gender'];
			if ($data['password']===$password) {
				echo "true";
				$_SESSION['user_id'] = $user_id;
				$_SESSION['user_profile']=$src_prof;
				$_SESSION['user_gender']=$gender;
			}else{
				echo "false";
			}
		}else{
			echo "false";
		}
	}

?>