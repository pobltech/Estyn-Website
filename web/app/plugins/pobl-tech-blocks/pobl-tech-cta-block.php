<?php
/**
 * Plugin Name:       Pobl Tech Blocks
 * Description:       Our plugin that registers our blocks.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.1
 * Author:            Pobl Tech
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       pobl-tech-cta-block
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_pobl_tech_cta_block_block_init() {
	register_block_type( __DIR__ . '/blocks/build/pobl-tech-cta-block' );
	register_block_type( __DIR__ . '/blocks/build/pobl-tech-accordion-block' );
	register_block_type( __DIR__ . '/blocks/build/pobl-tech-accordion-item-block' );
	register_block_type( __DIR__ . '/blocks/build/pobl-tech-carousel-block' );
}
add_action( 'init', 'create_block_pobl_tech_cta_block_block_init' );

// Add NONCE stuff so the editor can make REST requests to any custom endpoints
function pobl_tech_blocks_add_nonce() {
	$handle = 'pobl-tech-carousel-block-editor-script';

	// Check if the script is enqueued
	if (wp_script_is($handle, 'enqueued')) {
		// Generate the nonce
		$nonce = wp_create_nonce('wp_rest');

		// Prepare the inline script to add the nonce
		$inline_script = sprintf('var poblTechBlockData = { nonce: "%s" };', $nonce);

		// Add the inline script to the enqueued block script
		wp_add_inline_script($handle, $inline_script, 'before');
	}
}
add_action('enqueue_block_assets', 'pobl_tech_blocks_add_nonce');