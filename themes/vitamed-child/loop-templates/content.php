<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'p-4 bg-white round-2' ); ?> id="post-<?php the_ID(); ?>">
    <div>
        <header class="entry-header">
            <div class="d-flex gap-4 align-items-center">
                <div class="col-12 col-md-5 image-wrapper">
                    <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
                </div>
                <div  class="col-12 col-md-auto">
                    <?php
                    the_title(
                            sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
                            '</a></h2>'
                    );
                    ?>

                    <?php if ( 'post' === get_post_type() ) : ?>

                        <div class="entry-meta">
                            <?php understrap_posted_on(); ?>
                        </div><!-- .entry-meta -->

                    <?php endif; ?>


                </div>
            </div>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php
            the_excerpt();
            understrap_link_pages();
            ?>

        </div><!-- .entry-content -->

        <footer class="entry-footer">

            <?php understrap_entry_footer(); ?>

        </footer><!-- .entry-footer -->
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
