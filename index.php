<!DOCTYPE html>
<html>
<head>
	<title>Communication</title>
	 <link rel="stylesheet" type="text/css" href="css/communication.css">
	  <link rel="stylesheet" type="text/css" href="css/comment.css">
	 <script type="text/javascript" src="js/communication.js"></script>
	 <script type="text/javascript" src="js/basic.js"></script>
	<link rel="icon" type="image/png" href="css/Img/medicare_dot.png">
	<meta charset="utf-8">
	<script>

	</script>
</head>
<?php

	header('Cache-Control: no cache');
	session_cache_limiter('private_no_expire');

	session_start();

?>
<body>
<?php
	include_once('xml/databases/dbconnections.php');
	include 'xml/functions.php';
	$username="";
	$loginstatus="";
	$userprofile="";
	$user_id="";
	$src_prof="";
	$lf_prof_field="";
	$post_id="";

	if (!isset($_SESSION['username'])) {
		$username="Please login";
		$loginstatus="<form action='Login.php' method='POST'><input type='text' name='rd' value='/Medicare/' hidden><input type='submit' class='login-req-btn' value='Login'></form>";
		$src_prof="css/Img/alert_i.png";
		$userprofile="<img src='css/Img/alert_i.png' width='100%' height='100%' class='prof'>";
		$lf_prof_field=
		"<div class='login-req'>".
		"<h2>Please Login to enjoy more..</h2><br><br>".
		"<form action='Login.php' method='POST'><input type='text' name='rd' value='/Medicare/' hidden><input type='submit' class='login-req-btn' value='Go to Login'></form>".
		"</div>";
		$rg_prof_field=
		"<div class='login-req'>".
		"<h2>New user? Registration here..</h2><br><br>".
		"<form action='create.php' method='POST'><input type='text' name='rd' value='/Medicare/' hidden><input type='submit' class='login-req-btn' value='Registration'></form>".
		"</div>";
	}else{
		$username=$_SESSION['username'];
		
		$_SESSION['username']=$username;
		$loginstatus=
		"<a href='Post.php?type=status'><li class='custom-post'></li></a><a href='Post.php?type=photo'><li class='photo-post'></li></a><a href='Post.php?type=shop'><li class='shop-post'></li></a><a href='MagazineEditor.php'><li class='news-post'></li></a>";

		$sqli="SELECT * FROM medicares where username=?";

		if ($conn->connect_error) {
		die("Failed to connect : ".$conn->connect_error);
		}else{
		$stmt=$conn->prepare($sqli);
		$stmt->bind_param("s",$username);
		$stmt->execute();
		$stmt_result=$stmt->get_result();

		if ($stmt_result->num_rows>0) {
			$data=$stmt_result->fetch_assoc();
			$src_prof=$data['profile'];
			$userprofile="<img src='$src_prof' width='100%' height='100%' class='prof'>";
			$user_id=$data['id'];

			$_SESSION['user_profile']=$src_prof;
			$_SESSION['user_id']=$user_id;
			
		}else{
			echo "Something wrong";
		}
	}

	$rg_prof_field=
	"<div class='rg_head'>".
	"<h3>---- Channel & Media ----</h3>".
	"</div>".
	"<div class='rg_body'>".
	"<ul>".
	"<li><div class='rg-c-view'><img src='css/Img/medicare_dot.png'><span><h3>Medicare</h3><small>Channel</small></span><nav class='subscription'>Supscribe</nav></div>".
	"<div class='rg-c-footer'>Subscribe our channel to know daily healthy life. We're help you for all your health problems.</div>".
	"</li>".
		"</ul>".
	"</div>".
	"<div class='rg_footer'></div>";


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
	}

	$lf_prof_field=
	"<div id='left_canvas'>".
	"<div id='head'>".
	"<a href='Profile'>".
	"<div id='me'>".
	"<input type='file' name='choosepp' id='ppchose' hidden>".
	"<img src='$src_prof' class='profile_pp'></div>".
	"<div id='in_title_text'>".
	"<span class='myname'>$username</span>".
	"<ul>".
	"<li>".$popularity."Popularity<span  class='plan-icon'></span></li>".
	"<li>".$follower."Follower<span  class='emergency-icon'></span></li>".
	"<li>".$a_status."<span  class='edit'></span></li>".
	"</ul>".
	"</div>".
	"</a>".
	"</div>".
	"<div id='lf-c-body'>".
	"<div id='filter_field' onclick='ShowStores();'>".
	"<img src='css/Img/nodata.png' width='30' height='30' class='ft-icon'><span id='filter' >".
	"Health care</span>".
	"<div id='st'><span id='health-icon-menu' class='filters'></span></div>".
	"</div>".
	"<div id='store_overviews' class='overviews'>".
	"<ul>".
	"<li>Personal care</li>".
	"<li>Sexual care</li>".
	"</div>".
	"<div id='filter_field'  onclick='ShowSpec();'>".
	"<a href='shop.php'><img src='css/Img/shop.png' width='30' height='30' class='ft-icon'><span id='filter'>Shop</span></a>".
	"<div id='spec'><span id='shop-icon-menu' class='filters'></span></div>".
	"</div>".
	"<div id='special_overviews' class='overviews'>".
	"<ul>".
	"<li>Medicine</li>".
	"<li>Products</li>".
	"<li>Cosmetics</li>".
	"</ul>".
	"</div>".
	"<div id='filter_field'>".
	"<img src='css/Img/saved.png' width='30' height='30' class='ft-icon'><span id='filter' class='save_item'>Saved</span>	".		
	"</div>".
	"<div id='filter_field'>".
	"<img src='css/Img/activity.png' width='25' height='25' class='ft-icon'><span id='filter'>Activities</span>	".		
	"</div>".
	"<div id='filter_field'>".
	"<img src='css/Img/timer.png' width='30' height='30' class='ft-icon'><span id='filter'>Recent</span>".
	"</div>".
	"<a href='Logout.php'><div id='filter_field'>".
	"<img src='css/Img/logout.png' width='30' height='30' class='ft-icon'><span id='filter'>Logout</span>".
	"</div></a>".
	"<div id='filter_field'>".
	"<img src='css/Img/dot.png' width='30' height='30' class='ft-icon'><span id='filter'>Dark Mood</span><label id='dark' onclick='darkMood()'></label>".
	"</div>".
	"</div>".
	"</div>";
	}
	$activer="";
	$home_activer="home_active";
	$search_s="0";
	$qa_activer = "";
	$news_activer = "";
	$shop_activer = "";

	if (isset($_POST['qa'])) {
			$qa_activer="qa_active";
			$home_activer="home";
			$search_s="1";
		}

		if (isset($_POST['news'])) {
			$news_activer="news_active";
			$home_activer="home";
			$search_s="2";
		}

		if (isset($_POST['shop'])) {
			$shop_activer="shop_active";
	 		$home_activer="home";
			$search_s="3";
		}
