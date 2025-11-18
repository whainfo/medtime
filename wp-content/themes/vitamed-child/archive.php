<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');
$heading = 'h2';
$title = get_field('title', 'option');
$form_title = get_field('form_title', 'option');

$shortcode = get_field('form_shortcode', 'option');
$text = get_field('description', 'option');
?>

    <div class="archive-wrapper" id="archive-wrapper">

        <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">


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
                        if (have_posts()) {
                            ?>
                            <div class="col-12">
                                <header class="page-header">
                                    <?php
                                    the_archive_title('<h2 class="page-title">', '</h2>');
                                    the_archive_description('<div class="taxonomy-description">', '</div>');
                                    ?>
                                </header><!-- .page-header -->
                            </div>
                            <?php
                            // Start the loop.
                            while (have_posts()) {
                                the_post();

                                /*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                ?>
                                <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
                                    <div class="swiper-slide bg-white overflow-hidden">
                                        <div class="overflow-hidden  image-wrapper ">
                                            <?php if (has_post_thumbnail(get_the_ID())) { ?>
                                                <?php echo get_the_post_thumbnail(get_the_ID(), 'large'); ?>
                                            <?php } else { ?>
                                                <img class=""
                                                     src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/placeholder.png"
                                                     alt="placeholder"
                                                     title="placeholder">
                                            <?php } ?>
                                        </div>
                                        <div class="content-wrapper ">
                                            <h3 class="title "><?php echo esc_html(get_the_title(get_the_ID())); ?><span
                                                        class="text-secondary">.</span></h3>
                                            <?php add_filter('excerpt_length', 'vitamed_custom_excerpt_length', 999); ?>
                                            <div class="content limit-4-lines"><?php echo get_the_excerpt(get_the_ID()); ?></div>
                                            <?php remove_filter('excerpt_length', 'vitamed_custom_excerpt_length', 999); ?>

                                            <div class="cta ">
                                                <a class="btn btn-primary"
                                                   href="<?php echo esc_url(get_permalink(get_the_ID())) ?>">
                                                    <?php esc_html_e('Детальніше', 'vitamed'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            get_template_part('loop-templates/content', 'none');
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

        <section  id="contact-us"  class="contact-form-section section-wrapper wrapper m-75">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-12 ">
                        <div class="bg-white rounded-3 p-5" data-aos="fade-up"
                             data-aos-delay="<?php echo '0'; ?>">
                            <div class=" d-flex flex-wrap justify-content-between ">
                                <?php if ($title || $text) { ?>
                                    <div class="px-2 py-md-3 col-12 col-md-6  col-lg-6 mb-3 mb-md-0 ">
                                        <svg width="50" class="mb-4" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="50" height="50" rx="15" fill="#4CD30E" fill-opacity="0.1"/>
                                            <path d="M22 27.2354V30.0001C22 32.7615 24.2386 35.0001 27 35.0001H27.8824C29.7691 35.0001 31.3595 33.7311 31.8465 32.0001" stroke="#4CD30E" stroke-width="2"/>
                                            <path d="M18.4286 16H18.3369C18.024 16 17.8676 16 17.7357 16.0117C16.2876 16.1397 15.1397 17.2876 15.0117 18.7357C15 18.8676 15 19.024 15 19.3369V20.2353C15 24.1013 18.134 27.2353 22 27.2353C25.7082 27.2353 28.7143 24.2292 28.7143 20.521V19.3369C28.7143 19.024 28.7143 18.8676 28.7026 18.7357C28.5746 17.2876 27.4267 16.1397 25.9785 16.0117C25.8467 16 25.6902 16 25.3774 16H25.2857" stroke="#4CD30E" stroke-width="2" stroke-linecap="round"/>
                                            <circle cx="32" cy="29" r="3" stroke="#4CD30E" stroke-width="2"/>
                                            <path d="M25 15V17" stroke="#4CD30E" stroke-width="2" stroke-linecap="round"/>
                                            <path d="M19 15V17" stroke="#4CD30E" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                        <?php if ($title) { ?>
                                            <?php
                                            printf(
                                                __('<%1$s class=" title mb-4 section-title">%2$s</%1$s>  '),
                                                esc_html($heading),
                                                esc_html($title),
                                            ); ?>
                                        <?php } ?>
                                        <?php if ($text) : ?>
                                            <div class="content fs-6 mb-4"><?php echo $text; ?></div>
                                        <?php endif; ?>
                                    </div>
                                <?php } ?>
                                <div class=" col-12 col-md-6 rounded-4 p-3">
                                    <?php if ($form_title) : ?>
                                        <div class="content fs-6 mb-4"><?php echo $form_title; ?></div>
                                    <?php endif; ?>
                                    <div class="form-wrapper">
                                        <?php echo do_shortcode($shortcode); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- info-section -->
        <?php include get_stylesheet_directory() . '/flexible-content/sections/contact.php'; ?>

    </div><!-- #archive-wrapper -->

<?php
get_footer();
