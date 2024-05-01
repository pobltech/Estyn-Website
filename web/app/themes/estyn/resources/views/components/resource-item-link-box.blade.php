<a href="{{ $linkURL }}" class="list-group-item list-group-item-action">
	@if(isset($dateOnRight))
		<div class="d-md-flex w-100 justify-content-between">
			<div>
				{{ $title }}
			</div>
			<div>
				@if(isset($superText))
					<span class="searchResourceDate me-2"><strong>{{ $superText }}</strong></span>
				@endif
				<span class="searchResourceDate">{{ $superDate }}</span>
			</div>
		</div>
	@else
		<div class="d-flex w-100 justify-content-start">
			<span class="searchResourceType me-2">{{ $superText }}</span>
			<span class="searchResourceDate me-2">{{ $superDate }}</span>
		</div>
		{{ $title }}
	@endif
</a>