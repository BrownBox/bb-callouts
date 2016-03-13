<?php
// Include ACF
require_once (BB_CALLOUTS_DIR.'fields/acf.php');

// Customize ACF path
add_filter('acf/settings/path', 'bb_callouts_acf_settings_path');
function bb_callouts_acf_settings_path($path) {
    $path = BB_CALLOUTS_DIR.'fields/';
    return $path;
}

// Customize ACF dir
add_filter('acf/settings/dir', 'bb_callouts_acf_settings_dir');
function bb_callouts_acf_settings_dir($dir) {
    $dir = BB_CALLOUTS_DIR.'fields/';
    return $dir;
}

// Set save dir
add_filter('acf/settings/save_json', 'bb_callouts_acf_json_save_point');
function bb_callouts_acf_json_save_point($path) {
    $path = BB_CALLOUTS_DIR.'fields/json/';
    return $path;
}

// Add dir to load files from
add_filter('acf/settings/load_json', 'bb_callouts_acf_json_load_point');
function bb_callouts_acf_json_load_point($paths) {
    $paths[] = BB_CALLOUTS_DIR.'fields/json/';
    return $paths;
}

// Populate recipe drop-down
add_filter('acf/load_field/name=recipe', 'bb_callouts_load_recipe_field_choices');
function bb_callouts_load_recipe_field_choices($field) {
    $field['choices'] = bb_callouts_get_recipe_options();
    return $field;
}

// Hide ACF field group menu item
// add_filter('acf/settings/show_admin', '__return_false');
