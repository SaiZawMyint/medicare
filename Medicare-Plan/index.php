<?php
	
	session_start();

	if (!isset($_SESSION['username'])) {
		$log=true;
	}else{
		$log=false;


		$username=$_SESSION['username'];


	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Enroll Medicare-Plan</title>
	<link rel="icon" type="image/png" href="/Medicare/css/Img/my_plan.png">
	<link rel="stylesheet" type="text/css" href="/Medicare/css/medicare-plan.css">
	<script type="text/javascript" src="/Medicare/js/csar.js"></script>
	<script type="text/javascript">
		function back(){
			window.history.back();
		}
	</script>
</head>
<body>
<div id="main-body">
	<div class="bg-header">
		<div class="md-header">
			<nav class="back" onclick="back()"></nav>
			<h3>Medicare-Plan</h3>
			<ul>
				<li class="email"><nav>Email</nav></li>
				<li class="md"><nav>Medicare</nav></li>
				<li class="fb"><nav>Facebook</nav></li>
				<li class="tt"><nav>Twitter</nav></li>
			</ul>
		</div>
		<div class="plan-space">
			<div class="plan-field">
				<nav class="header-p"><h3>Plan A<br>
					<small>Normal Plan</small>
				</h3><h4></h4></nav>
				<nav class="p-body">
					<ul>
						<li>Normal Plan</li>
						<li>Free 10% of cost in <a href=''>Medicare Shop</a></li>
						<li>Inpatient care</li>
						<li><strong>Emergency Lone</strong> with 5% of insterst rate</li>
					</ul>
				</nav>
				<div class="footer-p">
					<div class="info">Information</div>
					<div class="enroll">Enroll</div>
				</div>
			</div>
			<div class="plan-field">
				<nav class="header-p"><h3>Plan B
					<br><small>Premium Plan</small></h3><h4></h4></nav>
				<nav class="p-body">
					<ul>
						<li>Normal Plan</li>
						<li>Free 10% of cost in <a href=''>Medicare Shop</a></li>
						<li>Inpatient care</li>
						<li><strong>Emergency Lone</strong> with 5% of insterst rate</li>
					</ul>
				</nav>
				<div class="footer-p">
					<div class="info">Information</div>
					<div class="enroll">Enroll</div>
				</div>
			</div>
			<div class="plan-field">
				<nav class="header-p"><h3>Plan C
					<br><small>Special Plan</small></h3><h4></h4></nav>
				<nav class="p-body">
					<ul>
						<li>Normal Plan</li>
						<li>Free 10% of cost in <a href=''>Medicare Shop</a></li>
						<li>Inpatient care</li>
						<li><strong>Emergency Lone</strong> with 5% of insterst rate</li>
					</ul>
				</nav>
				<div class="footer-p">
					<div class="info">Information</div>
					<div class="enroll">Enroll</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="notification-box"></div>

<!-- customer support -->
<div class="customer-chat-box">
	<div class="customer-chat-header">
		<h3>Customer Support</h3>
		<nav title="Report issue"></nav>
	</div>
	<div class="customer-chat-body">
		<div class="tip">Refreshing or Leaving the page, all data will be clear !</div>
		<div class="message-field">
			<span class="message-body s-m">Dear customer,<br>This's auto reply system. If this's not helping your problem, please
				feedback us here
				<a href="/Medicare/feedback">Feedback</a><br>
			</span>
		</div>

		
	</div>
	<div class="customer-chat-footer">
		<textarea placeholder="Write something here" id="c-message"></textarea>
		<button title="sent" id="sentbtn" onclick="Sent()"></button>
	</div>
</div>
<div class="customer-support chat-cs" onclick="showCS()"></div>
<script type="text/javascript">
	
	var message=_('c-message');
	
	message.addEventListener('focus',function () {
		
	});

	message.onfocus=function () {
		
	};
	

</script>
</body>
</html>