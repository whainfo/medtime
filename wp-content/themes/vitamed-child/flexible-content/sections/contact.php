<?php
/**
 * ACF: Flexible Content > Layouts > Contact
 *
 * @package WordPress
 * @subpackage QORP
 */

$key       = isset($args['key']) ? $args['key'] : 0;
$aos_delay = 0;
if ( $key > 0 ) {
    $aos_delay = 300;
}


$heading = isset($args['section']['heading']) ? $args['section']['heading'] : 'h2';
$title   = isset($args['section']['title'])? $args['section']['title'] : __('Контакти', 'vitamed' );

$style = isset($args['section']['style']) ? $args['section']['style'] : 'map-bg';


$theme_color   = get_field( 'theme_color', 'option' ) ? get_field( 'theme_color', 'option' ) : '#4CD30E';
$address_group = get_field( 'address', 'option' ) ? get_field( 'address', 'option' ) : '';
$address       = $address_group ? $address_group['locality'] . ' ' . $address_group['street_address'] : '';
$working_hours = get_field( 'working_hours', 'option' ) ? get_field( 'working_hours', 'option' ) : '';
$phone         = get_field( 'phone', 'option' ) ? get_field( 'phone', 'option' ) : '';
$email         = get_field( 'email', 'option' ) ? get_field( 'email', 'option' ) : '';
?>
<?php if ( $style != 'map-bg' ) { ?>
    <section class="contact-section section-wrapper wrapper position-relative map-img">
        <div class="container">
            <div class="row justify-content-between   ">
                <div class="col-12 ">
                    <div class="bg-white rounded-3 p-5"  data-aos="fade-up"  data-aos-delay="<?php echo $aos_delay; ?>">
                        <div class=" d-flex flex-wrap justify-content-between ">
                            <div class="col-lg-6 col-xl-5 bg-white rounded-4 p-lg-3" data-aos="fade-up"
                                 data-aos-delay="<?php echo $aos_delay; ?>">
                                <div class="  ">

                                    <?php if ( $title ) { ?>
                                        <?php
                                        printf(
                                                __( '<%1$s class=" title mb-4 section-title">%2$s</%1$s>  ' ),
                                                esc_html( $heading ),
                                                esc_html( $title ),

                                        ); ?>
                                    <?php } ?>
                                    <?php if ( $address || $working_hours || $phone || $email ) : ?>
                                        <div class="content fs-6 mb-4">
                                            <ul class="list-group border-0 gap-3">

                                                <?php if ( $address ) { ?>
                                                    <li class="list-group-item p-0 border-0 ">
                                    <span class="d-flex gap-2">
                                          <img width="20" height="20" alt="point" title="point" role="img"
                                               aria-label="Address"
                                               src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/point.svg">
                                        <?php echo esc_html( $address ) ?>
                                    </span>
                                                    </li>
                                                <?php } ?>
                                                <?php if ( $working_hours ) { ?>
                                                    <li class="list-group-item p-0 border-0 ">
                                                        <?php get_working_hours( $working_hours ) ?>
                                                    </li>
                                                <?php } ?>
                                                <?php if ( $phone ) { ?>
                                                    <li class="list-group-item p-0 border-0 ">
                                    <span class="d-flex gap-2">
                                          <img width="20" height="20" alt="smartphone" title="smartphone" role="img"
                                               aria-label="phone"
                                               src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/smartphone.svg">
                                       <a href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo $phone; ?></a>
                                    </span>
                                                    </li>
                                                <?php } ?>
                                                <?php if ( $email ) { ?>
                                                    <li class="list-group-item p-0 border-0 ">
                                    <span class="d-flex gap-2">
                                          <img width="20" height="20" alt="email" title="email" role="img"
                                               aria-label="email"
                                               src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/letter.svg">
                                        <a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a>
                                    </span>
                                                    </li>
                                                <?php } ?>
                                            </ul>

                                        </div>
                                    <?php endif; ?>
                                    <?php if ( $address ) { ?>
                                        <div class="cta ">
                                            <a class="btn btn-secondary"
                                               href="<?php echo esc_url( 'https://www.google.com/maps/place/' . str_replace( " ", "+", $address ) ); ?>"
                                               target="_blank">
                                                <?php esc_html_e( 'Переглянути на карті', 'vitamed' ); ?></a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class=" col-12 col-md-6  bg-light rounded-4 p-3">
                                <div class="image-wrapper image-object-cover rounded-4 overflow-hidden ">
                                    <div  class="map-placeholder bm-map">
                                        <div class="map-gradient"></div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- info-section -->
<?php } else { ?>
    <section class="contact-section section-wrapper wrapper position-relative map-bg">
        <div class="bm-map-placeholder map-placeholder bm-map">
            <div class="map-gradient"></div>
        </div>
        <div class="container">
            <div class="row justify-content-between  gy-4 ">
                <div class="col-lg-6 col-xl-5 bg-white rounded-4 p-lg-3" data-aos="fade-up"
                     data-aos-delay="<?php echo $aos_delay; ?>">
                    <div class=" p-4 ">

                        <?php if ( $title ) { ?>
                            <?php
                            printf(
                                    __( '<%1$s class=" title mb-4 section-title">%2$s</%1$s>  ' ),
                                    esc_html( $heading ),
                                    esc_html( $title ),

                            ); ?>
                        <?php } ?>
                        <?php if ( $address || $working_hours || $phone || $email ) : ?>
                            <div class="content fs-6 mb-4">
                                <ul class="list-group border-0 gap-3">

                                    <?php if ( $address ) { ?>
                                        <li class="list-group-item p-0 border-0 ">
                                    <span class="d-flex gap-2">
                                          <img width="20" height="20" alt="point" title="point" role="img"
                                               aria-label="Address"
                                               src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/point.svg">
                                        <?php echo esc_html( $address ) ?>
                                    </span>
                                        </li>
                                    <?php } ?>
                                    <?php if ( $working_hours ) { ?>
                                        <li class="list-group-item p-0 border-0 ">
                                            <?php get_working_hours( $working_hours ) ?>
                                        </li>
                                    <?php } ?>
                                    <?php if ( $phone ) { ?>
                                        <li class="list-group-item p-0 border-0 ">
                                    <span class="d-flex gap-2">
                                          <img width="20" height="20" alt="smartphone" title="smartphone" role="img"
                                               aria-label="phone"
                                               src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/smartphone.svg">
                                       <a href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo $phone; ?></a>
                                    </span>
                                        </li>
                                    <?php } ?>
                                    <?php if ( $email ) { ?>
                                        <li class="list-group-item p-0 border-0 ">
                                    <span class="d-flex gap-2">
                                          <img width="20" height="20" alt="email" title="email" role="img"
                                               aria-label="email"
                                               src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/letter.svg">
                                        <a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a>
                                    </span>
                                        </li>
                                    <?php } ?>
                                </ul>

                            </div>
                        <?php endif; ?>
                        <?php if ( $address ) { ?>
                            <div class="cta ">
                                <a class="btn btn-secondary"
                                   href="<?php echo esc_url( 'https://www.google.com/maps/place/' . str_replace( " ", "+", $address ) ); ?>"
                                   target="_blank">
                                    <?php esc_html_e( 'Переглянути на карті', 'vitamed' ); ?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>