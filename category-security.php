<?php get_header() ?>
<section class="container category-style3">
    <div class="row category-style3-row">
        <div class="col-lg-12">
            <div class="category-style3-content">
                <h1><?= single_cat_title(); ?></h1>
                <div class="row category-style3-item">
                    <?php if (have_posts()): ?>
                        <?php while (have_posts()): the_post(); ?>
                            <div class="col-lg-3 col-md-4 col-sm-4 col-6 item">
                                <div class="inner">
                                    <a href="#">
                                    </a>
                                    <div class="cat_img_outer">
                                        <a href="<?php the_permalink() ?>">
                                            <img
                                                src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "size10")[0]; ?>"
                                                class="img-fluid"
                                                title="<?php the_title() ?>"
                                                alt="<?php the_title() ?>">
                                        </a>
                                        <div class="hover-layer-style1">
                                            <div class="dp-table">
                                                <div class="dp-cell">
                                                    <a href="<?php the_permalink() ?>" class="fas  fa-link"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <article>
                                        <h1>
                                            <a href="<?php the_permalink() ?>">
                                                <?php echo wp_trim_words(get_the_title(), 15); ?>
                                            </a>
                                        </h1>
                                        <h2><?php echo convert_date("fa", get_the_time('Y-m-d')); ?></h2>
                                        <p>
                                            <?php
                                            $content = strip_tags(get_the_content());
                                            $content = wp_trim_words($content, 15, '...');
                                            echo $content;
                                            ?>
                                        </p>
                                    </article>
                                    <div class="more-info">
                                        <a href="<?php the_permalink() ?>" class="btn btn-danger hvr-shutter-out-vertical">ادامه مطلب</a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer() ?>