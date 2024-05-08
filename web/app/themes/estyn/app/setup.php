<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;

// Output error_log() etc. to the terminal. TODO: Remove this in production.
ini_set('error_log', 'php://stdout');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    bundle('app')->enqueue()->localize('estyn', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'news_and_blog_posts_search_rest_url' => rest_url('estyn/v1/newsandblogposts/'),
        'nonce' => wp_create_nonce('wp_rest'),
    ]);
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
/* add_action('init', function () {
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
}); */

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
        'menu_icon' => 'dashicons-admin-site-alt',
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
        'menu_icon' => 'dashicons-hammer',
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

/**
 * Register 'estyn_eduprovider' post type.
 */
add_action('init', function () {
    register_post_type('estyn_eduprovider', [
        'labels' => [
            'name' => __('Providers', 'sage'),
            'singular_name' => __('Provider', 'sage'),
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'],
        'rewrite' => ['slug' => 'education-providers'],
        'show_in_rest' => true, // Enable Gutenberg editor
    ]);
});

/**
 * Register the Inspection Report post type.
 */
add_action('init', function () {
    register_post_type('estyn_inspectionrpt', [
        'labels' => [
            'name' => __('Inspection Reports', 'sage'),
            'singular_name' => __('Inspection Report', 'sage'),
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-clipboard',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'],
        'rewrite' => ['slug' => 'inspection-reports'],
        'show_in_rest' => true, // Enable Gutenberg editor
    ]);
});

/**
 * Create the Sector taxonomy and the Local Authority taxonomy for the Education Providers post type.
 */
function create_eduprovider_taxonomies() {
    $labels = array(
        'name' => _x( 'Sectors', 'taxonomy general name', 'sage' ),
        'singular_name' => _x( 'Sector', 'taxonomy singular name', 'sage' ),
        'search_items' =>  __( 'Search Sectors', 'sage' ),
        'all_items' => __( 'All Sectors', 'sage' ),
        'edit_item' => __( 'Edit Sector', 'sage' ),
        'update_item' => __( 'Update Sector', 'sage' ),
        'add_new_item' => __( 'Add New Sector', 'sage' ),
        'new_item_name' => __( 'New Sector Name', 'sage' ),
        'menu_name' => __( 'Sectors', 'sage' ),
    );

    register_taxonomy('sector', array('estyn_eduprovider'), array(
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'sector' ),
        'show_in_rest' => true, // Enable Gutenberg editor
    ));

    $labels = array(
        'name' => _x( 'Local Authorities', 'taxonomy general name', 'sage' ),
        'singular_name' => _x( 'Local Authority', 'taxonomy singular name', 'sage' ),
        'search_items' =>  __( 'Search Local Authorities', 'sage' ),
        'all_items' => __( 'All Local Authorities', 'sage' ),
        'edit_item' => __( 'Edit Local Authority', 'sage' ),
        'update_item' => __( 'Update Local Authority', 'sage' ),
        'add_new_item' => __( 'Add New Local Authority', 'sage' ),
        'new_item_name' => __( 'New Local Authority Name', 'sage' ),
        'menu_name' => __( 'Local Authorities', 'sage' ),
    );

    register_taxonomy('local_authority', array('estyn_eduprovider'), array(
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'local-authority' ),
        'show_in_rest' => true, // Enable Gutenberg editor
    ));
}
add_action( 'init', __NAMESPACE__ . '\\create_eduprovider_taxonomies', 0 );

/**
 * Create the Status taxonomy for the Education Providers post type.
 */
function create_eduprovider_status_taxonomy() {
    $labels = array(
        'name' => _x( 'Statuses', 'taxonomy general name', 'sage' ),
        'singular_name' => _x( 'Status', 'taxonomy singular name', 'sage' ),
        'search_items' =>  __( 'Search Statuses', 'sage' ),
        'all_items' => __( 'All Statuses', 'sage' ),
        'edit_item' => __( 'Edit Status', 'sage' ),
        'update_item' => __( 'Update Status', 'sage' ),
        'add_new_item' => __( 'Add New Status', 'sage' ),
        'new_item_name' => __( 'New Status Name', 'sage' ),
        'menu_name' => __( 'Statuses', 'sage' ),
    );

    register_taxonomy('provider_status', array('estyn_eduprovider'), array(
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'provider-status' ),
        'show_in_rest' => true, // Enable Gutenberg editor
    ));
}
add_action( 'init', __NAMESPACE__ . '\\create_eduprovider_status_taxonomy', 0 );

/**
 * Now for our own REST API endpoints
 */
add_action('rest_api_init', function () {
    register_rest_route('estyn/v1', '/newsandblogposts/', array(
        'methods' => 'GET',
        'callback' => __NAMESPACE__ . '\\estyn_get_news_and_blog_posts',
        'permission_callback' => function (\WP_REST_Request $request) {
            $nonce = $request->get_header('X-WP-Nonce');
            return wp_verify_nonce($nonce, 'wp_rest');
        },
    ));
});
  
// For the 'News and blog' page search and filters update (ajax) requests
function estyn_get_news_and_blog_posts(\WP_REST_Request $request) {
    $params = $request->get_params();
    error_log(print_r($params, true));
    
    $args = [
        'posts_per_page' => -1,
        'post_type' => ['post', 'estyn_newsarticle'],
    ];

    if(isset($params['postType'])) {
        if($params['postType'] === 'estyn_newsarticle') {
            $args['post_type'] = 'estyn_newsarticle';
        } elseif($params['postType'] === 'post') {
            $args['post_type'] = 'post';
        }
    }

    if(isset($params['year'])) {
        if(is_numeric($params['year'])) {
            $args['date_query'] = [
                [
                    'year' => $params['year'],
                ],
            ];
        }
    }

    if(isset($params['searchText']) && !empty($params['searchText'])) {
        $args['s'] = $params['searchText'];
    }

    // Merge the request parameters into the query arguments
    /* $args = array_merge($args, $params); */

    $query = new \WP_Query($args);
    $posts = $query->posts;
    // Convert the posts to the format expected by the client
    /* $posts = array_map(function($post) {
        return [
            'title' => ['rendered' => $post->post_title],
            'content' => ['rendered' => $post->post_content],
        ];
    }, $posts);
    return $posts; */

    if(empty($posts)) {
        return __('Sorry, no resources were found based on your search criteria.', 'sage');
    }

    // We'll send the HTML, from the view, instead of the raw post data
    $items = [];
    foreach($posts as $post) {
        $postTypeName = (get_post_type_object(get_post_type($post)))->labels->singular_name;
        if($postTypeName == 'Post') {
          $postTypeName = __('Blog post', 'sage');
        }

        $postTypeName = ucfirst(strtolower($postTypeName));

        $items[] = [
            'linkURL' => get_permalink($post->ID),
            'superText' => $postTypeName,
            'superDate' => get_the_date('d/m/Y', $post->ID),
            'title' => get_the_title($post->ID),
        ];
    }

    $HTML = \Roots\view('components.resource-list', [
        'items' => $items
    ]);

    return $HTML->render();
}