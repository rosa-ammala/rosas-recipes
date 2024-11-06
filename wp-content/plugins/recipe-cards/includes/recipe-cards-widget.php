<?php

class Rcards_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'rcards_widget',
            'Popular Recipes',
            array(
                'description' => 'Displays the most popular recipes based on view count.'
            )
        );
    }

    public function form($instance) {
        
        $title = !empty($instance['title']) ? $instance['title'] : 'Popular Recipes';
        $number = !empty($instance['number']) ? $instance['number'] : 6;
        $selected_category = !empty($instance['selected_category']) ? $instance['selected_category'] : '';

        $categories = get_terms(array(
            'taxonomy' => 'rcards_category',
            'hide_empty' => false,
        ));
        ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:</label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
                name="<?php echo esc_attr($this->get_field_name('title')); ?>" 
                value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>">Number:</label>
            <input type="number" class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('number')); ?>"
                   value="<?php echo esc_attr($number); ?>" min="1">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('selected_category')); ?>">Select Category:</label>
            <select class="widefat" id="<?php echo esc_attr($this->get_field_id('selected_category')); ?>"
                    name="<?php echo esc_attr($this->get_field_name('selected_category')); ?>">
                <option value=""><?php _e('All Categories', 'text_domain'); ?></option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?php echo esc_attr($category->term_id); ?>" <?php selected($selected_category, $category->term_id); ?>>
                        <?php echo esc_html($category->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

    <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = isset($new_instance['title']) ? wp_strip_all_tags($new_instance['title']) : '';
        $instance['number'] = isset($new_instance['number']) ? absint($new_instance['number']) : '';
        $instance['selected_category'] = isset($new_instance['selected_category']) ? absint($new_instance['selected_category']) : '';
        return $instance;
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        $title = $instance['title'] ?? 'Most viewed recipes';
        $number = $instance['number'] ?? 3;
        $selected_category = $instance['selected_category'] ?? '';

        if ($title) echo $args['before_title'] . esc_html($title) . $args['after_title'];

        $query_args = array(
            'post_type'      => 'recipe_card',
            'post_status'    => 'publish',
            'posts_per_page' => $number,
            'meta_key'       => 'view_count',
            'orderby'        => 'meta_value_num',
            'order'          => 'DESC'
        );

        if (!empty($selected_category)) {
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'rcards_category',
                    'field'    => 'term_id',
                    'terms'    => $selected_category,
                ),
            );
        }

        $recipes = new WP_Query($query_args);
        if ($recipes->have_posts()) :
            echo '<div class="recipe-cards">';

            while ($recipes->have_posts()) : $recipes->the_post();
                ?>
                <section class="recipe-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </a>
                    <?php endif; ?>    

                    <div class="recipe-card-content">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                        <p class="date"><?php echo get_the_date(); ?></p>

                        <?php 
                        $categories = get_the_terms(get_the_ID(), 'rcards_category');
                        if ($categories && !is_wp_error($categories)) :
                            echo '<p class="category">';
                            foreach ($categories as $category) {
                                $category_link = home_url('/recipes/' . $category->slug);
                                echo '<a href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a> ';
                            }
                            echo '</p>';
                        endif;
                        ?>
                    </div>
                </section>
                <?php
            endwhile;

            echo '</div>';
        else :
            echo '<p>No popular recipes found.</p>';
        endif;
        
        wp_reset_postdata();

        echo $args['after_widget'];
    }
}

function update_recipe_view_count() {
    if (is_singular('recipe_card')) {
        $post_id = get_the_ID();
        $views = (int) get_post_meta($post_id, 'view_count', true);
        update_post_meta($post_id, 'view_count', $views + 1);
    }
}
add_action('wp_head', 'update_recipe_view_count');

function rcards_register_widget() {
    register_widget('Rcards_Widget');
}

add_action('widgets_init', 'rcards_register_widget');

?>