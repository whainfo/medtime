<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_filter( 'upload_mimes', function ( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';

    return $mimes;
} );
function understrap_all_excerpts_get_more_link( $post_excerpt ) {
    if ( is_admin() || ! get_the_ID() ) {
        return $post_excerpt;
    }

    return $post_excerpt;

}

function vitamed_custom_excerpt_length( $length ) {
    return 20;
}

add_filter( 'excerpt_length', 'vitamed_custom_excerpt_length', 999 );


add_filter( 'use_block_editor_for_post', function ( $use_block_editor, $post ) {

    if ( get_page_template_slug( $post ) === 'flexible-content-page.php' ) {
        return false;
    }

    return $use_block_editor;
}, 10, 2 );

function vitamed_generate_schema( $schema ) {
    $address_group = get_field( 'address', 'option' );
    $address_string        = $address_group ? $address_group['locality'] .' '. $address_group['street_address'] : '';
    $email         = get_field( 'email', 'option' )?: '';
    $site_image_url         = get_field( 'site_image_url', 'option' )?: '';
    $phone         = get_field( 'phone', 'option' )?: '';
    $working_hours = get_field( 'working_hours', 'option' )?: '';
    $social_group  = get_field( 'social', 'option' )?: '';
    $site_description  = get_field( 'site_description', 'option' )?: '';
    $map_link      = get_field( 'map_link', 'option' ) ? get_field( 'map_link', 'option' ) : '';

    if ( is_front_page() ) {

        $address = array();
        if ( $address_group ) {
            $address = array(
                "@type"           => "PostalAddress",
                "streetAddress"   => $address_group['street_address'],
                "addressLocality" => $address_group['locality'],
                "addressCountry"  => $address_group['country_name'],
                "postalCode"      => $address_group['postal_code']
            );
        }
        $GeoCoordinates = array(
            "@type"     => "GeoCoordinates",
            "latitude"  => 50.4501,
            "longitude" => 30.5234
        );

        $openingHoursSpecification = array();
        if ( $working_hours ) {
            $days = [
                'monday'    => 'Monday',
                'tuesday'   => 'Tuesday',
                'wednesday' => 'Wednesday',
                'thursday'  => 'Thursday',
                'friday'    => 'Friday',
                'saturday'  => 'Saturday',
                'sunday'    => 'Sunday'
            ];

            foreach ( $days as $key => $day ) {
                $from = $working_hours[ $key . '_from' ];
                $to   = $working_hours[ $key . '_to' ];

                if ( $from && $to ) {
                    $openingHoursSpecification[] = array(
                        "@type"     => "OpeningHoursSpecification",
                        "dayOfWeek" => $day,
                        "opens"     => $from,
                        "closes"    => $to
                    );
                }
            }
        }

        $sameAs = array();
        if ( $social_group ) {
            $social_item = [
                'facebook'  => 'facebook',
                'instagram' => 'instagram',
                'youtube'   => 'youtube',
                'twitter'   => 'twitter',
                'linkedin'  => 'linkedin'
            ];
            foreach ( $social_item as $value ) {
                if ( isset( $social_group[ $value ] ) ) {
                    $sameAs[] = $social_group[ $value ];
                }
            }
        }
        $hasMap = '';
        if($map_link){
            $hasMap = esc_url( $map_link ) ;
        }
        elseif ($address){
            $hasMap =   esc_url( 'https://www.google.com/maps/place/'.str_replace(" ", "+", $address_string) ) ;
        }

$aggregateRating = array(
            "@type"       => "AggregateRating",
            "ratingValue" => "4.8",
            "reviewCount" => "132"
        );

        $args = array( 'posts_per_page' => -1, 'post_type' => 'service' , 'post_status' => 'publish' );
        $postslist = get_posts( $args );
        $department = array();
        $medicalSpecialty = array();
        if ( $postslist ) {
            foreach ( $postslist as $post ) {
                $medicalSpecialty[] = get_the_title( $post->ID );
                $department[] = array(
                    "@type" => "MedicalClinic",
                    "name"  => get_the_title( $post->ID ),
                    "url"   => get_the_permalink( $post->ID ),
                );
            }
        }
        $schema_home = array(
            "@context"                  => "http://schema.org",
            "@type"                     => "MedicalClinic",
            "@id"                       => get_the_permalink() . "#clinic",
            "name"                      => get_bloginfo( 'name' ),
            "url"                       => get_the_permalink(),
            "image"                     => $site_image_url,
            "description"               => $site_description,
            "telephone"                 => $phone,
            "email"                     => $email,
            "priceRange"                => "₴₴",
            "medicalSpecialty"          => $medicalSpecialty,
            "address"                   => $address,
            "geo"                       => $GeoCoordinates,
            "openingHoursSpecification" => $openingHoursSpecification,
            'sameAs'                    => $sameAs,
            "department"                => $department,
            "hasMap"                    => $hasMap,
            "aggregateRating"           => $aggregateRating,

        );


        echo '<script type="application/ld+json">' . json_encode( $schema_home, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE ) . '</script>';
    }

    $schema_search = array(
        "@context"        => "http://schema.org",
        "@type"           => "WebSite",
        "url"             => get_home_url(),
        "name"            => get_bloginfo( 'name' ),
        "description"     => $site_description,
        "potentialAction" => array(
            "@type"       => "SearchAction",
            "target"      => get_home_url() . "/?s={search_term_string}",
            "query-input" => "required name=search_term_string"
        )
    );

    echo '<script type="application/ld+json">' . json_encode( $schema_search, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE ) . '</script>';



}

