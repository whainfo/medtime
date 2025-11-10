<?php
/**
 * ACF: Flexible Content > Layouts > Content
 *
 * @package WordPress
 * @subpackage QORP
 */

$key = isset($args['key']) ? $args['key'] : 0;
$aos_delay = 0;
if ($key > 0) {
    $aos_delay = 300;
}
$text = $args['section']['text'];

?>
<section class="section-wrapper wrapper position-relative ">
    <div class="container">
        <div class="row justify-content-between   ">
            <div class="col-12 ">
                <?php echo $text ?>
            </div>
        </div>
    </div>
</section>