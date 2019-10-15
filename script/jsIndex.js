$(function(){
        
	//********animacion del header typed.js*********

	var options = {
		strings: ['LAS MEJORES FIESTAS', 'EL MEJOR CARRETE', 'SHOWS DE STAND UP COMEDY', 'FESTIVALES DE MUSICA', 'TU MEJOR PANORAMA'],
		typeSpeed: 100,
		loop: true
	};

	var typed = new Typed('#headCute', options);

	ScrollReveal().reveal('.sr1', {
		reset: true,
		origin: 'bottom',
		distance: '50px'
	});
	ScrollReveal().reveal('.sr2', {
		reset: true,
		origin: 'bottom',
		delay: 300,
		distance: '50px'
	});
	ScrollReveal().reveal('.sr3', {
		reset: true,
		origin: 'bottom',
		delay: 600,
		distance: '50px'
	});
	ScrollReveal().reveal('.sr4', {
		reset: true,
		origin: 'bottom',
		delay: 900,
		distance: '50px'
	});
	ScrollReveal().reveal('.sr5', {
		reset: true,
		origin: 'bottom',
		distance: '50px'
	});
	ScrollReveal().reveal('.sr6', {
		reset: true,
		origin: 'left',
		distance: '50px'
	});
	ScrollReveal().reveal('.sr7', {
		reset: true,
		origin: 'left',
		distance: '50px'
	});
	ScrollReveal().reveal('.sr8', {
		reset: true,
		origin: 'left',
		distance: '50px',
		delay: 300
	});
	ScrollReveal().reveal('.sr9', {
		reset: true,
		origin: 'left',
		distance: '50px',
		delay: 300
	});
      
});