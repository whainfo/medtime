<?php

defined( 'ABSPATH' ) || exit;

function get_social_icons( $social ) {
    $social_facebook = $social['facebook'];
    $social_instagram = $social['instagram'];
    $social_youtube = $social['youtube'];
    $social_twitter = $social['twitter'];
    $social_linkedin = $social['linkedin'];
    ?>
    <div class="socials d-flex  align-items-center fw-bold">
        <?php if ( $social_facebook ) { ?>
            <a href="<?php echo $social_facebook ?>" target="_blank"
               class="d-inline-block lh-1"
               aria-label="facebook">
                <img class="icon" width="20" height="20" role="img" aria-label="facebook"
                     src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/fb.svg"
                     alt="social"
                     title="social">
            </a>
        <?php } ?>
        <?php if ( $social_instagram ) { ?>
            <a href="<?php echo $social_instagram ?>" target="_blank"
               class="d-inline-block lh-1"
               aria-label="instagram">
                <img class="icon" width="20" height="20" role="img" aria-label="instagram"
                     src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/inst.svg"
                     alt="social"
                     title="social">
            </a>
        <?php } ?>
        <?php if ( $social_youtube ) { ?>
            <a href="<?php echo $social_youtube ?>" target="_blank"
               class="d-inline-block lh-1"
               aria-label="youtube">
                <img class="icon" width="20" height="20" role="img" aria-label="youtube"
                     src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/youtube.svg"
                     alt="social"
                     title="social">
            </a>
        <?php } ?>
        <?php if ( $social_twitter ) { ?>
            <a href="<?php echo $social_twitter ?>" target="_blank"
               class="d-inline-block lh-1"
               aria-label="twitter">
                <img class="icon" width="20" height="20" role="img" aria-label="twitter"
                     src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/twitter.svg"
                     alt="social"
                     title="social">
            </a>
        <?php } ?>
        <?php if ( $social_linkedin ) { ?>
            <a href="<?php echo $social_linkedin ?>" target="_blank"
               class="d-inline-block lh-1"
               aria-label="linkedin">
                <img class="icon" width="20" height="20" role="img" aria-label="linkedin"
                     src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/linkedin.svg"
                     alt="social"
                     title="social">
            </a>
        <?php } ?>
    </div>
    <?php

}

