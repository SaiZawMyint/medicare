//short function
function _(argument) {
	return document.getElementById(argument);
}
function __(argument) {
	return document.querySelector(argument);
}
function C_(argument) {
	return document.createElement(argument);
}

//show cs
var opcs=false;
function showCS() {
	if (!opcs) {
		__('.customer-chat-box').style.display='flex';
		__('.customer-support').classList.remove('chat-cs');
		__('.customer-support').classList.add('close-cs');
		opcs=true;
	}else{
		__('.customer-chat-box').style.display='none';
		__('.customer-support').classList.add('chat-cs');
		__('.customer-support').classList.remove('close-cs');
		opcs=false;
	}
	
}

//customer sent 
function Sent(sup) {
	if (sup==null) {
		var message=_('c-message');
		var m_f=C_('div');
		m_f.classList.add('message-field');
		var m_b=C_('span');
		m_b.classList.add('message-body');
		m_b.classList.add('c-m');
		if (message.value.length == 0) {
			m_b.innerHTML=' ';
		}else{
			m_b.innerHTML=message.value;
		}
		
		m_f.appendChild(m_b);
		__('.customer-chat-body').appendChild(m_f);
		message.value='';

		guessMessage(m_b.innerHTML);
	}else{

		var message=_('c-message');
		var m_f=C_('div');
		m_f.classList.add('message-field');
		var m_b=C_('span');
		m_b.classList.add('message-body');
		m_b.classList.add('c-m');
		m_b.innerHTML=sup;
		m_f.appendChild(m_b);
		__('.customer-chat-body').appendChild(m_f);
		message.value='';

		grep(m_b.innerHTML);

		

	}
	

}
//g
function grep(message) {
console.log(message);
	var m_f=C_('div');
		m_f.classList.add('message-field');
		var m_b=C_('span');
		m_b.classList.add('message-body');
		m_b.classList.add('s-m');
		m_b.setAttribute('id','1');
		var first=C_('span');
		first.classList.add("first");
		var second=C_('span');
		second.classList.add("second");
		var third=C_('span');
		third.classList.add("third");
		m_b.appendChild(first);
		m_b.appendChild(second);
		m_b.appendChild(third);
		m_f.appendChild(m_b);
		__('.customer-chat-body').appendChild(m_f);
		
		scroll();

		var second=0;
		function disTime(){
			second+=1;
		}
		setInterval(disTime, 1000);
		
	if (message !== `A` && message !== `B` && message !== `C` && message !== `D`) {
		setTimeout('limit("'+message+'")', 3000);		
			
	}else{
		setTimeout('replyG("'+message+'")', 3000);	
	}
}

//limit message

function limit(message) {
	_('1').innerHTML='<nav class="tip-inc">Sorry my knowledge is limited.<br><a href="/Medicare/Feedback">Feedback</a></nav>';
	_('1').classList.add('limit-message');
	_('1').removeAttribute('id');
	
	scroll();

	guessMessage(message);

}

function replyG(message) {
	var a='<i style="color: #e91e63;font-weight:bold;">Q-</i> '+_(message).innerHTML;
	_('1').innerHTML=a;
	_('1').removeAttribute('id');

	typing();

	Answer(message);

	scroll();

}

function sentsup(sup) {
	Sent(sup);
}

//guess messgae from user

function sleep(time,fun) {
	
}

//scroll

function scroll() {
	olist=__('.customer-chat-body');
	olist.scrollTop = olist.scrollHeight;

/**	var scroll=__('.customer-chat-body');
  	scroll.scrollIntoView({behavior: 'smooth',block: 'end'});*/
}

function typing() {
	var m_f=C_('div');
	m_f.classList.add('message-field');
	var m_b=C_('span');
	m_b.classList.add('message-body');
	m_b.classList.add('s-m');
	
	m_b.setAttribute('id','1');
	var first=C_('span');
	first.classList.add("first");
	var second=C_('span');
	second.classList.add("second");
	var third=C_('span');
	third.classList.add("third");
	m_b.appendChild(first);
	m_b.appendChild(second);
	m_b.appendChild(third);
	m_f.appendChild(m_b);
	__('.customer-chat-body').appendChild(m_f);
	scroll();
}

