<?php 
/**
 * 
 * @package sunsettheme

	===============================
		ADMIN PAGE 		
	===============================
 * 
 * */

function sunset_add_admin_page() {
	//Generate Sunset Main Admin Page
	add_menu_page( 'Sunset Theme Options', 'Sunset', 'manage_options', 'moe_sunset', 'sunset_theme_create_page', get_template_directory_uri() . '/img/sunset-icon.png', '110' );
	
	//Generate Sunset Sub-Menu  admin Pages
	add_submenu_page('moe_sunset', 'Sunset Sidebar Options', 'Sidebar', 'manage_options', 'moe_sunset', 'sunset_theme_create_page' );
	add_submenu_page('moe_sunset', 'Sunset Theme Options', 'Theme Options', 'manage_options', 'moe_sunset_theme', 'sunset_theme_support_page' );
	add_submenu_page('moe_sunset', 'Sunset Contact Options', 'Contact Form', 'manage_options', 'moe_sunset_theme_contact', 'sunset_contact_form_page' );
	add_submenu_page('moe_sunset', 'Sunset CSS Options', 'Custom CSS', 'manage_options', 'moe_sunset_CSS', 'sunset_theme_settings_page' );
	
	/*
	WP Admin Dashboard Hirarchy
	 2 - Dashboard
	 4 - Separator
	 5 - Posts
	10 - Media
	15 - Links
	20 - Pages
	25 - Comments 
	59 - Separator
	60 - Appearance
	65 - Plugins
	70 - Users
	75 - Tools
	80 - Settings
	99 - Separator
	*/
	
	//Activate custom settings
	add_action('admin_init', 'sunset_custom_settings' );
}
add_action('admin_menu', 'sunset_add_admin_page' );

function sunset_custom_settings() {
	//Sidebar Options
	$twitterArgs = array( 'sanitize_callback' => 'sunset_sanitize_twitter_handler' );
	$supportArgs = array( 'sanitize_callback' => 'sunset_post_formats_callback' );
	$cssArgs = array( 'sanitize_callback' => 'susnet_sanitize_custom_css' );
	
	//Start registering settings
	register_setting( 'sunset-settings-group', 'profile_picture' );
	register_setting( 'sunset-settings-group', 'first_name' );
	register_setting( 'sunset-settings-group', 'last_name' );
	register_setting( 'sunset-settings-group', 'twitter_handler', $twitterArgs );
	register_setting( 'sunset-settings-group', 'instagram_handler' );
	register_setting( 'sunset-settings-group', 'facebook_handler' );
	register_setting( 'sunset-settings-group', 'user_description' );
	
	add_settings_section('sunset-sidebar-options', 'Sidebar Options', 'sunset_sidebar_options', 'moe_sunset');
	
	add_settings_field( 'sidebar-profile-picture', 'Profile Picture', 'sunset_sidebar_profile', 'moe_sunset', 'sunset-sidebar-options');
	add_settings_field( 'sidebar-name', 'Full Name', 'sunset_sidebar_name', 'moe_sunset', 'sunset-sidebar-options');
	add_settings_field( 'sidebar_description', 'Description', 'sunset_sidebar_description', 'moe_sunset', 'sunset-sidebar-options');
	add_settings_field( 'sidebar-twitter', 'Twitter handler', 'sunset_sidebar_twitter', 'moe_sunset', 'sunset-sidebar-options');
	add_settings_field( 'sidebar-instagram', 'Instagram handler', 'sunset_sidebar_instagram', 'moe_sunset', 'sunset-sidebar-options');
	add_settings_field( 'sidebar-facebook', 'Facebook handler', 'sunset_sidebar_facebook', 'moe_sunset', 'sunset-sidebar-options');
	
	//Theme Support Options
	register_setting( 'sunset-theme-support', 'post_formats' );
	register_setting( 'sunset-theme-support', 'custom_header' );
	register_setting( 'sunset-theme-support', 'custom_background' );
	register_setting( 'sunset-theme-support', 'sticky_navbar' );
	
	add_settings_section('sunset-theme-options', 'Theme Options', 'sunset_theme_options', 'moe_sunset_theme');
	
	add_settings_field('post-format', 'Post Formats', 'sunset_post_formats', 'moe_sunset_theme', 'sunset-theme-options' );
	add_settings_field('custom-header', 'Custom Header', 'sunset_custom_header', 'moe_sunset_theme', 'sunset-theme-options' );
	add_settings_field('custom-background', 'Custom Background', 'sunset_custom_background', 'moe_sunset_theme', 'sunset-theme-options' );
	add_settings_field('sticky_navbar', 'Sticky Navigation Bar', 'sunset_sticky_navbar', 'moe_sunset_theme', 'sunset-theme-options' );
	
	//Contact Form Options
	register_setting( 'sunset-contact-options', 'activate_contact' );
	
	add_settings_section( 'sunset-contact-section', 'Contact Form', 'sunset_contact_section', 'moe_sunset_theme_contact' );
	
	add_settings_field( 'activate-form', 'Activate Contact Form', 'sunset_activate_contact', 'moe_sunset_theme_contact', 'sunset-contact-section' );
	
	//Custom CSS Options
	register_setting( 'sunset-custom-css-options', 'sunset_css', $cssArgs );
	
	add_settings_section( 'sunset-custom-css-section', 'Custom CSS', 'sunset_custom_css_section_callback', 'moe_sunset_CSS' );
	
	add_settings_field( 'custom-css', 'Insert your Custom CSS', 'sunset_custom_css_callback', 'moe_sunset_CSS', 'sunset-custom-css-section' );

	}

