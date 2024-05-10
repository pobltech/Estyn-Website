/**
 * Use this file for JavaScript code that you want to run in the front-end
 * on posts/pages that contain this block.
 *
 * When this file is defined as the value of the `viewScript` property
 * in `block.json` it will be enqueued on the front end of the site.
 *
 * Example:
 *
 * ```js
 * {
 *   "viewScript": "file:./view.js"
 * }
 * ```
 *
 * If you're not making any changes to this file because your project doesn't need any
 * JavaScript running in the front-end, then you should delete this file and remove
 * the `viewScript` property from `block.json`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#view-script
 */

/* eslint-disable no-console */
//console.log( 'Hello World! (from create-block-pobl-tech-cta-block block)' );
/* eslint-enable no-console */

// Scale the image so it looks good in relation to the height of
// the text content
jQuery(document).ready(function($) {
    $('.pt-cta-block').each(function() {
        const elemID = $(this).attr('id');

        const contentHeight = $('#' + elemID + ' .pt-cta-content').height();
        const height = contentHeight * 1.25; // 125% of the text content's height

        $('#' + elemID + ' .pt-cta-image:not(.breakOut)').css('height', height);
    });
});
