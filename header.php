<?php
/**
 * 
 * @package sunsettheme

	===============================
		HEADER SECTION		
	===============================
 * 
 * */
?>

<html <?php language_attributes(); ?>>
	<head>
		<title><?php bloginfo( 'name' ); wp_title(); ?></title>
		<meta name="description" content="<?php bloginfo( 'description' ); ?>">
		  <meta charset="<?php bloginfo( 'charset' ); ?>">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="profile" href="http://gmpg.org/xfn/11" >
			<?php if( is_singular() && pings_open( get_queried_object() ) ): ?>
		  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif; ?>
		<?php wp_head(); ?>
	</head>

<body <?php body_class(); ?>>
<!-- sidebar-closed -->
	<div class="sunset-sidebar sidebar-closed ">

		<div class="sunset-sidebar-container">

			<a class="js-toggleSidebar sidebar-close">
				<span class="sunset-icon sunset-close"></span>
			</a>

			<div class="sidebar-scroll">
			
				<?php get_sidebar(); ?>

			</div><!-- .sidebar-scroll -->

		</div><!-- .sunset-sidebar-container -->
		
	</div><!-- .sunset-sidebar -->

	<div class="sidebar-overlay js-toggleSidebar"></div>
	
	<div class="container-fluid">
		
		<div class="row">
				
			<header class="header-container background-image text-center" style="background-image: url(<?php header_image(); ?>);">

				<a class="js-toggleSidebar sidebar-open">
				<span class="sunset-icon sunset-menu"></span>
			</a>
				
				<div class="header-content table">
					<div class="table-cell">
						<h1 class="site-title sunset-icon">
							<span class="sunset-logo"></span>
							<span class="visually-hidden"><?php bloginfo( 'name' ); ?></span>
						</h1>
						<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
					</div><!-- .table-cell -->
				</div><!-- .header-content -->
				
				<div class="nav-container d-none d-sm-block"  >
					
					<nav id="sunset_navigation" class="navbar navbar-sunset navbar-expand-md <?php echo sunset_sticky_navbar_option(); ?>" role="navigation" >
					  <div  class="container collapse navbar-collapse ms-auto me-auto" >
					        <?php
					        wp_nav_menu( array(
					            'theme_location'    => 'primary',
					            'depth'             => 5,
					            'container'         => 'div',
					            'container_class'   => 'collapse navbar-collapse',
					            'container_id'      => 'sunset-navbar-collapse-1',
					            'menu_class'        => 'nav navbar-nav',
					            'fallback_cb'       => '__return_false',
					            'walker'            => new Sunset_Walker_Nav_Primary(),
					        ) );
					        ?>
					  </div>

					</nav>
					
				</div><!-- .nav-container -->
				
			</header><!-- .header-container -->

		</div><!-- .row -->
		
	</div><!-- .container-fluid -->