<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post(); ?>
        <header id="site-header">
            <h1><?php the_title(); ?></h1>
        </header>

        <div id="content">
            <main id="recipe-content">
                <article>
                    <!-- date, categories and cooking time -->
                    <div class="recipe-meta">
                        <div class="meta-item">
                            <h3>Published on:</h3>
                            <p><?php echo get_the_date(); ?></p>
                        </div>
                        <div class="meta-item">
                            <h3>Categories:</h3>
                            <p><?php echo get_the_term_list(get_the_ID(), 'rcards_category', '', ', '); ?></p>
                        </div>
                        <div class="meta-item">
                            <h3>Cooking time:</h3>
                            <p><?php echo esc_html(get_post_meta(get_the_ID(), '_recipe_cooking_time', true)); ?></p>
                        </div>
                    </div>

                    <!-- image and ingredients inline -->
                    <div class="recipe-content-wrapper" style="display: flex;">
                        <!-- image -->
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="recipe-thumbnail">
                                <?php the_post_thumbnail(); ?>
                            </div>
                        <?php endif; ?>

                        <!-- ingredients -->
                        <div class="recipe-ingredients">
                                <h3>Ingredients</h3>
                                <ul><?php 
                                    $ingredients = get_post_meta(get_the_ID(), '_recipe_ingredients', true);
                                    if ($ingredients) {
                                        $ingredients_array = explode(',', $ingredients);
                                        foreach ($ingredients_array as $ingredient) {
                                            echo '<li>' . esc_html(trim($ingredient)) . '</li>';
                                        }
                                    } else {
                                        echo '<li>No ingredients found.</li>';
                                    }
                                ?></ul>
                        </div>
                    </div>

                    <!-- instructions -->
                    <h3>Instructions</h3>
                        <ol>
                            <?php 
                            $instructions = get_post_meta(get_the_ID(), '_recipe_instructions', true);
                            if ($instructions) {
                                $instructions_array = explode('.,', $instructions);
                                foreach ($instructions_array as $instruction) {
                                    echo '<li>' . esc_html(trim($instruction)) . '</li>';
                                }
                            } else {
                                echo '<li>No instructions found.</li>';
                            }
                            ?>
                        </ol>

                    <!-- Avainsanat 
                    <div class="recipe-tags">
                        <?php the_tags('<h3>Tags:</h3><ul><li>', '</li><li>', '</li></ul>'); ?>
                    </div>-->
                </article>
            </main>
        </div>
    <?php endwhile;
endif;

get_footer();
?>
