<?php

	session_start();
	include_once 'xml/databases/dbconnections.php';

	$log=isset($_SESSION['username']) ? false : true;


	if ($log) {
			$head_li="<a href='Login.php' class='u-header-link'>Join Us</a>";
	}else{
			$head_li="<li class='chat' title='chat with poster'></li><li class='report' title='report magazine'></li>";
	}

	if (!isset($_GET['id']) || !isset($_GET['npf']) || !isset($_GET['title'])) {
		$unavailable=true;
	}else{
		$unavailable=false;
		$post_id=$_GET['id'];
		$pr_url=$_GET['npf'];
		$magazine_url="news/news_".$pr_url.".j9";
		$url="xml/".$magazine_url;
		if (is_file($url)) {
			$unavailable=false;
			$old_contents=file_get_contents($url);

			$old_contents=preg_replace("#\[sp\]#", " &nbsp;", $old_contents);
			$old_contents=preg_replace("#\[nl\]#", " <br/>", $old_contents);
			$old_contents=preg_replace('"\b(https?://\S+)"', '<a href="$1 ">$1</a>', $old_contents);

			$len=strlen($old_contents);
			$words=explode(" ", $old_contents);
			
			function firstPage($string)
			{
				$ary = explode(" ", $string);

				$s=sizeof($ary)/2;
				
				for ($i=0; $i < $s; $i++) { 
					$fr[$i]=$ary[$i];
				}

				$res=implode(" ", $fr);

				return $res;
			}

			function lastPage($string){
				$ary = explode(" ", $string);

				$s=sizeof($ary)/2;
				
				for ($i=$s+1; $i < sizeof($ary); $i++) { 
					$fr[$i]=$ary[$i];
				}

				$res=implode(" ", $fr);

				return $res;
			}

			if (sizeof($words) > 50) {
				$first=firstPage($old_contents);
				$last=lastPage($old_contents);
			}else{
				$first=$old_contents;
				$last='';
			}

		}else{
			$unavailable=true;
		}
		
		$get_news_header=$_GET['title'];

		if ($conn->connect_error) {
			die("Failed to load : ". $conn->connect_error);
			$unavailable=true;
		}else{

			$sql="SELECT * FROM `post` where post_id='$post_id'";

			$result=mysqli_query($conn,$sql);
			$resultCheck=mysqli_num_rows($result);

			if ($resultCheck > 0) {
				while ($row = mysqli_fetch_assoc($result)) {

					$poster_name=$row['poster_name'];
					$msg_con=$row['message'];
					$cap_ncap=$row['post_caption'];
					$date=$row['post_date'];
					$likes=$row['likes'];
					$comments=$row['comments'];
					$share=$row['shares'];
					$type=$row['type'];

					$sqlu="SELECT * FROM medicares where username=?";
					$stmt=$conn->prepare($sqlu);
					$stmt->bind_param('s',$poster_name);
					$stmt->execute();
					$res=$stmt->get_result();

					if ($res->num_rows > 0) {
						$unavailable=false;
						$data=$res->fetch_assoc();
						$poster_profile=$data['profile'];
					}else{
						$unavailable=true;
					}

					if ($type != 'news') {
						$unavailable=true;
					}else{
						$unavailable=false;
					}

					$message=substr($msg_con, 0,  stripos($msg_con, '-'));
					$news_contents=substr($msg_con, stripos($msg_con, '-')+1);

					$n=substr($news_contents, stripos($news_contents, "_")+1);
					$npf=substr($n, 0,stripos($n, "."));

					


					$news_header=substr($cap_ncap, 0, stripos($cap_ncap, '*'));

					if ($news_header != $get_news_header || $pr_url != $npf) {
						$unavailable=true;
					}else{
						$unavailable=false;
					}
					
					$ps_caption=substr($cap_ncap, strripos($cap_ncap, "*")+1);
					$ps_caption=preg_replace("#\[sp\]#", " &nbsp;", $ps_caption);
					$ps_caption=preg_replace("#\[nl\]#", " <br/>", $ps_caption);
					$ps_caption=preg_replace('"\b(https?://\S+)"', '<a href="$1 ">$1</a>', $ps_caption);

				}
				
			}else{
				$unavailable=true;
			}

		}

		

	}
?>
<?php

	if ($unavailable) {
		if (is_file('error_log/event_unavilable.errj9')) {
			$content_f=file_get_contents('error_log/event_unavilable.errj9');
			echo $content_f;
		}else{
			echo "no file";
		}
	}else{
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $news_header; ?></title>
	<link rel="icon" type="image/png" href="css/Img/news.png">
	<script type="text/javascript" src="js/communication.js"></script>
	<link rel="stylesheet" type="text/css" href="css/view.css">
	<link rel="stylesheet" type="text/css" href="css/magazine.css">
	<script type="text/javascript" src="js/basic.js"></script>
</head>
<body>
	<div class="m-header mg-header" id="hi-he">
		<span class="back" onclick="back()">Back</span>
		<ul>
			<?php echo $head_li; ?>
		</ul>
	</div>
	<div class="main-body">
		<div class="header-col">
		<div class="mg-col-1">
			<img src="<?php echo($message) ?>">
			
		</div>
		<div class="mg-col-2">
			<div class="ps"><?php echo $ps_caption; ?></div>
			<ul>
				<li>Writer : <a href=''><?php echo $poster_name; ?></a></li>
				<li>feedback : <a href=''><?php echo $poster_name; ?></a></li>
				<li><a href=''>Like</a></li>
				<li><a href=''>Share</a></li>
			</ul>
		</div>
		</div>
		<center><h3><?php echo $news_header; ?></h3></center>
		<div class="contents-col">
			<div class="c-col-1"><p><?php echo $first; ?></p></div>
			<div class="c-col-2"><p><?php echo $last; ?></p></div>
			
		</div>
	</div>	
	<div id="noti-box-in-body" class="alert-in-box">
	<div class="alert-in-box-header"></div>
	<div id='dark' style="display: none;"></div>
</div>
</body>
</html>
	

<?php
	}
?>


