<?php use Roots\Sage\Nav\NavWalker; ?>

    <header class="banner navbar navbar-default navbar-fixed-top" role="banner">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>">
                    <img class="img-responsive" src="<?php echo esc_url(get_theme_mod('rjfs_logo')); ?>"
                         alt="<?php bloginfo('name'); ?>">
                </a>
            </div>


            <div class="phone-number">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="tel:<?php echo get_theme_mod("rjfs_phone", "NOT SET"); ?>">
                <span class="phone-number black">
                    <icon class="glyphicon glyphicon-phone-alt"></icon>
                    <?php echo get_theme_mod("rjfs_phone", "NOT SET"); ?>
                </span>
                </a>
            </div>

            <nav class="collapse navbar-collapse" role="navigation">
                <?php
                if (has_nav_menu('primary_navigation')) :
                    wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new NavWalker(), 'menu_class' => 'nav navbar-nav']);
                endif;
                ?>
            </nav>
        </div>
    </header>