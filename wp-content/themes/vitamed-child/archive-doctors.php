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


?>

    <div class="archive-wrapper doctors" id="archive-wrapper">

        <div class="container" id="content" tabindex="-1">


            <?php
            // Do the left sidebar check and open div#primary.
            ?>
            <main class="main" id="main">
                <div class="row">
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
                    <div class="col-12 mb-3 d-flex flex-column justify-content-end align-items-end">
                        <div class="position-relative specialty">
                            <svg class="position-absolute svg_select" width="40" height="40" viewBox="0 0 40 40"
                                 fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <rect width="40" height="40" rx="20" fill="#F5F5F5"/>
                                <path d="M25 20H24.3321C23.6408 20 23.2951 20 23.0085 20.1623C22.722 20.3245 22.5441 20.6209 22.1884 21.2138L22.1627 21.2567C21.8313 21.809 21.6656 22.0851 21.4245 22.0806C21.1835 22.076 21.0283 21.7939 20.7179 21.2295L19.3118 18.673C19.0224 18.1468 18.8777 17.8837 18.6466 17.8713C18.4155 17.8588 18.2433 18.1048 17.899 18.5967L17.6631 18.9337C17.2973 19.4562 17.1145 19.7175 16.8431 19.8587C16.5718 20 16.2529 20 15.615 20H15"
                                      stroke="#868686" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="M17.4675 26.1423L17.9414 25.561L17.4675 26.1423ZM19.9993 14.5823L19.4503 15.0932C19.5922 15.2457 19.7911 15.3323 19.9993 15.3323C20.2076 15.3323 20.4065 15.2457 20.5484 15.0932L19.9993 14.5823ZM22.5312 26.1423L23.0052 26.7235L22.5312 26.1423ZM17.4675 26.1423L17.9414 25.561C16.7368 24.5787 15.3339 23.2934 14.2386 21.8896C13.129 20.4675 12.416 19.0264 12.416 17.717H11.666H10.916C10.916 19.5305 11.8778 21.3023 13.056 22.8123C14.2484 24.3405 15.7462 25.7064 16.9935 26.7235L17.4675 26.1423ZM11.666 17.717H12.416C12.416 15.4797 13.4447 14.012 14.7146 13.4837C15.964 12.9639 17.7272 13.2413 19.4503 15.0932L19.9993 14.5823L20.5484 14.0714C18.5216 11.8932 16.1182 11.2751 14.1384 12.0987C12.179 12.9139 10.916 15.0285 10.916 17.717H11.666ZM22.5312 26.1423L23.0052 26.7235C24.2525 25.7065 25.7503 24.3405 26.9427 22.8123C28.1209 21.3024 29.0827 19.5305 29.0827 17.717H28.3327H27.5827C27.5827 19.0264 26.8697 20.4675 25.7601 21.8896C24.6648 23.2934 23.2619 24.5787 22.0573 25.561L22.5312 26.1423ZM28.3327 17.717H29.0827C29.0827 15.0285 27.8197 12.9138 25.8603 12.0987C23.8805 11.2751 21.477 11.8932 19.4503 14.0714L19.9993 14.5823L20.5484 15.0932C22.2715 13.2413 24.0347 12.9638 25.2841 13.4836C26.5539 14.0119 27.5827 15.4796 27.5827 17.717H28.3327ZM17.4675 26.1423L16.9935 26.7235C18.0424 27.5789 18.8137 28.25 19.9994 28.25L19.9994 27.5L19.9994 26.75C19.4512 26.75 19.1125 26.516 17.9414 25.561L17.4675 26.1423ZM22.5312 26.1423L22.0573 25.561C20.8862 26.516 20.5475 26.75 19.9994 26.75L19.9994 27.5L19.9994 28.25C21.185 28.25 21.9563 27.5789 23.0052 26.7235L22.5312 26.1423Z"
                                      fill="#868686"/>
                            </svg>

                            <select id="specialty-filter" class="form-select">
                                <option value=""><?php esc_html_e( 'Оберіть спеціалізацію', 'vitamed' ); ?></option>
                                <?php
                                $specialty_terms = get_terms( array(
                                        'taxonomy'   => 'specialty',
                                        'hide_empty' => true,
                                        'orderby'    => 'name',
                                        'order'      => 'ASC'
                                ) );
                                if ( ! empty( $specialty_terms ) && ! is_wp_error( $specialty_terms ) ) {
                                    foreach ( $specialty_terms as $term ) {
                                        echo '<option value="' . esc_attr( $term->slug ) . '">' . esc_html( $term->name ) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row posts-row">
                    <?php
                    // Start the loop.
                    while ( have_posts() ) {
                        the_post();
                        $experience         = get_field( 'experience', get_the_ID() );
                        $consultation_price = get_field( 'consultation_price', get_the_ID() );

                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        ?>
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
                            <div class="bg-white overflow-hidden single-item h-100 d-flex flex-column">
                                <div class="overflow-hidden  image-wrapper  position-relative">
                                    <?php if ( has_post_thumbnail( get_the_ID() ) ) { ?>
                                        <?php echo get_the_post_thumbnail( get_the_ID(), 'medium' ); ?>
                                    <?php } else { ?>
                                        <img class=""
                                             src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/placeholder.png"
                                             alt="placeholder"
                                             title="placeholder">
                                    <?php } ?>
                                    <?php if ( $experience ) {
                                        $year = ' рік';
                                        if ( intval( $experience ) > 1 ) {
                                            $year = ' років';
                                        }
                                        ?>
                                        <span class="experience position-absolute"><?php echo $experience . $year; ?></span>
                                    <?php } ?>
                                </div>
                                <div class="content-wrapper d-flex flex-column flex-grow-1">
                                    <?php
                                    $terms = get_the_terms( get_the_ID(), 'qualification' );
                                    if ( $terms && ! is_wp_error( $terms ) ) {
                                        $term_names = wp_list_pluck( $terms, 'name' );
                                        echo '<div class="qualification">' . esc_html( implode( ', ', $term_names ) ) . '</div>';
                                    }
                                    ?>

                                    <h3 class="title "><?php echo esc_html( get_the_title( get_the_ID() ) ); ?><span
                                                class="text-secondary">.</span></h3>
                                    <?php add_filter( 'excerpt_length', 'vitamed_custom_excerpt_length', 999 ); ?>
                                    <div class="content limit-4-lines"><?php echo get_the_excerpt( get_the_ID() ); ?></div>
                                    <?php remove_filter( 'excerpt_length', 'vitamed_custom_excerpt_length', 999 ); ?>
                                    <?php
                                    $terms = get_the_terms( get_the_ID(), 'specialty' );
                                    if ( $terms && ! is_wp_error( $terms ) ) {
                                        $term_names = wp_list_pluck( $terms, 'name' );
                                        echo '<div class="specialties">' . esc_html( implode( ', ', $term_names ) ) . '</div>';
                                    }
                                    ?>
                                    <div class="cta mt-auto">
                                        <a class="btn btn-primary"
                                           href="<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>">
                                            <?php esc_html_e( 'Детальніше', 'vitamed' ); ?></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <?php
                    } ?>
                </div>
                <?php
                } else {
                    get_template_part( 'loop-templates/content', 'none' );
                }
                ?>

            </main>
            <div class="mt-2 d-flex justify-content-end pagination-wrapper">
                <?php
                global $wp_query;
                $pagination_links = paginate_links( array(
                        'total'     => $wp_query->max_num_pages,
                        'current'   => max( 1, get_query_var( 'paged' ) ),
                        'mid_size'  => 2,
                        'prev_text' => _x( '<svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.0711 6.74998C15.4853 6.74998 15.8211 6.41419 15.8211 5.99998C15.8211 5.58576 15.4853 5.24998 15.0711 5.24998L15.0711 5.99998L15.0711 6.74998ZM0.398603 5.46965C0.10571 5.76254 0.105709 6.23741 0.398603 6.53031L5.17157 11.3033C5.46447 11.5962 5.93934 11.5962 6.23223 11.3033C6.52513 11.0104 6.52513 10.5355 6.23223 10.2426L1.98959 5.99998L6.23223 1.75734C6.52513 1.46444 6.52513 0.989569 6.23223 0.696676C5.93934 0.403783 5.46447 0.403783 5.17157 0.696676L0.398603 5.46965ZM15.0711 5.99998L15.0711 5.24998L0.928933 5.24998L0.928933 5.99998L0.928933 6.74998L15.0711 6.74998L15.0711 5.99998Z" fill="#31312F"/>
</svg>
', 'previous set of posts', 'understrap' ),
                        'next_text' => _x( '<svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M0.928932 6.74998C0.514718 6.74998 0.178932 6.41419 0.178932 5.99998C0.178932 5.58576 0.514718 5.24998 0.928932 5.24998L0.928932 5.99998L0.928932 6.74998ZM15.6014 5.46965C15.8943 5.76254 15.8943 6.23741 15.6014 6.53031L10.8284 11.3033C10.5355 11.5962 10.0607 11.5962 9.76777 11.3033C9.47487 11.0104 9.47487 10.5355 9.76777 10.2426L14.0104 5.99998L9.76777 1.75734C9.47487 1.46444 9.47487 0.989569 9.76777 0.696676C10.0607 0.403783 10.5355 0.403783 10.8284 0.696676L15.6014 5.46965ZM0.928932 5.99998L0.928932 5.24998L15.0711 5.24998L15.0711 5.99998L15.0711 6.74998L0.928932 6.74998L0.928932 5.99998Z" fill="#31312F"/>
</svg>
', 'next set of posts', 'understrap' ),
                        'type'      => 'array'
                ) );
                if ( ! empty( $pagination_links ) ) {
                    echo '<ul class="pagination">';
                    foreach ( $pagination_links as $link ) {
                        $link = str_replace( 'page-numbers', 'page-link', $link );

                        if ( strpos( $link, 'current' ) !== false ) {
                            echo '<li class="page-item active">' . $link . '</li>';
                        } else {
                            echo '<li class="page-item">' . $link . '</li>';
                        }
                    }
                    echo '</ul>';
                } ?>
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
