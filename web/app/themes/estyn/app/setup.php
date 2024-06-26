<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;

use Geocoder\Query\GeocodeQuery;
use Geocoder\Query\ReverseQuery;
use Http\Adapter\Guzzle6\Client;
use Geocoder\Provider\GoogleMaps\GoogleMaps;
use Geocoder\StatefulGeocoder;

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
        'resources_search_rest_url' => rest_url('estyn/v1/resources_search/'),
        'all_search_rest_url' => rest_url('estyn/v1/all_search/'),
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
        'main_nav_parents_carers_and_learners_signposts' => __('Signposts for "Parents, Carers, and Learners" - Main Nav', 'sage'),
        'main_nav_parents_carers_and_learners_right_hand_side_links' => __('Links for "Parents, Carers and Learners" - Main Nav', 'sage'),
        'main_nav_education_professionals_signposts' => __('Signposts for "Education Professionals" - Main Nav', 'sage'),
        'main_nav_education_professionals_right_hand_side_links' => __('Education Professionals - Links - Main Nav', 'sage'),
        'main_nav_about_estyn_signposts' => __('Signposts for "About Estyn" - Main Nav', 'sage'),
        'main_nav_about_estyn_right_hand_side_links' => __('Links for "About Estyn" - Main Nav', 'sage'),
        'main_nav_search_popular_links' => __('Search - Popular Links - Main Nav', 'sage'),
        'footer_nav_1' => __('Footer Navigation Menu 1', 'sage'),
        'footer_nav_2' => __('Footer Navigation Menu 2', 'sage'),
        'footer_nav_3' => __('Footer Navigation Menu 3', 'sage'),
        'footer_bottom_nav' => __('Footer Bottom Navigation Menu', 'sage')
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
 * Global Items
 */
add_action('init', function() { 
    register_post_type( 'global' , [
        'labels' => [
            'name' => _x('Global Items', 'post type general name'),
            'singular_name' => _x('Global Item', 'post type singular name'),
            'add_new' => _x('Add New', 'Global Item'),
            'add_new_item' => __('Add New Global Item'),
            'edit_item' => __('Edit Global Item'),
            'new_item' => __('New Global Item'),
            'view_item' => __('View Global Item'),
            'search_items' => __('Search Global Items'),
            'not_found' =>  __('Nothing found'),
            'not_found_in_trash' => __('Nothing found in Trash'),
            'parent_item_colon' => ''
        ],
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-site-alt3',
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => ['title']
    ]);
});

/**
 * Register 'estyn_newsarticle' post type.
 * 
 * TODO: Remove hack to get custom post type URL slugs translations to work with Polylang (until we use Pro)
 */
add_action('init', function () {
    $news_slug = __('news', 'sage');
    flush_rewrite_rules(); // Only use this once, not in any other actions added to init. It's part of the hack to get custom post type URL slugs translations to work with Polylang (until we use Pro
    register_post_type('estyn_newsarticle', [
        'labels' => [
            'name' => __('News Articles', 'sage'),
            'singular_name' => __('News Article', 'sage'),
            'add_new' => __('Add New', 'sage'),
            'add_new_item' => __('Add New News Article', 'sage'),
            'edit_item' => __('Edit News Article', 'sage'),
            'new_item' => __('New News Article', 'sage'),
            'view_item' => __('View News Article', 'sage'),
            'search_items' => __('Search News Articles', 'sage'),
            'not_found' => __('No news articles found', 'sage'),
            'not_found_in_trash' => __('No news articles found in Trash', 'sage'),
            'all_items' => __('All News Articles', 'sage'),
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-admin-site-alt',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'],
        'rewrite' => ['slug' => $news_slug, 'with_front' => false],
        'show_in_rest' => true, // Enable Gutenberg editor
    ]);
});

/**
 * Register Improvement Resource post type.
 */
add_action('init', function () {
    $improvementResourcesSlug = __('improvement-resources', 'sage');
    register_post_type('estyn_imp_resource', [
        'labels' => [
            'name' => __('Improvement Resources', 'sage'),
            'singular_name' => __('Improvement Resource', 'sage'),
            'add_new' => __('Add New', 'sage'),
            'add_new_item' => __('Add New Improvement Resource', 'sage'),
            'edit_item' => __('Edit Improvement Resource', 'sage'),
            'new_item' => __('New Improvement Resource', 'sage'),
            'view_item' => __('View Improvement Resource', 'sage'),
            'search_items' => __('Search Improvement Resources', 'sage'),
            'not_found' => __('No improvement resources found', 'sage'),
            'not_found_in_trash' => __('No improvement resources found in Trash', 'sage'),
            'all_items' => __('All Improvement Resources', 'sage'),
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-hammer',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'],
        'rewrite' => ['slug' => $improvementResourcesSlug, 'with_front' => false],
        'show_in_rest' => true, // Enable Gutenberg editor,
    ]);

    // Add tag support
    register_taxonomy_for_object_type('post_tag', 'estyn_imp_resource');
});

/**
 * Override the post type archive links
 */
add_filter('post_type_archive_link', __NAMESPACE__ . '\\estyn_custom_archive_links', 10, 2);

function estyn_custom_archive_links($link, $post_type) {
    $newLink = $link;
    
    switch($post_type) {
        case 'post':
            $newLink = get_permalink_by_template('template-news-and-blog.blade.php');
            break;
        case 'estyn_imp_resource':
            $newLink = get_permalink_by_template('template-search.blade.php');
            break;
        case 'estyn_eduprovider':
            $newLink = get_permalink_by_template('provider-search.blade.php');
            break;
        case 'estyn_inspectionrpt':
            $newLink = get_permalink_by_template('template-inspection-report-search.blade.php');
            break;
        case 'estyn_newsarticle':
            $newLink = get_permalink_by_template('template-news-and-blog.blade.php');
            break;
        case 'estyn_inspguidance':
            $newLink = get_permalink_by_template('template-inspection-guidance-search-page.blade.php');
            break;
        case 'estyn_insp_qu':
            $newLink = get_permalink_by_template('template-inspection-questionnaire-search-page.blade.php');
            break;
        case 'estyn_thematicreport':
            $newLink = get_permalink_by_template('template-search.blade.php');
            break;
        case 'estyn_job_vacancy':
            $newLink = get_permalink_by_template('template-vacancies.blade.php');
            break;
        case 'estyn_team_member':
            $newLink = get_permalink_by_template('template-about.blade.php');
            break;
        case 'estyn_event':
            $newLink = get_permalink_by_template('template-events.blade.php');
            break;
        default:
            break;
    }

    return $newLink;
}

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

    $improvementResourceTypeSlug = __('improvement-resource-type', 'sage');
    register_taxonomy('improvement_resource_type', array('estyn_imp_resource'), array(
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => $improvementResourceTypeSlug, 'with_front' => false),
        'show_in_rest' => true, // Enable Gutenberg editor
        'meta_box_cb' => 'post_categories_meta_box',
    ));
}
add_action( 'init', __NAMESPACE__ . '\\create_improvement_resource_type_taxonomy', 0 );

// Enable REST query for the 'improvement_resource_type' taxonomy
add_action('rest_api_init', function () {
    register_rest_route('wp/v2', '/estyn_imp_resource', array(
        'methods' => 'GET',
        'callback' => __NAMESPACE__ . '\\estyn_imp_resource_query',
        'args' => array(
            'improvement_resource_type' => array(
                'validate_callback' => function($param, $request, $key) {
                    return true; // Here you can add validation for the parameter value
                },
                'sanitize_callback' => 'sanitize_text_field', // Sanitize the input
            ),
        ),
        'permission_callback' => function (\WP_REST_Request $request) {
            $nonce = $request->get_header('X-WP-Nonce');
            return wp_verify_nonce($nonce, 'wp_rest');
        },
    ));
});

