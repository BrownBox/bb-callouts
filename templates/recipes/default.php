<?php

if (has_post_thumbnail($callout->ID)) {
    $image = wp_get_attachment_image_src(get_post_thumbnail_id($callout->ID), 'full');
    $style .= 'background-image: url('.$image[0].');';
}

echo '<style>';
echo '#callout-'.$callout->ID.' { '.$style.' }';
echo '</style>';
?>
<div class="small-24 medium-24 large-24 columns">
<?php
if (bb_callout_show_title($callout)) {
?>
    <h1><?php echo $callout->post_title; ?></h1>
<?php
}
echo apply_filters('the_content', $callout->post_content);
if (!empty(get_post_meta($callout->ID, 'destination', true))) {
?>
    <p class="action-button"><a href="<?php echo get_post_meta($callout->ID, 'destination', true); ?>" class="button flat small"><?php echo get_post_meta($callout->ID, 'action_text', true); ?></a></p>
<?php
}
?>
</div>
