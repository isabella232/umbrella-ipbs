<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,400italic,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" a href="<?php bloginfo('template_directory') ?>/assets/css/stylesheet.css">
    <link rel="stylesheet" a href="<?php bloginfo('template_directory') ?>/assets/css/owl.carousel.css">
    <?php wp_head(); ?>

    <title>IPBS</title>
</head>
<body>
<div class="wrapper">

    <!--begin header-->

    <div class="header">
        <ul class="bg_slider">
            <li>
            </li>
            <li>
            </li>
            <li>
            </li>
            <li>
            </li>
        </ul>

        <a href="<?php echo home_url(); ?>"><div class="ipbslogo">
                <img class="ipbsimg" src="<?php bloginfo('template_directory') ?>/assets/images/ipbs_colorlogo.svg">
                <p>
                    INDIANA<br>
                    PUBLIC<br>
                    BROADCASTING<br>
                    STATIONS
                </p>
            </div>
        </a>
        <div class="login">
            IPBS Member Log In
        </div>
        <div class="ipbscenter">
            <a href="<?php echo home_url(); ?>"">
                <h2>IPBS</h2>
                <h3>INDIANA PUBLIC BROADCASTING STATIONS</h3>
            </a>
        </div>
    </div>

    <!--end header-->

    <!--begin menu--->

    <?php

        $args = array(
            'menu'=>'Main Menu',
            'container_class'=>'mainmenu'
        );

        wp_nav_menu($args);
    ?>

