<?php

get_header(); ?>

<header id="site-header">
    <h1><?php bloginfo('name'); ?></h1>
</header>

<div id="content">

    <main>
        <!-- home description -->
        <?php $home_category = get_category_by_slug('home');
        if ($home_category && category_description($home_category->term_id)) : ?>
            <div class="home-category-description">
                <?php echo category_description($home_category->term_id); ?>
            </div>
        <?php 
        endif; ?>

        <!-- categories -->
        <h2>Browse by category</h2>
        <div class="category-list">
            <?php 
            $categories = get_terms(array(
                'taxonomy' => 'rcards_category',
                'hide_empty' => true,
                'orderby' => 'id',
                'order' => 'ASC',
            ));

            if (!is_wp_error($categories) && !empty($categories)) :
                foreach ($categories as $category) :
                    $category_link = get_term_link($category); ?>
                    <div class="category-item">
                        <a href="<?php echo esc_url($category_link); ?>" class="category-link">
                            <?php echo esc_html($category->name); ?>
                        </a>
                    </div>
                <?php endforeach;
            else: ?>
                <p>No recipe categories found.</p>
            <?php endif; ?>
        </div>
        
        <!-- popular recipes widget -->
            <!--<?php echo do_shortcode('[recipe-cards top="3"]'); ?> -->
            <?php 
            if (is_active_sidebar('homepage_widget')) {
                dynamic_sidebar('homepage_widget');
            } 
            ?>
    </main>
</div>

<?php
get_footer();
?>