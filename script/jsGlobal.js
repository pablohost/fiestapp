(function($) {
  "use strict"; // Start of use strict

  // Smooth scrolling using jQuery easing
  $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top - 100)
        }, 1000, "easeOutQuad");
        return false;
      }
    }
  });
})(jQuery); // End of use strict

$('.rrss').tooltip({ 
  boundary: 'window'
 });

$('.navbar-nav>li>#cerrarNav').on('click', function(){
    $('.navbar-collapse').collapse('hide');
});
$('.navbar-nav>li>div>a').on('click', function(){
    $('.navbar-collapse').collapse('hide');
});