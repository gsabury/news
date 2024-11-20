<?php

function get_sidebar_most_read_news()
{
    register_widget('Sidebar_Most_Read_News_Widget');
}

add_action("widgets_init", "get_sidebar_most_read_news");

class Sidebar_Most_Read_News_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            // Widget ID, Base ID
            'sidebar_most_read_news',
            // Widget Name
            "Sidebar Most Read News",
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
            "post_type" => "post",
            "posts_per_page" => $posts,
            'meta_key' => 'post_visits',
            'orderby' => 'meta_value_num',
            'order' => "DESC",
        );

        $sidebar_most_read_news_query = new WP_Query($query_args);

?>
        <div class="sidebar-news-style4">
            <h1><?= $title ?></h1>
            <div class="latest-news">
                <div class="latest-new-item row">
                    <?php while ($sidebar_most_read_news_query->have_posts()): $sidebar_most_read_news_query->the_post(); ?>
                        <div class="right-content col-lg-12">
                            <h2>
                                <a href="<?php the_permalink() ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <time class="date">
                                <?php echo convert_date("fa", get_the_time('Y-m-d')); ?>
                            </time>
                        </div>
                    <?php
                    endwhile; ?>
                    <?php wp_reset_postdata() ?>
                </div>
            </div>
        </div>
    <?php
    }

    function form($instance)
    {
        $defaults = array(
            "title" => "پر بیننده ترین ها",
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