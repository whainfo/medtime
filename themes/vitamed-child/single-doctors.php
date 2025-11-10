<?php
/**
 * The template for displaying all single posts
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$heading = 'h2';
$title = get_field('title', 'option');
$form_title = get_field('form_title', 'option');

$shortcode = get_field('form_shortcode', 'option');
$text = get_field('description', 'option');

$theme_color = get_field( 'theme_color', 'option' ) ? get_field( 'theme_color', 'option' )  : '#4CD30E' ;
?>

    <div class="wrapper" id="single-wrapper">

        <div class="container" id="content" tabindex="-1">

            <div class="row">
                <div class="col-12">
                    <?php custom_breadcrumbs(); ?>
                </div>


            </div><!-- .row -->

        </div><!-- #content -->
        <div class=" content-area" id="primary">

            <main class="site-main" id="main">

                <?php
                while (have_posts()) {
                    the_post();
                    //get_template_part('loop-templates/content', 'doctor');

                    ?>
                    <?php
                    // ACF - Flexible Content fields.
                    $sections = get_field( 'doctor_sections' );

                    if ( $sections ) :
                        foreach ( $sections as $key => $section ) :
                            $template = str_replace( '_', '-', $section['acf_fc_layout'] );
                            get_template_part( 'flexible-content/sections/' . $template, '', array('key' => $key, 'section' => $section)  );
                        endforeach;
                    endif;
                    ?>
                    <?php
                }
                ?>

            </main>

        </div>

        <?php if( get_field( 'sign_up_open' ) && false){ ?>

            <div id="contact-us" class="container my-5 calendar-wrapper doctor-booking-form">
                <div class="row g-4 align-items-center">
                    <div class="col-12">
                        <div class="d-flex justify-content-lg-between  align-items-lg-center flex-column flex-lg-row rounded-3 bg-white p-6">
                            <!-- Left: Calendar -->
                            <div class="col-12 col-lg-5 flex-column rounded-3  bg-secondary-lite py-6 px-1 d-flex align-items-center justify-content-center">
                                <div class="rounded-3 bg-white p-3">
                                    <h4 class="fw-bold text-center mb-3"><?php echo __( 'Дні прийому лікаря', 'vitemed' ) ?></h4>

                                    <div id="calendar" class="doctor-booking-calendar" style="width: auto">
                                    </div>
                                </div>
                            </div>
                            <!-- Right: Form -->
                            <div class="col-12 col-lg-6">
                                <div class="p-4 rounded bg-white ">
                                    <h4 class="fw-bold mb-2"><?php echo __( 'Записатися на прийом', 'vitemed' ) ?></h4>
                                    <p class="text-muted mb-4"><?php echo __( 'Оператор зателефонує для уточнення деталей', 'vitemed' ) ?></p>

                                    <div class="form-wrapper">
                                        <?php echo do_shortcode($shortcode); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>




                </div>
            </div>

        <?php } else{

            //get_short_form() ;
        } ?>

        <?php include get_stylesheet_directory() . '/flexible-content/sections/contact.php'; ?>
    </div><!-- #single-wrapper -->
<input type="hidden" id="doctor_id" value="<?php echo get_the_ID(); ?>">
<?php
get_footer();
