<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package    ClassicPress
 * @subpackage themename
 * @since      themename 1.0.0
 */
?>
<div class="sidebar-widget-section">
				
    <?php if ( is_active_sidebar( 'sidebar-primary' ) ) : ?>

	<aside id="secondary" class="sidebar widget-area" role="complementary">
		
		<?php dynamic_sidebar( 'sidebar-primary' ); ?>

	</aside><!-- .sidebar .widget-area -->
    
	<?php endif; ?>

</div>
