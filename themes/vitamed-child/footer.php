<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$subscription        = get_field( 'subscription', 'option' );
$info                = get_field( 'info', 'option' );
$has_menu            = has_nav_menu( 'primary' );
$working_hours       = get_field( 'working_hours', 'option' ) ? get_field( 'working_hours', 'option' ) : '';
$phone               = get_field( 'phone', 'option' ) ? get_field( 'phone', 'option' ) : '';
$email               = get_field( 'email', 'option' ) ? get_field( 'email', 'option' ) : '';
$colophon            = get_field( 'colophon', 'option' );
$indicator_gallery   = $info['indicator_gallery'];
$indicator_title     = $info['indicator_title'];
$indicator_sub_title = $info['indicator_sub_title'];
?>

<div class="modal fade" id="iframeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title"></div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ratio ratio-16x9 bg-dark">
                    <iframe width="640" height="360" src="" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen=""></iframe>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-header border-0">
                <div class="modal-title" ></div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <?php get_short_form('footer') ?>
            </div>

        </div>
    </div>
</div>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<footer class="wrapper bg-dark" id="wrapper-footer">

    <div class="container">
        <?php if ( $subscription ) { ?>
            <div class="row gy-4 subscription-wrapper aligne-items-center justify-content-between">

                <div class="col-lg-6">
                    <?php if ( $subscription_title = $subscription['title'] ) { ?>
                        <h2 class="footer-title text-center text-white text-md-start mb-2"><?php echo esc_html( $subscription_title ); ?></h2>

                    <?php } ?>
                    <?php if ( $subscription_text = $subscription['text'] ) { ?>
                        <div class="content text-center text-md-start  "><?php echo esc_html( $subscription_text ); ?></div>
                    <?php } ?>
                </div>


                <?php if ( $subscription_form = $subscription['shortcode'] ) { ?>
                    <div class="col-lg-6 align-self-center">
                        <div class="form-wrapper">
                            <?php echo do_shortcode( $subscription_form ); ?>
                        </div>
                    </div>

                <?php } ?>

            </div>
        <?php } ?>

        <?php if ( $has_menu || $working_hours || $phone || $email || $info ) { ?>
            <div class="row info-wrapper gy-4">
                <div class="col-lg-4">
                    <?php if ( $logo_id = $info['logo'] ) { ?>
                        <div class="footer-logo text-center text-md-start mb-4">
                            <?php echo wp_get_attachment_image( $logo_id, 'full' ); ?>
                        </div>
                    <?php } ?>
                    <?php if ( $info_text = $info['text'] ) { ?>
                        <div class="footer-title  text-center text-md-start mb-4"><?php echo esc_html( $info_text ); ?></div>
                    <?php } ?>
                    <?php if ( $indicator_gallery || $indicator_title || $indicator_sub_title ) { ?>
                        <div class="d-flex gap-2 align-items-center">
                            <?php if ( $indicator_gallery ) { ?>
                                <div class="indicator-gallery">
                                    <div class="images d-flex">
                                        <?php foreach ( $indicator_gallery as $id ): ?>
                                            <figure class="position-relative mb-0">
                                                <?php echo wp_get_attachment_image( $id, array( 200, 200 ) ); ?>
                                            </figure>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ( $indicator_title || $indicator_sub_title ) { ?>
                                <div class="indicator-info">
                                    <?php if ( $indicator_title ) { ?>
                                        <div class="indicator-title text-white fw-bold">
                                            <?php echo esc_html( $indicator_title ); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ( $indicator_sub_title ) { ?>
                                        <div class="indicator-sub_title ">
                                            <?php echo esc_html( $indicator_sub_title ); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <?php if ( $has_menu || $working_hours || $phone || $email ) { ?>
                    <div class="col-lg-6 mx-auto ">
                        <div class="grid-info">

                            <?php if ( $has_menu ) { ?>
                                <div class="">
                                    <div class="footer-title lh-1 mb-3"><?php esc_html_e( 'Меню', 'vitamed' ); ?></div>
                                    <nav class="footer-menu ">
                                        <?php
                                        wp_nav_menu(
                                                array(
                                                        'theme_location' => 'primary',
                                                        'container'      => '',
                                                        'menu_class'     => 'nav flex-column ',
                                                        'depth'          => 1,
                                                )
                                        );
                                        ?>
                                    </nav>
                                </div><!-- col -->
                            <?php } ?>
                            <?php if ( $working_hours ) { ?>
                                <div class="">
                                    <div class="footer-title lh-1 mb-3"><?php esc_html_e( 'Робочі години', 'vitamed' ); ?></div>
                                    <?php get_working_hours( $working_hours, 'footer' ) ?>
                                </div><!-- col -->
                            <?php } ?>

                            <?php if ( $phone || $email ) { ?>
                                <div class="">
                                    <div class="footer-title lh-1 mb-3"><?php esc_html_e( 'Контакти', 'vitamed' ); ?></div>
                                    <div class="text-white mb-3">
                                        <?php if ( $phone ) { ?>
                                            <div class=""><a href="tel:<?php echo esc_attr($phone); ?>"><?php echo $phone; ?></a></div>
                                        <?php } ?>
                                        <?php if ( $email ) { ?>
                                            <div class=""><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo $email; ?></a></div>
                                        <?php } ?>
                                    </div>
                                </div><!-- col -->
                            <?php } ?>
                        </div>

                    </div>

                <?php } ?>

            </div><!-- .row -->
        <?php } ?>


        <?php if ( $colophon ) { ?>
            <div class="row colophon-wrapper">
                <?php if ( $theme_author = $colophon['theme_author'] ) { ?>
                    <div class="col-md-6">
                        <div class="colophon text-center  text-md-start">
                            <?php echo $theme_author; ?>
                        </div>
                    </div><!-- col -->
                    <?php //if ( $site_info = $colophon['site_info'] ) { ?>
                        <div class="col-md-6">
                            <div class="colophon text-center text-md-end">
                                <nav class="footer-menu ">
                                    <?php
                                    wp_nav_menu(
                                            array(
                                                    'theme_location' => 'colophon',
                                                    'container'      => '',
                                                    'menu_class'     => 'nav justify-content-center justify-content-md-end',
                                                    'depth'          => 1,
                                            )
                                    );
                                    ?>
                                </nav>
                            </div>
                        </div><!-- col -->

                    <?php //} ?>
                <?php } ?>


            </div><!-- .row -->
        <?php } ?>


    </div><!-- .container(-fluid) -->

</footer><!-- #wrapper-footer -->


<?php // Closing div#page from header.php. ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>

