
<?php

	include_once('xml/databases/dbconnections.php');

	session_start();

	$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;
	$open = isset($_POST['open']) ? true : false;

	$sql="SELECT * FROM medicares where username=?";

		if ($conn->connect_error) {
		die("Failed to connect : ".$conn->connect_error);
		}else{
		$stmt=$conn->prepare($sql);
		$stmt->bind_param("s",$username);
		$stmt->execute();
		$stmt_result=$stmt->get_result();

		if ($stmt_result->num_rows>0) {
			$data=$stmt_result->fetch_assoc();
			$src_prof=$data['profile'];
			$user_id=$data['id'];
		}else{
			
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Magazine Editor</title>
	<script type="text/javascript" src="\JNine-itech\cms-web-design-texteditor\JS/jnine-texteditor.js"></script>
	<link rel="icon" type="image/*" href="css/img/news_active.png">
	<link rel="stylesheet" type="text/css" href="css/editor.css">
	<link rel="stylesheet" type="text/css" href="css/basic_css.css">
	<script type="text/javascript" src="js/MGStyle.js"></script>
</head>
<body>
	<div id="main-body">
		<div id="header">
			<nav class="p_back" onclick="back();" title="Back"></nav>
			<h3>WEB-EDITOR</h3>
			<ul>
				<?php
					if ($username != null) {
					?>
						
						<li class="preview-console" onclick="previewer()" title="Preview Magazine"></li>
						<li class="mag_up" onclick="interview()" title="Upload Magazine"></li>
						
						<a href="Profile/"><li class="preview-console" style="background: url(<?php echo $src_prof;?>) no-repeat;background-size: 100% 100%;background-position: center;" title="<?php echo($username)?>"></li></a>
						<li class="more_act" title="More"></li>
					<?php
					}else{
						?>
							<form action="Login.php" method="POST">
								<input type="text" name="rd" value="/Medicare/MagazineEditor.php" hidden="hidden">
								<input type="submit" name="" class="login" value="Login">
							</form>
						<?php
					}					
					?>
			</ul>
		</div>
		<div id="b-field">
		<div id="tools">
			<div>
				<span id="t1" class="tools-menus layout-edit active" title="Layout" onclick="choiceTool(0)"></span>
				<span id="t2" class="tools-menus bg-col-icon" title="Customize Background" onclick="choiceTool(1)"></span>
				<!--<span id="t3" class="tools-menus bg-col-icon" title="Gradient background" onclick="choiceTool(2)"></span> -->
				<span id="t4" class="tools-menus openfile-icon" title="Open File" onclick="openF()"></span>
				<span id="t5" class="tools-menus hide-tools right" title="Close Tool Panel" onclick="closeTools()"></span>
			</div>
			<ul id="layout">
				<fieldset>
					<legend>Layouts</legend>
				<li class="layout1" onclick="Dolayout(1,'panel',false)">
					<nav class="normal-view">
						<nav class="row r2 n2">
							<nav class="col c2 cb"></nav>
							<nav class="col c2 cb"></nav>
						</nav>
						<nav class="row r2 n2">
							<nav class="col c1 cb"></nav>
						</nav>
					</nav>
					<nav class="hover">
						<label for="hover">Layout 1</label>
					</nav>
				</li>
				<li class="layout2" onclick="Dolayout(2,'panel',false)">
					<nav class="normal-view">
						<nav class="row r2 n2">
							<nav class="col c2 cb"></nav>
							<nav class="col c2 cb"></nav>
						</nav>
						<nav class="row r2 n2">
							<nav class="col c2 cb"></nav>
							<nav class="col c2 cb"></nav>
						</nav>
					</nav>
					<nav class="hover">
						<label for="hover">Layout 2</label>
					</nav>
				</li>
				<li class="layout3" onclick="Dolayout(3,'panel',false)">
					<nav class="normal-view">
						<nav class="row r2 n2">
							<nav class="col c1 cb"></nav>
						</nav>
						<nav class="row r2 n2">
							<nav class="col c2 cb"></nav>
							<nav class="col c2 cb"></nav>
						</nav>
					</nav>
					<nav class="hover">
						<label for="hover">Layout 3</label>
					</nav>
				</li>
				<li class="layout4" onclick="Dolayout(4,'panel',false)">
					<nav class="normal-view">
						<nav class="row r1 n1">
							<nav class="col c1 cb"></nav>
							
						</nav>
					</nav>
					<nav class="hover">
						<label for="hover">Layout 4</label>
					</nav>
				</li>
				<li class="layout5" onclick="Dolayout(5,'panel',false)">
					<nav class="normal-view">
						<nav class="row r2 n2">
							<nav class="col c2 cb"></nav>
							<nav class="col c2 cb"></nav>
						</nav>
						<nav class="row r2 n2">
							<nav class="col c3"></nav>
							<nav class="col c3"></nav>
							<nav class="col c3"></nav>
						</nav>
					</nav>
					<nav class="hover">
						<label for="hover">Layout 5</label>
					</nav>
				</li>
				<li class="layout6" onclick="Dolayout(6,'panel',false)">
					<nav class="normal-view">
						<nav class="row r2 n2">
							<nav class="col c1 cb"></nav>
						</nav>
						<nav class="row r2 n2">
							<nav class="col c3 cb"></nav>
							<nav class="col c3 cb"></nav>
							<nav class="col c3 cb"></nav>
						</nav>
					</nav>
					<nav class="hover">
						<label for="hover">Layout 6</label>
					</nav>
				</li>
				<li class="layout7" onclick="Dolayout(7,'panel',false)">
					<nav class="normal-view">
						<nav class="row r2 n2">
							<nav class="col c1 cb"></nav>
						</nav>
						<nav class="row r2 n2">
							<nav class="col c1 cb"></nav>
						</nav>
					</nav>
					<nav class="hover">
						<label for="hover">Layout 7</label>
					</nav>
				</li>
				<li class="layout8" onclick="Dolayout(8,'panel',false)">
					<nav class="normal-view">
						<nav class="row r1 n1">
							<nav class="col c2 cb"></nav>
							<nav class="col c2 cb"></nav>
						</nav>
					</nav>
					<nav class="hover">
						<label for="hover">Layout 8</label>
					</nav>
				</li>
				</fieldset>
			</ul>
			<ul id="backgroundColor" style="display: none;">
				<fieldset>
					<legend>Choose Color</legend>
					<li class="bgc" style="background-color: none;box-shadow: none;">
						<div class="bgc-row">
							<nav class="c-child col1" onclick="choseColor(1)"></nav>
							<nav class="c-child col2" onclick="choseColor(2)"></nav>
							<nav class="c-child col3" onclick="choseColor(3)"></nav>
							<nav class="c-child col4" onclick="choseColor(4)"></nav>
							<nav class="c-child col5" onclick="choseColor(5)"></nav>
							<nav class="c-child col6" onclick="choseColor(6)"></nav>
						</div>
						<div class="bgc-row">
							<nav class="c-child col7" onclick="choseColor(7)"></nav>
							<nav class="c-child col8" onclick="choseColor(8)"></nav>
							<nav class="c-child col9" onclick="choseColor(9)"></nav>
							<nav class="c-child col10" onclick="choseColor(10)"></nav>
							<nav class="c-child col11" onclick="choseColor(11)"></nav>
							<nav class="c-child col12" onclick="choseColor(12)"></nav>
						</div>
						<div class="bgc-row">
							<nav class="c-child col13" onclick="choseColor(13)"></nav>
							<nav class="c-child col14" onclick="choseColor(14)"></nav>
							<nav class="c-child col15" onclick="choseColor(15)"></nav>
							<nav class="c-child col16" onclick="choseColor(16)"></nav>
							<nav class="c-child col17" onclick="choseColor(17)"></nav>
							<nav class="c-child col18" onclick="choseColor(18)"></nav>
						</div>
					</li>
				</fieldset>
				<fieldset>
					<legend>Customize color</legend>
					<li class="cus-col" style="background-color: transparent;box-shadow: none;">
						<div class="show-res-cc" id="s-r-c"></div>
						<div class="filter-c" onclick="ColorClick()">
							<input type="color" id="fc" style="width: 0px;height: 0px;float: right;">
						</div>
					</li>
				</fieldset>
				
				<li></li>
			</ul>
		</div>
		<div id="panel">
	<?php
		if (open) {
			$filename=$_FILES["file"]["name"];
			$filetype=$_FILES["file"]["type"];
			$filetmp_name=$_FILES["file"]["tmp_name"];
			$filesize=$_FILES["file"]["size"];
			$fileerror=$_FILES["file"]["error"];
			echo $filetype."/".$filename;
		}
	?>
		</div>
		</div>
		<div id="footer"></div>
	</div>
	<div id="preview">
		<div id="result">
			<div id="header" style="height: 12%;">
				<h3>Preview</h3>
				<ul>
					<li class="close-pre-light" onclick="closePre()"></li>
				</ul>
			</div>
			<div id="obj"></div>
		</div>

	</div>
	<div id="alert-body">
		<div id="alert-box">
			<nav class="a-title">
				<nav class="a-a close-pre-light" id="b-c" onclick="cancelA()"></nav>
				<center><h3 id="a-title-f">hello</h3></center>
			</nav>

			<nav class="a-body" id="a-body-f"> 
				
			</nav>
			<nav class="a-footer" id="a-footer">
				<center><nav class="a-ok" id="a-ok-f" onclick="cancelA()">Ok</nav></center>
			</nav>
		</div>
	</div>
<!--	<div id="log-pre">
		<div id="log-title">
			<nav class="l-title"><nav class="log-icon"></nav><h3>Login</h3></nav>
		</div>
		<div id="log-body"></div>
		<div id="log-footer"></div>
	</div> -->
</body>
</html>