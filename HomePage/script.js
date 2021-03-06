$.toggler = function(val){ 
  // val = val.toLowerCase();
  if (val == 'others')
    $('#tab3').prop('checked', true);
  else if (val == 'technical')
    $('#tab2').prop('checked', true);
  else {
    $('#tab1').prop('checked', true);
    val = 'cultural';
  }
    history.replaceState(undefined, undefined, "#"+val);
}
$.hashChanger = function(){
  var val = window.location.hash.substring(1).toLowerCase();
  var univ_set = ['cultural','technical','others'];
  val = (univ_set.indexOf(val) > -1) ? val : 'cultural';
  $.toggler(val);
}
$.hashChanger();   
/*
if (window.location.hash) {
      // alert(window.location.hash.substring(1));
      $.toggler(window.location.hash.substring(1));
 }
 else{
      $.toggler("cultural");
 }
 */
$('[name=tab]').on('change', function() {
  //alert($('label[for='+$(this).attr('id')+']').html());
  $.toggler($('label[for='+$(this).attr('id')+']').html().toLowerCase());
})
// add 'x' to modal close button
$('.modal__close').html('<svg class="" viewBox="0 0 24 24"><path d="M19 6.41l-1.41-1.41-5.59 5.59-5.59-5.59-1.41 1.41 5.59 5.59-5.59 5.59 1.41 1.41 5.59-5.59 5.59 5.59 1.41-1.41-5.59-5.59z"/><path d="M0 0h24v24h-24z" fill="none"/></svg>');

/***************************** For Modal ****************************/
var Modal = (function() {
  var trigger = $qsa('.modal__trigger'); // what you click to activate the modal
  var modals = $qsa('.modal'); // the entire modal (takes up entire window)
  var modalsbg = $qsa('.modal__bg'); // the entire modal (takes up entire window)
  var content = $qsa('.modal__content'); // the inner content of the modal
  var closers = $qsa('.modal__close'); // an element used to close the modal
  var w = window;
  var isOpen = false;
  var contentDelay = 400; // duration after you click the button and wait for the content to show
  var len = trigger.length;
  // make it easier for yourself by not having to type as much to select an element
  function $qsa(el) {
    return document.querySelectorAll(el);
  }
  var getId = function(event) {
    event.preventDefault();
    var self = this;
    // get the value of the data-modal attribute from the button
    var modalId = self.dataset.modal;
    var len = modalId.length;
    // remove the '#' from the string
    var modalIdTrimmed = modalId.substring(1, len);
    // select the modal we want to activate
    var modal = document.getElementById(modalIdTrimmed);
    // execute function that creates the temporary expanding div
    makeDiv(self, modal);
  };
  var makeDiv = function(self, modal) {
    var fakediv = document.getElementById('modal__temp');
    /**
     * if there isn't a 'fakediv', create one and append it to the button that was
     * clicked. after that execute the function 'moveTrig' which handles the animations.
     */
    if (fakediv === null) {
      var div = document.createElement('div');
      div.id = 'modal__temp';
      self.appendChild(div);
      moveTrig(self, modal, div);
    }
  };
  var moveTrig = function(trig, modal, div) {
    var trigProps = trig.getBoundingClientRect();
    var m = modal;
    var mProps = m.querySelector('.modal__content').getBoundingClientRect();
    var transX, transY, scaleX, scaleY;
    var xc = w.innerWidth / 2;
    var yc = w.innerHeight / 2;
    // this class increases z-index value so the button goes overtop the other buttons
    trig.classList.add('modal__trigger--active');
    // these values are used for scale the temporary div to the same size as the modal
    scaleX = mProps.width / trigProps.width;
    scaleY = mProps.height / trigProps.height;
    scaleX = scaleX.toFixed(3); // round to 3 decimal places
    scaleY = scaleY.toFixed(3);
    // these values are used to move the button to the center of the window
    transX = Math.round(xc - trigProps.left - trigProps.width / 2);
    transY = Math.round(yc - trigProps.top - trigProps.height / 2);
    // if the modal is aligned to the top then move the button to the center-y of the modal instead of the window
    if (m.classList.contains('modal--align-top')) {
      transY = Math.round(mProps.height / 2 + mProps.top - trigProps.top - trigProps.height / 2);
    }
    // translate button to center of screen
    trig.style.transform = 'translate(' + transX + 'px, ' + transY + 'px)';
    trig.style.webkitTransform = 'translate(' + transX + 'px, ' + transY + 'px)';
    // expand temporary div to the same size as the modal
    div.style.transform = 'scale(' + scaleX + ',' + scaleY + ')';
    div.style.webkitTransform = 'scale(' + scaleX + ',' + scaleY + ')';
    window.setTimeout(function() {
      window.requestAnimationFrame(function() {
        open(m, div);
      });
    }, contentDelay);
  };
  var open = function(m, div) {
    if (!isOpen) {
      // select the content inside the modal
      var content = m.querySelector('.modal__content');
      // reveal the modal
      m.classList.add('modal--active');
      // reveal the modal content
      content.classList.add('modal__content--active');
      /**
       * when the modal content is finished transitioning, fadeout the temporary
       * expanding div so when the window resizes it isn't visible ( it doesn't
       * move with the window).
       */
      content.addEventListener('transitionend', hideDiv, false);
      isOpen = true;
    }
    function hideDiv() {
      // fadeout div so that it can't be seen when the window is resized
      div.style.opacity = '0';
      content.removeEventListener('transitionend', hideDiv, false);
    }
  };
  var close = function(event) {
    //event.preventDefault();
    event.stopImmediatePropagation();
    var target = event.target;
    var div = document.getElementById('modal__temp');
    /**
     * make sure the modal__bg or modal__close was clicked, we don't want to be able to click
     * inside the modal and have it close.
     */
    if (isOpen && target.classList.contains('modal__bg') || target.classList.contains('modal__close')) {
      // make the hidden div visible again and remove the transforms so it scales back to its original size
      div.style.opacity = '1';
      div.removeAttribute('style');
      /**
      * iterate through the modals and modal contents and triggers to remove their active classes.
      * remove the inline css from the trigger to move it back into its original position.
      */
      for (var i = 0; i < len; i++) {
        modals[i].classList.remove('modal--active');
        content[i].classList.remove('modal__content--active');
        trigger[i].style.transform = 'none';
        trigger[i].style.webkitTransform = 'none';
        trigger[i].classList.remove('modal__trigger--active');
      }
      // when the temporary div is opacity:1 again, we want to remove it from the dom
      div.addEventListener('transitionend', removeDiv, false);
      isOpen = false;
    }
    function removeDiv() {
      setTimeout(function() {
        window.requestAnimationFrame(function() {
          // remove the temp div from the dom with a slight delay so the animation looks good
          div.remove();
        });
      }, contentDelay - 50);
    }
  };
  var bindActions = function() {
    for (var i = 0; i < len; i++) {
      trigger[i].addEventListener('click', getId, false);
      closers[i].addEventListener('click', close, false);
      modalsbg[i].addEventListener('click', close, false);
    }
  };
  var init = function() {
    bindActions();
  };
  return {
    init: init
  };
}());
Modal.init(); 

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


