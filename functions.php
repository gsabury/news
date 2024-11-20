<?php
// Load css files
function loadStyles()
{
    wp_enqueue_style(
        "custom_style",
        get_template_directory_uri() . '/css/custom.css',
        array(),
        "1.0",
        "all"
    );

    wp_enqueue_style(
        "main_style",
        get_template_directory_uri() . '/style.css',
        array("custom_style"),
        "1.0",
        "all"
    );
}

add_action("wp_enqueue_scripts", "loadStyles");

// load script files
function loadScripts()
{
    wp_enqueue_script(
        "custom_js",
        get_template_directory_uri() . '/js/custom.js',
        array(),
        "1.0",
        true
    );
}
add_action("wp_enqueue_scripts", "loadScripts");


// Enable Page Title Tag
add_theme_support("title-tag");

// Include Persian Date 
require_once("persian_date/persian_date.class.php");
require_once("persian_date/jdate.php");


// Enable Menu Option
add_theme_support('menus');

// Register Menu
function register_menus()
{
    register_nav_menus(
        array(
            "top_bar_menu" => "Top Bar Menu",
            "primary_menu" => "Primary Menu",
            "footer_menu_1" => "Footer Menu 1",
            "footer_menu_2" => "Footer Menu 2",
        )
    );
}

add_action("init", "register_menus");

// Enable Menu Option
add_theme_support('widgets');
// Register Sidebar
function register_custom_sidebars()
{
    register_sidebar(
        array(
            "name" => "Logo Area",
            "id" => "header_logo",
            "description" => "Header Logo",
            "before_widget" => "",
            "after_widget" => ""
        )
    );

    register_sidebar(
        array(
            "name" => "Header Social Links Area",
            "id" => "header_social_links",
            "description" => "",
            "before_widget" => "<ul class='social-icons-header'>",
            "after_widget" => "</ul>",
            "before_title" => "",
            "after_title" => ""
        )
    );

    register_sidebar(
        array(
            "name" => "Home Slide Show Area",
            "id" => "home_slide_show",
            "description" => "",
            "before_widget" => "",
            "after_widget" => ""
        )
    );

    register_sidebar(
        array(
            "name" => "Home Section 2 Area",
            "id" => "home_section_2",
            "description" => "",
            "before_widget" => "",
            "after_widget" => ""
        )
    );

    register_sidebar(
        array(
            "name" => "Home Section 3 Area",
            "id" => "home_section_3",
            "description" => "",
            "before_widget" => "",
            "after_widget" => ""
        )
    );

    register_sidebar(
        array(
            "name" => "Home Carousel Area",
            "id" => "home_carousel",
            "description" => "",
            "before_widget" => "",
            "after_widget" => ""
        )
    );

    register_sidebar(
        array(
            "name" => "Home Vidoe Area",
            "id" => "home_video",
            "description" => "",
            "before_widget" => "",
            "after_widget" => ""
        )
    );

    register_sidebar(
        array(
            "name" => "Home Sidebar",
            "id" => "home_sidebar",
            "description" => "",
            "before_widget" => "",
            "after_widget" => ""
        )
    );

    register_sidebar(
        array(
            "name" => "Footer Latest News Area",
            "id" => "footer_latest_news",
            "description" => "",
            "before_widget" => "",
            "after_widget" => "",
            "before_title" => "",
            "after_title" => ""
        )
    );

    register_sidebar(
        array(
            "name" => "Footer Social Links Area",
            "id" => "footer_social_links",
            "description" => "",
            "before_widget" => "",
            "after_widget" => "",
            "before_title" => "",
            "after_title" => ""
        )
    );

    register_sidebar(
        array(
            "name" => "Footer Copyright Area",
            "id" => "footer_copy_right",
            "description" => "",
            "before_widget" => "",
            "after_widget" => ""
        )
    );

    register_sidebar(
        array(
            "name" => "Default Sidebar Area",
            "id" => "default_sidebar",
            "description" => "",
            "before_widget" => "",
            "after_widget" => ""
        )
    );
}

add_action("widgets_init", "register_custom_sidebars");

function convert_date($lang, $post_date)
{
    $persian = new persian_date();
    $full_date = $persian->to_date('' . $post_date . '', 'Y-m-d');
    $full_date = explode('-', $full_date);
    $year = $full_date[0];
    $month_as_number = $full_date[1];
    $day = $full_date[2];

    switch ($month_as_number) {
        case '01':
            $month_name = $lang == 'fa' ? 'حمل' : 'وری';
            break;
        case '02':
            $month_name = $lang == 'fa' ? 'ثور' : 'غویی';
            break;
        case '03':
            $month_name = $lang == 'fa' ? 'جوزا' : 'غبرګولی';
            break;
        case '04':
            $month_name = $lang == 'fa' ? 'سرطان' : 'چنګاښ';
            break;
        case '05':
            $month_name = $lang == 'fa' ? 'اسد' : 'زمری';
            break;
        case '06':
            $month_name = $lang == 'fa' ? 'سنبله' : 'وږی';
            break;
        case '07':
            $month_name = $lang == 'fa' ? 'میزان' : 'تله';
            break;
        case '08':
            $month_name = $lang == 'fa' ? 'عقرب' : 'لړم';
            break;
        case '09':
            $month_name = $lang == 'fa' ? 'قوس' : 'لیندۍ';
            break;
        case '10':
            $month_name = $lang == 'fa' ? 'جدی' : 'مرغومی';
            break;
        case '11':
            $month_name = $lang == 'fa' ? 'دلو' : 'سلواغه';
            break;
        case '12':
            $month_name = $lang == 'fa' ? 'حوت' : 'کب';
            break;
    }

    return $day . ' ' . $month_name . ', ' . $year;
}


