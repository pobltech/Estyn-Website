<section class="signposting {{ $sectionClasses ?? '' }}">
	<div class="container pt-5 pb-md-5 px-md-4 px-xl-5">
		<div class="row">
			<div class="col-12">
                @if(isset($heading))
				<h2 class="mb-4">{{ $heading }}</h2>
                @endif
				<div class="row">
                    @foreach($signposts as $signpost)
                        <!-- SP Item -->
                        <div class="col-12 col-sm-6 col-xl-4 mb-4 position-relative">
                            @include('components.signpost', [
                                'bgColourClass' => $signpost['bgColourClass'] ?? null,
                                'bgColour' => $signpost['bgColour'] ?? null,
                                'iconClasses' => $signpost['iconClasses'] ?? null,
                                'svg' => $signpost['svg'] ?? null,
                                'title' => $signpost['title'] ?? null,
                                'description' => $signpost['description'] ?? null,
                                'linkURL' => $signpost['linkURL'] ?? null
                            ])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>