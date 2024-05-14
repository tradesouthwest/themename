<?php
/**
 * The template part for displaying content
 *
 * @package    ClassicPress
 * @subpackage Themename
 * @since      Themename 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="content-title">
    <?php 
    the_title(
        sprintf( '<h2 class="article-title h4"><a href="%s" rel="bookmark">', 
        esc_attr( esc_url( get_permalink() ) ) 
        ),
        '</a></h2>'
    ); ?>
	</header>
	<div class="entry-content">
		<?php 
		the_excerpt(); 
		?>
	</div><!-- .entry-content -->
    <div class="after-entry">

        <?php //do_action( 'themename_after_entry' ); ?>
        
    </div>
</article><!-- #post-## -->
