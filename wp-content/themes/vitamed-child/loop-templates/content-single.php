<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
$files      = get_field( 'files' );
$share_btns = get_field( 'share_btns' ) ? get_field( 'share_btns' ) : 'top';
?>

<article <?php post_class( 'p-4 bg-white rounded-3' ); ?> id="post-<?php the_ID(); ?>">
    <div>
        <header class="entry-header">
            <div class="d-flex flex-wrap gap-4 align-items-center">
                <div class="col-12 col-md-5 image-wrapper rounded-3  overflow-hidden">
                    <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
                </div>
                <div class="col">
                    <?php if ( 'post' === get_post_type() ) : ?>
                        <div class="entry-meta mb-3">
                            <?php vitamed_posted_on(); ?>
                        </div><!-- .entry-meta -->
                    <?php endif; ?>

                    <?php
                    the_title(
                            sprintf( '<h1 class="entry-title "><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
                            '</a></h2>'
                    );

                    ?>
                    <?php if ( $share_btns == 'top' ) { ?>
                        <?php echo vitamed_add_social_share_buttons() ?>
                    <?php } ?>
                </div>
            </div>
        </header><!-- .entry-header -->

        <div class="entry-content mt-3 mt-md-6">
            <?php
            the_content();
            ?>

            <?php
            //understrap_link_pages();
            ?>

        </div><!-- .entry-content -->

        <footer class="entry-footer">

            <?php if ( $files ) { ?>
                <?php foreach ( $files as $f => $file ): ?>
                    <?php if ( $file["file"] ) { ?>
                        <div class="file-wrapper d-flex flex-wrap align-items-center gap-3 bg-light rounded-1 p-4 <?php echo $f ?> <?php echo $f == 0 ? '' : 'mt-4' ?>">
                            <div class="col-auto">
                                <?php

                                switch ( $file["file"]["mime_type"] ) {
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
                                        if ( $file["file"]["icon"] ) {
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
                                    <a class="btn btn-primary download" download
                                       href="<?php echo esc_url( $file["file"]["url"] ); ?>"
                                       target="_blank">
                                        <?php echo __( 'Завантажити', 'vitamed' ); ?></a>
                                </div>
                            <?php } ?>

                            <?php //var_dump($file);?>
                        </div>
                    <?php } ?>
                <?php endforeach; ?>
            <?php } ?>
            <?php //understrap_entry_footer(); ?>

        </footer><!-- .entry-footer -->

        <?php if ( $share_btns == 'bottom' ) { ?>
                <hr>
            <div class="d-flex flex-wrap justify-content-center justify-content-between gap-4 mt-5">

                <div class="col-auto">
                    <?php echo vitamed_add_social_share_buttons() ?>
                </div>


                <div class="col-12 col-lg-auto">
                    <?php vitamed_post_nav(); ?>
                </div>
            </div>

        <?php } ?>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->

<div class="d-flex flex-wrap justify-content-center justify-content-between gap-4 mt-5">
    <?php if ( 'post' === get_post_type() ) : ?>
        <div class="col-auto">
            <a class="btn btn-secondary"
               href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">
                <?php esc_html_e( 'До списку новин', 'vitamed' ); ?></a>
        </div>

    <?php endif; ?>
    <?php if ( $share_btns != 'bottom' ) { ?>
        <div class="col-12 col-lg-auto">
            <?php vitamed_post_nav(); ?>
        </div>
    <?php } ?>
</div>