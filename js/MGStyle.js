
const layout_element = new Array();
const layout_rec = new Array();
const each_l_e = new Array();
const element_rec = new Array();
const magazine_title = new Array();

var countle = 0;

function Dolayout(num,parent,childT) {
	// body...
	if(num == 1){
		layout1(parent,childT);
	}
	if(num == 2){
		layout2(parent,childT);
	}
	if(num == 3){
		layout3(parent,childT);
	}
	if(num == 4){
		layout4(parent,childT);
	}
	if(num == 5){
		layout5(parent,childT);
	}
	if(num == 6){
		layout6(parent,childT);
	}
	if(num == 7){
		layout7(parent,childT);
	}
	if(num == 8){
		layout8(parent,childT);
	}
	if (childT) {
		cancelA();
	}
}
function back(){
	window.history.back();
}
var countli=0,countColor=0;
var countre=0;
function hoverElement(id,childT){
	var ele = document.createElement("nav");
	ele.classList.add("element-hover");
	ele.classList.add("we-editor-obj");
	ele.setAttribute("id","hover_r"+countre);
	countre++;
	var ul = document.createElement("ul");
	var liv = document.createElement("li");
	var li1 = document.createElement("li");
	var li2 = document.createElement("li");
	var li3 = document.createElement("li");
	
	liv.classList.add("u-vid");
	li1.classList.add("e-photo");
	li2.classList.add("e-text");
	li3.classList.add("text-edit");
	
	li1.setAttribute("title","Choose photo");
	li1.setAttribute("id","element"+countli);
	li1.setAttribute("onclick","doSomething('photo',"+id+",element"+countli+")");
	countli++;

	liv.setAttribute("title","Video");
	liv.setAttribute("id","element"+countli);
	liv.setAttribute("onclick","doSomething('video',"+id+",element"+countli+")");
	countli++;

	li2.setAttribute("title","Text editor");
	li2.setAttribute("id","element"+countli);
	li2.setAttribute("onclick","doSomething('text',"+id+",element"+countli+")");
	countli++;
	
	var col = document.createElement("input");
	col.setAttribute("type","color");
	col.style.width='100%';
	col.style.height='100%';
	col.style.borderRadius='50%';
	col.style.display='none';
	li3.appendChild(col);
	li3.setAttribute("title","Style sheet");
	li3.addEventListener("click",()=>{
		document.getElementById('alert-body').style.display="block";
		var title = document.getElementById('a-title-f');
		title.innerHTML="Custom Field";
		var body = document.getElementById('a-body-f');
		var ap = document.getElementById(id);
		var elements = customElement(ap,"Background*color","Foreground*color","CustomElement*text");

		body.appendChild(elements);
		document.getElementById('a-ok-f').setAttribute("onclick","cancelA()");
	});
	
	ul.appendChild(li1);
	ul.appendChild(liv);
	ul.appendChild(li2);
	ul.appendChild(li3);

if (!childT) {
	var li4 = document.createElement("li");
	li4.setAttribute("title","add layout");
	li4.classList.add("layout-edit");
	li4.setAttribute("onclick","layoutView("+id+")")
	ul.appendChild(li4);
}
	
	
	var cancelF = document.createElement("nav");
	cancelF.style.width="25px";
	cancelF.style.height="25px";
	cancelF.style.float = "right";
	cancelF.style.cursor="pointer";
	cancelF.style.position="relative";
	cancelF.style.borderRadius="50%";
	cancelF.style.margin="5px";
	cancelF.classList.add("close-pre-light");
	cancelF.setAttribute("title","close editor panel");

	cancelF.setAttribute("onclick","remove_field("+id+")");

	ele.appendChild(ul);
	ele.appendChild(cancelF);


	
	return ele;
}
function layoutView(id) {
	// body...
	document.getElementById('alert-body').style.display="block";
	var title = document.getElementById('a-title-f');
	title.innerHTML="Choose Layout";
	var body = document.getElementById('a-body-f');
	var elements = document.createElement("div");
	elements.setAttribute("id","tools");
	elements.innerHTML="<ul>\r\n" + 
"				<li class=\"layout1\" onclick=\"Dolayout(1,'"+id.id+"',"+true+")\">\r\n" + 
"					<nav class=\"normal-view\">\r\n" + 
"						<nav class=\"row r2 n2\">\r\n" + 
"							<nav class=\"col c2 cb\"></nav>\r\n" + 
"							<nav class=\"col c2 cb\"></nav>\r\n" + 
"						</nav>\r\n" + 
"						<nav class=\"row r2 n2\">\r\n" + 
"							<nav class=\"col c1 cb\"></nav>\r\n" + 
"						</nav>\r\n" + 
"					</nav>\r\n" + 
"					<nav class=\"hover\">\r\n" + 
"						<label for=\"hover\">Layout 1</label>\r\n" + 
"					</nav>\r\n" + 
"				</li>\r\n" + 
"				<li class=\"layout2\" onclick=\"Dolayout(2,'"+id.id+"',"+true+")\">\r\n" + 
"					<nav class=\"normal-view\">\r\n" + 
"						<nav class=\"row r2 n2\">\r\n" + 
"							<nav class=\"col c2 cb\"></nav>\r\n" + 
"							<nav class=\"col c2 cb\"></nav>\r\n" + 
"						</nav>\r\n" + 
"						<nav class=\"row r2 n2\">\r\n" + 
"							<nav class=\"col c2 cb\"></nav>\r\n" + 
"							<nav class=\"col c2 cb\"></nav>\r\n" + 
"						</nav>\r\n" + 
"					</nav>\r\n" + 
"					<nav class=\"hover\">\r\n" + 
"						<label for=\"hover\">Layout 2</label>\r\n" + 
"					</nav>\r\n" + 
"				</li>\r\n" + 
"				<li class=\"layout3\" onclick=\"Dolayout(3,'"+id.id+"',"+true+")\">\r\n" + 
"					<nav class=\"normal-view\">\r\n" + 
"						<nav class=\"row r2 n2\">\r\n" + 
"							<nav class=\"col c1 cb\"></nav>\r\n" + 
"						</nav>\r\n" + 
"						<nav class=\"row r2 n2\">\r\n" + 
"							<nav class=\"col c2 cb\"></nav>\r\n" + 
"							<nav class=\"col c2 cb\"></nav>\r\n" + 
"						</nav>\r\n" + 
"					</nav>\r\n" + 
"					<nav class=\"hover\">\r\n" + 
"						<label for=\"hover\">Layout 3</label>\r\n" + 
"					</nav>\r\n" + 
"				</li>\r\n" + 
"				<li class=\"layout4\" onclick=\"Dolayout(4,'"+id.id+"',"+true+")\">\r\n" + 
"					<nav class=\"normal-view\">\r\n" + 
"						<nav class=\"row r1 n1\">\r\n" + 
"							<nav class=\"col c1 cb\"></nav>\r\n" + 
"							\r\n" + 
"						</nav>\r\n" + 
"					</nav>\r\n" + 
"					<nav class=\"hover\">\r\n" + 
"						<label for=\"hover\">Layout 4</label>\r\n" + 
"					</nav>\r\n" + 
"				</li>\r\n" + 
"				<li class=\"layout5\" onclick=\"Dolayout(5,'"+id.id+"',"+true+")\">\r\n" + 
"					<nav class=\"normal-view\">\r\n" + 
"						<nav class=\"row r2 n2\">\r\n" + 
"							<nav class=\"col c2 cb\"></nav>\r\n" + 
"							<nav class=\"col c2 cb\"></nav>\r\n" + 
"						</nav>\r\n" + 
"						<nav class=\"row r2 n2\">\r\n" + 
"							<nav class=\"col c3\"></nav>\r\n" + 
"							<nav class=\"col c3\"></nav>\r\n" + 
"							<nav class=\"col c3\"></nav>\r\n" + 
"						</nav>\r\n" + 
"					</nav>\r\n" + 
"					<nav class=\"hover\">\r\n" + 
"						<label for=\"hover\">Layout 5</label>\r\n" + 
"					</nav>\r\n" + 
"				</li>\r\n" + 
"				<li class=\"layout6\" onclick=\"Dolayout(6,'"+id.id+"',"+true+")\">\r\n" + 
"					<nav class=\"normal-view\">\r\n" + 
"						<nav class=\"row r2 n2\">\r\n" + 
"							<nav class=\"col c1 cb\"></nav>\r\n" + 
"						</nav>\r\n" + 
"						<nav class=\"row r2 n2\">\r\n" + 
"							<nav class=\"col c3 cb\"></nav>\r\n" + 
"							<nav class=\"col c3 cb\"></nav>\r\n" + 
"							<nav class=\"col c3 cb\"></nav>\r\n" + 
"						</nav>\r\n" + 
"					</nav>\r\n" + 
"					<nav class=\"hover\">\r\n" + 
"						<label for=\"hover\">Layout 6</label>\r\n" + 
"					</nav>\r\n" + 
"				</li>\r\n" + 
"				<li class=\"layout7\" onclick=\"Dolayout(7,'"+id.id+"',"+true+")\">\r\n" + 
"					<nav class=\"normal-view\">\r\n" + 
"						<nav class=\"row r2 n2\">\r\n" + 
"							<nav class=\"col c1 cb\"></nav>\r\n" + 
"						</nav>\r\n" + 
"						<nav class=\"row r2 n2\">\r\n" + 
"							<nav class=\"col c1 cb\"></nav>\r\n" + 
"						</nav>\r\n" + 
"					</nav>\r\n" + 
"					<nav class=\"hover\">\r\n" + 
"						<label for=\"hover\">Layout 7</label>\r\n" + 
"					</nav>\r\n" + 
"				</li>\r\n" + 
"				<li class=\"layout8\" onclick=\"Dolayout(8,'"+id.id+"',"+true+")\">\r\n" + 
"					<nav class=\"normal-view\">\r\n" + 
"						<nav class=\"row r1 n1\">\r\n" + 
"							<nav class=\"col c2 cb\"></nav>\r\n" + 
"							<nav class=\"col c2 cb\"></nav>\r\n" + 
"						</nav>\r\n" + 
"					</nav>\r\n" + 
"					<nav class=\"hover\">\r\n" + 
"						<label for=\"hover\">Layout 8</label>\r\n" + 
"					</nav>\r\n" + 
"				</li>\r\n" + 
"			</ul>";

	elements.style.width="100%";
	body.appendChild(elements);
	document.getElementById('a-ok-f').setAttribute("onclick","cancelA()");
}
function remove_field(id) {
	// body...
	var parent = id.parentElement;
	var x = new Array();
	x = id.children;
	for (var i = 0; i < each_l_e.length; i++) {
		var each = each_l_e[i];
		var idp = each.slice(each.indexOf(",")+1,each.length);
		if(idp == id.id){
			each_l_e[i] = "";
		}
	}

	parent.removeChild(id);
}
var countFileInp=0;
var countText=0;
var countVid=0;
var fgColor="";
var VS="";
function doSomething(arg,id,li_id) {
	// body...

	if(arg == "photo"){
		var c = document.createElement("input");
		c.setAttribute("type","file");
		c.setAttribute("accept","image/*");
		c.setAttribute("id","file"+countFileInp);
		c.style.display="none";

		id.appendChild(c);

		choose('photo',"file"+countFileInp,id);
		countFileInp++;
	}
	if (arg == "video") {
		document.getElementById('alert-body').style.display="block";
		var title = document.getElementById('a-title-f');
		title.innerHTML="Video Rules";
		var body = document.getElementById('a-body-f');
		var vr = videoRule();
		document.getElementById('a-ok-f').setAttribute("onclick","ApplyVideo("+id.id+")");
		body.appendChild(vr);

	}
	if(arg == "text"){

		var f = document.createElement("nav");
		f.style.background="#0000002f";
		f.style.overflow="hidden";
		f.style.float="left";
		f.style.width="98%";
		f.style.minHeight="40px";
		f.style.margin="1%";
		var text = document.createElement("span");
		var editor = new TextEditor(text);
		editor.createEditor();
		text.style.minHeight="40px";
		text.style.float="left";
		text.classList.add('cus-textarea');
		text.setAttribute("placeholder","Write something here...");
		text.setAttribute("title","Text editor");
		text.setAttribute("id","text"+countText);

		var color = document.createElement("nav");
		color.setAttribute("title","Customize editor");
		color.classList.add("text-edit");
		color.classList.add("we-editor-obj");
	//	color.style.backgroundColor="#181256b8";
		color.style.marginBottom="-30px";
		color.style.marginRight="30px";
		color.style.position="relative";

		var col = document.createElement("input");
		col.setAttribute("id","color"+countli);
		col.setAttribute("type","color");
		col.style.width='100%';
		col.style.height='100%';
		col.style.borderRadius='50%';
		col.style.display='none';

		color.addEventListener("click",()=>{
			document.getElementById('alert-body').style.display="block";
			var title = document.getElementById('a-title-f');
			title.innerHTML="Custom text editor";
			var body = document.getElementById('a-body-f');

			var elements = customElement(text,"Background*color","Foreground*color","Font*text","Margin*text","Padding*text",
				"Width*text","Height*text","TextAlign*text","Border*text","Border-radius*text","Box-Shadow*text","CustomElement*text");

			body.appendChild(elements);
			document.getElementById('a-ok-f').setAttribute("onclick","cancelA()");
		});

		each_l_e[countle] = "text-"+text.id+","+id.id;
	//	console.log(each_l_e[countle]);
		countle++;


		var closeText = document.createElement("nav");
		closeText.style.width="25px";
		closeText.style.height="25px";
		closeText.style.float = "right";
		closeText.style.cursor="pointer";
		closeText.style.position="relative";
		closeText.style.borderRadius="50%";
		closeText.style.margin="3px";
		closeText.classList.add("close-pre");
		closeText.classList.add("we-editor-obj");
		closeText.style.marginBottom="-30px";
		closeText.setAttribute("title","close textarea");
	//	closeText.style.backgroundColor="#181256b8";

		closeText.addEventListener("click",()=>{
			var ser = "text-"+text.id+","+id.id;
			var rec = 0;
			for (var i = 0; i < each_l_e.length; i++) {
				if(each_l_e[i] == ser){
					rec = i;
				}
			}
		each_l_e[rec]="";
		id.removeChild(f);
		});

		color.appendChild(col);
		
		f.appendChild(closeText);
		f.appendChild(color);
		f.appendChild(text);
		id.appendChild(f);
	//	li_id.removeAttribute("onclick");
	//	li_id.setAttribute("onclick","reloadText(text"+countText+")");
		countText++;
	}
	/**if(arg == "text"){
		id.style.background='none';
		id.innerHTML=
		"<textarea style='width:90%;height:90%;padding:5% 5%;background-color:transparent;' id='text"
		+countText+"' placeholder='Write something here' title='You can enter html tag for style'></textarea>";
		countText++;
	}*/
	if (arg == "color") {

		li_id.click();
		var pre = li_id.id;
		var pretid=pre.slice(5,pre.length);
		var tid = "text"+pretid;
		var x = 0;
		x = pretid-1;
		var lastEle = "element"+x;
		var tid = document.getElementById(lastEle);
		li_id.addEventListener("change",()=>{
			fgColor=li_id.value;
			tid.click();
			
		});
	}
	
}

