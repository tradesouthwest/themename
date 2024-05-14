<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package:   ClassicPress
 * @subpackage themename
 * @since      themename 1.0.0
 */

get_header(); ?>

<section>

	<div class="site-branding">    
		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" 
			rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	</div><!-- .site-branding -->

		<main id="main" class="main main-content">
            
			<?php if ( have_posts() ) { ?>

				<?php
				// Start the loop.
				while ( have_posts() ) :
					the_post();

					if ( is_home() || is_archive() ) {

						get_template_part( 'excerpt' );
						
					} else {
						
						get_template_part( 'content' );
						
					}

				// End the loop.
				endwhile;
				?>

			<div id="postPagination" class="post-navigation">
				<?php
				// Previous/next page navigation.
				the_posts_pagination( ); 
				?>
			</div>

				<?php } else { ?>
				
					<hr>
			
			<?php } ?>

		</main>

</section>

<?php get_footer(); ?>
