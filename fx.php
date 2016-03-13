<?php
function bb_get_callouts(array $params = array()) {
    global $post;
    $args = array(
            'posts_per_page' => -1,
            'post_type' => 'callout',
            'orderby' => 'menu_order',
            'order' => 'DESC',
            'tax_query' => array(
                    array(
                            'taxonomy' => 'pageascategory',
                            'field' => 'slug',
                            'terms' => (string)$post->ID,
                    ),
            ),
    );
    return get_posts($args);
}

add_shortcode('bb_callouts', 'bb_show_callouts');
function bb_show_callouts($atts) {
    $callouts = bb_get_callouts();

    foreach ($callouts as $callout) {
        $args = array(
                'posts_per_page' => -1,
                'post_type' => 'callout',
                'orderby' => 'menu_order',
                'order' => 'DESC',
                'post_parent' => $callout->ID,
        );
        $slides = get_posts($args);
        if (count($slides) > 0) {
            include(BB_CALLOUTS_TEMPLATE_DIR.'slider.php');
        } else {
            include(BB_CALLOUTS_TEMPLATE_DIR.'banner.php');
        }
    }
}

function bb_callouts_get_recipes() {
    $recipes = array();
    $dir = opendir(BB_CALLOUTS_TEMPLATE_DIR.'recipes/');
    while (false !== ($filename = readdir($dir))) {
        if (strpos($filename, '.php') !== false) {
            $recipes[] = str_replace('.php', '', $filename);
        }
    }
    return $recipes;
}

function bb_callouts_get_recipe_options() {
    $recipes = bb_callouts_get_recipes();
    sort($recipes);
    $recipe_options = array();
    foreach ($recipes as $recipe) {
        $recipe_options[$recipe] = ucwords(str_replace('_', ' ', $recipe));
    }
    return $recipe_options;
}

function bb_callout_cook_recipe($callout) {
    include(BB_CALLOUTS_TEMPLATE_DIR.'recipes/'.get_post_meta($callout->ID, 'recipe', true).'.php');
}

function bb_callout_show_title($callout) {
    $hide_title = get_post_meta($callout->ID, 'hide_title', true);
    return empty($hide_title);
}
