<?php
	session_start();
	$root= realpath($_SERVER["DOCUMENT_ROOT"]);
	
	$dbservername='localhost:1101';
	$dbusername='root';
	$dbpassword='';
	$dbname='medicare';

	$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$dbname);

	$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
	$unavaliable = false;
	$id = isset($_GET['id']) ? $_GET['id'] : '';
	$npff = isset($_GET['npf']) ? $_GET['npf'] : '';
	$npf = 'news/mag'.$npff.'.html';
	
	$title = isset($_GET['title']) ? $_GET['title'] : '';

	$sql ="SELECT * FROM `post` where post_id=?";

	if ($conn->connect_error) {
			die($conn->connect_error);
	}

	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s",$id);
	$stmt->execute();

	$res = $stmt->get_result();
	if($res->num_rows > 0){
		$unavaliable = false;
		$data = $res->fetch_assoc();

		$poster = $data['poster_name'];
		$post_type = $data['type'];
		$post_date = $data['post_date'];
		$message = $data['message'];
		$post_caption = $data['post_caption'];
		$like = $data['likes'];
		$comment = $data['comments'];
		$share = $data['shares'];

		$check_mg = substr($message, 0,stripos($message, "-"));

		$mag_cov = substr($message, stripos($message, "-")+1);
		$mag_cov = "/Medicare/xml/".$mag_cov;
		
		$news_header=substr($post_caption, 0, stripos($post_caption, '*')); 
		
		if($post_type != 'news' || $check_mg != $npf || $news_header != $title){
			$unavaliable = true;
		}else{
			$unavaliable = false;
		}

	}

if (!$unavaliable) {
	
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title;?></title>
	<link rel="icon" type="image/*" href="<?php echo($mag_cov)?>">
	<script type="text/javascript" src="/Medicare/js/event.js"></script>
	<link rel="stylesheet" type="text/css" href="/Medicare/css/editor.css">
	<link rel="stylesheet" type="text/css" href="/Medicare/css/basic_css.css">
</head>
<body>

	<div id="main-body">
	<div id="header" style="position: fixed;">
			<nav class="p_back" onclick="back();" title="Back"></nav>
			<h3><?php echo $title;?></h3>
			<ul>
				<li class="more_act" title="More"></li>
			</ul>
		</div>
<?php
if ($id != '') {

$path = "{$root}/Medicare/xml/$npf";
if (is_file($path)) {
	$contents = file_get_contents($path);
	$contents = str_replace("\r\n", "\n", $contents);
?>
	
		<div id="up-info" style="display: none;">
			<div class="mag-cov">
				<img src="<?php echo($mag_cov)?>" class="cov">
			</div>
		</div>
		<div id="mag-field" style="width: 100%;margin-top: 4%;">
<?php
	echo $contents;
?>
	</div>
<?php
}else{
	$root= realpath($_SERVER["DOCUMENT_ROOT"]);
	include "{$root}/Medicare/error_log/ajax_request_rejection.errj9";
		
}

}	
?>

</div>
</body>
</html>
<?php

	}else{
		$root= realpath($_SERVER["DOCUMENT_ROOT"]);
		include "{$root}/Medicare/error_log/ajax_request_rejection.errj9";
		
	}

?>