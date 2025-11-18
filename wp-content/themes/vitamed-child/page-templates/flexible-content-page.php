<?php
/**
 * Template Name: Flexible Content Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

?>

    <div class="wrapper py-0 no-title-page-wrapper"  id="content">

            <main class="site-main" id="main" role="main">
                <?php
                if ( !  is_front_page() && ! is_home() ) {
                    ?>
                    <header class="entry-header my-1 py-4">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <?php custom_breadcrumbs(); ?>
                                    <?php
                                    the_title(
                                            '<h1 class="entry-title h2">',
                                            '</h1>'
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>

                    </header><!-- .entry-header -->
                    <?php
                }
                ?>
                <?php
                while ( have_posts() ) {
                    the_post();

                    // ACF - Flexible Content fields.
                    $sections = get_field( 'page_sections' );

                    if ( $sections ) :
                        foreach ( $sections as $key => $section ) :
                            $template = str_replace( '_', '-', $section['acf_fc_layout'] );
                            get_template_part( 'flexible-content/sections/' . $template, '', array('key' => $key, 'section' => $section)  );
                        endforeach;
                    endif;

                }
                ?>

            </main>



    </div><!-- #no-title-page-wrapper -->

<?php
get_footer();
