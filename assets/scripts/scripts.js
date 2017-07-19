(function($){
	$(function(){



$('body').on('click',".region h2", function(){
  $(this).next('ul').slideToggle();
  $(this).parent().toggleClass('regionhighlight');
  $(this).children('img').toggleClass('rotate2');
});




$(".owl-carousel").owlCarousel({
  loop:true,
  margin:10,
  nav:true,
  responsive:{
    0:{
      items:1
    },
    600:{
      itmes:3
    },
    1000:{
      items:4
    }
  }
});




});
})(jQuery);
