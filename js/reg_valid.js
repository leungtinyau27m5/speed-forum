var check1=false;
var check2=false;
var check3=false;
var check4=false;
function validusername(){
	var input=document.getElementById("reg_uname");
	var display=document.getElementById("reg_uname_indi");
	if(input.value.length>5){
		display.innerHTML="&#10003;";
		display.style.color="#66cc66";
		input.setCustomValidity('');
		check1=true;
		//alert(check1);
	}else{
		input.setCustomValidity("please follow the format!!");		
		display.style.color="#ff6666";
		display.innerHTML="&#x2718 should be at least 6 characters"; 
		check1=false;
	}
	validSubmit();
}
function validpassword(){
	var input=document.getElementById("reg_upw");
	var display=document.getElementById("reg_upw_indi");
	var pattern=/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+){8,24}$/;
	if(input.value.match(pattern)){
		display.style.color="#66cc66";
		display.innerHTML="&#10003;";
		check2=true;
		//alert(check2);
	}else if(input.value.length<8 || input.value.length>24){
		display.style.color="#ff6666";
		display.innerHTML="&#x2718; at least 8 characters but not exceed";
		check2=false;
	}else{
		display.style.color="#ff6666";
		display.innerHTML="&#x2718; should contains at least 1 character and 1 number";
		check2=false;
	}
	validSubmit();
}
function validconfirmed(){
	var input=document.getElementById("reg_upwc");
	var inputCheck=document.getElementById("reg_upw").value;
	var display=document.getElementById("reg_upwc_indi");
	if(input.value.match(inputCheck)){
		display.style.color="#66cc66";
		display.innerHTML="&#10003;";
		check3=true;
		//alert(check3);
	}else{
		display.style.color="#ff6666";
		display.innerHTML="&#x2718; Passwords are not match!";
		check3=false;
	}
	validSubmit();
}
function validemail(){
	var input=document.getElementById("reg_email");
	if (input.value.length>5){
		check4=true;
		//alert(check4);
	}else{
		check4=false;
	}
	validSubmit();
}
function validSubmit(){
	if(check1 & check2 & check3 & check4){
		document.getElementById("reg_submit").disabled=false;
	}else{
		document.getElementById("reg_submit").disabled=true;
	}
}

