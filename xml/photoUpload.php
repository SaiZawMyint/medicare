<?php

	include_once("databases/dbconnections.php");

	$filename=$_FILES["file1"]["name"];
	$filetype=$_FILES["file1"]["type"];
	$filetmp_name=$_FILES["file1"]["tmp_name"];
	$filesize=$_FILES["file1"]["size"];
	$fileerror=$_FILES["file1"]["error"];

	$poster_name=$_GET['username'];
	$type=$_GET['type'];
	$post_caption=$_GET['post_caption'];

	function RandomNumbers(int $length)
	{
		$array=[];

		for ($i=0; $i < $length; $i++) { 
			$array[]=mt_rand(1,10);
		}
		return $array;
	}

	$tsn='';
	
	if (isset($_POST['news_contents'])) {
		$news_contents=$_POST['news_contents'];
		$gs=implode("", RandomNumbers(10));
		$nfilename="news/news_".$gs.".j9";
		$tsn="-".$nfilename;
		if (!is_file($nfilename)) {
			file_put_contents($nfilename, $news_contents);
		}
	}else{
		$tsn="";
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

		$indata="xml/photo_uploaded/".$filenametosave.'.'.$ts.$tsn;
		$sql ="INSERT INTO `post` (`poster_name`,`type`,`message`,`post_caption`) VALUES ('$poster_name','$type','$indata','$post_caption')";
		$result_check=mysqli_query($conn,$sql);

		if (!$result_check) {
			echo mysqli_error($conn);
		}else{
			

			$sar_sql="SELECT * FROM `post` where `poster_name` = '$poster_name' and `type` = '$type' and `message` = '$indata' LIMIT 1";
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
					echo "<center><form action='Communication.php' method='post'><input type='text' name='medicarename' id='medicarename' value='$poster_name' hidden>".
						"<input class='alert-in' type='submit' value='Done'>".
						"</form></center>";
				}

			}


		}
		
			
		
	}else{
		echo "Failed to upload!";
	}
}
?>