add_action( 'wp_footer', 'vitamed_generate_schema', 100 );


add_action('admin_init', function () {
    register_setting('general', 'site_slug', [
        'type' => 'string',
        'sanitize_callback' => 'sanitize_title',
        'default' => '',
    ]);

    add_settings_field(
        'site_slug',
        __('Site Slug', 'understrap'),
        function () {
            $value = get_option('site_slug', '');
            echo '<input type="text" id="site_slug" name="site_slug" value="' . esc_attr($value) . '" class="regular-text" />';
            echo '<p class="description">' . __('Enter a short slug/identifier for this site.', 'understrap') . '</p>';
        },
        'general',
        'default'
    );
});

add_filter('use_block_editor_for_post', '__return_false');


add_filter( 'tiny_mce_before_init', 'vitamed_mce_before_init' );
function vitamed_mce_before_init( $settings ) {

    $style_formats = array(
        array(
            'title' => 'Ul 2 columns',
            'selector' => 'ul',
            'classes' => 'columns-2',
        )
    );
    $settings['style_formats'] = json_encode( $style_formats );
    return $settings;
}

function my_mce_add_download_button() {
    // Підключаємо медіа-бібліотеку WordPress
    wp_enqueue_media();

    // Реєструємо JS для TinyMCE
    add_filter('mce_external_plugins', function($plugin_array) {
        $plugin_array['my_download_btn'] = get_stylesheet_directory_uri() . '/js/mce-download-btn.js';
        return $plugin_array;
    });

    add_filter('mce_buttons', function($buttons) {
        // Додаємо власну кнопку у панель
        array_push($buttons, 'my_download_btn');
        return $buttons;
    });
}
//add_action('admin_init', 'my_mce_add_download_button');


