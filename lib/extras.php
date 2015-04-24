<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Config;
use WP_Customize_Image_Control;

/**
 * Add <body> classes
 */
function body_class($classes)
{
    // Add page slug if it doesn't exist
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    // Add class if sidebar is active
    if (Config\display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    return $classes;
}

add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more()
{
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}

add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

// make sure shortcodes are used in widgest
add_filter('widget_text', 'do_shortcode');

// change login page logo
function rjfs_login_logo()
{
    ?>
    <style type="text/css">
        body.login {
            background-color: #000;
            background-image: url(<?php echo get_template_directory_uri() . '/assets/images/binding_dark.png' ?>);
        }

        body.login div#login {
            width: 530px;
        }

        body.login div#login h1 a {
            background-image: url(<?php echo get_template_directory_uri() . '/assets/images/ramjack-logo.png'?>);
            background-size: auto;
            padding-bottom: 30px;
            width: auto;
            height: 100px;
        }
    </style>
<?php
}

add_action('login_enqueue_scripts', __NAMESPACE__ . '\\rjfs_login_logo');

function rjfs_wp_login_url()
{
    return 'http://www.ramjack.com';
}

add_filter('login_headerurl', __NAMESPACE__ . '\\rjfs_wp_login_url');

function rjfs_wp_login_title()
{
    return 'Ram Jack Foundation Solutions';
}

add_filter('login_headertitle', __NAMESPACE__ . '\\rjfs_wp_login_title');

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
function example_customizer($wp_customize)
{
    // set up defaults
    $wp_customize->get_setting('header_textcolor')->default = '#000000';
    $wp_customize->get_setting('background_color')->default = '#ffffff';

    $wp_customize->add_section(
        'rjfs_franchise_config',
        array(
            'title' => 'Ram Jack Settings',
            'description' => 'This section is where all our franchise specific settings are set.',
            'priority' => 35,
        )
    );

    // Logo
    $default = get_template_directory_uri() . '/assets/images/ramjack-logo-black.png';
    $wp_customize->add_setting('rjfs_logo', array(
            'default' => $default
        )
    );
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'rjfs_logo', array(
                'label' => __('Logo', 'rjfs_logo'),
                'section' => 'rjfs_franchise_config',
                'settings' => 'rjfs_logo',
            )
        )
    );

    // Phone number
    $wp_customize->add_setting(
        'rjfs_phone',
        array(
            'default' => '(555) 555-555',
        )
    );
    $wp_customize->add_control(
        'rjfs_phone',
        array(
            'label' => 'Phone Number',
            'section' => 'rjfs_franchise_config',
            'type' => 'text',
        )
    );

    // Header Caption
    $wp_customize->add_setting(
        'rjfs_header_caption',
        array(
            'default' => 'Ram Jack',
        )
    );
    $wp_customize->add_control(
        'rjfs_header_caption',
        array(
            'label' => 'Header Caption',
            'section' => 'rjfs_franchise_config',
            'type' => 'text',
        )
    );

    // Header Desc
    $wp_customize->add_setting(
        'rjfs_header_desc',
        array(
            'default' => 'Foundation Repair Services For [ENTER COMPNAY NAME] and surrounding areas',
        )
    );
    $wp_customize->add_control(
        'rjfs_header_desc',
        array(
            'label' => 'Header Description',
            'section' => 'rjfs_franchise_config',
            'type' => 'text',
        )
    );

}

add_action('customize_register', __NAMESPACE__ . '\\example_customizer');


// Short codes
function phone_number_func()
{
    return get_theme_mod('rjfs_phone');
}

add_shortcode('phone-number', __NAMESPACE__ . '\\phone_number_func');

function header_caption_func()
{
    return get_theme_mod('rjfs_header_caption');
}

add_shortcode('header-caption', __NAMESPACE__ . '\\header_caption_func');


function header_description_func()
{
    return get_theme_mod('rjfs_header_desc');
}

add_shortcode('header-description', __NAMESPACE__ . '\\header_description_func');
