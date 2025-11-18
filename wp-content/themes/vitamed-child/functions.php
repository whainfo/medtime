<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;




/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'vitamed', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );
function add_child_theme_menu() {
    register_nav_menus(
        array(
            'colophon' => __( 'Colophon Menu', 'understrap' ),
        )
    );
}
add_action( 'after_setup_theme', 'add_child_theme_menu' );




/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function understrap_default_bootstrap_version() {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );



$file_scripts = get_stylesheet_directory() . '/inc/enqueue-scripts.php';

if (file_exists($file_scripts)) {
    require_once $file_scripts;
}


$file_function = get_stylesheet_directory() . '/inc/function.php';

if (file_exists($file_function)) {
    require_once $file_function;
}

$file_cpt = get_stylesheet_directory() . '/inc/cpt.php';

if (file_exists($file_cpt)) {
    require_once $file_cpt;
}

$file_acf = get_stylesheet_directory() . '/inc/acf.php';

if (file_exists($file_acf)) {
    require_once $file_acf;
}

$file_helper = get_stylesheet_directory() . '/inc/helper.php';

if (file_exists($file_helper)) {
    require_once $file_helper;
}
$rest_api = get_stylesheet_directory() . '/inc/rest-api.php';

if (file_exists($rest_api)) {
    require_once $rest_api;
}

$developer = get_stylesheet_directory() . '/inc/developer.php';

if (file_exists($developer)) {
    require_once $developer;
}
$cf7 = get_stylesheet_directory() . '/inc/cf7.php';

if (file_exists($cf7)) {
    require_once $cf7;
}


