<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <?php
    // ACF - Flexible Content fields.
    $sections = get_field( 'service_sections' );

    if ( $sections ) :
        foreach ( $sections as $key => $section ) :
            $template = str_replace( '_', '-', $section['acf_fc_layout'] );
            get_template_part( 'flexible-content/sections/' . $template, '', array('key' => $key, 'section' => $section)  );
        endforeach;
    endif;
    ?>



</article><!-- #post-<?php the_ID(); ?> -->