function guessMessage(message) {
		
		typing();

		var second=0;
		function disTime(){
			second+=1;
		}
		setInterval(disTime, 1000);
		
		setTimeout('reply("'+message+'")', 4000);

}

function reply(message) {
//	_('1').innerHTML=message;

	_('1').innerHTML='Hello,<br>How can I help you? Please choose your option<br>'+
	'<ul><li id="A" onclick="sentsup(`A`)">What is Medicare-Plan?</li><li id="B" onclick="sentsup(`B`)">How to enroll Medicare-Plan?</li>'+
	'<li id="C" onclick="sentsup(`C`)">Cannot enroll the plan!</li>'+
	'<li id="D" onclick="sentsup(`D`)">Others</li><br></ul><nav class="tip-in">You can click on the option or type A, B, C, D.</nav>';
	_('1').removeAttribute('id');
	scroll();

	_('sentbtn').removeAttribute('onclick');
	_('sentbtn').style.cursor='not-allowed';
	_('c-message').setAttribute('placeholder','Type A or B or C or D');
	var sup='';
	_('c-message').addEventListener('input',function() {
		sup=_('c-message').value;
		_('sentbtn').setAttribute('onclick','Sent("'+sup+'")');
		_('sentbtn').style.cursor='pointer';
	});


}
//

	var p_num=0;

function poll() {
	var mpf=C_('div');
		mpf.classList.add('message-poll-field');

		mbup=C_('span');
		mbup.classList.add('message-body');
		mbup.classList.add('useful');
		mbup.classList.add('poll');
		mbup.setAttribute("onclick","react("+p_num+",1)");
		mbup.setAttribute("id","r_"+p_num);
		p_num++;

		mbulp=C_('span');
		mbulp.classList.add('message-body');
		mbulp.classList.add('useless');
		mbulp.classList.add('poll');
		mbulp.setAttribute("onclick","react("+p_num+",2)");
		mbulp.setAttribute("id","r_"+p_num);
		p_num++;

		mbrp=C_('span');
		mbrp.classList.add('message-body');
		mbrp.classList.add('report');
		mbrp.classList.add('poll');
		mbrp.setAttribute("onclick","react("+p_num+",3)");
		mbrp.setAttribute("id","r_"+p_num);
		p_num++;

		mpf.appendChild(mbup);
		mpf.appendChild(mbulp);
		mpf.appendChild(mbrp);

		__('.customer-chat-body').appendChild(mpf);


}

//React


function react(arg,type) {
	if (type==1) {
		_('r_'+arg).removeAttribute('class');
		_('r_'+arg).setAttribute('class','message-body use_added poll');
		var un=arg+1;
		_('r_'+un).removeAttribute('class');
		_('r_'+un).setAttribute('class','message-body useless poll');
	}
	if (type==2) {
		_('r_'+arg).removeAttribute('class');
		_('r_'+arg).setAttribute('class','message-body use_added poll');
		var un=arg-1;
		_('r_'+un).removeAttribute('class');
		_('r_'+un).setAttribute('class','message-body useful poll');
	}
	if (type==3) {
		var rep=prompt("Enter your report");

		if (rep!==null && rep!=='') {
			_('r_'+arg).removeAttribute('class');
			_('r_'+arg).setAttribute('class','message-body use_added poll');
			_('r_'+arg).removeAttribute('onclick');
			_('r_'+arg).setAttribute('onclick','reported()');

			typing();
			var second=0;
			function disTime(){
				second+=1;
			}
			setInterval(disTime, 1000);
			
			setTimeout('replyD("'+rep+'")', 3000);
			
			
		}
	}
	
}

//reported alert

function reported() {
	window.alert('We recieved your reported');
}

