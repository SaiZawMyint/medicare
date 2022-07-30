
function pp(){
	const ppblock=document.getElementById('ppchose');
	ppblock.click();
	ppblock.addEventListener("change",function(){
		if(ppblock.value){
			var ppchoosen="image/"+ppblock.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
		}else{
			
		}
	});
}



//darkmood
var dark=false;
function darkMood() {
	if (!dark) {
		_('dark').classList.toggle('active');
		document.body.style.backgroundColor='#343434';
		document.body.style.color='#ffffff';

		__('.alert-in-box').style.backgroundColor='#343434';
		__('.alert-in-box').style.border='2px solid';
		__('.alert-in-box-header').style.backgroundColor='#ffffff9b';

		localStorage.setItem('mood','dark');

		dark=true;
	}else{
		_('dark').classList.toggle('active');
		document.body.style.backgroundColor='#ffffff';
		document.body.style.color='#343434';

		localStorage.removeItem('mood');
		__('.alert-in-box').style.backgroundColor='#ffffff';
		__('.alert-in-box').style.border='none';
		dark=false;
	}
	
}


var showstore=false;
function ShowStores(){
	if (!showstore) {
		document.getElementById('store_overviews').style.display='block';
		__('#health-icon-menu').style.transform='rotate(0deg)';
		showstore=true;
	}else{
		_('store_overviews').style.display='none';
		__('#health-icon-menu').style.transform='rotate(270deg)';
		showstore=false;
	}
	
}

function back(){
	window.history.back();
}

var spec=false;
function ShowSpec(){
	if (!spec) {
		document.getElementById('special_overviews').style.display='block';
		__('#shop-icon-menu').style.transform='rotate(0deg)';
		spec=true;
	}else{
		_('special_overviews').style.display='none';
		__('#shop-icon-menu').style.transform='rotate(270deg)';
		spec=false;
	}
	
}

//



//short funcitons

function _(eid){
			return document.getElementById(eid);
		}
		function __(qsl){
			return document.querySelector(qsl);
		}



var opn=false;


//home
var opn_home=true;
function home(){
	window.location.reload();
	if (!opn_home) {
		_('m-m-menu').classList.add('m-m-menu');
		_('m-m-menu').classList.remove('m-m-menu-close');
		_('home').classList.add('home_active');
		if (opn) {
			__('.lf-prof').style.display='none';
			_('web-m-body').style.display='block';
		}
		
		

		opn_qa=false;
		opn_news=false;
		opn_shop=false;
		opn_notification=false;
		opn_home=true;
		opn=false;
		_('qa').classList.remove('qa_active');
		_('qa').classList.add('qa');
		_('news').classList.remove('news_active');
		_('news').classList.add('news');
		_('shop').classList.remove('shop_active');
		_('shop').classList.add('shop');
		_('notification').classList.remove('notification_active');
		_('notification').classList.add('notification');

		_('m-m-menu').classList.add('m-m-menu');
		_('m-m-menu').classList.remove('m-m-menu-close');

	}
}

var opn_qa=false;
function qa(){
	if (!opn_qa) {
		_('qa').classList.add('qa_active');

		_('home').classList.remove('home_active');
		_('home').classList.add('home');
		_('news').classList.remove('news_active');
		_('news').classList.add('news');
		_('shop').classList.remove('shop_active');
		_('shop').classList.add('shop');
		_('notification').classList.remove('notification_active');
		_('notification').classList.add('notification');

		_('m-m-menu').classList.add('m-m-menu');
		_('m-m-menu').classList.remove('m-m-menu-close');

		opn_qa=true;
		opn_news=false;
		opn_shop=false;
		opn_notification=false;
		opn_home=false;
		opn=false;

		var form=new FormData();
		form.append("qa","1");

		var ajax=new XMLHttpRequest();
		ajax.open('POST','/Medicare/',true);
		_('posts_show_field').innerHTML="<center><h3 class='pg_loading'>Loading...</h3></center>";
		ajax.send(form);
		ajax.onreadystatechange=function(){
				if(ajax.readyState==4 && ajax.status == 200){
					var origin_T = document.createElement("html");
					origin_T.innerHTML=ajax.responseText;
					console.log(origin_T.lastElementChild);
					document.body.innerHTML=origin_T.lastElementChild.innerHTML;
					Dark();

				}
			}

	}
}
var opn_news=false;
function news(){
	if (!opn_news) {
		_('news').classList.add('news_active');

		opn_qa=false;
		opn_news=true;
		opn_shop=false;
		opn_notification=false;
		opn_home=false;
		opn=false;

		_('home').classList.remove('home_active');
		_('home').classList.add('home');
		_('qa').classList.remove('qa_active');
		_('qa').classList.add('qa');
		_('shop').classList.remove('shop_active');
		_('shop').classList.add('shop');
		_('notification').classList.remove('notification_active');
		_('notification').classList.add('notification');

		_('m-m-menu').classList.add('m-m-menu');
		_('m-m-menu').classList.remove('m-m-menu-close');

		var form=new FormData();
		form.append("news","1");

		_('posts_show_field').innerHTML="<center><h3 class='pg_loading'>Loading...</h3></center>";
		var ajax=new XMLHttpRequest();
		ajax.open('POST','/Medicare/',true);
		ajax.send(form);
		ajax.onreadystatechange=function(){
				if(ajax.readyState==4 && ajax.status == 200){
					var origin_T = document.createElement("html");
					origin_T.innerHTML=ajax.responseText;
					console.log(origin_T.lastElementChild);
					document.body.innerHTML=origin_T.lastElementChild.innerHTML;
					Dark();

				}
			}
	}
}

