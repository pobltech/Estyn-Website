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
//console.log("Hello World! (from create-block-pobl-tech-carousel-block block)");
/* eslint-enable no-console */

// Import Bootstrap
//import { Carousel } from 'bootstrap';

document.addEventListener('DOMContentLoaded', (event) => {
    const carouselElements = document.querySelectorAll('.pobl-tech-carousel-block');
    carouselElements.forEach((carouselElement) => {
        //const carousel = new Carousel(carouselElement);
        const carouselId = carouselElement.getAttribute('id');
        //console.log('Carousel with ID ' + carouselId + ' initialized');

        let buttonRight = carouselElement.querySelector('#' + carouselId + '-slideRight');
        let buttonLeft = carouselElement.querySelector('#' + carouselId + '-slideLeft');

        const carouselSlider = carouselElement.querySelector('.pobl-tech-carousel-block-slider');

        buttonRight.onclick = function () {
            carouselSlider.scrollLeft += 500;
        };

        buttonLeft.onclick = function () {
            carouselSlider.scrollLeft -= 500;
        };

    });
});