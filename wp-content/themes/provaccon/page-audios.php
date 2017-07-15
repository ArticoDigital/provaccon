<?php

global $wpdb;
$send = false;
if ($_POST['_token'] == '$KJMM99osods$=)/' && is_user_logged_in()) {
    $userId = get_current_user_id();
    $exits = $wpdb->get_results('SELECT count(*) as count FROM pro_usermeta WHERE user_id = ' . $userId .
        ' and meta_key = "date_audio" ', OBJECT);
    if ($exits[0]->count) {
        $sql = "UPDATE pro_usermeta SET meta_value = '" . $_POST['date'] . "' WHERE  meta_key = 'date_audio'";
    } else {
        $sql = "INSERT INTO pro_usermeta (user_id, meta_key,meta_value) 
values ('$userId','date_audio','" . $_POST['date'] . "')";
    };
    $wpdb->query($sql);
}

get_header(); ?>
<div class="Page - content">
    <?php
    $category = get_query_var('cat_audios');
    the_content() ?>
    <?php wp_nav_menu(array('theme_location' => 'menuAudios', 'container' => 'div')) ?>
    <div class="Audios">
        <p><?php echo get_term_by('slug', $category, 'Temario')->description ?></p>

        <?php
        global $current_user;

        $args = [
            'post_type' => 'audios',
            'tax_query' => [
                [
                    'taxonomy' => 'Temario',
                    'field' => 'slug',
                    'terms' => $category,
                ]
            ]
            , 'order' => 'DESC',];
        $query = new WP_Query($args);
        $index = 0;
        if (is_user_logged_in() && ($current_user->allcaps['administrator'] || get_user_meta($current_user->ID, 'status_user_audios', true))) :
            $userId = get_current_user_id();
            $results = $wpdb->get_results('SELECT * FROM pro_usermeta WHERE user_id = ' . $userId .
                ' and meta_key = "date_audio" ', OBJECT);
            ?>

            <p class="note"> ► Ubiquese sobre el audio y arrastre arriba o abajo según el orden que desea reproducir y
                seleccione reproducir todos automaticamente
                .</p>
            <div class="row end middle Play - all">
                <span>Reproducir todos automaticamente</span><input type="checkbox" checked id="AutoPlay">
            </div>
            <form action="" method="post" class="Date-form">
                <label for="date">Seleccione la fecha para que se reproduzca automáticamente.
                    Recuerde que debe tener el navegador con la página abierta.</label>
                <input type="text" id="date" name="date" placeholder="Ingresa la fecha">
                <input type="hidden" name="_token" value="$KJMM99osods$=)/">

                <button type="submit">GUARDAR</button>
                <?php if ($results): ?>
                    <?php
                    $dateArray = explode(' ', $results[0]->meta_value);
                    $one = explode(',', str_replace('/', ',', $dateArray[0]));
                    $two = explode(':', $dateArray[1]);
                    $hour = ($dateArray[2] == 'pm' && $two[0] > '12') ? $two[0] + 12 : $two[0];
                    $dateF = $one[2] . ',' . $one[1] . ',' . $one[0] . ',' . $hour . ',' . $two[1] . ',0';

                    ?>
                    <div data-date="<?php echo $dateF ?>" id="dataDate">
                        Tiene programada la reproducción para <?php echo $results[0]->meta_value ?>
                    </div>
                <?php endif ?>
            </form>
            <section id="sortable">
                <?php
                while ($query->have_posts()) : $query->the_post(); ?>
                    <article class="Audio-content row middle">
                        <div class="col-8 small-16 medium-8"><?php the_title(); ?></div>
                        <div class="col-8 small-16 medium-8"><?php the_content(); ?></div>
                    </article>
                <?php endwhile; ?>
            </section>

            <?php

            $tag = get_term_by('slug', $category, 'Temario');

            $pdf = get_option("taxonomy_" . $tag->term_id)['imagen'];
            if (!empty($pdf)) {
                ?>
                <a style="text-align: center;
    display: block;
    padding: .75rem 2rem;
    color: #D4D0CA;
    margin-top: 1.5rem;
    background: #313332;
    font-size: .9375rem;
    line-height: 1.2;
    font-weight: 400;" href="<?php echo $pdf ?>" target="_blank">Descargue el pdf de evaluación</a>
            <?php };
        else: ?>
            <div class="row center Audio-Forms">
                <p class="col-16 small-16 medium-16">
                    Regístrate para obtener acceso inmediato a este curso completo y muchos otros como éste, además
                    de contenido nuevo cada semana.2
                </p>
                <p><a href=" <?php echo get_site_url() . '/login' ?>">INGRESAR</a></p>
                <p><a href="<?php echo get_site_url() . '/registro' ?>">REGISTRARSE</a></p>
            </div>
            <?php
            while ($query->have_posts()) : $query->the_post(); ?>
                <article class="Audio-content row between  middle" data-index="<?php echo $index;
                $index++ ?>">
                    <div class=""><?php the_title(); ?></div>
                    <div class="">
                        <svg width="20px" height="23px" viewBox="0 0 20 23" version="1.1"
                             xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <path d="M10,0 C6.44959804,0 3.57142857,2.87816947 3.57142857,6.42857143 L3.57142857,10 L2.85714286,10 C1.27918643,10 0,11.2791864 0,12.8571429 L0,20 C0,21.5779564 1.27918643,22.8571429 2.85714286,22.8571429 L17.1428571,22.8571429 C18.7208136,22.8571429 20,21.5779564 20,20 L20,12.8571429 C20,11.2791864 18.7208136,10 17.1428571,10 L16.4285714,10 L16.4285714,6.42857143 C16.4285714,2.87816947 13.550402,0 10,0 Z M12.8571429,10 L7.14285714,10 L7.14285714,6.42857143 C7.14285714,4.850615 8.42204357,3.57142857 10,3.57142857 C11.5779564,3.57142857 12.8571429,4.850615 12.8571429,6.42857143 L12.8571429,10 Z"
                                  id="Shape" stroke="none" fill="#9B9B9B" fill-rule="evenodd"></path>
                        </svg>
                    </div>
                </article>
            <?php endwhile;
        endif;
        ?>
    </div>
