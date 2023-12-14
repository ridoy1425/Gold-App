(function ($) {
    'use strict';

    jQuery(document).ready(function () {
      

        
        $(window).on('scroll', function () {
          var menu_area = $('.navbar-sticky');
          if ($(window).scrollTop() > 200) {
              menu_area.addClass('sticky-menu');
          } else {
              menu_area.removeClass('sticky-menu');
          }
        });


        $("#search-toggle").click(function(e){
          e.preventDefault();
          $(".search-form").toggleClass('show');
        });


        $('.menu-item-has-children').append('<i class="fa fa-caret-down" aria-hidden="true"></i>');


       $('#mobile-menu-active').meanmenu({});

        // addclass & removeclass
        $(".menu-toggle").on("click", function() {
            $(".mobile-menu, .overlay-inn").addClass("active");
        });

        $(".overlay-inn").on("click", function() {
            $(".mobile-menu, .overlay-inn").removeClass("active");
        });

        // Show mobile sub menu when click arrow
        $('.mobile-menu ul.m-sub-menu').slideUp();
        $('.mobile-menu i.fa-caret-down').on('click', function(){
            $(this).toggleClass('fa-caret-up');
            $(this).prev('ul.m-sub-menu').toggleClass('show');
            $(this).prev('ul.m-sub-menu').slideToggle('slow');
        });


    });

})(jQuery);