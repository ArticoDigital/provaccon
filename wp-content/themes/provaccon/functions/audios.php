<?php

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

/* Add field image category */
add_action( 'Temario_add_form_fields', 'categoria_add_new_meta_fields', 10, 2 );
function categoria_add_new_meta_fields(){

    ?>
    <div>
        <label for="term_meta[imagen]">
            <input type="text" name="term_meta[imagen]" size="36" id="upload_image" value=""><br>
            <input id="upload_image_button" type="button" class='button button-primary' value="Subir PDF" />
            <br/><i>Introduce una URL o establece un PDF de preguntas</i>
        </label>
    </div>

    <?php
}
/* Add field in edit chef  */
function categoria_edit_meta_fields($term){
    $t_id = $term->term_id;
    $term_meta = get_option("taxonomy_$t_id");
    ?>
    <tr valign="top" class='form-field'>
        <th scope="row">Subir PDF</th>
        <td>
            <label for="upload_image">
                <input id="upload_image" type="text" size="36" name="term_meta[imagen]" value="<?php if( esc_attr( $term_meta['imagen'] ) != "") echo esc_attr( $term_meta['imagen'] ) ; ?>" />
                <p><input id="upload_image_button" type="button" class='button button-primary' style='width: 100px' value="Subir PDF" />
                    <i>Introduce una URL o establece un PDF de preguntas.</i></p>
            </label>

        </td>
    </tr>
    <?php

}
add_action( 'Temario_edit_form_fields', 'categoria_edit_meta_fields', 10, 2 );
/* Save edit and create chef */
function categoria_save_custom_meta( $term_id ) {
    if ( isset( $_POST['term_meta'] ) ) {
        $t_id = $term_id;
        $term_meta = get_option( "taxonomy_$t_id" );
        $cat_keys = array_keys( $_POST['term_meta'] );
        foreach ( $cat_keys as $key ) {
            if ( isset ( $_POST['term_meta'][$key] ) ) {
                $term_meta[$key] = $_POST['term_meta'][$key];
            }
        }
        update_option( "taxonomy_$t_id", $term_meta );
    }
}
/* Add script image  */
add_action( 'admin_enqueue_scripts', 'my_enqueue' );
function my_enqueue() {
    wp_enqueue_media();
    wp_enqueue_script( 'my_custom_script', themeDirUri . '/functions/admin.js' );
}
add_action( 'edited_Temario', 'categoria_save_custom_meta', 10, 2 );
add_action( 'create_Temario', 'categoria_save_custom_meta', 10, 2 );
add_action('restrict_manage_posts','restrict_gallery');

function restrict_gallery() {
    global $typenow;
    global $wp_query;

    if ($typenow=='audios') {
        $taxonomy = 'Temario';
        $business_taxonomy = get_taxonomy($taxonomy);

        wp_dropdown_categories(array(
            'show_option_all' =>  __("Ver todas las categorias "),
            'taxonomy'        =>  $taxonomy,
            'name'            =>  'categoria',
            'orderby'         =>  'name',
            'selected'        =>  $wp_query->query['term'],
            'hierarchical'    =>  true,
            'depth'           =>  3,
            'show_count'      =>  true, // Show # listings in parens
            'hide_empty'      =>  true, // Don't show businesses w/o listings
        ));
    }
}
add_filter('parse_query','convert_id_to_taxonomy_term_in_query');
function convert_id_to_taxonomy_term_in_query($query) {
    global $pagenow;
    $qv = &$query->query_vars;
    if ($pagenow=='edit.php' &&  $qv['post_type'] == 'audios' ) {
        $term = get_term_by('id',$qv['temario'],'Temario');
        $qv['Temario'] = $term->slug;
    }
}