<?php

function get_home_videos()
{
    register_widget('Home_Video_Widget');
}

add_action("widgets_init", "get_home_videos");

class Home_Video_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            // Widget ID, Base ID
            'home_vidoe',
            // Widget Name
            "Home Vidoe",
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

        $home_video_query = new WP_Query($query_args);

?>
        <!-- content-news-style4 -->
        <div class="content-news-style4">
            <h1><?= $title ?></h1>
            <div class="row video-container">
                <?php while ($home_video_query->have_posts()): $home_video_query->the_post(); ?>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-6 video-item">
                        <div class="inner">
                            <a href="<?php the_permalink() ?>">
                                <img
                                    class="img-fluid"
                                    src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "size8")[0]; ?>"
                                    title="<?php the_title() ?>"
                                    alt="<?php the_title() ?>">
                                <i class="fas fa-play-circle"></i>
                                <h2><?php echo wp_trim_words(get_the_title(), 10, '...'); ?></h2>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata() ?>
            </div>
        </div>
        <!-- content-news-style4 End -->
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