//create look and feel video roll
function videoRule(){
	var displayer = document.createElement("div");
	displayer.style.width="80%";
	displayer.style.marginLeft="10%";

	
	var tip1 = document.createElement("nav");
	tip1.style.float="left";
	var warn1 = document.createElement("span");
	warn1.style.width="1em";
	warn1.style.height="1em";
	warn1.style.float="left";
	warn1.classList.add("warning-icon");
	tip1.appendChild(warn1);
	var contip1 = document.createElement("span");
	contip1.innerHTML="Your video must accept the following requirement,<br>(1) No rude content,<br>(2) No effect other business,<br>(3) Video length must less than 30MB.<br><br>";

	var vdfield = document.createElement("fieldset");
	var legend = document.createElement("legend");
	legend.innerHTML="Choose Your video";
	legend.style.padding="5px 0px";
	vdfield.appendChild(legend);
    
	var vdP = document.createElement("div");
	vdP.style.width="100%";
	vdP.style.height="150px";
	vdP.style.backgroundSize="50%";
	vdP.style.borderRadius="5px";
	vdP.style.backgroundColor="rgb(48 68 154 / 80%)";
	vdP.style.cursor="pointer";
	vdP.classList.add("u-vid");
	vdP.style.transition="width 1s";
	vdP.style.float="left";
	vdP.style.position="relative";
	vdP.setAttribute("title","Click to choose video.");
	var vdf = document.createElement("input");
	vdf.type="file";
	vdf.accept="video/mp4";


	vdfield.appendChild(vdP);
	var vdshow = document.createElement("video");
//	vdshow.innerHTML="Your Browser unavaliable to play video.";
	vdshow.autoplay="true";
	vdshow.muted="true";
	vdshow.loop ="true";
	vdshow.style.width="100%";
	vdshow.style.height="100%";
	vdshow.style.border="1px solid #00bcd4";
	var source = document.createElement("source");
	source.type="video/mp4";
	vdshow.appendChild(source);
	vdshow.load();
	vdP.addEventListener("click",()=>{
		vdf.click();
	});
	var preV = document.createElement("span");
	preV.style.width="100%";
	preV.style.height="auto";
	preV.style.textAlign="center";
	preV.style.float="left";
	preV.style.marginBottom="-40px";
	preV.style.position="relative";
	preV.style.backgroundColor="#ffa50078";
	var v = false;
	vdf.addEventListener("change",displayVid);
		function displayVid(event){
			var vdfile = event.target.files;
			if (vdfile.length === 0) {
				console.log("Please, Choose file.")
				}
				var size = vdfile[0].size;
				if (size < 30000000) {
					var reader = new FileReader();
					reader.readAsDataURL(event.target.files[0]);
					reader.onload=function(e){
						source.src = e.target.result;
						VS = e.target.result;
						vdshow.load();
						preV.innerHTML="";
						preV.style.backgroundColor="transparent";
					};
					
				}else{
					preV.innerHTML="Video file is too large.";
					vdfield.appendChild(preV);
					source.src="";
					VS="";
					vdshow.load();
					preV.style.backgroundColor="#ffa50078";
				}
				vdfield.appendChild(vdshow);
				v = true;
				vdfield.removeChild(vdP);
				vdP.style.width="40px";
				vdP.style.height="40px";
				vdP.style.borderRadius="40px";
				vdP.style.backgroundSize="30px";
				vdP.style.margin="-50px 5px 5px 5px";
				vdfield.appendChild(vdP);
			
		};

//	vdfield.appendChild(vdP);
	
	tip1.appendChild(contip1);
	displayer.appendChild(tip1);
	displayer.appendChild(vdfield);
	return displayer;

}
//Apply Video
function ApplyVideo(id){
	if (VS != "") {
		videoGenerator(VS,id);
		VS="";
	}else{
		alert("You have not choose file yet.")
	}
	
}
//show video
function videoGenerator(videosource,id){
	var field = document.createElement("div");
	field.style.width="100%";
	field.style.height="auto";
	field.style.float="left";
	field.style.backgroundColor="transparent";
	field.style.overflow="hidden";

	var toolBar = document.createElement("div");
	toolBar.classList.add("we-editor-obj");
	toolBar.style.width="100%";
	toolBar.style.height="auto";
	toolBar.style.float="left";
	toolBar.style.backgroundColor="rgb(8 6 23 / 47%)";

	var vd = document.createElement("video");
	vd.style.width="100%";
	vd.style.height="100%";
	vd.style.float="left";
	vd.setAttribute("id","video"+countVid);

	each_l_e[countle]="video-"+vd.id+","+id.id;
	countle++;

	var cus = document.createElement("nav");
	cus.classList.add("text-edit");
	cus.style.float="right";
	cus.addEventListener("click",()=>{
		document.getElementById('alert-body').style.display="block";
		var title = document.getElementById('a-title-f');
		title.innerHTML="Custom Video";
		var body = document.getElementById('a-body-f');

		var elements = customElement(vd,"Width*text","Height*text","Margin*text","Padding*text",
			"Border*text","Border-radius*text","Box-Shadow*text","CustomElement*text");

		body.appendChild(elements);
		document.getElementById('a-ok-f').setAttribute("onclick","cancelA()");
	});

	var close = document.createElement("nav");
	close.style.float="right";
	close.style.width="25px";
	close.style.height="25px";
	close.classList.add("close-pre-light");
	close.style.cursor="pointer";
	close.addEventListener("click",()=>{
		var ser = "video-"+vd.id+","+id.id;
			var rec = 0;
			for (var i = 0; i < each_l_e.length; i++) {
				if(each_l_e[i] == ser){
					rec = i;
				}
			}
		each_l_e[rec]="";
		id.removeChild(field);
		for (var i = 0; i < each_l_e.length; i++) {
		console.log(each_l_e[i]);
	}
	});

	toolBar.appendChild(close);
	toolBar.appendChild(cus);

	

	countVid++;

	var s = document.createElement("source");
	s.src = videosource;
	vd.appendChild(s);
	vd.load();
	field.appendChild(toolBar);
	field.appendChild(vd);
	id.appendChild(field);
	for (var i = 0; i < each_l_e.length; i++) {
		console.log(each_l_e[i]);
	}
	cancelA();
}
//custom box
function customElement(AP,...args) {
	// body...
	var parent = document.createElement("nav");
	parent.classList.add("a-body");
	args.forEach(arg=>{
		var div = arg.indexOf("*");
		var attribute = arg.slice(0,div);
		var value = arg.slice(div+1,arg.length);

		var field = document.createElement("nav");
		field.classList.add("field");

		var attr = document.createElement("nav");
		attr.classList.add("attr");
		attr.innerHTML=attribute;

		if (attribute != "CustomElement") {
			var val = document.createElement("input");
			val.classList.add("value");
			val.style.color="#ffffff";
			if(value == "color"){
				val.setAttribute("type","color");
				val.value="-1 -1 -1";
			}
			if(value == "text"){
				val.setAttribute("type","text");
				val.setAttribute("placeholder",attribute);
			}
			if(value == "file"){
				val.setAttribute("type","file");
				val.setAttribute("placeholder",attribute);
			}
		}else{
			var val = document.createElement("textarea");
			val.classList.add("custom-t");
			val.setAttribute("placeholder","Enter CSS stylesheet for more.");

	}
		var attr1 = document.createElement("nav");
		attr.classList.add("attr");

		var res = document.createElement("div");
		res.classList.add("value");
		res.style.width='100%';
		if (attribute == "Cover") {
			val.accept="image/*";
		}
		val.addEventListener("input",(evt)=>{
			if(attribute == "Background"){
				AP.style.backgroundColor=val.value;
			}
			if(attribute == "Foreground"){
				AP.style.color=val.value;
			}
			if(attribute == "Font"){
				AP.style.fontFamily=val.value;
			}
			if(attribute == "Margin"){
				AP.style.margin=val.value;
			}
			if(attribute == "Padding"){
				AP.style.padding=val.value;
			}
			if(attribute == "Width"){
				AP.style.width=val.value;
				AP.style.minWidth=val.value;
				AP.style.maxWidth=val.value;
			}
			if(attribute == "Height"){
				AP.style.height=val.value;
				AP.style.minHeight=val.value;
				AP.style.maxHeight=val.value;
			}
			if(attribute == "Box-Shadow"){
				AP.style.boxShadow=val.value;
			}
			if(attribute == "Border"){
				AP.style.border=val.value;
			}
			if(attribute == "TextAlign"){
				AP.style.textAlign=val.value;
			}
			if(attribute == "Border-radius"){
				AP.style.borderRadius=val.value;
			}
			if(attribute == "MagazineTitle"){
				magazine_title[0] = val.value;
			}
			if(attribute == "Writter"){
				magazine_title[1] = val.value;
			}
			if(attribute == "Description"){
				magazine_title[2] = val.value;
			}
			if (attribute == "Cover") {
				var prec = document.createElement("img");
				prec.classList.add("value");
				prec.style.width="90%";
				prec.style.margin="5%";
				var files=evt.target.files;
				magazine_title[3] = files;
				if(files.length === 0){
					console.log('No file is selected !');
					return;
				}
				
				var reader=new FileReader();
				reader.onload=function(event){
					prec.src = event.target.result;
				};
				reader.readAsDataURL(files[0]);
				field.style.display='flex';
				res.appendChild(attr1);
				res.appendChild(prec);
				
			}
			if (attribute == "CustomElement") {
				AP.setAttribute("style",val.value);
			}
		});
		
		if (attribute!="CustomElement") {
			field.appendChild(attr);
			field.appendChild(val);
			parent.appendChild(field);
		}else{
			var fs = document.createElement("fieldset");
			var legend = document.createElement("legend");
			legend.style.padding="10px 10% 0px 10%";
			legend.innerHTML="Customize style sheet";
			fs.appendChild(legend);
			fs.appendChild(field);
			field.appendChild(val);
			parent.appendChild(fs);
		}
		
		
		
		parent.appendChild(res);
	});

	return parent;
}

