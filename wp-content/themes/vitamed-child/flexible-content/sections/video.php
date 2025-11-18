<?php
/**
 * ACF: Flexible Content > Layouts > Video
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

$items = $args['section']['videos'];
?>

<section class="video-section section-wrapper wrapper">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-4 col-xl-3"  data-aos="fade-up"  data-aos-delay="<?php echo $aos_delay; ?>">
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
                    <div class="swiper-button-prev video"></div>
                    <div class="swiper-button-next video"></div>

                </div>

            </div>
            <div class="col-md-8 col-xl-9 video-swiper slider-swiper overflow-hidden">
                <?php if ( $items ) { ?>
                    <div class="swiper-wrapper">
                        <?php foreach ( $items as $k=> $item ):
                            $video = $item['video'];
                            $video_title = $item['title'];
                            $aos_delay += $k * 200;
                            ?>
                            <div class="swiper-slide video-slide  bg-white overflow-hidden " data-aos="fade-up"  data-aos-delay="<?php echo $aos_delay; ?>">
                                <?php if ( $video ) { ?>
                                    <div class="ratio ratio-16x9 bg-dark mb-3 pointer-event">
                                        <?php echo $video; ?>
                                    </div>

                                <?php } ?>
                                <div class="content-wrapper ">
                                    <h3 class="title "><?php echo esc_html( $video_title ); ?></h3>
                                    <div class="cta ">
                                        <a  href="#" class="btn btn-primary play target-iframe" >
                                            <?php esc_html_e( 'Переглянути', 'vitamed' ); ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section><!-- video-section -->