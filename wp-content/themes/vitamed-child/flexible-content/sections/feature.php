<div class="container" >
    <div class="row">
        <div class="col-md-12">
            <?php
            $feature              = get_field( 'feature' );
            $theme_color = get_field( 'theme_color', 'option' ) ? get_field( 'theme_color', 'option' ) : '#4CD30E';
            ?>
            <div id="feature" class="feature-wrapper  wrapper">
                <h2 class="mb-4"><?php echo __( 'Чим займається лікар?', 'vitamed' ) ?></h2>

                <?php if ( $feature ) { ?>
                    <div class="d-grid grid-columns-md-2 grid-columns-lg-3  pt-1">

                        <?php foreach ( $feature as $k => $item ):
                            $item_title = $item['title'];
                            $item_description = $item['description'];
                            //$aos_delay += $k * 200;
                            ?>
                            <div class="col"
                                 data-aos="fade-up"
                                 data-aos-delay="<?php //echo $aos_delay;
                                 ?>">
                                <div class="bg-white rounded-1 overflow-hidden p-4 h-100">
                                    <div class="mb-4">
                                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <rect width="50" height="50" rx="15" fill="<?php echo $theme_color ?>"/>
                                            <path d="M18 25.5L22.5 30L32.5 20" stroke="white" stroke-width="2"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <h3 class="h5"><?php echo $item_title ?></h3>
                                    <div class="content pt-2"><?php echo $item_description ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

