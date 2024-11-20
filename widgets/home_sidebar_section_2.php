<?php

function get_news_for_home_sidebar_section2()
{
    register_widget('Home_Sidebar_Section_2_Widget');
}

add_action("widgets_init", "get_news_for_home_sidebar_section2");

class Home_Sidebar_Section_2_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            // Widget ID, Base ID
            'home_sidebar_section_2',
            // Widget Name
            "Home Sidebar Section 2",
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

        $home_sidebar_section2_query = new WP_Query($query_args);

?>
        <div class="sidebar-news-style1">
            <h1><?= $title ?></h1>
            <div class="latest-news">
                <?php while ($home_sidebar_section2_query->have_posts()): $home_sidebar_section2_query->the_post(); ?>
                    <div class="latest-new-item row">
                        <div class="latest-news-img col-lg-4 col-md-4 col-sm-4 col-4">
                            <a href="<?php the_permalink() ?>">
                                <img
                                    class="img-fluid"
                                    title="<?php the_title() ?>"
                                    alt="<?php the_title() ?>"
                                    src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "size3")[0]; ?>">
                            </a>

                            <div class="hover-layer-style1">
                                <div class="dp-table">
                                    <div class="dp-cell">
                                        <a href="<?php the_permalink() ?>" class="fas  fa-link"></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-8 right-content">
                            <h2>
                                <a href="<?php the_permalink() ?>">
                                    <?php echo wp_trim_words(get_the_title(), 14); ?>
                                </a>
                            </h2>
                            <time class="date">
                                <?php echo convert_date("fa", get_the_time('Y-m-d')); ?>
                            </time>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata() ?>
            </div>
        </div>
    <?php
    }

    function form($instance)
    {
        $defaults = array(
            "title" => "  ",
            "posts" => 3,
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