<?php

function get_social_links_in_header()
{
    register_widget('Header_social_links_widget');
}

add_action("widgets_init", "get_social_links_in_header");

class Header_social_links_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            // Widget ID, Base ID
            'header_social_links',
            // Widget Name
            "Header Social Links",
            array(
                'description' => "Show the social links in header"
            )
        );
    }

    function widget($args, $instance)
    {
        $instagram  = $instance['instagram'];
        $youtube  = $instance['youtube'];
        $twitter  = $instance['twitter'];
        $facebook  = $instance['facebook'];
        $telegram  = $instance['telegram'];
?>
        <?php echo $args['before_widget']; ?>

        <li class="facebook">
            <a href="<?= $facebook ?>" target="_blank" class="hvr-bounce-to-bottom"><i class="fab fa-facebook"></i></a>
        </li>
        <li class="twitter">
            <a href="<?= $twitter ?>" target="_blank" class="hvr-bounce-to-bottom"><i class="fab fa-twitter"></i></a>
        </li>
        <li class="youtube">
            <a href="<?= $youtube ?>" target="_blank" class="hvr-bounce-to-bottom"><i class="fab fa-youtube"></i></a>
        </li>
        <li class="instagram">
            <a href="<?= $instagram ?>" target="_blank" class="hvr-bounce-to-bottom"><i class="fab fa-instagram"></i></a>
        </li>
        <li class="telegram">
            <a href="<?= $telegram ?>" target="_blank" class="hvr-bounce-to-bottom"><i class="fab fa-telegram"></i></a>
        </li>
        <?php echo $args['after_widget']; ?>
    <?php
    }

    function form($instance)
    {
        $defaults = array(
            "instagram" => "https://www.instagram.com",
            "youtube" => "https://www.youtube.com",
            "twitter" => "https://www.twitter.com",
            "facebook" => "https://www.facebook.com",
            "telegram" => "https://www.telegram.com",
        );
        $instance = wp_parse_args((array) $instance, $defaults);
    ?>
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
        $instance['instagram'] = $new_instance['instagram'];
        $instance['youtube'] = $new_instance['youtube'];
        $instance['twitter'] = $new_instance['twitter'];
        $instance['facebook'] = $new_instance['facebook'];
        $instance['telegram'] = $new_instance['telegram'];
        return $instance;
    }
}
?>