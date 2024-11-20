<?php get_header(); ?>
<section class="container single-content">
    <div class="row single-page-row">
        <?php
        while (have_posts()): the_post();
            $attachment_title = get_the_title();
            $attachment_url = wp_get_attachment_url(get_the_ID());
        ?>
            <div class="col-lg-9">
                <div class="single-content1">
                    <h1><?= $attachment_title ?></h1>
                    <img src="<?= $attachment_url ?>" class="img-fluid d-flex m-auto" title="<?= $attachment_title ?>" alt="<?= $attachment_title ?>">
                    <p class="text-center mt-2 mb-2">
                        <?= get_the_excerpt() ?>
                    </p>
                    <a href="<?= $attachment_url ?>" download class="text-center d-block">دانلود</a>
                </div>
            </div>
        <?php endwhile; ?>
        <?php get_sidebar(); ?>
    </div>
</section>
<?php get_footer(); ?>