function reloadText(tid){
	tid.style.color=fgColor;
}
var countImg=0;
function choose(arg,id1,id) {
	// body...
	if(arg == "photo"){
		var idss = document.getElementById(id1);
		idss.click();
		
		idss.addEventListener("change",getPhoto);
		function getPhoto(evt){

		var files=evt.target.files;
		if(files.length === 0){
			console.log('No file is selected !');
			return;
		}
		
		var reader=new FileReader();
		reader.onload=function(event){
			var img = document.createElement("img");
			img.setAttribute("id","img"+countImg);
			img.setAttribute("title","click to customize the photo");
		//	img.setAttribute("onclick","imgEvents(img"+countImg+")");
			img.classList.add("cus-img");
		 	img.src =event.target.result;
		/**	id.style.background="url("+imgs+") no-repeat";
			id.style.backgroundSize = "100%";*/

			img.addEventListener("click",()=>{
			document.getElementById('alert-body').style.display="block";
			var title = document.getElementById('a-title-f');
			title.innerHTML="Customize photo";
			var body = document.getElementById('a-body-f');

			var elements = customElement(img,"Width*text","Height*text","Margin*text","Padding*text","Border*text","Border-radius*text","Box-Shadow*text","CustomElement*text");

			body.appendChild(elements);
			document.getElementById('a-ok-f').setAttribute("onclick","cancelA()");
		});

			
			each_l_e[countle] = "photo-"+img.id+","+id.id;
		//	console.log(each_l_e[countle]);
			countle++;
		/*	var caption = document.createElement("input");
			caption.setAttribute("id","cap"+countImg);
			caption.setAttribute("type","text");
			caption.setAttribute("title","The caption of photo.\nYou can skip this,\nit will return null");
			caption.setAttribute("placeholder","Photo caption");
			caption.classList.add("photo-caption");
			caption.classList.add("we-cus-obj");
			each_l_e[countle] = "caption-"+caption.id+","+id.id;
		//	console.log(each_l_e[countle]);
			countle++;*/
			
			var closeImg = document.createElement("nav");
			closeImg.style.width="25px";
			closeImg.style.height="25px";
			closeImg.style.float = "right";
			closeImg.style.cursor="pointer";
			closeImg.style.marginBottom="-30px";
			closeImg.style.borderRadius="50%";
			closeImg.style.position="relative";
			closeImg.classList.add("close-pre");
			closeImg.classList.add("we-editor-obj");
			closeImg.setAttribute("title","close photo");

			countImg++;
			closeImg.addEventListener("click",()=>{
				
				var ser = "photo-"+img.id+","+id.id;
				var rec=0;
				for (var i = 0; i < each_l_e.length; i++) {
					if(each_l_e[i] == ser){
						rec = i;
					}
				}

				each_l_e[rec] = "";
				each_l_e[rec+1]="";

				id.removeChild(closeImg);
				id.removeChild(img);

			})

			id.appendChild(closeImg);
			id.appendChild(img);
			
		};
		reader.readAsDataURL(files[0]);
		
		
		};
	}
}

