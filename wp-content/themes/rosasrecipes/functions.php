<?php 
update_option('siteurl', 'localhost');
update_option('home', 'localhost');


register_nav_menus([ 'primary' => 'Päävalikko' ]);

function rosasrecipes_assets() {
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_script('rosasrecipes-script', get_template_directory_uri() . '/js/rosasrecipes.js', array('jquery'), '1.0.0', true);
}

add_action('wp_enqueue_scripts','rosasrecipes_assets');

function rcards_widgets_init() {
    register_sidebar(array(
        'name' => 'Homepage Widget',
        'id' => 'homepage_widget',
        'before_widget' => '<div>',
        'after_widget' => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));
}

add_action('widgets_init', 'rcards_widgets_init');

function rosasrecipes_theme_setup() {
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'rosasrecipes_theme_setup');

// Rekisteröi reseptikorttipostityyppi
add_action('init', 'rcards_register_post_type');

// Rekisteröi mukautetut kentät
add_action('init', 'rcards_register_taxonomy');

?>