var opn_shop=false;
function shop(){
	if (!opn_shop) {
		_('shop').classList.add('shop_active');

		opn_qa=false;
		opn_news=false;
		opn_shop=true;
		opn_notification=false;
		opn_home=false;
		opn=false;


		_('posts_show_field').innerHTML="<center><h3 class='pg_loading'>Loading...</h3></center>";
		_('home').classList.remove('home_active');
		_('home').classList.add('home');
		_('news').classList.remove('news_active');
		_('news').classList.add('news');
		_('qa').classList.remove('qa_active');
		_('qa').classList.add('qa');
		_('notification').classList.remove('notification_active');
		_('notification').classList.add('notification');

		_('m-m-menu').classList.add('m-m-menu');
		_('m-m-menu').classList.remove('m-m-menu-close');
		var form=new FormData();
		form.append("shop","1");
		_('posts_show_field').innerHTML="<center><h3 class='pg_loading'>Loading...</h3></center>";
		var ajax=new XMLHttpRequest();
		ajax.open('POST','/Medicare/',true);
		ajax.send(form);
		ajax.onreadystatechange=function(){
				if(ajax.readyState==4 && ajax.status == 200){
					var origin_T = document.createElement("html");
					origin_T.innerHTML=ajax.responseText;
					console.log(origin_T.lastElementChild);
					document.body.innerHTML=origin_T.lastElementChild.innerHTML;
					Dark();

				}
			}
	}
}

var opn_notification=false;
function notification(){
	if (!opn_notification) {
		_('notification').classList.add('notification_active');

		opn_qa=false;
		opn_news=false;
		opn_shop=false;
		opn_notification=true;
		opn_home=false;
		opn=false;

		_('posts_show_field').innerHTML="<center><h3 class='pg_loading'>Loading...</h3></center>";
		_('home').classList.remove('home_active');
		_('home').classList.add('home');
		_('news').classList.remove('news_active');
		_('news').classList.add('news');
		_('shop').classList.remove('shop_active');
		_('shop').classList.add('shop');
		_('qa').classList.remove('qa_active');
		_('qa').classList.add('qa');

		_('m-m-menu').classList.add('m-m-menu');
		_('m-m-menu').classList.remove('m-m-menu-close');

	}
}
function showAllMenu(){

if(!opn){
	_('m-m-menu').classList.remove('m-m-menu');
	_('m-m-menu').classList.add('m-m-menu-close');
	__('.lf-prof').style.display='block';
	_('web-m-body').style.display='none';
	opn_qa=false;
	opn_news=false;
	opn_shop=false;
	opn_notification=false;
	opn_home=false;
	opn=true;

	_('home').classList.remove('home_active');
		_('home').classList.add('home');
		_('news').classList.remove('news_active');
		_('news').classList.add('news');
		_('shop').classList.remove('shop_active');
		_('shop').classList.add('shop');
		_('notification').classList.remove('notification_active');
		_('notification').classList.add('notification');
		_('qa').classList.remove('qa_active');
		_('qa').classList.add('qa');

		 

	}else{
		_('menu-for-s-d').style.display='none';
	_('m-m-menu').classList.add('m-m-menu');
	_('m-m-menu').classList.remove('m-m-menu-close');
	__('.lf-prof').style.display='none';
	_('web-m-body').style.display='block';
	opn_qa=false;
	opn_news=false;
	opn_shop=false;
	opn_notification=false;
	opn_home=true;
	opn=false;
			_('home').classList.add('home_active');

	}

}

