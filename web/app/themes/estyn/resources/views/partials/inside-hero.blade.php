<div class="insideHero">
	<div class="container h-100 d-flex align-items-end mb-5 pb-5 px-md-4 px-xl-5">
		<div class="row flex-fill">
			<div class="col-12 insideHeroContent">
				@if(isset($super))
					<span class="fs-5 d-block inside-hero-super">{{ $super }}</span>
				@endif
				@if(isset($sectors))
					@foreach($sectors as $sector)
						<span class="inside-hero-sector">{{ $sector->name }}</span>
					@endforeach
				@endif
				@if(isset($localAuthorities))
					@foreach($localAuthorities as $localAuthority)
						<span class="inside-hero-local-authority">{{ $localAuthority->name }}</span>
					@endforeach
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
		@if(isset($heroImageSrc))
			<img src="{{ $heroImageSrc }}" alt="{{ $heroImageAlt }}" />
		@elseif(isset($heroImageImgTag))
			{!! $heroImageImgTag !!}
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
<div class="insideIntro position-relative w-100">
	<div class="container px-md-4 px-xl-5">
		@if(isset($insideIntroLinks))
			<div class="row p-5">
				<div class="col-12 mb-5">
					<div class="d-flex justify-content-between">
						@foreach($insideIntroLinks as $link)
							@include('components.signpost', [
								'linkURL' => $link['url'],
								'bgColourClass' => $link['bgColourClass'],
								'iconClasses' => $link['iconClasses'],
								'title' => $link['title'],
								'description' => $link['description']
							])
						@endforeach
					</div>
				</div>
			</div>
		@else
			<div class="row justify justify-content-center">
				<div class="col-12 col-md-10 my-5">
					<div class="row">
						<div class="col-11 col-md-6 pb-5 pb-md-0 pe-xl-5 {{ isset($cropIntroImagePortrait) && $cropIntroImagePortrait == true ? 'pt-xl-5' : '' }}">
							<div class="{{ isset($cropIntroImagePortrait) && $cropIntroImagePortrait == true ? 'pt-xxl-5' : '' }}">
								<h2 class="pe-xl-5">{{ $secondHeading }}</h2>
								<div class="inside-intro-content">
									{!! $introContent !!}
									@if(isset($introLinks))
										<div class="row">
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
						<div class="col-12 col-md-6 ps-md-5">
							<div class="ps-lg-5">
								<div class="d-flex justify-content-center px-me-5 px-md-0">
									<div class="intro-image-container {{ isset($cropIntroImagePortrait) && $cropIntroImagePortrait == true ? 'crop-portrait' : '' }}">
										@if(isset($introImageSrc))
											<img src="{{ $introImageSrc }}" alt="{{ $introImageAlt }}" class="rounded-2 img-fluid" />
										@elseif(isset($introImageID))
											{!! wp_get_attachment_image($introImageID, 'full', false, ['class' => 'rounded-2 img-fluid']) !!}
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
</div>