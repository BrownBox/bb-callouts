<!-- CALL TO ACTION -->
<div class="callout-wrapper callout-slider">
<?php
foreach ($slides as $callout) {
    $style = 'style="';
    if (has_post_thumbnail($callout->ID)) {
        $image = wp_get_attachment_image_src(get_post_thumbnail_id($callout->ID), 'full');
        $style .= 'background-image: url('.$image[0].');';
    }
    $style .= '"';
?>
    <div id="callout-<?php echo $callout->ID; ?>" class="callout-inner-wrapper <?php echo get_post_meta($callout->ID, 'recipe', true); ?>" <?php echo $style; ?>>
        <div style="<?php //echo $bg;?>;" class="callout-box row">
            <?php bb_callout_cook_recipe($callout); ?>
        </div>
    </div>
<?php
}
?>
</div>
