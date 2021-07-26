const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});

function ValidateEmail(inputText , inputtxt)
{
var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@bmsce.ac.in$/;
var passw=  /^[A-Za-z]\w{7,14}$/;
if(inputText.value.match(mailformat))
{
	if(inputtxt.value.match(passw)) 
{ 
return true;
}
else
{ 
alert('Please enter a valid password between 7 to 16 characters which contain only characters, numeric digits, underscore and first character must be a letter');
document.getElementById('PassText').value = '';
return false;
}

	return (true);
}
else
{
	alert("Please enter a valid bmsce Email!");
	document.getElementById('EmailText').value = '';
	return (false);
}
}