function close_menu_fs(){
	_('menu-for-s-d').style.display='none';
	_('m-m-menu').classList.add('m-m-menu');
	_('m-m-menu').classList.remove('m-m-menu-close');
	__('.lf-prof').style.display='none';

}

function close_noti(){
	_('noti-box-in-body').innerHTML='';
	_('noti-box-in-body').style.display='none';
	_('noti-in-body').style.display='none';
}


function comment(post_id,poster_name,poster_profile,post_date){

	_('noti-in-body').style.display='block';
	_('noti-box-in-body').style.display='block';


	var ajax;
	if(window.XMLHttpRequest){
		ajax=new XMLHttpRequest();
	}else{
		ajax=new ActiveObject("Microsolf.XMLHTTP");
	}
	ajax.open("POST","xml/comment.php?post_id="+post_id+"&poster_name="+poster_name+"&poster_profile="+poster_profile+"&post_date="+post_date,true);
	ajax.onreadystatechange=function(){
		if(ajax.readyState==4 && ajax.status == 200){
			var status=ajax.responseText;
			_('noti-box-in-body').innerHTML=status;
		}
	}
	ajax.send(null);
}
function submitComment(post_id){
			var username=_('username').value;
			var poster_name=_('poster_name').value;
			var comment=_('comment').value;
			var origin_c=0;
			var get_c=_('cmc_'+post_id).value ? _('cmc_'+post_id).value : 0;
			origin_c=parseInt(get_c);
			_('comment').value='';
			_('status').style.display='block';

			comment=comment.replace(/  /g," [sp]");
			comment=comment.replace(/\n/g," [nl]");

			var ajax=new XMLHttpRequest();

			ajax.open("POST","xml/post_c.php?poster_name="+poster_name+"&comment="+encodeURIComponent(comment)+"&post_id="+post_id);
			ajax.onreadystatechange=function(){
				if(ajax.readyState==4 && ajax.status == 200){
						_('status').style.display='none';
						__('.comment-body').innerHTML=ajax.responseText;
						_('comment_'+post_id).innerHTML=origin_c+1+'';
					}
				}
			ajax.send(null);
}




function addLike(post_id,log){
		if (log>0) {

		_(post_id).classList.add('like_added');
		_(post_id).classList.remove('donate');
		_(post_id).removeAttribute('onclick');
		_(post_id).setAttribute('onclick','unLike('+post_id+',1)');
		_(post_id).innerHTML="<img src='css/Img/loading_icon.gif' class='pre_load_l'>";

		var ajax;
		if(window.XMLHttpRequest){
			ajax=new XMLHttpRequest();
		}else{
			ajax=new ActiveObject("Microsolf.XMLHTTP");
		}
		ajax.open("POST","xml/addLike.php?post_id="+post_id+"&sts=1",true);
		ajax.onreadystatechange=function(){
			if(ajax.readyState==4 && ajax.status == 200){
				var status=ajax.responseText;
				_(post_id).innerHTML=status;
			}
		}
		ajax.send(null);

	}else{
		_('noti-in-body').style.display='block';
		_('noti-in-body').innerHTML="<a class='u-header-link' href='Login.php' class='sign-up-btn' style='float:left;top:50%;left:50%;transform:translate(-50%,-50%);position:absolute;'>Plaese Login first</a>";

	}
	
}
function unLike(post_id){
	_(post_id).classList.remove('like_added');
	_(post_id).classList.add('donate');
	_(post_id).removeAttribute('onclick');
	_(post_id).setAttribute('onclick','addLike('+post_id+',1)');
		_(post_id).innerHTML="<img src='css/Img/loading_icon.gif' class='pre_load_l'>";

	var ajax;
		if(window.XMLHttpRequest){
			ajax=new XMLHttpRequest();
		}else{
			ajax=new ActiveObject("Microsolf.XMLHTTP");
		}
		ajax.open("POST","xml/addLike.php?post_id="+post_id+"&unsts=1",true);
		ajax.onreadystatechange=function(){
			if(ajax.readyState==4 && ajax.status == 200){
				var status=ajax.responseText;
				_(post_id).innerHTML=status;
			}
		}
		ajax.send(null);
	
}

function pre_search(pre_id){
	_('submit_search').removeAttribute('onclick');
	_('submit_search').setAttribute('onclick','search('+pre_id+')');
}

