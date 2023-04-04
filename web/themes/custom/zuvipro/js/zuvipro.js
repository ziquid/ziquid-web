/* Custom Cursor
--------------------------*/

/* Prepage loader
--------------------------*/
jQuery(window).on('load', function() {
  jQuery(".loader").delay(1000).fadeOut( 'slow' );
});
/* Load jQuery.
--------------------------*/
jQuery(document).ready(function ($) {
  // Mobile menu.
  $('.mobile-menu').click(function () {
    $(this).next('.primary-menu-wrapper').toggleClass('active-menu');
  });
  $('.close-mobile-menu').click(function () {
    $(this).closest('.primary-menu-wrapper').removeClass('active-menu');
  });
  // Full page search.
  $('.search-icon').on('click', function() {
    $('.search-box').addClass('open');
    return false;
  });

  $('.search-box-close').on('click', function() {
    $('.search-box').removeClass('open');
    return false;
  });

  // Sliding sidebar.
  $('.sliding-panel-icon').click(function () {
    $('.sliding-sidebar').toggleClass('animated-panel-is-visible');
  });
  $('.close-animated-sidebar').click(function () {
    $('.sliding-sidebar').removeClass('animated-panel-is-visible');
  });

  // Slider and carousel
  // Elements -> Clients.
  $('.clients').owlCarousel({
    loop:true,
    center: true,
    margin:30,
    nav:true,
    dots: false,
    responsive:{
      0:{
        items:1
      },
      576:{
        items:3
      },
      768:{
        items:4
      },
      992:{
        items:5
      }
    }
  });
  // Elements -> Toggle.
  $(".toggle-content").hide();
	$(".toggle-title").click(function() {
		$(this).next('.toggle-content').slideToggle(300);
		$(this).toggleClass('active-toggle');
		return false;
  });

  // Elements -> Accordion.
  var accordion_head = $(".accordion-title"), accordion_para = $(".accordion-content"); // select heading and para and save as variable
	accordion_para.hide(); // hide all para
	accordion_head.click(function() {
		var current = $(this); // save the heading for easy referral
		if ( current.next(".accordion-content").is(":hidden") ) {
			current.siblings(".accordion-content").slideUp();
			current.next(".accordion-content").slideDown();
			current.siblings(".accordion-title").removeClass('active-accordion'); // remove active-accordion class from all siblings titles
			current.addClass("active-accordion"); // add class active-accordion to clicked title
		} else {
			current.next(".accordion-content").slideUp();
			current.removeClass("active-accordion"); // add class active-accordion to clicked title
		}
  });
  
  // Elements -> Tab.
  $(".tabs li:first-child").addClass('active-tab');
  $(".tab-content:first").addClass('active-tab-content');
  $(".tabs li a").click(function() {
  $(".tabs li").removeClass('active-tab');
  $(this).parent('li').addClass('active-tab');
});
  $(".tabs li a").click(function() {
    var t = $(this).attr('href');
    $('.tabs li a').addClass('inactive-tab');
    $(this).removeClass('inactive-tab');
    $('.tab-content').hide();
    $(t).fadeIn('slow');
    return false;
  });
  if($(this).hasClass('inactive-tab')) {
    $('.tabs li a').addClass('inactive-tab');
    $(this).removeClass('inactive-tab');
    $('.tab-content').hide();
    $(t).fadeIn('slow');
  }

  // Elements -> Popup.
  $(".popup-open").on("click", function() {
    $('.popup-content').removeClass("active");
    $(this).closest('.popup').find('.popup-content').addClass("active");
  });

  $(".popup-close").on("click", function(){
    $(this).parent('.popup-content').removeClass("active");
  });

  // Scroll To Top.
  $(window).scroll(function () {
    if ($(this).scrollTop() > 80) {
      $('.scrolltop').fadeIn('slow');
    } else {
      $('.scrolltop').fadeOut('slow');
    }
  });
  $('.scrolltop').click(function () {
    $('html, body').animate( { scrollTop: 0 }, 'slow');
  });
/* End document
--------------------------*/
});