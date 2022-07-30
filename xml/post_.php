<?php
include_once("databases/dbconnections.php");



	if ($conn->connect_error) {
		die("Connection failed : ".$conn->connect_error );
	}

if (isset($_GET['message']) && isset($_GET['poster_name'])&& isset($_GET['type'])) {
	
	$poster_name=$_GET['poster_name'];
	$type=$_GET['type'];
	$message=$_GET['message'];
	
		$sql ="INSERT INTO `post` (`poster_name`,`type`,`message`) values('$poster_name','$type','$message')";
		$res=mysqli_query($conn,$sql);
		
		if (!$res) {
			echo myslqi_error($conn);
		}else{
			$sar_sql="SELECT * FROM `post` where `poster_name` = '$poster_name' and `type` = '$type' and `message` = '$message' LIMIT 1";
			$sar_stmt=$conn->prepare($sar_sql);
			$sar_stmt->execute();
			$ress=$sar_stmt->get_result();

			if ($ress->num_rows > 0) {
				$data=$ress->fetch_assoc();

				$post_id=$data['post_id'];

				$sar="INSERT INTO `sar_tb`(`username`,`post_id`,`type`,`log_type`) VALUES ('$poster_name','$post_id','$type','recent')";
				$sar_res=mysqli_query($conn,$sar);

				if (!$sar_res) {
					echo myslqi_error($conn);
				}else{
					echo "<center>Uploaded !! <a href='Communication.php'>Done</a></center>";
				}

			}
		}
		
		

	}


	$conn->close();

?>