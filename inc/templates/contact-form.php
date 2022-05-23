<form id="sunsetContacForm" class="needs-validation sunset-contact-form <?php echo sunset_activate_contact_form_option(); ?>" novalidate action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">

	<div class="text-center">
		<img src="<?php echo get_template_directory_uri() . '/img/paper-plane.png '; ?>">
		
	</div>

	<div class="form-group has-validation">
	<input for="validationCustomname" type="text" class="form-control sunset-form-control" placeholder="Your Name" id="name" name="name" required="required">
	<div class="invalid-feedback">
      This field is required.
    </div>
	</div>

	<div class="form-group has-validation">
	<input for="validationCustomemail" type="email" class="form-control sunset-form-control" placeholder="Your Email" id="email" name="email" required="required">
	<div class="invalid-feedback">
      This field is required, Please provide a valid email
    </div>
	</div>

	<div class="form-group has-validation">
	<textarea for="validationCustommessage" name="message" id="message" class="form-control sunset-form-control" required="required" placeholder="Your Message"></textarea>
	<div class="invalid-feedback">
      This field is required.
    </div>
	</div>

	<div class="text-center">
		<button type="submit" class="btn btn-outline-secondary sunset-form-btn">Submit
		<span class="spinner-border spinner-border-sm visually-hidden js-form-submission" role="status"></span>
	  	</button>

	  	<small class="text-success visually-hidden js-form-success">Message Successfully submitted, Thank you!</small>
		<small class="text-danger visually-hidden js-form-error">Error occured while submitting the form, please try again!</small>
	</div>
	
</form>