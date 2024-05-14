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
		<h2><?php the_title(); ?></h2>
		<figure class="linked-attachment-container">
		<a class="imgwrap-link"
		href ="<?php echo esc_url( get_attachment_link( get_post_thumbnail_id() ) ); ?>" 
		title="<?php the_title_attribute( 'before=Permalink to: &after=' ); ?>">
		<?php 
		the_post_thumbnail( 'medium_large', array( 
				'itemprop' => 'image', 
				'class'  => 'themename-featured',
				'alt'  => get_attachment_link( get_post_thumbnail_id() )
			) 
		); ?></a>
		</figure>
	</header>
	<div class="entry-content">
		
		<?php the_content(); ?>
		
		<div class="link-pages">
			<?php wp_link_pages(); ?>
		</div>

	</div><!-- .entry-content -->

	<div class="article-info">

		<div class="post-footer">
			<p><i class="ic-calendar-day"></i><span class="post_footer-date">
			<?php printf( esc_attr( get_the_date() ) ); ?></span>
			<i class="ic-category-folder"></i><span><?php the_category( ' &bull; ' ); ?></span>
			<i class="ic-tags-list"></i><span><?php the_tags('<em class="tags">', ' ', '</em>'); ?></span></p>
		</div>

	</div>

</article><!-- #post-## -->
