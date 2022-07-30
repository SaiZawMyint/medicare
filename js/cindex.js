let header=document.querySelector('#hi-he');
let lastScroll=0;

window.addEventListener('scroll',()=>{
    if(window.scrollY > lastScroll){
      header.classList.add('hide');
    }else{
      header.classList.remove('hide');
    }

    lastScroll=window.scrollY;
});



function _(eid){
	return document.getElementById(eid);
}
function __(qsl){
	return document.querySelector(qsl);
}

var search_inp=_('search_input');
search_inp.addEventListener('keyup',(e)=>{
	if(e.keyCode===13){
		var search_id=_('search_id').value;
		search(search_id);
	}
});

