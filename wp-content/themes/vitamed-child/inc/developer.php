<?php

add_filter( 'get_the_archive_title', function ( $title ) {
    if ( is_post_type_archive( 'service' ) ) {
        $title = 'Наші послуги';
    }
    if ( is_post_type_archive( 'doctors' ) ) {
        $title = 'Наші лікарі';
    }
    if ( is_home() || ( is_archive() && is_post_type_archive( 'post' ) ) ) {
        $title = 'Новини';
    }

    return $title;
} );
function custom_breadcrumbs() {
    if ( is_front_page() ) {
        return;
    }

    echo '<nav class="breadcrumbs mb-3" aria-label="Breadcrumbs">';
    echo '<a href="' . home_url() . '">Головна</a> › ';

    if ( is_home() || ( is_archive() && is_post_type_archive( 'post' ) ) ) {
        echo 'Наші новини';

    } elseif ( is_category() ) {
        echo single_cat_title( '', false );

    } elseif ( is_tag() ) {
        echo 'Tag: ' . single_tag_title( '', false );

    } elseif ( is_tax() ) {
        $term = get_queried_object();
        echo $term->name;

    } elseif ( is_post_type_archive( 'service' ) ) {
        echo 'Наші послуги';

    } elseif ( is_post_type_archive( 'doctors' ) ) {
        echo 'Наші лікарі';

    } elseif ( is_post_type_archive() ) {
        post_type_archive_title();

    } elseif ( is_date() ) {
        if ( is_day() ) {
            echo 'Archive for ' . get_the_date();
        } elseif ( is_month() ) {
            echo 'Archive for ' . get_the_date( 'F Y' );
        } elseif ( is_year() ) {
            echo 'Archive for ' . get_the_date( 'Y' );
        }

    } elseif ( is_single() ) {
        $post_type     = get_post_type();
        $post_type_obj = get_post_type_object( $post_type );

        $archive_name = $post_type_obj->labels->name;
        if ( is_singular( 'service' ) ) {
            $archive_name = 'Наші послуги';
        } elseif ( is_singular( 'doctors' ) ) {
            $archive_name = 'Наші лікарі';
        }

        if ( $post_type_obj && get_post_type_archive_link( $post_type ) ) {
            echo '<a href="' . get_post_type_archive_link( $post_type ) . '">' . $archive_name . '</a> › ';
        }
        $category = get_the_category();
        if ( ! empty( $category ) ) {
            echo '<a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->name . '</a> › ';
        }
        the_title();

    } elseif ( is_page() ) {
        global $post;
        if ( $post->post_parent ) {
            $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
            foreach ( $ancestors as $ancestor ) {
                echo '<a href="' . get_permalink( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a> › ';
            }
        }
        the_title();

    } elseif ( is_search() ) {
        echo 'Search results for "' . get_search_query() . '"';

    } elseif ( is_404() ) {
        echo 'Error 404';
    }

    echo '</nav>';
}



function enqueue_ajax_filter_script() {
    if ( is_post_type_archive( 'doctors' ) ) {
        wp_enqueue_script( 'ajax-filter', get_stylesheet_directory_uri() . '/js/ajax-filter.js', array( 'jquery' ), '1.0', true );

        wp_localize_script( 'ajax-filter', 'ajax_object', array(
                'ajax_url' => admin_url( 'admin-ajax.php' ),
                'nonce'    => wp_create_nonce( 'filter_specialty_nonce' )
        ) );
    }
    if ( is_singular( 'doctors' ) ) {

        //wp_enqueue_script( 'calendar-custom', get_stylesheet_directory_uri() . '/js/calendar.js', array( 'jquery' ), '1.1', true );


    }
}

add_action( 'wp_enqueue_scripts', 'enqueue_ajax_filter_script' );

function handle_specialty_filter_ajax() {
    if ( ! wp_verify_nonce( $_POST['nonce'], 'filter_specialty_nonce' ) ) {
        wp_die( 'Помилка безпеки' );
    }

    $term_slug = sanitize_text_field( $_POST['term_slug'] );
    $paged     = isset( $_POST['paged'] ) ? intval( $_POST['paged'] ) : 1;

    $args = array(
            'post_type'      => 'doctors',
            'posts_per_page' => 8,
            'paged'          => $paged,
            'post_status'    => 'publish'
    );

    if ( ! empty( $term_slug ) ) {
        $args['tax_query'] = array(
                array(
                        'taxonomy' => 'specialty',
                        'field'    => 'slug',
                        'terms'    => $term_slug
                )
        );
    }

    $query = new WP_Query( $args );
    ob_start();

    if ( $query->have_posts() ) {
        echo '<div class="row">';
        while ( $query->have_posts() ) {
            $query->the_post();
            $experience         = get_field( 'experience', get_the_ID() );
            $consultation_price = get_field( 'consultation_price', get_the_ID() );
            ?>
            <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
                <div class="bg-white overflow-hidden single-item h-100 d-flex flex-column">
                    <div class="overflow-hidden image-wrapper position-relative">
                        <?php if ( has_post_thumbnail( get_the_ID() ) ) { ?>
                            <?php echo get_the_post_thumbnail( get_the_ID(), 'medium' ); ?>
                        <?php } else { ?>
                            <img class=""
                                 src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/placeholder.png"
                                 alt="placeholder" title="placeholder">
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
                        <h3 class="title"><?php echo esc_html( get_the_title( get_the_ID() ) ); ?><span
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
                            <a class="btn btn-primary" href="<?php echo esc_url( get_permalink( get_the_ID() ) ) ?>">
                                <?php esc_html_e( 'Детальніше', 'vitamed' ); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        echo '</div>';
        $posts_html = ob_get_clean();
        wp_reset_postdata();

        ob_start();
        if ( $query->max_num_pages > 1 ) {
            $pagination_args = array(
                    'base'      => '%_%',
                    'format'    => '?paged=%#%',
                    'total'     => $query->max_num_pages,
                    'current'   => $paged,
                    'mid_size'  => 2,
                    'prev_text' => _x( '<svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.0711 6.74998C15.4853 6.74998 15.8211 6.41419 15.8211 5.99998C15.8211 5.58576 15.4853 5.24998 15.0711 5.24998L15.0711 5.99998L15.0711 6.74998ZM0.398603 5.46965C0.10571 5.76254 0.105709 6.23741 0.398603 6.53031L5.17157 11.3033C5.46447 11.5962 5.93934 11.5962 6.23223 11.3033C6.52513 11.0104 6.52513 10.5355 6.23223 10.2426L1.98959 5.99998L6.23223 1.75734C6.52513 1.46444 6.52513 0.989569 6.23223 0.696676C5.93934 0.403783 5.46447 0.403783 5.17157 0.696676L0.398603 5.46965ZM15.0711 5.99998L15.0711 5.24998L0.928933 5.24998L0.928933 5.99998L0.928933 6.74998L15.0711 6.74998L15.0711 5.99998Z" fill="#31312F"/>
</svg>
', 'previous set of posts', 'understrap' ),
                    'next_text' => _x( '<svg width="16" height="12" viewBox="0 0 16 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M0.928932 6.74998C0.514718 6.74998 0.178932 6.41419 0.178932 5.99998C0.178932 5.58576 0.514718 5.24998 0.928932 5.24998L0.928932 5.99998L0.928932 6.74998ZM15.6014 5.46965C15.8943 5.76254 15.8943 6.23741 15.6014 6.53031L10.8284 11.3033C10.5355 11.5962 10.0607 11.5962 9.76777 11.3033C9.47487 11.0104 9.47487 10.5355 9.76777 10.2426L14.0104 5.99998L9.76777 1.75734C9.47487 1.46444 9.47487 0.989569 9.76777 0.696676C10.0607 0.403783 10.5355 0.403783 10.8284 0.696676L15.6014 5.46965ZM0.928932 5.99998L0.928932 5.24998L15.0711 5.24998L15.0711 5.99998L15.0711 6.74998L0.928932 6.74998L0.928932 5.99998Z" fill="#31312F"/>
</svg>
', 'next set of posts', 'understrap' ),
                    'type'      => 'list',
                    'add_args'  => array(
                            'action'    => 'filter_specialty_posts',
                            'term_slug' => $term_slug,
                            'nonce'     => wp_create_nonce( 'filter_specialty_nonce' )
                    )
            );
            echo '<nav class="pagination">' . paginate_links( $pagination_args ) . '</nav>';
//            $pagination_links = paginate_links($pagination_args);
//            if (!empty($pagination_links)) {
//                echo '<ul class="pagination">';
//                foreach ($pagination_links as $link) {
//                    $link = str_replace('page-numbers', 'page-link', $link);
//
//                    if (strpos($link, 'current') !== false) {
//                        echo '<li class="page-item active">' . $link . '</li>';
//                    } else {
//                        echo '<li class="page-item">' . $link . '</li>';
//                    }
//                }
//                echo '</ul>';
//            }
        }
        $pagination = ob_get_clean();

        wp_send_json_success( array(
                'posts_html'  => $posts_html,
                'pagination'  => $pagination,
                'found_posts' => $query->found_posts
        ) );
    } else {
        ob_end_clean();
        $empty_html = '<div class="row"><div class="col-12"><p class="text-center">Немає постів за вибраним фільтром.</p></div></div>';
        wp_send_json_success( array(
                'posts_html'  => $empty_html,
                'pagination'  => '',
                'found_posts' => 0
        ) );
    }
}

add_action( 'wp_ajax_filter_specialty_posts', 'handle_specialty_filter_ajax' );
add_action( 'wp_ajax_nopriv_filter_specialty_posts', 'handle_specialty_filter_ajax' );


function set_doctors_posts_per_page( $query ) {
    if ( ! is_admin() && $query->is_main_query() ) {
        if ( is_post_type_archive( 'doctors' ) ) {
            $query->set( 'posts_per_page', 8 );
        }
    }
}

add_action( 'pre_get_posts', 'set_doctors_posts_per_page' );


// Shortcode function
function doctor_booking_form_shortcode() {

    wp_enqueue_style( 'vanillajs-datepicker' );
    wp_enqueue_script( 'vanillajs-datepicker' );
    wp_enqueue_script( 'vanillajs-datepicker-locales-uk' );
    wp_enqueue_script( 'custom-datepicker' );
    ob_start();
    ?>
    <div class="container my-5 calendar-wrapper doctor-booking-form">
        <div class="row g-4 align-items-center">
            <div class="col-12">
                <div class="d-flex justify-content-lg-between align-item-lg-center flex-column flex-lg-row rounded-3 bg-white p-6">
                    <!-- Left: Calendar -->
                    <div class="col-12 col-lg-5 flex-column rounded-3  bg-secondary-lite p-6 d-flex align-items-center justify-content-center">
                        <div class="rounded-3 bg-white p-3">
                            <h4 class="fw-bold text-center mb-3"><?php echo __( 'Дні прийому лікаря', 'vitemed' ) ?></h4>
                            <div id="calendar" class="doctor-booking-calendar" style="width: auto">
                        </div>


                        </div>
                    </div>
                    <!-- Right: Form -->
                    <div class="col-12 col-lg-6">
                        <div class="p-4 rounded bg-white shadow-sm">
                            <h4 class="fw-bold mb-2"><?php echo __( 'Записатися на прийом', 'vitemed' ) ?></h4>
                            <p class="text-muted mb-4"><?php echo __( 'Оператор зателефонує для уточнення деталей', 'vitemed' ) ?></p>

                            <form id="doctor-booking-form" method="post">
                                <div class="mb-3">
                                    <input type="text"
                                           class="form-control"
                                           name="your_name"
                                           placeholder="<?php echo __( 'Ваше ім’я', 'vitemed' ) ?>" required>
                                </div>

                                <div class="mb-3">
                                    <input type="tel"
                                           class="form-control"
                                           name="your_phone"
                                           placeholder="<?php echo __( 'Ваш телефон', 'vitemed' ) ?>" required>
                                </div>

                                <input type="hidden" name="appointment_date" id="appointment_date">

                                <?php wp_nonce_field( 'doctor_booking_action', 'doctor_booking_nonce' ); ?>
                                <button type="submit"
                                        class="btn btn-secondary "><?php echo __( 'Зателефонуйте мені', 'vitemed' ) ?>

                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>




        </div>
    </div>


    <?php
    // Handle form submission
    if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['doctor_booking_nonce'] ) && wp_verify_nonce( $_POST['doctor_booking_nonce'], 'doctor_booking_action' ) ) {
        global $wpdb;
        $table_name       = $wpdb->prefix . 'doctor_bookings';
        $name             = sanitize_text_field( $_POST['your_name'] );
        $phone            = sanitize_text_field( $_POST['your_phone'] );
        $appointment_date = sanitize_text_field( $_POST['appointment_date'] );

        $wpdb->insert(
                $table_name,
                array(
                        'name'             => $name,
                        'phone'            => $phone,
                        'appointment_date' => $appointment_date
                ),
                array( '%s', '%s', '%s' )
        );
    }

    return ob_get_clean();
}

add_shortcode( 'doctor_booking_form', 'doctor_booking_form_shortcode' );


