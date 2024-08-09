<div class="insideHero">
	<div class="container h-100 d-flex align-items-end mb-5 pb-5 px-md-4 px-xl-5">
		<div class="row flex-fill">
			<div class="col-12 insideHeroContent">
				@if(isset($super))
					<span class="fs-5 d-block inside-hero-super">{{ $super }}</span>
				@endif
				@if(isset($sectors) || isset($localAuthorities))
					<span class="inside-hero-la-andor-sectors-container mb-3 d-block mb-md-0">
						@if(isset($sectors))
							@foreach($sectors as $sector)
								<span class="inside-hero-sector">{{ $loop->index > 0 ? ', ' : '' }}{{ $sector->name }}</span>
							@endforeach
						@endif
						@if(isset($sectors) && isset($localAuthorities))
							<span class="inside-hero-la-and-sectors-separator"> - </span>
						@endif
						@if(isset($localAuthorities))
							@foreach($localAuthorities as $localAuthority)
								<span class="inside-hero-local-authority">{{ $loop->index > 0 ? ', ' : '' }}{{ $localAuthority->name }}</span>
							@endforeach
						@endif
					</span>
				@endif
				<h1>{!! $title !!}</h1>
				@if(isset($followUpStatusses))
					@foreach($followUpStatusses as $followUpStatus)
						<div class="d-flex me-3 align-items-center">
							<span class="rounded-circle me-2 bg-lightblue p-3 follow-up-status-circle"></span>
							<span class="follow-up-status">{{ $followUpStatus->name }}</span>
						</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>
	<div class="heroImage">
		@if(!empty($heroImageID))
			{!! wp_get_attachment_image($heroImageID, 'full', false, ['class' => 'img-fluid']) !!}
		@elseif(!empty($heroImageSrc))
			<img src="{{ $heroImageSrc }}" class="img-fluid" alt="{{ $heroImageAlt }}" />
		@elseif(!empty($heroImageImgTag))
			{!! $heroImageImgTag !!}
		@else
			<img src="@asset('images/' . ESTYN_DEFAULT_HERO_IMAGE_FILENAME)" class="img-fluid" alt="{{ __('Estyn logo on a blue background', 'sage') }}" />
		@endif
	</div>
	<div class="heroOverlay"></div>
</div>
<!-- Arc for larger screens -->
<div class="insideIntroArc position-relative w-100 d-none d-md-block">
	<svg width="1600" height="71" viewBox="0 0 1600 71" preserveAspectRatio="none">
	  <path d=
	  "M0,54.7C0,54.7,392,0,792,0s808,54.7,808,54.7v16.4H0V54.7z" 
	  fill="#DCEEFE" />
	</svg>
</div>
<!-- Arc for smaller screens -->
<div class="insideIntroArc position-relative w-100 d-block d-md-none">
	<svg width="1600" height="35" viewBox="0 0 1600 71" preserveAspectRatio="none">
	  <path d=
	  "M0,54.7C0,54.7,392,0,792,0s808,54.7,808,54.7v16.4H0V54.7z" 
	  fill="#DCEEFE" />
	</svg>
</div>
<div class="insideIntro pt-4 pt-sm-5 pb-5 pb-md-0 position-relative w-100">
	<div class="container pb-md-5 px-md-4 px-xl-5">
		@if(isset($insideIntroLinks))
			<div class="row py-4 py-lg-5 px-xl-5 justify-content-center">
				@foreach($insideIntroLinks as $link)
					<div class="col-12 col-md-auto {{ $loop->index > 0 ? 'mt-3 mt-md-0' : '' }}">
						@include('components.signpost', [
							'linkURL' => $link['url'],
							'bgColourClass' => $link['bgColourClass'],
							'iconClasses' => $link['iconClasses'],
							'title' => $link['title'],
							'description' => $link['description']
						])
					</div>
				@endforeach
			</div>
		@else
			<div class="row justify justify-content-center">
				<div class="col-12 col-sm-5 mb-4 mb-sm-0 {{ isset($cropIntroImagePortrait) && $cropIntroImagePortrait == true ? '' : '' }}">
					<div class="d-flex flex-column h-100 justify-content-center">
						<div>
							<h2>{{ $secondHeading }}</h2>
							<div class="inside-intro-content">
								{!! $introContent !!}
								@if(!empty($introLinks))
									<div class="row gy-3">
									@foreach($introLinks as $introLink)
										<div class="col-12">
											<a class="btn btn-outline-primary" href="{{ $introLink['url'] }}">{{ $introLink['text'] }}</a>
										</div>
									@endforeach
									</div>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-sm-auto col-md-4 offset-md-1">
					<div class="d-flex h-100 flex-sm-column justify-content-center">
						<div class="intro-image-container {{ isset($cropIntroImagePortrait) && $cropIntroImagePortrait == true ? 'crop-portrait' : '' }}">
							@if(!empty($introImageID))
								{!! wp_get_attachment_image($introImageID, 'full', false, ['class' => 'rounded-2 img-fluid']) !!}
							@elseif(!empty($introImageSrc))
								<img src="{{ $introImageSrc }}" alt="{{ $introImageAlt }}" class="rounded-2 img-fluid" />
							@elseif(!empty($introImageImgTag))
								{!! $introImageImgTag !!}					
							@endif
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
</div>