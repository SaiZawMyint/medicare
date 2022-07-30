<?php

	include_once("databases/dbconnections.php");

	$filename=$_FILES["file1"]["name"];
	$filetype=$_FILES["file1"]["type"];
	$filetmp_name=$_FILES["file1"]["tmp_name"];
	$filesize=$_FILES["file1"]["size"];
	$fileerror=$_FILES["file1"]["error"];

	$username=$_GET['username'];

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
			$user_id=$data['id'];

			$old_profile=$data['profile'];


			if ($old_profile == 'User_Profile/femalepro.jpg' || $old_profile=='User_Profile/male_user.jpg') {
				
			}else{
				$get_path=substr($old_profile,4);
				if (!unlink($get_path)) {
					echo "Error while deleting old profile....";
				}else{
					echo "New profile uploaded...";
				}
			}
			
		}else{
			echo "Something wrong";
		}
	}

	if (!$filetmp_name) {
		echo "Please choose file to be upload !";
		exit();
	}

	$ts=substr($filetype, strpos($filetype, "/")+1);

	function RandomNumbers(int $length)
	{
		$array=[];

		for ($i=0; $i < $length; $i++) { 
			$array[]=mt_rand(1,10);
		}
		return $array;
	}

	$first=date("dmy");
	$last=implode("", RandomNumbers(10));

	$filenametosave=$first.$last;

	if (move_uploaded_file($filetmp_name, "profile_uploaded/$filenametosave.$ts")) {
		
		$update=" UPDATE `medicares` SET `profile`='xml/profile_uploaded/$filenametosave.$ts' where `id`='".$user_id."'";

		$result= mysqli_query($conn,$update);

		if ($result) {
			echo "<center><form action='Communication.php' method='post'><input type='text' name='username' id='username' value='$username' hidden>".
						"<input class='alert-in' type='submit' value='Done'>".
						"</form></center>";
		}else{
			echo "Something went wrong !!";
		}

	}else{
		echo "Failed to upload $filename file";
	}

?>