$pre_search=isset($_POST['search'])? $_POST['search'] : '';
$count_sre = 0;

		$sql="SELECT * FROM `post` order by post_id desc;";
		$search=isset($_POST['search']) ? $_POST['search'] : null;
		if (isset($_POST['qa'])) {
			$sql="SELECT * FROM `post` WHERE type='status' order by post_id desc;";
		}

		if (isset($_POST['news'])) {
			$sql="SELECT * FROM `post` WHERE type='news' order by post_id desc;";
		}

		if (isset($_POST['shop'])) {
			$sql="SELECT * FROM `post` WHERE type='shop' order by post_id desc;";
		}

		if (isset($_POST['all_search'])) {
			$sql="SELECT * FROM `post` WHERE post_caption like '%$search%' or message like '%$search%' order by post_id desc;";
		}

		if (isset($_POST['qa_search'])) {
			$sql="SELECT * FROM `post` WHERE type='status' and message like '%$search%' order by post_id desc;";
		}

		if (isset($_POST['news_search'])) {
			$sql="SELECT * FROM `post` WHERE type='news' and post_caption like '%$search%' order by post_id desc;";
		}

		if (isset($_POST['shop_search'])) {
			$sql="SELECT * FROM `post` WHERE type='shop' and post_caption like '%$search%' order by post_id desc;";
		}


		if(isset($_SESSION['username'])){
			$log=true;
		}else{
			$log=false;
		}
		$result_ser=mysqli_query($conn,$sql);
		$resultCheck_ser=mysqli_num_rows($result_ser);

		if ($resultCheck_ser > 0) {
			while ($row = mysqli_fetch_assoc($result_ser)) {
				$count_sre++;
			}
		}
