$(function () {

	// =============================================================================================
  
  		// Scrool top window

		$(window).on('beforeunload', function() {
			$(window).scrollTop(0);
		});

	// =============================================================================================

		//Preloader

		function hidePreloader() {

			$('.bg_load').fadeOut(500);
			$('body').removeClass('overflow-hidden');

		}

		if($('.bg_load').length){
			hidePreloader();
		}

	// =============================================================================================

		//Scroll Menu
		if($(window).width() >= 1900){

			$(window).scroll(function(){

				if( $(this).scrollTop() > 1150 ){
					$('.main-header').addClass('active-header');
					$('.footer-btn').addClass('active-btn-fixed-btn_back_top');		
					$('.filter__box').addClass('active-filter');	
					$('.filter .date').attr('id', 'date-input');		
				}else{
					$('.filter .date').attr('id', '');
					$('.footer-btn').removeClass('active-btn-fixed-btn_back_top');
					$('.main-header').removeClass('active-header');
					$('.filter__box').removeClass('active-filter');
				}

			});

		}else if($(window).width() >= 1350){

			$(window).scroll(function(){

				if( $(this).scrollTop() > 800 ){
					$('.main-header').addClass('active-header');
					$('.footer-btn').addClass('active-btn-fixed-btn_back_top');		
					$('.filter__box').addClass('active-filter');	
					$('.filter .date').attr('id', 'date-input');		
				}else{
					$('.filter .date').attr('id', '');
					$('.footer-btn').removeClass('active-btn-fixed-btn_back_top');
					$('.main-header').removeClass('active-header');
					$('.filter__box').removeClass('active-filter');
				}

			});

		}else{

			$(window).scroll(function(){

				if( $(this).scrollTop() > 350 ){
					$('.main-header').addClass('active-header');
					$('.footer-btn').addClass('active-btn-fixed-btn_back_top');	
				}else{
					$('.footer-btn').removeClass('active-btn-fixed-btn_back_top');
					$('.main-header').removeClass('active-header');
				}

			});
		}

	// =============================================================================================

		//Menu mobile button
		$('.ham').on('click', function () {
			$('body').toggleClass('is-nav');
			$('.open-menu').animate({height: 'toggle'});
		});

	// =============================================================================================


		// Down section click Arrow
    	$('.banner .banner__content span svg').on('click', function(){

		$('html, body').animate({
		  scrollTop: $('.about').offset().top - 125
	  
		  }, 200);
  
	  	});

	//==============================================================================================

		// Ancora Menu
		$('#about-link, #beach-link, #bedroom-link').click(function() {

			$('html, body').animate({
				scrollTop: $( $.attr(this, 'href') ).offset().top
			}, 1000);

			return false;
		});
  
	// =============================================================================================

		// button back to top
		$('.btn-back-top').on('click', function(e){
			e.preventDefault();
			$('body,html').animate({
				scrollTop: 0
			}, 700);
			return false;
		});

	//==============================================================================================
	
		//date-dropper
		$('#date-input-checkin').dateDropper({
			eventSelector: 'click',
			largeOnly: true,
			lang: 'pt',
			//roundtrip: 'my-trip',
			minYear: 2021,
			lock: 'from',
			startFromMonday: false,
			onChange: function (res) {
				var new_date = (res.date.d + '/' + res.date.m + '/' + res.date.Y);

				$('.filter #date-input-checkin').removeClass('wpcf7-not-valid');

				$('.datedropper .picker .pick-submit').on('click', function(){

					var old_date = $('#date-input-checkin').attr('data-date');

					if(old_date != new_date){
						$('#date-input-checkin').attr('data-date', new_date);
						$('#date-input-checkin').dateDropper('hide');
						$('#date-input-checkout').dateDropper('show');

						if($('#date-input').length){

							setTimeout(function(){ 
								var top = $('.datedropper').css('top');
								var topCalc = parseInt(top)-450;
								$('.datedropper').css('top', topCalc)
							}, 400);
						}
					}
				});
			}
		});

		$('#date-input-checkout').dateDropper({
			eventSelector: 'click',
			largeOnly: true,
			lang: 'pt',
			// roundtrip: 'my-trip',
			minYear: 2021,
			lock: 'from',
			startFromMonday: false,
			onChange: function (res) {
				var new_date = (res.date.d + '/' + res.date.m + '/' + res.date.Y);

				var dateCheckin = $('#date-input-checkin').attr('data-date');
				dateCheckin = dateCheckin.split('/');
				dateCheckin = dateCheckin[2]+'-'+dateCheckin[1]+'-'+dateCheckin[0];

				$('.datedropper .picker .pick-submit').on('click', function(){

					var old_date = $('#date-input-checkout').attr('data-date');

					if(old_date != new_date){

						$('.filter #date-input-checkout').removeClass('wpcf7-not-valid');
						$('#date-input-checkout').attr('data-date', new_date);
						$('#date-input-checkout').dateDropper('hide');
					}
				});
			}
		});
	
	
	//==============================================================================================

		//Onchange Age Children - filter
		$('#children').change(function(){
			
			var children_count = $(this).val();
			
			switch (children_count) {
				case '1':
					$('.box-age').removeClass('active-age-2-field');
					$('.box-age').addClass('active-age-1-field');

					var text_input = $('#age-1').val();
					if($('#children').val() == 2){
						text_input = text_input +', '+ $('#age-2').val();
					}
					
					$('#age-children').val(text_input);
					$('.box-age__modal').css('display', 'block');
					break;
				case '2':
					$('.box-age').removeClass('active-age-1-field');
					$('.box-age').addClass('active-age-2-field');

					var text_input = $('#age-2').val();
					text_input = $('#age-1').val() +', '+ text_input;
					$('#age-children').val(text_input);
					$('.box-age__modal').css('display', 'block');
					break;
				default:
					$('.box-age').removeClass('active-age-1-field');
					$('.box-age').removeClass('active-age-2-field');

					if($(window).width() <= 768){
						$('.filter__box').css('bottom', '-155px');
					}
					break;
			}
		});


		$('#age-1').change(function(){
			var text_input = $(this).val();

			if($('#children').val() == 2){
				text_input = text_input +', '+ $('#age-2').val();
			}

			$('#age-children').val(text_input);
		});

		$('#age-2').change(function(){
			var text_input = $(this).val();

			text_input = $('#age-1').val() +', '+ text_input;

			$('#age-children').val(text_input);
		});

		$('.box-age .btn-ok button').on('click', function(){
			$('.box-age__modal').css('display', 'none');
		});

		$('.mask-shadow').on('click', function(){
			$('.box-age__modal').css('display', 'block');
		});

	//==============================================================================================	

		//Active filter desktop - datedropper
		$('#date-input input').on('click', function(){

			if($('#date-input').length){

				setTimeout(function(){ 
					var top = $('.datedropper').css('top');
					var topCalc = parseInt(top)-450;
					$('.datedropper').css('top', topCalc)
				}, 400);
			}
			
		});

	//==============================================================================================

		// Open & Close Filter mobile
		if($(window).width() <= 768){
			$('.icon-open').on('click', function(){
				$('.filter__box').addClass('active-filter-mobile');

				if($(window).width() <= 767){
					$('.footer-btn').addClass('active-filter-move-btn-whats');
				}
			});

			$('.icon-close').on('click', function(){

				if($('.active-age-1-field').length || $('.active-age-2-field').length){
					$('.filter__box').css('bottom', '-304px');
				}

				$('.filter__box').removeClass('active-filter-mobile');
				$('.footer-btn').removeClass('active-filter-move-btn-whats');
			});
		}

	//==============================================================================================

		// btn-whats, btn-back-top / move buttons
		// if($(window).width() >= 1000){

		// 	$(window).scroll(function(){

		// 		if( $(this).scrollTop() > 4500 ){
		// 			$('.footer-btn').addClass('active-btns');
		// 		}else{
		// 			$('.footer-btn').removeClass('active-btns');
		// 		}
		// 	});
		// }

	//==============================================================================================

		//click reserva header
		$('.reserva').on('click', function(e){
			e.preventDefault();

			if($(window).width() >= 768){

				$('html, body').animate({
					scrollTop: $('#filter').offset().top - 50
				}, 200);

				setTimeout(function(){ 
					$('.filter #date-input-checkin').focus();
				}, 500);
				
			}else{
				$('.ham').trigger('click');
				$('.icon-open').trigger('click');
			}
		});

	//==============================================================================================


		//Redirect reserva

		$('.filter #adult').on('click', function(){
			$(this).removeClass('wpcf7-not-valid');
		});

		$('.filter .click-reserva').on('click', function(e){
			e.preventDefault();

			var adult    = $('.filter #adult').val();
			var children = $('.filter #children').val();
			var checkin  = $('.filter #date-input-checkin').val();
			var checkout = $('.filter #date-input-checkout').val();

			if(checkin == ''){
				handleNotify("danger", "Informe a data para Checkin!");
				$('.filter #date-input-checkin').addClass('wpcf7-not-valid');
				return false;
			}

			if(checkout == ''){
				handleNotify("danger", "Informe a data para Checkout!");
				$('.filter #date-input-checkout').addClass('wpcf7-not-valid');
				return false;
			}

			var checkinFormat = checkin.split('/');
			checkin = checkinFormat[2]+'-'+checkinFormat[1]+'-'+checkinFormat[0];

			var checkoutFormat = checkout.split('/');
			checkout = checkoutFormat[2]+'-'+checkoutFormat[1]+'-'+checkoutFormat[0];
			

			if(checkin > checkout){
				handleNotify("danger", "Checkout não pode ser uma data antes da data do Checkin!");
				$('.filter #date-input-checkout').addClass('wpcf7-not-valid');
				return false;
			}

			if(adult == ''){
				handleNotify("danger", "Informe a quantidade de pessoas adultas!");
				$('.filter #adult').addClass('wpcf7-not-valid');
				return false;
			}

			var url = 'https://hbook.hsystem.com.br/Booking?companyId=5f514164ab41d42368a1007c';

			//adult
			url += '&adults=' + adult;

			//children
			url += '&children=' + children;

			if(children > 0){
				var age_children = $('#age-children').val();

				switch (children) {
					case '1':
						
						if(age_children == '0'){
							handleNotify("danger", "Informe a idade da criança!");
							return false;
						}else{
							url += '&childrenage=' + age_children;
						}

						break;
					case '2':

						var age_children_split = age_children.split(', ');

						if((age_children_split[0] == '0') || (age_children_split[1] == '0')){
							handleNotify("danger", "Informe a idade das crianças!");
							return false;
						}else{
							console.log();
							url += '&childrenage=' + age_children_split[0] + '&childrenage=' + age_children_split[1];
						}

						break;
					default:
						break;
				}
			}

			//checkin			
			url += '&checkin=' + checkin;

			//checkout			
			url += '&checkout=' + checkout;

			window.open(url, '_blank');
			
		});

	//==============================================================================================

		//Slider About Hotel
		if($('.about .about__box__content__image .slider').length) {
			$('.about .about__box__content__image .slider').slick({
				dots: false,
				arrows: true,
				slidesToScroll: 1,
				slidesToShow: 1,
				adaptiveHeight: true,
				// autoplay: true,
				// autoplaySpeed: 3000,
				responsive: [
					{
						breakpoint: 991,
						settings: {
							dots: true,
							arrows: false,
							slidesToScroll: 1,
							slidesToShow: 1,
						}
					}
				]
			});
		}

		//==============================================================================================

		//Slider Banner Hotel
		if($('.banner .banner__box__content__image .slider').length) {
			$('.banner .banner__box__content__image .slider').slick({
				dots: false,
				arrows: true,
				slidesToScroll: 1,
				slidesToShow: 1,
				adaptiveHeight: true,
				// autoplay: true,
				// autoplaySpeed: 3000,
				responsive: [
					{
						breakpoint: 991,
						settings: {
							dots: true,
							arrows: false,
							slidesToScroll: 1,
							slidesToShow: 1,
						}
					}
				]
			});
		}

		//==============================================================================================

		//Slider Details Hotel
		if($('.details .details__box__content__image .slider').length) {
			$('.details .details__box__content__image .slider').slick({
				dots: false,
				arrows: true,
				slidesToScroll: 1,
				slidesToShow: 1,
				adaptiveHeight: true,
				// autoplay: true,
				// autoplaySpeed: 3000,
				responsive: [
					{
						breakpoint: 991,
						settings: {
							dots: true,
							arrows: false,
							slidesToScroll: 1,
							slidesToShow: 1,
						}
					}
				]
			});
		}

		//==============================================================================================

		// Slick Slider Bedroom
		if ($('.fotos .fotos__slider').length) {
			$('.fotos .fotos__slider').slick({
				dots: false,
				arrows: true,
				slidesToScroll: 1,
				slidesToShow: 2,
				adaptiveHeight: true,
				// autoplay: true,
				// autoplaySpeed: 3000,
				responsive: [
					{
						breakpoint: 991,
						settings: {
							dots: true,
							arrows: true,
							slidesToScroll: 1,
							slidesToShow: 1,
						}
					}
				]
			});
		}

		if ($('.fotos .image-slider').length) {
			$('.fotos .image-slider').slick({
				dots: true,
				arrows: true,
				slidesToScroll: 1,
				slidesToShow: 1,
				adaptiveHeight: true,
				// autoplay: true,
				// autoplaySpeed: 3000,
				responsive: [
					{
						breakpoint: 991,
						settings: {
							dots: true,
							arrows: true,
							slidesToScroll: 1,
							slidesToShow: 1,
						}
					}
				]
			});
		}

	// =============================================================================================

		//Slick Slider Fotos - prev next
		$('.fotos__slider .slick-prev, .fotos__slider .slick-next, .fotos__slider .slick-slide').on('click', function(){
			var current = $('.fotos__slider .slick-current').data('current');

			$('.fotos__change__right .qtd_fotos').text(current);
		});


	// =============================================================================================

		//Slider Beach Hotel
		if($('.beach .beach__box__content__image .slider').length) {
			$('.beach .beach__box__content__image .slider').slick({
				dots: false,
				arrows: true,
				slidesToScroll: 1,
				slidesToShow: 1,
				adaptiveHeight: true,
				// autoplay: true,
				// autoplaySpeed: 3000,
				responsive: [
					{
						breakpoint: 991,
						settings: {
							dots: true,
							arrows: false,
							slidesToScroll: 1,
							slidesToShow: 1,
						}
					}
				]
			});
		}

	// =============================================================================================

		//Slider Estrutura Hotel
		if($('.estrutura .estrutura__box__content__image .slider').length) {
			$('.estrutura .estrutura__box__content__image .slider').slick({
				dots: false,
				arrows: true,
				slidesToScroll: 1,
				slidesToShow: 1,
				adaptiveHeight: true,
				// autoplay: true,
				// autoplaySpeed: 3000,
				responsive: [
					{
						breakpoint: 991,
						settings: {
							dots: true,
							arrows: false,
							slidesToScroll: 1,
							slidesToShow: 1,
						}
					}
				]
			});
		}

	// =============================================================================================

		// Slick Slider Bedroom
		if ($('.bedroom .bedroom__slider').length) {
			$('.bedroom .bedroom__slider').slick({
				dots: false,
				arrows: true,
				slidesToScroll: 1,
				slidesToShow: 2,
				adaptiveHeight: true,
				// autoplay: true,
				// autoplaySpeed: 3000,
				responsive: [
					{
						breakpoint: 991,
						settings: {
							dots: true,
							arrows: true,
							slidesToScroll: 1,
							slidesToShow: 1,
						}
					}
				]
			});
		}

		if ($('.bedroom .image-slider').length) {
			$('.bedroom .image-slider').slick({
				dots: true,
				arrows: true,
				slidesToScroll: 1,
				slidesToShow: 1,
				adaptiveHeight: true,
				// autoplay: true,
				// autoplaySpeed: 3000,
				responsive: [
					{
						breakpoint: 991,
						settings: {
							dots: true,
							arrows: true,
							slidesToScroll: 1,
							slidesToShow: 1,
						}
					}
				]
			});
		}

	// =============================================================================================

		//Slick Slider Bedroom - prev next
		$('.bedroom__slider .slick-prev, .bedroom__slider .slick-next, .bedroom__slider .slick-slide').on('click', function(){
			var current = $('.bedroom__slider .slick-current').data('current');

			$('.bedroom__change__right .qtd_bedroom').text(current);
		});

	// =============================================================================================

		// Mask Inputs
		$('#mask-cnpj').mask('00.000.000/0000-00', { reverse: true });
		$('#mask-phone').mask('(00) 0 0000-0000');
		$('.mask_celular').mask('(00) 00000-0000');
		$('.mask-cpf').mask('000.000.000-00');	

	// =============================================================================================

		// Lightbox in slider

		$('.about .about__box__content__image .slider .item svg').lightBox();
		$('.beach .beach__box__content__image .slider .item svg').lightBox();
		$('.fotos .fotos__box__content__image .slider .item svg').lightBox();
		$('.details .details__box__content__image .slider .item svg').lightBox();
		$('.bedroom .bedroom__box__content__image .slider .item svg').lightBox();
		$('.estrutura .estrutura__box__content__image .slider .item svg').lightBox();
		$('.banner .banner__box__content__image .slider .item svg').lightBox();

	// =============================================================================================

});	

document.addEventListener("wpcf7submit", function(event){

	if($('.wpcf7-list-item label input') && !$('.wpcf7-list-item label input').is(":checked")){
		handleNotify("danger", 'Você precisa aceitar nossa <a href="'+BASE_URL+'/politica-de-privacidade">Política de Privacidade</a> para prosseguir.');
		$(".fadeInDown").addClass('border-notify');
	}else if(event.detail.status=="validation_failed"){
		handleNotify("danger", event.detail.apiResponse.message);
		$(".fadeInDown").addClass('border-notify');
	}else if('5' == event.detail.contactFormId){

		if(event.detail.status=="mail_sent"){
			handleNotify("success", event.detail.apiResponse.message);
			$(".fadeInDown").addClass('border-notify');
			window.location.replace(BASE_URL+'/sucesso');
		}
	
	}

});

function handleNotify(type, message){
	//type: 'info', 'danger', 'success'
	$.notify({
		// options
		message: message 
	},{
		// settings
		type: type,
		z_index: 9999
	});
}