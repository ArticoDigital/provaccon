<?php
/*
Description: WP Functions - Theme init
Theme: After Party Bogotá
*/
//add image in posts
add_theme_support('post-thumbnails');
define('themeDir', get_template_directory() . '/');
define('themeDirUri', get_template_directory_uri());
/* Jquery + Main */
add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js", false, '2.1.3' , true);
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'main', themeDirUri . '/assets/js/main.js', '', '', true );
}
/* remove emoji comments */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
/* Add Menu */
add_action('init', 'register_my_menus');
function register_my_menus()
{
    register_nav_menus(
        array(
            'menuHeader' => __('Menu Header'),
            'menuFooter' => __('Menu Footer'),
            'menuEstrategia' => __('Menu Estrategia'),
            'menuServiciosIT' => __('Menu Servicios IT'),
            'menuServiciosProfesionales' => __('Menu Servicios Profesionales'),
        )
    );
}
/* Add Space Search Widget */
add_action('widgets_init', 'widgetFlags');
function widgetFlags(){
    register_sidebar(
        array(
            'id' => 'widgetFlags', /* ID unique*/
            'name' => 'widgetFlags',
            'description' => 'widget',
            'before_widget' => '<ul class "Flags">',
            'after_widget' => '</div>',
            'before_title' => '<strong>',
            'after_title' => '</strong>',
        )
    );
}
/* Add Space Search Widget */
add_action('widgets_init', 'widgetSearchFooter');
function widgetSearchFooter(){
    register_sidebar(
        array(
            'id' => 'widgetSearch', /* ID unique*/
            'name' => 'widgetSearch',
            'description' => 'widget',
            'before_widget' => '<div class "SearchFooter">',
            'after_widget' => '</div>',
            'before_title' => '<strong>',
            'after_title' => '</strong>',
        )
    );
}
/* Add Custom Search */
add_filter('get_search_form', 'searchCustom');
function searchCustom() {
    $form = '<form role="search" method="get"   action="' . home_url( '/' ) . '" >
    <input type="text" placeholder="Buscar" value="" name="s" >
        <button></button>
    </form>';
    return $form;
}
if( class_exists( 'kdMultipleFeaturedImages' ) ) {
    $args = array(
        'id' => 'featured-image-2',
        'post_type' => 'page',      // Set this to post or page
        'labels' => array(
            'name'      => 'Featured image 2',
            'set'       => 'Set featured image 2',
            'remove'    => 'Remove featured image 2',
            'use'       => 'Use as featured image 2',
        )
    );
    new kdMultipleFeaturedImages( $args );
}
//add_theme_support('category-thumbnails');
add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup()
{
    load_theme_textdomain('luker', get_template_directory() . '/languages');
}
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );
function wpdocs_excerpt_more( $more ) {
    return sprintf( '<a class="read-more" href="%1$s">%2$s</a>',
        get_permalink( get_the_ID() ),
        __( 'Leer más... ', 'textdomain' )
    );
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );