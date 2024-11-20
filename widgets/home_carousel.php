<?php

function get_news_for_carousel()
{
    register_widget('Home_Carousel_Widget');
}

add_action("widgets_init", "get_news_for_carousel");

class Home_Carousel_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            // Widget ID, Base ID
            'home_carousel',
            // Widget Name
            "Home Carousel",
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

        $home_carousel_query = new WP_Query($query_args);

?>
        <!-- content-news-style3 -->
        <div class="content-news-style3">
            <h1><?= $title ?></h1>
            <div class="owl-carousel owl-theme gallery-container" dir="ltr">
                <?php while ($home_carousel_query->have_posts()): $home_carousel_query->the_post(); ?>
                    <div class="gallery-item">
                        <a href="<?php the_permalink() ?>">
                            <img
                                class="img-fluid"
                                src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "size8")[0]; ?>"
                                title="<?php the_title() ?>"
                                alt="<?php the_title() ?>">
                            <div class="img-caption">
                                <h1><?php echo wp_trim_words(get_the_title(), 7, '...'); ?></h1>
                                <p>
                                    <?php
                                    $content = strip_tags(get_the_content());
                                    $content = wp_trim_words($content, 18);
                                    echo $content;
                                    ?>
                                </p>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata() ?>
            </div>
        </div>
        <!-- content-news-style3 End -->
    <?php
    }

    function form($instance)
    {
        $defaults = array(
            "title" => "  ",
            "posts" => 6,
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