jQuery(document).ready( function($){
	//custom Sunset script

	/* init function */
	revealPosts();

	/* variable declarations */
	var carousel = '.sunset-carousel-thumb';
	var last_scroll = 0;
	
	// Show next and previous images on hover on slider nav buttons
	sunset_get_bs_thumbs( carousel ); //show carousel thumbnails before sliding starts
	/* show carousel thumbnials after sliding is compeleted */
	$( carousel ).on('slid.bs.carousel', function(){
		sunset_get_bs_thumbs( carousel );
	});

	function sunset_get_bs_thumbs( carousel ){

		$(carousel).each(function(){
			var nextThumb = $(this).find('.carousel-item.active').find('.next-image-preview').data('image');
			var prevThumb = $(this).find('.carousel-item.active').find('.prev-image-preview').data('image');

			$(this).find('.carousel-control-next').find('.thumbnail-container').css({ 'background-image' : 'url('+nextThumb+')' });
			$(this).find('.carousel-control-prev').find('.thumbnail-container').css({ 'background-image' : 'url('+prevThumb+')' });
		});
	
	}

	/* Ajax functions */
	$(document).on('click', '.sunset-load-more:not(.loading)', function(){

		var that = $(this);
		var page = $(this).data('page');
		var newPage = page+1;
		var ajaxurl = that.data('url');
		var prev = that.data('prev');
		var archive = that.data('archive');
		var homepage = that.data('homepage');

		if( typeof prev === 'undefined' ){
			prev = 0;
		}

		if( typeof archive === 'undefined' ){
			archive = homepage;
		}

		that.addClass('loading').find('.text').slideUp(320);
		that.find('.sunset-icon').addClass('spin');

		$.ajax({

			url : ajaxurl,
			type : 'post',
			data : {

				page : page,
				prev : prev,
				archive : archive,
				action : 'sunset_load_more'

			},
			error : function( response ){
				console.log(response);
			},
			success : function( response ){

				if( response == 0 ){
					$('.sunset-posts-container').append( '<div class="text-center"><h3> You reached the end of the page!</h3><p>No more posts to load.</p></div>' );
					that.slideUp(320);
				} else {
					setTimeout( function(){

						if( prev == 1 ){
							$('.sunset-posts-container').prepend( response );
							newPage = page-1;
						} else {
							$('.sunset-posts-container').append( response );
						}

						if( newPage == 1 ){
							that.slideUp(320);
						}else {

							that.data('page', newPage);
						
							that.removeClass('loading').find('.text').slideDown(320);
							that.find('.sunset-icon').removeClass('spin');

						}

						/*reveal carousel thumbnail after ajax loading*/
						$( carousel ).on('slid.bs.carousel', function(){
							sunset_get_bs_thumbs( carousel );
						});
						sunset_get_bs_thumbs( carousel );
						revealPosts();

					}, 1000);
				}

			}

		});

	});

	/* scroll function */
	$(window).scroll( function(){

		var scroll = $(window).scrollTop();

		if( Math.abs( scroll-last_scroll ) > $(window).height()*0.1 ) {
			last_scroll = scroll;

			$('.page-limit').each(function( index ){

				if( isVisible( $(this) ) ){

					history.replaceState( null, null, $(this).attr("data-page") );
					return(false);

				}

			});

		}


	} );

		/* sticky navbar function */

	if ( $("#sunset_navigation").hasClass("sunset-sticky-navigation") ){

		window.onload = function() {sunset_sticky_navbar()};
		window.onscroll = function() {sunset_sticky_navbar()};

			var navbar = document.getElementById("sunset_navigation");
			var sticky = navbar.offsetTop+250;

			function sunset_sticky_navbar() {


			  if (window.pageYOffset >= sticky) {
			    navbar.classList.add("sunset-sticky-navigation");
			    console.log( "the class added" );
			  } else {
			    navbar.classList.remove("sunset-sticky-navigation");
			    console.log ( "the class removed" );
			  }
			}

	}

	
	

	/* helper functions */
	function revealPosts(){

		//activate tooltips
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
		var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		  return new bootstrap.Tooltip(tooltipTriggerEl)
		})
		
		//activate popovers
		var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
		var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
		  return new bootstrap.Popover(popoverTriggerEl)
		})

		//reveal posts
		var posts = $('article:not(.reveal)');
		var i = 0;
		setInterval(function(){

			if( i >= posts.length ) return false;

			var el = posts[i];

			/* 
				detect and initiate carousel again after ajax loading, 
				otherwise it will not slide aoutomatically 
			*/
			$(el).addClass('reveal').find('.sunset-carousel-thumb').carousel(); 


			i++

		}, 200);

	}

	function isVisible( element ){

		var scroll_pos = $(window).scrollTop();
		var window_height = $(window).height();
		var el_top = $(element).offset().top;
		var el_height = $(element).height();
		var el_bottom = el_top + el_height;
		return ( ( el_bottom - el_height*0.25 > scroll_pos ) && ( el_top < ( scroll_pos+0.5*window_height ) ) );

	}

	/* sidebar functions */
	$(document).on('click', '.js-toggleSidebar', function(){
		$( '.sunset-sidebar' ).toggleClass( 'sidebar-closed' );
		$( 'body' ).toggleClass( 'no-scroll' );
		$( '.sidebar-overlay' ).fadeToggle( 320 );
	});

/* contact form submission */
	$('#sunsetContacForm').on('submit', function(e){

		e.preventDefault();

		$('.spinner-border').addClass('visually-hidden');

		var form = $(this);

		var name = form.find('#name').val(),
		email = form.find('#email').val(),
		message = form.find('#message').val(),
		ajaxurl = form.data('url');

		if( name === '' || email === '' || message === '' ){
			// console.log( 'Rquired fields are empty' );
			return;
		}

		form.find('input, button, textarea').attr('disabled', 'disabled');
		$('.spinner-border').removeClass('visually-hidden');

		

		$.ajax({

			url : ajaxurl,
			type : 'post',
			data : {

				name : name,
				email : email,
				message : message,
				action : 'sunset_save_user_contact_form'

			},
			error : function( response ){
				$('.spinner-border').addClass('visually-hidden');
				$('.js-form-error').removeClass('visually-hidden');
				form.find('input, button, textarea').removeAttr('disabled');

			},
			success : function( response ){
				if( response == 0 ){
					$('.spinner-border').addClass('visually-hidden');
					$('.js-form-error').removeClass('visually-hidden');
					form.find('input, button, textarea').removeAttr('disabled');
				} else {

					$('.spinner-border').addClass('visually-hidden');
					$('.js-form-success').removeClass('visually-hidden');
					form.find('input, button, textarea').removeAttr('disabled').val('');
					$('.was-validated').removeClass('was-validated');


				}
			}

		});

	});


	/* contact form validation */
	(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()

});