var countEle = 0;
//create and record

function createRecordElement(argument) {
	// body...

}

var layoutC=0;
function layout1(parent,childT) {
	// body...
	var mainview = document.createElement("nav");
	var row1 = document.createElement("nav");
	var row2 = document.createElement("nav");
	var r1_col1 =	document.createElement("nav");
	var r1_col2 =	document.createElement("nav");
	var r2_col1 =	document.createElement("nav");

	row1.classList.add("row");
	row1.classList.add("r2");
	r1_col1.classList.add("col");
	r1_col1.classList.add("c2");
	r1_col2.classList.add("col");
	r1_col2.classList.add("c2");
	row2.classList.add("row");
	row2.classList.add("r2");
	r2_col1.classList.add("col");
	r2_col1.classList.add("c1");
	row2.appendChild(r2_col1);

	row1.appendChild(r1_col1);
	row1.appendChild(r1_col2);

	r1_col1.setAttribute("id","vour"+countEle);
	var ele1 = hoverElement("vour"+countEle,childT);	
	countEle++;
	r1_col1.appendChild(ele1);

	var ele2 = hoverElement("vour"+countEle,childT);
	r1_col2.setAttribute("id","vour"+countEle);
	countEle++;
	r1_col2.appendChild(ele2);

	r2_col1.setAttribute("id","vour"+countEle);
	var ele3 = hoverElement("vour"+countEle,childT);
	countEle++;
	r2_col1.appendChild(ele3);

	mainview.classList.add("normal-view-panel");
	
	
	
	mainview.appendChild(row1);
	mainview.appendChild(row2);

	
	layout_rec[layoutC] = parent+"/1";
	layoutC++;


	document.getElementById(parent).appendChild(mainview);
}