$ser_res=isset($_POST['search'])? $count_sre." results found ['".$pre_search."'] - most relevance" : '';
?>
<div class="lf-prof"><div id="left_canvas"><?php echo $lf_prof_field; ?></div></div>
		<div class="rg-prof">
			
			<?php 
			if (!isset($_SESSION['username'])) {
				?>
				<div class='login-req'>
				<h2>New user? Registration here..</h2><br><br>
				<form action='create.php' method='POST'><input type='text' name='rd' value='/Medicare/' hidden><input type='submit' class='login-req-btn' value='Registration'></form>
				</div>
		<?php
			}else{
				?>
				<div class='rg_head'>
					<h3 class="people_rg rg_active" title="People"></h3>
					<h3 class="chat" title="Chat"></h3>
					<h3 class="tips" title="Daily tips"></h3>
				</div>
			<div class='rg_body'>
				<?php
			$getusql = "SELECT * FROM medicares WHERE username!='$username'";
			$res_u = mysqli_query($conn,$getusql);
			$res_c = mysqli_num_rows($res_u);

			if ($res_c > 0) {
				while ($row = mysqli_fetch_assoc($res_u)) {
					$uname=$row['username'];
					$id=$row['id'];

					$id=substr($id, strripos($id, '_')+1);

					$link_id="Profile/?id=".$id."&username=".$uname;

					$prof_src=$row['profile'];
					$description=$row['description'];
					$description=preg_replace("#\[sp\]#", " &nbsp;", $description);
					$description=preg_replace("#\[nl\]#", " <br/>", $description);
					$description=preg_replace('"\b(https?://\S+)"', '<a href="$1" style="color:blue;">$1</a>', $description);
					if ($description == null) {
						# code...
						$description = "No description.";
					}

					$get_level="SELECT * FROM user_account_status WHERE username=?";
					$stmtl=$conn->prepare($get_level);
					$stmtl->bind_param("s",$uname);
					$stmtl->execute();
					$resultl=$stmtl->get_result();
					if ($resultl->num_rows > 0) {
						$datal=$resultl->fetch_assoc();
						$level=$datal['level'];

						if ($level == 0) {
							$a_status="Junior";
						}else if ($level == 1) {
							$a_status="Senior";
						}else if ($level == 2) {
							$a_status="Media";
						}else if ($level == 3) {
							$a_status="Channel";
						}
						
					}

					?>
					
					<ul>
					<li><div class='rg-c-view'><a href="<?php echo($link_id)?>" style="text-decoration: none;"><img src='<?php echo($prof_src)?>'></a><span><h3>
						<a href="<?php echo($link_id)?>" style="text-decoration: none;"><?php echo($uname) ?></a>
					</h3><small style="color: #e91e63;"><?php echo($a_status) ?></small></span><nav class='subscription'>Supscribe</nav></div>
					<div class='rg-c-footer'><?php echo($description) ?></div>
					</li>
						</ul>
					
					<?php
				}
			}
}
		?>
