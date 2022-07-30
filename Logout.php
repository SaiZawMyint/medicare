<?php  

	session_start();

	session_destroy();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Logout</title>
	<style type="text/css">
		body{
			overflow-y: scroll;
			overflow-x: hidden;
			font-family: Arial;
		}
		*{
			margin: 0;
			padding: 0;
		}
		.main-body{
			width: 100%;
			height: 100%;
			position: absolute;
		}
		.body{
			margin-left: 20%;

			width: 60%;
			min-height:100%;
			text-align: center;
			background: url(css/Img/load.png) no-repeat;
			background-size: 100% 100%;
			background-position: center;
			background-color: #343434;
		}
		.body nav{
			width: 100%;
			top: 30%;
			left: 50%;
			transform: translate(-50%,-60%);
			position: absolute;
		}
		.body h3{
			color: #25bfb2;
			font-size: 3em;
			
		}
		.body small{
			color: #25bfb2;
			font-size: 1em;
		}
		.body a{
			font-weight: bold;
		}
		@media only screen and (max-width:1000px) {

			.body{
				margin-left: 0;
				width: 100%;
			}
			.body h3{
			font-size: 5em;
			
		}
		.body small{
			font-size: 2em;
		}
		}
	</style>
</head>
<body>
<div class="main-body">
	<div class="body">
		<nav><h3>You're currently logout</h3>
		<small><a href='Login.php'>Click here to login</a> OR <a href="create.html">Click here to create account</a></small></nav>
	</div>
</div>
</body>
</html>