<?php get_header(); ?>
<section class="container single-content">
    <div class="row single-page-row">
        <div class="col-lg-9">
            <div class="single-content1">
                <?php while (have_posts()): the_post(); ?>
                    <h1><?php the_title() ?></h1>
                    <?php
                    $thumbail_id = get_post_thumbnail_id();
                    $attachment_url = get_attachment_link($thumbail_id);
                    ?>
                    <?php if (!has_post_format('gallery') && !has_post_format('video')) { ?>
                        <div>
                            <a href="<?= $attachment_url ?>" target="_blank">
                                <img
                                    src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "size9")[0]; ?>"
                                    alt="<?php the_title() ?>" title="<?php the_title() ?>">
                            </a>
                            <div class="post_meta">
                                <h2><?php echo convert_date("fa", get_the_time('Y-m-d')) ?></h2>
                            </div>
                        </div>
                    <?php } ?>
                    <?php the_content(); ?>

                    <?php
                    $tags = get_the_tags(get_the_ID());
                    ?>
                    <?php if (!empty($tags)): ?>
                        <?php foreach ($tags as $tag): ?>
                            <a href="<?= get_site_url() . '/tag/' . $tag->slug; ?>" class="tags" target="_blank"><?= $tag->name ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <div class="social_share_area">
                        <h4>اشتراک گذاری</h4>
                        <?php echo do_shortcode('[Sassy_Social_Share]'); ?>
                    </div>
                <?php endwhile; ?>
            </div>
            <!-- single-content1 -->

            <div class="content-news-style2 related_posts">
                <h1>خبرهای مرتبط</h1>
                <div class="row">
                    <?php
                    global $post;
                    $categories = get_the_category($post->ID);
                    $category_ids = wp_list_pluck($categories, 'term_id');

                    $args = array(
                        'category__in' => $category_ids,
                        'post__not_in' => array($post->ID),
                        'posts_per_page' => 4,
                    );
                    $related_news = new wp_query($args);
                    ?>
                    <?php if ($related_news->have_posts()): ?>
                        <?php while ($related_news->have_posts()) {
                            $related_news->the_post(); ?>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-12 left-side">
                                <div class="row left-side-row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-4 left-side-img">
                                        <a href="<?php the_permalink() ?>">
                                            <img alt="<?php the_title() ?>" title="<?php the_title() ?>" class="img-fluid" src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "size6")[0]; ?>">
                                        </a>
                                        <div class="hover-layer-style1">
                                            <div class="dp-table">
                                                <div class="dp-cell">
                                                    <a href="<?php the_permalink() ?>" class="fas  fa-link"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-8 left-side-content">
                                        <h2>
                                            <a href="<?php the_permalink() ?>">
                                                <?php
                                                echo wp_trim_words(get_the_title(), 15, '...');
                                                ?>
                                            </a>
                                        </h2>
                                        <time class="date">
                                            <?php echo convert_date("fa", get_the_time('Y-m-d')) ?>
                                        </time>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</section>
<?php get_footer(); ?>