function layout2(parent,childT) {
	var mainview = document.createElement("nav");

	var row1 = document.createElement("nav");
	var row2 = document.createElement("nav");

	var r1_col1 = document.createElement("nav");
	var r1_col2 = document.createElement("nav");

	var r2_col1 = document.createElement("nav");
	var r2_col2 = document.createElement("nav");

	var ele1 = hoverElement("vour"+countEle,childT);	
	r1_col1.setAttribute("id","vour"+countEle);
	countEle++;
	r1_col1.appendChild(ele1);

	var ele2 = hoverElement("vour"+countEle,childT);
	r1_col2.setAttribute("id","vour"+countEle);
	countEle++;
	r1_col2.appendChild(ele2);

	var ele3 = hoverElement("vour"+countEle,childT);
	r2_col1.setAttribute("id","vour"+countEle);
	countEle++;
	r2_col1.appendChild(ele3);

	var ele4 = hoverElement("vour"+countEle,childT);
	r2_col2.setAttribute("id","vour"+countEle);
	countEle++;
	r2_col2.appendChild(ele4);



	mainview.classList.add("normal-view-panel");
	row1.classList.add("row");
	row1.classList.add("r2");
	r1_col1.classList.add("col");
	r1_col1.classList.add("c2");
	r1_col2.classList.add("col");
	r1_col2.classList.add("c2");
	row1.appendChild(r1_col1);
	row1.appendChild(r1_col2);

	row2.classList.add("row");
	row2.classList.add("r2");
	r2_col1.classList.add("col");
	r2_col1.classList.add("c2");
	r2_col2.classList.add("col");
	r2_col2.classList.add("c2");
	row2.appendChild(r2_col1);
	row2.appendChild(r2_col2);

	mainview.appendChild(row1);
	mainview.appendChild(row2);

	layout_rec[layoutC] = parent+"/2";
	layoutC++;
	
	document.getElementById(parent).appendChild(mainview);

}

function layout3(parent,childT) {
	// body...
	var mainview = document.createElement("nav");

	var row1 = document.createElement("nav");
	var row2 = document.createElement("nav");

	var r1_col1 = document.createElement("nav");

	var r2_col1 = document.createElement("nav");
	var r2_col2 = document.createElement("nav");

	var ele1 = hoverElement("vour"+countEle,childT);	
	r1_col1.setAttribute("id","vour"+countEle);
	countEle++;
	r1_col1.appendChild(ele1);

	var ele2 = hoverElement("vour"+countEle,childT);
	r2_col1.setAttribute("id","vour"+countEle);
	countEle++;
	r2_col1.appendChild(ele2);

	var ele3 = hoverElement("vour"+countEle,childT);
	r2_col2.setAttribute("id","vour"+countEle);
	countEle++;
	r2_col2.appendChild(ele3);




	mainview.classList.add("normal-view-panel");
	row1.classList.add("row");
	row1.classList.add("r2");
	r1_col1.classList.add("col");
	r1_col1.classList.add("c1");
	
	row1.appendChild(r1_col1);
	

	row2.classList.add("row");
	row2.classList.add("r2");
	r2_col1.classList.add("col");
	r2_col1.classList.add("c2");
	r2_col2.classList.add("col");
	r2_col2.classList.add("c2");
	row2.appendChild(r2_col1);
	row2.appendChild(r2_col2);

	mainview.appendChild(row1);
	mainview.appendChild(row2);

	layout_rec[layoutC] = parent+"/3";
	layoutC++;
	

	document.getElementById(parent).appendChild(mainview);

}