</div>
					<div class='rg_footer'></div>
	</div>
	<div class="header" id="hi-he">
		<!--	<span class="main-icon"></span>-->
			<span class="title">Medicare</span>
			<div class="c">
			<sapn class="search_field">
				<span>
					<input type="text" id="search_id" value="<?php echo($search_s) ?>" hidden>
					<input type="text" id="search_input" name="search" title="search here" placeholder="search here" class="search_inp" value="<?php echo($pre_search) ?>">
					<input type="submit" name="submit_search" value="" title="search" class="search_btn search window_search" onclick="search(<?php echo $search_s;?>)">
					<input type="submit" id="submit_search" name="submit_search" value="" title="search" class="search_btn search android_search" onclick="pre_search(<?php echo $search_s;?>)">
				</span>
								
			</sapn>
			
			</div>
			<ul>
				<li id="home" class="<?php echo($home_activer) ?>" title="home" onclick="home()"></li>
				<li id="qa" class="qa <?php echo($qa_activer) ?>" title="Questions and Answers" onclick="qa()"></li>
				<li id="news" class="news <?php echo($news_activer) ?>" title="health magazines" onclick="news()"></li>
				<li id="shop" class="shop <?php echo($shop_activer) ?>" title="Shop" onclick="shop()"></li>
				<li id="notification" class="notification " title="notifications" onclick="notification()">
					<span class="notification_active_in"></span>
				</li>
				<li id="m-m-menu" class="m-m-menu" onclick="showAllMenu();"></li>
			</ul>			
		</div>
		
	<div id="web-m-body">
	<div id="lf-body"></div>
	<div id="main-body">	
		
		<div class="ads-field">
			
		</div>
		

		<div id="body">
			<div id="home-field">
			<div id="u-header">
				<a href="/Medicare/Profile/">
				<span class="my-prof">
					<?php echo $userprofile; ?>
				</span>
				<span class="userheader" style="color: #26c6da;"><?php echo $username; ?></span>
			</a>
				<ul>
					<?php  
						echo $loginstatus;
					?>
					
				</ul>
			</div>
		<div id="ser_res"><?php echo $ser_res; ?></div>

			<div id="ads-field">
				<div class="ads-contents"></div>
			</div>
