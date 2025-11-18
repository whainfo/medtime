<?php
/**
 * ACF: Flexible Content > Layouts > Contact form
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

$sub_title      = $args['section']['sub_title'];
$text      = $args['section']['text'];
$shortcode = $args['section']['shortcode'];

$style         = $args['section']['style'] ? $args['section']['style'] : 'image';
$image_id      = $args['section']['image'] ? $args['section']['image'] : '';
$address_group = get_field( 'address', 'option' ) ? get_field( 'address', 'option' ) : '';
$address       = $address_group ? $address_group['locality'] . ' ' . $address_group['street_address'] : '';
$phone         = get_field( 'phone', 'option' ) ? get_field( 'phone', 'option' ) : '';
$email         = get_field( 'email', 'option' ) ? get_field( 'email', 'option' ) : '';
$theme_color = get_field( 'theme_color', 'option' ) ? get_field( 'theme_color', 'option' )  : '#4CD30E' ;
?>

<section id="contact-us" class="contact-form-section section-wrapper wrapper">
    <div class="container">
        <div class="row justify-content-between   ">
            <div class="col-12 ">
                <div class="bg-white rounded-3 p-5" data-aos="fade-up" data-aos-delay="<?php echo $aos_delay; ?>">
                    <div class=" d-flex flex-wrap justify-content-between ">
                        <?php if ( $style == 'none' ) { ?>

                            <?php if ( $title || $sub_title ) { ?>
                                <div class=" col-12 col-md-6  col-lg-5 mb-3 mb-md-0 ">
                                    <div class="mb-4">
                                        <svg role="img" aria-label="Info" width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="50" height="50" rx="15" fill="<?php echo $theme_color?>" fill-opacity="0.1"/>
                                            <path d="M22 27.2354V30.0001C22 32.7615 24.2386 35.0001 27 35.0001H27.8824C29.7691 35.0001 31.3595 33.7311 31.8465 32.0001" stroke="<?php echo $theme_color?>" stroke-width="2"/>
                                            <path d="M18.4286 16H18.3369C18.024 16 17.8676 16 17.7357 16.0117C16.2876 16.1397 15.1397 17.2876 15.0117 18.7357C15 18.8676 15 19.024 15 19.3369V20.2353C15 24.1013 18.134 27.2353 22 27.2353C25.7082 27.2353 28.7143 24.2292 28.7143 20.521V19.3369C28.7143 19.024 28.7143 18.8676 28.7026 18.7357C28.5746 17.2876 27.4267 16.1397 25.9785 16.0117C25.8467 16 25.6902 16 25.3774 16H25.2857" stroke="<?php echo $theme_color?>" stroke-width="2" stroke-linecap="round"/>
                                            <circle cx="32" cy="29" r="3" stroke="<?php echo $theme_color?>" stroke-width="2"/>
                                            <path d="M25 15V17" stroke="<?php echo $theme_color?>" stroke-width="2" stroke-linecap="round"/>
                                            <path d="M19 15V17" stroke="<?php echo $theme_color?>" stroke-width="2" stroke-linecap="round"/>
                                        </svg>

                                    </div>
                                    <?php if ( $title ) { ?>
                                        <?php
                                        printf(
                                                __( '<%1$s class=" title mb-4 section-title">%2$s</%1$s>  ' ),
                                                esc_html( $heading ),
                                                esc_html( $title ),
                                        ); ?>
                                    <?php } ?>
                                    <?php if ( $sub_title ) : ?>
                                        <div class="content fs-6 "><?php echo $sub_title; ?></div>
                                    <?php endif; ?>

                                </div>
                            <?php } ?>
                        <?php if ( $shortcode || $text ) { ?>
                                <div class=" col-12 col-md-6  ">

                                    <?php if ( $text ) : ?>
                                        <div class="content fs-6 mb-4"><?php echo $text; ?></div>
                                    <?php endif; ?>
                                    <div class="form-wrapper">
                                        <?php echo do_shortcode( $shortcode ); ?>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else {?>
                            <?php if ( $title || $text ) { ?>
                                <div class="px-2 py-md-3 col-12 col-md-6  col-lg-5 mb-3 mb-md-0 ">
                                    <?php if ( $title ) { ?>
                                        <?php
                                        printf(
                                                __( '<%1$s class=" title mb-4 section-title">%2$s</%1$s>  ' ),
                                                esc_html( $heading ),
                                                esc_html( $title ),
                                        ); ?>
                                    <?php } ?>
                                    <?php if ( $text ) : ?>
                                        <div class="content fs-6 mb-4"><?php echo $text; ?></div>
                                    <?php endif; ?>
                                    <div class="form-wrapper">
                                        <?php echo do_shortcode( $shortcode ); ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class=" col-12 col-md-6  bg-light rounded-4 p-3">
                                <?php if ( $style == 'map' && $address ) { ?>
                                    <div class="image-wrapper image-object-cover rounded-4 overflow-hidden mb-3">
                                        <div class="map-placeholder bm-map">
                                            <div class="map-gradient"></div>
                                        </div>
                                    </div>
                                <?php } elseif ( $style == 'image' && $image_id ) { ?>
                                    <div class="image-wrapper image-object-cover rounded-4 overflow-hidden mb-3">
                                        <?php echo wp_get_attachment_image( $image_id, 'large' ); ?>
                                    </div>
                                <?php } else {
                                    ?>
                                    <div class="image-wrapper image-object-cover rounded-4 overflow-hidden mb-3">
                                        <img class=""
                                             src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/placeholder.png"
                                             alt="placeholder"
                                             title="placeholder">
                                    </div>
                                    <?php
                                } ?>
                                <?php if ( $address || $phone || $email ) { ?>
                                    <div class="contact-info-wrapper d-flex flex-column flex-lg-row  justify-content-between ">
                                        <?php if ( $address ) { ?>
                                            <div class="address col px-3">
                                                <?php echo $address; ?>
                                            </div>
                                        <?php } ?>
                                        <?php if ( $phone || $email ) { ?>
                                            <div class="contact-info text-lg-end col-auto px-3">
                                                <div>
                                                    <a href="tel:<?php echo esc_url( $phone ); ?>"><?php echo $phone; ?></a>
                                                </div>
                                                <div>
                                                    <a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- info-section -->