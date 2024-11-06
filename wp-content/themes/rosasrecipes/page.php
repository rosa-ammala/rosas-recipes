<?php

get_header(); ?>

<header id="site-header">
    <h1><?php the_title_attribute(); ?></h1>
</header>

<!-- FAQs and Contact Us pages -->
<div id="content">
    <main>
        <?php
        if (have_posts()) :

            while(have_posts()) : the_post(); ?>
            <article>
                <h2 id="title-to-hide"><?php the_title(); ?></h2>
                <?php the_content(); ?>
            </article>
            <?php
            endwhile;

        endif; ?>
    </main>
</div> <!-- content -->
<?php
get_footer();
?>
