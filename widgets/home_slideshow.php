<?php

function get_home_slide_show()
{
    register_widget('Home_Slideshow_Widget');
}

add_action("widgets_init", "get_home_slide_show");

class Home_Slideshow_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            // Widget ID, Base ID
            'home_slide_show',
            // Widget Name
            "Home Slide Show",
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
        if ($categories == "") {
            $query_args =  array(
                "showposts" => $posts,
                "post_type" => "post",
            );
        } else {
            $query_args = array(
                "showposts" => $posts,
                "post_type" => "post",
                "cat" => $categories,
            );
        }
        $slide_show_posts_query = new WP_Query($query_args);

?>
        <div class="row slide-container">
            <div id="demo" class="carousel slide main-slider col-lg-12 col-md-12" data-ride="carousel">
                <div class="col-lg-4 col-md-4 col-sm-4 indicators-container">
                    <div class="slide-sidebar-section carousel-indicators">
                        <?php $counter = 0; ?>
                        <?php while ($slide_show_posts_query->have_posts()): $slide_show_posts_query->the_post(); ?>
                            <div class="slide-sidebar-item row nav-link hvr-underline-from-center <?= $counter == 0 ? 'active' : '' ?>" data-target="#demo" data-slide-to="<?= $counter ?>">
                                <div class="slide-sidebar-img col-lg-4 col-md-4 col-sm-4 col-4">
                                    <a href="#">
                                        <img
                                            class="img-fluid"
                                            title="<?php the_title() ?>"
                                            alt="<?php the_title() ?>"
                                            src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "size3")[0]; ?>">
                                    </a>

                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-8 right-content">
                                    <h2>
                                        <a href="#">
                                            <?php echo wp_trim_words(get_the_title(), 13); ?>
                                        </a>
                                    </h2>
                                </div>
                            </div>
                        <?php $counter++;
                        endwhile; ?>
                        <?php wp_reset_postdata() ?>
                    </div>
                </div>
                <div class="carousel-inner col-lg-8 col-md-8 col-sm-8">
                    <?php $c = 0; ?>
                    <?php while ($slide_show_posts_query->have_posts()): $slide_show_posts_query->the_post(); ?>
                        <div class="carousel-item <?= $c == 0 ? 'active' : '' ?>">
                            <img class="large-size" alt="<?php the_title() ?>" src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "size1")[0]; ?>" title="<?php the_title() ?>">

                            <img class="small-size" alt="<?php the_title() ?>" src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "size2")[0]; ?>" title="<?php the_title() ?>">

                            <div class="carousel-caption">
                                <time class="time">
                                    <span>
                                        <?php echo convert_date("fa", get_the_time('Y-m-d')); ?>
                                    </span>
                                </time>
                                <h1>
                                    <a href="<?php the_permalink() ?>">
                                        <?php echo wp_trim_words(get_the_title(), 14); ?>
                                    </a>
                                </h1>
                            </div>
                        </div>
                    <?php $c++;
                    endwhile; ?>
                    <?php wp_reset_postdata() ?>
                </div>
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
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