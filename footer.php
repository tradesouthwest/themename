<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package:   ClassicPress
 * @subpackage themename
 * @since      themename 1.0.0
 */
?>
<footer id="colophon" class="site-footer" role="contentinfo">
	
	<div class="site-info">
		<p><span class="foot-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" 
			rel="home"><?php bloginfo( 'name' ); ?></a></span>
		<?php
		if ( function_exists( 'the_privacy_policy_link' ) ) {
			the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
		}
		?>
		<a class="classicpress-credit" href="<?php echo esc_url( __( 'https://www.classicpress.net/', 'themename' ) ); ?>" class="imprint">
		<?php
		printf( esc_attr__( 'Proudly powered by %s', 'themename' ), 'ClassicPress' );
		?></a></p>
	</div><!-- .site-info -->

</footer><!-- .site-footer -->

<?php wp_footer(); ?>
</body>
</html>
