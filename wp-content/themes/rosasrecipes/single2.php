<?php

get_header();

if (get_post_type() === 'recipe_card') :
    ?>
        <header id="site-header">
            <h1><?php the_title(); ?></h1>
        </header>
    
        <div id="content">
            <main id="content-single">
                <article>
                    <?php the_content(); ?>
                </article>
            </main>
        </div>


<?php
endif;
get_footer();
?>
