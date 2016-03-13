<?php
if (has_post_thumbnail($callout->ID)) {
    $image = wp_get_attachment_image_src(get_post_thumbnail_id($callout->ID), 'full');
    $style .= 'background-image: url('.$image[0].');';
}
if (!empty($style)) {
?>
<style>
    #callout-<?php echo $callout->ID; ?> {<?php echo $style; ?>}
</style>
<?php
}
$meta = get_post_meta($callout->ID);
$img_block = '<div class="image small-24 medium-6 large-6 columns">'."\n";
$img_block .= '<img src="'.$meta["image"][0].'" alt="">'."\n";
$img_block .= '</div>'."\n";
if($meta["image_pos"][0] == 'left') {
	echo $img_block;
}
?>
<div class="content small-24 medium-18 large-18 columns">
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
<?php } ?>
</div>
<?php
if($meta["image_pos"][0] == 'right') {
	echo $img_block;
}
?>