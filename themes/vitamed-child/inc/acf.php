<?php

defined( 'ABSPATH' ) || exit;


add_action( 'acf/init', function () {
    if ( function_exists( 'acf_add_options_page' ) ) {

        acf_add_options_page( array(
            'page_title' => __( 'Загальні налаштування теми', 'med-portal' ),
            'menu_title' => __( 'Налаштування теми', 'med-portal' ),
            'menu_slug'  => 'theme-general-settings',
            'capability' => 'edit_posts',
            'redirect'   => false
        ) );

    }
} );