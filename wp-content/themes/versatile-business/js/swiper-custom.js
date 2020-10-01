var swiperHeroSlider = new Swiper ( '#hero-slider', {
	// Optional parameters
	loop: 1,
	effect: 'slide',
	speed: 300,
	// If we need pagination
	pagination: {
		el: '.swiper-pagination',
		type: 'bullets',
		clickable: 'true',
	},

	// Navigation arrows
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
});

var swiperTestimonial = new Swiper( '.testimonial-content-wrapper.swiper-carousel-enabled', {
	slidesPerView: 1,
	loop: 1,
	effect: 'slide',
	speed: 300,
	freeMode: true,
	spaceBetween: 30,
	pagination: {
		el: '.swiper-pagination',
		clickable: true,
	},

	// Navigation arrows
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
	// Breakpoints
	breakpoints: {
		640 : {
			slidesPerView: 2,
			spaceBetween: 30,
		}
	}
});
