<?php
add_action('wp_enqueue_scripts', 'bb_callouts_enqueue');
function bb_callouts_enqueue() {
	wp_enqueue_style('slick', plugins_url('css/vendor/slick.css', __FILE__));
	wp_enqueue_style('callouts', plugins_url('css/callouts.css', __FILE__));

    wp_enqueue_script('slick', plugins_url('js/vendor/slick.min.js', __FILE__), array('jquery'), '1.5.8', true);
    wp_enqueue_script('callouts', plugins_url('js/callouts.js', __FILE__), array('jquery', 'slick'), '0.0.1', true);
}
