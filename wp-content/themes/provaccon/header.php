<!DOCTYPE html>
<html <?php language_attributes(); ?>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> <?php the_title(); ?> </title>

    <meta name="description" content="<?php bloginfo('description'); ?>"/>

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300i,400,500,500i,700,700i,900,900i" rel="stylesheet">
    <link rel="shortcut icon" href="<?php bloginfo('template_url') ?>/assets/img/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Lato:100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/assets/css/main.min.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/assets/css/owl.carousel.css">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-urlBody="<?php bloginfo('url') ?>">
<header class="Header <?php if (is_front_page()) echo 'Header-index' ?>">
    <div class="Header-bar">
        <div class="Header-barContent row">
            <figure class="Header-logo col-2">
                <img src="<?php bloginfo('template_url') ?>/assets/img/logo.png" alt="">
            </figure>
            <div class="content-menu center col-14">
                <?php wp_nav_menu(array('theme_location' => 'menuHeader', 'container' => 'nav')) ?>
            </div>
        </div>
    </div>
    <?php if (is_front_page()): ?>
        <div id="owl-carousel">
            <?php $my_query = new WP_Query('category_name=slide-header-home &showposts=10'); ?>
            <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <section class="Header-slide"
                         style="background-image: url( <?php echo get_the_post_thumbnail_url(); ?> );">
                    <?php the_content() ?>

                </section>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </div>
    <?php else: ?>
        <section class="Header-banner">
            <?php while (have_posts()) : the_post(); ?>
                <figure class="row center bottom"
                        style="background-image: url( <?php echo get_the_post_thumbnail_url(); ?> );">
                    <div class="Header-bannerTitle col-16">
                        <h1><?php the_title() ?></h1>
                    </div>
                </figure>
                <?php
            endwhile;
            wp_reset_query();
            ?>
        </section>
    <?php endif; ?>
</header>


<main>
