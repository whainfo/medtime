<?php
/**
 * ACF: Flexible Content > Layouts > Testemonials
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


$theme_color = get_field( 'theme_color', 'option' ) ? get_field( 'theme_color', 'option' ) : '#4CD30E';

$items = $args['section']['testemonials'];
?>
<?php if ( $items ) { ?>
    <section class="testemonials-section section-wrapper wrapper">
        <div class="container">
            <div class="row gy-3 align-items-center " data-aos="fade-up" data-aos-delay="<?php echo $aos_delay; ?>">
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
                    <div class="d-flex gap-4 justify-content-end">

                        <div class="position-relative text-center swiper-buttons d-flex gap-2 mb-3">
                            <div class="swiper-button-prev testemonials"></div>
                            <div class="swiper-button-next testemonials"></div>

                        </div>

                    </div>

                </div>
            </div>
            <div class="row gy-4">
                <div class="col-12 testemonials-swiper  overflow-hidden">

                    <div class="swiper-wrapper">
                        <?php foreach ( $items as $k => $p_id ):
                            $raw_content = get_post_field( 'post_content', $p_id );
                            $formatted_content = apply_filters( 'the_content', $raw_content );
                            $author = get_field( 'author', $p_id );
                            $date = get_field( 'date', $p_id );
                            $aos_delay += $k * 200;
                            ?>
                            <div class="swiper-slide  bg-white overflow-hidden p-4 bg-white rounded-3"
                                 data-aos="fade-up" data-aos-delay="<?php echo $aos_delay; ?>">

                                <div class="content-wrapper p-lg-3 ">
                                    <div class="mb-4">
                                        <svg role="img" aria-label="Testemonials" width="50" height="50"
                                             viewBox="0 0 50 50" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <rect width="50" height="50" rx="15"
                                                  fill="<?php echo $theme_color ?>" fill-opacity="0.1"/>
                                            <path d="M25 35C30.5228 35 35 30.5228 35 25C35 19.4772 30.5228 15 25 15C19.4772 15 15 19.4772 15 25C15 26.5997 15.3756 28.1116 16.0435 29.4525C16.2209 29.8088 16.28 30.2161 16.1771 30.6006L15.5815 32.8267C15.323 33.793 16.207 34.677 17.1733 34.4185L19.3994 33.8229C19.7839 33.72 20.1912 33.7791 20.5475 33.9565C21.8884 34.6244 23.4003 35 25 35Z"
                                                  stroke="<?php echo $theme_color ?>" stroke-width="2"/>
                                            <path d="M21 23.5H29" stroke="<?php echo $theme_color ?>" stroke-width="2"
                                                  stroke-linecap="round"/>
                                            <path d="M21 27H26.5" stroke="<?php echo $theme_color ?>" stroke-width="2"
                                                  stroke-linecap="round"/>
                                        </svg>
                                    </div>
                                    <h3 class="title mb-3"><?php echo esc_html( get_the_title( $p_id ) ); ?></h3>
                                    <div class="d-flex flex-column gap-3 ">
                                        <div class="content "><?php echo $formatted_content; ?></div>
                                    </div>


                                    <div class="d-flex gap-3 align-items-center">
                                        <?php if ( $author ) { ?>
                                            <div class="">
                                                <div class="d-flex gap-2 align-items-center">
                                                    <svg role="img" aria-label="Author" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="12" cy="6" r="4" stroke="<?php echo $theme_color ?>"
                                                                stroke-width="2"/>
                                                        <ellipse cx="12" cy="17" rx="7" ry="4"
                                                                 stroke="<?php echo $theme_color ?>" stroke-width="2"/>
                                                    </svg>

                                                    <span><?php echo esc_html( $author ); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if ( $date ) { ?>
                                            <div class="">
                                                <div class="d-flex gap-2 align-items-center">
                                                    <svg role="img" aria-label="Date" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12V14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14V12Z"
                                                              stroke="<?php echo $theme_color ?>" stroke-width="2"/>
                                                        <path d="M7 4V2.5" stroke="<?php echo $theme_color ?>"
                                                              stroke-width="2" stroke-linecap="round"/>
                                                        <path d="M17 4V2.5" stroke="<?php echo $theme_color ?>"
                                                              stroke-width="2" stroke-linecap="round"/>
                                                        <path d="M2.5 9H21.5" stroke="<?php echo $theme_color ?>"
                                                              stroke-width="2" stroke-linecap="round"/>
                                                    </svg>

                                                    <span><?php echo esc_html( $date ); ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>

        </div>

    </section><!-- testemonials-section -->
<?php } ?>