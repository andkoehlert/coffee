<?php get_header() ?>

<div class="content">
    <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
            <?php the_content(); ?>
        </article>
    <?php endwhile; ?>
</div>

<?php get_footer() ?>
