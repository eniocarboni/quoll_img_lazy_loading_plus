jQuery( document ).ready( function( $ ) {
	const lazyoptions={ 
		rootMargin: '20px', 
		threshold: 0 
	};
	var observer_img = new IntersectionObserver(quollLazyImg, lazyoptions);
	var target_imgs=document.querySelectorAll('[data-quoll-src]');
	target_imgs.forEach(target => observer_img.observe(target));
	function quollLazyImg(entries, observer) {
		entries.forEach(entry => {
			var element = $(entry.target);
			var ratio = entry.intersectionRatio;
			if (ratio > 0) {
				observer.unobserve(entry.target);
				var imgSrc=element.data('quollSrc');
				if (imgSrc) {
					element.attr('src',imgSrc);
				}
			}
		});
	}
} );
