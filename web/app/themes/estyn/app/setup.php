<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    bundle('app')->enqueue();
}, 100);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    bundle('editor')->enqueue();
}, 100);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id' => 'sidebar-footer',
    ] + $config);
});

/**
 * Register 'estyn_thematic_report' post type.
 */
add_action('init', function () {
    register_post_type('estyn_thematicreport', [
        'labels' => [
            'name' => __('Thematic Reports', 'sage'),
            'singular_name' => __('Thematic Report', 'sage'),
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-media-document',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'],
        'rewrite' => ['slug' => 'thematic-reports'],
        'show_in_rest' => true, // Enable Gutenberg editor
    ]);
});

/**
 * Register 'estyn_newsarticle' post type.
 */
add_action('init', function () {
    register_post_type('estyn_newsarticle', [
        'labels' => [
            'name' => __('News Articles', 'sage'),
            'singular_name' => __('News Article', 'sage'),
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-media-document',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'],
        'rewrite' => ['slug' => 'news-articles'],
        'show_in_rest' => true, // Enable Gutenberg editor
    ]);
});

/**
 * Register Improvement Resource post type.
 */
add_action('init', function () {
    register_post_type('estyn_imp_resource', [
        'labels' => [
            'name' => __('Improvement Resources', 'sage'),
            'singular_name' => __('Improvement Resource', 'sage'),
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-media-document',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'],
        'rewrite' => ['slug' => 'improvement-resources'],
        'show_in_rest' => true, // Enable Gutenberg editor
    ]);
});

/**
 * Add the custom taxonomy for Improvement Resources
 */
function create_improvement_resource_type_taxonomy() {
    $labels = array(
        'name' => _x( 'Improvement Resource Types', 'taxonomy general name', 'sage' ),
        'singular_name' => _x( 'Improvement Resource Type', 'taxonomy singular name', 'sage' ),
        'search_items' =>  __( 'Search Improvement Resource Types', 'sage' ),
        'all_items' => __( 'All Improvement Resource Types', 'sage' ),
        'edit_item' => __( 'Edit Improvement Resource Type', 'sage' ),
        'update_item' => __( 'Update Improvement Resource Type', 'sage' ),
        'add_new_item' => __( 'Add New Improvement Resource Type', 'sage' ),
        'new_item_name' => __( 'New Improvement Resource Type Name', 'sage' ),
        'menu_name' => __( 'Improvement Resource Types', 'sage' ),
    );

    register_taxonomy('improvement_resource_type', array('estyn_imp_resource'), array(
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'improvement_resource_type' ),
        'show_in_rest' => true, // Enable Gutenberg editor
        'meta_box_cb' => 'post_categories_meta_box',
    ));
}
add_action( 'init', __NAMESPACE__ . '\\create_improvement_resource_type_taxonomy', 0 );

function add_improvement_resource_types() {
    $types = array('Thematic Report', 'Effective Practice', 'Additional Resource');
    foreach($types as $type) {
        if(!term_exists($type, 'improvement_resource_type')) {
            wp_insert_term($type, 'improvement_resource_type');
        }
    }
}
add_action('init', __NAMESPACE__ . '\\add_improvement_resource_types');
