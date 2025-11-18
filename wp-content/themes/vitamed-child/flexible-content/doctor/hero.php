<article <?php post_class('p-4 bg-white rounded-3'); ?> id="post-<?php the_ID(); ?>">


    <div class="row align-items-center mb-5 pb-2 bx-70">
        <div class="col-xl-4 col-md-6">
            <div class="image-wrapper rounded-3 overflow-hidden position-relative">
                <?php echo get_the_post_thumbnail($post->ID, 'medium'); ?>
                <?php if ($experience) {
                    $year = __( ' рік', 'vitamed' );
                    if (intval($experience) > 1) {
                        $year = __( ' років', 'vitamed' );
                    }
                    ?>
                    <span class="experience position-absolute">Стаж <?php echo $experience . $year; ?></span>
                <?php } ?>
            </div>
        </div>
        <div class="col-xl-8 col-md-6">
            <?php
            $terms = get_the_terms(get_the_ID(), 'qualification');
            if ($terms && !is_wp_error($terms)) {
                $term_names = wp_list_pluck($terms, 'name');
                echo '<div class="qualification">' . esc_html(implode(', ', $term_names)) . '</div>';
            }
            ?>
            <?php
            the_title(
                sprintf('<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
                '</a></h2>'
            );
            ?>
            <?php
            $terms = get_the_terms(get_the_ID(), 'specialty');
            if ($terms && !is_wp_error($terms)) {
                $term_names = wp_list_pluck($terms, 'name');
                echo '<div class="specialties">' . esc_html(implode(', ', $term_names)) . '</div>';
            }
            ?>
            <a class="btn btn-secondary d-none d-md-flex" href="#contact-us" target="_self">
                <?php esc_html_e( 'Записатися', 'vitamed' ); ?></a>
            <!-- Display ACF Fields -->
            <div class="acf-fields mt-4">
                <?php if (get_field('consultation_price')) : ?>
                    <div class="d-flex align-items-center mb-2 consultation">
                        <svg width="45" height="46" viewBox="0 0 45 46" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <rect y="0.5" width="45" height="45" rx="15" fill="#EDFAE6"/>
                            <path d="M27.4531 12.5833H17.5469C16.3397 12.5833 15.7362 12.5833 15.2494 12.7527C14.3263 13.0739 13.6015 13.82 13.2895 14.7703C13.125 15.2714 13.125 15.8927 13.125 17.1355V31.7231C13.125 32.6171 14.151 33.0914 14.8001 32.4975C15.1814 32.1485 15.7561 32.1485 16.1374 32.4975L16.6406 32.958C17.3089 33.5695 18.3161 33.5695 18.9844 32.958C19.6527 32.3464 20.6598 32.3464 21.3281 32.958C21.9964 33.5695 23.0036 33.5695 23.6719 32.958C24.3402 32.3464 25.3473 32.3464 26.0156 32.958C26.6839 33.5695 27.6911 33.5695 28.3594 32.958L28.8626 32.4975C29.2439 32.1485 29.8186 32.1485 30.1999 32.4975C30.849 33.0914 31.875 32.6171 31.875 31.7231V17.1355C31.875 15.8927 31.875 15.2714 31.7105 14.7703C31.3985 13.82 30.6737 13.0739 29.7506 12.7527C29.2638 12.5833 28.6603 12.5833 27.4531 12.5833Z"
                                  stroke="#4CD30E" stroke-width="2"/>
                            <path d="M19.8965 21.3333L21.3846 23L25.1048 18.8333" stroke="#4CD30E"
                                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M17.8125 26.6458H27.1875" stroke="#4CD30E" stroke-width="2"
                                  stroke-linecap="round"/>
                        </svg>
                        <div class="">
                            <span class=d-block"><?php esc_html_e( 'Консультація', 'vitamed' ); ?></span>
                            <strong class="d-block"><?php echo get_field('consultation_price'); ?> <?php esc_html_e( ' грн.', 'vitamed' ); ?></strong>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if (have_rows('information')) : ?>
        <div class="accordion accordion-masonry"
             id="accordionPanelsStayOpen-<?php echo get_the_ID(); ?>">
            <?php $aos_delay = 0;
            while (have_rows('information')) : the_row();
                $item_title = get_sub_field('title');
                $content = get_sub_field('content');
                $is_first = (get_row_index() === 1);
                ?>
                <div class="accordion-item bg-white rounded-1 mb-4 d-inline-block w-100"
                     data-aos="fade-up"
                     data-aos-delay="<?php echo $aos_delay;
                     $aos_delay += 200; ?>">
                    <div class="accordion-header"
                         id="panelsStayOpen-heading-<?php echo get_the_ID(); ?>-<?php echo get_row_index(); ?>">
                        <button class="accordion-button h3 m-0 <?php echo $is_first ? '' : 'collapsed'; ?>"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapse-<?php echo get_the_ID(); ?>-<?php echo get_row_index(); ?>"
                                aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
                                aria-controls="panelsStayOpen-collapse-<?php echo get_the_ID(); ?>-<?php echo get_row_index(); ?>">
                            <?php echo $item_title; ?>
                        </button>
                    </div>
                    <div id="panelsStayOpen-collapse-<?php echo get_the_ID(); ?>-<?php echo get_row_index(); ?>"
                         class="accordion-collapse collapse <?php echo $is_first ? 'show' : ''; ?>"
                         aria-labelledby="panelsStayOpen-heading-<?php echo get_the_ID(); ?>-<?php echo get_row_index(); ?>">
                        <div class="accordion-body px-3 pb-3 pt-0">
                            <?php echo $content; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
    <div class="entry-content mt-6">
        <?php
        the_excerpt();
        understrap_link_pages();
        ?>
    </div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