function wha_booking_add_doctor_schedule_metabox() {
    add_meta_box(
        'wha_doctor_schedule',
        esc_html__('Графік лікаря', 'wha-online-booking'),
        'wha_booking_doctor_schedule_metabox_callback',
        'doctors',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'wha_booking_add_doctor_schedule_metabox');

/**
 *
 * @param WP_Post $post
 */
function wha_booking_doctor_schedule_metabox_callback($post) {
    wp_nonce_field('wha_booking_doctor_schedule_nonce', 'wha_doctor_schedule_nonce');
    $schedule = get_post_meta($post->ID, 'wha_doctor_schedule', true);
    $schedule = $schedule ? json_decode($schedule, true) : [
        'start_time' => '',
        'end_time' => '',
        'interval_minutes' => '30',
        'max_appointments' => '10',
        'holidays' => ''
    ];
    ?>
    <div class="form-group">
        <label for="wha-doctor-start"><?php esc_html_e('Час початку:', 'wha-online-booking'); ?></label>
        <input type="time" name="wha_doctor_schedule[start_time]" id="wha-doctor-start" value="<?php echo esc_attr($schedule['start_time']); ?>">
    </div>
    <div class="form-group">
        <label for="wha-doctor-end"><?php esc_html_e('Час закінчення:', 'wha-online-booking'); ?></label>
        <input type="time" name="wha_doctor_schedule[end_time]" id="wha-doctor-end" value="<?php echo esc_attr($schedule['end_time']); ?>">
    </div>
    <div class="form-group">
        <label for="wha-doctor-interval"><?php esc_html_e('Інтервал (хвилини):', 'wha-online-booking'); ?></label>
        <select name="wha_doctor_schedule[interval_minutes]" id="wha-doctor-interval">
            <option value="15" <?php selected($schedule['interval_minutes'], 15); ?>>15</option>
            <option value="30" <?php selected($schedule['interval_minutes'], 30); ?>>30</option>
            <option value="60" <?php selected($schedule['interval_minutes'], 60); ?>>60</option>
        </select>
    </div>
    <div class="form-group">
        <label for="wha-doctor-max"><?php esc_html_e('Максимальна кількість записів на день:', 'wha-online-booking'); ?></label>
        <input type="number" name="wha_doctor_schedule[max_appointments]" id="wha-doctor-max" value="<?php echo esc_attr($schedule['max_appointments']); ?>">
    </div>
    <div class="form-group">
        <label for="wha-doctor-holidays"><?php esc_html_e('Вихідні/перерви:', 'wha-online-booking'); ?></label>
        <textarea name="wha_doctor_schedule[holidays]" id="wha-doctor-holidays" placeholder="<?php esc_attr_e('Введіть дати (РРРР-ММ-ДД) або діапазони, по одній на рядок', 'wha-online-booking'); ?>"><?php echo esc_textarea($schedule['holidays']); ?></textarea>
    </div>
    <?php
}

/**
 *
 * @param int $post_id
 */
function wha_booking_save_doctor_schedule($post_id) {
    if (!isset($_POST['wha_doctor_schedule_nonce']) || !wp_verify_nonce($_POST['wha_doctor_schedule_nonce'], 'wha_booking_doctor_schedule_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['wha_doctor_schedule'])) {
        $schedule = [
            'start_time' => sanitize_text_field($_POST['wha_doctor_schedule']['start_time']),
            'end_time' => sanitize_text_field($_POST['wha_doctor_schedule']['end_time']),
            'interval_minutes' => absint($_POST['wha_doctor_schedule']['interval_minutes']),
            'max_appointments' => absint($_POST['wha_doctor_schedule']['max_appointments']),
            'holidays' => sanitize_textarea_field($_POST['wha_doctor_schedule']['holidays'])
        ];
        update_post_meta($post_id, 'wha_doctor_schedule', wp_json_encode($schedule));
    }
}
add_action('save_post_doctors', 'wha_booking_save_doctor_schedule');

add_action( 'login_head', 'vitamed_change_login_logo' );

function vitamed_change_login_logo() {
    echo '<style>
	#login h1 a{
		background-image : url(' . get_stylesheet_directory_uri() . '/images/wha-logo.png);
	}
	</style>';
}
add_filter( 'login_headerurl', 'vitamed_login_link_to_website' );

function vitamed_login_link_to_website( $url ) {
    return 'https://webhelpagency.com/';
}

// Додаємо "Меню" окремо для редактора
function add_editor_menu_page() {
    if (current_user_can('editor')) {
        add_menu_page(
                __('Меню', 'textdomain'),
                __('Меню', 'textdomain'),
                'edit_pages',
                'editor-nav-menus',
                'editor_nav_menu_page',
                'dashicons-menu',
                61
        );
    }
}
add_action('admin_menu', 'add_editor_menu_page', 5);


function editor_nav_menu_page() {

    if (!current_user_can('edit_theme_options')) {

        $GLOBALS['submenu']['themes.php'][] = array(__('Меню', 'textdomain'), 'edit_pages', 'nav-menus.php');
    }
    require_once(ABSPATH . 'wp-admin/nav-menus.php');
}

function hide_appearance_for_editor() {
    if (current_user_can('editor')) {
        remove_menu_page('themes.php');
    }
}
add_action('admin_menu', 'hide_appearance_for_editor', 999);

function remove_editor_theme_cap() {
    $role = get_role('editor');
    if ($role) {
        $role->add_cap('edit_theme_options');
    }
}
add_action('init', 'remove_editor_theme_cap');
function custom_remove_admin_menus() {

    if (current_user_can('editor')) {
        remove_menu_page('tools.php');
        remove_menu_page('edit-comments.php');
        remove_menu_page('wpcf7');
        remove_submenu_page('sib_admin_page', 'sib_page_home');
        remove_menu_page('sib_page_home');
    }
}
add_action('admin_menu', 'custom_remove_admin_menus', 9999);

add_filter( 'wpcf7_contact_form_properties', 'modify_email_author' );

function modify_email_author( $properties ) {
    $submission = WPCF7_Submission::get_instance();

    if ( ! $submission ) {
        return $properties;
    }

    $email = get_field( 'email', 'option' );

    if ( ! ( $email && is_email( $email ) ) ) {
        return $properties;
    }

    $properties['mail']['recipient'] = $email;//help@vitamed.com

    return $properties;
}

function vitamed_unregister_tags() {
    unregister_taxonomy_for_object_type( 'post_tag', 'post' );
}
add_action( 'init', 'vitamed_unregister_tags' );

add_action( 'admin_bar_menu', function( $wp_admin_bar ) {
    if ( current_user_can( 'editor' ) ) {
        $wp_admin_bar->remove_node( 'customize' );
        $wp_admin_bar->remove_node( 'comments' );
    }
}, 999 );
