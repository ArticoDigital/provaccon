<?php

/* Add field image category */
add_action( 'categoria_add_form_fields', 'categoria_add_new_meta_fields', 10, 2 );
function categoria_add_new_meta_fields(){
    ?>
    <div>
        <label for="term_meta[imagen]">
            <input type="text" name="term_meta[imagen]" size="36" id="upload_image" value=""><br>
            <input id="upload_image_button" type="button" class='button button-primary' value="Subir PDF" />
            <br/><i>Introduce una URL o establece un PDF de preguntas</i>
        </label>
    </div>
    print_r('erm_meta[imagen]');exit;
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
            <p><?php if( esc_attr( $term_meta['imagen'] ) != "" ) echo "<table><tr><td><i><strong>PDF actual</strong></i>:</td><td> <img src='".esc_attr( $term_meta['imagen'] )."'></td></tr></table>"; ?></p>
        </td>
    </tr>
    <?php
}
add_action( 'categoria_edit_form_fields', 'categoria_edit_meta_fields', 10, 2 );
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
add_action( 'edited_categoria', 'categoria_save_custom_meta', 10, 2 );
add_action( 'create_categoria', 'categoria_save_custom_meta', 10, 2 );
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