//Answer 
function Answer(message) {
	if (message == 'A') {

		_('1').innerHTML="<i style='color: #e91e63;font-weight:bold;'>Ans-</i> "+
		"Medicare-Plan is the health care program that cover your medical cost. "+
		"The Medicare Plan is divided into three main parts. Each section has it's own "+
		"set of opportunities. Money saved from a medicare plan can be recovered with the good interest rate. If "+
		"you have a health emergency, you can withdraw your savings. If your savings are not enought for your problem, "+
		"you can get Emergency Lone Service (ELS) from medicare.<br>"+
		"<i>Credit <a href='/Medicare/'>What is Medicare-Plan?</a></i>";
		_('1').removeAttribute('id');
		poll();
		scroll();
	}

	if (message == 'B') {

		_('1').innerHTML="<i style='color: #e91e63;font-weight:bold;'>Ans-</i> "+
		"There're easy way to enroll the plan<br>"+
		"1. Go to <a href='/Medicare/Medicare-Plan/'>Medicare-Plan</a><br>"+
		"2. Choose the plan you want to enroll<br>"+
		"3. Click Enroll and fill the requirement<br>"+
		"4. Wait for the configuration message<br><br>"+
		"<nav class='tip-in'>Notic before you enroll the plan you need to <a href='/Medicare/login.php'>Login</a> or <a href='/Medicare/create.php'>Registration</a> to medicare "+
		"and you need to complete your personal information"+
		" such as e-mail configuration/Brith-date <a href='/Medicare/Profile/'> Check here </a> </nav>";
		_('1').removeAttribute('id');

		poll();
		
		scroll();
	}

	if (message == 'C') {

		_('1').innerHTML="<i style='color: #e91e63;font-weight:bold;'>Ans-</i> "+
		"There, we collected some solutions for this problem <br>"+
		"1. Make sure that you have been Registration <a href='/Medicare/Member/'> Check here </a><br>"+
		"2. Check your connection <br>"+
		"3. Check your personal information <a href='/Medicare/Profile/'> Check here </a><br>"+
		"4. Be patient, while waiting the configuration message<br><br>"+
		"<nav class='tip-in'>Notic before you enroll the plan you need to <a href='/Medicare/login.php'>Login</a> or <a href='/Medicare/create.php'>Registration</a> to medicare "+
		"and you need to complete your personal information"+
		" such as e-mail configuration/Brith-date <a href='/Medicare/Profile/'> Check here </a> </nav>";
		_('1').removeAttribute('id');

		poll();
		scroll();
	}

	if (message == 'D') {
		_('1').innerHTML='<nav class="tip-inc">Type your problem in the text box</nav>';
		_('1').classList.add('limit-message');
		_('1').removeAttribute('id');
		_('c-message').setAttribute('placeholder','type your problem');
		_('sentbtn').style.cursor='pointer';
		_('sentbtn').setAttribute('onclick','SentD()');

		var sup='';
		_('c-message').addEventListener('input',function() {
			sup=_('c-message').value;
		_('sentbtn').setAttribute('onclick','SentD("'+sup+'")');
		_('sentbtn').style.cursor='pointer';
		})
	}
}
//other message
function SentD(msg) {
		var message=_('c-message');


		if (message.value.length == 0) {
			alert("We can't recieve your problem");
		}else{

			var m_f=C_('div');
			m_f.classList.add('message-field');
			var m_b=C_('span');
			m_b.classList.add('message-body');
			m_b.classList.add('c-m');
			m_b.innerHTML=message.value;
			m_f.appendChild(m_b);
			__('.customer-chat-body').appendChild(m_f);
			message.value='';

			scroll();
			typing();
			var second=0;
			function disTime(){
				second+=1;
			}
			setInterval(disTime, 1000);
			
			setTimeout('replyD("'+msg+'")', 3000);
			}

}

function replyD(message) {
	_('1').innerHTML="We recieved your report. Thanks for Feedback us, hope you enjoy more.";
	_('1').classList.add('recieved-message');
	_('1').removeAttribute('id');

	typing();
	scroll();
	var second=0;
	function disTime(){
		second+=1;
	}
	setInterval(disTime, 1000);
	
	setTimeout('reply("'+message+'")', 3000);
			
	
}