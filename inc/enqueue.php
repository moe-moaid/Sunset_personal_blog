<?php

/*

@package sunsettheme

	===============================
		ADMIN ENQUEUE FUNCTIONS
	===============================
*/


function sunset_load_admin_scripts( $hook ) {
	//echo $hook;
	if( 'toplevel_page_moe_sunset' == $hook ){
		
	
		wp_register_style( 'sunset_admin', get_template_directory_uri() . '/css/sunset.admin.css', array(), '1.0.0', 'all' );
		wp_enqueue_style( 'sunset_admin' );

		wp_enqueue_media();

		wp_register_script( 'sunset_admin_script', get_template_directory_uri() . '/js/sunset.admin.js', array('jquery'), '1.0.0', true );
		wp_enqueue_script( 'sunset_admin_script' );
		
	} else if( 'sunset_page_moe_sunset_CSS' == $hook ){
		//Registering scripts and CSS for 'ACE', our text editor
		wp_register_style( 'ace', get_template_directory_uri() . '/css/sunset.ace.css', array(), '1.0.0', 'all' );
		wp_enqueue_style( 'ace' );
		
		wp_register_script( 'ace', get_template_directory_uri() . '/js/ace/ace.js', array('jquery'), '1.4.14', true );
		wp_enqueue_script( 'ace' );
		
		wp_register_script( 'sunset-custom-css-script', get_template_directory_uri() . '/js/sunset.custom_css.js', array('jquery'), '1.0.0', true ); 
		wp_enqueue_script( 'sunset-custom-css-script' );
		
	
	} else {return; }
	
}
add_action( 'admin_enqueue_scripts', 'sunset_load_admin_scripts' );

/*
	===================================
		FRONT-END ENQUEUE FUNCTIONS		
	===================================
*/

function sunset_load_scripts() {
	//enque bootstrap right away, no need to register it, because it is basic and used everywhere in the theme
	
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '5.0.2', 'all' );
	wp_enqueue_style( 'sunset', get_template_directory_uri() . '/css/sunset.css', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'ralewy', 'https://fonts.googleapis.com/css?family=Raleway:200,300,500' );
	
	wp_deregister_script( 'jquery' );
	wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), false, '3.6.0', true );
	//enqueue scripts 
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', array('jquery'), '2.9.2', true );
	wp_enqueue_script( 'bootstrap-bundle', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery'), '5.0.2', true );
	wp_enqueue_script( 'bootstrap-min', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '5.0.2', true );
	wp_enqueue_script( 'sunset', get_template_directory_uri() . '/js/sunset.js', array('jquery'), '1.0.0', true );
		
}

add_action( 'wp_enqueue_scripts', 'sunset_load_scripts' );


/*
	=========================================
		REGISTER CUSTOM NAVIGATION WALKER		
	=========================================
*/

function register_navwalker(){
	require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );
















