let header=document.querySelector('.header');
let lastScroll=0;

window.addEventListener('scroll',()=>{
    if(window.scrollY > lastScroll){
      header.classList.add('hide');
    }else{
      header.classList.remove('hide');
    }

    lastScroll=window.scrollY;
});

function JoinCom(){
	var formData=document.getElementById('Join_Com');
	formData.addEventListener('submit',e=>{
		e.preventDefault();

		const jd="communication.blade.php";
		fetch(jd,{
			method: "post",
			body: formData
		}).catch(console.error);

	})
}
