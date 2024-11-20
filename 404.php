<?php get_header(); ?>
<section class="container not_found-page">
    <div class="row py-3">
        <div class="col-lg-9">
            <div class="not-found-content">
                <img src="<?= get_template_directory_uri() ?>/images/404.jpg" class="img-fluid" title="404" alt="404">
                <h2 class="title404">
                    متاسفانه صحفه که دنبال آن هستید در وبسایت وجود ندارد، لطف نموده با استفاده از نوار جستجو کلمات خود را جستجو کنید.
                </h2>
                <form class="form-inline search_form_4o4" action="<?= get_site_url() ?>">
                    <button class="btn btn-outline-success fa fa-search" type="submit">
                    </button>
                    <input class="form-control" type="text" name="s" required placeholder="جستجو...">
                </form>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</section>
<?php get_footer(); ?>