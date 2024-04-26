<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

	// Get the attributes.
	$ctaHeading = isset($attributes['heading']) ? $attributes['heading'] : '';
	$ctaText = isset($attributes['text']) ? $attributes['text'] : '';
	$ctaButtonLinkURL = isset($attributes['buttonURL']) ? $attributes['buttonURL'] : '';
	$ctaButtonText = isset($attributes['buttonText']) ? $attributes['buttonText'] : '';
	$imageBreakOut = isset($attributes['imageBreakOut']) ? $attributes['imageBreakOut'] : false;

	$imageExtraClasses = '';

	$showSearchBox = false;

	$ctaImageURL = '';
	if($attributes['variant'] === 'general') {
		$ctaImageURL = $attributes['imageURL'];
	} else {
		// map.svg which is in the block's assets/images folder
		$ctaImageURL = plugins_url('pobl-tech-cta-block/blocks/assets/images/map.svg');
		$imageBreakOut = true;
		$imageExtraClasses = 'ctaSearchMap';

		$showSearchBox = true;
	}
	
	$ctaImageAlt = isset($attributes['imageAlt']) ? $attributes['imageAlt'] : '';
	

	// Output the attributes for debugging
	/* echo '<pre>';
	print_r($attributes);
	echo '</pre>'; */

	$HTML = '';

	if(function_exists('\Roots\view')) {
		try {
			$HTML = \Roots\view('partials.cta', [
				'ctaHeading' => $ctaHeading,
				'ctaText' => $ctaText,
				'ctaButtonLinkURL' => $ctaButtonLinkURL,
				'ctaButtonText' => $ctaButtonText,
				'ctaImageURL' => $ctaImageURL,
				'ctaImageAlt' => $ctaImageAlt,
				'imageBreakOut' => $imageBreakOut,
				'imageExtraClasses' => $imageExtraClasses,
				'showSearchBox' => $showSearchBox,
				'ctaContainerExtraClasses' => 'pt-cta-block',
				'noJavaScript' => true
			]);
		} catch (InvalidArgumentException $e) {
			$HTML = '<p>View not found</p>';
		}

	} else {
		$HTML = '<p>Not using Sage theme</p>';
	}
	

	//$template_path = locate_template(['resources/views/partials/cta.blade.php']);

	echo $HTML;