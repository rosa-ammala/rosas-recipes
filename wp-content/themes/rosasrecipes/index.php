<?php

get_header(); ?>

<header id="site-header">
    <h1><?php single_cat_title(); ?></h1>
</header>

<!-- recipes by category -->
<div id="content">
    <main>
        <div class="content-wrap">
            <div class="recipes-list">
                <?php
                if (have_posts()) {
                    // Get the current category object
                    $current_category = get_queried_object();
                    
                    // If the category object is valid, get its name
                    if ($current_category && isset($current_category->slug)) {
                        $category_slug = $current_category->slug;

                        echo do_shortcode('[recipe-cards category="' . esc_attr($category_slug) . '"]');
                    } else {
                        echo "<p>No recipes found for this category.</p>";
                    }
                } else {
                    echo "<p>This page is not a category archive.</p>";
                }
                ?>
            </div>

            <!-- sidebar -->
            <aside class="sidebar">
                <h3>Categories</h3>
                <ul class="category-list">
                <?php
                    $categories = get_terms(array(
                        'taxonomy' => 'rcards_category',
                        'hide_empty' => true,
                        'orderby' => 'name',
                        'order' => 'ASC'
                    ));
            
                    if (!is_wp_error($categories) && !empty($categories)) :
                        foreach ($categories as $category) :
                            $category_link = get_term_link($category); ?>
                            <li class="category-item">
                                <a href="<?php echo esc_url($category_link); ?>">
                                    <?php echo esc_html($category->name); ?>
                                </a>
                            </li>
                        <?php endforeach;
                    else: ?>
                        <li>No recipe categories available.</li>
                    <?php endif; ?>
                </ul>
            </aside>
        </div>
    </main>

</div> <!-- content -->
<?php
get_footer();
?>