function get_list_tax_posts($p_id, $tax = '') {
    if($tax && $p_id){
        $clinic_types    = get_the_terms( $p_id, $tax );
        $categories_list = '';
        if ( ! empty( $clinic_types ) && ! is_wp_error( $clinic_types ) ) {
            $categories_list = wp_list_pluck( $clinic_types, 'name' );

        }
        if ( $categories_list ) {
            /* translators: %s: Categories of current post */
            printf( '<div class=" ' . esc_html__( $tax ) . '-list"><span class="cat-links">' . esc_html__( '%s', 'med-portal' ) . '</span></div>', implode( ', ', $categories_list ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }

}

function vitamed_hex2rgb($hex): array {
    // Remove '#' if present
    $hex = str_replace("#", "", $hex);

    // Handle shorthand hex codes (e.g., #f00)
    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else { // Handle full hex codes (e.g., #ff0000)
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }

    return array($r, $g, $b); // Returns an array with RGB values
}

function get_holiday_calendar(  ) {
    $working_hours = get_field( 'working_hours', 'option' ) ? get_field( 'working_hours', 'option' ) : '';
    if ( ! $working_hours ) {
        return;
    }
    $days = [
            'monday'    => '1',
            'tuesday'   => '2',
            'wednesday' => '3',
            'thursday'  => '4',
            'friday'    => '5',
            'saturday'  => '6',
            'sunday'    => '0'
    ];
    $array = [];
    foreach ( $days as $day_key => $day_lvalue ) {
        if ( ! empty( $working_hours[ $day_key ]['from'] ) && ! empty( $working_hours[ $day_key ]['to'] ) ) {

            $array[ ] = $day_lvalue;
        }
    }
    return $array;
}
function get_working_hours( $working_hours , $mode = 'list' ) {
    if ( ! $working_hours ) {
        return;
    }

    $days = [
            'monday'    => 'Пн',
            'tuesday'   => 'Вт',
            'wednesday' => 'Ср',
            'thursday'  => 'Чт',
            'friday'    => 'Пт',
            'saturday'  => 'Сб',
            'sunday'    => 'Нд'
    ];

    $hours_by_day = [];
    foreach ( $days as $day_key => $day_label ) {
        if ( ! empty( $working_hours[ $day_key ]['from'] ) && ! empty( $working_hours[ $day_key ]['to'] ) ) {
            $hours                    = $working_hours[ $day_key ]['from'] . '-' . $working_hours[ $day_key ]['to'];
            $hours_by_day[ $day_key ] = [
                    'label' => $day_label,
                    'hours' => $hours
            ];
        }
    }

    $working_hours_list = '';
    $grouped_days       = [];
    $current_group      = [];
    $current_hours      = null;

    $ordered_days = array_keys( $days );
    foreach ( $ordered_days as $index => $day_key ) {
        $is_last_day = ( $index === count( $ordered_days ) - 1 );

        if ( isset( $hours_by_day[ $day_key ] ) ) {
            $hours = $hours_by_day[ $day_key ]['hours'];
            if ( $current_hours === null || $hours === $current_hours ) {
                $current_hours   = $hours;
                $current_group[] = $hours_by_day[ $day_key ]['label'];
            } else {
                if ( ! empty( $current_group ) ) {
                    $grouped_days[] = [
                            'days'  => $current_group,
                            'hours' => $current_hours
                    ];
                }
                $current_group = [ $hours_by_day[ $day_key ]['label'] ];
                $current_hours = $hours;
            }
        } else {
            if ( ! empty( $current_group ) ) {
                $grouped_days[] = [
                        'days'  => $current_group,
                        'hours' => $current_hours
                ];
            }
            $current_group = [];
            $current_hours = null;
        }

        // Завершуємо групу для останнього дня
        if ( $is_last_day && ! empty( $current_group ) ) {
            $grouped_days[] = [
                    'days'  => $current_group,
                    'hours' => $current_hours
            ];
        }
    }

    if($mode == 'list'){
        foreach ( $grouped_days as $group ) {
            if ( $group['hours'] ) {
                $day_range          = count( $group['days'] ) > 1 ? $group['days'][0] . '-' . end( $group['days'] ) : $group['days'][0];
                $working_hours_list .= '<li class="list-group-item bg-transparent border-0 p-0 d-flex align-items-center gap-2">';
                $working_hours_list .= '<img role="img" aria-label="clock" width="20" height="20" alt="clock" title="clock" src="' . esc_url( get_stylesheet_directory_uri() ) . '/images/clock-white.svg">';
                $working_hours_list .= '<span class="time">' . esc_html( $day_range ) . ' ' . esc_html( $group['hours'] ) . '</span>';
                $working_hours_list .= '</li>';
            }
        }

        if ( $working_hours_list ) {
            printf( '<ul class="working-hours list-group border-0 gap-3 list-group-horizontal flex-wrap">' . esc_html__( '%s', 'vitamed' ) . '</ul>', $working_hours_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }
    elseif ($mode == 'footer'){
        foreach ( $grouped_days as $group ) {
            if ( $group['hours'] ) {
                $day_range          = count( $group['days'] ) > 1 ? $group['days'][0] . '-' . end( $group['days'] ) : $group['days'][0];
                $working_hours_list .= '<li class="list-group-item bg-transparent text-white border-0 p-0 d-flex align-items-center gap-2">';
                $working_hours_list .= '<span class="time">' . esc_html( $day_range ) . ' ' . esc_html( $group['hours'] ) . '</span>';
                $working_hours_list .= '</li>';
            }
        }
        if ( $working_hours_list ) {
            printf( '<ul class="working-hours flex-column list-group border-0 gap-3 list-group-horizontal flex-wrap">' . esc_html__( '%s', 'vitamed' ) . '</ul>', $working_hours_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }
    else{
        foreach ( $grouped_days as $group ) {
            if ( $group['hours'] ) {
                $day_range          = count( $group['days'] ) > 1 ? $group['days'][0] . '-' . end( $group['days'] ) : $group['days'][0];
                $working_hours_list .= '<span class="time">' . esc_html( $day_range ) . ' ' . esc_html( $group['hours'] ) . '</span>';

            }
        }

        if ( $working_hours_list ) {
            printf(  esc_html__( '%s', 'vitamed' ) , $working_hours_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }

}


function get_working_hours_old( $working_hours ) {
    if($working_hours){
        $wh_monday = $working_hours['monday'];
        $monday_from = $wh_monday['from'];
        $monday_to = $wh_monday['to'];

        $wh_tuesday = $working_hours['tuesday'];
        $tuesday_from = $wh_tuesday['from'];
        $tuesday_to = $wh_tuesday['to'];

        $wh_wednesday = $working_hours['wednesday'];
        $wednesday_from = $wh_wednesday['from'];
        $wednesday_to = $wh_wednesday['to'];

        $wh_thursday = $working_hours['thursday'];
        $thursday_from = $wh_thursday['from'];
        $thursday_to = $wh_thursday['to'];

        $wh_friday = $working_hours['friday'];
        $friday_from = $wh_friday['from'];
        $friday_to = $wh_friday['to'];

        $wh_saturday = $working_hours['saturday'];
        $saturday_from = $wh_saturday['from'];
        $saturday_to = $wh_saturday['to'];

        $wh_sunday = $working_hours['sunday'];
        $sunday_from = $wh_sunday['from'];
        $sunday_to = $wh_sunday['to'];

        if ( $monday_from && $monday_to ) {
            $monday = esc_html( $monday_from . ' - ' . $monday_to );
        } else {
            $monday = '';
        }
        if ( $tuesday_from && $tuesday_to ) {
            $tuesday = esc_html( $tuesday_from . ' - ' . $tuesday_to );
        } else {
            $tuesday = '';
        }
        if ( $wednesday_from && $wednesday_to ) {
            $wednesday = esc_html( $wednesday_from . ' - ' . $wednesday_to );
        } else {
            $wednesday = '';
        }
        if ( $thursday_from && $thursday_to ) {
            $thursday = esc_html( $thursday_from . ' - ' . $thursday_to );
        } else {
            $thursday = '';
        }
        if ( $friday_from && $friday_to ) {
            $friday = esc_html( $friday_from . ' - ' . $friday_to );
        } else {
            $friday = '';
        }
        if ( $saturday_from && $saturday_to ) {
            $saturday = esc_html( $saturday_from . ' - ' . $saturday_to );
        } else {
            $saturday = '';
        }
        if ( $sunday_from && $sunday_to ) {
            $sunday = esc_html( $sunday_from . ' - ' . $sunday_to );
        } else {
            $sunday = '';
        }
        $working_hours_list = '';
        if ( $monday ) {
            $working_hours_list .= '<li class="list-group-item border-0 p-0 d-flex align-items-center gap-2">';
            $working_hours_list .= '<img role="img" aria-label="clock" width="20" height="20" alt="clock" title="clock" src="'. esc_url( get_stylesheet_directory_uri() ).'/images/clock-white.svg">';
            $working_hours_list .= '<span class="time">' . esc_html__( 'Пн', 'vitamed' ) . '' . esc_html( $monday ) . '</span>';
            $working_hours_list .= '</li>';
        }
        if ( $tuesday ) {
            $working_hours_list .= '<li class="list-group-item border-0 p-0 d-flex align-items-center gap-2">';
            $working_hours_list .= '<img role="img" aria-label="clock" width="20" height="20" alt="clock" title="clock" src="'. esc_url( get_stylesheet_directory_uri() ).'/images/clock-white.svg">';
            $working_hours_list .= '<span class="time">' . esc_html__( 'Вт', 'vitamed' ) . ' ' . esc_html( $tuesday ) . '</span>';
            $working_hours_list .= '</li>';
        }
        if ( $wednesday ) {
            $working_hours_list .= '<li class="list-group-item border-0 p-0 d-flex align-items-center gap-2">';
            $working_hours_list .= '<img role="img" aria-label="clock" width="20" height="20" alt="clock" title="clock" src="'. esc_url( get_stylesheet_directory_uri() ).'/images/clock-white.svg">';
            $working_hours_list .= '<span class="time">' . esc_html__( 'Ср', 'vitamed' ) . ' ' . esc_html( $wednesday ) . '</span>';
            $working_hours_list .= '</li>';
        }
        if ( $thursday ) {
            $working_hours_list .= '<li class="list-group-item border-0 p-0 d-flex align-items-center gap-2">';
            $working_hours_list .= '<img role="img"  aria-label="clock" width="20" height="20"  alt="clock" title="clock" src="'. esc_url( get_stylesheet_directory_uri() ).'/images/clock-white.svg">';
            $working_hours_list .= '<span class="time">' . esc_html__( 'Чт', 'vitamed' ) . ' ' . esc_html( $thursday ) . '</span>';
            $working_hours_list .= '</li>';
        }
        if ( $friday ) {
            $working_hours_list .= '<li class="list-group-item border-0 p-0 d-flex align-items-center gap-2">';
            $working_hours_list .= '<img role="img" aria-label="clock" width="20" height="20"  alt="clock" title="clock" src="'. esc_url( get_stylesheet_directory_uri() ).'/images/clock-white.svg">';
            $working_hours_list .= '<span class="time">' . esc_html__( 'Пн', 'vitamed' ) . ' ' . esc_html( $friday ) . '</span>';
            $working_hours_list .= '</li>';
        }
        if ( $saturday ) {
            $working_hours_list .= '<li class="list-group-item border-0 p-0 d-flex align-items-center gap-2">';
            $working_hours_list .= '<img role="img" aria-label="clock" width="20" height="20"  alt="clock" title="clock" src="'. esc_url( get_stylesheet_directory_uri() ).'/images/clock-white.svg">';
            $working_hours_list .= '<span class="time">' . esc_html__( 'Сб', 'vitamed' ) . ' ' . esc_html( $saturday ) . '</span>';
            $working_hours_list .= '</li>';
        }
        if ( $sunday ) {
            $working_hours_list .= '<li class="list-group-item border-0 p-0 d-flex align-items-center gap-2">';
            $working_hours_list .= '<img role="img" aria-label="clock" width="20" height="20"  alt="clock" title="clock" src="'. esc_url( get_stylesheet_directory_uri() ).'/images/clock-white.svg">';
            $working_hours_list .= '<span class="time">' . esc_html__( 'Нд', 'vitamed' ) . ' ' . esc_html( $sunday ) . '</span>';
            $working_hours_list .= '</li>';
        }
        if ( $working_hours_list ) {
            /* translators: %s: Working hours list */
            printf( '<ul class="working-hours list-group border-0 gap-3 list-group-horizontal flex-wrap">' . esc_html__( '%s', 'vitamed' ) . '</ul>', $working_hours_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }
}

function vitamed_posted_on() {
    $post = get_post();
    if ( ! $post ) {
        return;
    }

    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
    }

    $time_string = sprintf(
            $time_string,
            esc_attr( get_the_date( "d F, Y H:i" ) ),
            esc_html( get_the_date("d F, Y H:i") )
    );

    $posted_on = apply_filters(
            'understrap_posted_on',
            sprintf(
                    '<span class="posted-on d-flex gap-1"><img class="icon" width="20" height="20" role="img"  aria-label="date"
                                                 src="'. esc_url( get_stylesheet_directory_uri() ).'/images/clock-circle.svg"
                                                 alt="date" title="date">%1$s</span>', $time_string )
    );

    echo $posted_on;
}

function vitamed_post_nav() {
    global $post;
    if ( ! $post ) {
        return;
    }

    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );
    if ( ! $next && ! $previous ) {
        return;
    }
    ?>
    <nav class=" navigation post-navigation">
        <h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'understrap' ); ?></h2>
        <div class="d-flex nav-links justify-content-between  gap-4">
            <?php
            if ( get_previous_post_link() ) {
                $p = get_previous_post_link( '<span class="nav-previous">%link</span>',
                        __('Попередня новина', 'vitamed' ) );
                echo str_replace("<a ", '<a class="btn btn-primary" ', $p);
            }
            if ( get_next_post_link() ) {
                $n = get_next_post_link( '<span class="nav-next">%link</span>',
                        __( 'Наступна новина', 'vitamed' ) );
                echo str_replace("<a ", '<a class="btn btn-primary" ', $n);
            }
            ?>
        </div><!-- .nav-links -->
    </nav><!-- .post-navigation -->
    <?php
}

function vitamed_add_social_share_buttons() {

    global $post;
    if ( ! $post || 'post' !== get_post_type()) {
        return;
    }
    // Get the current page URL
    $url = esc_url(get_permalink());

    // Get the current page title
    $title = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));

    // Create an array of social networks and their respective sharing URLs
    $social_networks = array(
            'facebook.svg' => 'https://www.facebook.com/sharer/sharer.php?u=' . $url,
            'viber.svg' => "viber://forward?text=" . $title . ' ' . $url,
            'whatsapp.svg' => 'https://web.whatsapp.com/send?text=' .$title . ' ' . $url,
            'telegram.svg' => 'https://t.me/share/url?url=' . $url . '&text=' . $title,
    );

    // Initialize the share buttons HTML
    $share_buttons = '<div style="justify-self: start;"><div class="p-2 d-flex align-items-center bg-light rounded-pill"><span class="px-3">'. esc_html__( 'Поділитись', 'vitamed' ).'</span>';
    $share_buttons .= '<div class="social-share-buttons">';

    // Loop through the social networks and generate the share buttons HTML
    foreach ($social_networks as $network => $share_url) {
        $share_buttons .= '<a href="' . $share_url . '" target="_blank" rel="noopener"><img width="40" height="40" src="'. esc_url(get_stylesheet_directory_uri()).'/images/add-to-any/' . $network . '"></a>';
    }

    // Close the share buttons HTML
    $share_buttons .= '</div>';
    $share_buttons .= '</div></div>';



    return $share_buttons;
}

function get_short_form($flag = '') {

    $heading = 'h2';
    $title = get_field('title', 'option');
    $form_title = get_field('form_title', 'option');

    $shortcode = get_field('form_shortcode', 'option');
    $text = get_field('description', 'option');

    $theme_color = get_field( 'theme_color', 'option' ) ? get_field( 'theme_color', 'option' )  : '#4CD30E' ;
    ?>

    <section  class="contact-form-section section-wrapper wrapper <?php echo $flag == 'footer' ? 'py-0' : 'm-75'?> ">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 ">
                    <div class="bg-white rounded-3 p-5" >
                        <div class=" d-flex flex-wrap justify-content-between ">
                            <?php if ($title || $text) { ?>
                                <div class="px-2 py-md-3 col-12 col-md-6  col-lg-6 mb-3 mb-md-0 ">
                                    <svg role="img" aria-label="Info" width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="50" height="50" rx="15" fill="<?php echo $theme_color?>" fill-opacity="0.1"/>
                                        <path d="M22 27.2354V30.0001C22 32.7615 24.2386 35.0001 27 35.0001H27.8824C29.7691 35.0001 31.3595 33.7311 31.8465 32.0001" stroke="<?php echo $theme_color?>" stroke-width="2"/>
                                        <path d="M18.4286 16H18.3369C18.024 16 17.8676 16 17.7357 16.0117C16.2876 16.1397 15.1397 17.2876 15.0117 18.7357C15 18.8676 15 19.024 15 19.3369V20.2353C15 24.1013 18.134 27.2353 22 27.2353C25.7082 27.2353 28.7143 24.2292 28.7143 20.521V19.3369C28.7143 19.024 28.7143 18.8676 28.7026 18.7357C28.5746 17.2876 27.4267 16.1397 25.9785 16.0117C25.8467 16 25.6902 16 25.3774 16H25.2857" stroke="<?php echo $theme_color?>" stroke-width="2" stroke-linecap="round"/>
                                        <circle cx="32" cy="29" r="3" stroke="<?php echo $theme_color?>" stroke-width="2"/>
                                        <path d="M25 15V17" stroke="<?php echo $theme_color?>" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M19 15V17" stroke="<?php echo $theme_color?>" stroke-width="2" stroke-linecap="round"/>
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
    </section>
<?php
}

