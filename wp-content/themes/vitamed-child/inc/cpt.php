<?php

defined( 'ABSPATH' ) || exit;

function mp_post_type_register() {

    //Articles

    $labels = array(
        'name'                  => _x( 'Статті', 'Post Type General Name', 'med-portal' ),
        'singular_name'         => _x( 'Стаття', 'Post Type Singular Name', 'med-portal' ),
        'menu_name'             => __( 'Статті', 'med-portal' ),
        'name_admin_bar'        => __( 'Статті', 'med-portal' ),
    );

    $args = array(
        'label'               => __( 'Articles', 'med-portal' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'  => true,
        'menu_position'       => 5,
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );

    //register_post_type( 'articles', $args );


    //Doctors

    $labels = array(
        'name'                  => _x( 'Лікарі', 'Post Type General Name', 'med-portal' ),
        'singular_name'         => _x( 'Лікар', 'Post Type Singular Name', 'med-portal' ),
        'menu_name'             => __( 'Лікарі', 'med-portal' ),
        'name_admin_bar'        => __( 'Лікарі', 'med-portal' ),

    );

    $args = array(
        'label'               => __( 'Лікарі', 'med-portal' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'  => true,
        'menu_position'       => 5,
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );

    register_post_type( 'doctors', $args );


    //Services

    $labels = array(
        'name'                  => _x( 'Сервіси на полсуги', 'Post Type General Name', 'med-portal' ),
        'singular_name'         => _x( 'Сервіси на полсуги', 'Post Type Singular Name', 'med-portal' ),
        'menu_name'             => __( 'Сервіси на полсуги', 'med-portal' ),
        'name_admin_bar'        => __( 'Сервіси на полсуги', 'med-portal' ),
    );

    $args = array(
        'label'               => __( 'Сервіси на полсуги', 'med-portal' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'  => true,
        'menu_position'       => 5,
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );

    register_post_type( 'service', $args );

    //Testimonials

    $labels = array(
        'name'                  => _x( 'Відгуки', 'Post Type General Name', 'med-portal' ),
        'singular_name'         => _x( 'Відгук', 'Post Type Singular Name', 'med-portal' ),
        'menu_name'             => __( 'Відгуки', 'med-portal' ),
        'name_admin_bar'        => __( 'Відгуки', 'med-portal' ),

    );

    $args = array(
        'label'               => __( 'Відгуки', 'med-portal' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'custom-fields' ),
        'hierarchical'        => false,
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_rest'  => false,
        'menu_position'       => 5,
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );

    register_post_type( 'testimonials', $args );

}

add_action( 'init', 'mp_post_type_register', 0 );
// Register Custom Post Type



function mp_create_taxonomy() {

    // Category article

    $labels = array(
        'name'              => _x( 'Category article', 'taxonomy general name', 'med-portal' ),
        'singular_name'     => _x( 'Category article', 'taxonomy singular name', 'med-portal' ),
        'search_items'      => __( 'Search Category article', 'med-portal' ),
        'all_items'         => __( 'All Category article', 'med-portal' ),
        'parent_item'       => __( 'Parent Category article', 'med-portal' ),
        'parent_item_colon' => __( 'Parent Category article:', 'med-portal' ),
        'edit_item'         => __( 'Edit Category article', 'med-portal' ),
        'update_item'       => __( 'Update Category article', 'med-portal' ),
        'add_new_item'      => __( 'Add New Category article', 'med-portal' ),
        'new_item_name'     => __( 'New Category article Name', 'med-portal' ),
        'menu_name'         => __( 'Category article', 'med-portal' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_in_rest'  => true,
        'publicly_queryable'           => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'category-article' ),
    );

    register_taxonomy( 'category-article', array( 'articles' ), $args );


    // Type article

    $labels = array(
        'name'              => _x( 'Type article', 'taxonomy general name', 'med-portal' ),
        'singular_name'     => _x( 'Type article', 'taxonomy singular name', 'med-portal' ),
        'search_items'      => __( 'Search Type article', 'med-portal' ),
        'all_items'         => __( 'All Type article', 'med-portal' ),
        'parent_item'       => __( 'Parent Type article', 'med-portal' ),
        'parent_item_colon' => __( 'Parent Type article:', 'med-portal' ),
        'edit_item'         => __( 'Edit Type article', 'med-portal' ),
        'update_item'       => __( 'Update Type article', 'med-portal' ),
        'add_new_item'      => __( 'Add New Type article', 'med-portal' ),
        'new_item_name'     => __( 'New Type article Name', 'med-portal' ),
        'menu_name'         => __( 'Type article', 'med-portal' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_in_rest'  => true,
        'publicly_queryable'           => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'type-article' ),
    );

    register_taxonomy( 'type-article', array( 'articles' ), $args );


    // Languages

    $labels = array(
        'name'              => _x( 'Languages', 'taxonomy general name', 'med-portal' ),
        'singular_name'     => _x( 'Languages', 'taxonomy singular name', 'med-portal' ),
        'search_items'      => __( 'Search Languages', 'med-portal' ),
        'all_items'         => __( 'All Languages', 'med-portal' ),
        'parent_item'       => __( 'Parent Languages', 'med-portal' ),
        'parent_item_colon' => __( 'Parent Languages:', 'med-portal' ),
        'edit_item'         => __( 'Edit Languages', 'med-portal' ),
        'update_item'       => __( 'Update Languages', 'med-portal' ),
        'add_new_item'      => __( 'Add New Languages', 'med-portal' ),
        'new_item_name'     => __( 'New Languages Name', 'med-portal' ),
        'menu_name'         => __( 'Languages', 'med-portal' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_in_rest'  => true,
        'publicly_queryable'           => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'languages' ),
    );

    register_taxonomy( 'languages', array( 'doctors' ), $args );

    // Specialization

    $labels = array(
        'name'              => _x( 'Specialization', 'taxonomy general name', 'med-portal' ),
        'singular_name'     => _x( 'Specialization', 'taxonomy singular name', 'med-portal' ),
        'search_items'      => __( 'Search Specialization', 'med-portal' ),
        'all_items'         => __( 'All Specialization', 'med-portal' ),
        'parent_item'       => __( 'Parent Specialization', 'med-portal' ),
        'parent_item_colon' => __( 'Parent Specialization:', 'med-portal' ),
        'edit_item'         => __( 'Edit Specialization', 'med-portal' ),
        'update_item'       => __( 'Update Specialization', 'med-portal' ),
        'add_new_item'      => __( 'Add New Specialization', 'med-portal' ),
        'new_item_name'     => __( 'New Specialization Name', 'med-portal' ),
        'menu_name'         => __( 'Specialization', 'med-portal' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_in_rest'  => true,
        'publicly_queryable'           => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'specialization' ),
    );

    //register_taxonomy( 'specialization', array( 'doctors' ), $args );

    // Specialty

    $labels = array(
        'name'              => _x( 'Specialty', 'taxonomy general name', 'med-portal' ),
        'singular_name'     => _x( 'Specialty', 'taxonomy singular name', 'med-portal' ),
        'search_items'      => __( 'Search Specialty', 'med-portal' ),
        'all_items'         => __( 'All Specialty', 'med-portal' ),
        'parent_item'       => __( 'Parent Specialty', 'med-portal' ),
        'parent_item_colon' => __( 'Parent Specialty:', 'med-portal' ),
        'edit_item'         => __( 'Edit Specialty', 'med-portal' ),
        'update_item'       => __( 'Update Specialty', 'med-portal' ),
        'add_new_item'      => __( 'Add New Specialty', 'med-portal' ),
        'new_item_name'     => __( 'New Specialty Name', 'med-portal' ),
        'menu_name'         => __( 'Specialty', 'med-portal' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_in_rest'  => true,
        'publicly_queryable'           => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'specialty' ),
    );

    register_taxonomy( 'specialty', array( 'doctors' ), $args );

    // qualification

    $labels = array(
        'name'              => _x( 'Посада та науковий ступінь', 'taxonomy general name', 'med-portal' ),
        'singular_name'     => _x( 'Посада та науковий ступінь', 'taxonomy singular name', 'med-portal' ),
        'search_items'      => __( 'Search Qualification', 'med-portal' ),
        'all_items'         => __( 'All Qualification', 'med-portal' ),
        'parent_item'       => __( 'Parent Qualification', 'med-portal' ),
        'parent_item_colon' => __( 'Parent Qualification:', 'med-portal' ),
        'edit_item'         => __( 'Edit Qualification', 'med-portal' ),
        'update_item'       => __( 'Update Qualification', 'med-portal' ),
        'add_new_item'      => __( 'Add New Qualification', 'med-portal' ),
        'new_item_name'     => __( 'New Qualification Name', 'med-portal' ),
        'menu_name'         => __( 'Qualification', 'med-portal' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_in_rest'  => true,
        'publicly_queryable' => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'qualification' ),
    );

    register_taxonomy( 'qualification', array( 'doctors' ), $args );






}
add_action( 'init', 'mp_create_taxonomy', 0 );
// Register Custom Taxonomy