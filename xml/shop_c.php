<?php

	
	include_once("databases/dbconnections.php");

	$filename=$_FILES["file1"]["name"];
	$filetype=$_FILES["file1"]["type"];
	$filetmp_name=$_FILES["file1"]["tmp_name"];
	$filesize=$_FILES["file1"]["size"];
	$fileerror=$_FILES["file1"]["error"];

	$poster_name=$_GET['username'];
	$pd_name=$_GET['pd_name'];
	$pd_prices=$_GET['pd_prices'];
	$post_caption=$_GET['post_caption'];
	$type=$_GET['type'];
	$methods=$_GET['methods'];

	function RandomNumbers(int $length)
	{
		$array=[];

		for ($i=0; $i < $length; $i++) { 
			$array[]=mt_rand(1,10);
		}
		return $array;
	}

	if (!$filetmp_name) {
		echo "Please choose file to be upload !";
		exit();
	}

	$ts=substr($filetype, strpos($filetype, "/")+1);

	

	$first=date("dmy");
	$last=implode("", RandomNumbers(10));

	$filenametosave=$first.$last;

	if ($conn->connect_error) {
		die("Failed to upload".$conn->connect_error);
		echo "Failed to upload".$conn->connect_error;
	}else{

	if (move_uploaded_file($filetmp_name, "photo_uploaded/$filenametosave.$ts")) {

		$indata="xml/photo_uploaded/".$filenametosave.'.'.$ts;
		$sql ="INSERT INTO `post` (`poster_name`,`type`,`message`,`post_caption`) VALUES ('$poster_name','$type','$indata','$post_caption')";

		$result_check=mysqli_query($conn,$sql);

		if (!$result_check) {
			echo mysqli_error($conn);
		}
		

		$get_c_id="SELECT * FROM `post` where poster_name='$poster_name' AND type='$type' and message='$indata' and post_caption='$post_caption' limit 1";
		$stmt=$conn->prepare($get_c_id);
		$stmt->execute();
		$srs=$stmt->get_result();

		if ($srs->num_rows > 0) {
			$data=$srs->fetch_assoc();

			$id=$data['post_id'];

			$shop="INSERT INTO `shop` (`name`,`prices`,`payment`,`id`,`pd_description`,`pd_photo`) VALUES ('$pd_name','$pd_prices','$methods','$id','$post_caption','$indata')";

			$scheck=mysqli_query($conn,$shop);

			if (!$scheck) {
				echo mysqli_error($conn);
			
		}else{
			echo "<center><form action='Communication.php' method='post'><input type='text' name='username' id='username' value='$poster_name' hidden>".
						"<input class='alert-in' type='submit' value='Done'>".
						"</form></center>";
		}

		
		
	}else{
		echo "Failed to upload!";
	}
}else{
	echo "Failed to upload!";
}
}

?>