<?php

function get_social_links_in_footer()
{
    register_widget('Footer_social_links_widget');
}

add_action("widgets_init", "get_social_links_in_footer");

class Footer_social_links_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            // Widget ID, Base ID
            'footer_social_links',
            // Widget Name
            "Footer Social Links",
            array(
                'description' => "Show the social links in footer"
            )
        );
    }

    function widget($args, $instance)
    {
        $title = $instance['title'];
        $desc  = $instance['desc'];
        $instagram  = $instance['instagram'];
        $youtube  = $instance['youtube'];
        $twitter  = $instance['twitter'];
        $facebook  = $instance['facebook'];
        $telegram  = $instance['telegram'];
?>
        <?php echo $args['before_widget']; ?>

        <?php echo $args['before_title']; ?>
        <h3><?= $title ?></h3>
        <?php echo $args['after_title']; ?>
        <p><?= $desc ?></p>
        <div id="social-media">
            <div class="links-container">
                <a href="<?= $instagram ?>" target="_blank" class="hvr-bounce-to-top">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="<?= $youtube ?>" target="_blank" class="hvr-bounce-to-top">
                    <i class="fab fa-youtube"></i>
                </a>
                <a href="<?= $twitter ?>" target="_blank" class="hvr-bounce-to-top">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="<?= $facebook ?>" target="_blank" class="hvr-bounce-to-top">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="<?= $telegram ?>" target="_blank" class="hvr-bounce-to-top">
                    <i class="fab fa-telegram"></i>
                </a>
            </div>
        </div>
        <?php echo $args['after_widget']; ?>
    <?php
    }

    function form($instance)
    {
        $defaults = array(
            "title" => "در شبکه های اجتماعی دنبال کنید",
            "desc" => "",
            "instagram" => "",
            "youtube" => "",
            "twitter" => "",
            "facebook" => "",
            "telegram" => "",
        );
        $instance = wp_parse_args((array) $instance, $defaults);
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input class="widefat" style="width:100%;padding:7px 6px;border-radius:8px;border:1px solid #ddd" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('desc'); ?>">Description</label>
            <textarea class="widefat" style="width:100%;padding:7px 6px;border-radius:8px;border:1px solid #ddd" id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>"><?php echo $instance['desc']; ?></textarea>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('instagram'); ?>">Instagram Link</label>
            <textarea class="widefat" style="width:100%;padding:7px 6px;border-radius:8px;border:1px solid #ddd" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>"><?php echo $instance['instagram']; ?></textarea>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('youtube'); ?>">Youtube Link</label>
            <textarea class="widefat" style="width:100%;padding:7px 6px;border-radius:8px;border:1px solid #ddd" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>"><?php echo $instance['youtube']; ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('twitter'); ?>">Twitter</label>
            <textarea class="widefat" style="width:100%;padding:7px 6px;border-radius:8px;border:1px solid #ddd" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>"><?php echo $instance['twitter']; ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('facebook'); ?>">Facebook Link</label>
            <textarea class="widefat" style="width:100%;padding:7px 6px;border-radius:8px;border:1px solid #ddd" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>"><?php echo $instance['facebook']; ?></textarea>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('telegram'); ?>">Telegram Link:</label>
            <textarea class="widefat" style="width:100%;padding:7px 6px;border-radius:8px;border:1px solid #ddd" id="<?php echo $this->get_field_id('telegram'); ?>" name="<?php echo $this->get_field_name('telegram'); ?>"><?php echo $instance['telegram']; ?></textarea>
        </p>
<?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['desc'] = $new_instance['desc'];
        $instance['instagram'] = $new_instance['instagram'];
        $instance['youtube'] = $new_instance['youtube'];
        $instance['twitter'] = $new_instance['twitter'];
        $instance['facebook'] = $new_instance['facebook'];
        $instance['telegram'] = $new_instance['telegram'];
        return $instance;
    }
}
?>