<?php

function get_news_for_home_section3()
{
    register_widget('Home_Section_3_Widget');
}

add_action("widgets_init", "get_news_for_home_section3");

class Home_Section_3_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            // Widget ID, Base ID
            'home_section_3',
            // Widget Name
            "Home Section 3",
            array(
                'description' => ""
            )
        );
    }

    function widget($args, $instance)
    {
        $title = $instance['title'];
        $posts  = $instance['posts'];
        $categories  = $instance['categories'];
        $query_args = array(
            "showposts" => $posts,
            "post_type" => "post",
            "cat" => $categories,
        );

        $home_section3_query = new WP_Query($query_args);

?>
        <!-- content-news-style2 -->
        <div class="content-news-style2 col-lg-4 col-md-4 col-sm-4 col-12">
            <div class="content-container">
                <h1><?= $title ?></h1>
                <?php $counter = 0; ?>
                <?php while ($home_section3_query->have_posts()): $home_section3_query->the_post(); ?>
                    <?php if ($counter == 0): ?>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 left-side">
                            <div class="row left-side-row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 left-side-img">
                                    <a href="<?php the_permalink() ?>">
                                        <img
                                            class="img-fluid realsize"
                                            src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "size6")[0]; ?>"
                                            title="<?php the_title() ?>"
                                            alt="<?php the_title() ?>">

                                        <img
                                            class="img-fluid content-news-style2-small-size"
                                            src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "size7")[0]; ?>"
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
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 left-side-content">
                                    <h2>
                                        <a href="<?php the_permalink() ?>">
                                            <?php echo wp_trim_words(get_the_title(), 12); ?>
                                        </a>
                                    </h2>

                                    <time class="date">
                                        <?php echo convert_date("fa", get_the_time('Y-m-d')); ?>
                                    </time>
                                    <p class="description">
                                        <?php
                                        $content = strip_tags(get_the_content());
                                        $content = wp_trim_words($content, 18);
                                        echo $content;
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php $counter++;
                endwhile; ?>
                <?php wp_reset_postdata() ?>
                <div class="bottom-section">
                    <?php $counter = 0; ?>
                    <?php while ($home_section3_query->have_posts()): $home_section3_query->the_post(); ?>
                        <?php if ($counter > 0): ?>
                            <div class="row bottom-section-row">
                                <div class="col-lg-12 col-md-12 col-sm-12 bottom-section-content">
                                    <h2 class="real-title">
                                        <a href="<?php the_permalink() ?>">
                                            <?php echo wp_trim_words(get_the_title(), 12); ?>
                                        </a>
                                    </h2>
                                    <h2 class="short-title">
                                        <a href="<?php the_permalink() ?>">
                                            <?php echo wp_trim_words(get_the_title(), 15); ?>
                                        </a>
                                    </h2>
                                    <time class="date">
                                        <?php echo convert_date("fa", get_the_time('Y-m-d')); ?>
                                    </time>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php $counter++;
                    endwhile; ?>
                    <?php wp_reset_postdata() ?>
                </div>
            </div>
        </div>
        <!-- content-news-style2  End -->
    <?php
    }

    function form($instance)
    {
        $defaults = array(
            "title" => "  ",
            "posts" => 4,
            "categories" => "",
        );

        $instance = wp_parse_args((array) $instance, $defaults);
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input class="widefat" style="width:100%;padding:7px 6px;border-radius:8px;border:1px solid #ddd" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('categories'); ?>">Category:</label>
            <select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" style="width:100%;padding:7px 6px;border-radius:8px;border:1px solid #ddd">
                <?php $cats_list = get_categories("hide_empty=0&depth=1&type=post"); ?>
                <option value="" <?= $instance['categories'] == "" ? "selected" : ''; ?>>All</option>
                <?php foreach ($cats_list as $cat): ?>
                    <option value="<?php echo $cat->term_id ?>" <?= ($cat->term_id == $instance['categories'] ? "selected" : '') ?>><?php echo $cat->cat_name ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('posts'); ?>">Number of posts:</label>
            <input class="widefat" style="width:100%;padding:7px 6px;border-radius:8px;border:1px solid #ddd" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
        </p>
<?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['posts'] = $new_instance['posts'];
        $instance['categories'] = $new_instance['categories'];
        return $instance;
    }
}
?>