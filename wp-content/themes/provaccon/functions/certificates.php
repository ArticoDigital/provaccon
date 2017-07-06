<?php

add_action('add_meta_boxes', 'cd_meta_box_add');
function cd_meta_box_add()
{
    add_meta_box('certificate-box-id', 'Información certificados', 'cd_meta_box_cb', 'post', 'normal', 'high');
}

function cd_meta_box_cb($post)
{
    global $post;
    $values = get_post_custom($post->ID);
    $name_certificate = isset($values['name_certificate']) ? $values['name_certificate'] : '';
    $number_certificate = isset($values['number_certificate']) ? $values['number_certificate'] : '';
    $address_certificate = isset($values['address_certificate']) ? $values['address_certificate'] : '';
    $town_certificate = isset($values['town_certificate']) ? $values['town_certificate'] : '';
    $tel_certificate = isset($values['tel_certificate']) ? $values['tel_certificate'] : '';
    $email_certificate = isset($values['email_certificate']) ? $values['email_certificate '] : '';
    $anchorage_certificate = isset($values['anchorage_certificate']) ? $values['anchorage_certificate'] : '';
    $location_certificate = isset($values['location_certificate']) ? $values['location_certificate'] : '';
    $specification_certificate = isset($values['specification_certificate']) ? $values['specification_certificate'] : '';
    $anchorage_number_certificate = isset($values['anchorage_number_certificate ']) ? $values['anchorage_number_certificate '] : '';
    $reading_ini_certificate = isset($values['reading_ini_certificate']) ? $values['reading_ini_certificate'] : '';
    $reading_end_certificate = isset($values['reading_end_certificate']) ? $values['reading_end_certificate'] : '';
    $time_certificate = isset($values['time_certificate']) ? $values['time_certificate'] : '';
    $result_certificate = isset($values['result_certificate']) ? $values['result_certificate'] : '';
    $approved_certificate= isset($values['approved_certificate']) ? $values['approved_certificate'] : '';
    $date_certificate= isset($values['date_certificate']) ? $values['date_certificat'] : '';
    $expiration_certificate= isset($values['date_certificate']) ? $values['date_certificate'] : '';
    $note_certificate= isset($values['note_certificate']) ? $values['note_certificate'] : '';


    /*$selected = isset( $values['my_meta_box_select'] ) ? esc_attr( $values['my_meta_box_select'] ) : '';
    $check = isset( $values['my_meta_box_check'] ) ? esc_attr( $values['my_meta_box_check'] ) : '';*/

    // We'll use this nonce field later on when saving.
    wp_nonce_field('my_meta_box_nonce', 'meta_box_nonce');
    ?>
    <h2 style="padding: 0; font-weight: bold; margin-top: 20px">INFORMACIÓN GENERAL DEL SOLICITANTE</h2>
    <hr>
    <p>
        <label for="name_certificate">NOMBRE O RAZÓN SOCIAL:</label>
        <input type="text" name="name_certificate" id="name_certificate" value="<?php echo $name_certificate; ?>"/>
    </p>
    <p>
        <label for="number_certificate">NÚMERO DE IDENTIFICACIÓN O NIT:</label>
        <input type="text" name="number_certificate" id="number_certificate"
               value="<?php echo $number_certificate; ?>"/>
    </p>
    <p>
        <label for="address_certificate">DIRECCIÓN:</label>
        <input type="text" name="address_certificate" id="address_certificate"
               value="<?php echo $address_certificate; ?>"/>

        <label for="town_certificate">MUNICIPIO:</label>
        <input type="text" name="town_certificate" id="town_certificate" value="<?php echo $town_certificate; ?>"/>
    </p>
    <p>
        <label for="tel_certificate">TELÉFONO:</label>
        <input type="text" name="tel_certificate" id="tel_certificate" value="<?php echo $tel_certificate; ?>"/>

        <label for="email_certificate">E-MAIL:</label>
        <input type="text" name="email_certificate" id="email_certificate" value="<?php echo $email_certificate; ?>"/>
    </p>
    <h2 style="padding: 0; font-weight: bold; margin-top: 20px">INFORMACIÓN DEL ANCLAJE</h2>
    <hr>
    <p>
        <label for="anchorage_certificate">TIPO DE ANCLAJE:</label>
        <input type="text" name="anchorage_certificate" id="anchorage_certificate"
               value="<?php echo $anchorage_certificate; ?>"/>
        <label for="location_certificate">UBICACIÓN:</label>
        <textarea name="location_certificate" id="location_certificate"><?php echo $location_certificate; ?></textarea>
        <label for="specification_certificate">ESPECIFICACIÓN:</label>
        <textarea name="specification_certificate" id="specification_certificate"><?php echo $specification_certificate; ?></textarea>
    </p>
    <h2 style="padding: 0; font-weight: bold; margin-top: 20px">RESULTADO DE LA PRUEBA SOBRE EL ANCLAJE:</h2>
    <hr>
    <p>
        <label for="anchorage_number_certificate">ANCLAJE N°</label>
        <input type="text" name="anchorage_number_certificate" id="anchorage_number_certificate"
               value="<?php echo $anchorage_number_certificate; ?>"/>
        <label for="reading_ini_certificate">Lectura Inicial:</label>
        <input type="text" name="reading_ini_certificate" id="reading_ini_certificate"
               value="<?php echo $reading_ini_certificate; ?>"/>
        <label for="reading_end_certificate">Lectura Final:</label>
        <input type="text" name="reading_end_certificate" id="reading_end_certificate"
               value="<?php echo $reading_end_certificate; ?>"/>
        <label for="time_certificate">Tiempo:</label>
        <input type="text" name="time_certificate" id="time_certificate"
               value="<?php echo $time_certificate; ?>"/>
        <label for="result_certificate">Resultado:</label>
        <input type="text" name="result_certificate" id="result_certificate"
               value="<?php echo $result_certificate; ?>"/>
    </p>
    <p>
        <label for="approved_certificate">ANCLAJE APROBADO:</label>
        <textarea name="approved_certificate" id="approved_certificate"><?php echo $approved_certificate; ?></textarea>
    </p>
    <p>
        <label for="date_certificate">Fecha de Certificación: :</label>
        <input type="text" name="date_certificate" id="date_certificate"
               value="<?php echo $date_certificate; ?>"/>
        <label for="expiration_certificate">Fecha de Expiración:</label>
        <input type="text" name="expiration_certificate" id="expiration_certificate"
               value="<?php echo $expiration_certificate; ?>"/>
    </p>

    <p>
        <label for="note_certificate">Nota:</label>
        <textarea name="note_certificate" id="note_certificate"><?php echo $note_certificate; ?></textarea>
    </p>
    <!--<p>
        <label for="my_meta_box_select">Color</label>
        <select name="my_meta_box_select" id="my_meta_box_select">
            <option value="red" <?php /*selected($selected, 'red'); */
    ?>>Red</option>
            <option value="blue" <?php /*selected($selected, 'blue'); */
    ?>>Blue</option>
        </select>
    </p>-->
    <?php
}