function estyn_imp_resource_query($data) {
    $args = array(
        'post_type' => 'estyn_imp_resource',
        // Add other WP_Query arguments as needed
    );

    // Check if 'improvement_resource_type' is in the query and modify the query accordingly
    if (!empty($data['improvement_resource_type'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'improvement_resource_type',
                'field' => 'slug',
                'terms' => explode(',', $data['improvement_resource_type']),
            ),
        );
    }

    $posts = get_posts($args);
    $data = array();

    foreach ($posts as $post) {
        // Format the post data so it's the same as when you get it from the REST API
        $item = array(
            'id' => $post->ID,
            'title' => [
                'rendered' => apply_filters('the_title', $post->post_title),
                'protected' => false,
            ],
            'content' => [
                'rendered' => apply_filters('the_content', $post->post_content),
                'protected' => false,
            ],
            'excerpt' => [
                'rendered' => apply_filters('the_excerpt', $post->post_excerpt),
                'protected' => false,
            ],
            'featured_media' => get_post_thumbnail_id($post->ID),
            'date' => $post->post_date,
            'modified' => $post->post_modified,
            'slug' => $post->post_name,
            'type' => $post->post_type,
            'link' => get_permalink($post->ID)
        );

        $data[] = $item;
    }

    return new \WP_REST_Response($data, 200);
}
/* function my_custom_query_vars_filter($vars) {
    $vars[] = 'improvement_resource_type';
    return $vars;
}
add_filter('rest_query_vars', __NAMESPACE__ . '\\my_custom_query_vars_filter');

function filter_rest_estyn_imp_resource_query($args, $request) {
    if (!empty($request['improvement-resource-type'])) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'improvement_resource_type',
                'field' => 'slug',
                'terms' => explode(',', $request['improvement-resource-type']),
            ],
        ];
    }
    return $args;
}
add_filter('rest_estyn_imp_resource_query', __NAMESPACE__ . '\\filter_rest_estyn_imp_resource_query', 10, 2); */

function add_improvement_resource_types() {
    $types = array('Thematic Report', 'Effective Practice', 'Additional Resource', 'Annual Report');
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
    $providersSlug = __('education-providers', 'sage');
    register_post_type('estyn_eduprovider', [
        'labels' => [
            'name' => __('Providers', 'sage'),
            'singular_name' => __('Provider', 'sage'),
            'edit_item' => __('Edit Provider', 'sage'),
            'view_item' => __('View Provider', 'sage'),
            'search_items' => __('Search Providers', 'sage'),
            'not_found' => __('No providers found', 'sage'),
            'not_found_in_trash' => __('No providers found in Trash', 'sage'),
            'all_items' => __('All Providers', 'sage'),
            'add_new_item' => __('Add New Provider', 'sage'),
            'add_new' => __('Add New', 'sage'),
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'],
        'rewrite' => ['slug' => $providersSlug, 'with_front' => false],
        'show_in_rest' => true, // Enable Gutenberg editor
    ]);
});

/**
 * Register the Inspection Report post type.
 */
