<?php 

	session_start();

	$doc_title="";
	$rel_icon="";
	$post_type="";
	$post_caption="";
	$post_footer_form="";
	$date=date("d/m/y");

	if (!isset($_SESSION['username'])) {
		$unavilable=true;
	}else{
		$username=$_SESSION['username'];
		$user_profile=$_SESSION['user_profile'];
		$user_id=$_SESSION['user_id'];

		$unavilable=false;
	

if (isset($_GET['type'])) {
	
	if($_GET['type']=='status' || $_GET['type']=='shop' || $_GET['type']=='magazine' || $_GET['type']=='photo'){
		$unavilable=false;
	}else{
		$unavilable=true;
	}

	if ($_GET['type']=='status') {
		$doc_title='Q/A';
		$rel_icon='css/Img/qa_active.png';
		$post_type='status-post';
		$post_body="<textarea id='textarea' placeholder='Write your questions here..'></textarea>";
		$post_caption="<br>";
		$post_footer_form="<form id='My_Form' method='post'>".
						"<input type='text' name='poster_name' id='poster_name' hidden='hidden' value='$username'>".
						"<input type='button' onclick='Post_status()' value='Post' class='submit'>".
						"<center><h3 id='status'></h3>".
						"</center>".	
						"</form>";
		$news_body="";
	}
	if ($_GET['type']=='photo') {
		$doc_title='Post your photo';
		$rel_icon='css/Img/photo.png';
		$post_type='photo-postt';
		$post_body="<input type='file' id='getphoto' name='getphoto' accept='image/*' hidden><img id='display_photo' src='' class='post_img' onclick='chosePhoto()' title='Click to choose photo'>";
		$post_caption="<textarea id='post_caption' placeholder='Write something here'></textarea>";
		$post_footer_form="<form id='My_Form' method='post' enctype='multipart-form/data'>".
						"<input type='text' name='poster_name' id='poster_name' hidden='hidden' value='$username'>".
						"<input type='button' onclick='Post_photo()' value='Post' class='submit'>".
						"<center><h3 id='status'></h3>".
						"</center>".	
						"</form>";
		$news_body="";
	}
	if ($_GET['type']=='shop') {
		$doc_title='Post your product';
		$rel_icon='css/Img/shop.png';
		$post_type='shop-postt';
		$post_body="<input type='file' id='getphoto' name='getphoto' accept='image/*' hidden><img id='display_photo' src='' class='post_img' onclick='chosePhoto()' title='Upload your product photo'>";
		$post_caption="<div class='prices'><span class='psric'><label>name</label><input type='text' placeholder='Enter your product name' id='pd-name'></span><span class='psric'><label>Prices  </label>  <input type='text' placeholder='Enter your product price' id='pd-prices'></span><span class='psric'><label>Payment Methods</label><div class='payment'><div class='k-pay'><span class='pay' onclick='addPayment(1)' id='p_1'></span></div><div class='wave-pay'><span class='pay' onclick='addPayment(2)' id='p_2'></span></div><div class='atm'><span class='pay' onclick='addPayment(3)' id='p_3'></span></div></div></span></div><textarea id='post_caption' placeholder='Write something about your product..'></textarea>";
		$post_footer_form="<form id='My_Form' method='post' enctype='multipart-form/data'>".
						"<input type='text' name='poster_name' id='poster_name' hidden='hidden' value='$username'>".
						"<input type='button' onclick='Post_Shop()' value='Post' class='submit'>".
						"<center><h3 id='status'></h3>".
						"</center>".	
						"</form>";
		$news_body="";
	}
	if ($_GET['type']=='magazine') {
		$doc_title='Post your product';
		$rel_icon='css/Img/news_active.png';
		$post_type='new-postt';
		$post_body="<input type='file' id='getphoto' name='getphoto' accept='image/*' hidden><img id='display_photo' src='' class='post_img' onclick='chosePhoto()' title='Upload your magazine photo'>";
		$post_caption="<textarea id='post_caption' placeholder='Write the best message from your magazine here...'></textarea>";
		$post_footer_form="<form id='My_Form' method='post' enctype='multipart-form/data'>".
						"<input type='text' name='poster_name' id='poster_name' hidden='hidden' value='$username'>".
						"<input type='button' onclick='Post_News()' value='Post' class='submit'>".
						"<center><h3 id='status'></h3>".
						"</center>".	
						"</form>";
		$news_body=
		"<input type='text' id='new-header' class='new-header' placeholder='Title'>".
		"<span class='tip'></span>".
		"<textarea id='new_content' placeholder='Write your content'></textarea>";
	}

}else{
	$unavilable=true;
}
}
if (!$unavilable) {
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $doc_title; ?></title>
	<link rel="icon" type="image/png" href="<?php echo $rel_icon; ?>">
	<link rel="stylesheet" type="text/css" href="css/communication.css">
	<script type="text/javascript" src="js/basic.js"></script>
	<style type="text/css">
		.p-main-body{
			position: absolute;
			width: 100%;
			height: 100%;
		}
		.poster-field{
			margin-top: 60px;
		}
		.p-main-view{
			width: 60%;
			height: auto;
			margin-left: 20%;
		}
		#poster-body{
			height: auto;
			max-height: 1000px;
		}
		#poster-body img{
			min-height: 400px;
			height: auto;
		}
		#news_body{
			margin: 0;
			padding: 0;
		}
		.post_img{
			width: 400px;
			min-height: 400px;
			background: url(css/Img/photo.png) no-repeat;
			background-size: 400px 400px;
			background-position: center;
			cursor: pointer;
		}
		.poster-footer{
			position: fixed;
			width: 60%;
			height: 60px;
			background-color: #78d0f7;
			margin-left: 20%;
		}
		.poster-footer input{
			border:0;
			border-radius: 15px;
			padding: 10px;
			cursor: pointer;
			background-color: transparent;
		}
		.poster-footer input:hover{
			background: linear-gradient(to right,#F443362b,#e07ac12b);
		}
		.post-caption textarea{
			width: 97%;
			min-height:100px;
			border:0;
			padding: 10px;
			color: unset;
			background-color: transparent;
		}
		.cancel{
			float: left;
			margin: 10px 10px 10px 20px;
		}
		.submit{
			float: right;
			margin: 10px 20px 10px 10px;
		}
		
		#textarea{
			background-color: transparent;
			border: 0;
			padding: 10px;
			width: 97%;
			height: 100%;
			min-height: 300px;
			text-align: justify;
			color: unset;
		}
		input:focus , textarea{
			outline: none;
		}
		progress{
			-webkit-appearance:none;
			width: 600px;
			border: 1px solid #fff;
			overflow: hidden;
			color: #aaa;
			border-radius: 20px;
			height: 24px;
		}
		#UploadProgress{
			
		}
		.user-name{
			width: 80%;
		}
		#news_body input{
			text-align: center;
			background-color: #2f3eb975;
			width: 100%;
			border-radius: 5px;
			border: 0;
			color: #ffffff;
		}
		#news_body textarea{
			width: 100%;
			min-height: 700px;
			height: auto;
			color: unset;
			border: 0;
			border-style: none;
			text-align: justify;
			padding-top: 50px;
			background-color: transparent;
		}
		.prices{
			width: 100%;
			display: flex;
			flex-direction: column;
						float: left;

		}
		#poster-header{
			max-height: none;
		}
		.psric{
			display: flex;
			margin: 10px 0px;
						float: left;


		}
		.psric label{
			width: 20%;
			font-size: 1.3em;
			padding: 5px 15px;
						float: left;

		}
		.psric input{
			outline: 0;
			border: 0;
			width: 70%;
			font-size: 1.3em;
			padding: 5px 15px;
			float: left;
			background-color: transparent;
			color: unset;
			border-bottom: 2px solid;


		}
		.psric input:focus{
			border: 0;
			border-bottom: 2px solid;
			float: left;

		}
		.payment{
			width: auto;
			display: flex;
						float: left;

		}
		.k-pay{
			width: 50px;
			height: 50px;
			background: url(css/Img/kbz.png) no-repeat;
			background-size: 90% 90%;
			background-position: center;
			margin: 5px;
			float: left;
			border-radius: 15px;
		}
		.wave-pay{
			width: 50px;
			height: 50px;
			background: url(css/Img/wave.png) no-repeat;
			background-size: 90% 90%;
			background-position: center;
			margin: 5px;
			float: left;
			border-radius: 15px;
		}
		.atm{
			width: 50px;
			height: 50px;
			background: url(css/Img/credit.png) no-repeat;
			background-size: 100% 90%;
			background-position: center;
			margin: 5px;
			float: left;
			border-radius: 15px;
		}
		.pay{
			width: 100%;
			height: 100%;
			float: left;
			border-radius: 5px;
			cursor: pointer;
		}
		.pay:hover{
			background-color: #0000004f;
		}
		.pay_select{
			background: url(css/Img/right.png) no-repeat;
			background-position: 80% 10%;
			background-size: 30% 30%;
			background-color:#0000004f;
		}
		.post-noti{
			position: fixed;
			width: 100%;
			height: 100%;
			background-color: #3333332b;
			display: none;

		}
		.post-in-progress{
			width: fit-content;
			height: fit-content;
			top: 50%;
			left: 50%;
			transform: translate(-50%,-50%);;
			position: absolute;
			display: flex;
			flex-direction: column;
		}
		.post-in-progress input{
			padding: 10px;
			border-radius: 20px;
			font-size: 1.5em;
			background: linear-gradient(to right,#2196f3,#673ab7);
			color: #fff;
			border: 0;
			outline: 0;
			cursor: pointer;
		}
		.loading{
			width: fit-content;
			height: fit-content;
			background: url(css/Img/loading_icon.gif) no-repeat;
			background-size: 25px 25px;
			background-position: 5px center;
			font-size: 1em;
			padding: 7px 7px 7px 30px;
			color: #ffffff;
			margin-top: -27px;
			float: left;
			margin-left: 40%;
		}
		.new-header{
			margin: 15px 0px;
		}
		.tip{
			font-size: 1em;
		}
		@media only screen and (max-width:1000px){
			.tip{
				font-size: 2em;
			}
			.post-noti{
				
			}
			.post-in-progress input{
				font-size: 3em;
			}

			.loading{
				background-size: 35px 35px;
				font-size: 2em;
				margin-top: -43px;
				padding: 10px 10px 10px 40px;
				margin-left: 35%;
			}
			.p-main-view{
				width: 100%;
				margin-left: 0%;
			}
			#textarea{
				height: 500px;
			}
			textarea{
				font-size: 1.5em;
			}
			.cancel{
				font-size: 3em;
			}
			.submit{
				font-size: 3em;
			}
			#news_body input{
				font-size: 4em;
			}
			.poster-footer{
				width: 100%;
				height: 100px;
				margin-left: 0;
			}
			.poster-field{
				margin-top: 100px;
			}
			.k-pay{
				width: 100px;
				height: 100px;
			}
			.wave-pay{
				width: 100px;
				height: 100px;
			}
			.atm{
				width: 100px;
				height: 100px;
			}
			progress{
				width:600px;
				height: 35px;
			}
		}
	</style>
	<script>
		function _(eid) {
			return document.getElementById(eid);
		}
		function __(qsl) {
			return document.querySelector(qsl);
		}

		var k=false;
		var wave=false;
		var atm=false;

		function addPayment(pay_num) {
			if (pay_num==1) {
				if (!k) {
					_('p_1').classList.add('pay_select');
					k=true;
				}else{
					_('p_1').classList.remove('pay_select');
					k=false;
				}
				
			}
			if (pay_num==2) {
				if (!wave) {
					_('p_2').classList.add('pay_select');
					wave=true;
				}else{
					_('p_2').classList.remove('pay_select');
					wave=false;
				}
			}
			if (pay_num==3) {
				if (!atm) {
					_('p_3').classList.add('pay_select');
					atm=true;
				}else{
					_('p_3').classList.remove('pay_select');
					atm=false;
				}
			}
		}

		function Post_status() {
			
			var status='status';
			var message=_('textarea').value;
			message=message.replace(/  /g," [sp]");
			message=message.replace(/\n/g," [nl]");
		/*	message=message.replace("#_","[shpl]");

			for (var i = 0; i < message.length; i++) {
				if(message.charAt(i)==='_' && message.charAt(i+1)==='#'){
					message=message.replace("_#","[ehpl]");
					i=message.length;
				}else{
					message=message+"[ehpl]";
					i=message.length;
				}
			}*/

			var poster_name=_('poster_name').value;

			var ajax=new XMLHttpRequest();
			ajax.upload.addEventListener("progress", progressHandler, false);
			ajax.addEventListener("load", loadHandler, false);
			ajax.addEventListener("error", errorHandler, false);
			ajax.addEventListener("abort", abortHandler, false);
			if (message != '') {
				_('UploadProgress').style.display='block';
				__('.post-noti').style.display='block';
				ajax.open("POST","xml/post_.php?poster_name="+poster_name+"&type="+status+"&message="+encodeURIComponent(message));
				ajax.send(null);
			}else{
				alert("Please fill your question or answer");
				_('textarea').style.border="2px solid red";
				__('.poster-footer').style.border="2px solid #78d0f7";
			}
			
		}


		function Post_photo(){
			_('UploadProgress').style.display='block';
			var status='photo';
			var post_caption=_('post_caption').value;
			post_caption=post_caption.replace(/  /g," [sp]");
			post_caption=post_caption.replace(/\n/g," [nl]");
			var file=_('getphoto').files[0];
			//alert(file.type);
			var formData = new FormData();
			formData.append("file1",file);
			var username=_('poster_name').value;
			var ajax=new XMLHttpRequest();




			ajax.upload.addEventListener("progress", progressHandler, false);
			ajax.addEventListener("load", loadHandler, false);
			ajax.addEventListener("error", errorHandler, false);
			ajax.addEventListener("abort", abortHandler, false);
			if (file==null) {
				alert("Please choose photo to upload !");
				_('poster-body').style.border="2px solid red";
				__('.poster-footer').style.border="2px solid #78d0f7";
			}else{
				__('.post-noti').style.display='block';
				ajax.open("POST","xml/photoUpload.php?username="+username+"&type="+status+"&post_caption="+encodeURIComponent(post_caption));
				ajax.send(formData);
			}
			
		}

		function Post_Shop(){
			
			var status='shop';
			var post_caption=_('post_caption').value;
			post_caption=post_caption.replace(/  /g," [sp]");
			post_caption=post_caption.replace(/\n/g," [nl]");
			var file=_('getphoto').files[0];
			//alert(file.type);
			var formData = new FormData();
			formData.append("file1",file);
			var username=_('poster_name').value;
			var ajax=new XMLHttpRequest();

			
			var pd_name=_('pd-name').value;
			var pd_prices=_('pd-prices').value;
			var payments="";
			if (k) {
				payments+="k/";
			}
			if (wave) {
				payments+="wave/";
			}
			if (atm) {
				payments+="atm/";
			}

			if (pd_name=='' || pd_prices=='' || payments=="" || file==null) {
				alert("Please fill all requirement !");
				if (pd_name=='') {
					_('pd-name').style.borderBottom='2px solid red';
				}
				if (pd_prices=='') {
					_('pd-prices').style.borderBottom='2px solid red';
				}
				if (payments=='') {
					__('.payment').style.borderBottom='2px solid red';
				}
				if (file==null) {
					_("poster-body").style.border="2px solid red";
				}
				__('.poster-footer').style.border="2px solid #78d0f7";
			}else{
				_('UploadProgress').style.display='block';
				__('.post-noti').style.display='block';
				ajax.upload.addEventListener("progress", progressHandler, false);
				ajax.addEventListener("load", loadHandler, false);
				ajax.addEventListener("error", errorHandler, false);
				ajax.addEventListener("abort", abortHandler, false);
				ajax.open("POST","xml/shop_c.php?username="+username+"&type="+status+"&post_caption="+encodeURIComponent(post_caption)+"&methods="+payments+"&pd_name="+pd_name+"&pd_prices="+encodeURIComponent(pd_prices));
				ajax.send(formData);

			}

			
			
		}

		function Post_News(){
			_('UploadProgress').style.display='block';
			var status='news';
			var news_header=_('new-header').value;
			var post_caption=_('post_caption').value;
			var news_contents=_('new_content').value;


			post_caption=post_caption.replace(/  /g," [sp]");
			post_caption=post_caption.replace(/\n/g," [nl]");

			news_contents=news_contents.replace(/  /g," [sp]");
			news_contents=news_contents.replace(/\n/g," [nl]");


			var new_content_length=news_contents.length;

			var tocap=news_header+'*'+post_caption;

			
			var file=_('getphoto').files[0];
			//alert(file.type);
			var formData = new FormData();
			formData.append("file1",file);
			formData.append("news_contents",news_contents);
			var username=_('poster_name').value;
			var ajax=new XMLHttpRequest();

			ajax.upload.addEventListener("progress", progressHandler, false);
			ajax.addEventListener("load", loadHandler, false);
			ajax.addEventListener("error", errorHandler, false);
			ajax.addEventListener("abort", abortHandler, false);
			if (news_header=='' || post_caption=='' || news_contents=='' || file==null || new_content_length < 300) {
				alert("Please fill all requirement !");
				__('.poster-footer').style.border="2px solid #78d0f7";
				if (news_header=='') {
					_('new-header').style.border='2px solid red';
				}else{
					_('new-header').style.border='2px solid transparent';
				}
				if (post_caption=='') {
					_('post_caption').style.border='2px solid red';
				}else{
					_('post_caption').style.border='2px solid transparent';
				}
				if (news_contents=='') {
					_('new_content').style.border='2px solid red';
				}else{
					_('new_content').style.border='2px solid transparent';
				}
				if (new_content_length < 500) {
					_('new_content').style.border='2px solid #ff9c0a';
					__('.tip').innerHTML='<p style="color: #ff9c0a;">Your magazine need to have at least 300 words !</p>';
				}else{
					__('.tip').innerHTML='<p style="color: green;">OK</p>';
				}
				if (file==null) {
					_('poster-body').style.border='2px solid red';
				}else{
					_('poster-body').style.border='2px solid transparent';
				}
			}else{
				__('.post-noti').style.display='block';
				ajax.open("POST","xml/photoUpload.php?username="+username+"&type="+status+"&post_caption="+encodeURIComponent(tocap));
				ajax.send(formData);	
			}
			
		}


		function progressHandler(event){
			var percent=(event.loaded/event.total)*100;
			_('UploadProgress').value=Math.round(percent);
			__('.loading').innerHTML=Math.round(percent)+"% loaded... please wait";
		}
		function loadHandler(event){
			__('.post-in-progress').innerHTML=event.target.responseText;
			
		}
		function errorHandler(event){
			__('.post-in-progress').innerHTML="Failed to upload.";
		}
		function abortHandler(event){
			__('.post-in-progress').innerHTML="Upload canceled.";
		}

		function chosePhoto(){
			var getphoto=_('getphoto');
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
				_('display_photo').src=event.target.result;

			};
			reader.readAsDataURL(files[0]);
			
			
			};
		}
	</script>
</head>
<body>
	<div class="p-main-body">
		<div class="p-main-view">
			
			<div class='poster-field'>

				<div id='poster-header'>
					<a href='#' class='user-prof'>
						<img src='<?php echo $user_profile;?>' class='prof'>
					</a>
					<span class='user-name'><a href='#' class='ps-header'><?php echo $username; ?></a></span>
					<span class='post-type <?php echo $post_type ?>'><?php echo $date; ?></span>
					<span class='post-caption'><?php echo $post_caption; ?></span>
				</div>
				<div id='poster-body'>
					<?php echo $post_body; ?>
				</div>
				<div id="news_body">
					<?php echo $news_body; ?>
				</div>
				
				
			</div>

		</div>
		<div class='poster-footer'>
					<a href="/Medicare/"><input type="button" name="" value="Cancel" class="cancel"></a>
					<?php echo $post_footer_form; ?>
		</div>
	</div>
	<div class="post-noti">
		<div class="post-in-progress">
			<progress value='0' max='100' id='UploadProgress'></progress>
			<center><span class="loading">Loading..</span></center>
		</div>
	</div>
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