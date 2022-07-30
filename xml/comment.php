<?php  

	include 'functions.php';

	session_start();

		$post_id=$_GET['post_id'];
		$poster_name=$_GET['poster_name'];
		$poster_profile=$_GET['poster_profile'];
		$post_date=$_GET['post_date'];

		$sr_rs="";

	if (empty($_SESSION['username'])) {
		echo "<a class='u-header-link' href='Login.php' class='sign-up-btn' style='float:left;top:50%;left:50%;transform:translate(-50%,-50%);position:absolute;'>Plaese Login first</a>";
		$footer='';
	}else{
		
		$username=$_SESSION['username'];
		$footer="<textarea id='comment' placeholder='Write comment here ...'></textarea>".
				"<input type='text' id='username' value='$username' hidden>".
				"<input type='text' id='poster_name' value='$poster_name' hidden>".
				"<button onclick='submitComment($post_id)' class='sub-com'></button>";

	}
	
	

?>
	
	
		<div class="display-body">
			<div class="alert-in-box-header">
				
				<nav><?php echo $poster_name; ?>'s post comments</nav>
				<span onclick="close_noti()">X</span>
			</div>
			<div class='comment-body'>
				<?php 
					load($post_id);
				?>

			</div>
			<div id="status"></div>
			<div class='comment-footer'>
				<?php echo $footer; ?>
			</div>
		</div>

