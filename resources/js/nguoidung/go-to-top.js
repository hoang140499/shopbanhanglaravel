	$(document).ready(function () {
		$(window).scroll(function () {
			var top =  $(".goto-top");
			if ( $('body').height() <= (    $(window).height() + $(window).scrollTop() + 200 )) {
				top.animate({"margin-left": "0px"},0);
			} else {
				top.animate({"margin-left": "-100%"},0);
			}
		});

		$(".goto-top").on('click', function () {
			$("html, body").animate({scrollTop: 0}, 0);
		});
	});

// vanilla JS
	var toTop = document.getElementById("goto-topJS");

	toTop.addEventListener("click", function(){
		scrollToTop(1000);
	});
	function scrollToTop(scrollDuration) {
		var scrollStep = -window.scrollY / (scrollDuration / 15),
		scrollInterval = setInterval(function(){
			if ( window.scrollY != 0 ) {
				window.scrollBy( 0, scrollStep );
			}
			else clearInterval(scrollInterval); 
		},15);
}
// var offset = 200;
//     var duration = 500;
//     $(window).scroll(function () {
//         if ($(this).scrollTop() > 500) {
//             $('.top').fadeIn(400);
//         } else {
//             $('.top').fadeOut(400);
//         }
//     });
//     $('.top').click(function (event) {
//         event.preventDefault();
//         $('body').animate({
//             scrollTop: 0
//         }, duration);
//         return false;
//     });