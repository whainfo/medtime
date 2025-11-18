<?php
/**
 * ACF: Flexible Content > Layouts > Hero
 *
 * @package WordPress
 * @subpackage QORP
 */
$key = $args['key'] ? $args['key'] : 0;
$aos_delay = 0;

if ($key > 0) {
    $aos_delay = 400;
}


$heading = $args['section']['heading'] ? $args['section']['heading'] : 'h2';
$title = $args['section']['title'];

$indicator_style = $args['section']['indicator_style'];
$reverse_col = $args['section']['reverse_col'] ? 'flex-md-row-reverse' : '';
$text = $args['section']['text'];
$image_id = $args['section']['image'];
$cta_options = $args['section']['cta_options'];
$cta = $args['section']['cta'];
$cta_text = $args['section']['cta_text'];
$patients = $args['section']['patients'];
$indicators = $args['section']['indicators'];
$patients_gallery = $patients ? $patients['gallery'] : '';
$patients_title = $patients ? $patients['title'] : '';
$patients_sub_title = $patients ? $patients['sub_title'] : '';

?>

<section class="hero-section section-wrapper wrapper ">
    <div class="container">
        <div class="row justify-content-between  gy-4 <?php echo esc_attr($reverse_col); ?>">
            <div class="col-md-6 col-lg-6 col-xl-5 align-self-center" data-aos="fade-up"
                 data-aos-delay="<?php echo $aos_delay; ?>">
                <?php if ($title) { ?>
                    <?php
                    printf(
                        __('<%1$s class=" title mb-4 section-title">%2$s</%1$s>  '),
                        esc_html($heading),
                        esc_html($title),

                    ); ?>
                <?php } ?>
                <?php if ($text) : ?>
                    <div class="content fs-6 mb-4"><?php echo $text; ?></div>
                <?php endif; ?>
                <?php if ($cta_options == 'popup') { ?>
                    <div class="cta mb-4">
                        <a class="btn btn-secondary d-none d-md-flex"
                           data-bs-toggle="modal" href="#contactModal" role="button">
                            <?php if ($cta_text != ''): ?>
                                <?php echo $cta_text; ?>
                            <?php else: ?>
                                <?php esc_html_e('Записатися', 'vitamed'); ?>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php } elseif ($cta_options == 'cta' && $cta) { ?>
                    <div class="cta mb-4">
                        <a class="btn btn-secondary" href="<?php echo esc_url($cta['url']); ?>"
                           target="<?php echo esc_attr($cta['target'] ? $cta['target'] : '_self'); ?>">
                            <?php echo esc_html($cta['title']); ?></a>
                    </div>
                <?php } ?>
                <?php if ($indicator_style == 'image') { ?>
                    <?php if ($patients) { ?>
                        <div class="d-flex gap-2 align-items-center">
                            <?php if ($patients_gallery) { ?>
                                <div class="patients-gallery">
                                    <div class="images d-flex">
                                        <?php foreach ($patients_gallery as $id): ?>
                                            <figure class="position-relative mb-0">
                                                <?php echo wp_get_attachment_image($id, array(200, 200)); ?>
                                            </figure>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($patients_title || $patients_sub_title) { ?>
                                <div class="patients-info">
                                    <?php if ($patients_title) { ?>
                                        <div class="patients-title text-dark fw-bold">
                                            <?php echo esc_html($patients_title); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($patients_sub_title) { ?>
                                        <div class="patients-sub_title text-gray">
                                            <?php echo esc_html($patients_sub_title); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } elseif ($indicator_style == 'multi') { ?>
                    <?php if ($indicators) { ?>
                        <div class="d-flex gap-3 indicators">
                            <?php foreach ($indicators as $indicator):
                                $i_title = $indicator['title'];
                                $i_title_after = $indicator['after'];
                                $i_text = $indicator['text'] ?>
                                <div class="indicator">
                                    <?php if ($i_title) { ?>
                                        <div class="indicator_title text-dark ">
                                            <?php
                                            $span = $i_title_after ? '<span class="after text-secondary">' . esc_html($i_title_after) . '</span>' : '';
                                            printf(
                                                __('%1$s%2$s'),
                                                esc_html($i_title),
                                                $span); ?>

                                        </div>
                                    <?php } ?>
                                    <?php if ($i_text) { ?>
                                        <div class="indicator_content text-gray mt-1">
                                            <?php echo esc_html($i_text); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php endforeach; ?>


                        </div>
                    <?php } ?>
                <?php } ?>

            </div>
            <div class="col-md-6">
                <?php if ($image_id) { ?>
                    <div class="overflow-hidden  image-wrapper">
                        <?php echo wp_get_attachment_image($image_id, 'large'); ?>
                    </div>
                <?php } else { ?>
                    <div class="overflow-hidden  image-wrapper">

                        <img class=""
                             src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/images/placeholder.png"
                             alt="placeholder"
                             title="placeholder">


                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section><!-- hero-section -->