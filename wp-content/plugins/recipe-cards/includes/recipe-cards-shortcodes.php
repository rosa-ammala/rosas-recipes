<?php
function rcards_shortcode($attr) {
    $attr = shortcode_atts(array(
        'category' => 'all', 
        'top' => -1, // By default show all unless specified
    ), $attr);

    $query_args = array(
        'post_type'      => 'recipe_card',
        'posts_per_page' => intval($attr['top']),
        'orderby'        => 'date',
        'order'          => 'DESC',
        'tax_query'      => $attr['category'] !== 'all' ? array(
            array(
                'taxonomy' => 'rcards_category',
                'field'    => 'slug',
                'terms'    => $attr['category'],
            ),
        ) : array(),
    );

    $recipes = new WP_Query($query_args);

    ob_start();

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
                    endif;
                    ?>
                </div>

            </section>
            <?php
        endwhile;
        echo '</div>';
    else :
        echo '<p>No recipes found.</p>';
    endif;
    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode('recipe-cards', 'rcards_shortcode');

?>