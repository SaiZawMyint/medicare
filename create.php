<?php
	session_start();

	 $rd=isset($_POST['rd']) ? $_POST['rd'] : '/Medicare';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Create</title>
<script type="text/javascript" src="js/create.js"></script>
<link rel="stylesheet" type="text/css" href="css/Login.css">
<link rel="icon" type="image/png" href="Img/chat.png">

</head>
<body>
<div id="mian_canvas"></div>
		<div id="login_box">
			<div class="header">Sign up account</div>
			<div id="in_canvas">
				<input type="text" id="username" class="text-in" placeholder="Username" title="Username" required><br>
				<div id="us" class="s"></div>
				<br>
				<input type="text" id="email_address" class="text-in" placeholder="Email-Address" title="Email-Address" required><br>
				<div id="es" class="s"></div>
				<br>
				<select id="gender" class="text-in">
					<option>Male</option>
					<option>Female</option>
				</select>
				<br>
				<br>
				<input type="password" id="password" class="text-in" placeholder="Password" title="Password" required><br>
				<div id="ps" class="s"></div>
				<br>
				<input type="password" id="con-pass" class="text-in" placeholder="Confirm Password" title="Confirm Password" required><br>
				<div id="cps" class="s"></div>
				<br>
			</div>
			<div id="ongo_status"></div>
			<div id="footer">
				<a href="rsp">Request password !</a><br><br>
				<input type="text" id="rd" value="<?php echo($rd) ?>" hidden>
				<button onclick="SubmitCreate()" id="Submit" class="Submit" title="Sign up">Sign up</button>
				<p class='create'> 
					<form action="Login.php" method="post">
					<input type="text" name="rd" value="<?php echo($rd) ?>" hidden>
					<button class="an-join">Already have account? Sign in !</button>
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
					document.getElementById('Submit').setAttribute('onclick','SubmitCreate()');
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
						document.getElementById('Submit').setAttribute('onclick','SubmitCreate()');
						document.getElementById('Submit').style.cursor='pointer';
					}
					else if(str>3 && str<5){
						document.getElementById('ps').style.display='block';
						document.getElementById('ps').style.color='yellow';
						document.getElementById('ps').innerHTML="Medium<span class='rg'></span>";	
						document.getElementById('Submit').setAttribute('onclick','SubmitCreate()');
						document.getElementById('Submit').style.cursor='pointer';
					}else if(str>5){
						document.getElementById('ps').style.display='block';
						document.getElementById('ps').style.color='green';
						document.getElementById('ps').innerHTML="Strong<span class='rg'></span>";		
						document.getElementById('Submit').setAttribute('onclick','SubmitCreate()');
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
					document.getElementById('Submit').setAttribute('onclick','SubmitCreate()');
					document.getElementById('Submit').style.cursor='pointer';
				}
				
			}
			}
		});
		
		var em=document.getElementById('email_address');
		em.addEventListener("input",function(){
			var emailaddress=em.value;
			var countspec=0;
			if(emailaddress.length === 0){
				document.getElementById('es').style.display='block';
				document.getElementById('es').innerHTML='Please fill Email-Address !';
				document.getElementById('Submit').removeAttribute('onclick');
				document.getElementById('Submit').style.cursor='not-allowed';
			}else{
			for(var i=0;i<emailaddress.length;i++){
				for(var j=0;j<spec.length;j++){
					if(emailaddress.charAt(i) === '@'){
						continue;
					}
					if(emailaddress.charAt(i) === '.'){
						continue;
					}
					if(emailaddress.charAt(i)===spec[j]){
						countspec++;
					}
				}
			}
			
			if(countspec>0){
				document.getElementById('es').style.display='block';
				document.getElementById('es').style.color='red';
				document.getElementById('es').innerHTML=" <div class='ag'></div><div id='f'>Username cannot be contain special characters!<br>";
				document.getElementById('Submit').removeAttribute('onclick');
				document.getElementById('Submit').style.cursor='not-allowed';
			}else{
				document.getElementById('es').style.display='none';
				document.getElementById('Submit').setAttribute('onclick','SubmitCreate()');
				document.getElementById('Submit').style.cursor='pointer';
			}
		}
		});
		
		var conpass=document.getElementById('con-pass');
		
		conpass.addEventListener("input",function(){
			
			var cp=conpass.value;
			var op=ps.value;
			
			if(cp.length===0){
				document.getElementById('cps').style.display='block';
				document.getElementById('cps').innerHTML='You need to comfrim your password for our security policy!';
				document.getElementById('Submit').removeAttribute('onclick');
				document.getElementById('Submit').style.cursor='not-allowed';
			}else{
			
			var cplength=cp.length;
			var checkopwithcp=op.slice(0,cplength);
			
			if(cp != checkopwithcp){
				document.getElementById('cps').style.display='block';
				document.getElementById('cps').style.color='red';
				document.getElementById('cps').innerHTML=" <div class='ag'></div><div id='f'>Password do not match!<br>";
				document.getElementById('Submit').removeAttribute('onclick');
				document.getElementById('Submit').style.cursor='not-allowed';
			}else{
				document.getElementById('cps').style.display='none';				
				document.getElementById('Submit').setAttribute('onclick','SubmitCreate()');
				document.getElementById('Submit').style.cursor='pointer';
			}
			
			}
		});
		
	</script>
</body>
</html>