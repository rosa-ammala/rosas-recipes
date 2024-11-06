<?php
/* 
Plugin Name: Recipe Cards
Description: Plugin to making new recipes and showing them.
Author: Rosa Ämmälä
*/
require_once('includes/recipe-cards-post-type.php');
require_once('includes/recipe-cards-shortcodes.php');
require_once('includes/recipe-cards-widget.php');

function rcards_setup_menu() {
    add_menu_page('Recipe Cards', 'Recipe Cards', 'manage_options', 'recipe-cards', 'rcards_display_admin_page');
}

function rcards_display_admin_page() {
    echo '<h1>Recipe cards</h1>';
    echo '<p>Use shortcode <code>[recipe-cards]</code> to display all recipes or <code>[recipe-cards category="your-category"]</code> for specific categories.</p>';
    echo '<p>Try out the Recipe Cards widget in your sidebar!</p>';
}

add_action('admin_menu', 'rcards_setup_menu');

function rcards_assets() {
    wp_enqueue_style('rcards-css', plugin_dir_url(__FILE__) . 'css/recipe-cards.css');
}

add_action('wp_enqueue_scripts', 'rcards_assets');

function my_theme_setup() {
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'my_theme_setup');

?>