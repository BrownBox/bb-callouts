<?php
require_once(BB_CALLOUTS_CLASS_DIR.'cpt_.php');
require_once(BB_CALLOUTS_CLASS_DIR.'meta_.php');
require_once(BB_CALLOUTS_CLASS_DIR.'tax_.php');
require_once(BB_CALLOUTS_CLASS_DIR.'tax_meta_.php');

new bb_callouts\cptClass('Callout','Callouts', array(
        'public' => true,
        'has_archive' => false,
        'query_var' => false,
        'show_ui' => true,
));

// $callout_fields = array(
//         array(
//                 'type' => 'text',
//                 'title' => 'Action Text',
//                 'field_name' => 'action_text',
//         ),
//         array(
//                 'type' => 'text',
//                 'title' => 'Destination URL',
//                 'field_name' => 'destination',
//                 'placeholder' => 'http://'
//         ),
//         array(
//                 'type' => 'text',
//                 'title' => 'Callout name (class used for styling)',
//                 'field_name' => 'callout_name',
//                 'placeholder' => ''
//         ),
//         array(
//                 'type' => 'select',
//                 'title' => 'Recipe',
//                 'field_name' => 'recipe',
//                 'options' => bb_callouts_get_recipe_options(),
//         ),
// );

// new bb_callouts\metaClass('Call To Action', array('callout'), $callout_fields);

new bb_callouts\taxClass('Page as Category', 'Pages as Categories', array('callout'));

/*
 * Page as category
*/
function bb_callouts_page_as_category($post_id) {
    // We don't want to do anything when autosaving a draft
    $post = get_post($post_id);
    if (wp_is_post_autosave($post_id) || $post->post_status == 'auto-draft')
        return;

    // Now let's make sure we have the right ID
    $revision = wp_is_post_revision($post_id);
    if ($revision) {
        $post_id = $revision;
        $post = get_post($post_id);
    }

    // Need to mirror the page hierarchy
    $parent_id = $post->post_parent;
    $parent_cat_id = 0;
    if ($parent_id > 0) {
        $parent_category = get_term_by('slug', $parent_id, 'pageascategory');
        if ($parent_category)
            $parent_cat_id = (int)$parent_category->term_id;
    }

    $category = get_term_by('slug', $post_id, 'pageascategory');
    if ($category) { // Update
        wp_update_term((int)$category->term_id, 'pageascategory', array(
        'name' => $post->post_title,
        'slug' => $post_id,
        'parent'=> $parent_cat_id
        )
        );
    } else { // Create
        wp_insert_term($post->post_title, 'pageascategory', array(
        'slug' => $post_id,
        'parent'=> $parent_cat_id
        )
        );
    }
}
add_action('save_post_page', 'bb_callouts_page_as_category');

function bb_callouts_refresh_page_hierarchy($post_id) {
    // Update child pages (which will in turn update their terms)
    $args = array(
            'post_parent' => $post_id,
            'post_type' => 'page',
    );
    $children = get_children($args);
    foreach (array_keys($children) as $child_id) {
        wp_update_post(array('ID' => $child_id));
    }

    return true;
}
add_action('before_delete_post', 'bb_callouts_refresh_page_hierarchy');

function bb_callouts_delete_page_as_category($post_id) {
    // If it's only a revision, ignore
    if (wp_is_post_revision($post_id))
        return true;

    $category = get_term_by('slug', $post_id, 'pageascategory');
    if ($category) {
        // Delete term relationships
        global $wpdb;
        $wpdb->query($wpdb->prepare( 'DELETE FROM '.$wpdb->term_relationships.' WHERE term_taxonomy_id = %d', $category->term_id));

        // Delete from users
        $users = get_users();
        foreach ($users as $user) {
            $pages = get_user_meta($user->ID, 'pageascategory', true);
            $pageArr = explode(',',$pages);
            $idx = array_search($category->term_id, $pageArr);
            if ($idx !== false) {
                unset($pageArr[$idx]);
                update_user_meta($user->ID, 'pageascategory', implode(',',$pageArr));
            }
        }

        // Delete term
        wp_delete_term($category->term_id, 'pageascategory');
    }

    return true;
}
add_action('deleted_post', 'bb_callouts_delete_page_as_category');

/*
 * End page as category
*/
