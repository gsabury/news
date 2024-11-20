<?php get_header(); ?>
<section class="container single-content">
    <div class="row single-page-row">
        <div class="col-lg-9">
            <?php while (have_posts()): the_post(); ?>
                <div class="single-content1">
                    <h1><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </div>
            <?php endwhile; ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</section>
<?php get_footer(); ?>