<?php
/**
 * Header Navbar (bootstrap5)
 *
 * @package Understrap
 * @since 1.1.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>

<nav id="main-nav" class="navbar navbar-expand-lg rounded-5 bg-white" aria-labelledby="main-nav-label">

    <div id="main-nav-label" class="screen-reader-text">
        <?php esc_html_e( 'Main Navigation', 'understrap' ); ?>
    </div>


    <div class="d-flex justify-content-between align-items-center w-100">

        <!-- Your site branding in the menu -->
        <?php get_template_part( 'global-templates/navbar-branding' ); ?>

        <button
                class="navbar-toggler ms-auto mx-3"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#navbarNavOffcanvas"
                aria-controls="navbarNavOffcanvas"
                aria-expanded="false"
                aria-label="<?php esc_attr_e( 'Open menu', 'understrap' ); ?>"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end " tabindex="-1" id="navbarNavOffcanvas">

            <div class="offcanvas-header justify-content-end">
                <button
                        class="btn-close  text-reset "
                        type="button"
                        data-bs-dismiss="offcanvas"
                        aria-label="<?php esc_attr_e( 'Close menu', 'understrap' ); ?>"
                ></button>
            </div><!-- .offcancas-header -->

            <!-- The WordPress Menu goes here -->
            <div class="offcanvas-body d-flex flex-column justify-content-between">
                <?php
                wp_nav_menu(
                        array(
                                'theme_location'  => 'primary',
                                'container_class' => '',
                                'container_id'    => '',
                                'menu_class'      => 'navbar-nav justify-content-center flex-grow-1 px-3',
                                'fallback_cb'     => '',
                                'menu_id'         => 'main-menu',
                                'depth'           => 2,
                                'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                        )
                );
                ?>

                <div class="d-lg-none pb-4 ">
                    <div class="mb-4 ">
                        <a class="btn btn-secondary d-none d-md-flex"
                           href="#contact-us"><?php esc_html_e( 'Записатися', 'vitamed' ); ?></a>

                    </div>
                    <?php if ( $social = get_field( 'social', 'option' ) ) { ?>
                    <div class="socials-wrapper ">

                        <?php if ( $social ) { ?>
                            <?php get_social_icons( $social ); ?>

                        <?php } ?>

                    </div>
                </div>

            <?php } ?>

            </div>


        </div><!-- .offcanvas -->

        <a class="btn btn-secondary d-none d-md-flex"
           data-bs-toggle="modal" href="#contactModal" role="button"><?php esc_html_e( 'Записатися', 'vitamed' ); ?></a>

    </div><!-- .container(-fluid) -->

</nav><!-- #main-nav -->
