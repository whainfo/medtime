<?php

$doctors              = get_field( 'doctors' );
?>
<div class="doctors-section section-wrapper wrapper">
    <div class="container">
        <div class="row gy-4">
            <div class="col-12 ">

                <?php

                printf(
                    __( '<%1$s class=" title mb-4 section-title">%2$s</%1$s>  ' ),
                    esc_html( 'h2' ),
                    esc_html( __( 'Наші лікарі', 'vitamed' ) ),
                ); ?>

            </div>

            <div class="col-12  ">
                <?php if ( $doctors ) {
                    $aos_delay = 0; ?>
                    <div class="doctors-grid">
                        <?php foreach ( $doctors as $k => $p_id ):
                            $aos_delay += $k * 200;
                            $position = get_field( 'position', $p_id );
                            $experience = get_field( 'experience', $p_id );
                            ?>
                            <div class="  doctor-item-wrapper p-0 rounded-0" data-aos="fade-up"
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
                                                    __( 'Стаж %1$s років' ),
                                                    esc_html( $experience )
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
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div><!-- doctors-section -->
