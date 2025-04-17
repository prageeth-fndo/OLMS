
// $(document).on(function(){
//   $('.sidebar-menu .nav-pills li a').click(function(){
//     $('.nav-link').removeClass("active");
//     $(this).addClass("active");
// });
// });

$(window).on('load', function() {

  $('.slide-carousel').owlCarousel({
      loop: true,
      autoplay: true,
      dots: true,
      responsiveClass: true,
      navText: [
          '<i class="fa fa-angle-left"></i>',
          '<i class="fa fa-angle-right"></i>'
      ],
      responsive: {
          0: {
              items: 1,
              nav: false,
              dots: true,
              loop: true
          }
      }
  });

  $('.slide-carousel').on('translate.owl.carousel', function () {
      $('.this-item h2').removeClass('fadeInUp animated').hide();
      $('.this-item h3').removeClass('fadeInUp animated').hide();
      $('.this-item p').removeClass('fadeInUp animated').hide();
  });

  $('.slide-carousel').on('translated.owl.carousel', function () {
      $('.this-item h2').addClass('fadeInUp animated').show();
      $('.this-item h3').addClass('fadeInUp animated').show();
      $('.this-item p').addClass('fadeInUp animated').show();
  });

});	


$( ".dropdown-toggle" ).click(function() {
  $( ".dropdown-menu" ).toggle( "1000", function() {
    // Animation complete.
  });
});
$( ".menu-toggle1" ).click(function() {
  $( ".menus1" ).toggle( "1000", function() {
    // Animation complete.
  });
});
//$(document).ready( function () {
//    $('#example').DataTable();
//} );

$(document).ready(function () {
$('#dtBasicExample').DataTable();
$('.dataTables_length').addClass('bs-select');
});