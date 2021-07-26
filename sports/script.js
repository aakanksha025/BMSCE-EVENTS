function openNav() {
   if (window.matchMedia("(max-width: 500px)").matches) {
    document.getElementById("mySidenav").style.width = "100%";
    }
  else{
    document.getElementById("mySidenav").style.width = "250px";  
    }
}

function closeNav() {
if (window.matchMedia("(max-width: 500px)").matches) {
    document.getElementById("mySidenav").style.width = "100%";
    }
  else{
    document.getElementById("mySidenav").style.width = "0px";  
    }
}

var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none"; 
  }
  slideIndex++;
  if (slideIndex > slides.length) 
    {slideIndex = 1}    

  slides[slideIndex-1].style.display = "block";  
  slides[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000);
}

window.onload = function () { 
  window.setTimeout( vanishText, 4000 ); 
  setTimeout(func1, 4000);
}
 
function vanishText() { 
  document.getElementById( 'makethisvanish' ).style.visibility = 'hidden'; 
} 

function func1()
{
  document.getElementById("my_div").className="show";
  document.getElementById("my").className="show";
}


