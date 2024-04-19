<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<div class="break-out-of-containers">
	<div class="accordion accordion-flush <?php echo ($attributes['className'] ?? ''); ?>" id="<?php echo $attributes['accordionID']; ?>">
		<?php echo $content; ?>
	</div>
</div>