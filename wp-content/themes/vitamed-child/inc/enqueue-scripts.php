<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

    // Get the theme data.
    $the_theme     = wp_get_theme();
    $theme_version = $the_theme->get( 'Version' );

    $suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
    // Grab asset urls.
    $theme_styles  = "/css/child-theme{$suffix}.css";
    $theme_scripts = "/js/child-theme{$suffix}.js";

    $css_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_styles );

    wp_enqueue_style( 'vitamed-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $css_version );
    wp_enqueue_style( 'custom-styles', get_stylesheet_directory_uri() . '/css/custom.css', array(), $css_version );
    wp_enqueue_script( 'jquery' );

    $js_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_scripts );

    // map assets
    wp_enqueue_style('leaflet-styles', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css', [], '1.9.4');
    wp_enqueue_script('leaflet-scripts', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', [], '1.9.4', true);


    wp_enqueue_script( 'vitamed-scripts', get_stylesheet_directory_uri() . $theme_scripts, array('jquery' ), $js_version, true );
    // localize address for the map
    $address_group       = get_field( 'address', 'option' ) ?: '';
    $address        = $address_group ? $address_group['locality'] .' '. $address_group['street_address'] : '';
    $location       = get_bloginfo('name') ;
    wp_localize_script('vitamed-scripts', 'VitamedVar', [
        'address' => (string)($address ?: ''),
        'markerTitle' => (string)($location?: 'Location'),
    ]);


    //Slider
    wp_enqueue_style(
        'slider-swiper-bundle-styles',
         'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        [],
        '1.0.0'
    );
    wp_enqueue_script(
        'slider-swiper-bundle-scripts',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        ['jquery'],
        '1.0.0', true
    );

    //fancybox
    wp_enqueue_style(
        'fancybox-styles',
        'https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.0/dist/fancybox/fancybox.css',
        [],
        '6.0.0'
    );
    wp_enqueue_script(
        'fancybox-scripts',
        'https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.0/dist/fancybox/fancybox.umd.js',
        ['jquery'],
        '6.0.0', true
    );

    wp_enqueue_style(
        'aos-styles',
        'https://unpkg.com/aos@next/dist/aos.css',
        [],
        '1.0.0'
    );
    wp_enqueue_script(
        'aos-scripts',
        'https://unpkg.com/aos@next/dist/aos.js',
        ['jquery'],
        '1.0.0', true
    );

    // Register the script and style
    wp_register_style(
        'vanillajs-datepicker',
        'https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.4/dist/css/datepicker-bs5.min.css',
        [],
        '1.3.4',
    );
    wp_register_script(
        'vanillajs-datepicker',
         'https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.4/dist/js/datepicker.min.js',
        array('jquery'),
        '1.3.4',
        true
    );
    wp_register_script(
        'vanillajs-datepicker-locales-uk',
         'https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.3.4/dist/js/locales/uk.js',
        array('jquery'),
        '1.3.4',
        true
    );
    wp_register_script(
        'custom-datepicker',
        get_stylesheet_directory_uri() .'/js/custom-datepicker.js',
        array('jquery'),
        '1.3.4',
        true
    );

    wp_enqueue_script( 'custom-scripts', get_stylesheet_directory_uri() . "/js/custom.js", array('jquery' ), $js_version, true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    if ( is_singular( 'doctors' ) ) {
        
        wp_enqueue_style( 'vanillajs-datepicker' );
        wp_enqueue_script( 'vanillajs-datepicker' );
        wp_enqueue_script( 'vanillajs-datepicker-locales-uk' );
        wp_enqueue_script( 'custom-datepicker' );

        $my_data_array = array(
            'daysOfWeekDisabled' => get_holiday_calendar(),
        );


        // Localize the script with your data
        wp_localize_script( 'custom-datepicker', 'vitamedGlobalVars', $my_data_array );
    }
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Loads javascript for showing customizer warning dialog.
 */
function vitamed_customize_controls_js() {
    wp_enqueue_script(
        'understrap_child_customizer',
        get_stylesheet_directory_uri() . '/js/customizer-controls.js',
        array( 'customize-preview' ),
        '20130508',
        true
    );
}
add_action( 'customize_controls_enqueue_scripts', 'vitamed_customize_controls_js' );

add_action( 'admin_enqueue_scripts', 'vitamed_load_admin_styles' );
function vitamed_load_admin_styles() {
    wp_enqueue_style( 'admin_css', get_stylesheet_directory_uri() . '/css/admin.css', [], '1.0.0' );

}