function layout4(parent,childT) {
	// body...
	var mainview = document.createElement("nav");

	var row1 = document.createElement("nav");

	var r1_col1 = document.createElement("nav");
	
	var ele1 = hoverElement("vour"+countEle,childT);	
	r1_col1.setAttribute("id","vour"+countEle);
	countEle++;
	r1_col1.appendChild(ele1);



	mainview.classList.add("normal-view-panel");
	row1.classList.add("row");
	row1.classList.add("r1");
	r1_col1.classList.add("col");
	r1_col1.classList.add("c1");
	row1.appendChild(r1_col1);

	
	mainview.appendChild(row1);

	layout_rec[layoutC] = parent+"/4";
	layoutC++;
	

	document.getElementById(parent).appendChild(mainview);

}

function layout5(parent,childT) {
	// body...
	var mainview = document.createElement("nav");

	var row1 = document.createElement("nav");
	var row2 = document.createElement("nav");

	var r1_col1 = document.createElement("nav");
	var r1_col2 = document.createElement("nav");

	var r2_col1 = document.createElement("nav");
	var r2_col2 = document.createElement("nav");
	var r2_col3 = document.createElement("nav");

	var ele1 = hoverElement("vour"+countEle,childT);	
	r1_col1.setAttribute("id","vour"+countEle);
	countEle++;
	r1_col1.appendChild(ele1);

	var ele2 = hoverElement("vour"+countEle,childT);
	r1_col2.setAttribute("id","vour"+countEle);
	countEle++;
	r1_col2.appendChild(ele2);

	var ele3 = hoverElement("vour"+countEle,childT);
	r2_col1.setAttribute("id","vour"+countEle);
	countEle++;
	r2_col1.appendChild(ele3);

	var ele4 = hoverElement("vour"+countEle,childT);
	r2_col2.setAttribute("id","vour"+countEle);
	countEle++;
	r2_col2.appendChild(ele4);


	var ele5 = hoverElement("vour"+countEle,childT);
	r2_col3.setAttribute("id","vour"+countEle);
	countEle++;
	r2_col3.appendChild(ele5);


	mainview.classList.add("normal-view-panel");
	row1.classList.add("row");
	row1.classList.add("r2");
	r1_col1.classList.add("col");
	r1_col1.classList.add("c2");
	r1_col2.classList.add("col");
	r1_col2.classList.add("c2");
	row1.appendChild(r1_col1);
	row1.appendChild(r1_col2);

	row2.classList.add("row");
	row2.classList.add("r2");
	r2_col1.classList.add("col");
	r2_col1.classList.add("c3");
	r2_col2.classList.add("col");
	r2_col2.classList.add("c3");
	r2_col3.classList.add("col");
	r2_col3.classList.add("c3");
	row2.appendChild(r2_col1);
	row2.appendChild(r2_col2);
	row2.appendChild(r2_col3);

	mainview.appendChild(row1);
	mainview.appendChild(row2);

	layout_rec[layoutC] =parent+"/5";
	layoutC++;
	

	document.getElementById(parent).appendChild(mainview);
}

function layout6(parent,childT) {
	// body...
	var mainview = document.createElement("nav");

	var row1 = document.createElement("nav");
	var row2 = document.createElement("nav");

	var r1_col1 = document.createElement("nav");

	var r2_col1 = document.createElement("nav");
	var r2_col2 = document.createElement("nav");
	var r2_col3 = document.createElement("nav");

	var ele1 = hoverElement("vour"+countEle,childT);	
	r1_col1.setAttribute("id","vour"+countEle);
	countEle++;
	r1_col1.appendChild(ele1);

	var ele2 = hoverElement("vour"+countEle,childT);
	r2_col1.setAttribute("id","vour"+countEle);
	countEle++;
	r2_col1.appendChild(ele2);

	var ele3 = hoverElement("vour"+countEle,childT);
	r2_col2.setAttribute("id","vour"+countEle);
	countEle++;
	r2_col2.appendChild(ele3);


	var ele4 = hoverElement("vour"+countEle,childT);
	r2_col3.setAttribute("id","vour"+countEle);
	countEle++;
	r2_col3.appendChild(ele4);



	mainview.classList.add("normal-view-panel");
	row1.classList.add("row");
	row1.classList.add("r2");
	r1_col1.classList.add("col");
	r1_col1.classList.add("c1");
	row1.appendChild(r1_col1);

	row2.classList.add("row");
	row2.classList.add("r2");
	r2_col1.classList.add("col");
	r2_col1.classList.add("c3");
	r2_col2.classList.add("col");
	r2_col2.classList.add("c3");
	r2_col3.classList.add("col");
	r2_col3.classList.add("c3");
	row2.appendChild(r2_col1);
	row2.appendChild(r2_col2);
	row2.appendChild(r2_col3);

	mainview.appendChild(row1);
	mainview.appendChild(row2);

	layout_rec[layoutC] = parent+"/6";
	layoutC++;
	

	document.getElementById(parent).appendChild(mainview);

}
function layout7(parent,childT) {
	// body...
	var mainview = document.createElement("nav");

	var row1 = document.createElement("nav");

	var r1_col1 = document.createElement("nav");
	
	var row2 = document.createElement("nav");

	var r2_col1 = document.createElement("nav");
	
	var ele1 = hoverElement("vour"+countEle,childT);	
	r1_col1.setAttribute("id","vour"+countEle);
	countEle++;
	r1_col1.appendChild(ele1);

	var ele3 = hoverElement("vour"+countEle,childT);
	r2_col1.setAttribute("id","vour"+countEle);
	countEle++;
	r2_col1.appendChild(ele3);



	mainview.classList.add("normal-view-panel");
	row1.classList.add("row");
	row1.classList.add("r2");
	r1_col1.classList.add("col");
	r1_col1.classList.add("c1");
	row1.appendChild(r1_col1);

	row2.classList.add("row");
	row2.classList.add("r2");
	r2_col1.classList.add("col");
	r2_col1.classList.add("c1");
	row2.appendChild(r2_col1);

	
	mainview.appendChild(row1);
	mainview.appendChild(row2);

	layout_rec[layoutC] = parent+"/7";
	layoutC++;
	

	document.getElementById(parent).appendChild(mainview);

}

function layout8(parent,childT) {
	// body...
	var mainview = document.createElement("nav");

	var row1 = document.createElement("nav");

	var r1_col1 = document.createElement("nav");
	var r1_col2 = document.createElement("nav");
	
	var ele1 = hoverElement("vour"+countEle,childT);	
	r1_col1.setAttribute("id","vour"+countEle);
	countEle++;
	r1_col1.appendChild(ele1);

	var ele4 = hoverElement("vour"+countEle,childT);
	r1_col2.setAttribute("id","vour"+countEle);
	countEle++;
	r1_col2.appendChild(ele4);




	mainview.classList.add("normal-view-panel");
	row1.classList.add("row");
	row1.classList.add("r1");
	r1_col1.classList.add("col");
	r1_col1.classList.add("c2");
	r1_col2.classList.add("col");
	r1_col2.classList.add("c2");
	row1.appendChild(r1_col1);
	row1.appendChild(r1_col2);

	mainview.appendChild(row1);

	layout_rec[layoutC] = parent+"/8";
	layoutC++;
	

	document.getElementById(parent).appendChild(mainview);

}

