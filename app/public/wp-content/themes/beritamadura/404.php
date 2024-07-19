<?php
get_header();
?>

<div class="container text-center">
    <div id="primary" class="content-area row align-items-center">
        <main id="main" class="site-main">
            <section class="error-404 not-found">
                <header class="page-header my-4">
                    <h1 class="page-title"><?php esc_html_e( 'Halaman Tidak ditemukan!', 'theme' ); ?></h1>
                </header>
                <div class="page-content">
                    <p><?php esc_html_e( 'Silahkan cari berita melalui kolom pencarian di bawah ini', 'theme' ); ?></p>
                    <form class="justify-content-center" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
                        <div class="input-group input-group-merge input-group-sm">
                            <input type="search" class="form-control" placeholder="<?php echo esc_attr_x( 'Cari …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>">
                            <button class="input-group-text" type="submit">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>
</div>

<?php
get_footer();
?>
