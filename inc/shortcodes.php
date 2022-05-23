<?php
/**
 * 
 * @package sunsettheme

	===============================
		SHORTCODE Options 		
	===============================
 * 
 * */

function sunset_tooltip( $atts, $content = null ){

	//[tooltip placement="top" title="This is the title"]This is the content[/tooltip]

	//get the attributes
	$atts = shortcode_atts(
		array(
			'placement' 	=> 'bottom',
			'title' 		=> '',
		),
		$atts,
		'tooltip'
	);

	$title = ( $atts['title'] == '' ? $content : $atts['title'] );

	//return HTML
	return '<span class="sunset-tooltip" data-bs-toggle="tooltip" data-bs-placement="'. $atts['placement'] .'" title="' . $title . '">'. $content .'</span>';

}

add_shortcode( 'tooltip', 'sunset_tooltip' );


function sunset_popover( $atts, $content = null ){
	//[popover title="Popover title" placement="top" trigger="click" content="this is the popover content"]Tis is the clickable content[/popover]

	//get the attributes
	$atts = shortcode_atts(
		array(
			'placement' 	=> 'top',
			'title' 		=> '',
			'trigger' 		=> 'click',
			'content' 		=> '',
		),
		$atts,
		'popover'
	);

	//return HTML
	return '<span class="sunset-popover" data-bs-toggle="popover" data-bs-placement="'. $atts['placement'] .'" title="' . $atts['title'] . '" data-bs-trigger="'. $atts['trigger'] .'" data-bs-content="'. $atts['content'] .'">'. $content .'</span>';

}

add_shortcode( 'popover', 'sunset_popover' );

// Contact Form shortcode
function sunset_contact_form( $atts, $content = null ){

	//[contact_form]

	//get the attributes
	$atts = shortcode_atts(
		array(),
		$atts,
		'contact_form'
	);

	//return HTML
	ob_start();
	include 'templates/contact-form.php';
	return ob_get_clean();

}

add_shortcode( 'contact_form', 'sunset_contact_form' );
