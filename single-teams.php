<?php get_header(); ?>
<section class="container single-content">
    <div class="row single-page-row">
        <div class="col-lg-9">
            <div class="single-content1">
                <?php while (have_posts()): the_post(); ?>
                    <?php
                    $thumbail_id = get_post_thumbnail_id();
                    $attachment_url = get_attachment_link($thumbail_id);
                    ?>

                    <h1><?php the_title() ?></h1>
                    <div class="mb-4">
                        <a href="<?= $attachment_url ?>" target="_blank">
                            <img
                                src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "size9")[0]; ?>"
                                alt="<?php the_title() ?>" title="<?php the_title() ?>">
                        </a>
                    </div>

                    <?php
                    $taxnomies = get_the_terms(get_the_ID(), 'contracts');
                    $categories = get_the_category(get_the_ID());
                    ?>

                    <?php if (!empty($taxnomies)): ?>
                        <?php foreach ($taxnomies as $tax): ?>
                            <a href="<?= get_site_url() . '/' . $tax->taxonomy . '/' . $tax->slug; ?>" class="tags" target="_blank"><?= $tax->name ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $cat): ?>
                            <a href="<?= get_site_url() . '/category/' . $cat->slug; ?>" class="tags" target="_blank"><?= $cat->name ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php the_content(); ?>

                    <?php
                    $email = get_post_meta(get_the_ID(), "_email_field", true);
                    $phone = get_post_meta(get_the_ID(), "_phone_field", true);
                    ?>
                    <?php if ($email != ""): ?>
                        <div class="my-3">
                            <a href="mailto:<?= $email ?>" class="text-dark">
                                <i class="fas fa-envelope mx-2 text-dark"></i>
                                <?= $email ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($phone != ""): ?>
                        <div class="my-3">
                            <a href="tel:<?= $phone ?>" class="text-dark">
                                <i class="fas fa-phone mx-2 text-dark"></i>
                                <?= $phone ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="social_share_area">
                        <h4>اشتراک گذاری</h4>
                        <?php echo do_shortcode('[Sassy_Social_Share]'); ?>
                    </div>

                <?php endwhile; ?>
            </div>
            <div class="content-news-style2 related_posts w-100">
                <h1>مطالب مرتبط</h1>
                <?php
                // Get current team member id
                $current_team_id = $post->ID;
                // Get the categories of current team member
                $categories = get_the_terms($current_team_id, 'category');
                // Extract the categories' IDs
                $category_ids = wp_list_pluck($categories, 'term_id');
                ?>
                <?php if (!empty($category_ids)): ?>
                    <div class="row">
                        <?php
                        // Query to get related teams in the teams custom post type
                        $related_args = array(
                            'post_type' => "teams", // Define Post Type
                            'posts_per_page' => 4, // Number of team member to dispaly
                            'post__not_in' => array($current_team_id), // Exclude current team member
                            'tax_query' => array( // Get all the team members by categories' IDs
                                array(
                                    'taxonomy' => "category",
                                    'field' => "term_id",
                                    'terms' => $category_ids,
                                )
                            )
                        );
                        $related_team_query = new WP_Query($related_args);
                        ?>
                        <?php if ($related_team_query->have_posts()):  ?>
                            <?php while ($related_team_query->have_posts()): $related_team_query->the_post(); ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 left-side">
                                    <div class="row left-side-row">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-4 left-side-img">
                                            <a href="<?php the_permalink() ?>">
                                                <img
                                                    src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "size6")[0]; ?>"
                                                    alt="<?php the_title() ?>"
                                                    title="<?php the_title() ?>"
                                                    class="img-fluid">
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
                                                <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</section>
<?php get_footer(); ?>