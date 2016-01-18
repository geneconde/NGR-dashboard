$(document).ready(function() {
	$('.blink').blink({ speed: 500, blinks: 1000 });
	$('.wiggle').wiggle({ speed: 250, wiggles: 1000 });
	$('.wiggle-right').wiggle({ speed: 250, wiggles: 1000, moveto: 'right' });

	/* Next Hover -- if there are hover images */
	/*$('img.next-toggle').hover( function () { 
		this.src = 'images/buttons/next-on2.png';
	}, function () { 
		this.src = 'images/buttons/next.png';
	});*/

	/* Back Hover if there are hover images */
	/*$('img.back-toggle').hover(function () {
		this.src = 'images/buttons/back-on2.png';
	}, function () {
		this.src = 'images/buttons/back.png';
	});*/
	
	/* Back Screen Hover 
	$('img.back-toggle-screen').hover(function () {
		this.src = 'images/buttons/back-on.png';
	}, function () {
		this.src = 'images/buttons/back.png';
	}); */
	
	/* Read More Hover if there are hover images  */
	/*$('img.readmore-toggle').hover( function () {
		this.src = 'images/buttons/readmore-on.png'; 
	}, function () { 
		this.src = 'images/buttons/readmore.png';
	});*/
	
	/* Check Answer Hover */
	/*$('img.check-toggle').hover( function () {
		this.src = 'images/buttons/check-answer-on.png'; 
	}, function () { 
		this.src = 'images/buttons/check-answer.png';
	});*/
	
	/* Back Screen Answer Hover 
	$('img.back-toggle-answer').hover(function () {
		this.src = 'images/buttons/back-hover.png';
	}, function () {
		this.src = 'images/buttons/check-answer-back.png';
	}); */
});