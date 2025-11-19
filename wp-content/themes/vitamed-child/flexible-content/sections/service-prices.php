<?php
/**
 * ACF: Flexible Content > Layouts > Service prices
 *
 * @package WordPress
 * @subpackage QORP
 */

$title = $args['section']['title'];
?>
<section id="service-prices" class="contact-form-section section-wrapper wrapper">
    <div class="container">
        <div class="row ">
            <div class="col">
                <?php
                $items = array();
                if(is_singular('service')){
                    $args = array(
                        'post_type' => 'service',
                        'post__in' => array(get_the_ID())
                    );

                    $servicePosts = get_posts($args);
                }else {
                    $servicePosts = get_posts('post_type=service');
                }

                foreach ($servicePosts as $servicePost) {
                    $prices = get_field('prices', $servicePost->ID) ?? array();

                    foreach ($prices as $priceRow) {
                        array_push($items, $priceRow);
                    }
                }
                if (!empty($items)) :
                    ?>
                        <h2 class="mb-4"><?php echo $title ?></h2>

                        <?php if ($items) { ?>
                            <div class="accordion simple-accordion pt-1" id="accordionPanelsStayOpen">

                                <?php foreach ($items as $k => $item):
                                    $item_title = $item['title'];
                                    $i = $item['items'];
                                    //$aos_delay += $k * 200;
                                    ?>
                                    <div class="accordion-item bg-white rounded-1 overflow-hidden <?php echo $k == 0 ? '' : 'mt-4' ?>"
                                         data-aos="fade-up"
                                         data-aos-delay="<?php //echo $aos_delay;
                                         ?>">
                                        <div class="accordion-header "
                                             id="panelsStayOpen-heading-<?php echo $k ?>">
                                            <button class="accordion-button collapsed h3 mb-0" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#panelsStayOpen-collapse-<?php echo $k ?>"
                                                    aria-expanded="false"
                                                    aria-controls="panelsStayOpen-collapse-<?php echo $k ?>">
                                                <?php echo $item_title ?>
                                            </button>
                                        </div>
                                        <div id="panelsStayOpen-collapse-<?php echo $k ?>"
                                             class="accordion-collapse collapse collapsed"
                                             aria-labelledby="panelsStayOpen-heading-<?php echo $k ?>">
                                            <div class="accordion-body px-3 pb-3 pt-0">
                                                <?php foreach ($i as $f => $price): ?>

                                                    <div class="file-wrapper d-flex flex-wrap align-items-center gap-3 bg-light rounded-1 p-4 mt-4">
                                                        <div class="col">
                                                            <?php echo $price["name"]; ?>
                                                        </div>
                                                        <div class="col-2 text-end">
                                                            <?php echo $price["price"]; ?>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                                <div class="d-flex nav-links justify-content-start mt-3  gap-4">
                                                    <a class="btn btn-secondary "
                                                       data-bs-toggle="modal" href="#contactModal" role="button">
                                                        <?php esc_html_e('Записатися на прийом', 'vitamed'); ?></a>
                                                </div><!-- .nav-links -->
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php } ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
