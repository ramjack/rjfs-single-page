<?php

use Roots\Sage\Config;
use Roots\Sage\Wrapper;

?>

<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>
<!--[if lt IE 9]>
<div class="alert alert-warning">
    <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your
    browser</a> to improve your experience.', 'sage'); ?>
</div>
<![endif]-->
<?php
do_action('get_header');
get_template_part('templates/header');
?>

<?php if (is_dynamic_sidebar('welcome')) : ?>
    <div class="welcome">
        <div class="container">
            <div class="content row">
                <?php dynamic_sidebar('welcome'); ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="wrap container" role="document">
    <?php if (is_dynamic_sidebar('mobile-only')) : ?>
        <div class="content row">
            <div class="col-xs-12 visible-xs">
                <?php dynamic_sidebar('mobile-only'); ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="content row">
        <main class="main" role="main">
            <?php include Wrapper\template_path(); ?>
        </main>
        <!-- /.main -->
        <?php if (Config\display_sidebar()) : ?>
            <aside class="primary sidebar hidden-xs" role="complementary">
                <?php include Wrapper\sidebar_path(); ?>
            </aside>
            <!-- /.sidebar -->
        <?php endif; ?>

        <aside class="sidebar" role="complementary">
            <?php dynamic_sidebar('sidebar-secondary'); ?>
        </aside>

    </div>
    <!-- /.content -->
</div>
<!-- /.wrap -->
<?php
get_template_part('templates/footer');
wp_footer();
?>
</body>
</html>
