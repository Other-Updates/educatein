$(document).ready(function(){
    "use strict"

    // Owl-carousel
    $('.owl-carousel').owlCarousel({
        loop:true,
        // center: true,
        margin:10,
        nav:true,
        autoplay:true,
        navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
        responsive:{
            0:{
                items:1
            },
            350:{
                items:2
            },
            575:{
                items:3
            },
            767:{
                items:3
            },
            991:{
                items:3
            },
            1200:{
                items:5
            }
        }
    })

    // Tooltip
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    // Back-to-top
    window.onload=function(){
        var btn = $('#button');

        $(window).scroll(function() {
          if ($(window).scrollTop() > 300) {
            btn.addClass('show');
          } else {
            btn.removeClass('show');
          }
        });

        btn.on('click', function(e) {
          e.preventDefault();
          $('html, body').animate({scrollTop:0}, '300');
        });
    }
    

});