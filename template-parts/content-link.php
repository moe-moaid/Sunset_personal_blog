<?php
/**
 * 
 * @package sunsettheme

	===============================
		Link POST FORMAT
	===============================
 * 
 * */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sunset-format-link' ); ?>>
	<header class="entry-header text-center">

		<?php 
			$link = sunset_grap_url();
			the_title( '<h1 class="entry-title"><a href="' .$link. '" target="_blank">','<dic class="link-icon"><span class="sunset-icon sunset-link"></span></div></a></h1>' ); 
		?>

		
		
	</header>

</article>