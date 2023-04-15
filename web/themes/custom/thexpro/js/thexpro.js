/* Load jQuery.
--------------------------*/
jQuery(document).ready(function ($) {
  // Mobile menu.
  $('.mobile-menu').click(function () {
    $(this).next('.primary-menu-wrapper').toggleClass('active-menu');
  });
  $('.close-mobile-menu').click(function () {
    $(this).closest('.primary-menu-wrapper').toggleClass('active-menu');
  });
  // Header search form
  $('.search-icon').on('click', function() {
    $('.search-box').toggleClass('open');
    $('.search-box-content .form-search').focus();
    return false;
  });
  $('.search-box-content input[type="search"]').attr("placeholder", "Type your search");

  $('.header-search-close').on('click', function() {
    $('.search-box').removeClass('open');
    return false;
  });
  $('.search-box').on( 'keydown', function(e) {
    if ( e.keyCode === 27 ) {
      $('.search-box.open').removeClass('open');
    }
  });
  $(document).on('click', function(event) {
    if(!$(event.target).closest(".search-box-content").length) {
      $('.search-box').removeClass('open');
    }
  })
  // Scroll To Top.
  $(window).scroll(function () {
    if ($(this).scrollTop() > 80) {
      $('.scrolltop').css('display', 'flex');
    } else {
      $('.scrolltop').fadeOut('slow');
    }
  });
  $('.scrolltop').click(function () {
    $('html, body').animate( { scrollTop: 0 }, 'slow');
  });

  // Sliding sidebar.
  $('.sliding-sidebar-icon').click(function () {
    $('.sliding-sidebar').toggleClass('animated-panel-is-visible');
  });
  $('.close-sliding-sidebar').click(function () {
    $('.sliding-sidebar').removeClass('animated-panel-is-visible');
  });

  // Elements -> Popup.
  $(".model button, .model .model-button").on("click", function() {
    $('.model-content').removeClass("model-active");
    $(this).closest('.model').find('.model-content').addClass("model-active");
  });

  $(".model-close").on("click", function(){
    $(this).parent('.model-content').removeClass("model-active");
  });
  // Elements -> Accordion
  $('.accordion-content').hide();
  $('.active-accordion').next('.accordion-content').show();
  $('.accordion-title').click(function(){
    $(this).siblings('.accordion-title').removeClass('active-accordion');
    $(this).addClass('active-accordion');
    $(this).siblings('.accordion-content').slideUp();
    $(this).next('.accordion-content').slideDown();
  });
  // Elements -> Toggle
  $('.toggle-content').hide();
  $('.active-toggle').next('.toggle-content').show();
  $('.toggle-title').click(function(){
    $(this).toggleClass('active-toggle');
    $(this).next('.toggle-content').slideToggle();
  });
  // Elements -> tab
  $(".tab-nav li:first-child").addClass('active-tab');
  $(".tabs .tab-content:nth-child(1)").addClass('active-tab-content');
  $(".v-tabs .tab-content:nth-child(1)").addClass('active-tab-content');
  $(".tab-nav li a").click(function() {
    $(this).parent('li').siblings().removeClass('active-tab');
    $(this).parent('li').addClass('active-tab');
    var t = $(this).attr('href');
    $(this).parents('.tab-nav').siblings('.tabs-content').children('.tab-content').hide();
    $(t).fadeIn('slow');
    return false;
  });
  // Elements -> Title Slider
  var $active_title = $('.sliding-titles li:first-child').addClass('active-title'), $next_title = $active_title.next();
  setInterval(function () {
    $active_title.removeClass('active-title');
    $active_title = $next_title.addClass('active-title');
    $next_title = $active_title.next();
    if (!$next_title.length) {
      $next_title = $('.sliding-titles li:first-child');
    }
  }, 3000);
/* End document
--------------------------*/
});
