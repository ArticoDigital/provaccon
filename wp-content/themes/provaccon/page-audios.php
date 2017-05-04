<?php get_header(); ?>
<div class="Page-content">
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
            ?>
            <p class="note"> ► Ubiquese sobre el audio y arrastre arriba o abajo según el orden que desea reproducir y seleccione reproducir todos automaticamente
                .</p>
            <div class="row end middle Play-all">
                <span>Reproducir todos automaticamente</span><input type="checkbox" checked id="AutoPlay">
            </div>
            <section id="sortable">
                <?php
                while ($query->have_posts()) : $query->the_post(); ?>
                    <article class="Audio-content row middle">
                        <div class="col-8 small-16 medium-8"><?php the_title(); ?></div>
                        <div class="col-8 small-16 medium-8"><?php the_content(); ?></div>
                    </article>
                <?php endwhile; ?>
            </section>
        <?php else: ?>
            <div class="row center Audio-Forms">
                <p class="col-16 small-16 medium-16">
                    Regístrate para obtener acceso inmediato a este curso completo y muchos otros como éste, además
                    de contenido nuevo cada semana.2
                </p>
                <p><a href="<?php echo get_site_url() . '/login' ?>">INGRESAR</a></p>
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


<?php get_footer(); ?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>

    $("#sortable").sortable();
    var $v = $('audio');
    $v.on('ended', function () {
        var $next = $(this).parents('article').next().find('audio')[0];
        if ( $next && $("#AutoPlay").is(':checked'))
            $next.play();
    });

</script>

