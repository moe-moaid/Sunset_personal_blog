<h1>Sunset Contact Form</h1>
<?php settings_errors(); ?>

<p>Use this <strong>shortcode</strong> to activate hte Contact Form inside a Page or a Post</p>
<p><code>[contact_form]</code></p>

<form method="post" action="options.php" class="sunset-general-form">
	<?php settings_fields('senset-contact-options'); ?>
	<?php do_settings_sections('moe_sunset_theme_contact'); ?>
	<?php submit_button(); ?> 
</form>