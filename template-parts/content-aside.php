<?php
/*

@package sunsettheme

	===============================
		ASIDE POST FORMAT
	===============================
*/

// $class = get_query_var( 'post-class' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array ( 'sunset-format-aside' /*, $class*/ ) ); ?>>

	<div class="aside-container">
		
		<div class="row">

			<div class="col-xs-12 col-sm-4 col-md-3 text-center">

				<?php if( sunset_get_attachment() ): ?>
				
					<div class="aside-featured background-image" style="background-image: url(<?php echo sunset_get_attachment(); ?>);"></div>

				<?php endif ?>

			</div><!-- .col-md-2 -->

			<div class="col-xs-12 col-sm-8 col-md-9">

				<header class="entry-header">

					<div class="entry-meta">
						<?php echo sunset_posted_meta(); ?>
					</div>
			
				</header>

				<div class="entry-content">

					<div class="entry-excerpt">
						<?php the_content(); ?>
					</div>

				</div> <!-- .entry-content -->

			</div><!-- .col-md-10 -->

		</div><!-- .row -->

		<footer class="entry-footer">

			<div class="row">

				<div class="col-sm-8 offset-sm-4 col-md-9 offset-md-3">
					<?php echo sunset_posted_footer(); ?>
				</div><!-- .col-md-9 -->

			</div><!-- .row -->

		</footer>
	</div><!-- .aside-container -->

	
</article>