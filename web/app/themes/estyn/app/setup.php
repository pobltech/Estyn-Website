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
        'rewrite' => ['slug' => 'news'],
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

    // Add tag support
    register_taxonomy_for_object_type('post_tag', 'estyn_imp_resource');
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

    register_taxonomy('sector', array('estyn_eduprovider', 'estyn_imp_resource', 'estyn_inspectionrpt', 'estyn_newsarticle'), array(
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

    register_taxonomy('local_authority', array('estyn_eduprovider', 'estyn_imp_resource', 'estyn_inspectionrpt'), array(
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
    $query = new \WP_Query([
        'posts_per_page' => 20,
        'post_type' => $request->get_param('postType') != null ? $request->get_param('postType') : ['post', 'estyn_newsarticle', 'estyn_imp_resource', 'estyn_eduprovider', 'estyn_inspectionrpt'],
        's' => $request->get_param('searchText'),
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
  
// For the 'News and blog' page search and filters update (ajax) requests
// Returns the HTML for the list of resources
function estyn_resources_search(\WP_REST_Request $request) {
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
        } elseif($params['postType'] === 'estyn_imp_resource') {
            $args['post_type'] = 'estyn_imp_resource';
        } elseif($params['postType'] === 'estyn_eduprovider') {
            $args['post_type'] = 'estyn_eduprovider';
            $args['posts_per_page'] = 50;
        } elseif($params['postType'] === 'estyn_inspectionrpt') {
            $args['post_type'] = 'estyn_inspectionrpt';
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

    if(isset($params['sort'])) {
        $args['orderby'] = $params['sort'];
        if($params['sort'] == 'title') {
            $args['order'] = 'ASC';
        } elseif($params['sort'] == 'type' && isset($params['postType']) && $params['postType'] == 'estyn_imp_resource') {
            // We need to sort by the 'Improvement Resource Type' taxonomy
            $args['orderby'] = 'tax_query';
        }
    }

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

    if(isset($params['tags'])) {
        $args['tag'] = $params['tags'];
    }

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
    foreach($posts as $post) {
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
        }

        $postTypeName = ucfirst(strtolower($postTypeName));

        $items[] = [
            'linkURL' => get_permalink($post->ID),
            'superText' => $postTypeName,
            'superDate' => $args['post_type'] != 'estyn_eduprovider' ? get_the_date('d/m/Y', $post->ID) : null,
            'title' => get_the_title($post->ID),
        ];
    }

    $HTML = \Roots\view('components.resource-list', [
        'items' => $items
    ]);

    return ['html' => $HTML->render(), 'totalPosts' => $query->found_posts];
}

/**
 * When a post is imported using WP All Import, ACF might not recognise it
 * until it's been saved once. This hook will save the post after import.
 */
add_action('pmxi_saved_post', __NAMESPACE__ . '\\save_post_after_import', 10, 1);

function save_post_after_import($post_id) {
    $post = get_post($post_id);
    wp_update_post($post);
}

/** 
 * Stop ACF removing the 'Custom Fields' meta box from the post edit screen
 */
//add_filter('acf/settings/remove_wp_meta_box', '__return_false');