<?php
/**
 * ACF: Flexible Content > Layouts > News
 *
 * @package WordPress
 * @subpackage QORP
 */

$key = $args['key'] ? $args['key'] : 0;
$aos_delay = 0;
if($key > 0){
    $aos_delay = 300;
}
$heading = $args['section']['heading'] ? $args['section']['heading'] : 'h2';
$title   = $args['section']['title'];


$theme_color = get_field( 'theme_color', 'option' ) ? get_field( 'theme_color', 'option' ) : '#4CD30E';

$items = $args['section']['news'];
?>

<section class="news-section section-wrapper wrapper">
    <div class="container">
        <div class="row mb-4 justify-content-between align-items-center gy-3 " data-aos="fade-up"  data-aos-delay="<?php echo $aos_delay; ?>">
            <div class="col">
                <?php if ( $title ) { ?>
                    <?php
                    printf(
                            __( '<%1$s class=" title section-title">%2$s</%1$s>  ' ),
                            esc_html( $heading ),
                            esc_html( $title ),

                    ); ?>
                <?php } ?>
            </div>
            <div class="col-auto">
                <a class="btn btn-secondary"
                   href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">
                    <?php esc_html_e( 'Всі новини', 'vitamed' ); ?></a>
            </div>
        </div>
        <div class="row gy-4">
            <div class="col-12 ">
                <?php if ( $items ) { ?>
                    <div class="news-grid">
                        <?php foreach ( $items as $k=> $p_id ):
                            $aos_delay += $k * 200;
                            ?>
                            <div class=" bg-white overflow-hidden  bg-white rounded-3"   data-aos="fade-up"  data-aos-delay="<?php echo $aos_delay; ?>">
                                <div class="d-flex flex-column flex-md-row h-100" >
                                    <div class="p-3  col-md-6 ">
                                        <div class="overflow-hidden rounded-2 image-wrapper" style="">
                                            <?php if ( has_post_thumbnail( $p_id ) ) { ?>
                                                <?php echo get_the_post_thumbnail( $p_id, 'large' ); ?>
                                            <?php } else { ?>
                                                <img class=""
                                                     src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/placeholder.png"
                                                     alt="placeholder"
                                                     title="placeholder">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="content-wrapper col-md-6  p-4">

                                        <h3 class="title "><?php echo esc_html( get_the_title( $p_id ) ); ?></h3>

                                        <?php add_filter( 'excerpt_length', 'vitamed_custom_excerpt_length', 999 ); ?>
                                        <div class="content "><?php echo get_the_excerpt( $p_id ); ?></div>
                                        <?php remove_filter( 'excerpt_length', 'vitamed_custom_excerpt_length', 999 ); ?>

                                        <div class="cta ">
                                            <a class="btn btn-primary"
                                               href="<?php echo esc_url( get_permalink( $p_id ) ) ?>">
                                                <?php esc_html_e( 'Читати', 'vitamed' ); ?></a>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section><!-- testemonials-section -->