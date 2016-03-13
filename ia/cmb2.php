<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @package  BB_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap!
 */
if (file_exists(dirname(__FILE__) . '/cmb2/init.php')) {
	require_once dirname(__FILE__) . '/cmb2/init.php';
} elseif (file_exists(dirname(__FILE__) . '/CMB2/init.php')) {
	require_once dirname(__FILE__) . '/CMB2/init.php';
}

add_action('cmb2_admin_init', 'bb_callouts_register_callout_metabox');
function bb_callouts_register_callout_metabox() {
	// Start with an underscore to hide fields from custom fields list

	$cmb = new_cmb2_box(array(
    		'id'            => BB_CALLOUTS_FIELD_PREFIX . 'metabox',
    		'title'         => __('Additional Callout Details', BB_CALLOUTS_NS),
    		'object_types'  => array('callout'),
    		'context'       => 'side',
    		'priority'      => 'high',
	));

	$cmb->add_field(array(
	        'name'    => __('Hide Title', BB_CALLOUTS_NS),
	        'id'      => BB_CALLOUTS_FIELD_PREFIX . 'hide_title',
	        'type'    => 'checkbox',
	));

	$cmb->add_field(array(
        	'name' => __('Additional Image', BB_CALLOUTS_NS),
        	'desc' => __('Some recipes will display an additional image alongside the content', BB_CALLOUTS_NS),
        	'id'   => BB_CALLOUTS_FIELD_PREFIX.'image',
        	'type' => 'file',
	));

	$cmb->add_field(array(
    		'name'    => __('Image Position', BB_CALLOUTS_NS),
    		'id'      => BB_CALLOUTS_FIELD_PREFIX . 'image_pos',
    		'type'    => 'radio',
	        'default' => 'left',
    		'options' => array(
        			'left' => __('Left', BB_CALLOUTS_NS),
        			'right' => __('Right', BB_CALLOUTS_NS),
    		),
	        'show_on_cb' => 'bb_callouts_show_additional_image_options',
	));

	/*

	$cmb->add_field(array(
    		'name'    => __('Vertical Image Position', ns_),
    		'id'      => BB_CALLOUTS_FIELD_PREFIX . 'bgpos_y',
    		'type'    => 'radio',
	        'default' => 'center',
    		'options' => array(
        			'top' => __('Top', ns_),
        			'center' => __('Centre', ns_),
        			'bottom' => __('Bottom', ns_),
    		),
	));

	$cmb->add_field(array(
    		'name'    => __('Horizontal Image Position', ns_),
    		'id'      => BB_CALLOUTS_FIELD_PREFIX . 'bgpos_x',
    		'type'    => 'radio',
	        'default' => 'center',
    		'options' => array(
        			'left' => __('Left', ns_),
        			'center' => __('Centre', ns_),
        			'right' => __('Right', ns_),
    		),
	));*/
}

function bb_callouts_show_additional_image_options($field) {
    return !empty(get_post_meta($field->object_id, BB_CALLOUTS_FIELD_PREFIX.'image', true));
}
