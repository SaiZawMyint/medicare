<?php
	
	include_once("databases/dbconnections.php");
	session_start();

	$username = $_SESSION['username'];
	$type = "news";

	function RandomNumbers(int $length)
	{
		$array=[];

		for ($i=0; $i < $length; $i++) { 
			$array[]=mt_rand(1,10);
		}
		return $array;
	}	

	$data = isset(($_POST['magazine'])) ? $_POST['magazine'] : "none";
	if(isset($_POST['magazine'])){

		$magazine=$_POST['magazine'];

		$filename=$_FILES["file1"]["name"];
		$filetype=$_FILES["file1"]["type"];
		$filetmp_name=$_FILES["file1"]["tmp_name"];
		$filesize=$_FILES["file1"]["size"];
		$fileerror=$_FILES["file1"]["error"];

		$gs=implode("", RandomNumbers(10));
		
		$title = $_POST['title'];
		$Writter= $_POST['Writter'];
		$Comment = $_POST['Comment'];

		$nfilename="news/mag".$gs.".html";
		


		
		
		$dataE = $title.'*'.$Writter.'*'.$Comment;
		if (!is_file($nfilename)) {
			file_put_contents($nfilename, $magazine);

			$ts=substr($filetype, strpos($filetype, "/")+1);
			$ncname = "photo_uploaded/p".$gs.'.'.$ts;
			
			if (move_uploaded_file($filetmp_name, $ncname)) {
				$sql = "INSERT INTO `post` (`poster_name`,`type`,`message`,`post_caption`) VALUES ('$username','$type','$nfilename-$ncname','$dataE')";

				$result_check=mysqli_query($conn,$sql);

				if (!$result_check) {
					echo mysqli_error($conn);
				}else{
					
				

				$sar_sql="SELECT * FROM `post` where `poster_name` = '$username' and `type` = '$type' and `message` = '$nfilename-$ncname' LIMIT 1";
				$sar_stmt=$conn->prepare($sar_sql);
				$sar_stmt->execute();
				$ress=$sar_stmt->get_result();

				if ($ress->num_rows > 0) {
					$data=$ress->fetch_assoc();

					$post_id=$data['post_id'];

					$sar="INSERT INTO `sar_tb`(`username`,`post_id`,`type`,`log_type`) VALUES ('$username','$post_id','$type','recent')";
					$sar_res=mysqli_query($conn,$sar);

					if (!$sar_res) {
						echo myslqi_error($conn);
					}else{
						echo "<center>See your file <a href='Magazine/?id=$post_id&npf=$gs&title=$title'><i>here<i></a>.</center>";
					}

				}
				}
		}
		}
	}
	



?>