function cancelA() {
	document.getElementById('alert-body').style.display="none";
	document.getElementById('a-title-f').innerHTML="";
	document.getElementById('a-body-f').innerHTML="";
	document.getElementById('a-ok-f').removeAttribute("onclick");
}
function previewer(){
	document.getElementById('preview').style.display='block';
	var ob = document.getElementById("obj");
	var panel = document.getElementById('panel');
	ob.style.backgroundColor=panel.style.backgroundColor;

	var countCurrentEditor = 0,newCCE = 0;
	var weEditorObj = document.getElementsByClassName('we-editor-obj');
	countCurrentEditor = weEditorObj.length;

	ob.innerHTML = panel.innerHTML;

	var newWEO = document.getElementsByClassName("we-editor-obj");
	newCCE = newWEO.length;
	for(var i = countCurrentEditor ; i < newCCE ; i++){
		var c = newWEO[i];
		c.style.display="none";
	}
	
	

}
function Objects(){
	document.getElementById('preview').style.display='block';
	document.getElementById("obj").style.backgroundColor=document.getElementById('panel').style.backgroundColor;
	countCurrent=0;
	
	var current=0;
	for (var i = 0; i < layout_rec.length; i++) {
		var p_obj = layout_rec[i].slice(0,layout_rec[i].indexOf("/"));
		var l_c = parseInt(layout_rec[i].slice(layout_rec[i].indexOf("/")+1,layout_rec[i].length));

		var mainBody;
		if (p_obj == "panel") {
			mainBody = document.getElementById('obj');
		}else{
			var cInt = p_obj.slice(4,p_obj.length);
			var mid = "nav"+cInt;
			mainBody = document.getElementById(mid);
		}


		if (l_c == 1) {
			var row = createRow(2,2);
			var row1 = createRow(2,1);

			mainBody.appendChild(row);
			mainBody.appendChild(row1);
		}
		if (l_c == 2) {
			
			var row = createRow(2,2);
			var row1 = createRow(2,2);

			mainBody.appendChild(row);
			mainBody.appendChild(row1);
		}
		if (l_c == 3) {
			
			var row = createRow(2,1);
			var row1 = createRow(2,2);

			mainBody.appendChild(row);
			mainBody.appendChild(row1);
		}
		if (l_c == 4) {
			
			var row = createRow(1,1);

			mainBody.appendChild(row);
		}
		if (l_c == 5) {
			
			var row = createRow(2,2);
			var row1 = createRow(2,3);

			mainBody.appendChild(row);
			mainBody.appendChild(row1);
		}
		if (l_c == 6) {
			
			var row = createRow(2,1);
			var row1 = createRow(2,3);

			mainBody.appendChild(row);
			mainBody.appendChild(row1);
		}
		if (l_c == 7) {
			
			var row = createRow(2,1);
			var row1 = createRow(2,1);

			mainBody.appendChild(row);
			mainBody.appendChild(row1);
		}
		if (l_c == 8) {
			
			var row = createRow(1,2);

			mainBody.appendChild(row);
		}
	}


	
}

var countCurrent = 0;
function createRow(num,child) {
	// body...
	var row = document.createElement("nav");
	row.style.boxShadow = "none";
	row.style.margin="0";
	row.classList.add("row");
	row.classList.add("r"+num);
	
//	row.classList.add("n"+num);
	
	for (var i = 0; i < child; i++) {
		var c = document.createElement("nav");
		var sc = "c"+child;
		c.style.boxShadow = "none";
		c.style.margin="0";
		c.classList.add("col");
		c.classList.add(sc);
		c.setAttribute("id","nav"+countCurrent);

		updateFeelElement(c);

		countCurrent++;
		
		row.appendChild(c);

	}

	return row;
}

function updateFeelElement(id) {
	var pre = id.id;
	var preId = 0;

	preId = pre.slice(3,pre.length);

	var idi = "vour"+preId;
	var countchild = 0;
	var rec_pos = new Array();
	for (var i = 0; i < each_l_e.length; i++) {
		var get = each_l_e[i];
		var def = get.indexOf("-");
		var pos = get.indexOf(",");

		var type = get.slice(0,def);
		var child = get.slice(def+1,pos);
		var parent = get.slice(pos+1,get.length);
		if(parent == idi){
			var children = document.getElementById(child);
			var parents = document.getElementById(parent);
			if (children != null && parents != null) {
				id.setAttribute("style",parents.getAttribute("style"));

				if(type == "photo"){
					var img = document.createElement("img");
					img.src = children.src;
					img.setAttribute("style",children.getAttribute("style"));
					id.appendChild(img);
				}
			/*	if(type == "caption"){
					var label = document.createElement("label");
					label.innerHTML = children.value;
					label.classList.add("photo-caption");
					if(children.value.length !=0){
						id.appendChild(label);
					}
					
				}*/
				if(type == "text"){
					var p = document.createElement("div");
					p.innerHTML = children.innerHTML;

					var oldstyle = children.getAttribute("style");
					p.setAttribute("style",oldstyle);
					p.classList.add("d-text");

					id.appendChild(p);
				}
				if (type == "video") {
					var vid = document.createElement("video");
					vid.innerHTML = children.innerHTML;
					vid.controls="true";
					vid.loop="true";
					vid.muted="true";
					vid.load();
					var olds = children.getAttribute("style");
					vid.setAttribute("style",olds);
					id.appendChild(vid);
				}
			}
		}

	}

}

function closePre() {
	document.getElementById('preview').style.display="none";
	document.getElementById('obj').innerHTML='';
}

