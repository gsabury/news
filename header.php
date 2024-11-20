<!DOCTYPE html>
<html lang="<?= get_bloginfo("language") ?>" dir="<?= is_rtl() ? "rtl" : 'ltr' ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class() ?>>
    <a href="javascript:void(0)" class="closebtn">&times;</a>
    <header>
        <div class="top-menu">
            <div class="top-menu-container container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 links">
                        <?php
                        wp_nav_menu(
                            array(
                                "theme_location" => "top_bar_menu",
                                "menu_class" => "list-unstyled",
                                "menu_id" => "top-menu",
                                "container" => "",
                            )
                        );
                        ?>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 current-time">
                        <time class="navbar-brand navbar-time">
                            <?= jdate('l j F, Y'); ?>
                            <span id="clock"></span>
                        </time>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 s-icons">
                        <?php dynamic_sidebar("header_social_links") ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-container container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12 header-logo">
                    <div class="logo-container">
                        <a href="<?= get_site_url() ?>">
                            <?php dynamic_sidebar("header_logo") ?>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12 search-container">
                    <form action="<?= get_site_url() ?>" class="search-form">
                        <input
                            type="search"
                            class="form-control"
                            name="s"
                            placeholder="جستجو کنید..."
                            autocomplete="off"
                            value="<?= isset($_GET['s']) ? $_GET['s'] : ''; ?>">
                        <button type="submit" class="btn btn-primary fas fa-search"></button>
                    </form>
                </div>
            </div>
        </div>
        <nav class="header-navbar">
            <div class="container">
                <nav class="navbar navbar-expand-lg top-navbar">
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#primary_navigation_menu"
                        aria-controls="primary_navigation_menu"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <span class="sidebar-toggler-icon"></span>
                    <div class="collapse navbar-collapse" id="primary_navigation_menu">
                        <?php
                        wp_nav_menu(
                            array(
                                "theme_location" => "primary_menu",
                                "menu_class" => "navbar-nav",
                                "menu_id" => "primary-menu",
                                "container" => "",
                            )
                        );
                        ?>
                    </div>
                </nav>
            </div>
        </nav>
    </header>