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