//step f
function interview() {
	// body...
	document.getElementById('alert-body').style.display="block";
	var title = document.getElementById('a-title-f');
	title.innerHTML="Fill File Detail";
	var body = document.getElementById('a-body-f');
	var xmp = document.createElement("input");
	var elements = customElement(xmp,"MagazineTitle*text","Writter*text","Description*text","Cover*file");

	body.appendChild(elements);
	document.getElementById('a-ok-f').setAttribute("onclick","checkT()");
}
function checkT() {
	// body...
	if(magazine_title[0] != null && magazine_title[1] != null){
		uploadMagazine();
	}else{
		alert("Please filled all requirement !");
	}
}
var AJ;
//upload
function uploadMagazine() {
	// body...
	previewer();
	var magazine = document.getElementById("obj");
	var title = magazine_title[0];
	var Writter = magazine_title[1];
	var Comment = magazine_title[2];
	var mag_cover = magazine_title[3][0];
	var orbgs = document.getElementById('panel').style.backgroundColor;
	var data = "<div id='obj' style='background-color:"+orbgs+";'>"+magazine.innerHTML+"</div>";
	var form = new FormData();
	form.append("magazine",data);
	form.append("title",title);
	form.append("Writter",Writter);
	form.append("Comment",Comment);
	form.append("file1",mag_cover);
	var ajax = new XMLHttpRequest();
	AJ = ajax;
	var prog = document.createElement("progress");
	prog.setAttribute("value","0");
	prog.setAttribute("max","100");
	prog.setAttribute("id","prog_bar");
	prog.style.width="80%";
	prog.style.float="left";
	prog.style.marginLeft="10%";
	prog.value=50;

	var lab = document.createElement("label");
	lab.setAttribute("id","loadingLab");
	lab.innerHTML="Loading";
	lab.style.textAlign="center";
	lab.style.width="100%";
	cancelA();

	var alert = document.getElementById('alert-body').style.display="block";
	var title = document.getElementById('a-title-f');
	title.innerHTML="Uploading file";
	var body = document.getElementById('a-body-f');
	document.getElementById('a-ok-f').innerHTML="Cancel";
	document.getElementById('b-c').style.display="none";
	document.getElementById('a-ok-f').setAttribute("onclick","AbortUpload()");
	body.appendChild(lab);
	body.appendChild(prog);

	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", loadHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST","xml/UploadMagazine.php");
//	ajax.open("POST","xml/test.php");
	ajax.send(form);
	ajax.onreadystatechange=function(){
		if(ajax.readyState==4 && ajax.status == 200){
			document.getElementById("a-ok-f").removeAttribute("onclick");
			prog.style.display="none";
			lab.innerHTML=ajax.responseText;
			document.getElementById('a-ok-f').innerHTML="OK";
			document.getElementById('a-ok-f').setAttribute("onclick","cancelA()");
		}
	}
}
function AbortUpload(){
	var ajax = AJ;
	ajax.abort();
	document.getElementById('a-ok-f').innerHTML="OK";
	document.getElementById('b-c').style.display="block";
	magazine_title[0]=null;
	magazine_title[1]=null;
	magazine_title[2]=null;
	magazine_title[3]=null;
	cancelA();
}
//calculate file size
function calculateFileSize(bytes){
	const sizes = ['Bytes','KB','MB','GB','TB'];
	const i = parseInt(Math.floor(Math.log(bytes)/Math.log(1024)),10);
	return`${(bytes/(1024 ** i)).toFixed(1)} ${sizes[i]}`;
}
function progressHandler(event){
	var percent=(event.loaded/event.total)*100;
	document.getElementById('loadingLab').innerHTML=Math.round(percent)+"% of "+calculateFileSize(event.total);
	document.getElementById('prog_bar').value = Math.round(percent);
}
function loadHandler(event){
	var res =event.target.responseText;
	console.log(res);
}
function errorHandler(event){
	var res="Failed to upload.";
	document.getElementById('loadingLab').innerHTML=res;
}
function abortHandler(event){
	var res ="Upload canceled.";
	document.getElementById('loadingLab').innerHTML=res;
}
//bg color customizing...
function ColorClick(){
	var color = document.getElementById('fc');
	color.click();
	color.addEventListener("input",(evt)=>{
		updatePreviewColor(color.value);
	});
}
function choseColor(index){
	if (index == 1) {
		updatePreviewColor("white");
	}
	if (index == 2) {
		updatePreviewColor("whitesmoke");
	}
	if (index == 3) {
		updatePreviewColor("silver");
	}
	if (index == 4) {
		updatePreviewColor("darkgray");
	}
	if (index == 5) {
		updatePreviewColor("gray");
	}
	if (index == 6) {
		updatePreviewColor("black");
	}
	if (index == 7) {
		updatePreviewColor("#00bcd4");
	}
	if (index == 8) {
		updatePreviewColor("#03a9f4");
	}
	if (index == 9) {
		updatePreviewColor("#2196f3");
	}
	if (index == 10) {
		updatePreviewColor("#3f51b5");
	}
	if (index == 11) {
		updatePreviewColor("#673ab7");
	}
	if (index == 12) {
		updatePreviewColor("#9c27b0");
	}
	if (index == 13) {
		updatePreviewColor("#ffeb3b");
	}
	if (index == 14) {
		updatePreviewColor("#ffc107");
	}
	if (index == 15) {
		updatePreviewColor("#ff9800");
	}
	if (index == 16) {
		updatePreviewColor("#ff5722");
	}
	if (index == 17) {
		updatePreviewColor("#f44336");
	}
	if (index == 18) {
		updatePreviewColor("#e91e63");
	}
}
function updatePreviewColor(color) {
	var src = document.getElementById('s-r-c');
	var panel = document.getElementById('panel')
	src.style.backgroundColor=color;
	panel.style.backgroundColor=color;	
}

//tools options
function choiceTool(index) {
	// body...
	if(index == 0){
		document.getElementById('layout').style.display="block";
		document.getElementById('backgroundColor').style.display="none";	
		document.getElementById('t1').classList.add("active");
		document.getElementById('t2').classList.remove("active");

	}

	if(index == 1){
		document.getElementById('layout').style.display="none";
		document.getElementById('backgroundColor').style.display="block";	
		document.getElementById('t2').classList.add("active");
		document.getElementById('t1').classList.remove("active");
		
	}

	if (!tooldisplay) {
		var tool = document.getElementById('tools');
		var panel = document.getElementById('panel');
		tool.style.width="25%";
		panel.style.width="75%";
		tooldisplay=true;
		document.getElementById('t5').style.transform="rotate(180deg)";
		document.getElementById('t5').style.float="right";
	}
	
}

//
var tooldisplay=true;
function closeTools() {
	// body...
	
	restoreTool();
}
function restoreTool() {
	// body...
	var tool = document.getElementById('tools');
	var panel = document.getElementById('panel');
	if (tooldisplay) {
		tool.style.width="0%";
		panel.style.width="100%";
		document.getElementById('t5').style.transform="rotate(360deg)";
		document.getElementById('t5').style.float="left";
		tooldisplay=false;
	}else{
		tool.style.width="25%";
		panel.style.width="75%";
		tooldisplay=true;
		document.getElementById('t5').style.transform="rotate(180deg)";
		document.getElementById('t5').style.float="right";
	}
}

function openF() {
	var f = document.createElement("input");
	f.type="file";
	f.click();
	f.addEventListener("change",(e)=>{
		
	});
}