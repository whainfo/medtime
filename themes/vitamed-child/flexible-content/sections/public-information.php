<?php
/**
 * ACF: Flexible Content > Layouts > Public information
 *
 * @package WordPress
 * @subpackage QORP
 */

$key       = $args['key'] ? $args['key'] : 0;
$aos_delay = 0;
if ( $key > 0 ) {
    $aos_delay = 300;
}


$items = $args['section']['items'];

$theme_color = get_field( 'theme_color', 'option' ) ? get_field( 'theme_color', 'option' ) : '#4CD30E';

?>

<section class="public-information-section section-wrapper wrapper">
    <div class="container">
        <div class="row justify-content-between  gy-4 ">
            <div class="col " >
                <?php if ( $items ) { ?>
                    <div class="accordion" id="accordionPanelsStayOpen-<?php echo $key ?>">

                        <?php foreach ( $items as $k => $item ):
                            $item_title = $item['title'];
                            $files = $item['files'];
                            $aos_delay += $k * 200;
                            ?>
                            <div class="accordion-item bg-white rounded-1 <?php echo $k == 0 ? '' : 'mt-4' ?>" data-aos="fade-up"
                                 data-aos-delay="<?php echo $aos_delay; ?>">
                                <div class="accordion-header "
                                     id="panelsStayOpen-heading-<?php echo $key ?>-<?php echo $k ?>">
                                    <button class="accordion-button h3" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapse-<?php echo $key ?>-<?php echo $k ?>"
                                            aria-expanded="false"
                                            aria-controls="panelsStayOpen-collapse-<?php echo $key ?>-<?php echo $k ?>">
                                        <?php echo $item_title ?>
                                    </button>
                                </div>
                                <div id="panelsStayOpen-collapse-<?php echo $key ?>-<?php echo $k ?>"
                                     class="accordion-collapse collapse collapsed"
                                     aria-labelledby="panelsStayOpen-heading-<?php echo $key ?>-<?php echo $k ?>">
                                    <div class="accordion-body px-3 pb-3 pt-0">
                                        <?php foreach ( $files as $f => $file ): ?>
                                            <?php if ( $file["file"] ) { ?>
                                                <div class="file-wrapper d-flex flex-wrap align-items-center gap-3 bg-light rounded-1 p-4 <?php echo $f ?> <?php echo $f == 0 ? '' : 'mt-4' ?>">
                                                    <div class="col-auto">
                                                        <?php

                                                        switch ( $file["file"]["mime_type"]) {
                                                            case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                                                                ?>
                                                                <img width="60" height="60"
                                                                     src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/xls.svg">
                                                                <?php
                                                                break;
                                                            case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                                                                ?>
                                                                <img width="60" height="60"
                                                                     src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/doc.svg">
                                                                <?php
                                                                break;
                                                            case 'application/pdf':
                                                                ?>
                                                                <img width="60" height="60"
                                                                     src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/images/pdf.svg">
                                                                <?php
                                                                break;
                                                            default:
                                                                if($file["file"]["icon"]){
                                                                    ?>
                                                                    <img width="60" height="60"
                                                                         src="<?php echo $file["file"]["icon"]; ?>">
                                                                    <?php
                                                                }

                                                        } ?>
                                                    </div>

                                                    <div class="col">
                                                        <div class="fw-bold">
                                                            <?php echo $file["file"]["filename"]; ?>
                                                        </div>
                                                        <div>
                                                            <?php echo $file["file"]["date"]; ?>
                                                        </div>
                                                    </div>
                                                    <?php if ( $file["file"]["url"] ) { ?>
                                                        <div class="cta col-12 col-md-auto">
                                                            <a class="btn btn-primary download" download href="<?php echo esc_url( $file["file"]["url"] ); ?>"
                                                               target="_blank">
                                                                <?php echo  __( 'Завантажити', 'vitamed' ); ?></a>
                                                        </div>
                                                    <?php } ?>

                                                    <?php //var_dump($file);?>
                                                </div>
                                            <?php } ?>


                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section><!-- info-section -->