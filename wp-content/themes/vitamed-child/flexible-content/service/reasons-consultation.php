<?php
$reasons_consultation =  $args['section']['reasons_consultation'];

?>
<div id="reasons-consultation" class="reasons-consultation-wrapper  wrapper">

    <div class="d-flex  align-items-lg-center flex-column flex-lg-row   pt-1">

        <div class="col">
            <h2 class=""><?php echo __( 'В яких випадках потрібна консультація алерголога', 'vitamed' ) ?></h2>
        </div>

        <div class="col">
            <?php echo $reasons_consultation; ?>
        </div>
    </div>
</div>
