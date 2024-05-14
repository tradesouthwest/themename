<?php
/**
 * themename Customizer functionality
 *
 * @package:   ClassicPress
 * @subpackage themename
 * @since      themename 1.0.0
 */

/**
 * Page options settings
 */

// A1
add_action( 'wp_enqueue_scripts', 'themename_theme_customizer_css', 15 );  
// A2
add_action( 'customize_register', 'themename_register_theme_customizer_setup' );

/**
 * Text sanitizer for numeric values
 * @since 1.0
 * @see https://themefoundation.com/wordpress-theme-customizer/
 * @return string $input
 */
function themename_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
} 

/** A1
 * CUSTOM FONT OUTPUT, CSS
 * The @font-face rule should be added to the stylesheet before any styles. (priority 2)
 * @uses background-image as linear gradient meerly remove any input background image.
 * @since 1.0.0
*/
function themename_theme_customizer_css($args) {
    
    if( get_theme_mods() ) : 
	$fntfamily = 'sans-serif';
	$maxw      = '1200';	
	$fntfamily = ( empty( get_theme_mod( 'themename_fontfamily' ) ) ) ? esc_attr( $fntfamily )  
			     : wp_strip_all_tags( get_theme_mod( 'themename_fontfamily' ) );
	$maxw      = ( empty( get_theme_mod( 'themename_maxwidth' ) ) ) ? esc_attr( $maxw )
                 : get_theme_mod( 'themename_maxwidth' );        

	/* use above set values into inline styles */
    $cssstyles = 
	'body, button, input, select, textarea, p{ font-family: '. esc_attr( $fntfamily ) .';}
	.page article.page, .single article.post{max-width: '. esc_attr( $maxw ) .'px;margin: 0 auto;}';
    
	wp_register_style( 'themename-inline-customizer', true );
	wp_enqueue_style( 'themename-inline-customizer' );
	wp_add_inline_style( 'themename-inline-customizer', $cssstyles );

	endif;
		return false;
}

/**
 * Add section to the Options menu.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 * @since 1.0.0
*/

function themename_register_theme_customizer_setup($wp_customize)
{
	$transport = ( $wp_customize->selective_refresh ? 'postMessage' : 'refresh' );
    // Theme font choice section
    $wp_customize->add_section( 'themename_general', array(
        'title'       => __( 'themename Theme Settings', 'themename' ),
        'capability'  => 'edit_theme_options',
		'priority'    => 20
    ) );

	//-----------------Settings and Controls -----------

	// Add setting & control for font type
	$wp_customize->add_setting( 
        'themename_fontfamily', array(
		'type'              => 'theme_mod',
		'default'           => 'sans-serif',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'refresh'
	));
	$wp_customize->add_control( 'themename_fontfamily', array(
		'label'   => esc_html__( 'Font for Content', 'themename'),
		'section'  => 'themename_general',
		'settings'  => 'themename_fontfamily',
		'description' => esc_html__( 'Choose the font family type.', 'themename'),
		'type'        => 'select',
    	'choices'     => array(
			'inherit'    => esc_attr__( 'Select font', 'themename' ),
        	'sans-serif' => esc_attr__( 'Sans Serif', 'themename'),
			'serif'      => esc_attr__( 'Serif', 'themename'),
			'Helvetica'  => esc_attr__( 'Helvetica', 'themename'),
			'Arial'      => esc_attr__( 'Arial', 'themename'),
			'monospace'  => esc_attr__( 'Monospace', 'themename'),
        	)
	));

	$wp_customize->add_setting( 
		'themename_maxwidth', array(
		'type'            => 'theme_mod',
		'default'          => '1200',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'          => 'refresh'
	));
	$wp_customize->add_control( 'themename_maxwidth', array(
		'label'   => esc_html__( 'Maximum Width of Content', 'themename'),
		'section'  => 'themename_general',
		'settings'  => 'themename_maxwidth',
		'description' => esc_html__( 'Sets the width of the aricles for pages and posts. (in pixels)', 'themename'),
		'type'         => 'number'
	));

}
