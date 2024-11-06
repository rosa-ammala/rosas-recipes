<?php
/* register the new post type: recipe card */
function rcards_register_post_type() {

    $labels = array(
        'name' => 'Recipe Cards',
        'singular_name' => 'Recipe Card',
        'add_new' => 'New recipe card',
        'add_new_item' => 'Add new recipe',
        'edit_item' => 'Edit recipe',
        'new_item' => 'New recipe',
        'view_item' => 'View recipes',
        'search_items' => 'Search recipes',
        'not_found' => 'Recipes not found',
        'not_found_in_trash' => 'Recipes not found in trash'
    );

    $args = array(
        'labels' => $labels,
        'has_archive' => true,
        'public' => true,
        'hierarchical' => false,
        'supports' => array(
            'title', 
            'editor', 
            'thumbnail',
            'excerpt',
            'comments',
        ),
        'rewrite' => array('slug' => 'recipe'),
        'show_in_rest' => true
    );

    register_post_type('recipe_card', $args);
}

add_action('init', 'rcards_register_post_type');

/* add ingredients, instructions and time boxes */
function recipe_custom_meta_boxes() {
    add_meta_box('recipe_cooking_time', 'Cooking time', 'recipe_cooking_time_callback', 'recipe_card', 'normal', 'high');
    add_meta_box('recipe_ingredients', 'Ingredients', 'recipe_ingredients_callback', 'recipe_card', 'normal', 'high');
    add_meta_box('recipe_instructions', 'Instructions', 'recipe_instructions_callback', 'recipe_card', 'normal', 'high');
}
add_action('add_meta_boxes', 'recipe_custom_meta_boxes');

function recipe_cooking_time_callback($post) {
    $cooking_time = get_post_meta($post->ID, '_recipe_cooking_time', true);
    echo '<input type="text" style="width:100%;" name="recipe_cooking_time" value="' . esc_attr($cooking_time) . '" placeholder="e.g 30 minutes">';
}

function recipe_ingredients_callback($post) {
    $ingredients = get_post_meta($post->ID, '_recipe_ingredients', true);
    echo '<p>Please enter the ingredients separated by commas (e.g., "2 cups flour, 1 cup sugar").</p>';
    echo '<textarea style="width:100%;height:100px;" name="recipe_ingredients">' . esc_textarea($ingredients) . '</textarea>';
}

function recipe_instructions_callback($post) {
    $instructions = get_post_meta($post->ID, '_recipe_instructions', true);
    echo '<p>Please enter the instructions for the recipe, separated by ".,"</p>';
    echo '<textarea style="width:100%;height:100px;" name="recipe_instructions">' . esc_textarea($instructions) . '</textarea>';
}

/* save fields */
function save_recipe_meta($post_id) {
    if (array_key_exists('recipe_cooking_time', $_POST)) {
        update_post_meta($post_id, '_recipe_cooking_time', sanitize_text_field($_POST['recipe_cooking_time']));
    }
    if (array_key_exists('recipe_ingredients', $_POST)) {
        update_post_meta($post_id, '_recipe_ingredients', sanitize_text_field($_POST['recipe_ingredients']));
    }
    if (array_key_exists('recipe_instructions', $_POST)) { // Lisää uusi rivi ohjeiden tallentamiseksi
        update_post_meta($post_id, '_recipe_instructions', sanitize_textarea_field($_POST['recipe_instructions']));
    }
}
add_action('save_post', 'save_recipe_meta');

/* register new taxonomy: recipe category */
function rcards_register_taxonomy() {
    $labels = array(
        'name' => 'Recipe categories',
        'singular_name' => 'Recipe category',
        'search_items' => 'Search recipe categories',
        'all_items' => 'All recipe categories',
        'edit_items' => 'Edit recipe category',
        'update_item' => 'Update recipe category',
        'add_new_items' => 'Add new recipe category',
        'new_item_name' => 'New recipe category name',
        'menu_item' => 'Recipe categories'
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'sort' => true,
        'args' => array('orderby' => 'term_order'),
        'rewrite' => array('slug' => 'recipes'),
        'show_admin_column' => true,
        'show_in_rest' => true
    );

    register_taxonomy('rcards_category', array('recipe_card'), $args);
}

add_action('init', 'rcards_register_taxonomy');

?>