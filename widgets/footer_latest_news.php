<?php

function get_latest_news_in_footer()
{
    register_widget('Footer_Latest_Posts_widget');
}

add_action("widgets_init", "get_latest_news_in_footer");

class Footer_Latest_Posts_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            // Widget ID, Base ID
            'footer_latest_posts',
            // Widget Name
            "Footer Latest Nes",
            array(
                'description' => "Show the latest posts in footer"
            )
        );
    }

    function widget($args, $instance)
    {
        $title = $instance['title'];
        $posts  = $instance['posts'];

        $latest_posts_query = new WP_Query(
            array(
                "showposts" => $posts,
                "post_type" => "post",
            )
        );

?>
        <?php echo $args['before_widget']; ?>
        <div class="most-recent-news-footer">
            <?php echo $args['before_title']; ?>
            <h3><?= $title ?></h3>
            <?php echo $args['after_title']; ?>
            <?php if ($latest_posts_query->have_posts()): ?>
                <?php while ($latest_posts_query->have_posts()) : $latest_posts_query->the_post() ?>
                    <div class="row most-recent-news-footer-row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 left-section">
                            <h2>
                                <a href="<?php the_permalink() ?>">
                                    <?php
                                    echo wp_trim_words(get_the_title(), 12, "...");
                                    ?>
                                </a>
                            </h2>
                            <time class="date">
                                <?php
                                echo convert_date("fa", get_the_time('Y-m-d'));
                                ?>
                            </time>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata() ?>
            <?php endif; ?>
        </div>
        <?php echo $args['after_widget']; ?>
    <?php
    }

    function form($instance)
    {
        $defaults = array(
            "title" => "آخرین خبر ها",
            "posts" => 3,
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