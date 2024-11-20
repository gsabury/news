<div class="transparent-layer"></div>
<footer>
    <section id="main-area" class="clearfix">
        <div class="container">
            <div class="row">
                <div class="col column col-lg-4 col-md-4 col-sm-4 col-12">
                    <?php dynamic_sidebar("footer_latest_news") ?>
                </div>
                <div class="col column col-lg-2 col-md-2 col-sm-2 col-6">
                    <h3>بخش ها</h3>
                    <?php
                    wp_nav_menu(
                        array(
                            "theme_location" => "footer_menu_1",
                            "menu_class" => "list-unstyled footer_menu",
                            "menu_id" => "",
                            "container" => "",
                        )
                    );
                    ?>
                </div>

                <div class="col column col-lg-2 col-md-2 col-sm-2 col-6">
                    <h3>لینک ها</h3>
                    <?php
                    wp_nav_menu(
                        array(
                            "theme_location" => "footer_menu_2",
                            "menu_class" => "list-unstyled footer_menu",
                            "menu_id" => "",
                            "container" => "",
                        )
                    );
                    ?>
                </div>
                <div class="col column col-lg-4 col-md-4 col-sm-4 col-12">
                    <?php dynamic_sidebar("footer_social_links") ?>
                </div>
            </div>
        </div>
    </section>
    <section id="footer-area" class="clearfix">
        <div class="container">
            <?php dynamic_sidebar("footer_copy_right") ?>
        </div>
    </section>
</footer>
<a href="#top" id="scrollup" class="btn btn-danger" title="Go to top"></a>
<br style="clear: both;">
<?php wp_footer() ?>
</body>

</html>