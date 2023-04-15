/* Prepage loader
--------------------------*/
jQuery(window).on('load', function() {
  jQuery(".loader").delay(1000).fadeOut( 'slow' );
});
/* Load jQuery.
--------------------------*/
jQuery(document).ready(function ($) {
  // Homepage blocks
  $(".region-content-home-top .block, .region-content-home-bottom .block").wrapInner( '<div class="container"></div>' );

  /* Sticky header */
  if ($(window).width() > 767) {
    $(window).scroll(function () {
      var headermainheight = jQuery('.header-main').outerHeight();
      if ($(this).scrollTop() >= headermainheight) {
        $('.header-sticky').addClass('sticky-header animated fadeInDown');
        $('.sticky-header-height').css('padding-top', headermainheight);
      } else {
        $('.header-sticky').removeClass('sticky-header animated fadeInDown');
        $(".sticky-header-height").css('padding-top', '0');
      }
    });
  };
/* End document
--------------------------*/
});