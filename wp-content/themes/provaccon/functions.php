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
function my_jquery_enqueue()
{
    wp_deregister_script('jquery');
    wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js", false, '2.1.3', true);
    wp_enqueue_script('jquery');
    wp_enqueue_script('main', themeDirUri . '/assets/js/main.js', '', '', true);
}

/* remove emoji comments */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
/* Add Menu */
add_action('init', 'register_my_menus');
function register_my_menus()
{
    register_nav_menus(
        array(
            'menuHeader' => __('Menu Header'),
            'menuAudios' => __('Menu Audios'),

        )
    );
}

/* Add Space Search Widget */
add_action('widgets_init', 'widgetFlags');
function widgetFlags()
{
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
function widgetSearchFooter()
{
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
function searchCustom()
{
    $form = '<form role="search" method="get"   action="' . home_url('/') . '" >
    <input type="text" placeholder="Buscar" value="" name="s" >
        <button></button>
    </form>';
    return $form;
}

if (class_exists('kdMultipleFeaturedImages')) {
    $args = array(
        'id' => 'featured-image-2',
        'post_type' => 'page',      // Set this to post or page
        'labels' => array(
            'name' => 'Featured image 2',
            'set' => 'Set featured image 2',
            'remove' => 'Remove featured image 2',
            'use' => 'Use as featured image 2',
        )
    );
    new kdMultipleFeaturedImages($args);
}
//add_theme_support('category-thumbnails');

function wpdocs_custom_excerpt_length($length)
{
    return 20;
}

add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);
function wpdocs_excerpt_more($more)
{
    return sprintf('<a class="read-more" href="%1$s">%2$s</a>',
        get_permalink(get_the_ID()),
        __('Leer más... ', 'textdomain')
    );
}

add_filter('excerpt_more', 'wpdocs_excerpt_more');
/* Widget Contact */
add_action('widgets_init', 'widgetContact');
function widgetContact()
{
    register_sidebar(
        array(
            'id' => 'widgetContact', /* ID unique*/
            'name' => 'widgetContact',
            'description' => 'widget contact',
            'before_widget' => '<div class "Footer">',
            'after_widget' => '</div>',
            'before_title' => '<span>',
            'after_title' => '</span>',
        )
    );
}

function form_certificate($atts)
{
    $html = '';
    if ($_REQUEST['error']) {
        $html .= '<div class="row center Error-certificate"> Cerfificado no existe </div>';
        wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/error.js', array('jquery'), 1.1, true);

    }
    $html .= '<form action="' . get_site_url() . '/certificado' . '" method="GET" class="form_certificate row center">
    <input type="text" name="numero_cerficado" placeholder="numero de cerficado">
    <button>Consultar</button></form>';
    return $html;
}

add_shortcode('CERTIFICATE', 'form_certificate');


add_action('show_user_profile', 'add_user_meta_fields');
add_action('edit_user_profile', 'add_user_meta_fields');
add_action('personal_options_update', 'update_user_meta_fields');
add_action('edit_user_profile_update', 'update_user_meta_fields');

function update_user_meta_fields($user_id)
{
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    update_user_meta($user_id, 'status_user_audios', $_POST['status_user_audios']);
}

function add_query_vars($aVars)
{
    $aVars[] = "cat_audios"; // represents the name of the product category as shown in the URL
    return $aVars;
}

add_filter('query_vars', 'add_query_vars');
function add_rewrite_rules()
{
    add_rewrite_rule('^audios/([^/]*)/?$', 'index.php?pagename=audios&cat_audios=$matches[1]', 'top');
}

add_action('init', 'add_rewrite_rules');

/* Add Recipes */
add_action('init', 'registerAudios');
function registerAudios()
{
    $labels = array(
        'name' => __('Audios'),
        'singular_name' => __('Audios'),
        'add_new' => __('Añadir audio', 'audio'),
        'add_new_item' => __('Añadir nueva audio'),
        'edit_item' => __('Editar audio'),
        'new_item' => __('Nueva audio'),
        'view_item' => __('Ver audio'),
        'search_items' => __('Buscar audio'),
        'not_found' => __('No se han encontrado audio'),
        'not_found_in_trash' => __('No se han encontrado audio en la papelera'),
        'parent_item_colon' => '',
    );
    //  $args
    $args = array('labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'menu_icon'   => 'dashicons-controls-volumeon',
        'supports' => array('title', 'editor', 'author', 'revisions', 'thumbnail', 'excerpt', 'comments', 'custom-fields')
    );
    register_post_type('audios', $args);
}

$labels = array(
    'name' => __('Temario'),
    'singular_name' => __('Temario'),
    'search_items' => __('Buscar Temario'),
    'popular_items' => __('Temario populares'),
    'all_items' => __('Todos los Temario'),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __('Editar Temario'),
    'update_item' => __('Actualizar Temario'),
    'add_new_item' => __('Añadir nuevo Temario'),
    'new_item_name' => __('Nombre del nuevo Temario'),
    'separate_items_with_commas' => __('Separar Temario por comas'),
    'add_or_remove_items' => __('Añadir o eliminar Temario'),
    'choose_from_most_used' => __('Escoger entre los Temario más utilizados')
);
register_taxonomy('Temario', array('audios'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'Temario'),
));

function my_login_redirect( $redirect_to, $request, $user ) {
    //is there a user to check?

    if ( isset( $user->roles ) && is_array( $user->roles ) ) {

        if ( in_array( 'administrator', $user->roles ) ) {
            return home_url();
        } else {
            return home_url();
        }
    } else {
        return $redirect_to;
    }
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );



function add_user_meta_fields($user)
{ ?>


    <table class="form-table">
        <tr>
            <th><label for="mincraftUser">Status</label></th>
            <td>
                <select name="status_user_audios" id="status_user_audios">
                    <option value="0">Desactivado</option>
                    <option value="1"
                        <?php
                        if (esc_attr(get_the_author_meta('status_user_audios', $user->ID)) == 1) {
                            echo "selected";
                        }; ?>>Activado
                    </option>
                </select>
                <span class="description">Seleccione el estado de la suscripción</span>
            </td>
        </tr>
    </table>

<?php }

