<?php

	session_start();

	$dbservername='localhost:1101';
	$dbusername='root';
	$dbpassword='';
	$dbname='medicare';

	$root= realpath($_SERVER["DOCUMENT_ROOT"]);

	$conn = mysqli_connect($dbservername,$dbusername,$dbpassword,$dbname);

	$msg_dis = "";

	if (!isset($_SESSION['username'])) {
		$unavialble=true;
	}else{
		$unavialble=false;
		if (!isset($_GET['id']) && !isset($_GET['username']) && isset($_SESSION['username'])) {
			$me=true;
			$username=$_SESSION['username'];
			$user_profile=$_SESSION['user_profile'];
		}else{
			$me=false;
			$pre_id=$_GET['id'];
			$username=$_GET['username'];

			$u_id=str_replace(" ", "_", $username);
			$u_id=$u_id."_";

			$id=$u_id.$pre_id;


			if ($conn->connect_error) {
				die($conn->connect_error);
			}

			$sql="SELECT * FROM medicares WHERE id=?";
			$stmt=$conn->prepare($sql);
			$stmt->bind_param("s",$id);
			$stmt->execute();

			$res=$stmt->get_result();
			if ($res->num_rows > 0) {
				$unavialble=false;
				$data=$res->fetch_assoc();
				$user_name=$data['username'];
				$user_profile=$data['profile'];

				if ($username!=$user_name) {
					$unavialble=true;
				}else{
					$unavialble=false;
				}
			}else{
				$unavialble=true;
			}
		}
		
	}


