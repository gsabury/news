<?php get_header(); ?>
<section class="container category-page">
    <div class="row category-page-row">
        <div class="col-lg-9">
            <div class="category-page-content1">
                <h1><?= single_cat_title(); ?></h1>
                <?php if (have_posts()): ?>
                    <?php while (have_posts()): the_post(); ?>
                        <div class="row category-item">
                            <div class="col-lg-4 col-md-4 col-sm-5 col-5 categoryrightcol">
                                <div class="cat_img_outer">
                                    <img
                                        src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "size4")[0]; ?>"
                                        class="img-fluid"
                                        title="<?php the_title() ?>"
                                        alt="<?php the_title() ?>">
                                    <div class="hover-layer-style1">
                                        <div class="dp-table">
                                            <div class="dp-cell">
                                                <a href="<?php the_permalink() ?>" class="fas  fa-link"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 categoryleftcol col-md-8 col-sm-7 col-7">
                                <h1>
                                    <a href="<?php the_permalink() ?>">
                                        <?php echo wp_trim_words(get_the_title(), 15); ?>
                                    </a>
                                </h1>
                                <div class="post_meta">
                                    <h2>
                                        <?php echo convert_date("fa", get_the_time('Y-m-d')); ?>
                                    </h2>
                                    <p>
                                        <?php
                                        $content = strip_tags(get_the_content());
                                        $content = wp_trim_words($content, 30, '...');
                                        echo $content;
                                        ?>
                                    </p>
                                </div>
                                <div class="more-info">
                                    <a href="<?php the_permalink() ?>" class="btn btn-danger hvr-shutter-out-vertical">
                                        ادامه مطلب
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="row">
                        <div class="col-lg-12 categtory_not_post">
                            <h2 class="title404 text-center">
                                درین وبسایت هیچ مطلبی وجودد ندارد، لطفا کنید بعدا چک نمائید.
                            </h2>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</section>
<?php get_footer(); ?>