</div>
<?php
wp_enqueue_style('style',
    'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css');
?>

<?php get_footer(); ?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php bloginfo('template_url') ?>/assets/js/date.js"></script>


<script>

    $("#sortable").sortable();
    var $v = $('audio');
    $v.on('ended', function () {
        var $next = $(this).parents('article').next().find('audio')[0];
        if ($next && $("#AutoPlay").is(':checked'))
            $next.play();
    });
    if ($("#dataDate").data('date')) {


        var ds = $("#dataDate").data('date').split(','),
            i = new Date(ds[0], ds[1], ds[2], ds[3], ds[4], ds[5]),
            cadi = i.getHours() + ":" + i.getMinutes() + ":" + i.getSeconds();
        var p = new Date()
        cadp = p.getHours() + ":" + p.getMinutes() + ":" + p.getSeconds();
        if (cadi > cadp) {

            var refreshIntervalId = setInterval(
                function () {

                    var f = new Date(),
                        cadf = f.getHours() + ":" + f.getMinutes() + ":" + f.getSeconds();
                    console.log(cadi + " - " + cadf)
                    if (cadi == cadf) {

                        $v[0].play();
                        clearInterval(refreshIntervalId);
                    }
                },
                1000);
        }
    }

    $("#date").datetimepicker({
        timeFormat: "hh:mm tt",
        timeText: 'Tiempo',
        hourText: 'Hora',
        minuteText: 'Minutos',
        secondText: 'Segundos',
        currentText: 'Ahora',
        closeText: 'Cerrar',
        controlType: 'select',

    });
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: '',

    };
    $.datepicker.setDefaults($.datepicker.regional['es']);


</script>

