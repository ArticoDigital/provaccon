<?php get_header(); ?>

    <section class="row center Products">
<<<<<<< HEAD
        <h2 class="col-12  small-16">NUESTROS PRODUCTOS</h2>
        <ul class="row col-16  small-16">
            <?php $my_query = new WP_Query('category_name=productos-inicio &showposts=10');
            while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <li class="col-4 small-16">
=======
        <h2 class="col-12">NUESTROS PRODUCTOS</h2>
        <ul class="row col-16">
            <?php $my_query = new WP_Query('category_name=productos-inicio &showposts=10');
            while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <li class="col-4">
>>>>>>> 02c6572d88e0ee0a1815771c5708ce5c28ea0247
                    <?php the_post_thumbnail('medium'); ?>
                    <h3><?php the_title() ?></h3>
                    <?php the_content() ?>
                </li>
            <?php endwhile;
            wp_reset_postdata(); ?>

        </ul>
    </section>
    <section class="Clients">
<<<<<<< HEAD
        <h2 class="col-12  small-16">NUESTROS CLIENTES</h2>
=======
        <h2 class="col-12">NUESTROS CLIENTES</h2>
>>>>>>> 02c6572d88e0ee0a1815771c5708ce5c28ea0247
        <div class="Clients-content">
            <ul id="ClientsOwl">
                <?php $my_query = new WP_Query('category_name=clientes-inicio &showposts=20'); ?>
                <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <li>
                        <figure>
                            <?php the_post_thumbnail(); ?>
                        </figure>
                    </li>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </ul>
        </div>
    </section>
<?php get_footer(); ?>