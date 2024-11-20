<?php

function get_sidebar_latest_news()
{
    register_widget('Home_Sidebar_Latest_News_Widget');
}

add_action("widgets_init", "get_sidebar_latest_news");

class Home_Sidebar_Latest_News_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            // Widget ID, Base ID
            'home_sidebar_latest_news',
            // Widget Name
            "Home Sidebar Latest News",
            array(
                'description' => ""
            )
        );
    }

    function widget($args, $instance)
    {
        $title = $instance['title'];
        $posts  = $instance['posts'];
        $query_args = array(
            "showposts" => $posts,
            "post_type" => "post",
            'category__not_in' => array(17, 18),
        );

        $home_sidebar_query = new WP_Query($query_args);

?>
        <div class="sidebar-news-style1">
            <h1><?= $title ?></h1>
            <div class="latest-news latest-news-2">
                <?php $counter = 1; ?>
                <?php while ($home_sidebar_query->have_posts()): $home_sidebar_query->the_post(); ?>
                    <div class="latest-new-item row">
                        <div class="box-number col-lg-2 col-md-2 col-sm-2 col-2">
                            <h3><?= $counter; ?></h3>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-10 right-content">
                            <h2>
                                <a href="<?php the_permalink() ?>">
                                    <?php echo wp_trim_words(get_the_title(), 15, '...'); ?>
                                </a>
                            </h2>
                            <time class="date">
                                <?php echo convert_date("fa", get_the_time('Y-m-d')); ?>
                            </time>
                        </div>
                    </div>
                <?php $counter++;
                endwhile; ?>
                <?php wp_reset_postdata() ?>
            </div>
        </div>
    <?php
    }

    function form($instance)
    {
        $defaults = array(
            "title" => "  ",
            "posts" => 4,
        );

        $instance = wp_parse_args((array) $instance, $defaults);
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input class="widefat" style="width:100%;padding:7px 6px;border-radius:8px;border:1px solid #ddd" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
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
        return $instance;
    }
}
?>