add_action('init', function () {
    $inspectionReportsSlug = __('inspection-reports', 'sage');
    register_post_type('estyn_inspectionrpt', [
        'labels' => [
            'name' => __('Inspection Reports', 'sage'),
            'singular_name' => __('Inspection Report', 'sage'),
            'add_new' => __('Add New', 'sage'),
            'add_new_item' => __('Add New Inspection Report', 'sage'),
            'edit_item' => __('Edit Inspection Report', 'sage'),
            'new_item' => __('New Inspection Report', 'sage'),
            'view_item' => __('View Inspection Report', 'sage'),
            'search_items' => __('Search Inspection Reports', 'sage'),
            'not_found' => __('No inspection reports found', 'sage'),
            'not_found_in_trash' => __('No inspection reports found in Trash', 'sage'),
            'all_items' => __('All Inspection Reports', 'sage'),
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-clipboard',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'],
        'rewrite' => ['slug' => $inspectionReportsSlug, 'with_front' => false],
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

    $sectorSlug = __('sector', 'sage');
    register_taxonomy('sector', array('estyn_eduprovider', 'estyn_imp_resource', 'estyn_inspectionrpt', 'estyn_newsarticle', 'post'), array(
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => $sectorSlug, 'with_front' => false),
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

    $localAuthoritySlug = __('local-authority', 'sage');
    register_taxonomy('local_authority', array('estyn_eduprovider', 'estyn_imp_resource', 'estyn_inspectionrpt'), array(
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => $localAuthoritySlug, 'with_front' => false),
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

    $providerStatusSlug = __('provider-status', 'sage');
    register_taxonomy('provider_status', array('estyn_eduprovider'), array(
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => $providerStatusSlug, 'with_front' => false),
        'show_in_rest' => true, // Enable Gutenberg editor
    ));
}
add_action( 'init', __NAMESPACE__ . '\\create_eduprovider_status_taxonomy', 0 );

// Part of the hack to get custom post type URL slugs translations to work with Polylang (until we use Pro)
function correct_slug_in_language_switcher($url, $lang) {
    global $post;

    $translated_post_id = pll_get_post($post->ID, $lang);
    $translated_post = get_post($translated_post_id);
    $translated_post_name = $translated_post->post_name;

    if($post->post_type == 'estyn_inspectionrpt') {
        $slug = $lang == 'cy' ? 'adolygiadau' : 'inspection-reports';
    } elseif ($post->post_type == 'estyn_newsarticle') {
        $slug = $lang == 'cy' ? 'newyddion' : 'news';
    } elseif ($post->post_type == 'estyn_imp_resource') {
        $slug = $lang == 'cy' ? 'adnoddau-gwella' : 'improvement-resources';
    } elseif ($post->post_type == 'estyn_eduprovider') {
        $slug = $lang == 'cy' ? 'darparwyr-addysg' : 'education-providers';
    } else {
        return $url;
    }
    
    if($lang == 'en') {
        $url = '/' . $slug . '/' . $translated_post_name . '/';
    } else {
        $url = '/cy/' . $slug . '/' . $translated_post_name . '/';
    }

    return $url;
}
add_filter('pll_translation_url', __NAMESPACE__ . '\\correct_slug_in_language_switcher', 10, 2);

/**
 * Change the rewrite rule for tags so they don't have "/blog/" in the URL
 */
function change_tag_rewrite_args($args, $taxonomy) {
    if ('post_tag' === $taxonomy) {
        $args['rewrite'] = array('slug' => 'tag', 'with_front' => false);
    }
    return $args;
}
add_filter('register_taxonomy_args', __NAMESPACE__ . '\\change_tag_rewrite_args', 10, 2);


/**
 * Now for our own REST API endpoints
 */
add_action('rest_api_init', function () {
    register_rest_route('estyn/v1', '/resources_search/', array(
        'methods' => 'GET',
        'callback' => __NAMESPACE__ . '\\estyn_resources_search',
        'permission_callback' => function (\WP_REST_Request $request) {
            $nonce = $request->get_header('X-WP-Nonce');
            return wp_verify_nonce($nonce, 'wp_rest');
        },
    ));

    register_rest_route('estyn/v1', '/all_search/', array(
        'methods' => 'GET',
        'callback' => __NAMESPACE__ . '\\estyn_all_search',
        'permission_callback' => function (\WP_REST_Request $request) {
            $nonce = $request->get_header('X-WP-Nonce');
            return wp_verify_nonce($nonce, 'wp_rest');
        },
    ));
});

// For the typical 'search Estyn' boxes
// Returns an array of items with the URL and title or an empty array if no results
function estyn_all_search(\WP_REST_Request $request) {
    $params = $request->get_params();
    $language = !empty($params['language']) ? $params['language'] : (function_exists('pll_current_language') ? pll_current_language() : 'en');

    $query = new \WP_Query([
        'posts_per_page' => 20,
        'post_type' => $request->get_param('postType') != null ? $request->get_param('postType') : ['post', 'estyn_newsarticle', 'estyn_imp_resource', 'estyn_eduprovider', 'estyn_inspectionrpt'],
        's' => $request->get_param('searchText'),
        'lang' => $language
    ]);

    $posts = $query->posts;

    if($query->found_posts == 0) {
        return [];
    }

    $items = [];
    foreach($posts as $post) {
        $items[] = [
            'URL' => get_permalink($post->ID),
            'title' => get_the_title($post->ID),
        ];
    }

    return $items;
}

function calculateDistanceBetween($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000) {
    // Convert from degrees to radians
    $latFrom = deg2rad($latitudeFrom);
    $lonFrom = deg2rad($longitudeFrom);
    $latTo = deg2rad($latitudeTo);
    $lonTo = deg2rad($longitudeTo);

    $latDelta = $latTo - $latFrom;
    $lonDelta = $lonTo - $lonFrom;

    $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
        cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
    return $angle * $earthRadius;
}


// For the search pages (ajax) requests
// Returns the HTML for the list of resources
function estyn_resources_search(\WP_REST_Request $request) {
    $params = $request->get_params();
    //error_log(print_r($params, true));

    $language = !empty($params['language']) ? $params['language'] : (function_exists('pll_current_language') ? pll_current_language() : 'en');
    //error_log('Language: ' . $language);
    
    $args = [
        'posts_per_page' => -1,
        'post_type' => ['post', 'estyn_newsarticle'],
        'lang' => $language,
    ];

    if(isset($params['paged'])) {
        $args['paged'] = $params['paged'];
    }

    if(isset($params['postType'])) {
        if($params['postType'] === 'estyn_newsarticle') {
            $args['post_type'] = 'estyn_newsarticle';
        } elseif($params['postType'] === 'post') {
            $args['post_type'] = 'post';
        } elseif($params['postType'] === 'estyn_imp_resource') {
            $args['post_type'] = 'estyn_imp_resource';
        } elseif($params['postType'] === 'estyn_eduprovider') {
            if(empty($params['inspectionSchedule'])) {
                $args['post_type'] = 'estyn_eduprovider';
                $args['posts_per_page'] = 50;
                $args['orderby'] = 'title';
                $args['order'] = 'ASC';
            } else {
                $args['post_type'] = 'estyn_eduprovider';
                $args['meta_query'] = [
                  'relation' => 'OR',
                  [
                    'key' => 'next_scheduled_inspection_date',
                    'value' => date('Y-m-d'),
                    'compare' => '>=',
                    'type' => 'DATE'
                  ],
                  [
                    'key' => 'next_visit_date_old_db',
                    'value' => date('Y-m-d'),
                    'compare' => '>=',
                    'type' => 'DATE'
                  ]
                ];

                $args['orderby'] = 'meta_value';
                $args['meta_key'] = 'next_scheduled_inspection_date';
                $args['order'] = 'ASC';
            }
        } elseif($params['postType'] === 'estyn_inspectionrpt') {
            $args['post_type'] = 'estyn_inspectionrpt';
        } elseif($params['postType'] === 'estyn_inspguidance') {
            $args['post_type'] = 'estyn_inspguidance';
        } elseif($params['postType'] === 'estyn_insp_qu') {
            $args['post_type'] = 'estyn_insp_qu';
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

    if(isset($params['sort']) && empty($params['inspectionSchedule'])) {
        if($params['sort'] == 'lastUpdated') {
            $args['orderby'] = 'meta_value';
            $args['meta_key'] = 'last_updated';
        } else {
            $args['orderby'] = $params['sort'];
        }

        if($params['sort'] == 'title') {
            $args['order'] = 'ASC';
        } elseif($params['sort'] == 'date' || $params['sort'] == 'lastUpdated') {
            $args['order'] = 'DESC';
        } elseif($params['sort'] == 'type' && isset($params['postType']) && $params['postType'] == 'estyn_imp_resource') {
            // We need to sort by the 'Improvement Resource Type' taxonomy
            $args['orderby'] = 'tax_query';
            $args['order'] = 'ASC';
        }
    }
    
    // TODO: We need to look at the associated providers' LAs and sectors too, not just
    // rely on the actual post being assigned the LAs and sectors
    if(isset($params['localAuthority']) && term_exists($params['localAuthority']) ) {
        if(!isset($args['tax_query'])) {
            $args['tax_query'] = [];
        }
        $args['tax_query'][] = [
            [
                'taxonomy' => 'local_authority',
                'field' => 'slug',
                'terms' => $params['localAuthority'],
            ],
        ];
    }

    if(isset($params['sector']) && term_exists($params['sector']) ){
        if(!isset($args['tax_query'])) {
            $args['tax_query'] = [];
        }
        $args['tax_query'][] = [
            [
                'taxonomy' => 'sector',
                'field' => 'slug',
                'terms' => $params['sector'],
            ],
        ];
    }

    // improvement_resource_type
    if(isset($params['improvementResourceType']) && term_exists($params['improvementResourceType']) ){
        if(!isset($args['tax_query'])) {
            $args['tax_query'] = [];
        }
        $args['tax_query'][] = [
            [
                'taxonomy' => 'improvement_resource_type',
                'field' => 'slug',
                'terms' => $params['improvementResourceType'],
            ],
        ];
    }

    // inspection_guidance_type
    if(isset($params['inspectionGuidanceType']) && term_exists($params['inspectionGuidanceType']) ) {
        if(!isset($args['tax_query'])) {
            $args['tax_query'] = [];
        }
        $args['tax_query'][] = [
            [
                'taxonomy' => 'inspection_guidance_type',
                'field' => 'slug',
                'terms' => $params['inspectionGuidanceType'],
            ],
        ];
    }

    // Inspection Questionnaire Category
    if(isset($params['inspectionQuestionnaireCategory']) && term_exists($params['inspectionQuestionnaireCategory']) ) {
        if(!isset($args['tax_query'])) {
            $args['tax_query'] = [];
        }
        $args['tax_query'][] = [
            [
                'taxonomy' => 'inspection_questionnaire_cat',
                'field' => 'slug',
                'terms' => $params['inspectionQuestionnaireCategory'],
            ],
        ];
    }

    if(isset($params['tags'])) {
        $args['tag'] = $params['tags'];
    }

/*     if(isset($params['numLearners'])) {
        if(!isset($args['meta_query'])) {
            $args['meta_query'] = [];
        }
        $args['meta_query'][] = [
            [
                'key' => 'number_of_pupils',
                'value' => $params['numLearners']
            ],
        ];
    
    } */


    // Merge the request parameters into the query arguments
    /* $args = array_merge($args, $params); */

    $query = new \WP_Query($args);
    
    // Convert the posts to the format expected by the client
    /* $posts = array_map(function($post) {
        return [
            'title' => ['rendered' => $post->post_title],
            'content' => ['rendered' => $post->post_content],
        ];
    }, $posts);
    return $posts; */

    if($query->found_posts == 0) {
        return ['html' => __('Sorry, no resources were found based on your search criteria.', 'sage'), 'totalPosts' => 0];
    }

    $posts = $query->posts;
    
    // We'll send the HTML, from the view, instead of the raw post data
    $items = [];


    // 'Similar Settings To Mine' filters
    $postsToRemove = [];
    
    if( ((!empty($params['numLearners'])) && ($params['numLearners'] != 'any')) || ((!empty($params['languageMedium'])) && $params['languageMedium'] != 'any' ) || ((!empty($params['proximity'])) && $params['proximity'] != 'any' ) || ((!empty($params['ageRange'])) && $params['ageRange'] != 'any' ) ) {
        // We need to get all the estyn_eduprovider posts that are
        // assigned to this post and check if any of them match the number of learners.
        // If they do, then we include this post in the results, otherwise we skip it.
        //
        // Inspection reports (inspected_provider ACF Post Object field), effective practice (resource_creator ACF Post Object field), thematic reports (featured_providers ACF Relationship field)

        // If they've chosen to filter by proximity, we need to make sure we have
        // a Google Maps API key, otherwise there's no point in continuing
        $GoogleMapsAPIKey = '';
        $geocodingHttpClient = null;
        $geocodingProvider = null;
        $geocoder = null;
        $providerDistances = [];
        $geoCodingResult = null;
        $latitude = 0;
        $longitude = 0;
        if((!empty($params['proximity'])) && $params['proximity'] != 'any') {
            $GoogleMapsAPIKey = env('GOOGLE_MAPS_API_KEY');
            if(empty($GoogleMapsAPIKey)) {
                error_log('NO MAPS API KEY!');
                return ['html' => __('Sorry, no resources were found based on your search criteria.', 'sage'), 'totalPosts' => 0];
            }

            try {
                $geocodingHttpClient = new \GuzzleHttp\Client();
                $geocodingProvider = new GoogleMaps($geocodingHttpClient, null, $GoogleMapsAPIKey);
                $geocoder = new StatefulGeocoder($geocodingProvider, 'en');
            } catch(\Exception $e) {
                error_log('Error creating geocoder: ' . $e->getMessage());
                return ['html' => __('Sorry, no resources were found based on your search criteria.', 'sage'), 'totalPosts' => 0];
            }

            $postcode = trim($params['proximityPostcode']);

            

            try {
                $geoCodingResult = $geocoder->geocodeQuery(GeocodeQuery::create($postcode));
            } catch(\Exception $e) {
                error_log('Error geocoding postcode: ' . $e->getMessage());
                return ['html' => __('Sorry, no resources were found based on your search criteria.', 'sage'), 'totalPosts' => 0];
            }

            $firstResult = $geoCodingResult->first();
            $latitude = $firstResult->getCoordinates()->getLatitude();
            $longitude = $firstResult->getCoordinates()->getLongitude();
        }

        foreach($posts as $post) {
            $providers = get_field('inspected_provider', $post->ID);
            if(empty($providers)) {
                //error_log('No inspected provider for ' . $post->ID);
                $providers = get_field('resource_creator', $post->ID);
            }
            if(empty($providers)) {
                //error_log('No resource creator for ' . $post->ID);
                $providers = get_field('featured_providers', $post->ID);
            }

            if(empty($providers)) {
                $postsToRemove[] = $post->ID;
                continue; // We skip this improvement resource if there are no providers assigned to it
            }

               //error_log('Providers for ' . $post->ID . ':');
            //error_log(print_r($providers, true));

            // $providers will either be a single post object, an array of post objects, or a comma separated list of post IDs
            // We need to make it an array of post objects
            if(!is_array($providers)) {
                if(is_string($providers)) {
                    $providers = explode(',', trim($providers));
                } else {
                    $providers = [$providers];
                }
            }

            //error_log('Providers after conversion for ' . $post->ID . ':');
            //error_log(print_r($providers, true));

            // All providers at this point should be a numeric value (post ID)
            // but it's possible that some of the items are just empty strings. Need to remove those
            $providers = array_filter($providers, function($provider) {
                return !empty($provider);
            });

            if(empty($providers)) {
                $postsToRemove[] = $post->ID;
                continue; // We skip this improvement resource if there are no providers assigned to it
            }

            // If it's an array of post IDs, we need to convert them to post objects
            foreach($providers as $index => $provider) {
                if(is_numeric($provider)) {
                    $providers[$index] = get_post($provider);
                }
            }

            //error_log('Providers for ' . $post->ID . ':');
            //error_log(print_r($providers, true));

            if((!empty($params['numLearners'])) && ($params['numLearners'] != 'any')) {
                $numLearnersMin = 0;
                $numLearnersMax = 0;

                if(is_numeric($params['numLearners'])) {
                    $numLearnersMin = $params['numLearners'];
                    $numLearnersMax = $params['numLearners'];
                } else {
                    // We have a range (e.g. '1-50') or e.g. '50+'
                    $numLearnersRange = explode('-', $params['numLearners']);
                    if(count($numLearnersRange) == 2) {
                        $numLearnersMin = $numLearnersRange[0];
                        $numLearnersMax = $numLearnersRange[1];
                    } else {
                        $numLearnersMin = explode('+', $params['numLearners'])[0];
                        $numLearnersMax = 9999999; // A very high number
                    }
                }
                
                //error_log('Num learners: ' . $params['numLearners']);
                $match = false;
                foreach($providers as $provider) {
                    $numLearners = get_field('number_of_pupils', $provider->ID);
                    //error_log('Num learners ACF field value for ' . $provider->ID . ': ' . $numLearners);
                    if(empty($numLearners)) {
                        continue;
                    }
                    
                    if(is_numeric($numLearners)) {
                        // If it's between the min and max, we have a match
                        if(intval($numLearners) >= intval($numLearnersMin) && intval($numLearners) <= intval($numLearnersMax)) {
                            $match = true;
                            //error_log('Matched ' . $numLearners . ' with ' . $params['numLearners']);
                            break;
                        }
                    }

                    if($numLearners == $params['numLearners']) {
                        $match = true;
                        //error_log('Matched ' . $numLearners . ' with ' . $params['numLearners']);
                        break;
                    }
                }

                if(!$match) {
                    $postsToRemove[] = $post->ID;
                    continue; // We skip this improvement resource if the number of learners doesn't match
                }
            }

            if((!empty($params['languageMedium'])) && $params['languageMedium'] != 'any') {
                //error_log('Language medium: ' . $params['languageMedium']);
                $match = false;
                foreach($providers as $provider) {
                    $languageMedium = get_field('language_medium', $provider->ID);
                    //error_log('Language medium ACF field value for ' . $provider->ID . ': ' . $languageMedium);

                    if(empty($languageMedium)) {
                        // Try 'provider_language_id_external_db' custom field
                        $languageMedium = get_post_meta($provider->ID, 'provider_language_id_external_db', true);

                        //error_log('Language medium custom field value for ' . $provider->ID . ': ' . $languageMedium);

                        if(empty($languageMedium)) {
                            continue;
                        }

                        if(intval($languageMedium) == 1) {
                            $languageMedium = 'english';
                        } else {
                            $languageMedium = 'welsh';
                        }
                    }

                    

                    if(strtolower($languageMedium) == strtolower($params['languageMedium'])) {
                        $match = true;
                        //error_log('Matched ' . $languageMedium . ' with ' . $params['languageMedium']);
                        break;
                    }
                }

                if(!$match) {
                    $postsToRemove[] = $post->ID;
                    continue; // We skip this improvement resource if the language medium doesn't match
                }
            }

            if((!empty($params['ageRange'])) && $params['ageRange'] != 'any') {
                $match = false;

                foreach($providers as $provider) {
                    $ageRange = get_field('age_range', $provider->ID);
                    if($ageRange == $params['ageRange']) {
                        $match = true;
                        //error_log('Matched ' . $ageRange . ' with ' . $params['ageRange']);
                        break;
                    }
                }

                if(!$match) {
                    $postsToRemove[] = $post->ID;
                    continue; // We skip this improvement resource if the age range doesn't match
                }
            }

            if((!empty($params['proximity'])) && $params['proximity'] != 'any') {
                // $params['proximity'] will be e.g. '0-50', '50-100', '100-200', '200-250', '250+'
                // Lets convert it to a min and max
                $proximityMin = 0;
                $proximityMax = 0;
                
                // If there's a '+' symbol, set min to the number before the '+'
                // and max to a very large number
                if(strpos($params['proximity'], '+') !== false) {
                    $proximityMin = intval(explode('+', $params['proximity'])[0]);
                    $proximityMax = 9999999; // A very high number
                } else {
                    $proximityRange = explode('-', $params['proximity']);
                    $proximityMin = intval($proximityRange[0]);
                    $proximityMax = intval($proximityRange[1]);
                }
                
                $match = false;

                foreach($providers as $provider) {
                    // Let's check if we've already calculated the distance from this provider to the given postcode
                    if(array_key_exists($provider->ID, $providerDistances)) {
                        //error_log('Distance already calculated for ' . $provider->ID);
                        $distance = $providerDistances[$provider->ID];
                        if($distance >= $proximityMin && $distance <= $proximityMax) {
                            $match = true;
                            //error_log('Matched ' . $distance . ' miles with ' . $params['proximity']);
                            break;
                        }
                        continue;
                    }

                    $providerLongitude = get_field('longitude', $provider->ID);
                    if(empty($providerLongitude) || (!is_numeric($providerLongitude))) {
                        continue;
                    }

                    $providerLatitude = get_field('latitude', $provider->ID);
                    if(empty($providerLatitude) || (!is_numeric($providerLatitude))) {
                        continue;
                    }

                    // Calculate the distance between the provider and the postcode
                    $distance = calculateDistanceBetween($latitude, $longitude, $providerLatitude, $providerLongitude);
                    // In miles:
                    $distance = $distance * 0.000621371;

                    // Store the distance for this provider so we don't recalculate it later
                    $providerDistances[$provider->ID] = $distance;
                    //error_log('Stored distance for ' . $provider->ID . ': ' . $distance . ' miles');

                    //error_log('Distance between ' . $postcode . ' and ' . $provider->ID . ': ' . $distance . ' miles');

                    if($distance >= $proximityMin && $distance <= $proximityMax) {
                        $match = true;
                        //error_log('Matched ' . $distance . ' miles with ' . $params['proximity']);
                        break;
                    }
                }

                if(!$match) {
                    $postsToRemove[] = $post->ID;
                    continue; // We skip this improvement resource if the proximity doesn't match
                }
            }
            
        }
    }

    //error_log('Number of posts to remove: ' . count($postsToRemove));
    //error_log('Posts to remove:');
    //error_log(print_r($postsToRemove, true));

    if(!empty($postsToRemove)) {
        $args['post__not_in'] = $postsToRemove;
    }

    $args['posts_per_page'] = 10;

    $query = new \WP_Query($args);

    if($query->found_posts == 0) {
        return ['html' => __('Sorry, no resources were found based on your search criteria.', 'sage'), 'totalPosts' => 0];
    }

    $posts = $query->posts;

    foreach($posts as $post) {
        $reportFile = null;//$firstPDFAttachment = null; // Used for inspection reports and annual reports and inspection guidance

        $isAnnualReport = false;
        if($args['post_type'] == 'estyn_imp_resource') {
            $terms = get_the_terms($post->ID, 'improvement_resource_type');
            if($terms) {
                foreach($terms as $term) {
                    if($term->name == __('Annual Report', 'sage')) {
                        $isAnnualReport = true;
                        break;
                    }
                }
            }
        }

        if($args['post_type'] == 'estyn_inspectionrpt' || $isAnnualReport || $args['post_type'] == 'estyn_inspguidance' || $args['post_type'] == 'estyn_insp_qu') {
/*             $attachments = get_posts([
                'post_type' => 'attachment',
                'posts_per_page' => 1,
                'post_parent' => $post->ID,
                'post_mime_type' => 'application/pdf',
            ]); */

            
            
            if($args['post_type'] == 'estyn_inspguidance') {
                $reportFile = getInspectionGuidanceFileURL($post);
            } elseif($args['post_type'] == 'estyn_insp_qu') {
                $reportFile = getInspectionQuestionnaireFileURL($post);
            } else {
                // We use get_field('report_file') to get the PDF attachment.
                // If that returns null, then we'll try the 'report_file_from_old_site' custom field (using get_post_meta()),
                // prepending the value with the uploads directory path + '/estyn_old_files/'
                $reportFile = get_field('report_file', $post->ID);
                if(!$reportFile) {
                    $reportFile = get_post_meta($post->ID, 'report_file_from_old_site', true);
                    if($reportFile) {
                        // report_file_from_old_site is the filename of the PDF prepended with the old folder structure, either 'private/files' or just 'files'
                        // So for example, 'private/files/filename.pdf' or 'files/filename.pdf'
                        // We've emulated it this by moving the private and files folders to uploads/estyn_old_files
                        $reportFile = ESTYN_OLD_FILES_URL . $reportFile;
                        // Now we have to deal with the fact that some of the filenames literally have "%20" in them!
                        $reportFile = explode('/', $reportFile);
                        $reportFilename = array_pop($reportFile);
                        $reportFile = implode('/', $reportFile) . '/' . rawurlencode($reportFilename);
                    } else {
                        continue; // We skip this inspection report if there's no PDF attachment
                    }
                } else {
                    $reportFile = $reportFile['url'];
                }
            }

            /* if($attachments) {
                $firstPDFAttachment = $attachments[0];
            } else {
                continue; // We don't want to show inspection reports without a PDF attachment
            } */
        }        
        
        $postTypeName = (get_post_type_object(get_post_type($post)))->labels->singular_name;
        if($postTypeName == 'Post') {
          $postTypeName = __('Blog post', 'sage');
        } elseif(strtolower($postTypeName) == 'improvement resource') {
          // In this case we use the 'Improvement Resource Type' taxonomy to get the type of resource
            $terms = get_the_terms($post->ID, 'improvement_resource_type');
            if($terms) {
                foreach($terms as $index => $term) {
                    if($index == 0) {
                        $postTypeName = $term->name;
                    } else {
                        $postTypeName .= ', ' . $term->name;
                    }
                }
            }
        } elseif(strtolower($postTypeName) == 'inspection guidance') {
            // In this case we use the 'Inspection Guidance Type' taxonomy to get the type of guidance
            $terms = get_the_terms($post->ID, 'inspection_guidance_type');
            if($terms) {
                foreach($terms as $index => $term) {
                    if($index == 0) {
                        $postTypeName = $term->name;
                    } else {
                        $postTypeName .= ', ' . $term->name;
                    }
                }
            }
        } elseif(strtolower($postTypeName) == 'inspection questionnaire') { // TODO: Don't rely on the post type name. Same for other lines in this file
            // In this case we use the 'Inspection Questionnaire Category' taxonomy to get the type of questionnaire
            $terms = get_the_terms($post->ID, 'inspection_questionnaire_cat');
            if($terms) {
                foreach($terms as $index => $term) {
                    if($index == 0) {
                        $postTypeName = $term->name;
                    } else {
                        $postTypeName .= ', ' . $term->name;
                    }
                }
            }
        }

        $postTypeName = ucfirst(strtolower($postTypeName));

        $superDateText = null;
        if(($args['post_type'] != 'estyn_eduprovider') && isset($args['orderby']) && empty($params['inspectionSchedule'])) {
            if($params['sort'] == 'lastUpdated') {
                $superDateText = get_field('last_updated', $post->ID) ? (new \DateTime(get_field('last_updated', $post->ID)))->format('d/m/Y') : get_the_date('d/m/Y', $post->ID);
            } else {
                if($args['post_type'] == 'estyn_inspectionrpt') {
                    $superDateText = get_field('inspection_date', $post->ID) ? (new \DateTime(get_field('inspection_date', $post->ID)))->format('F Y') : get_the_date('F Y', $post->ID);
                } else {
                    $superDateText = get_the_date('d/m/Y', $post->ID);
                }
            }
        }

        if(($args['post_type'] == 'estyn_inspectionrpt' || $isAnnualReport || $args['post_type'] == 'estyn_inspguidance' || $args['post_type'] == 'estyn_insp_qu') && (!empty($reportFile))) {
            $items[] = [
                'linkURL' => $reportFile, //wp_get_attachment_url($firstPDFAttachment->ID),
                'superText' => $postTypeName,
                'superDate' => $superDateText,
                'title' => get_the_title($post->ID),
            ];
        } elseif(!empty($params['inspectionSchedule'])) {
            $items[] = [
                'linkURL' => get_permalink($post->ID),
                'superText' => __('Upcoming inspection', 'sage'),
                'superDate' => !empty(get_field('next_scheduled_inspection_date', $post->ID)) ? (new \DateTime(get_field('next_scheduled_inspection_date', $post->ID)))->format('d/m/Y') : (new \DateTime(get_post_meta('next_visit_date_old_db', get_the_ID(), true)))->format('d/m/Y'),
                'title' => get_the_title($post->ID),
            ];
        } else {
            $items[] = [
                'linkURL' => get_permalink($post->ID),
                'superText' => $postTypeName,
                'superDate' => $superDateText,
                'title' => get_the_title($post->ID),
            ];
        }
    }

    $HTML = \Roots\view('components.resource-list', [
        'items' => $items
    ]);

    return [
        'html' => $HTML->render(), // We use the Blade template view function to render the HTML
        'totalPosts' => $query->found_posts,
        'maxPages' => $query->max_num_pages,
        'currentPage' => $args['paged'],
        'nextPage' => $query->max_num_pages > $args['paged'] ? $args['paged'] + 1 : null,
        'prevPage' => $args['paged'] > 1 ? $args['paged'] - 1 : null,
    ];
}

/**
 * When a post is imported using WP All Import, ACF might not recognise it
 * until it's been saved once. For example, when using the ‘Post Object’/’Relationship’ fields, the search feature may not find the imported posts. This hook will save the post after import, circumventing this issue.
 */
add_action('pmxi_saved_post', __NAMESPACE__ . '\\save_post_after_import', 10, 1);

function save_post_after_import($post_id) {
    $post = get_post($post_id);
    wp_update_post($post);
}

/** 
 * Stop ACF removing the 'Custom Fields' meta box from the post edit screen
 */
add_filter('acf/settings/remove_wp_meta_box', '__return_false');

/**
 * Get the permalink of a page that uses a specific template
 * 
 * @param string $template The template file name
 * @return string|null The permalink of the page, or null if no pages were found
 */
function get_permalink_by_template($template) {
    // Get all pages that use the specified template
    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => $template
    ));

    // Check if any pages were found
    if ($pages) {
        // Return the permalink of the first page
        return get_permalink($pages[0]->ID);
    } else {
        return null;
    }
}

/**
 * For an inspection report, retrieve the corresponding report file, from either the ACF field
 * or the custom field 'report_file_from_old_site'
 */
function getInspectionReportFileURL($post) {
    /*$attachments = get_posts([
        'post_type' => 'attachment',
        'post_parent' => get_the_ID(),
        'posts_per_page' => -1,
    ]);*/

    // We use get_field('report_file') to get the PDF attachment.
    // If that returns null, then we'll try the 'report_file_from_old_site' custom field (using get_post_meta()),
    // prepending the value with the uploads directory path + '/estyn_old_files/'
    $reportFile = get_field('report_file', $post);
    if(!$reportFile) {
        $reportFile = get_post_meta($post->ID, 'report_file_from_old_site', true);
        if($reportFile) {
            // report_file_from_old_site is the filename of the PDF prepended with the old folder structure, either 'private/files' or just 'files'
            // So for example, 'private/files/filename.pdf' or 'files/filename.pdf'
            // We've emulated it this by moving the private and files folders to uploads/estyn_old_files
            $reportFile = ESTYN_OLD_FILES_URL . $reportFile;
            // Now we have to deal with the fact that some of the filenames literally have "%20" in them!
            $reportFile = explode('/', $reportFile);
            $reportFilename = array_pop($reportFile);
            $reportFile = implode('/', $reportFile) . '/' . rawurlencode($reportFilename);
        } else {
            return null;
        }
    } else {
        $reportFile = $reportFile['url'];
    }

    /*$hasPDF = false;
    foreach($attachments as $attachment) {
        if($attachment->post_mime_type == 'application/pdf') {
        $hasPDF = true;
        $firstPDFAttachment = $attachment;
        break;
        }
    }

    if(!$hasPDF) {
        continue;
    }*/
    
    return $reportFile;

}

/**
 * For an inspection guidance, retrieve the corresponding file, from either the ACF field
 * or the custom field 'guidance_file_from_old_site'
 */
function getInspectionGuidanceFileURL($post) {
    $guidanceFile = get_field('inspection_guidance_file', $post);

    if(!$guidanceFile) {
        $guidanceFile = get_post_meta($post->ID, 'guidance_file_from_old_site', true);
        if($guidanceFile) {
            // guidance_file_from_old_site is the filename of the PDF prepended with the old folder structure, either 'private/files' or just 'files'
            // So for example, 'private/files/filename.pdf' or 'files/filename.pdf'
            // We've emulated it this by moving the private and files folders to uploads/estyn_old_files
            $guidanceFile = ESTYN_OLD_FILES_URL . $guidanceFile;
            // Now we have to deal with the fact that some of the filenames literally have "%20" in them!
            $guidanceFile = explode('/', $guidanceFile);
            $guidanceFilename = array_pop($guidanceFile);
            $guidanceFile = implode('/', $guidanceFile) . '/' . rawurlencode($guidanceFilename);
        } else {
            return null;
        }
    } else {
        $guidanceFile = $guidanceFile['url'];
    }

    return $guidanceFile;

}

function getInspectionQuestionnaireFileURL($post) {
    $questionnaireFile = get_field('inspection_questionnaire_file', $post);

    if(!$questionnaireFile) {
        $questionnaireFile = get_post_meta($post->ID, 'guidance_file_from_old_site', true); // Yes, I forgot to change the field name during import
        if($questionnaireFile) {
            // guidance_file_from_old_site is the filename of the PDF prepended with the old folder structure, either 'private/files' or just 'files'
            // So for example, 'private/files/filename.pdf' or 'files/filename.pdf'
            // We've emulated it this by moving the private and files folders to uploads/estyn_old_files
            $questionnaireFile = ESTYN_OLD_FILES_URL . $questionnaireFile;
            // Now we have to deal with the fact that some of the filenames literally have "%20" in them!
            $questionnaireFile = explode('/', $questionnaireFile);
            $questionnaireFilename = array_pop($questionnaireFile);
            $questionnaireFile = implode('/', $questionnaireFile) . '/' . rawurlencode($questionnaireFilename);
        } else {
            return null;
        }
    } else {
        $questionnaireFile = $questionnaireFile['url'];
    }

    return $questionnaireFile;
}



/**
 * Register 'estyn_inspection_guidance' post type,
 * and 'estyn_inspection_guidance_type' taxonomy.
 * 
 * The post type supports the Sectors taxonomy and tags
 */
add_action('init', function () {
    $inspectionGuidanceSlug = __('inspection-guidance', 'sage');
    register_post_type('estyn_inspguidance', [
        'labels' => [
            'name' => __('Inspection Guidance', 'sage'),
            'singular_name' => __('Inspection Guidance', 'sage'),
            'add_new' => __('Add New', 'sage'),
            'add_new_item' => __('Add New Inspection Guidance', 'sage'),
            'edit_item' => __('Edit Inspection Guidance', 'sage'),
            'new_item' => __('New Inspection Guidance', 'sage'),
            'view_item' => __('View Inspection Guidance', 'sage'),
            'search_items' => __('Search Inspection Guidance', 'sage'),
            'not_found' => __('No inspection guidance found', 'sage'),
            'not_found_in_trash' => __('No inspection guidance found in Trash', 'sage'),
            'all_items' => __('All Inspection Guidance', 'sage'),
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-clipboard',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'],
        'rewrite' => ['slug' => $inspectionGuidanceSlug, 'with_front' => false],
        'show_in_rest' => true, // Enable Gutenberg editor
    ]);

    // Add tag support
    register_taxonomy_for_object_type('post_tag', 'estyn_inspguidance');

    // Add the 'estyn_inspection_guidance_type' taxonomy
    $labels = array(
        'name' => _x( 'Inspection Guidance Types', 'taxonomy general name', 'sage' ),
        'singular_name' => _x( 'Inspection Guidance Type', 'taxonomy singular name', 'sage' ),
        'search_items' =>  __( 'Search Inspection Guidance Types', 'sage' ),
        'all_items' => __( 'All Inspection Guidance Types', 'sage' ),
        'edit_item' => __( 'Edit Inspection Guidance Type', 'sage' ),
        'update_item' => __( 'Update Inspection Guidance Type', 'sage' ),
        'add_new_item' => __( 'Add New Inspection Guidance Type', 'sage' ),
        'new_item_name' => __( 'New Inspection Guidance Type Name', 'sage' ),
        'menu_name' => __( 'Inspection Guidance Types', 'sage' ),
    );

    $inspectionGuidanceTypeSlug = __('inspection-guidance-type', 'sage');

    register_taxonomy('inspection_guidance_type', array('estyn_inspguidance'), array(
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => $inspectionGuidanceTypeSlug, 'with_front' => false),
        'show_in_rest' => true, // Enable Gutenberg editor
    ));

    // Add the 'sector' taxonomy
    register_taxonomy_for_object_type('sector', 'estyn_inspguidance');


});

function getInspectionGuidancePostPlaceholderImageURL($post) {
    return asset('images/inspection-guidance-placeholder.jpg');
}

function getInspectionQuestionnairePostPlaceholderImageURL($post) {
    return asset('images/inspection-guidance-placeholder.jpg');
}

/**
 * Register 'estyn_insp_qu' post type (Inspection Questionnaires),
 * and 'estyn_inspection_questionnaire_category' taxonomy.
 * 
 * The post type supports the Sectors taxonomy and tags
 */
add_action('init', function () {
    $inspectionQuestionnaireSlug = __('inspection-questionnaire', 'sage');
    register_post_type('estyn_insp_qu', [
        'labels' => [
            'name' => __('Inspection Questionnaires', 'sage'),
            'singular_name' => __('Inspection Questionnaire', 'sage'),
            'add_new' => __('Add New', 'sage'),
            'add_new_item' => __('Add New Inspection Questionnaire', 'sage'),
            'edit_item' => __('Edit Inspection Questionnaire', 'sage'),
            'new_item' => __('New Inspection Questionnaire', 'sage'),
            'view_item' => __('View Inspection Questionnaire', 'sage'),
            'search_items' => __('Search Inspection Questionnaires', 'sage'),
            'not_found' => __('No inspection questionnaires found', 'sage'),
            'not_found_in_trash' => __('No inspection questionnaires found in Trash', 'sage'),
            'all_items' => __('All Inspection Questionnaires', 'sage'),
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-clipboard',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'],
        'rewrite' => ['slug' => $inspectionQuestionnaireSlug, 'with_front' => false],
        'show_in_rest' => true, // Enable Gutenberg editor
    ]);

    // Add tag support
    register_taxonomy_for_object_type('post_tag', 'estyn_insp_qu');

    // Add the 'estyn_inspection_questionnaire_category' taxonomy
    $labels = array(
        'name' => _x( 'Inspection Questionnaire Categories', 'taxonomy general name', 'sage' ),
        'singular_name' => _x( 'Inspection Questionnaire Category', 'taxonomy singular name', 'sage' ),
        'search_items' =>  __( 'Search Inspection Questionnaire Categories', 'sage' ),
        'all_items' => __( 'All Inspection Questionnaire Categories', 'sage' ),
        'edit_item' => __( 'Edit Inspection Questionnaire Category', 'sage' ),
        'update_item' => __( 'Update Inspection Questionnaire Category', 'sage' ),
        'add_new_item' => __( 'Add New Inspection Questionnaire Category', 'sage' ),
        'new_item_name' => __( 'New Inspection Questionnaire Category Name', 'sage' ),
        'menu_name' => __( 'Inspection Questionnaire Categories', 'sage' ),
    );

    $inspectionQuestionnaireCategorySlug = __('inspection-questionnaire-category', 'sage');

    register_taxonomy('inspection_questionnaire_cat', array('estyn_insp_qu'), array(
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => $inspectionQuestionnaireCategorySlug, 'with_front' => false),
        'show_in_rest' => true, // Enable Gutenberg editor
    ));

    // Add the 'sector' taxonomy
    register_taxonomy_for_object_type('sector', 'estyn_insp_qu');

});

/**
 * Register 'estyn_team_member' post type with 'team_member_category' taxonomy
 */
add_action('init', function () {
    $teamMemberSlug = __('team-member', 'sage');
    register_post_type('estyn_team_member', [
        'labels' => [
            'name' => __('Team Members', 'sage'),
            'singular_name' => __('Team Member', 'sage'),
            'add_new' => __('Add New', 'sage'),
            'add_new_item' => __('Add New Team Member', 'sage'),
            'edit_item' => __('Edit Team Member', 'sage'),
            'new_item' => __('New Team Member', 'sage'),
            'view_item' => __('View Team Member', 'sage'),
            'search_items' => __('Search Team Members', 'sage'),
            'not_found' => __('No team members found', 'sage'),
            'not_found_in_trash' => __('No team members found in Trash', 'sage'),
            'all_items' => __('All Team Members', 'sage'),
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'],
        'rewrite' => ['slug' => $teamMemberSlug, 'with_front' => false],
        'show_in_rest' => true, // Enable Gutenberg editor
    ]);

    // Add the 'team_member_category' taxonomy
    $labels = array(
        'name' => _x( 'Team Member Categories', 'taxonomy general name', 'sage' ),
        'singular_name' => _x( 'Team Member Category', 'taxonomy singular name', 'sage' ),
        'search_items' =>  __( 'Search Team Member Categories', 'sage' ),
        'all_items' => __( 'All Team Member Categories', 'sage' ),
        'edit_item' => __( 'Edit Team Member Category', 'sage' ),
        'update_item' => __( 'Update Team Member Category', 'sage' ),
        'add_new_item' => __( 'Add New Team Member Category', 'sage' ),
        'new_item_name' => __( 'New Team Member Category Name', 'sage' ),
        'menu_name' => __( 'Team Member Categories', 'sage' ),
    );

    $teamMemberCategorySlug = __('team-member-category', 'sage');

    register_taxonomy('team_member_category', array('estyn_team_member'), array(
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => $teamMemberCategorySlug, 'with_front' => false),
        'show_in_rest' => true, // Enable Gutenberg editor
    ));

});

/**
 * Add a 'estyn_job_vacancy' post type
 */
add_action('init', function () {
    $jobVacancySlug = __('job-vacancy', 'sage');
    register_post_type('estyn_job_vacancy', [
        'labels' => [
            'name' => __('Job Vacancies', 'sage'),
            'singular_name' => __('Job Vacancy', 'sage'),
            'add_new' => __('Add New', 'sage'),
            'add_new_item' => __('Add New Job Vacancy', 'sage'),
            'edit_item' => __('Edit Job Vacancy', 'sage'),
            'new_item' => __('New Job Vacancy', 'sage'),
            'view_item' => __('View Job Vacancy', 'sage'),
            'search_items' => __('Search Job Vacancies', 'sage'),
            'not_found' => __('No job vacancies found', 'sage'),
            'not_found_in_trash' => __('No job vacancies found in Trash', 'sage'),
            'all_items' => __('All Job Vacancies', 'sage'),
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-businessman',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'],
        'rewrite' => ['slug' => $jobVacancySlug, 'with_front' => false],
        'show_in_rest' => true, // Enable Gutenberg editor
    ]);
});

/**
 * Add a 'estyn_event' post type. Also add a taxonomy called 'event tag'
 */
add_action('init', function () {
    $eventSlug = __('event', 'sage');
    register_post_type('estyn_event', [
        'labels' => [
            'name' => __('Events', 'sage'),
            'singular_name' => __('Event', 'sage'),
            'add_new' => __('Add New', 'sage'),
            'add_new_item' => __('Add New Event', 'sage'),
            'edit_item' => __('Edit Event', 'sage'),
            'new_item' => __('New Event', 'sage'),
            'view_item' => __('View Event', 'sage'),
            'search_items' => __('Search Events', 'sage'),
            'not_found' => __('No events found', 'sage'),
            'not_found_in_trash' => __('No events found in Trash', 'sage'),
            'all_items' => __('All Events', 'sage'),
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields'],
        'rewrite' => ['slug' => $eventSlug, 'with_front' => false],
        'show_in_rest' => true, // Enable Gutenberg editor
    ]);

    // Add tag support
    //register_taxonomy_for_object_type('post_tag', 'estyn_event');

    // Add the 'event_tag' taxonomy
    $labels = array(
        'name' => _x( 'Event Tags', 'taxonomy general name', 'sage' ),
        'singular_name' => _x( 'Event Tag', 'taxonomy singular name', 'sage' ),
        'search_items' =>  __( 'Search Event Tags', 'sage' ),
        'all_items' => __( 'All Event Tags', 'sage' ),
        'edit_item' => __( 'Edit Event Tag', 'sage' ),
        'update_item' => __( 'Update Event Tag', 'sage' ),
        'add_new_item' => __( 'Add New Event Tag', 'sage' ),
        'new_item_name' => __( 'New Event Tag Name', 'sage' ),
        'menu_name' => __( 'Event Tags', 'sage' ),
    );

    $eventTagSlug = __('event-tag', 'sage');

    register_taxonomy('event_tag', array('estyn_event'), array(
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => $eventTagSlug, 'with_front' => false),
        'show_in_rest' => true, // Enable Gutenberg editor
    ));

});

/**
 * Add a filter to the_content that removes any empty paragraphs
 */
add_filter('the_content', function($content) {
    if(is_admin()) {
        return $content;
    }

    return str_replace('<p>&nbsp;</p>', '', str_replace('<p></p>', '', $content));
});

/**
 * Add a filter to post content that gives every heading a unique ID attribute,
 * but only if the post type is estyn_imp_resource
 */

 // TODO: This solution doesn't work properly. Need a Javascript approach instead

/* add_filter('the_content', function($content) {
    if(get_post_type() != 'estyn_imp_resource' || is_admin()) {
        return $content;
    }

    $dom = new \DOMDocument();
    @$dom->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    $xpath = new \DOMXPath($dom);

    $headings = $xpath->query('//h1|//h2|//h3|//h4|//h5|//h6');
    $usedIDs = [];
    foreach($headings as $index => $heading) {
        if($heading->hasAttribute('id')) {
            continue;
        }
        
        $idBase = 'heading-' . $index;//strtolower(str_replace(' ', '-', trim($heading->textContent)));
        $id = $idBase;
        $counter = 1;
        // Ensure the ID is unique by appending a number if necessary
        while(in_array($id, $usedIDs)) {
            $id = $idBase . '-' . $counter;
            $counter++;
        }
        $heading->setAttribute('id', $id);
        $usedIDs[] = $id;
    }

    return $dom->saveHTML();
}); */

/**
 * Go through all the estyn_imp_resource, estyn_newsarticle, and normal posts.
 * For each one, if the ACF field 'read_time' is empty, calculate the read time
 * based on the post content and the corresponding PDF file if it has one (we'll use \Smalot\PdfParser), and
 * set the ACF field to the calculated value.
 * 
 * Normal posts and estyn_newsarticle posts don't have PDF attachments.
 * 
 * estyn_imp_resource posts that have the improvement_resource_type taxonomy term of 'Thematic Report' may have PDF attachments, and there are several ways they may be "attached":
 * 
 * 1. ACF File field called full_report_file
 * 2. Attached to the post as a media attachment
 * 3. Any of the following custom fields (not ACF):
 *          pdfs_uris
 *          documents_uris
 *          document_node_files_uris
 *    In which cases, the values are separated by a | character and we'll just take the first one.
 * 
 *    Also note that the values will be in the form "private/files/pdffilename.pdf" or "files/pdffilename.pdf",
 *    and the filename part will need to be rawurlencoded. Then we prepend ESTYN_OLD_FILES_URL to the front.
 * 
 * Obviously we're only going to run this once and then comment it out.
 */
/*  add_action('init', function() {
    $args = [
        'post_type' => ['estyn_imp_resource', 'post', 'estyn_newsarticle'],
        'posts_per_page' => -1,
    ];

    $countOfPostsThatNeedReadTime = 0;

    $query = new \WP_Query($args);

    foreach($query->posts as $post) {
        $readTime = get_field('read_time', $post->ID);
        // Note: -1 means we previously attempted to calculate the read time but failed
        // We don't want to get stuck in an infinite loop
        if( (!empty($readTime)) && (intval($readTime) > 0 || intval($readTime == -1)) ) {
            continue;
        }

        $countOfPostsThatNeedReadTime++;
    }

    error_log('Number of posts that need read time: ' . $countOfPostsThatNeedReadTime);

    foreach($query->posts as $post) {
        $readTime = get_field('read_time', $post->ID);
        // Note: -1 means we previously attempted to calculate the read time but failed
        // We don't want to get stuck in an infinite loop
        if( (!empty($readTime)) && (intval($readTime) > 0 || intval($readTime == -1)) ) {
            continue;
        }

        $content = $post->post_content;
        $pdfFile = null;

        if(get_post_type($post) == 'estyn_imp_resource') {
            $terms = get_the_terms($post->ID, 'improvement_resource_type');
            if($terms) {
                foreach($terms as $term) {
                    if($term->name == __('Thematic Report', 'sage')) {
                        $pdfFile = get_field('full_report_file', $post->ID);
                        if(!$pdfFile) {
                            $attachments = get_posts([
                                'post_type' => 'attachment',
                                'post_parent' => $post->ID,
                                'posts_per_page' => 1,
                                'post_mime_type' => 'application/pdf',
                            ]);

                            if($attachments) {
                                $pdfFile = get_permalink($attachments[0]->ID);
                            } else {
                                $pdfFile = get_post_meta($post->ID, 'pdfs_uris', true);
                                if(!$pdfFile) {
                                    $pdfFile = get_post_meta($post->ID, 'documents_uris', true);
                                    if(!$pdfFile) {
                                        $pdfFile = get_post_meta($post->ID, 'document_node_files_uris', true);
                                    }
                                }

                                if($pdfFile) {
                                    $pdfFile = explode('|', $pdfFile)[0];

                                    // Paths are in the form private/files/filename.pdf or files/filename.pdf
                                    // AND in some cases the filename is not safe for URLs, so we need to encode it
                                    $pathParts = explode('/', $pdfFile);
                                    $filename = array_pop($pathParts);
                                    $filename = rawurlencode($filename);
                                    $pathParts[] = $filename;

                                    $pdfFile = implode('/', $pathParts);

                                    $pdfFile = ESTYN_OLD_FILES_URL . $pdfFile;
                                }
                            }
                        } else {
                            $pdfFile = $pdfFile['url'];
                        }
                        break;
                    }
                }
            }
        }

        
        
        error_log('Calculating read time for post ' . $post->ID);

        $readTime = calculateReadTime($content, $pdfFile);
        
        error_log('Read time for post ' . $post->ID . ' is ' . $readTime);

        error_log('Updating post ' . $post->ID . ' ACF field with read time ' . $readTime);
        update_field('read_time', $readTime, $post->ID);

        $countOfPostsThatNeedReadTime--;
        error_log('Number of posts that still need read time: ' . $countOfPostsThatNeedReadTime);
    }
}); */

function calculateReadTime($content, $pdfFile) {
    $wordCount = str_word_count(strip_tags($content));
    $readTime = ceil($wordCount / 200); // 200 words per minute is the average reading speed

    if($pdfFile) {
        try {
            $pdfParser = new \Smalot\PdfParser\Parser();
            $pdf = $pdfParser->parseFile($pdfFile);
            $pdfText = $pdf->getText();
            $pdfWordCount = str_word_count($pdfText);
            $pdfReadTime = ceil($pdfWordCount / 200);
            $readTime += $pdfReadTime;
        } catch(\Exception $e) {
            error_log('Error parsing PDF file ' . $pdfFile . ': ' . $e->getMessage());

            return -1; // We'll set the read time -1 so we can easily identify posts without read time
        }
    }

    return $readTime;
}