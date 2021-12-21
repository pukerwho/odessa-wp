$('.hamburger-toggle').on('click', function(){
  $(this).toggleClass('open');
  $('.mobile-menu').toggleClass('hidden').toggleClass('z-2');
  $('body').toggleClass('overflow-hidden');
});