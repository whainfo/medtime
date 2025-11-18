<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bootstrap_version = get_theme_mod( 'understrap_bootstrap_version', 'bootstrap4' );
$navbar_type       = get_theme_mod( 'understrap_navbar_type', 'collapse' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">
<!--    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">-->
    <?php

    $theme_color = get_field( 'theme_color', 'option' );
    if ( $theme_color ) {
        $theme_color_rgb_array = vitamed_hex2rgb( $theme_color );
        $theme_color_rgb     =  implode( ',', $theme_color_rgb_array ) ;
        ?>
        <style>
            :root {
                --vm-secondary: <?php echo $theme_color;?>;
                --bs-secondary: <?php echo $theme_color;?>;
                --bs-secondary-rgb: <?php echo $theme_color_rgb;?>;
            }
        </style>
    <?php } ?>
<?php $analytics = get_field( 'analytics', 'option' );?>
    <?php if($analytics){?>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($analytics) ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', '<?php echo esc_attr($analytics) ?>');
        </script>
    <?php } ?>

</head>


<body <?php body_class( 'bg-light' ); ?> <?php understrap_body_attributes(); ?>>
<?php do_action( 'wp_body_open ' ); ?>
<div class="site" id="page">
    <?php
    $address_group          = get_field( 'address', 'option' );
    $address        = $address_group ? $address_group['locality'] .' '. $address_group['street_address'] : '';
    $social  = get_field( 'social', 'option' );
    $phone            = get_field( 'phone', 'option' );
    $working_hours = get_field( 'working_hours', 'option' ) ? get_field( 'working_hours', 'option' ) : '';

    ?>

    <!-- ******************* The Navbar Area ******************* -->
    <header id="wrapper-navbar">
        <a class="skip-link <?php //echo understrap_get_screen_reader_class( true ); ?>" href="#content">
            <?php esc_html_e( 'Skip to content', 'understrap' ); ?>
        </a>
        <?php if ( $address || $working_hours || $social || $phone ) { ?>
            <div class="top-header ">
                <div class="container">
                    <div class="d-flex justify-content-between flex-nowrap">
                        <?php if ( $address || $working_hours ) { ?>
                            <div class="info d-none d-md-block">
                                <div class="d-flex flex-wrap gap-3 me-auto">
                                    <?php if ( $address ) { ?>
                                        <div class=" d-flex gap-2 align-items-center">
                                            <img class="icon" width="20" height="20" role="img"  aria-label="address"
                                                 src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/map.svg"
                                                 alt="<?php echo esc_attr($address)  ?>"
                                                 title="<?php echo esc_attr($address)  ?>"> <?php echo esc_attr($address)  ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ( $working_hours ) { ?>

                                        <div class="me-auto d-flex gap-2 align-items-center">
                                            <img class="icon" width="20" height="20" role="img"  aria-label="Working hours"
                                                 src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/clock.svg"
                                                 alt="Working hours"
                                                 title="Working hours"> <?php get_working_hours( $working_hours, 'text' ) ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ( $social || $phone ) { ?>
                            <div class="socials-wrapper ms-auto d-flex  align-items-center">

                                    <?php if ( $social ) { ?>
                                    <?php   get_social_icons( $social ) ; ?>

                                    <?php } ?>
                                    <?php if ( $phone ) { ?>
                                        <div class="me-auto d-flex gap-1 align-items-center fw-bold">
                                            <img class="icon" width="20" height="20" role="img" aria-label="phone"
                                                 src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/phone.svg"
                                                 alt="Phone"
                                                 title="Phone">
                                            <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo $phone; ?></a>
                                        </div>
                                    <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="container">
            <?php get_template_part( 'global-templates/navbar', 'offcanvas-bootstrap5' ); ?>
        </div>
    </header><!-- #wrapper-navbar -->
