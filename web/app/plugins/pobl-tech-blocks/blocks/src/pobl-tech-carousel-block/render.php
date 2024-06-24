<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

if(!function_exists('poblTechCarouselBlockRender')) {	
	function poblTechCarouselBlockRender($attributes) {
		// Try to use the Sage view function to render the carousel
		if(function_exists('\Roots\view')) {
			$postType = null;
			$postTypeLink = null;
			$buttonLink = $attributes['buttonLink'];

			$carouselItems = [];
	
			$carouselItemsQuery = new WP_Query();
			if($attributes['populateCarouselUsing'] === 'postType') {
				// Get post type details
				$postType = get_post_type_object($attributes['postTypeOfPostsToDisplayAsCarouselItems']);
				$postTypeLink = get_post_type_archive_link($postType->name);
				$buttonLink = $postTypeLink ? $postTypeLink : $attributes['buttonLink'];


				$args = array(
					'post_type' => $attributes['postTypeOfPostsToDisplayAsCarouselItems'],
					'posts_per_page' => -1,
					'status' => 'publish'
				);

				if($attributes['postTypeOfPostsToDisplayAsCarouselItems'] === 'estyn_imp_resource') {
					$args['tax_query'] = [
						[
							'taxonomy' => 'improvement_resource_type',
							'field' => 'slug',
							'terms' => $attributes['chosenImprovementResourceType']
						]
					];
				}

				// Make sure we get posts in the current language
				if(function_exists('pll_current_language')) {
					$args['lang'] = pll_current_language();
				}

				$carouselItemsQuery = new WP_Query($args);

				if($carouselItemsQuery->have_posts()) {
					while($carouselItemsQuery->have_posts()) {
						$carouselItemsQuery->the_post();

						// If it doesn't have a featured image, skip
						if(!has_post_thumbnail()) {
							continue;
						}

						$carouselItems[] = [
							'title' => get_the_title(),
							'excerpt' => get_the_excerpt(),
							'featured_image_src' => get_the_post_thumbnail_url(get_the_ID(), 'full'),
							'featured_image_alt' => get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true),
							'link' => get_the_permalink()
						];

						
					}
				}
				wp_reset_postdata();
			} else {
				$postIds = $attributes['postIdsOfPostsToDisplayAsCarouselItems'];

				/**
				 * IMPORTANT: The reason we do it this way
				 * instead of a single WP_Query is because
				 * the user can choose to have duplicate slides/posts
				 * in the carousel. This is not possible with WP_Query.
				 */
				foreach($postIds as $postId) {
					global $post;
					$post = get_post($postId);
					setup_postdata($post);

					// If it doesn't have a featured image, skip
					if(!has_post_thumbnail()) {
						continue;
					}

					$carouselItems[] = [
						'title' => get_the_title($post),
						'excerpt' => get_the_excerpt($post),
						'featured_image_src' => get_the_post_thumbnail_url($post, 'full'),
						'featured_image_alt' => get_post_meta(get_post_thumbnail_id($post), '_wp_attachment_image_alt', true),
						'link' => get_the_permalink($post)
					];

					wp_reset_postdata();
				}
			}

			wp_reset_postdata();

			// Cut carouselItems down to 10 items
			$carouselItems = array_slice($carouselItems, 0, 10);

			try {
				$HTML = \Roots\view('partials.slider', [
					'carouselHeading' => $attributes['heading'],
					'carouselDescription' => $attributes['description'],
					'carouselButtonLink' => $buttonLink,
					'carouselButtonText' => $attributes['buttonText'],
					'postIDs' => $attributes['postIdsOfPostsToDisplayAsCarouselItems'],
					'postType' => $attributes['postTypeOfPostsToDisplayAsCarouselItems'],
					'carouselID' => $attributes['carouselId'],
					'populateCarouselUsing' => $attributes['populateCarouselUsing'],
					'carouselItems' => $carouselItems,
					'carouselSectionClass' => 'pobl-tech-carousel-block',
					'carouselSliderWrapperClass' => 'pobl-tech-carousel-block-slider',
					'doNotDoJavaScript' => true, // Let our block handle the JS instead of the partial/component
				]);

				echo $HTML;

				return;

			} catch (InvalidArgumentException $e) {
				// The partial wasn't found
				// so we don't do 'return' here
			}
		}

		// If we got here then Sage View() and/or the partial wasn't found so
		// we'll render the carousel manually

		$postType = null;
		$postTypeLink = null;
		$buttonLink = $attributes['buttonLink'];

		if($attributes['populateCarouselUsing'] === 'postType') {
			// Get post type details
			$postType = get_post_type_object($attributes['postTypeOfPostsToDisplayAsCarouselItems']);
			$postTypeLink = get_post_type_archive_link($postType);
			$buttonLink = $postTypeLink;
		}

		if(!function_exists('displayItem')) {
			function displayItem($featuredImageCode, $title, $excerpt) {
				?>
				<div class="card me-4 h-100">
					<div class="slideCardBody">
						<?php echo $featuredImageCode; ?>
					</div>
					<div class="card-footer py-4 px-0">
						<h4 class="mb-0"><?php echo $title; ?></h4>
						<p><?php echo $excerpt; ?></p>
					</div>
				</div>
				<?php
			}
		}

		/* echo '<pre>';
		print_r($postType);
		echo '</pre>'; */
		?>
		<section class="slideMenu py-5 pobl-tech-carousel-block" id="<?php echo $attributes['carouselId']; ?>" data-pt-block-is-using-partial="false">
			<div class="container px-md-4 px-xl-5">
				<div class="row">
					<div class="col-12">
						<h2 class="mb-3 mb-md-4"><?php echo $attributes['heading']; ?></h2>
					</div>
				</div>
				<div class="row d-flex align-items-end">
					<div class="col-12 col-md-6">
						<p><?php echo $attributes['description']; ?></p>
					</div>
					<div class="col-12 col-md-6 d-flex justify-content-between justify-content-md-end mb-3">
						<a class="btn btn-outline-primary" href="<?php echo esc_url($buttonLink); ?>"><?php echo $attributes['buttonText']; ?></a>
						<div class="d-flex justify-content-end">
							<a id="<?php echo $attributes['carouselId']; ?>-slideLeft" class="btn btn-link" data-bs-target="#<?php echo $attributes['carouselId']; ?>" data-bs-slide="prev"><i class="fa-sharp fa-solid fa-arrow-left"></i></a>
							<a id="<?php echo $attributes['carouselId']; ?>-slideRight" class="btn btn-link" data-bs-target="#<?php echo $attributes['carouselId']; ?>" data-bs-slide="next"><i class="fa-sharp fa-solid fa-arrow-right"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="w-100 overflow-auto my-3 pb-4 pb-md-5 pobl-tech-carousel-block-slider">
			<div class="container px-md-4 px-xl-5">
				<div class="row">
					<div class="d-flex flex-row flex-nowrap">
						<?php
							$carouselItemsQuery = new WP_Query();
							if($attributes['populateCarouselUsing'] === 'postType') {
								$args = array(
									'post_type' => $attributes['postTypeOfPostsToDisplayAsCarouselItems'],
									'posts_per_page' => -1,
									'status' => 'publish'
								);

								if($attributes['postTypeOfPostsToDisplayAsCarouselItems'] === 'estyn_imp_resource') {
									$args['tax_query'] = [
										[
											'taxonomy' => 'improvement_resource_type',
											'field' => 'slug',
											'terms' => $attributes['chosenImprovementResourceType']
										]
									];
								}
								
								$carouselItemsQuery = new WP_Query($args);
							}

							if($carouselItemsQuery->have_posts()) : while($carouselItemsQuery->have_posts()) : $carouselItemsQuery->the_post();
						?>
						
						<?php displayItem(get_the_post_thumbnail(get_the_ID(), 'full'), get_the_title(), get_the_excerpt()); ?>

						<?php endwhile; else : ?>
							<?php
								/**
								 * IMPORTANT: The reason we do it this way
								 * instead of using WP_Query is because
								 * the user can choose to have duplicate slides/posts
								 * in the carousel. This is not possible with WP_Query
								 * as it will only return unique posts.
								 */
								$postIds = $attributes['postIdsOfPostsToDisplayAsCarouselItems'];

								foreach($postIds as $postId) {
									global $post;
									$post = get_post($postId);
									setup_postdata($post);
									displayItem(get_the_post_thumbnail($post, 'full'), get_the_title(), get_the_excerpt());

									wp_reset_postdata();
								}
							?>
						<?php endif; ?>
						<?php wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
			</div>
		</section>
		<?php

	}

	poblTechCarouselBlockRender($attributes);
} else {
	poblTechCarouselBlockRender($attributes);
}