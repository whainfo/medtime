<?php
/**
 * ACF: Flexible Content > Layouts > Doctors
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

$theme_color = get_field( 'theme_color', 'option' ) ? get_field( 'theme_color', 'option' ) : '#4CD30E';

$items = $args['section']['doctors'];
foreach ( $items as $k => $id ) {
    if ( get_post_status( $id ) != 'publish' ) {
        unset( $items[ $k ] );
    }
}
if ( $items ) {
    ?>
    <section class="doctors-section section-wrapper wrapper">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-4 col-xl-3 " data-aos="fade-up" data-aos-delay="<?php echo $aos_delay; ?>">
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
                    <div class="position-relative text-center swiper-buttons d-flex gap-2 mb-3">
                        <div class="swiper-button-prev doctors"></div>
                        <div class="swiper-button-next doctors"></div>

                    </div>
                    <div>
                        <a class="btn btn-secondary"
                           href="<?php echo get_post_type_archive_link( 'doctors' ); ?>">
                            <?php esc_html_e( 'Всі лікарі', 'vitamed' ); ?></a>
                    </div>
                </div>

                <div class="col-md-8 col-xl-9 doctors-swiper slider-swiper ">
                    <?php if ( $items ) { ?>
                        <div class="swiper-wrapper">
                            <?php foreach ( $items as $k => $p_id ):
                                $aos_delay += $k * 200;
                                $position = get_field( 'position', $p_id );
                                $experience = get_field( 'experience', $p_id );
                                $sign_up_open = get_field( 'sign_up_open', $p_id );
                                $consultation_price = get_field( 'consultation_price', $p_id ); ?>
                                <div class="swiper-slide   doctor-item-wrapper p-0 rounded-0" data-aos="fade-up"
                                     data-aos-delay="<?php echo $aos_delay; ?>">
                                    <div class="doctor-item bg-white overflow-hidden">
                                        <div class="overflow-hidden  image-wrapper position-relative"
                                             style="--aspect-ratio: 275/300;">

                                            <?php if ( has_post_thumbnail( $p_id ) ) { ?>
                                                <?php echo get_the_post_thumbnail( $p_id, 'large' ); ?>
                                            <?php } else { ?>
                                                <img class=""
                                                     src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/placeholder.png"
                                                     alt="placeholder"
                                                     title="placeholder">
                                            <?php } ?>
                                            <?php if ( $experience ) { ?>
                                                <span class="white-label bg-white">
                                                <?php
                                                printf(
                                                        __( 'Стаж %1$s' ),
                                                    format_years(esc_html( $experience ))
                                                ); ?>
                                            </span>
                                            <?php } ?>
                                        </div>
                                        <div class="content-wrapper ">
                                            <div class="d-flex flex-column gap-2 mb-3">
                                                <div class="text-gray">
                                                    <?php get_list_tax_posts( $p_id, 'qualification' ) ?>
                                                </div>
                                                <h3 class="title mb-0"><?php echo esc_html( get_the_title( $p_id ) ); ?></h3>
                                                <?php get_list_tax_posts( $p_id, 'specialty' ) ?>
                                            </div>
                                            <div class="cta d-flex flex-column gap-1  ">
                                                <a class="btn btn-primary"
                                                   href="<?php echo esc_url( get_permalink( $p_id ) ) ?>">
                                                    <?php esc_html_e( 'Детальніше', 'vitamed' ); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button_reg bg-white overflow-hidden w-100">
                                        <div class="content-wrapper ">
                                            <div class="">
                                                <a class="btn btn-secondary mb-3"
                                                   href="#contact-us">
                                                    <?php esc_html_e( 'Записатися', 'vitamed' ); ?></a>
                                                <?php if ( $consultation_price ) { ?>
                                                    <div class="d-flex gap-2 align-items-center">
                                                        <div class="">
                                                            <svg width="45" height="45" viewBox="0 0 45 45" fill="none"
                                                                 role="img" aria-label="Price"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <rect width="45" height="45" rx="15"
                                                                      fill="<?php echo $theme_color ?>"
                                                                      fill-opacity="0.1"/>
                                                                <path d="M27.4531 12.0833H17.5469C16.3397 12.0833 15.7362 12.0833 15.2494 12.2526C14.3263 12.5738 13.6015 13.3199 13.2895 14.2702C13.125 14.7713 13.125 15.3927 13.125 16.6354V31.223C13.125 32.117 14.151 32.5914 14.8001 31.9974C15.1814 31.6485 15.7561 31.6485 16.1374 31.9974L16.6406 32.4579C17.3089 33.0695 18.3161 33.0695 18.9844 32.4579C19.6527 31.8464 20.6598 31.8464 21.3281 32.4579C21.9964 33.0695 23.0036 33.0695 23.6719 32.4579C24.3402 31.8464 25.3473 31.8464 26.0156 32.4579C26.6839 33.0695 27.6911 33.0695 28.3594 32.4579L28.8626 31.9974C29.2439 31.6485 29.8186 31.6485 30.1999 31.9974C30.849 32.5914 31.875 32.117 31.875 31.223V16.6354C31.875 15.3927 31.875 14.7713 31.7105 14.2702C31.3985 13.3199 30.6737 12.5738 29.7506 12.2526C29.2638 12.0833 28.6603 12.0833 27.4531 12.0833Z"
                                                                      stroke="<?php echo $theme_color ?>"
                                                                      stroke-width="2"/>
                                                                <path d="M19.896 20.8333L21.3841 22.4999L25.1043 18.3333"
                                                                      stroke="<?php echo $theme_color ?>"
                                                                      stroke-width="2"
                                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M17.8125 26.1458H27.1875"
                                                                      stroke="<?php echo $theme_color ?>"
                                                                      stroke-width="2"
                                                                      stroke-linecap="round"/>
                                                            </svg>
                                                        </div>
                                                        <div class="info">

                                                            <div class="fw-bolder">
                                                                <?php
                                                                printf(
                                                                        __( '%1$s грн.' ),
                                                                        esc_html( $consultation_price )
                                                                ); ?>
                                                            </div>

                                                        </div>

                                                    </div>
                                                <?php } ?>
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
    </section><!-- doctors-section -->
    <?php
}
?>

