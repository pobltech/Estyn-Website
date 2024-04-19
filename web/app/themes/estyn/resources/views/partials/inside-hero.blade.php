<div class="insideHero">
	<div class="container h-100 d-flex align-items-end mb-5 pb-5 px-md-4 px-xl-5">
		<div class="row flex-fill">
			<div class="col-12 insideHeroContent">
				@if(isset($super))
					<span class="fs-5 d-block inside-hero-super">{{ $super }}</span>
				@endif
				<h1>{!! $title !!}</h1>
			</div>
		</div>
	</div>
	<div class="heroImage">
		<img src="{{ $heroImageSrc }}" alt="{{ $heroImageAlt }}" />
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
		<div class="row d-flex justify justify-content-center">
			<div class="col-12 col-md-10 my-5">
				<div class="row">
					<div class="col-12 col-md-6">
						<h2 class="mb-3 mb-md-4">{{ $secondHeading }}</h2>
                        <div class="inside-intro-content">
                            {!! $introContent !!}
                        </div>
					</div>
                    <div class="col-12 col-md-6">
                        <img src="{{ $introImageSrc }}" alt="{{ $introImageAlt }}" class="rounded-3 img-fluid" />
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>