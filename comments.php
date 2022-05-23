<?php 
/**
 * 
 * @package sunsettheme

	===============================
		COMMENTS SECTION 		
	===============================
 * 
 * */

if( post_password_required() ){
	return;
}

?>

<div id="comments" class="comments-area">

	<?php
		if( have_comments() ):

	?>

	<h4 class="comments-title">
		<?php
			
			printf(

				'<span> ' . comments_number('Be the first to comment on ', '1 Comment on ', '% Comments on ') . get_the_title() . ' </span>'
			);

		?>
	</h4>

	<?php sunset_get_post_navigation(); ?>

	<ol class="coments-list">
		
		<?php 

			$args = array(
				'walker' 			=> null,
				'max_depth' 		=> 4,
				'style' 			=> 'ol',
				'callback' 			=> null, 
				'end-callback' 		=> null,
				'type'				=> 'all',
				'reply_text'		=> 'Reply',
				'page'				=> '',
				'per_page'			=> '',
				'avatar_size'		=> 64,
				'reverse_top_level'	=> true,
				'reverse_children'	=> '',
				'format'			=> 'html5',
				'short_ping'		=> false,
				'echo'				=> true
			);


			wp_list_comments( $args ); 
		?>

	</ol>

	<?php sunset_get_post_navigation(); 

		if( !comments_open() && get_comments_number() ):
	?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'sunsettheme' ); ?></p>
	<?php
		endif;

	?>

	<?php
		endif;

	?>
	
	<?php 

		$fields = array(

			'author' =>
				'<div class="form-group"><label for="author">' . __( 'Name', 'domainreference' ) . '</label> <span class="required">*</span> <input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" required="required" /></div>',
				
			'email' =>
				'<div class="form-group"><label for="email">' . __( 'Email', 'domainreference' ) . '</label> <span class="required">*</span><input id="email" name="email" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" required="required" /></div>',
				
			'url' =>
				'<div class="form-group last-field"><label for="url">' . __( 'Website', 'domainreference' ) . '</label><input id="url" name="url" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div>',

			'cookies' => ''
				

		);

		$args = array(

			'class_submit' 		=> 'but btn-lg btn-warning w-100',
			'label_submit' 		=> __( 'Submit Comment' ),
			'comment_field' 	=> '<div class="form-group"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <span class="required">*</span><textarea id="comment" class="form-control" name="comment" rows="4" required="required"></textarea></p>',
			'fields' 			=> apply_filters( 'comment_form_default_fields', $fields )

		);

		comment_form($args); 
	?>

</div><!-- .comments-area -->