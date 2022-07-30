
<!DOCTYPE html>
<html>
<head>
<?php  
	session_start();
	$rd=isset($_POST['rd']) ? $_POST['rd'] : '/Medicare/Description.php';
?>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Login</title>
<script type="text/javascript" src="js/login.js"></script>
<link rel="stylesheet" type="text/css" href="css/Login.css">
<link rel="icon" type="image/png" href="image/chat.png">
</head>
<body>
<div id="mian_canvas"></div>
		<div id="login_box">
			<div class="header">Login to Medicare</div>
			<div id="in_canvas">
				<input type="text" id="username" class="text-in" placeholder="Username" title="Username" required><br>
				<div id="us" class="s"></div>
				<br>
				<input type="password" id="password" class="text-in" placeholder="Password" title="Password" required><br>
				<div id="ps" class="s"></div>
				<br>
			</div>
			<div id="ongo_status"></div>
			<div id="footer">
				<a href="forgotten">Forgot password !</a><br><br>
				<input type="text" id="rd" value="<?php echo($rd) ?>" hidden>
				<button onclick="Submit()" id="Submit" class="Submit" title="Login">Login</button>
				<p class='create'>
					<form action="create.php" method="post">
					<input type="text" name="rd" value="<?php echo($rd) ?>" hidden>
					<button class="an-join">New Users? Sign up !</button>
					</form> 
				</p>
			</div>
		</div>
<div id="ongoing_pg"></div>
	<script type="text/javascript">
		var us=document.getElementById('username');
		var spec=['`','!','"','£','$','%','^','&','*','(',')','+','[',']','{','}','#','?','>','<','/',',','.',';','@',':','='];
		var num=['1','2','3','4','5','6','7','8','9','0'];
		var specc='';
	/**	for(var i=0;i<spec.length;i++){
			specc+=" "+spec[i]+" ";
		}*/
		
		us.addEventListener('input',function(){
			var username=us.value;
			var countspec=0;
			if(username.length===0){
				document.getElementById('us').style.display='block';
				document.getElementById('us').style.color='#343434';
				document.getElementById('us').innerHTML='Please fill username !';
				document.getElementById('Submit').removeAttribute('onclick');
				document.getElementById('Submit').style.cursor='not-allowed';
			}else{
				if(username.length<3){
					document.getElementById('us').style.display='block';
					document.getElementById('us').style.color='#343434';
					document.getElementById('us').innerHTML='Username is too short!';
					document.getElementById('Submit').removeAttribute('onclick');
					document.getElementById('Submit').style.cursor='not-allowed';
				}else{
				for(var i=0;i<username.length;i++){
					for(var j=0;j<spec.length;j++){
						if(username.charAt(i)===spec[j]){
							countspec++;
						}
					}
				}
				
				if(countspec>0){
					document.getElementById('us').style.display='block';
					document.getElementById('us').style.color='red';
					document.getElementById('us').innerHTML=" <div class='ag'></div><div id='f'>Username cannot be contain special characters!<br>";
					document.getElementById('Submit').removeAttribute('onclick');
					document.getElementById('Submit').style.cursor='not-allowed';
				}else{
					document.getElementById('us').style.display='none';
					document.getElementById('us').innerHTML='';
					document.getElementById('Submit').setAttribute('onclick','Submit()');
					document.getElementById('Submit').style.cursor='pointer';
				}
				console.log(countspec);
			}
			}
		});
		
		var ps=document.getElementById('password');
		
		
		ps.addEventListener("input",function(){
			var str=0;
			var pcs=0;
			var password=ps.value;
			if(password.length===0){
				document.getElementById('ps').style.display='block';
				document.getElementById('ps').innerHTML='Please fill password !';
				document.getElementById('Submit').removeAttribute('onclick');
				document.getElementById('Submit').style.cursor='not-allowed';
			}else{
				if(password.length<8){
					document.getElementById('ps').style.display='block';
					document.getElementById('ps').style.color='#343434';
					document.getElementById('ps').innerHTML="Password must be contain at least 8 characters !";
					document.getElementById('Submit').removeAttribute('onclick');
					document.getElementById('Submit').style.cursor='not-allowed';
				}else{
				for(var i=0;i<password.length;i++){
					for(var j=0;j<spec.length;j++){
						if(password.charAt(i)===spec[j]){
							pcs++;
						}
					}
					for(var k=0;k<num.length;k++){
						if (password.charAt(i)===num[k]) {
							str++;
						}
					}
				}
				console.log(str);
				if (str<1) {
					document.getElementById('ps').style.display='block';
					document.getElementById('ps').style.color='red';
					document.getElementById('ps').innerHTML="<div class='ag'></div><div id='f'>Password do not match !</div>";
					document.getElementById('Submit').removeAttribute('onclick');
					document.getElementById('Submit').style.cursor='not-allowed';
				}else{

					 if(str>1 && str<4){
					 	document.getElementById('ps').style.display='block';
					 	document.getElementById('ps').style.color='#3434';
						document.getElementById('ps').innerHTML="Normal<label class='rg'></label>";
						document.getElementById('Submit').setAttribute('onclick','Submit()');
						document.getElementById('Submit').style.cursor='pointer';
					}
					else if(str>3 && str<5){
						document.getElementById('ps').style.display='block';
						document.getElementById('ps').style.color='yellow';
						document.getElementById('ps').innerHTML="Medium<span class='rg'></span>";	
						document.getElementById('Submit').setAttribute('onclick','Submit()');
						document.getElementById('Submit').style.cursor='pointer';
					}else if(str>5){
						document.getElementById('ps').style.display='block';
						document.getElementById('ps').style.color='green';
						document.getElementById('ps').innerHTML="Strong<span class='rg'></span>";		
						document.getElementById('Submit').setAttribute('onclick','Submit()');
						document.getElementById('Submit').style.cursor='pointer';
					}			
				}
				if(pcs>0){
					document.getElementById('ps').style.display='block';
					document.getElementById('ps').style.color='red';
					document.getElementById('ps').innerHTML="<div class='ag'></div><div id='f'>Password cannot be contain special characters!<br>";
					document.getElementById('Submit').removeAttribute('onclick');
					document.getElementById('Submit').style.cursor='not-allowed';
				}else{
					document.getElementById('Submit').setAttribute('onclick','Submit()');
					document.getElementById('Submit').style.cursor='pointer';
				}
				
			}
			}
		});
		
		
	</script>
</body>
</html>