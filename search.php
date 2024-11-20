<?php get_header(); ?>
<section class="container search-page">
    <div class="row search-page-row py-3">
        <div class="col-lg-9">
            <div class="search-page-content1">
                <h1>
                    نتیجه جستجو برای:
                    <span>'<?= isset($_GET['s']) ? $_GET['s'] : ''; ?>'</span>
                </h1>
                <?php if (have_posts()): ?>
                    <?php while (have_posts()): the_post(); ?>
                        <div class="search-result">
                            <h2 class="search_result_title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <p>
                                <?php
                                $content = strip_tags(get_the_content());
                                $content = wp_trim_words($content, 30, '...');
                                echo $content;
                                ?>
                            </p>
                            <div class="more-info">
                                <a href="<?php the_permalink(); ?>" class="btn btn-danger hvr-shutter-out-vertical">
                                    ادامه مطلب
                                </a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <h2 class="title404 text-center">
                        متاسفانه برای کلمه کلیدی شما در وبسایت چیزی یافت نگردید. لطفا با کلمات کلیدی دیگر امتحان کنید
                    </h2>
                <?php endif; ?>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</section>
<?php get_footer(); ?>