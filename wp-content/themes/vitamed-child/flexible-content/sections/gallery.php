<?php
/**
 * ACF: Flexible Content > Layouts > Gallery
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
$text    = $args['section']['text'];

$theme_color = get_field( 'theme_color', 'option' ) ? get_field( 'theme_color', 'option' ) : '#4CD30E';

$items = $args['section']['items'];

?>

<section class="gallery-section section-wrapper wrapper">
    <div class="container">
        <div class="row align-items-center gy-3 " data-aos="fade-up"  data-aos-delay="<?php echo $aos_delay; ?>">
            <div class="col">
                <?php if ( $title ) { ?>
                    <?php
                    printf(
                            __( '<%1$s class=" title mb-4 section-title">%2$s</%1$s>  ' ),
                            esc_html( $heading ),
                            esc_html( $title ),

                    ); ?>
                <?php } ?>
            </div>
            <div class="col-auto">
                <div class="d-flex gap-3 justify-content-end">

                    <div class="position-relative text-center swiper-buttons d-flex gap-2 mb-3">
                        <div class="swiper-button-prev gallery"></div>
                        <div class="swiper-button-next gallery"></div>
                    </div>

                </div>

            </div>
        </div>

        <div class="row gy-4">
            <div class="col-12 gallery-swiper  overflow-hidden">
                <?php if ( $items ) { ?>
                    <div class="swiper-wrapper">
                        <?php foreach ( $items as $k=>  $i ):
                            $aos_delay += $k * 200;?>
                            <div class="swiper-slide  bg-white overflow-hidden p-2 bg-white rounded-2"   data-aos="fade-up"  data-aos-delay="<?php echo $aos_delay; ?>">
                                <div class="image-wrapper overflow-hidden position-relative" >
                                    <?php echo wp_get_attachment_image( $i["ID"], 'large' ); ?>
                                    <a href="#" class="fancybox-target stretched-link" aria-label="lightbox"  data-fancybox data-src="<?php echo $i["url"]; ?>" data-caption="<?php echo esc_attr($i["caption"] ) ?>"                                    >
                                        <img width="40" height="40" alt="lightbox" role="img" title="lightbox"
                                             src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/lightbox.svg">
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php } ?>
            </div>
        </div>


    </div>
</section><!-- testemonials-section -->