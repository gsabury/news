<?php

function get_facebook_page_in_sidebar()
{
    register_widget('Home_Sidebar_Facebook_Page_Widget');
}

add_action("widgets_init", "get_facebook_page_in_sidebar");

class Home_Sidebar_Facebook_Page_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            // Widget ID, Base ID
            'home_sidebar_facebook_page',
            // Widget Name
            "Home Sidebar Facebook Page",
            array(
                'description' => ""
            )
        );
    }

    function widget($args, $instance)
    {
        $title = $instance['title'];
        $url  = $instance['url'];
?>
        <div class="sidebar-news-style3 sidebar-facebook-likebox">
            <h1><?= $title ?></h1>
            <iframe src="<?= $url ?>" width="285" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
        </div>
    <?php
    }

    function form($instance)
    {
        $defaults = array(
            "title" => "  ",
            "url" => "",
        );

        $instance = wp_parse_args((array) $instance, $defaults);
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input class="widefat" style="width:100%;padding:7px 6px;border-radius:8px;border:1px solid #ddd" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('url'); ?>">Facebook Page Url:</label>
            <input class="widefat" style="width:100%;padding:7px 6px;border-radius:8px;border:1px solid #ddd" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" value="<?php echo $instance['url']; ?>" />
        </p>
<?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['url'] = $new_instance['url'];
        return $instance;
    }
}
?>