<div id="posts_show_field">
	<?php
		$result=mysqli_query($conn,$sql);
		$resultCheck=mysqli_num_rows($result);

		if ($resultCheck > 0) {
			while ($row = mysqli_fetch_assoc($result)) {

				$poster_name=$row['poster_name'];
				$post_id=$row['post_id'];
				$post_date=$row['post_date'];
				$type=$row['type'];
				$message=$row['message'];
				$post_caption=$row['post_caption'];
				$count_sre++;
				

				if ($username == $poster_name) {
					$prof_link="Profile";
					$es_post="post-det";
					$on_es="save(".$post_id.",`".$type."`)";
				}else{
					$getuid="SELECT * FROM medicares where username='$poster_name'";
					$st=$conn->prepare($getuid);
					$st->execute();
					$urs=$st->get_result();

					if ($urs->num_rows > 0) {
						$udata=$urs->fetch_assoc();
						$id=$udata['id'];

						$id=substr($id, strripos($id, '_')+1);

						$prof_link="Profile/?id=".$id."&username=".$poster_name;

						$get_save="SELECT * FROM `sar_tb` WHERE `post_id`='$post_id' and `log_type`='save' and `username`='$username'";
						$stmt_save=$conn->prepare($get_save);
						$stmt_save->execute();
						$result_save=$stmt_save->get_result();

						$saver='';

						if ($result_save->num_rows > 0) {
							$es_post="post-saved";
							$on_es="";
						}else{
							$es_post="post-save";
							$on_es="save(".$post_id.",`".$type."`)";
						}



						
					}else{
						exit();
					}
				}

				$getlike=loadLike($post_id);
				if ($getlike>1) {
					$getlike=$getlike.'likes';
				}else{
					if ($getlike == 1) {
						$getlike=$getlike.'like';
					}
					else{
						$getlike='like';
					}
				}
				$getcomment=loadComment($post_id);
				if ($getcomment>1) {
					if ($type != 'status') {
						$getcomment=$getcomment.'coms';
					}else{
						$getcomment=$getcomment.'ans';
					}
					
				}else{
					if ($getcomment == 1) {
						if($type != 'status'){
							$getcomment=$getcomment.'com';
						}else{
							$getcomment=$getcomment.'ans';
						}
						
					}
					else{
						if ($type != 'status') {
							$getcomment='Comment';
						}else{
							$getcomment='Answer';
						}
						
					}
				}
				$cutInt=substr($getcomment, 0,stripos($getcomment, " "));
				
				$poster_profile="";
				$msg_display="";
				$ps_caption="";

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

				//determine user liked or unlike
				
				
				if ($type=="status") {
					$href=$message;
					$message=preg_replace("#\[sp\]#", " &nbsp;", $message);
					$message=preg_replace("#\[nl\]#", " <br/>", $message);
					$message=preg_replace('"\b(https?://\S+)"', '<a href="$1" style="color:blue;">$1</a>', $message);
					$post_type='status-post';
					$msg_display="<a href='view.php?id=$post_id&psf=$psf_id&typ=$type' class='view-ps-dt'><p>$message</p></a>";
				}
				if ($type=="photo") {
					$href_psc=$post_caption;
					$post_caption=preg_replace("#\[sp\]#", " &nbsp;", $post_caption);
					$post_caption=preg_replace("#\[nl\]#", " <br/>", $post_caption);
					$post_caption=preg_replace('"\b(https?://\S+)"', '<a href="$1" style="color:blue;">$1</a>', $post_caption);
					$ps_caption="<span class='post-caption'>$post_caption</span>";
					if (strlen($ps_caption) > 50) {
						$ps_caption=substr($ps_caption, 0,50);
						$ps_caption=$ps_caption."....<br><a href='view.php?id=$post_id&psf=$psf_id&typ=$type' style='font-size: .9em;cursor:pointer;'>See more</a>";
					}
					$post_type='photo-postt';
					
					$msg_display="<a href='view.php?id=$post_id&psf=$psf_id&typ=$type' class='view-ps-dt'><img src='$message'></a>";
				}
				if ($type=="shop") {
					$href_psc=$post_caption;
					$post_caption=preg_replace("#\[sp\]#", " &nbsp;", $post_caption);
					$post_caption=preg_replace("#\[nl\]#", " <br/>", $post_caption);
					$post_caption=preg_replace('"\b(https?://\S+)"', '<a href="$1" style="color:blue;">$1</a>', $post_caption);
					$ps_caption="<span class='post-caption'>$post_caption</span>";
					if (strlen($ps_caption) > 50) {
						$ps_caption=substr($ps_caption, 0,50);
						$ps_caption=$ps_caption."....<br><a href='view.php?id=$post_id&psf=$psf_id&typ=$type' style='font-size: .9em;cursor:pointer;'>See more</a>";
					}
					$post_type='shop-postt';


					

					$msg_display="<a href='view.php?id=$post_id&psf=$psf_id&typ=$type' class='view-ps-dt'><img src='$message'></a>";
					$reaction_view="<div class='shop_product' >Shop</div>";
					
				}
				if ($type=="news") {
					$news_header=substr($post_caption, 0, stripos($post_caption, '*')); 
					$ec=substr($post_caption, stripos($post_caption, "*")+1);
					$writer=substr($ec, 0, stripos($ec, '*'));
					$comment = substr($ec,stripos($ec, '*')+1);

					$get_url=substr($message, 0,stripos($message, "-")+1);
					$n=substr($get_url, 8);
					$npf=substr($n, 0,stripos($n, "."));
					
					
					$ps_caption=preg_replace("#\[sp\]#", " &nbsp;", $ps_caption);
					$ps_caption=preg_replace("#\[nl\]#", " <br/>", $ps_caption);
					$ps_caption=preg_replace('"\b(https?://\S+)"', '<a href="$1" style="color:blue;">$1</a>', $ps_caption);
					
					$post_type='new-postt';
					$news_content=substr($message, 0, stripos($message, '-')); 
					$get_img_src=substr($message, strripos($message, "-")+1);
					$get_img_src="xml/".$get_img_src;
					if(!is_file($get_img_src)){
						$contents = "css/img/news_active.png";
					}else{
						$contents = $get_img_src;
					}
					

					if (strlen($comment) > 50) {
						$comment=substr($comment, 0,50).'...<br><a href="Magazine/?id='.$post_id.'&npf='.$npf.'&title='.$news_header.'" style="font-size: .9em;cursor:pointer;">See more</a>';
					}
					$ps_caption = "<strong style='color:#00bcd4'>Title : </strong>".$news_header."<br>"."<strong style='color:#00bcd4'>Writer : </strong>".$writer."<br>"."<strong style='color:#00bcd4'>Description : </strong>".$comment;
					$ps_caption="<span class='post-caption'>$ps_caption</span>";
					$msg_display="<a href='Magazine/?id=$post_id&npf=$npf&title=$news_header'><nav style='background: url($contents) no-repeat;background-size: 100% auto;background-position:center;'><h2>$news_header</h2><h3>Read the magazine</h3></nav></a>";
				}
			}

			?>
				<div class='poster-field'>
				<div id='poster-header'>
				<a href='<?php echo($prof_link) ?>' class='user-prof' class='ps-header'>
				<img src='<?php echo($poster_profile) ?>' class='prof'>
				</a>
				<span class='user-name'><a href='<?php echo($prof_link) ?>' class='ps-header'><?php echo $poster_name;?></a></span>
				<span id="save_<?php echo($post_id)?>" class='<?php echo($es_post) ?>' onclick='<?php echo $on_es; ?>'></span>
				<span class='post-type <?php echo($post_type) ?>'><?php echo $post_date;?></span>
				</div>
				<div id='poster-body'>
				<?php echo $msg_display;?>
				</div>
				<div class="s-s-o">
					<?php
						if ($type=='shop') {
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
								echo "<div class='s-s-i'><strong style='color:#00bcd4'>Name : </strong>$name<br><span style='color:orange;'><strong style='color:#00bcd4'>Price : </strong>$prices</></div><br><small>Availabel payments</small><br>";
								foreach ($ary as $value) {
									echo "<span class='{$value}'></span>";
								}
								
							}
						}
					?>
				</div>
				<div><?php echo $ps_caption;?></div>
				
				<div id='poster-footer'>
				<div class='p-r'>
				 
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
			<div class='comment' id="comment_<?php echo($post_id)?>" onclick='comment("<?php echo($post_id)?>","<?php echo($poster_name)?>","<?php echo($poster_profile)?>","<?php echo($post_date)?>")'><?php echo $getcomment; ?></div>
				<div class='share'>
					Share
				<div class='s-option'>
				<span class='f' title='share to facebook'></span>
				<span class='t' title='share to twiter'></span>
				<span class='l' title='copy link'></span>
				</div>
				</div>
				</div>
				</div>
				</div>
				<?php
			}
			
		}
	?>
