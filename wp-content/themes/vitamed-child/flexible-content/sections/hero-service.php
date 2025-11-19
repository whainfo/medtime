<div class="container" >
    <div class="row">
        <div class="col-md-12">
            <?php
            $icon                 = get_field( 'icon' );
            ?>
            <div class="entry-content hero-services-section">
                <div class="d-flex flex-wrap gap-4 align-items-center">
                    <?php if ( $icon ) { ?>
                        <?php echo wp_get_attachment_image( $icon, 'full' ); ?>
                    <?php } ?>
                    <div class="col">
                        <?php
                        the_title(
                                sprintf( '<h1 class="entry-title "><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
                                '</a></h2>'
                        );
                        ?>
                    </div>
                </div>
                <div class=" mt-3 mt-md-6">
                    <?php
                    the_content();
                    ?>

                </div><!-- .entry-content -->
                <div class=" mt-3 mt-md-6">
                    <div class="d-flex nav-links justify-content-start  gap-4">
                        <a class="btn btn-secondary d-none d-md-flex"
                           data-bs-toggle="modal" href="#contactModal">
                            <?php esc_html_e( 'Записатися на прийом', 'vitamed' ); ?></a>

                        <a class="btn btn-primary "
                           href="#price">
                            <?php esc_html_e( 'Вартість послуг', 'vitamed' ); ?></a>

                    </div><!-- .nav-links -->

                </div><!-- .entry-content -->
            </div>
        </div>
    </div>
</div>
