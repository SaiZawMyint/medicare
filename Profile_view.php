<?php 

	session_start();
	
	if (isset($_GET['profile']) && isset($_GET['username'])) {
		$profile=$_GET['profile'];
		$username=$_GET['username'];


	}else{
		header("location : Loguot.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Views</title>
	<script type="text/javascript" src="js/basic.js"></script>
	<style type="text/css">
		body{
			width: 100%;
		}
		*{
			margin: 0;
			padding: 0;
		}
		.main{
			margin-left: 10%;
			width: 80%;
			height: auto;
		}
		.display{
			margin-top: 30px;
			width: 100%;
			height: 100%;

		}
		.display img{
			width: auto;
			height: auto;
			height: 500px;
			width: 500px;
			border-radius: 50%;
		}
		.footer{
			width: 80%;
			height: auto;
			float: left;
			margin-left: 10%;
			height: 20%;
			background-color: #0000002f;
			padding-top: 20px;
			padding-bottom: 20px;
		}
		.footer input{
			border:0;
			border-radius: 15px;
			padding: 10px;
			background:linear-gradient(to right,#e07ac1,#F44336);
			cursor: pointer;
		}
		.footer input:hover{
			background: linear-gradient(to right,#F443362b,#e07ac12b);
		}
		.footer button{
			border:0;
			border-radius: 15px;
			padding: 10px;
			background:linear-gradient(to right,#e07ac1,#F44336);
			cursor: pointer;
		}
		.footer button:hover{
			background: linear-gradient(to right,#F443362b,#e07ac12b);
		}
		.cancel{
			float: left;
			margin-left: 30px;
		}
		.submit{
			float: right;
			margin-right: 30px;
		}
		progress{
			-webkit-appearance:none;
			width: 80%;
			border: 1px solid #fff;
			overflow: hidden;
			color: #aaa;
			border-radius: 15px;

			&::-webkit-progress-bar{
				background: #f1f1f1;
			}

			&::-webkit-progress-value{
				background: #aaa;
			}

			&::-moz-progress-bar{
				background: #aaa
			}
		}
		#UploadProgress{
			display: none;
		}

		@media only screen and (max-width:1000px){
			.main{
				width: 100%;
				margin-left: 0px;
			}
			.footer{
				width: 100%;
				margin-left: 0px;
			}
			.display img{
				width: 700px;
				height: 700px;
			}
			.footer input{
				font-size: 3em;
			}
			.footer button{
				font-size: 3em;
			}
		}
		
	</style>
	<script type="text/javascript">
		function _(eid){
			return document.getElementById(eid);
		}
		function change() {
			var getphoto=_('file1');
			getphoto.click();
			getphoto.addEventListener("change",getPhoto);
			function getPhoto(evt){
		
			var files=evt.target.files;
			if(files.length === 0){
				console.log('No file is selected !');
				return;
			}
			
			var reader=new FileReader();
			reader.onload=function(event){
				_('photo_in').src=event.target.result;

			};
			reader.readAsDataURL(files[0]);
			
			_('s').innerHTML="<input type='button' onclick='FileUpload()' value='upload' class='submit'>"+
			"<center><button class='discard'>Cancel</button></center>";
		
			};
		}

		function FileUpload(){


			

			_('UploadProgress').style.display='block';

			var file=_('file1').files[0];
			//alert(file.type);
			var formData = new FormData();
			formData.append("file1",file);
			var username=_('username').value;
			var ajax=new XMLHttpRequest();

			ajax.upload.addEventListener("progress", progressHandler, false);
			ajax.addEventListener("load", loadHandler, false);
			ajax.addEventListener("error", errorHandler, false);
			ajax.addEventListener("abort", abortHandler, false);

			ajax.open("POST","xml/fileupload.php?username="+username);
			ajax.send(formData);
		}

		function progressHandler(event){
			var percent=(event.loaded/event.total)*100;
			_('UploadProgress').value=Math.round(percent);
			_('status').innerHTML=Math.round(percent)+"% loaded... please wait";
		}
		function loadHandler(event){
			_('footer').innerHTML=event.target.responseText;
			
		}
		function errorHandler(event){
			_('status').innerHTML="Failed to upload file.";
		}
		function abortHandler(event){
			_('status').innerHTML="File canceled.";
		}
		function back(){
			window.history.back();
		}

	</script>
</head>
<body>
<div class="main">
	<div class="display">
		<center><img id='photo_in' onclick="change()" src="<?php echo $profile; ?>" ></center>
	</div>

	<?php
		if ($_SESSION['username'] == $username) {
			# code...
		
	?>
	<div class="footer" id="footer">
		<input type='text' name="username" id="username" value="<?php echo $username; ?>" hidden>
		<input type="button" value="Back" onclick="back()" class="cancel">
		<form id='my_form' method='post' enctype='multipart-form/data'>
			<input type="file" name="file1" hidden="hidden" id="file1" accept="image/*" >
			<div id="s"><input type='button' onclick='change()' value='Choose' class="submit"><br><br></div>
			<h3 id='status'></h3>
			<progress value='0' max='100' id='UploadProgress'></progress>
		</form>
	</div>
	<?php
		}else{
			?>
			<div class="footer" id="footer">
			
			</div>
			<?php
		}
	?>

</div>
<div id="noti-box-in-body" class="alert-in-box">
	<div class="alert-in-box-header"></div>
	<div id='dark' style="display: none;"></div>
</div>
</body>
</html>