<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>
<div class="accordion-item">
	<h2 class="accordion-header">
		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $attributes['itemID']; ?>" aria-expanded="false" aria-controls="<?php echo $attributes['itemID']; ?>">
			<?php echo $attributes['heading']; ?>
		</button>
	</h2>
	<div id="<?php echo $attributes['itemID']; ?>" class="accordion-collapse collapse" data-bs-parent="#<?php echo $attributes['parentID']; ?>">
		<div class="accordion-body">
			<?php echo $attributes['body']; ?>
		</div>
	</div>
</div>
