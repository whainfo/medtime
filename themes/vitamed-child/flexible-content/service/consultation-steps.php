<?php

$consultation_goes =  $args['section']['consultation_goes'];
?>
<div id="consultation-steps" class="consultation-wrapper steps-wrapper wrapper">
    <h2 class="mb-4"><?php echo __( 'Як проходить консультація', 'vitamed' ) ?></h2>

    <?php if ( $consultation_goes ) { ?>
        <div class="d-grid grid-columns-md-2   pt-1">

            <?php foreach ( $consultation_goes as $k => $item ):
                $item_title = $item['title'];
                $item_description = $item['description'];
                //$aos_delay += $k * 200;
                ?>
                <div class="col"
                     data-aos="fade-up"
                     data-aos-delay="<?php //echo $aos_delay;
                     ?>">
                    <div class="bg-primary text-white rounded-1 overflow-hidden p-4 h-100">
                        <div class="icon mb-4  fw-bold bg-secondary text-white d-flex justify-content-center align-items-center me-auto">
                            <span><?php echo $k+1 ?></span></div>
                        <h3 class="h5"><?php echo $item_title ?></h3>
                        <div class="content pt-2"><?php echo $item_description ?></div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    <?php } ?>
</div>