if (!$unavialble) {
	# code...

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $username; ?></title>
	<link rel="stylesheet" type="text/css" href="/Medicare/css/profile.css">
	<link rel="stylesheet" type="text/css" href="/Medicare/css/communication.css">
	<link rel="icon" type="image/png" href="<?php echo('/Medicare/'.$user_profile)?>">
	<script type="text/javascript" src="/Medicare/js/basic.js"></script>
	<script type="text/javascript">
		function back(){
			window.history.back();
		}
		function _(eid){
			return document.getElementById(eid);
		}
		function __(qsl){
			return document.querySelector(qsl);
		}
		function changedd(){
			__('.description').style.display='block';
			__('.list nav').style.display='none';
			__('.list .er').style.display='none';
			var d=__('.des-content').innerHTML;
			if (d != 'No description to show !') {
				__('.description textarea').value=d;
			}
		}
		function dccc(){
			__('.description').style.display='none';
			__('.list nav').style.display='block';
			__('.list .er').style.display='block';
			__('.description textarea').value='';
			__('.description textarea').style.border='0';
			__('.description textarea').removeAttribute('disabled');
			__('.description h5').innerHTML='0/150';
		}
		function ddd(username){
			var content =__('.description textarea').value;
			content=content.replace(/  /g," [sp]");
			content=content.replace(/\n/g," [nl]");
			console.log(content.length);
			if (content.length < 50) {
				alert("Your account description must stronger. Please Add more letter...");
				__('.description textarea').style.border='2px solid red';
			}else{
				__('.description').style.display='none';
			__('.list nav').style.display='block';
			__('.ded').style.display='none';
			__('.list nav span').innerHTML="<center>Loading...</center>";
			var ajax=new XMLHttpRequest();
			ajax.open("POST","/Medicare/xml/change_desc.php?content="+encodeURIComponent(content),true);
			ajax.onreadystatechange=function(){
				if (ajax.readyState===4 && ajax.status===200) {
					var sts=ajax.responseText;
					sts=sts.replace("[sp]","&nbsp;")
					sts=sts.replace("[nl]","<br>")
				__('.list nav span').innerHTML=sts;
				dccc();
				}
			}
			ajax.send(null);
			}
			

		}
		var activity=true;
		function hideactivity(){
			if (activity) {
				__('.u-a').style.height='0px';
				__('.activity h3 .show').style.transform='rotate(270deg)';
				activity=false;
			}else{
				__('.activity ul').style.height='fit-content';
				__('.activity h3 .show').style.transform='rotate(0deg)';
				activity=true;
			}
		}

		var save=false;
		function hidesave(){
			if (save) {
				__('.u-s').style.height='0px';
				__('.save h3 .show').style.transform='rotate(270deg)';
				save=false;
			}else{
				__('.u-s').style.height='fit-content';
				__('.save h3 .show').style.transform='rotate(0deg)';
				save=true;
			}
		}

		var recent=false;
		function hiderecent(){
			if (recent) {
				__('.u-r').style.height='0px';
				__('.recent h3 .show').style.transform='rotate(270deg)';
				recent=false;
			}else{
				__('.u-r').style.height='fit-content';
				__('.recent h3 .show').style.transform='rotate(0deg)';
				recent=true;
			}
		}

		function setting() {
			__('.alert-box').style.display='block';
			__('.alert-in-box').style.display='flex';
		}
		function closeAlert() {
			__('.alert-box').style.display='none';
			__('.alert-in-box').style.display='none';
		}
		var dark=false;

		
function darkMood() {
	if (!dark) {
		_('dark').classList.toggle('active');
		document.body.style.background='#343434';
		document.body.style.color='#ffffff';
		__('a').style.color='#ffffff';
		__('.alert-in-box').style.backgroundColor='#343434';
		__('.alert-in-box').style.border='2px solid';
		__('.alert-in-box-header').style.backgroundColor='#ffffff9b';

		localStorage.setItem('mood','dark');

		dark=true;
	}else{
		_('dark').classList.toggle('active');
		//id
		document.body.style.background='';
		__('.alert-in-box').style.backgroundColor='#ffffff';
		__('.alert-in-box').style.border='none';

		document.body.style.color='';

		localStorage.removeItem('mood');

		dark=false;
	}
	
}
	</script>
</head>
<body>
	
		
	<div class="dis-main-body">
		<div class="dis-header">
			<div class="lf">
			<div class="p-v">
		<a href="/Medicare/Profile_view.php?username=<?php echo($username)?>&profile=<?php echo('/Medicare/'.$user_profile)?>"><img src="<?php echo('/Medicare/'.$user_profile)?>"></a>
			<span><h3><?php echo $username; ?></h3>
				<ul>
					<?php
					
					$get_level="SELECT * FROM user_account_status WHERE username=?";
					$stmtl=$conn->prepare($get_level);
					$stmtl->bind_param("s",$username);
					$stmtl->execute();
					$resultl=$stmtl->get_result();
					if ($resultl->num_rows > 0) {
						$datal=$resultl->fetch_assoc();
						$follower=$datal['follower'];
						$level=$datal['level'];
						$popularity=$datal['popularity'];

						if ($level == 0) {
							$a_status="Junior";
						}else if ($level == 1) {
							$a_status="Senior";
						}else if ($level == 2) {
							$a_status="Media";
						}else if ($level == 3) {
							$a_status="Channel";
						}

						if ($follower == 0) {
							$follower="";
						}
						if ($popularity == 0) {
							$popularity="";
						}
						

						?>
						<li><?php echo $popularity; ?>Popularity<label  class='emergency-icon'></label></li>
						<li><?php echo $follower; ?>Follower<label  class='emergency-icon'></label></li>
						<li><?php echo $a_status; ?><label  class='emergency-icon'></label></li>
						<?php
					}
					
					?>
				</ul>
				<div class="native">
				<?php
				if (isset($_GET['username'])) {
					?>
					
						<nav class="follow">Follow</nav>
						
					<?php
				}
			
			?>
			<nav class="chat"><span class="notification_active_in"></span></nav>
			<nav class="report"></nav>
			<?php
				if ($me) {
					?>
					<nav class="setting" onclick="setting()"></nav>
					<?php
				}
			
			?>		
			</div>
			</span>
			</div>
			
			<div class="list">
				<j class="description">
				<textarea class="descr" placeholder="Write your new Description"></textarea>
				<h5>0/150</h5>
				<button class="ddd" onclick="ddd('<?php echo($username)?>')">Done</button><button class="ccc" onclick="dccc()">Cancel</button>
				</j>
				<div class="er">
				<?php
					if ($me) {
						echo "<b class='ded' onclick='changedd()' title='Edit your description'><span class='notification_active_in'></span></b>";
					}
					?>
				<nav>
					
						<?php
							$sd=$conn->prepare("SELECT * FROM medicares WHERE username=?");
							$sd->bind_param("s",$username);
							$sd->execute();
							$result=$sd->get_result();
							if ($result->num_rows > 0) {
								$unavialble=false;
								$dd=$result->fetch_assoc();

								$desc=$dd['description'];
								$desc=preg_replace("#\[sp\]#", " &nbsp;", $desc);
								$desc=preg_replace("#\[nl\]#", " <br/>", $desc);
								$desc=preg_replace('"\b(https?://\S+)"', '<a href="$1" style="color:blue;">$1</a>', $desc);
							}else{
								$unavialble=true;
							}
							if ($desc != '') {
								?>
								<span class="des-content"><?php echo $desc; ?></span>
								<?php
							}else{	
								?>
								<span class="des-content">No description to show !</span>
								<?php
							}
						?>
					
				</nav>
				</div>
			</div>
			<?php
			if ($me) {
				# code...
			?>
			<div class="alert-in-p">
				<center><nav class="c-alert">
					Upgrade your account to get more chances...
				</nav></center>
			</div>
			<?php
			}
			?>
		</div>
		</div>
		<div class="dis-header-mi">
			<span class="m-p-h">My Plan</span>
			<div class="p-header">

				<div class="p-icon ">
					<div class="p-content">
					<div class="content-r">
					<a href="Plan-A">Plan(A)</a> : Normal Plan
					- free 5% of medical cost, inpatient care, emergency lone with 5% instrest 
					</div>
				</div></div>
				
			</div>
			<div class="p-body">

				<?php
				if ($me) {
					# code...
				?>

				<span class="b-p-h">Balancy</span>
				<ul>
					<li class="lone"><span>TopUp</span></li>
					<li class="lone"><span>Lone</span></li>
					<li class="lone"><span>Balance</span></li>
					<li class="service"><span>Service</span></li>
					<li class="help"><span>Help</span></li>
				</ul>
				<?php
				}
				?>
				<div class="alert-in-p">
				<center>
					<?php
						if ($me) {
							# code...

					?>
					<nav class="p-alert">
					We're protecting all your payment.
					If you think that your lone and balance having issue
					please <a href="contact-us">Contact us</a>.Thank for enroll medicares-plan!
				</nav>
				<?php
					}else{
						?>
						<nav class="p-s-alert">
							<span style="color: #234efd;"><strong><?php echo $username; ?></strong></span> is in medicares-plan.
							Are you in plan? If you're not in plan <strong>click to enroll special plan for you!</strong>
						</nav>
						<?php
					}
				?>
			</center>
			</div>
			</div>
		</div>
		<div class="dis-header-rg">
			<div class="activity">
				<h3 onclick="hideactivity()">Recents<img src="/Medicare/css/Img/s-show-icon.png" class="show"></h3>
				<ul class="u-a">

					<?php

						$get_act="SELECT * FROM `sar_tb` WHERE `username` = '$username' and `log_type`='recent' order by sar_id desc";
						$act_result=mysqli_query($conn,$get_act);
						$act_check = 0;
						if($act_result){
							$act_check=mysqli_num_rows($act_result);
						}
						

						if ($act_check > 0) {

							while ($row = mysqli_fetch_assoc($act_result)) {
								$post_id=$row['post_id'];
								$r_typ=$row['type'];

								$sl="SELECT * FROM `post` WHERE `post_id`='$post_id'";

								$sml=$conn->prepare($sl);
								$sml->execute();
								$res_sml=$sml->get_result();

								if ($res_sml->num_rows > 0) {
									$d=$res_sml->fetch_assoc();
									$msg=$d['message'];
									$date_d='<small>'.$d['post_date'].'</small>';
									$d_caption=$d['post_caption'];
									$poster_name=$d['poster_name'];


								}

								$sql_get_posterd="SELECT * FROM medicares where username=?";
								$poster_profile = '';
								if ($conn->connect_error) {
								die("Failed to connect : ".$conn->connect_error);
								}else{
								$stmt_get_posterd=$conn->prepare($sql_get_posterd);
								$stmt_get_posterd->bind_param("s",$poster_name);
								$stmt_get_posterd->execute();
								$stmt_result_gpd=$stmt_get_posterd->get_result();

								if ($stmt_result_gpd->num_rows>0) {
									$data_p=$stmt_result_gpd->fetch_assoc();
									$poster_profile=$data_p['profile'];
								}else{
									echo "Something wrong";
								}

								if ($poster_profile=='User_Profile/male_user.jpg') {
									$psf_id='001';
								}else if ($poster_profile=='User_Profile/femalepro.jpg') {
									$psf_id='010';
								}else{
									$pf=substr($poster_profile, strripos($poster_profile, "/")+1);
									$psf_id=substr($pf, 0,strripos($pf, "."));
								}
							}

								if ($r_typ == 'status') {

									$a_href="/Medicare/view.php?id=$post_id&psf=$psf_id&typ=$r_typ";

									$msg=preg_replace("#\[sp\]#", " &nbsp;", $msg);
									$msg=preg_replace("#\[nl\]#", " <br/>", $msg);
								/*	$msg=preg_replace('"\b(https?://\S+)"', '<a href="$1">$1</a>', $msg);*/
									if (strlen($msg) > 50) {
										$msg=substr($msg, 0,50).'...<small><i>see more</i></small>';
									}
									$img_src='/Medicare/css/Img/qa_active.png';
									if ($me) {
										$msg_dis='<strong style="color:#00bcd4;">Q/A</strong><br>'.$msg;
									}else{
										$msg_dis='<strong style="color:#00bcd4;">Q/A</strong><br>'.$msg;
									}

								}
								if ($r_typ == 'photo') {
									$img_src='/Medicare/'.$msg;

									$a_href="/Medicare/view.php?id=$post_id&psf=$psf_id&typ=$r_typ";

									$d_caption=preg_replace("#\[sp\]#", " &nbsp;", $d_caption);
									$d_caption=preg_replace("#\[nl\]#", " <br/>", $d_caption);
								/*	$d_caption=preg_replace('"\b(https?://\S+)"', '<a href="$1">$1</a>', $d_caption);*/
									if (strlen($d_caption) > 50) {
										$d_caption=substr($d_caption, 0,50).'...<small><i>see more</i></small>';
									}
									if ($me) {
										$msg_dis='<strong style="color:#00bcd4;">photo</strong><br>'.$d_caption;
									}else{
										$msg_dis='<strong style="color:#00bcd4;">photo</strong><br>'.$d_caption;
									}
								}

								if ($r_typ == 'shop') {
									$img_src='/Medicare/'.$msg;
									$d_caption=preg_replace("#\[sp\]#", " &nbsp;", $d_caption);
									$d_caption=preg_replace("#\[nl\]#", " <br/>", $d_caption);
							/*		$d_caption=preg_replace('"\b(https?://\S+)"', '<a href="$1">$1</a>', $d_caption);*/



									$a_href="/Medicare/view.php?id=$post_id&psf=$psf_id&typ=$r_typ";

									if (strlen($d_caption) > 50) {
										$d_caption=substr($d_caption, 0,50).'...<small><i>see more</i></small>';
									}
									if ($me) {
										$msg_dis='<strong style="color:#00bcd4;">shopping-post</strong><br>'.$d_caption;
									}else{
										$msg_dis='<strong style="color:#00bcd4;">shopping-post</strong><br>'.$d_caption;
									}
								}

								if ($r_typ == 'news') {
									$pre=$msg;
									

									$news_header=substr($d_caption, 0, stripos($d_caption, '*')); 
									$ec=substr($d_caption, stripos($d_caption, "*")+1);
									$writer=substr($ec, 0, stripos($ec, '*'));
									$comment = substr($ec,stripos($ec, '*')+1);
									$ps_caption=substr($ec, 0, stripos($ec, '*')); 
									$get_url=substr($pre, 0,stripos($pre, "-")+1);
									$n=substr($get_url, 8);
									$npf=substr($n, 0,stripos($n, "."));
									
									$ps_caption=preg_replace("#\[sp\]#", " &nbsp;", $ps_caption);
									$ps_caption=preg_replace("#\[nl\]#", " <br/>", $ps_caption);
									$ps_caption=preg_replace('"\b(https?://\S+)"', '<a href="$1" style="color:blue;">$1</a>', $ps_caption);
									$ps_caption="<span class='post-caption'>$ps_caption</span>";
									$post_type='new-postt';
									$news_content=substr($pre, 0, stripos($pre, '-')); 
									$get_img_src=substr($pre, strripos($pre, "-")+1);
									$get_img_src="/Medicare/xml/".$get_img_src;
									if(!is_file($root.$get_img_src)){
										$img_src = "/Medicare/css/img/news_active.png";
									}else{
										$img_src = $get_img_src;

									}

									
									$a_href="/Medicare/Magazine/?id=$post_id&npf=$npf&title=$news_header";


									if (strlen($comment) > 10) {
											$comment=substr($comment, 0,10).'...<small>See more</small>';
										}
										$ps_caption = "<br><strong><span style='color:#00bcd4'>Title</span> : ".$news_header."</strong>"."<strong><span style='color:#00bcd4'>Writer</span> : ".$writer."</strong>"."<strong><span style='color:#00bcd4'>Description</span> : ".$comment."</strong>";
									
									if ($me) {
										$msg_dis='<strong style="color:#00bcd4;"><i>'.$news_header.'</i> - Magazine</strong> '.$ps_caption;
									}else{
										$msg_dis='<strong style="color:#00bcd4;"><i>'.$news_header.'</i> - Magazine</strong>'.$ps_caption;
									}
								}


								?>
									<li><a href="<?php echo($a_href) ?>" class="block-f"><nav style="background: url(<?php echo($img_src) ?>) no-repeat;background-size: 90%;	background-position:5px 5px;"></nav><p>
										<?php echo $msg_dis; ?><br><span class="timer"><small><?php echo $date_d; ?></small></span> </p></a></li>
								<?php

							}

						}else{
							echo "<center style='color: #00bcd4; padding: 10px 0px;'>No recent</center>";
						}

					?>
				</ul>
			</div>
			<?php
			if ($me) {
			?>
			<div class="save">
				<h3 onclick="hidesave()">saves<img src="/Medicare/css/Img/s-show-icon.png" class="show" style="transform: rotate(270deg);"></h3>
				<ul class="u-s">
					<?php

						$get_act="SELECT * FROM `sar_tb` WHERE `username` = '$username' and `log_type`='save' order by sar_id desc";
						$act_result=mysqli_query($conn,$get_act);
						$act_check = 0;
						if($act_result){
							$act_check=mysqli_num_rows($act_result);
						}
						
						if ($act_check > 0) {

							while ($row = mysqli_fetch_assoc($act_result)) {
								$post_id=$row['post_id'];
								$r_typ=$row['type'];

								$sl="SELECT * FROM `post` WHERE `post_id`='$post_id'";

								$sml=$conn->prepare($sl);
								$sml->execute();
								$res_sml=$sml->get_result();

								if ($res_sml->num_rows > 0) {
									$d=$res_sml->fetch_assoc();
									$msg=$d['message'];
									$date_d=$d['post_date'];
									$d_caption=$d['post_caption'];
									$poster_name=$d['poster_name'];


								}

								$sql_get_posterd="SELECT * FROM medicares where username=?";

								if ($conn->connect_error) {
								die("Failed to connect : ".$conn->connect_error);
								}else{
								$stmt_get_posterd=$conn->prepare($sql_get_posterd);
								$stmt_get_posterd->bind_param("s",$poster_name);
								$stmt_get_posterd->execute();
								$stmt_result_gpd=$stmt_get_posterd->get_result();

								if ($stmt_result_gpd->num_rows>0) {
									$data_p=$stmt_result_gpd->fetch_assoc();
									$poster_profile=$data_p['profile'];
								}else{
									echo "Something wrong";
								}

								if ($poster_profile=='User_Profile/male_user.jpg') {
									$psf_id='001';
								}else if ($poster_profile=='User_Profile/femalepro.jpg') {
									$psf_id='010';
								}else{
									$pf=substr($poster_profile, strripos($poster_profile, "/")+1);
									$psf_id=substr($pf, 0,strripos($pf, "."));
								}
							}

								if ($r_typ == 'status') {

									$a_href="/Medicare/view.php?id=$post_id&psf=$psf_id&typ=$r_typ";

									$msg=preg_replace("#\[sp\]#", " &nbsp;", $msg);
									$msg=preg_replace("#\[nl\]#", " <br/>", $msg);
								/*	$msg=preg_replace('"\b(https?://\S+)"', '<a href="$1">$1</a>', $msg);*/
									if (strlen($msg) > 50) {
										$msg=substr($msg, 0,50).'...<small><i>see more</i></small>';
									}
									$img_src='/Medicare/css/Img/qa_active.png';
									if ($me) {
										$msg_dis='<strong style="color:#00bcd4;">Q/A</strong><small style="color: #e91e63;"><i>saved</i></small><br>'.$msg;
									}else{
										$msg_dis='<strong style="color:#00bcd4;">Q/A</strong><small style="color: #e91e63;"><i>saved</i></small><br>'.$msg;
									}

								}
								if ($r_typ == 'photo') {
									$img_src='/Medicare/'.$msg;

									$a_href="/Medicare/view.php?id=$post_id&psf=$psf_id&typ=$r_typ";

									$d_caption=preg_replace("#\[sp\]#", " &nbsp;", $d_caption);
									$d_caption=preg_replace("#\[nl\]#", " <br/>", $d_caption);
								/*	$d_caption=preg_replace('"\b(https?://\S+)"', '<a href="$1">$1</a>', $d_caption);*/
									if (strlen($d_caption) > 50) {
										$d_caption=substr($d_caption, 0,50).'...<small><i>see more</i></small>';
									}
									if ($me) {
										$msg_dis='<strong style="color:#00bcd4;">photo</strong><small style="color: #e91e63;"><i>saved</i></small><br>'.$d_caption;
									}else{
										$msg_dis='<strong style="color:#00bcd4;">photo</strong><small style="color: #e91e63;"><i>saved</i></small><br>'.$d_caption;
									}
								}

								if ($r_typ == 'shop') {
									$img_src='/Medicare/'.$msg;
									$d_caption=preg_replace("#\[sp\]#", " &nbsp;", $d_caption);
									$d_caption=preg_replace("#\[nl\]#", " <br/>", $d_caption);
								/*	$d_caption=preg_replace('"\b(https?://\S+)"', '<a href="$1">$1</a>', $d_caption);*/



									$a_href="/Medicare/view.php?id=$post_id&psf=$psf_id&typ=$r_typ";

									if (strlen($d_caption) > 50) {
										$d_caption=substr($d_caption, 0,50).'...<small><i>see more</i></small>';
									}
									if ($me) {
										$msg_dis='<strong style="color:#00bcd4;">shopping-post</strong><small style="color: #e91e63;"><i>saved</i></small><br>'.$d_caption;
									}else{
										$msg_dis='<strong style="color:#00bcd4;">shopping-post</strong><small style="color: #e91e63;"><i>saved</i></small><br>'.$d_caption;
									}
								}

								if ($r_typ == 'news') {
									$pre=$msg;
									$news_header=substr($d_caption, 0, stripos($d_caption, '*')); 
									$ec=substr($d_caption, stripos($d_caption, "*")+1);
									$writer=substr($ec, 0, stripos($ec, '*'));
									$comment = substr($ec,stripos($ec, '*')+1);
									$ps_caption=substr($ec, 0, stripos($ec, '*')); 
									$get_url=substr($pre, 0,stripos($pre, "-")+1);
									$n=substr($get_url, 8);
									$npf=substr($n, 0,stripos($n, "."));
									
									$ps_caption=preg_replace("#\[sp\]#", " &nbsp;", $ps_caption);
									$ps_caption=preg_replace("#\[nl\]#", " <br/>", $ps_caption);
									$ps_caption=preg_replace('"\b(https?://\S+)"', '<a href="$1" style="color:blue;">$1</a>', $ps_caption);
									$ps_caption="<span class='post-caption'>$ps_caption</span>";
									$post_type='new-postt';
									$news_content=substr($pre, 0, stripos($pre, '-')); 
									$get_img_src=substr($pre, strripos($pre, "-")+1);
									$get_img_src="/Medicare/xml/".$get_img_src;
									if(!is_file($root.$get_img_src)){
										$img_src = "/Medicare/css/img/news_active.png";
									}else{
										$img_src = $get_img_src;

									}



									$a_href="/Medicare/Magazine/?id=$post_id&npf=$npf&title=$news_header";


									if (strlen($comment) > 10) {
											$comment=substr($comment, 0,10).'...<small>See more</small>';
										}
										$ps_caption = "<br><strong><span style='color:#00bcd4'>Title</span> : ".$news_header."</strong>"."<strong><span style='color:#00bcd4'>Writer</span> : ".$writer."</strong>"."<strong><span style='color:#00bcd4'>Description</span> : ".$comment."</strong>";
									
									if ($me) {
										$msg_dis='<strong style="color:#00bcd4;"><i>'.$news_header.'</i> - Magazine</strong><small style="color: #e91e63;"><i>saved</i></small>'.$ps_caption;
									}else{
										$msg_dis='<strong style="color:#00bcd4;"><i>'.$news_header.'</i> - Magazine</strong><small style="color: #e91e63;"><i>saved</i></small>'.$ps_caption;
									}
								}


								?>
									<li><a href="<?php echo($a_href) ?>" class="block-f"><nav style="background: url(<?php echo($img_src) ?>) no-repeat;background-size: 90%;	background-position:5px 5px;"></nav><p><?php echo $msg_dis; ?><br><span class="timer"><small><?php echo $date_d; ?></small></span> </p></a></li>
								<?php

							}

						}else{
							echo "<center style='color: #00bcd4; padding: 10px 0px;'>No saved item.</center>";
						}

					?>
				</ul>
			</div>
			<div class="recent">
				<h3 onclick="hiderecent()">Activities<img src="/Medicare/css/Img/s-show-icon.png" class="show" style="transform: rotate(270deg);"></h3>
				<ul class="u-r">
					<?php

						$get_act="SELECT * FROM `sar_tb` WHERE `username` = '$username' and `log_type`='activity' order by sar_id desc";
						$act_result=mysqli_query($conn,$get_act);
						$act_check = 0;
						if($act_result){
							$act_check=mysqli_num_rows($act_result);
						}
						
						if ($act_check > 0) {

							while ($row = mysqli_fetch_assoc($act_result)) {
								$post_id=$row['post_id'];
								$r_typ=$row['type'];
								$lc=substr($r_typ, stripos($r_typ, "/")+1);
								$r_typ=substr($r_typ, 0,stripos($r_typ, "/"));
								


								$sl="SELECT * FROM `post` WHERE `post_id`='$post_id'";

								$sml=$conn->prepare($sl);
								$sml->execute();
								$res_sml=$sml->get_result();

								if ($res_sml->num_rows > 0) {
									$d=$res_sml->fetch_assoc();
									$msg=$d['message'];
									$date_d=$d['post_date'];
									$d_caption=$d['post_caption'];
									$poster_name=$d['poster_name'];
								}

								$sql_get_posterd="SELECT * FROM medicares where username=?";

								if ($conn->connect_error) {
								die("Failed to connect : ".$conn->connect_error);
								}else{
								$stmt_get_posterd=$conn->prepare($sql_get_posterd);
								$stmt_get_posterd->bind_param("s",$poster_name);
								$stmt_get_posterd->execute();
								$stmt_result_gpd=$stmt_get_posterd->get_result();

								if ($stmt_result_gpd->num_rows>0) {
									$data_p=$stmt_result_gpd->fetch_assoc();
									$poster_profile=$data_p['profile'];
								}else{
									echo "Something wrong";
								}

								if ($poster_profile=='User_Profile/male_user.jpg') {
									$psf_id='001';
								}else if ($poster_profile=='User_Profile/femalepro.jpg') {
									$psf_id='010';
								}else{
									$pf=substr($poster_profile, strripos($poster_profile, "/")+1);
									$psf_id=substr($pf, 0,strripos($pf, "."));
								}
							}

								if ($r_typ == 'status') {
									$a_href="/Medicare/view.php?id=$post_id&psf=$psf_id&typ=$r_typ";

									$msg=preg_replace("#\[sp\]#", " &nbsp;", $msg);
									$msg=preg_replace("#\[nl\]#", " <br/>", $msg);
							/*		$msg=preg_replace('"\b(https?://\S+)"', '<a href="$1">$1</a>', $msg);*/
									if (strlen($msg) > 50) {
										$msg=substr($msg, 0,50).'...<small><i>see more</i></small>';
									}
									$img_src='/Medicare/css/Img/qa_active.png';
									if ($me) {
										$msg_dis='<strong style="color:#00bcd4;">Q/A</strong><small style="color: #e91e63;"><i>'.$lc.'</i></small><br>'.$msg;
									}else{
										$msg_dis='<strong style="color:#00bcd4;">Q/A</strong><small style="color: #e91e63;"><i>'.$lc.'</i></small><br>'.$msg;
									}

								}
								if ($r_typ == 'photo') {
									$img_src='/Medicare/'.$msg;
									$a_href="/Medicare/view.php?id=$post_id&psf=$psf_id&typ=$r_typ";
									$d_caption=preg_replace("#\[sp\]#", " &nbsp;", $d_caption);
									$d_caption=preg_replace("#\[nl\]#", " <br/>", $d_caption);
							/*		$d_caption=preg_replace('"\b(https?://\S+)"', '<a href="$1">$1</a>', $d_caption);*/
									if (strlen($d_caption) > 50) {
										$d_caption=substr($d_caption, 0,50).'...<small><i>see more</i></small>';
									}
									if ($me) {
										$msg_dis='<strong style="color:#00bcd4;">photo</strong><small style="color: #e91e63;"><i>'.$lc.'</i></small><br>'.$d_caption;
									}else{
										$msg_dis='<strong style="color:#00bcd4;">photo</strong><small style="color: #e91e63;"><i>'.$lc.'</i></small><br>'.$d_caption;
									}
								}

								if ($r_typ == 'shop') {
									$a_href="/Medicare/view.php?id=$post_id&psf=$psf_id&typ=$r_typ";
									$img_src='/Medicare/'.$msg;
									$d_caption=preg_replace("#\[sp\]#", " &nbsp;", $d_caption);
									$d_caption=preg_replace("#\[nl\]#", " <br/>", $d_caption);
							/*		$d_caption=preg_replace('"\b(https?://\S+)"', '<a href="$1">$1</a>', $d_caption);*/

									if (strlen($d_caption) > 50) {
										$d_caption=substr($d_caption, 0,50).'...<small><i>see more</i></small>';
									}
									if ($me) {
										$msg_dis='<strong style="color:#00bcd4;">shopping-post</strong><small style="color: #e91e63;"><i>'.$lc.'</i></small><br>'.$d_caption;
									}else{
										$msg_dis='<strong style="color:#00bcd4;">shopping-post</strong><small style="color: #e91e63;"><i>'.$lc.'</i></small><br>'.$d_caption;
									}
								}

								if ($r_typ == 'news') {
									$pre=$msg;
									$news_header=substr($d_caption, 0, stripos($d_caption, '*')); 
									$ec=substr($d_caption, stripos($d_caption, "*")+1);
									$writer=substr($ec, 0, stripos($ec, '*'));
									$comment = substr($ec,stripos($ec, '*')+1);
									$ps_caption=substr($ec, 0, stripos($ec, '*')); 
									$get_url=substr($pre, 0,stripos($pre, "-")+1);
									$n=substr($get_url, 8);
									$npf=substr($n, 0,stripos($n, "."));
									
									$ps_caption=preg_replace("#\[sp\]#", " &nbsp;", $ps_caption);
									$ps_caption=preg_replace("#\[nl\]#", " <br/>", $ps_caption);
									$ps_caption=preg_replace('"\b(https?://\S+)"', '<a href="$1" style="color:blue;">$1</a>', $ps_caption);
									$ps_caption="<span class='post-caption'>$ps_caption</span>";
									$post_type='new-postt';
									$news_content=substr($pre, 0, stripos($pre, '-')); 
									$get_img_src=substr($pre, strripos($pre, "-")+1);
									$get_img_src="/Medicare/xml/".$get_img_src;
									if(!is_file($root.$get_img_src)){
										$img_src = "/Medicare/css/img/news_active.png";
									}else{
										$img_src =$get_img_src;

									}



									$a_href="/Medicare/Magazine/?id=$post_id&npf=$npf&title=$news_header";

									if (strlen($comment) > 10) {
											$comment=substr($comment, 0,10).'...<small>See more</small>';
										}
										$ps_caption = "<br><strong><span style='color:#00bcd4'>Title</span> : ".$news_header."</strong>"."<strong><span style='color:#00bcd4'>Writer</span> : ".$writer."</strong>"."<strong><span style='color:#00bcd4'>Description</span> : ".$comment."</strong>";
									if ($me) {
										$msg_dis='<strong style="color:#00bcd4;"><i>'.$news_header.'</i> - Magazine</strong> <small style="color: #e91e63;"><i>'.$lc.'</i></small>'.$ps_caption;
									}else{
										$msg_dis='<strong style="color:#00bcd4;"><i>'.$news_header.'</i> - Magazine</strong><small style="color: #e91e63;"><i>'.$lc.'</i></small>'.$ps_caption;
									}

									$get_url=substr($msg, stripos($msg, "-")+1);
									$n=substr($get_url, stripos($get_url, "_")+1);
									$npf=substr($n, 0,stripos($n, "."));

								}


								?>
									<li><a href="<?php echo($a_href) ?>" class="block-f">
				<nav style="background: url(<?php echo($img_src)?>) no-repeat;background-size: 90%;background-position: 5px 5px;"></nav>
				<p><?php echo $msg_dis; ?><br><span class="timer"><small><?php echo $date_d; ?></small></span></p>
								</a></li>
								<?php

							}

						}else{
							echo "<center style='color: #00bcd4; padding: 10px 0px;'>No Activity</center>";
						}

					?>
				</ul>
			</div>
				<?php
				}
			 ?>
		</div>
	</div>
	<div class="header">
			<span class="back" onclick="back()">Back</span>
			
				<span class="search" title="search here"></span>
		</div>
	<div class="alert-box" onclick="closeAlert()"></div>	
	<div class="alert-in-box">
		<div class="alert-in-box-header">
			<h3>Setting</h3>
			<h4 onclick="closeAlert()" title="close"></h4>
		</div>
		<div class="alert-in-box-body">
			<ul>
				<li><span>Dark Mood</span> <label id='dark' onclick='darkMood()'></label></li>
			</ul>
		</div>
	</div>
<script>
	
	var descr=__('.descr');
	descr.addEventListener('input',function(){
		if (__('.description textarea').value.length < 151) {
		__('.description h5').innerHTML=__('.description textarea').value.length+'/150';
	}else{
		__('.description textarea').setAttribute('disabled','disabled');
	}
	});

</script>
</body>
</html>
<?php

	}else{
		
		include "{$root}/Medicare/error_log/ajax_request_rejection.errj9";
		
	}

?>