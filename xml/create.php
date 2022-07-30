<?php 
	include_once ('databases/dbconnections.php');
	session_start();
//random
function RandomNumbers(int $length)
	{
		$array=[];

		for ($i=0; $i < $length; $i++) { 
			$array[]=mt_rand(1,10);
		}
		return $array;
	}


if (isset($_GET['username']) && isset($_GET['email']) && isset($_GET['password'])) {
	
	$username=$_GET['username'];
	$email=$_GET['email'];
	$password=$_GET['password'];
	$gender=$_GET['gender'];
	$profile="";

	$ran=implode('', RandomNumbers(10));

	$subfir=str_replace(" ", "_", $username);

	$id=$subfir.'_'.$ran;

	$date=date("d-m-y");

	if ($gender=="Male") {
		$profile="User_Profile/male_user.jpg";
	}else if ($gender=="Female") {
		$profile="User_Profile/femalepro.jpg";
	}


	$sql="insert into medicares (username,email,password,id,profile,gender,birthday) values('$username','$email','$password','$id','$profile','$gender','')";
	mysqli_query($conn,$sql);

	$_SESSION['username']=$username;

	$sg="SELECT * FROM medicares WHERE username='$username'";
	$stmt=$conn->prepare($sg);
	$stmt->execute();
	$res=$stmt->get_result();

	if ($res->num_rows > 0) {
		$data=$res->fetch_assoc();
		$un=$data['username'];

		$inal="INSERT INTO user_account_status (`username`) VALUES ('$username')";
		$rsa=mysqli_query($conn,$inal);

		if (!$rsa) {
			echo "false";
		}else{
			echo "true";
		}
	}else{
		echo "false";
	}

	
	

}else{
	header("location : create.html");
	exit();
}

?>