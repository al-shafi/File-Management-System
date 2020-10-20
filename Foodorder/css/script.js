
var username = document.getElementById("vname");
var email = document.getElementById("vemail");
var password = document.getElementById("vpassword");
var cpassword = document.getElementById("vcpassword");
var phone = document.getElementById("vphone");
var address = document.getElementById("vaddress");


var name_error = document.getElementById("name_error");
var email_error = document.getElementById("email_error");
var password_error = document.getElementById("password_error");
var cpassword_error = document.getElementById("cpassword_error");
var phone_error = document.getElementById("phone_error");
var address_error = document.getElementById("address_error");


username.addEventListener("blur", nameVerify);
email.addEventListener("blur", emailVerify);
password.addEventListener("blur", passwordVerify);
cpassword.addEventListener("blur", passwordVerify);
phone.addEventListener("blur", phoneVerify);
address.addEventListener("blur", addressVerify);

function Validate(){

	if(username.value == ""){
		username.style.border = "2px solid red";
		name_error.textContent = "Username is required";
		username.focus();
		return false;
	}

	if(email.value == ""){
		email.style.border = "2px solid red";
		email_error.textContent = "Email is required";
		email.focus();
		return false;
	}

	if(password.value.length < 3){
		password.style.border = "2px solid red";
		password_error.textContent = "Password can't be less than 3";
		password.focus();
		return false;
	}

	if(password.value != cpassword.value){
		cpassword.style.border = "2px solid red";
		cpassword_error.textContent = "Password does not match";
		password.focus();
		return false;
	}

	if(phone.value.length < 11){
		phone.style.border = "2px solid red";
		phone_error.textContent = "Phone can't be less than 11 digit";
		phone.focus();
		return false;
	}
	if(address.value == ""){
		address.style.border = "2px solid red";
		address_error.textContent = "Address is required";
		address.focus();
		return false;
	}
}

function nameVerify(){
	if(username.value != ""){
		username.style.border = "1px solid black";
		name_error.innerHTML = "";
		return true;
	}
}

function emailVerify(){
	if(email.value != ""){
		email.style.border = "1px solid black";
		email_error.innerHTML = "";
		return true;
	}
}

function passwordVerify(){
	if(password.value != ""){
		password.style.border = "1px solid black";
		password_error.innerHTML = "";
		return true;
	}
}

function passwordVerify(){
	if(password.value == cpassword.value){
		cpassword.style.border = "1px solid black";
		cpassword_error.innerHTML = "";
		return true;
	}
}


function phoneVerify(){
	if(phone.value != ""){
		phone.style.border = "1px solid black";
		phone_error.innerHTML = "";
		return true;
	}
}

function addressVerify(){
	if(address.value != ""){
		address.style.border = "1px solid black";
		address_error.innerHTML = "";
		return true;
	}
}


$(document).ready(function(){
	$('#vbtn').click(function(){
		$.ajax({
			url: "signup.php",
			method: "POST",
			data: {username:username, email:email, password:password, cpassword:cpassword, phone:phone, address:address},
			success: function(data){
				$("vform").trigger("reset");
				$('#succmsg').fadeIn().html(data);
				setTimeOut(function(){
					$('#succmsg').fadeOut("Slow");
				}, 2000);
			} 
		});
	});
});