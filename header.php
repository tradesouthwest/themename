<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package:   ClassicPress
 * @subpackage themename
 * @since      themename 1.0.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name   ="viewport" content="width=device-width, initial-scale=1">
	<link rel    ="profile" href="http://gmpg.org/xfn/11">
	<?php 
	if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel    ="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php 
	endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

	<a class="skip-link screen-reader-text" href="#main">
    	<?php esc_attr_e( 'Skip to content', 'themename' ); ?></a>

	<div class="header">
		<div id="header-menu" class="site-header-menu">
		
			<nav id="nav" class="navbar navigation-top" aria-label="<?php esc_attr_e( 'Primary Menu', 'themename' ); ?>">
			
				<?php 
				if ( has_nav_menu( 'primary' ) ) : ?>
				<div id="menu-toggle">
					<span class="menu-toggle"><strong>|||</strong></span>
					<span class="menu-toggle-text screen-reader-text"><?php esc_html_e( 'open menu', 'themename' ); ?></span>	
				</div>
				<div class="nav-inside">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_class' => 'primary-menu',
						)
					);
				?>
				</div>
				<?php 
				endif; ?>
		
			</nav><!-- .main-navigation -->
			
		</div>
	</div><!-- .site-header -->