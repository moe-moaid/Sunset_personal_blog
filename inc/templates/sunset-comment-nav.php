<?php/*

@package sunsettheme

*/
?>
<nav class="commnet-navigation" role="navigation">
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<div class="postlink-nav-previous">
				<span class="sunset-icon sunset-chevron-left" aria-hidden="true"></span> 
				<?php previous_comments_link( esc_html__( 'Older Comments', 'sunsettheme' ) ) ?>
			</div>
		</div>

		<div class="col-xs-12 col-sm-6">
			<div class="postlink-nav-next">
				<span class="sunset-icon sunset-chevron-right" aria-hidden="true"></span> 
				<?php next_comments_link( esc_html__( 'latest Comments', 'sunsettheme' ) ) ?>
			</div>
		</div>
	</div><!-- .row -->
	
</nav>