<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<?php if(!empty($attributes['fullWidthSection'])) : ?>
<div class="break-out-of-containers pb-5 mt-5">
	<div class="w-100 bg-blue pt-md-5 pb-md-5">
		<div class="container py-5 px-md-4 px-xl-5">
			<div class="row justify-content-center">
				<div class="col-12 col-md-10 col-lg-8">
<?php endif; ?>
					<?php
						if(!empty($attributes['accordionHeading'])) :
					?>
					<div class="row pt-5">
						<div class="col-12">
							<h2 class="<?php echo (!empty($attributes['fullWidthSection'])) ? 'text-white' : ''; ?>  mb-3"><?php echo $attributes['accordionHeading']; ?></h2>
						</div>
					</div>
					<?php endif; ?>
					<div class="row mb-3 mb-md-5 justify-content-center">
						<div class="col-12">
							<div class="accordion accordion-flush <?php echo ($attributes['className'] ?? ''); ?>" id="<?php echo $attributes['accordionID']; ?>">
								<?php echo $content; ?>
							</div>
						</div>
					</div>
<?php if(!empty($attributes['fullWidthSection'])) : ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>