</div>

			</div>
			<div class="h-f-f"><h3>End of result</h3><small>Share your knowledge by post something</small>
				 <br>
				<a href="">Feedback us</a></div>
		</div>
</div>
<div id="rg-body"></div>
<div id="noti-in-body" onclick="close_noti()">

</div>
<div class='loading_body'><span class='loading_search'>Loading...</span></div>

<div id="noti-box-in-body" class="alert-in-box">
	<div class="alert-in-box-header"></div>
</div>

</div>
<div class="csm-sup">
	<div class="icon-click" onclick="showCSM()"></div>
	<div class="c4 custom-post"><a href='Post.php?type=status'></a></div>
	<div class="c5 photo-post"><a href='Post.php?type=photo'></a></div>
	<div class="c6 shop-post"><a href='Post.php?type=shop'></a></div>
	<div class="c7 news-post"><a href='MagazineEditor.php'></a></div>
	<div class="c0" onclick="doSomethingWithChat()"></div>
	<div class="c1" onclick="doSomethingWithChat()"></div>
	<div class="c2" onclick="doSomethingWithChat()"></div>
	<div class="c3" onclick="doSomethingWithChat()"></div>
	<div class="chat-small-field cb1">
		<div class="chat-head">
			<a href="">
				<img src="<?php echo($src_prof)?>">
				<nav><?php echo $username;?><br>
					<small>Active</small>
				</nav>
			</a>
			<nav class="post-det"></nav>
		</div>
		<div class="chat-body"></div>
		<div class="chat-footer"></div>
	</div>
</div>

<script type="text/javascript" src="js/cindex.js"></script>

</body>
</html>