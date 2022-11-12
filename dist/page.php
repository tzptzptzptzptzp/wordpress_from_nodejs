<?php get_header(); ?>
<body id="page">

    <div class="l-wrapper w-full">

        <?php get_template_part('./parts/loader'); ?>

        <div class="l-container">

            <?php get_template_part('./parts/header'); ?>

            <div class="l-main">
                <div class="l-main__inner">
                    <img data-src="<?php echo get_template_directory_uri(); ?>/assets/images/" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" onload="lzld(this)">
                </div><!-- .l-main__inner -->
            </div><!-- .l-main -->

            <?php get_template_part('./parts/footer'); ?>

        </div><!-- .l-container -->

    </div><!-- .l-wrapper -->

    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/page.js" type="module" defer></script>

    <?php get_footer(); ?>

</body>
</html>