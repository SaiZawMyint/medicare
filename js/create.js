var spec=['`','!','"','£','$','%','^','&','*','(',')','+','[',']','{','}','#','?','>','<','/',',','.',';','@',':'];
	var num=['1','2','3','4','5','6','7','8','9','0'];
	var specc='';
	for(var i=0;i<spec.length;i++){
		specc+=" "+spec[i]+" ";
	}
	var ongo="";
var usernameprv="";

function SubmitCreate(){
	var rd=document.getElementById('rd').value;
	var username=document.getElementById('username').value;
	var password=document.getElementById('password').value;
	var emailaddress=document.getElementById('email_address').value;
	var con=document.getElementById('con-pass').value;
	var countspec=0;
	if(username.length===0){
		document.getElementById('us').style.display='block';
		document.getElementById('us').style.color='#343434';
		document.getElementById('us').innerHTML='Please fill username !';
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
			document.getElementById('us').innerHTML=" <div class='ag'></div><div id='f'>Username cannot be contain special characters!<br>"+
			" \n \n ( " +specc+" ) </div>";
			document.getElementById('Submit').removeAttribute('onclick');
			document.getElementById('Submit').style.cursor='not-allowed';
		}else{
			document.getElementById('us').style.display='none';
			document.getElementById('us').innerHTML='';
		}
		
	}
	var pcs=0;
	var str=0;
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
		if (str<1) {
			document.getElementById('ps').style.display='block';
			document.getElementById('ps').style.color='red';
			document.getElementById('ps').innerHTML="<div class='ag'></div><div id='f'>Password do not match !</div>";
			document.getElementById('Submit').removeAttribute('onclick');
			document.getElementById('Submit').style.cursor='not-allowed';
		}else{

			 if(str>1 && str<4){
			 	document.getElementById('ps').style.display='block';
			 	document.getElementById('ps').style.color='#000000';
				document.getElementById('ps').innerHTML="Normal<label class='rg'></label>";
			}
			else if(str>3 && str<5){
				document.getElementById('ps').style.display='block';
				document.getElementById('ps').style.color='yellow';
				document.getElementById('ps').innerHTML="Medium<span class='rg'></span>";			
			}else if(str>5){
				document.getElementById('ps').style.display='block';
				document.getElementById('ps').style.color='green';
				document.getElementById('ps').innerHTML="Strong<span class='rg'></span>";			
			}			
		}
		if(pcs>0){
			document.getElementById('ps').style.display='block';
			document.getElementById('ps').style.color='red';
			document.getElementById('ps').innerHTML="<div class='ag'></div><div id='f'>Password cannot be contain special characters!<br>"+
			" \n \n ( " +specc+" )</div>";
			document.getElementById('Submit').removeAttribute('onclick');
			document.getElementById('Submit').style.cursor='not-allowed';
		}
		
	}
	}

	if(con.length===0){
		document.getElementById('cps').style.display='block';
		document.getElementById('cps').innerHTML='Please enter this field!';
		document.getElementById('Submit').removeAttribute('onclick');
		document.getElementById('Submit').style.cursor='not-allowed';
	}else{
		document.getElementById('cps').style.display='none';				
		document.getElementById('Submit').setAttribute('onclick','SubmitCreate()');
		document.getElementById('Submit').style.cursor='pointer';
	}
	if(emailaddress.length===0){
		document.getElementById('es').style.display='block';
		document.getElementById('es').innerHTML='Please fill Email-Address !';
		document.getElementById('Submit').removeAttribute('onclick');
		document.getElementById('Submit').style.cursor='not-allowed';
	}else{
		document.getElementById('es').style.display='none';
		document.getElementById('Submit').setAttribute('onclick','SubmitCreate()');
		document.getElementById('Submit').style.cursor='pointer';
	}
/////////////

	
	
	if(countspec<1 && str>1 && pcs<1 && username.length>0 && password.length>0 && emailaddress.length>0 && con.length>0){
		var username=document.getElementById('username').value;
		var password=document.getElementById('password').value;
		var gender=document.getElementById('gender').value;
		document.getElementById('Submit').setAttribute('onclick','SubmitCreate()');
		document.getElementById('Submit').style.cursor='pointer';
			document.getElementById('us').style.display='none';
			document.getElementById('ps').style.display='none';
			
			var xmlhttp;
			if(window.XMLHttpRequest){
				xmlhttp=new XMLHttpRequest();
			}else{
				xmlhttp=new ActiveObject("Microsolf.XMLHTTP");
			}
			xmlhttp.open("POST","xml/create.php?username="+username+"&email="+emailaddress+"&password="+password+"&gender="+gender,true);
			xmlhttp.onreadystatechange=function(){
				if(xmlhttp.readyState==4 && xmlhttp.status == 200){
					var status=xmlhttp.responseText;
					if(status=="true"){
						document.getElementById('ongo_status').innerHTML='';
						document.getElementById('footer').innerHTML="<span class='loading-page'>Success we're redirecting you to the Medicare...</span>";
						usernameprv=username;
						OngoC(rd);
					}else{
						document.getElementById('ongo_status').innerHTML="<span style='color:#b1b1b1e6;margin-left:14%;border-radius:5px;background-color:#ff2d00cc;padding:3px;'>User name is already used!</span>";
					}
				}
			}
			xmlhttp.send(null);
		
}
	

}

function redirectPageC(rd){
//	var pass=document.getElementById('password');
//	window.location="HatChat?username="+usernameprv+"&password="+pass.value;
	document.getElementById('ongoing_pg').style.display='none';
	document.getElementById('ongoing_pg').innerHTML="<form action='"+rd+"' method='post' style='display:none;'><input type='text' name='username' id='username' value='"+usernameprv+"' hidden>" +
						"<button class='alert-in' id='letsgo' type='submit'>Let's Go</button>" +
						"</form>";
	document.getElementById('letsgo').click();
}

function OngoC(rd){
	document.getElementById('ongoing_pg').style.display='block';
	var second=0;
	function disTime(){
		second+=1;
		console.log(second);
	}
	setInterval(disTime, 1000);
	
	setTimeout("redirectPageC('"+rd+"')", 4000);
}