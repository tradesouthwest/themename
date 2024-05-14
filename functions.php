<?php
/**
 * Themename functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package themename
 * @since   1.0.0
 */

/**
 * ******************************************************************
 * INFO: This ClassicPress version based on WordPress Twenty_Sixteen. 
 * CMS required: "wp_body_open" action or function call not inserted.
 * ******************************************************************
 * @since 1.0.0
 */

// FAST LOADER References ( find #id in DocBlocks )
// ------------------------- Actions ---------------------------
// A1
add_action( 'after_setup_theme',  'themename_theme_setup' );
// A2
add_action( 'after_setup_theme',  'themename_theme_content_width', 0 );
// A3
add_action( 'wp_enqueue_scripts', 'themename_theme_enqueue_styles' );
// A4
add_action( 'widgets_init',       'themename_theme_widgets_init' );
// ------------------------- Filters -----------------------------
// F1 
add_filter( 'body_class',            'themename_theme_body_classes' );

/** #A1
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own themename_setup() function to override in a child theme.
 *
 * @since themename 1.0
 */
if ( ! function_exists( 'themename_theme_setup' ) ) :

function themename_theme_setup() {
	    /*
		 * Make theme available for translation.
		 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
		 * If you're building a theme based on themename, use a find and replace
		 * to change 'themename' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'themename', 
			get_template_directory_uri() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let ClassicPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		
		/*
		 * Enable support for custom logo.
		 *
		 *  @since themename 1.2
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 140,
				'width'       => 140,
				'flex-height' => true,
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		//add_theme_support( 'post-thumbnails' );
		//set_post_thumbnail_size( 1200, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'themename' ),
			)
		);
}
endif;

/** #A2
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since themename 1.0
 */
function themename_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 
		'themename_theme_content_width', 840 );
}

/**
 * Add backwards compatibility support for wp_body_open function.
 */
if ( ! function_exists( 'wp_body_open' ) ) {
    
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/** #A3
 * Enqueues scripts and styles.
 *
 * @since themename 1.0
 */
function themename_theme_enqueue_styles() {
	wp_enqueue_style( 
		'themename-style', 
		get_stylesheet_uri() 
	);
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 
			'comment-reply' 
		);
	}
}

/** #A4
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since themename 1.0
 */
function themename_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Primary Sidebar', 'themename' ),
			'id'            => 'sidebar-primary',
			'description'   => __( 'Appears in section', 'themename' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

/** #F1
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function themename_theme_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}
	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-primary' ) ) {
		$classes[] = 'no-sidebar';
	}
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}

/**
 * Text sanitizer for outputs
 * @since 1.0.5
 * 
 * @return string $input
 */
function themename_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/theme-admin-menu.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';
