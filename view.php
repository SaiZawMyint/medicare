<?php
	

	session_start();
	include_once 'xml/databases/dbconnections.php';
	include 'xml/functions.php';

	$unavailable;
	$com_footer='';

	if (!isset($_GET['id']) || !isset($_GET['psf']) || !isset($_GET['typ'])) {
		$unavailable=true;
	}else{
		$unavailable=false;

		$ps_id=$_GET['id'];
		$pf=$_GET['psf'];
		$ptyp=$_GET['typ'];
		
		$sql="SELECT * FROM `post` where post_id=?";

		if ($conn->connect_error) {
			die("Failed to connect : ".$conn->connect_error);
		}else{

			$stmt=$conn->prepare($sql);
			$stmt->bind_param("s",$ps_id);
			$stmt->execute();
			$result=$stmt->get_result();

			if ($result->num_rows > 0) {
				$unavailable=false;
				$data=$result->fetch_assoc();
				$poster_name=$data['poster_name'];
				$post_id=$data['post_id'];
				$type=$data['type'];
				$post_date=$data['post_date'];
				$message=$data['message'];
				$post_caption=$data['post_caption'];
				$post_caption=preg_replace("#\[sp\]#", " &nbsp;", $post_caption);
				$post_caption=preg_replace("#\[nl\]#", " <br/>", $post_caption);
				$post_caption=preg_replace('"\b(https?://\S+)"', '<a href="$1">$1</a>', $post_caption);

				$sqlf="SELECT * FROM medicares WHERE username=?";

				$stmt=$conn->prepare($sqlf);
				$stmt->bind_param("s",$poster_name);
				$stmt->execute();
				$ref=$stmt->get_result();
				if ($ref->num_rows > 0) {
					$unavailable=false;

					$df=$ref->fetch_assoc();
					$poster_profile=$df['profile'];

					if ($poster_profile=='User_Profile/male_user.jpg') {
						$psf_id='001';
					}else if ($poster_profile=='User_Profile/femalepro.jpg') {
						$psf_id='010';
					}else{
						$pp=substr($poster_profile, strripos($poster_profile, "/")+1);
						$psf_id=substr($pp, 0,strripos($pp, "."));
					}

					
				}else{
					$unavailable=true;
				}

				
				if ($psf_id != $pf || $ptyp != $type) {
						$unavailable=true;
				}else{
					$unavailable=false;
				}



				$getlike=loadLike($post_id);
				$username=isset($_SESSION['username']) ? $_SESSION['username'] : '';

				if ($username=='') {
					$head_li="<form action='Login.php' method='POST'><input type='text' name='rd' value='view.php?id=$ps_id&psf=$pf&typ=$type' hidden><input type='submit' class='login-req-btn' value='Join Us'></form>";
					$com_footer="<div style='width:33.333%'></div><div  style='width:33.333%'><form action='Login.php' method='POST'><input type='text' name='rd' value='view.php?id=$ps_id&psf=$pf&typ=$type' hidden><input type='submit' class='login-req-btn' value='Join Us'></form></div><div style='width:33.333%'></div>";
				}else{
					$head_li="<li class='chat' title='chat with poster'></li><li class='report' title='report post'></li>";

					$com_footer="<textarea id='comment' placeholder='Write comment here ...'></textarea>".
						"<input type='text' id='username' value='$username' hidden>".
						"<input type='text' id='poster_name' value='$poster_name' hidden>".
						"<button onclick='submitComment($post_id)' class='sub-com'></button>";

					if ($username == $poster_name) {
						$esd="post-det";
					}else{

						$get_save="SELECT * FROM `sar_tb` WHERE `post_id`='$post_id' and `log_type`='save' and `username`='$username'";
						$stmt_save=$conn->prepare($get_save);
						$stmt_save->execute();
						$result_save=$stmt_save->get_result();

						$saver='';

						if ($result_save->num_rows > 0) {
							$esd="post-saved";
							$on_es="";
						}else{
							$esd="post-save";
							$on_es="save_view(".$post_id.",`".$type."`)";
						}

					}

				}



				if ($type=='status') {
					$ps_caption='';
					$message=preg_replace("#\[sp\]#", " &nbsp;", $message);
					$message=preg_replace("#\[nl\]#", " <br/>", $message);
					$message=preg_replace('"\b(https?://\S+)"', '<a href="$1">$1</a>', $message);

					$msg_display="<p>$message</message>";
				}
				if ($type=='photo') {
					$msg_display="<img src='$message'>";
					$ps_caption="<div class='post-caption'>$post_caption</div>";
				}
				if ($type=='shop') {
					$msg_display="<img src='$message'>";
					$ps_caption="<div class='post-caption'>$post_caption</div>";

				}

				$getcomment=loadComment($post_id);
				if ($getcomment>1) {
					$getcomment=$getcomment.'coms';
				}else{
					if ($getcomment == 1) {
						$getcomment=$getcomment.'com';
						if ($getcomment > 1) {
							$getcomment=$getcomment.'coms';
						}
					}
					else{
						$getcomment='Comment';
					}
				}
		$cutInt=substr($getcomment, 0,stripos($getcomment, " "));


			}else{
				$unavailable=true;
			}
		}

		if(isset($_SESSION['username'])){
			$log=true;
		}else{
			$log=false;
		}		
	}

	if (!$unavailable) {
		
	

?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $poster_name."'s post"; ?></title>
	<link rel="stylesheet" type="text/css" href="css/communication.css">
	<script type="text/javascript" src="js/communication.js"></script>
	<link rel="stylesheet" type="text/css" href="css/view.css">
	<script type="text/javascript" src="js/basic.js"></script>
	<link rel="icon" type="image/png" href="<?php echo($poster_profile) ?>">
	<script type="text/javascript">
		function _(eid) {
			return document.getElementById(eid);
		}
		function __(qsl) {
			return document.querySelector(qsl)
		}
		function viewCom() {
			var scroll=__('.view-cm');
  			scroll.scrollIntoView({behavior: 'smooth',block: 'end'});
  			__('.view-cm-footer').style.display='flex';

		}
		function save_view(post_id,status) {
			var ajax=new XMLHttpRequest();
			ajax.open('POST','xml/save.php?id='+post_id+'&typ='+status,true);
			ajax.onreadystatechange=function(){
		if(ajax.readyState==4 && ajax.status == 200){
			_('save_'+post_id).classList.remove('post-save');
			_('save_'+post_id).classList.add('post-saved');
			_('save_'+post_id).removeAttribute('onclick');
		}
	}
	ajax.send(null);
		}
	</script>
</head>
<body>
	<div class="m-header" id="hi-he">
		<span class="back" onclick="back()">Back</span>
		<ul>
			<?php echo $head_li; ?>
		</ul>
	</div>
	<div class="m-views">
		
<div class='poster-field'>
				<div id='poster-header'>
				<a href='#' class='user-prof' class='ps-header'>
				<img src='<?php echo($poster_profile) ?>' class='prof'>
				</a>
				<span class='user-name'><a href='#' class='ps-header'><?php echo $poster_name;?></a></span>
				<span id="save_<?php echo($post_id)?>" class='<?php echo($esd) ?>' onclick='<?php echo $on_es; ?>'></span>
				<span class='post-type $post_type'><?php echo $post_date;?></span>
				</div>
				<div id='poster-body'>
				<?php echo $msg_display;?>
				<?php
					if ($type=='shop') {
						?>
						<div class="related_shop">
							<h3>Related Items....</h3>
							<nav>
							<?php

								$getpname="SELECT * from `shop` where id='$post_id' limit 1;";
								$stmtp=$conn->prepare($getpname);
								$stmtp->execute();
								$resp=$stmtp->get_result();
								if ($resp->num_rows > 0) {
									$dsp=$resp->fetch_assoc();
									$name=$dsp['name'];
									$prices=$dsp['prices'];
									$method=$dsp['payment'];
									$cut_method=substr($method, 0,strripos($method, '/'));
									$ary=explode('/', $cut_method);
									
								}
						
								$getrel="SELECT * FROM post,shop WHERE post.post_id!='$post_id' and post.type='shop' and post.post_caption like '%$post_caption%' and shop.name like '%$name%' LIMIT 3";
								$res_rel=mysqli_query($conn,$getrel);
								if (!$res_rel) {
									echo mysqli_error($conn);
								}
								$result_check=mysqli_num_rows($res_rel);

								if ($result_check > 0) {
									while ($row = mysqli_fetch_assoc($res_rel)) {
										$psc=$row['post_caption'];
										$msg=$row['message'];
										?>
										<a href="shop.php?rel=<?php echo($pf) ?>" class="item" style="background: url(<?php echo $msg; ?>) no-repeat;background-position: center;background-size: 100% 100%;"><span class="labels"></span></a>
										<?php
									}
									?>
									<a href="shop.php" class="item"><span class="labels"><span class="exp">More Shop</span></span></a>
									<?php
								}else{
									?>
									<a href="shop.php" class="item"><span class="labels"><span class="exp">More Shop</span></span></a>
									<?php
								}

							?>
						</nav>
						</div>
						<div class="s-s-o">
							<?php
							echo "<div class='s-s-i'>$name<br>$prices</div><br><small>Availabel payments</small><br>";
									foreach ($ary as $value) {
										echo "<span class='{$value}'></span>";
									}
									
							?>
						</div>
						<?php
					}else{
						echo '';
					}
				?>
				</div>
				<div><?php echo $ps_caption;?></div>
				<div id='poster-footer'>
				<div class='p-r'>
			<!--	<div class='support-i'></div>
				<div class='comment-i'></div>
				<div class='share-i'></div> -->
				<?php
					if ($type=='shop') {
						?>
						<div class="rel-shop">Shop now</div>
						<?php
					}
				?>
				<div id='scs_res'></div>
				</div>
				<div class='reaction-f'>
					<?php
				$guesss_user_like=mysqli_query($conn,"SELECT * FROM likes where giver='$username' AND post_id=$post_id");

				if (mysqli_num_rows($guesss_user_like) == 1) {
					?>
						<div class="like_added" id="<?php echo($post_id)?>" onclick='unLike(<?php echo $post_id; ?>,<?php echo $log; ?>)'><?php echo $getlike; ?></div>
					<?php
				}else{
					?>
						<div class="donate" id="<?php echo($post_id)?>" onclick='addLike(<?php echo $post_id; ?>,<?php echo $log; ?>)'><?php echo $getlike; ?></div>
					<?php
				}
				?>

			<input type="text" id="cmc_<?php echo($post_id)?>" value="<?php echo($cutInt)?>" hidden>			
			<div id="comment_<?php echo($post_id)?>" onclick='viewCom()' class='comment'><?php echo $getcomment; ?></div>
				<div class='share'>Share
				<div class='s-option'>
				<span class='f' title='share to facebook'></span>
				<span class='t' title='share to twiter'></span>
				<span class='l' title='copy link'></span>
				</div>
				</div>
				</div>
				</div>
				</div>
				<div id="status"></div>
				<div class="view-cm">
					<div class="comment-body">
						<?php load($post_id);?>
					</div>
				</div>
				
				</div>
				<div class="view-cm-footer">
						<?php echo $com_footer; ?>
				</div>
				<div id="noti-in-body" onclick="close_noti()"></div>
				<div id="noti-box-in-body" class="alert-in-box">
	<div class="alert-in-box-header"></div>
	<div id='dark' style="display: none;"></div>
</div>

</body>
</html>
<?php
}else{
if (is_file('error_log/ajax_request_rejection.errj9')) {
			$content_f=file_get_contents('error_log/ajax_request_rejection.errj9');
			echo $content_f;
		}else{
			echo "no file";
		}
}
?>