// Include custom  Widgets
require_once('widgets/footer_latest_news.php');
require_once('widgets/footer_social_links.php');
require_once('widgets/header_social_icons.php');
require_once('widgets/home_slideshow.php');
require_once('widgets/home_section2.php');
require_once('widgets/home_section3.php');
require_once('widgets/home_carousel.php');
require_once('widgets/home_video.php');
require_once('widgets/home_sidebar_latest_news.php');
require_once('widgets/home_sidebar_section_2.php');
require_once('widgets/home_sidebar_facebook_page.php');
require_once('widgets/sidebar_most_read_posts.php');
require_once('widgets/home_sidebar_section_5.php');


// Enable Feature Image
add_theme_support("post-thumbnails");

// Set Image Sizes
add_image_size("size1", 581, 330, true);
add_image_size("size2", 431, 299, true);
add_image_size("size3", 95, 81, true);
add_image_size("size4", 389, 269, true);
add_image_size("size5", 101, 73, true);
add_image_size("size6", 285, 178, true);
add_image_size("size7", 500, 230, true);
add_image_size("size8", 292, 219, true);
add_image_size("size9", 785, 302, true);
add_image_size("size10", 375, 281, true);


// Count Post Visits
function count_post_visits()
{
    if (is_single()) {
        global $post;
        $views = get_post_meta($post->ID, 'post_visits', true);
        if ($views == "") {
            update_post_meta($post->ID, 'post_visits', '1');
        } else {
            $total_views = intval($views);
            update_post_meta($post->ID, 'post_visits', ++$total_views);
        }
    }
}
add_action("wp_head", "count_post_visits");


// Creating custom post type (teams)
function create_team_post_type()
{
    $labels = array(
        'name' => "اعضای تیم", // Title for table page
        'singular_name' => "عضو تیم", // Title for single item
        'menu_name' => "اعضای تیم", // Main Menu Name
        'all_items' => "لیست اعضای تیم", // Sub Menu Title
        'add_new' => "اضافه کردن عضو", // Sub menu title to add new team 
        'add_new_item' => "اضافه کردن عضو جدید", // Title for add page
        'edit_item' => "ویرایش عضو", // Title for edit page
    );

    $args = array(
        "labels" => $labels, // Define Label
        "public" => true, // Set for public use or not
        "rewrite" => array("slug" => "teams"), // Define the slug
        "has_archive" => true, // Whether there should be post type archives
        "hierarchical" => false, //Whether the post type is hierarchical
        "supports" => array("title", 'editor', 'thumbnail', "excerpt"), // support title, description, excerpt and feature image
        "menu_icon" => "dashicons-admin-users", // Menu Icon
        "taxonomies" => array('category'), // Support category
    );

    register_post_type("teams", $args);
}

// Call on init hook
add_action("init", "create_team_post_type");

// Add custom field for email
function add_email_custom_field()
{
    add_meta_box("email_meta_box", "Email", "email_meta_box_callback", "teams");
}
add_action("add_meta_boxes", "add_email_custom_field");

// add custom field
function email_meta_box_callback($post)
{
    $value = get_post_meta($post->ID, "_email_field", true);
    echo '<label for="email_custom_field">Email: </label>';
    echo '<input style="direction:ltr;width:100%" type="email" id="email_custom_field" name="email_custom_field" value="' . $value . '" />';
}

// Save custom field data
function save_email_custom_field($post_id)
{
    if (array_key_exists('email_custom_field', $_POST)) {
        update_post_meta($post_id, "_email_field", $_POST['email_custom_field']);
    }
}
add_action("save_post", 'save_email_custom_field');

// Add custom field for phone
function add_phone_custom_field()
{
    add_meta_box("phone_meta_box", "Phone", "phone_meta_box_callback", "teams");
}
add_action("add_meta_boxes", "add_phone_custom_field");

// add custom field
function phone_meta_box_callback($post)
{
    $value = get_post_meta($post->ID, "_phone_field", true);
    echo '<label for="phone_custom_field">Phone: </label>';
    echo '<input style="direction:ltr;width:100%" type="text" id="phone_custom_field" name="phone_custom_field" value="' . $value . '" />';
}

// Save custom field data
function save_phone_custom_field($post_id)
{
    if (array_key_exists('phone_custom_field', $_POST)) {
        update_post_meta($post_id, "_phone_field", $_POST['phone_custom_field']);
    }
}
add_action("save_post", 'save_phone_custom_field');


// Define Custom Taxonomy for Team custom post type

function register_custom_taxonomy()
{
    $labels = array(
        'name' => 'نوع قرارداد',
        'singular_name' => 'نوع قرارداد',
        'menu_name' => 'نوع قرارداد',
        'add_new_item' => 'اضافه کردن ',
        'edit_item' => 'ویرایش ',
    );

    $args = array(
        'labels' => $labels,
        "rewrite" => array("slug" => "contracts"),
        "hierarchical" => true,
    );
    register_taxonomy(
        'contracts',
        'teams',
        $args
    );
}

add_action("init", "register_custom_taxonomy");

// Enable Post Formats
add_theme_support('post-formats', array('video', 'gallery'));
