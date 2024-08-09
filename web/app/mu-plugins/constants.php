<?php
/**
 * Old Estyn site files location
 * 
 * Paths appended to this should have 'files/' or 'private/files/' prepended to them
 */
add_action('init', function() {
    if (!defined('ESTYN_OLD_FILES_URL')) {
        //define('ESTYN_OLD_FILES_URL', wp_upload_dir()['baseurl'] . '/estyn_old_files/');
        
        // The WP URL of site followed by /system/
        define('ESTYN_OLD_FILES_URL', '/system/');
    }

    if (!defined('ESTYN_DEFAULT_HERO_IMAGE_FILENAME')) {
        define('ESTYN_DEFAULT_HERO_IMAGE_FILENAME', 'estyn-school-default.jpg');
    }

    if (!defined('ESTYN_PROVIDER_DEFAULT_HERO_IMAGE_FILENAME')) {
        define('ESTYN_PROVIDER_DEFAULT_HERO_IMAGE_FILENAME', defined('ESTYN_DEFAULT_HERO_IMAGE_FILENAME') ? ESTYN_DEFAULT_HERO_IMAGE_FILENAME : 'estyn-school-default.jpg');
    }
});