function sunset_custom_css_section_callback () {
	echo 'Customize your Theme With your Own CSS';
}

function sunset_custom_css_callback(){
	$css = get_option( 'sunset_css' );
	$css = ( empty($css) ? '/*Sunset Theme Custom CSS*/' : $css );
	echo '<div id="customCss">'.$css.'</div><textarea id="sunset_css" name="sunset_css" style="display:none;visibility:hidden">'.$css.'</textarea>';
}



function sunset_theme_options () {
	echo 'Activate and Deactivate Specific Theme Support Options';
}

function sunset_contact_section () {
	echo 'Activate and Deactivate the Built-in Contact Form';
}

function sunset_activate_contact(){
	$options = get_option( 'activate_contact' );
	$output = '';
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<lable><input type="checkbox" id="activate_contact" name="activate_contact" value="1" '.$checked.' /></lable>';
}

function sunset_activate_contact_form_option() {
	$options = get_option( 'activate_contact' );
	$checked = ( @$options == 1 ? 'checked' : '' );
	$ischecked = ( $checked == 'checked' ? '' : 'visually-hidden' );

	return $ischecked;

}

function sunset_sidebar_options() {
	echo 'Customize your sidebar information';
}

function sunset_custom_background() {
	$options = get_option( 'custom_background' );
	$output = '';
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<lable><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' /> Activate the Custom Background</lable>';
	}

function sunset_custom_header() {
	$options = get_option( 'custom_header' );
	
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<lable><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' /> Activate the Custom Header</lable>';
	}

function sunset_sticky_navbar() {

	$options = get_option( 'sticky_navbar' );
	
	$checked = ( @$options == 1 ? 'checked' : '' );
	echo '<lable><input type="checkbox" id="sticky_navbar" name="sticky_navbar" value="1" '.$checked.' /> Activate Sticky Navbar</lable>';

}

function sunset_sticky_navbar_option() {
	$options = get_option( 'sticky_navbar' );
	
	$checked = ( @$options == 1 ? 'checked' : '' );
	$ischecked = ( $checked == 'checked' ? 'sunset-sticky-navigation' : '' );

	return $ischecked;
}

function sunset_post_formats() {
	$options = get_option( 'post_formats' );
	$formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
	$output = '';
	foreach ( $formats as $format ){
		$checked = ( @$options[$format] == 1 ? 'checked' : '' );
		$output .= '<lable><input type="checkbox" id="'.$format.'"name="post_formats['.$format.']" value="1" '.$checked.' > '.$format.'</lable> <br>';
	}
	echo $output;
}

//Sidebar Options Functions
function sunset_sidebar_profile() {
	$picture = esc_attr(get_option( 'profile_picture' ));
	if( empty($picture) ){
		echo '<input id="upload-button" class="button button-secondary" type="button" value="Upload Profile Picture" > <input id="profile-picture" type="hidden"  value="" name="profile_picture" />';
		
	}
	else {
		echo '<input id="upload-button" class="button button-secondary" type="button" value="Replace Profile Picture" > <input id="profile-picture" type="hidden"  value="'.$picture.'" name="profile_picture" /> <input type="button" calss="button button-secondary" value="Remove" name="profile_picture" id="remove-picture" ';
		
	}
	
	
	
}

function sunset_sidebar_name() {
	$firstName = esc_attr(get_option( 'first_name' ));
	$lastName = esc_attr(get_option( 'last_name' ));
	echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name"/> <input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name"/>';
	
}

function sunset_sidebar_description () {
	$description = esc_attr(get_option( 'user_description' ));
	echo '<input type="text" name="user_description" value="'.$description.'" placeholder="User Description"/><p class="desription">Write something smart about yourself.</p>';
}

function sunset_sidebar_twitter () {
	$twitter = esc_attr(get_option( 'twitter_handler' ));
	echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter Handler"/> <p class="desription">Input your Twitter username without the @ character.</p>';
}

function sunset_sidebar_instagram() {
	$instagram = esc_attr(get_option( 'instagram_handler' ));
	echo '<input type="text" name="instagram_handler" value="'.$instagram.'" placeholder="Instagram Handler"/>';
}

function sunset_sidebar_facebook() {
	$facebook = esc_attr(get_option( 'facebook_handler' ));
	echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook Handler"/>';
}

//Sanitization setting 
function susnet_sanitize_custom_css( $input ){
	$output = esc_textarea( $input );
	return $output;
}

function sunset_sanitize_twitter_handler ( $input ) {
	$output = sanitize_text_field($input);
	$output = str_replace('@', '', $output);
	return $output;
}

//Template submenu functions
function sunset_theme_support_page() {
	require_once( get_template_directory() . '/inc/templates/sunset-theme-support.php');
}

function sunset_contact_form_page() {
	require_once( get_template_directory() . '/inc/templates/sunset-contact-form.php');
}

function sunset_theme_create_page() {
	
	//generation of custom admin page
	require_once (get_template_directory() . '/inc/templates/sunset-admin.php');
	
}

function sunset_theme_settings_page() {
	
	require_once (get_template_directory() . '/inc/templates/sunset-custom-css.php');

	
}



























