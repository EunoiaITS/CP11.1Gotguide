


(function($) {
  
  "use strict";
  
  	/*--======
  	//bootstrap selectpicker for got search
  	=========================--*/
	$('.selectpicker').selectpicker();

	/*--======
  	//sticky menu for home and home-1
  	=========================--*/

	 $(window).on('scroll', function () {
            if ($(window).scrollTop() > 80) {
                $(".navbar-home").css({
                    'background-image': '-webkit-linear-gradient(left top, rgba(236, 91, 65, 0.8) , rgba(236, 91, 65, 0.8))',
                    transition: 'all 1s linear 0s'
                });
                $(".navbar-nav li a").css({
                    'padding-top': '15px',
                    transition: 'all .2s linear 0s'
                });
                $(".header-top").css({
                    'display': 'none',
                    transition: 'all .2s linear 0s'
                });
                $(".logo").css({
                    'display': 'none',
                    transition: 'all .2s linear 0s'
                });
                 $(".stick-logo,.social-media-sm").css({
                    'display': 'block',
                    'height':'30px',
                    transition: 'all .2s linear 0s'
                });
                $(".social-media-sm").css({
                  'display': 'table',
                    'height':'30px',
                    transition: 'all .2s linear 0s'
                });

            } else {
                $(".navbar-home").css({
                   'background-image': '-webkit-linear-gradient(left top, rgba(236, 91, 65, 0) , rgba(236, 91, 65, 0))',
                    border: '0px solid #ddd',
                    transition: 'all .2s linear 0s'
                });
                $(".navbar-nav li a").css({
                    'padding-top': '20px',
                    transition: 'all .2s linear 0s'
                });
                $(".header-top").css({
                    'display': 'block',
                    transition: 'all .2s linear 0s'
                });
                $(".logo").css({
                    'display': 'block',
                    transition: 'all .2s linear 0s'
                });
                 $(".stick-logo,.social-media-sm").css({
                    'display': 'none',
                    'height':'30px',
                    transition: 'all .2s linear 0s'
                });
                
            }
        });

	/*--==
   page scroll
   ========================--*/

   /* Page Scroll to id fn call */
       $(" #navigation-menu a,#slide-scroll").mPageScroll2id({
           highlightClass: "active-home",
       });
	/*==============================
    // Vertical Center Welcome
    ==================================*/
    setInterval(function () {
        var widnowHeight = $(window).height();
        var introHeight = $(".header-landing-text, .reset-email-new").height();
        var paddingTop = widnowHeight - introHeight;
        $(".header-landing-text, .reset-email-new").css({
            'padding-top': Math.round(paddingTop / 2) + 'px',
            'padding-bottom': Math.round(paddingTop / 2) + 'px'
        });
    }, 10);

     /*===================
      Search Popup and Page Functions 
      ===================*/

      $(".open-popup").on("click",function(){
          $(".popup-wrapper").fadeIn();
          return false;
      });
      $(".close").on("click",function(){
          $(".popup-wrapper").fadeOut();
      });
      
       /*===================
      available-popup
      ===================*/

      $(".available-popup").on("click",function(){
          $(".popup-available").fadeIn();
          return false;
      });
      $(".close").on("click",function(){
          $(".popup-available").fadeOut();
      });


      /*===================
      Rate-me popup function
      ===================*/

      $(".open-popup-rateme").on("click",function(){
          $(".popup-rateme").fadeIn();
          return false;
      });
      $(".close").on("click",function(){
          $(".popup-rateme").fadeOut();
      });

      /*===================
      about us popup function
      ===================*/

      $(".open-popup-about").on("click",function(){
          $(".popup-about").fadeIn();
          return false;
      });
      $(".close").on("click",function(){
          $(".popup-about").fadeOut();
      });


      /*===================
      image upload popup
      ===================*/
      $(".open-popup-image").on("click",function(){
          $(".popup-image-wrapper").fadeIn();
          return false;
      });
      $(".close").on("click",function(){
          $(".popup-image-wrapper").fadeOut();
      });
      /*===================
      image add class
      ===================*/
      $(".image-hover").click(function(){
          $(".image-upload-hide").addClass("hide-image");
      });


     /*===================
      edit available popup
      ===================*/

      $(".edit-popup-option-available").on("click",function(){
          $(".edit-popup-available").fadeIn();
          return false;
      });
      $(".close").on("click",function(){
          $(".edit-popup-available").fadeOut();
      });

      /*===================
      delete available popup
      ===================*/

      $(".delete-popup-option").on("click",function(){
          $(".delete-popup-available").fadeIn();
          return false;
      });
      $(".close").on("click",function(){
          $(".delete-popup-available").fadeOut();
      });


      /*===================
      package-popup
      ===================*/

      $(".package-popup-ip").on("click",function(){
          $(".popup-package").fadeIn();
          return false;
      });
      $(".close").on("click",function(){
          $(".popup-package").fadeOut();
      });

       /*===================
      edit-package-popup
      ===================*/

      $(".edit-popup-option").on("click",function(){
          $(".edit-popup-package").fadeIn();
          return false;
      });
      $(".close").on("click",function(){
          $(".edit-popup-package").fadeOut();
      });

      /*--===========
      Delete popup package
      =====================--*/
       $(".delete-package").on("click",function(){
          $(".delete-popup-package").fadeIn();
          return false;
      });
      $(".close").on("click",function(){
          $(".delete-popup-package").fadeOut();
      });
   
      /*--=============
      shoping cart popup
      ===================--*/
      $(".shopping-cart-popup").on("click",function(){
          $(".popup-shopping-card").fadeIn();
          return false;
      });
      $(".close").on("click",function(){
          $(".popup-shopping-card").fadeOut();
      });
      /*--=============
      log-out-confermation
      ===================--*/
      $(".log-out-confermation").on("click",function(){
          $(".log-out-confermation-popup").fadeIn();
          return false;
      });
      $(".close").on("click",function(){
          $(".log-out-confermation-popup").fadeOut();
      });



})(window.jQuery);

/*--=============
image upload js call
======================--*/
// vars
var result = document.querySelector('.result'),
    img_result = document.querySelector('.img-result'),
    img_w = document.querySelector('.img-w'),
    img_h = document.querySelector('.img-h'),
    options = document.querySelector('.options'),
    save = document.querySelector('.save'),
    cropped = document.querySelector('.cropped'),
    dwn = document.querySelector('.download'),
    upload = document.querySelector('#file-input'),
    cropper = '';


// on change show image with crop options
upload.addEventListener('change', function (e) {
  aspectRatio: 16 / 9;
  if (e.target.files.length) {
    // start file reader
    var reader = new FileReader();
    reader.onload = function (e) {
      if (e.target.result) {
        // create new image
        var img = document.createElement('img');
        img.id = 'image';
        img.src = e.target.result;
        // clean result before
        result.innerHTML = '';
        // append new image
        result.appendChild(img);
        // show save btn and options
        save.classList.remove('hide');
        options.classList.remove('hide');
        // init cropper
        cropper = new Cropper(img);

      }
    };
    reader.readAsDataURL(e.target.files[0]);
  }
});

// save on click
save.addEventListener('click', function (e) {
  e.preventDefault();
  // get result to data uri
  var imgSrc = cropper.getCroppedCanvas({
    width: img_w.value // input value
  }).toDataURL();
  // remove hide class of img
  cropped.classList.remove('hide');
  img_result.classList.remove('hide');
  // show image cropped
  cropped.src = imgSrc;
  dwn.download = 'imagename.png';
  dwn.setAttribute('href', imgSrc);
});


