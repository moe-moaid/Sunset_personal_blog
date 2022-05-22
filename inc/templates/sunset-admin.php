<h1>Sunset Sidebar Options</h1>
<?php settings_errors(); ?>
<?php 

$picture = esc_attr(get_option( 'profile_picture' ));
$firstName = esc_attr(get_option( 'first_name' ));
$lastName = esc_attr(get_option( 'last_name' ));
$fullName = $firstName .' '. $lastName;
$description = esc_attr(get_option( 'user_description' ));

$twitter_icon = esc_attr( get_option( 'twitter_handler' ) );
$facebook_icon = esc_attr( get_option( 'facebook_handler' ) );
$instagram_icon = esc_attr( get_option( 'instagram_handler' ) );

?>
<div class="sunset-sidebar-preview">
	<div class="sunset-sidebar">
		<div class="image-container">
			<div id="profile-picture-preview" class="profile-picture" style="background-image: url(<?php print $picture; ?>)"></div>
		</div>
		<h1 class="sunset-username"><?php print $fullName; ?></h1>
		<h2 class="sunset-description"><?php print $description; ?></h2>
		<div class="icons-wrapper">
			<?php if( !empty( $twitter_icon ) ): ?>
				<span class="sunset-icon-sidebar dashicons-before dashicons-twitter"></span>
			<?php endif; ?>
			<?php if( !empty( $instagram_icon ) ): ?>
				<span class="dashicons dashicons-instagram"></span>
			<?php endif; ?>
			<?php if( !empty( $facebook_icon ) ): ?>
				<span class="sunset-icon-sidebar dashicons-before dashicons-facebook-alt"></span>
			<?php endif; ?>
		</div><!-- .icons-wrapper -->
	</div><!-- .sunset-sidebar -->
</div><!-- .sunset-sidebar-preview -->
<form id="submitForm" method="post" action="options.php" class="sunset-general-form">
	<?php settings_fields('sunset-settings-group'); ?>
	<?php do_settings_sections('moe_sunset'); ?>
	<?php submit_button( 'Save Changes', 'primary', 'btnSubmit' ); ?> 
</form>