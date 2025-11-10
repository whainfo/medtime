<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$service_style      = get_field( 'service_style', 'option' ) ? get_field( 'service_style', 'option' ) : 'image';
?>

    <div class="archive-wrapper" id="archive-wrapper">

        <div class="container" id="content" tabindex="-1">


            <?php
            // Do the left sidebar check and open div#primary.
            ?>
            <div class="slider-swiper">
                <div class="swiper-wrapper">
                    <div class="row" id="main">
                        <div class="col-12">
                            <?php custom_breadcrumbs(); ?>
                        </div>
                        <?php
                        if ( have_posts() ) {
                            ?>
                            <div class="col-12">
                                <header class="page-header">
                                    <?php
                                    the_archive_title( '<h2 class="page-title">', '</h2>' );
                                    the_archive_description( '<div class="taxonomy-description">', '</div>' );
                                    ?>
                                </header><!-- .page-header -->
                            </div>
                            <?php
                            // Start the loop.
                            while ( have_posts() ) {
                                the_post();

                                /*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                ?>
                                <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
                                    <div class="swiper-slide bg-white overflow-hidden">
                                        <?php if($service_style == 'icon'){?>
                                            <div class="overflow-hidden  icon-wrapper ">
                                                <?php if ( get_field('icon') ) { ?>
                                                    <?php echo wp_get_attachment_image( get_field('icon'), 'full' ); ?>
                                                <?php } else { ?>
                                                    <img width="70" height="70" class=""
                                                         src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/doctor.svg"
                                                         alt="placeholder"
                                                         title="placeholder">
                                                <?php } ?>
                                            </div>
                                        <?php } else { ?>
                                            <div class="overflow-hidden  image-wrapper ">
                                                <?php if ( has_post_thumbnail( get_the_ID() ) ) { ?>
                                                    <?php echo get_the_post_thumbnail( get_the_ID(), 'large' ); ?>
                                                <?php } else { ?>
                                                    <img class=""
                                                         src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/placeholder.png"
                                                         alt="placeholder"
                                                         title="placeholder">
                                                <?php } ?>
                                            </div>
                                        <?php } ?>

                                        <div class="content-wrapper ">
                                            <h3 class="title "><?php echo esc_html( get_the_title( get_the_ID() ) ); ?></h3>
                                            <?php $description = get_field( 'description', get_the_ID() ); ?>
                                            <?php if ( $description ) { ?>
                                                    <p>
                                                        <?php echo $description; ?>
                                                    </p>

                                            <?php } else { ?>
                                                <?php add_filter( 'excerpt_length', 'vitamed_custom_excerpt_length', 999 ); ?>
                                                <div class="content limit-4-lines"><?php echo get_the_excerpt( get_the_ID() ); ?></div>
                                                <?php remove_filter( 'excerpt_length', 'vitamed_custom_excerpt_length', 999 ); ?>
                                            <?php } ?>
                                            <div class="cta ">
                                                <a class="btn btn-primary"
                                                   href="<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>">
                                                    <?php esc_html_e( 'Детальніше', 'vitamed' ); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            get_template_part( 'loop-templates/content', 'none' );
                        }
                        ?>

                    </div>
                </div>
            </div>
            <div class="mt-2 d-flex justify-content-end">
                <?php
                understrap_pagination();
                ?>
            </div>
        </div><!-- #content -->

        <!-- contact-form-section -->
        <?php include get_stylesheet_directory() . '/loop-templates/general-contact-form.php'; ?>
        <!-- end contact-form-section -->

        <!-- Contact Section -->
        <?php include get_stylesheet_directory() . '/flexible-content/sections/contact.php'; ?>
        <!-- End Contact Section -->
    </div><!-- #archive-wrapper -->

<?php
get_footer();
