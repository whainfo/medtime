<?php
/**
 * ACF: Flexible Content > Layouts > Services
 *
 * @package WordPress
 * @subpackage QORP
 */

$key       = $args['key'] ? $args['key'] : 0;
$aos_delay = 0;
if ( $key > 0 ) {
    $aos_delay = 300;
}
$heading = $args['section']['heading'] ? $args['section']['heading'] : 'h2';
$title   = $args['section']['title'];
$text    = $args['section']['text'];

$items = $args['section']['services'];
?>

<section class="services-section section-wrapper wrapper">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-4 col-xl-3" data-aos="fade-up" data-aos-delay="<?php echo $aos_delay; ?>">
                <?php if ( $title ) { ?>
                    <?php
                    printf(
                            __( '<%1$s class=" title mb-4 section-title">%2$s</%1$s>  ' ),
                            esc_html( $heading ),
                            esc_html( $title ),

                    ); ?>
                <?php } ?>

                <?php if ( $text ) : ?>
                    <div class="content fs-6 mb-4"><?php echo $text ?></div>
                <?php endif; ?>
                <div class="position-relative text-center swiper-buttons d-flex gap-2">
                    <div class="swiper-button-prev services"></div>
                    <div class="swiper-button-next services"></div>

                </div>

            </div>
            <div class="col-md-8 col-xl-9 services-swiper slider-swiper overflow-hidden">
                <?php if ( $items ) { ?>
                    <div class="swiper-wrapper">
                        <?php foreach ( $items as $k => $p_id ):
                            $aos_delay += $k * 200;
                            $description = get_field( 'description', $p_id );
                            $icon = get_field( 'icon', $p_id );
                            ?>
                            <div class="swiper-slide  bg-white overflow-hidden " data-aos="fade-up"
                                 data-aos-delay="<?php echo $aos_delay; ?>">
                                <div class="overflow-hidden  image-wrapper ">
                                    <?php if ( has_post_thumbnail( $p_id ) ) { ?>
                                        <?php echo get_the_post_thumbnail( $p_id, 'large' ); ?>
                                    <?php } else { ?>
                                        <img class=""
                                             src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/placeholder.png"
                                             alt="placeholder"
                                             title="placeholder">
                                    <?php } ?>
                                </div>
                                <div class="content-wrapper ">
                                    <h3 class="title "><?php echo esc_html( get_the_title( $p_id ) ); ?><span
                                                class="text-secondary">.</span></h3>
                                    <div class="content ">
                                        <?php if ( $description ) { ?>
                                            <p>
                                                <?php echo $description; ?>
                                            </p>
                                        <?php } else { ?>
                                            <?php add_filter( 'excerpt_length', 'vitamed_custom_excerpt_length', 999 ); ?>
                                            <?php echo get_the_excerpt( $p_id ); ?>
                                            <?php remove_filter( 'excerpt_length', 'vitamed_custom_excerpt_length', 999 ); ?>
                                        <?php } ?>
                                    </div>

                                    <div class="cta ">
                                        <a class="btn btn-primary"
                                           href="<?php echo esc_url( get_permalink( $p_id ) ) ?>">
                                            <?php esc_html_e( 'Детальніше', 'vitamed' ); ?></a>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section><!-- services-section -->