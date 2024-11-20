<?php get_header(); ?>
<main>
    <div class="container main-container">
        <div class="row container-row">
            <div class="col-lg-9 main-part">
                <?php dynamic_sidebar("home_slide_show"); ?>
                <?php dynamic_sidebar("home_section_2"); ?>
                <div class="row home-content2">
                    <?php dynamic_sidebar("home_section_3"); ?>
                </div>
                <?php dynamic_sidebar("home_carousel"); ?>
                <?php dynamic_sidebar("home_video"); ?>
            </div>

            <aside class="col-lg-3 col-md-3" id="sidebar">
                <?php dynamic_sidebar("home_sidebar"); ?>
            </aside>

        </div>
    </div>
</main>
<?php get_footer(); ?>