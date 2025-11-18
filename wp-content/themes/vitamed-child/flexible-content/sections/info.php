<?php
/**
 * ACF: Flexible Content > Layouts > Info
 *
 * @package WordPress
 * @subpackage QORP
 */

$key = $args['key'] ? $args['key'] : 0;
$aos_delay = 0;
if($key > 0){
    $aos_delay = 300;
}
$heading            = $args['section']['heading'] ? $args['section']['heading'] : 'h2';
$title              = $args['section']['title'];

$text               = $args['section']['text'];
$image_url          = $args['section']['image'];
$cta                = $args['section']['cta'];
$is_popup           = $args['section']['is_popup'];
$style = $image_url ? 'style="--bg-image: url('.$image_url.');"' : '';
$theme_color = get_field( 'theme_color', 'option' ) ? get_field( 'theme_color', 'option' )  : '#4CD30E' ;
?>

<section class="info-section section-wrapper wrapper" <?php echo $style; ?>>
    <div class="container">
        <div class="row justify-content-between  gy-4 ">
            <div class="<?php echo $image_url ? 'col-md-6 col-lg-6 col-xl-5' : 'col'?>  ">
                <div class="bg-white rounded-3 p-lg-3"  data-aos="fade-up"  data-aos-delay="<?php echo $aos_delay; ?>">
                    <div class=" p-4  ">
                        <div class="mb-4">
                            <svg role="img" aria-label="Info" width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="50" height="50" rx="15" fill="<?php echo $theme_color?>" fill-opacity="0.1"/>
                                <path d="M29 17.0017C31.175 17.0138 32.3529 17.1103 33.1213 17.8787C34 18.7573 34 20.1715 34 23V29C34 31.8284 34 33.2426 33.1213 34.1213C32.2426 35 30.8284 35 28 35H22C19.1716 35 17.7574 35 16.8787 34.1213C16 33.2426 16 31.8284 16 29V23C16 20.1715 16 18.7573 16.8787 17.8787C17.6471 17.1103 18.825 17.0138 21 17.0017" stroke="<?php echo $theme_color?>" stroke-width="2"/>
                                <path d="M23.5 27H30" stroke="<?php echo $theme_color?>" stroke-width="2" stroke-linecap="round"/>
                                <path d="M20 27H20.5" stroke="<?php echo $theme_color?>" stroke-width="2" stroke-linecap="round"/>
                                <path d="M20 23.5H20.5" stroke="<?php echo $theme_color?>" stroke-width="2" stroke-linecap="round"/>
                                <path d="M20 30.5H20.5" stroke="<?php echo $theme_color?>" stroke-width="2" stroke-linecap="round"/>
                                <path d="M23.5 23.5H30" stroke="<?php echo $theme_color?>" stroke-width="2" stroke-linecap="round"/>
                                <path d="M23.5 30.5H30" stroke="<?php echo $theme_color?>" stroke-width="2" stroke-linecap="round"/>
                                <path d="M21 16.5C21 15.6716 21.6716 15 22.5 15H27.5C28.3284 15 29 15.6716 29 16.5V17.5C29 18.3284 28.3284 19 27.5 19H22.5C21.6716 19 21 18.3284 21 17.5V16.5Z" stroke="<?php echo $theme_color?>" stroke-width="2"/>
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
                        <?php if ( $text ) : ?>
                            <div class="content fs-6 mb-4"><?php echo $text ; ?></div>
                        <?php endif; ?>
                        <?php if ( $cta ) { ?>
                            <div class="cta <?php if($is_popup):?>d-none d-md-flex<?php endif;?>">
                                <a class="btn btn-secondary" href="<?php echo esc_url( $cta['url'] ); ?>"
                                   <?php if($is_popup):?>data-bs-toggle="modal"<?php endif;?>
                                   target="<?php echo esc_attr( $cta['target'] ? $cta['target'] : '_self' ); ?>">
                                    <?php echo esc_html( $cta['title'] ); ?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section><!-- info-section -->