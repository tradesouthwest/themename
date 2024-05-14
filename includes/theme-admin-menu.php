<?php
/**
 * Theme Support Page in admin view
 * If you prefer a class to autoload try: https://www.wpexplorer.com/wordpress-theme-options/#admin-panel-class
 * 
 * @package:   ClassicPress
 * @subpackage themename
 * @since      themename 1.0.0
 */
add_action('admin_menu', 'themename_create_theme_options_page');
add_action('admin_init', 'themename_register_and_build_fields');

/**
 * Add theme menu
 *
 * @since 1.0.0
 * @uses add_theme_page()
 * $page_title, $menu_title, $capability, $menu_slug, $function
 */
function themename_create_theme_options_page() {
   add_theme_page( esc_html__( 'Theme Help', 'themename' ), 
                  esc_html__( 'Theme Help', 'themename' ), 
                  'administrator', 
                  __FILE__, 
                  'themename_options_page_fn'
                );
}

/**
 * Register our settings.
 */
function themename_register_and_build_fields() {
   register_setting('themename_theme_info', 'themename_theme_info', 'validate_setting');

   add_settings_section('main_section', 
                        'Main Settings', 'themename_section_cb', __FILE__);
   add_settings_field('themename_ad_one', esc_html__( 'Basic Info', 'themename' ),
                      'themename_ad_setting_one', __FILE__, 
                      'main_section');
   add_settings_field('themename_ad_two', esc_html__( 'Customizer Link', 'themename' ), 
                      'themename_ad_setting_two', __FILE__, 
                      'main_section'); 
}

/**
 * Sanitize fields before adding to the database.
 */
function themename_options_sanitize_fields( $value ) {
    $value = (array) $value;
    if ( ! empty( $value['themename_option_1'] ) ) {
        $value['themename_option_1'] = sanitize_text_field( $value['themename_option_1'] );
    }
    return $value;
}

/**
 * If you want to apply the same sanitization to every option in the options group (your fields will be saved as an array) you can instead do something like this
 * Sanitize fields before adding to the database.
 */
function themename_options_sanitize_array_fields( $value ) {
    return array_map( 'sanitize_text_field', $value );
}

/**
 *  Helper function for returning theme options. 
 *
 * @usage: $option_value = myprefix_get_option( 'my_option_1', 'default value' );
 */
/*
function myprefix_get_option( $option_name = '', $default = '' ) {
  return get_option( 'my_options' )['my_option_1'] ?? $default;
}
*/

/**
 * The "My Options" page html.
 */
function themename_options_page_fn() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }
?>
    <div id="theme-options-wrap" class="wrap widefat">
        <div class="icon32" id="icon-tools"></div>

          <h2><?php esc_html_e( 'Theme Name Theme Guide', 'themename' ); ?></h2>
          <p><?php esc_html_e( 'General Help', 'themename' ); ?></p>

        <form method="post" action="options.php" enctype="multipart/form-data">

          <?php settings_fields('themename_theme_info'); ?>
          <?php do_settings_sections(__FILE__); ?>
        
        </form>
    <style id="themename-options-css">
    #theme-options-wrap {
        width: 93%;
        padding: 3em;
        background: #fafeff;   
        border-top: 1px solid white;}
    #theme-options-wrap #icon-tools {
        position: relative;
        top: -10px;}	
    #theme-options-wrap input, #theme-options-wrap textarea {
        padding: .7em;}
    #theme-options-wrap em{color:#646464}</style>
</div>
<?php
}

// Ad one
function themename_ad_setting_two() {
   echo '<a class="button secondary" href="' . esc_url( admin_url( '/' ) . 'customize.php') .'" 
        title="' . esc_attr__( 'Customize Theme Here', 'themename' ) . '">'
        . esc_html__( 'Customize Theme Here', 'themename' ) . '</a>';
}

// Ad two
function themename_ad_setting_one() {
    echo '<h5>'. esc_html__( 'Theme Options Include:', 'themename' ) . '</h4>
    <hr><pre>'. esc_attr__('
    - Font for Content
      Choose the font family type.
    - Set maximum width of articles.
    - Add page background image
      ', 'themename' ) .'</pre>';
    echo '<h5>' . esc_html__( 'For Call To Action Widget try: (copy/paste into widget)', 'themename' ) . '</h5>';
    echo '<hr><p>';
    echo '&lt;p>&lt;a class="button primary" href="#main" title="go to content">View Our Program&lt;/a>&lt;/p>';
    echo '</p>';
    echo '<p><em>' . esc_html__( 'Use the Custom HTML type of widget to', 'themename') . '</em></p>';
    echo '<h5>' . esc_html__( 'To remove this part from pages, add this to the Customizer > Additional CSS section:', 'themename' )
          . '</h5><hr><pre>'. esc_attr('
          .themename-recent-posts{ display: none; }') . '</pre>';
}

// @since 1.0.0 
function themename_section_cb() {
    echo esc_html__( 'Produced by ', 'themename' ) 
    . '<a href="'. esc_url("https://tradesouthwest.com/").'" title="TradeSouthWest" target="_blank">TradeSouthWest</a>.';
    echo '<figure><img src="'. esc_url( get_template_directory_uri( ) . '/includes/TSWlogo.png' ) .'" alt="TSW" height="90"/></figure>';
}
