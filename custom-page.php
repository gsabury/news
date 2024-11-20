<?php
/* 
    Template Name: Contact Us
    Template Post Type: page
 */
?>
<?php get_header(); ?>
<section class="container single-content">
    <div class="row single-page-row">
        <div class="col-lg-9">
            <?php while (have_posts()): the_post(); ?>
                <div class="single-content1">
                    <h1><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                    <?php
                    echo do_shortcode('[contact-form-7 id="9bc5b88" title="فرم تماس 1"]');
                    ?>
                </div>
            <?php endwhile; ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</section>
<?php get_footer(); ?>