function search(s_id){

	if (s_id=='0') {
		var search=__('.search_inp').value;
	 	var form=new FormData();
		form.append("all_search","1");
		form.append("search",search);
		_('posts_show_field').innerHTML="<center><h3 class='pg_loading'>Searching...</h3></center>";
		var ajax=new XMLHttpRequest();
		ajax.open('POST','/Medicare/',true);
		ajax.send(form);
		ajax.onreadystatechange=function(){
				if(ajax.readyState==4 && ajax.status == 200){
					var origin_T = document.createElement("html");
					origin_T.innerHTML=ajax.responseText;
					console.log(origin_T.lastElementChild);
					document.body.innerHTML=origin_T.lastElementChild.innerHTML;
					Dark();

				}
			}
	}
	 if (s_id=='1') {
		var search=__('.search_inp').value;
	 	var form=new FormData();
		form.append("qa","1");
		form.append("qa_search","1");
		form.append("search",search);
		_('posts_show_field').innerHTML="<center><h3 class='pg_loading'>Searching...</h3></center>";
		var ajax=new XMLHttpRequest();
		ajax.open('POST','/Medicare/',true);
		ajax.send(form);
		ajax.onreadystatechange=function(){
				if(ajax.readyState==4 && ajax.status == 200){
					var origin_T = document.createElement("html");
					origin_T.innerHTML=ajax.responseText;
					console.log(origin_T.lastElementChild);
					document.body.innerHTML=origin_T.lastElementChild.innerHTML;
					Dark();

				}
			}
	 }
	  if (s_id=='2') {
		var search=__('.search_inp').value;
	 	var form=new FormData();
		form.append("shop","1");
		form.append("shop_search","1");
		form.append("search",search);
		_('posts_show_field').innerHTML="<center><h3 class='pg_loading'>Searching...</h3></center>";
		var ajax=new XMLHttpRequest();
		ajax.open('POST','/Medicare/',true);
		ajax.send(form);
		ajax.onreadystatechange=function(){
				if(ajax.readyState==4 && ajax.status == 200){
					var origin_T = document.createElement("html");
					origin_T.innerHTML=ajax.responseText;
					console.log(origin_T.lastElementChild);
					document.body.innerHTML=origin_T.lastElementChild.innerHTML;
					Dark();

				}
			}
	 }
	  if (s_id=='3') {
		var search=__('.search_inp').value;
	 	var form=new FormData();
		form.append("news","1");
		form.append("news_search","1");
		form.append("search",search);
		_('posts_show_field').innerHTML="<center><h3 class='pg_loading'>Searching...</h3></center>";
		var ajax=new XMLHttpRequest();
		ajax.open('POST','/Medicare/',true);
		ajax.send(form);
		ajax.onreadystatechange=function(){
				if(ajax.readyState==4 && ajax.status == 200){
					var origin_T = document.createElement("html");
					origin_T.innerHTML=ajax.responseText;
					console.log(origin_T.lastElementChild);
					document.body.innerHTML=origin_T.lastElementChild.innerHTML;
					Dark();

				}
			}
	 }
}

function save(post_id,status) {
	var ajax=new XMLHttpRequest();
	ajax.open('POST','xml/save.php?id='+post_id+'&typ='+status,true);
	ajax.onreadystatechange=function(){
		if(ajax.readyState==4 && ajax.status == 200){
			__('.save_item').innerHTML="Saved <small style='color: #e91e63;'>(new)</small>";
			_('save_'+post_id).classList.remove('post-save');
			_('save_'+post_id).classList.add('post-saved');
			_('save_'+post_id).removeAttribute('onclick');
		}
	}
	ajax.send(null);
}
function loadupdateS(results) {
	// body...
	_('ser_res').innerHTML=results+"results found [$pre_search] - most relevance";
	console.log(results);
}

//customer support message
var csm_active = false;
function showCSM() {
	// body...
	if (!csm_active) {
		__('.csm-sup').classList.add('csm-active');

		for (var i = 0; i <= 7; i++) {
			var classO = ".c"+i;
			var actc = "c"+i+"-active";
			__(classO).classList.add(actc);
		}
		__('.chat-small-field').style.display='block';
		csm_active=true;
	}else{
		__('.csm-sup').classList.remove('csm-active');
		for (var i = 0; i <= 7; i++) {
			var classO = ".c"+i;
			var actc = "c"+i+"-active";
			__(classO).classList.remove(actc);
		}
		__('.chat-small-field').style.display='none';
		csm_active=false;
	}
	
}

function doSomethingWithChat() {
	// body...
}