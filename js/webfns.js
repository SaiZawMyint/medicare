

//top main menu
var menuopen=false;
function showmenu(){
  if (!menuopen) {
    document.querySelector('nav').style.display='block';
    document.getElementById('menu').classList.remove('menu');
    document.getElementById('menu').classList.add('menu_open');
    menuopen=true;
  }else{
    document.querySelector('nav').style.display='none';
     document.getElementById('menu').classList.add('menu');
    document.getElementById('menu').classList.remove('menu_open');
    menuopen=false;
  }

}
window.addEventListener('scroll',()=>{
  if(menuopen){
    document.querySelector('nav').style.display='none';
     document.getElementById('menu').classList.add('menu');
    document.getElementById('menu').classList.remove('menu_open');
    menuopen=false;
  }

});

function JC(){
	window.open('/Medicare/');
}

function EP(){
  window.open('/Medicare/Medicare-Plan/');
}


function moreInfo(){
  var scroll=document.querySelector('#medicare');
  scroll.scrollIntoView({behavior: 'smooth',block: 'end'});
}
function community(){
 var scroll=document.querySelector('#community');
  scroll.scrollIntoView({behavior: 'smooth',block: 'end'});
}
function personal_care(){
 var scroll=document.querySelector('#personal_care');
  scroll.scrollIntoView({behavior: 'smooth',block: 'end'});
}
function medicare_plan(){
 var scroll=document.querySelector('#medicare_plan');
  scroll.scrollIntoView({behavior: 'smooth',block: 'end'});
}
function sexual_care(){
 var scroll=document.querySelector('#sexual_care');
  scroll.scrollIntoView({behavior: 'smooth',block: 'end'});
}
