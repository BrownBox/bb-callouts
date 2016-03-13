<!-- CALL TO ACTION -->
<?php
// $outer_class = $class = '';
// $style = 'style="';
$callout_name = (!empty(get_post_meta($callout->ID, 'callout_name', true))) ? get_post_meta($callout->ID, 'callout_name', true) : $callout->ID;

// if (has_post_thumbnail($callout->ID)) {
//     $image = wp_get_attachment_image_src(get_post_thumbnail_id($callout->ID), 'full');
//     $style .= 'background-image: url('.$image[0].');';
// } else {
//     $outer_class = 'row';
//     $class = 'no-image';
// }
// $style .= '"';

// $bg = (!empty(get_post_meta($callout->ID, 'bb_callout_bg_color', true))) ? "background-color:".get_post_meta($callout->ID, 'bb_callout_bg_color', true) : '';

?>

<div id="callout-<?php echo $callout->ID; ?>" class="callout-wrapper <?php echo get_post_meta($callout->ID, 'recipe', true); ?>">
	<div style="<?php //echo $bg;?>;" class="callout-box row">
		<?php bb_callout_cook_recipe($callout); ?>
	</div>
</div>
