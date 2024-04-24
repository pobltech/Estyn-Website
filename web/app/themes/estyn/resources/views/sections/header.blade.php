<header class="banner sticky-top">
{{--   <a class="brand" href="{{ home_url('/') }}">
    {!! $siteName !!}
  </a> --}}
<nav class="navbar navbar-expand-xl navbar-light bg-white">
  <div class="container my-2 my-sm-3 px-3 px-sm-4 px-xl-5">
    <a class="navbar-brand order-xl-1" href="{{ home_url('/') }}"><img src="@asset('images/estyn-logo.svg')" alt="{!! $siteName !!}" width="138"/></a>
    <div class="collapse navbar-collapse order-3 order-xl-2" id="navbarNavDropdown">
		<hr class="p-0 m-0 w-100 d-block d-xl-none">
      <ul class="navbar-nav ms-auto mt-5 mt-xl-0">
        <!-- Parents Carers and learners -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarProfessionalDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          	<span class="nav-item-sub">Estyn for</span>
            <span class="nav-item-main">Parents, carers & learners</span>
          </a>
          <div class="megaMenu dropdown-menu w-100 bg-white">
          	<div class="container my-4">
          		<div class="row d-flex justify-content-center">
          			<div class="col-12 col-md-8">
          				<h3 class="mb-4">Parents, carers & learners</h3>
          				<div class="row">
          					<div class="col-6 megaMenuFeature">
          						<div class="row">
												<div class="col-12 mb-4 position-relative">
													@include('components.signpost', [
														'bgColourClass' => 'bg-signpost-lightpink2',
														'iconClasses' => 'fa-solid fa-magnifying-glass',
														'title' => __('Provider search', 'sage'),
														'description' => __('Find an education & training provider', 'sage'),
														'linkURL' => 'https://www.google.co.uk'
													])
												</div>
												<div class="col-12 mb-4 position-relative">
													@include('components.signpost', [
														'bgColourClass' => 'bg-signpost-green2',
														'iconClasses' => 'fa-solid fa-location-dot',
														'title' => __('Provider map', 'sage'),
														'description' => __('Find an education & training provider', 'sage'),
														'linkURL' => 'https://www.google.co.uk'
													])
												</div>
											</div>
					        	</div>
						        <div class="col-6 megaMenuMain">
						        	<div class="row">
						        		<div class="col-10 offset-2">
								          <ul aria-labelledby="navbarProfessionalDropdownMenuLink">
								            <li><a href="https://google.co.uk">{{ __('What Estyn does', 'sage') }}</a></li>
								            <li><a href="#">{{ __('Parents and carers community', 'sage') }}</a></li>
								            <li><a href="#">{{ __('What happens during an inspection?', 'sage') }}</a></li>
											<li><a href="#">{{ __('How do I contact Estyn?', 'sage') }}</a></li>
								          </ul>	
								        </div>
								      </div>
						      	</div>
					    		</div>
			      		</div>
			    		</div>
						</div>
      		</div>
        </li>
        <!-- Education Proffessionals -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarProfessionalDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          	<span class="nav-item-sub">Estyn for</span>
            <span class="nav-item-main">Education professionals</span>
          </a>
          <div class="megaMenu dropdown-menu w-100 bg-white">
          	<div class="container my-4">
          		<div class="row d-flex justify-content-center">
          			<div class="col-12 col-md-8">
          				<h3 class="mb-4">Educational professionals</h3>
          				<div class="row">
          					<div class="col-6 megaMenuFeature">
          						<div class="row">
												<div class="col-12 mb-4 position-relative">
													@include('components.signpost', [
														'bgColourClass' => 'bg-signpost-lightpink2',
														'iconClasses' => 'fa-solid fa-file',
														'title' => __('Improvement Resources', 'sage'),
														'description' => __('Resources to help providers improve', 'sage'),
														'linkURL' => 'https://www.google.co.uk'
													])
												</div>
												<div class="col-12 mb-4 position-relative">
													@include('components.signpost', [
														'bgColourClass' => 'bg-signpost-green2',
														'iconClasses' => 'fa-solid fa-folder-open',
														'title' => __('Inspection reports', 'sage'),
														'description' => __('Search for an inspection report', 'sage'),
														'linkURL' => 'https://www.google.co.uk'
													])
												</div>
											</div>
					        	</div>
						        <div class="col-6 megaMenuMain">
						        	<div class="row">
						        		<div class="col-10 offset-2">
								          <ul aria-labelledby="navbarProfessionalDropdownMenuLink">
								            <li><a href="https://google.co.uk">Action</a></li>
								            <li><a href="#">Another action</a></li>
								            <li><a href="#">Something else here</a></li>
								          </ul>	
								        </div>
								      </div>
						      	</div>
					    		</div>
					    		<hr class="hrnav">
							    <div class="row">
							    	<div class="col-12">
							    		<h4 class="mb-3">Find my sector</h4>


												<div class="row">
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													
												</div>


							    	</div>
							    </div>
			      		</div>
			    		</div>
						</div>
      		</div>
        </li>
        <!-- About -->
        <li class="nav-item nav-item-no-border dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarProfessionalDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          	<span class="nav-item-sub">Who we are</span>
            <span class="nav-item-main">About Estyn</span>
          </a>
          <div class="megaMenu dropdown-menu w-100 bg-white">
          	<div class="container my-4">
          		<div class="row d-flex justify-content-center">
          			<div class="col-12 col-md-8">
          				<h3 class="mb-4">About Estyn</h3>
          				<div class="row">
          					<div class="col-6 megaMenuFeature">
          						<div class="row">
												<div class="col-12 mb-4 position-relative">
													@include('components.signpost', [
														'bgColourClass' => 'bg-signpost-lightpink2',
														'svg' => asset('images/estyn-logo-icon-only-darkblue.svg'),
														'title' => __('About Estyn', 'sage'),
														'description' => __('Who we are and what we do', 'sage'),
														'linkURL' => 'https://www.google.co.uk'
													])
												</div>
												<div class="col-12 mb-4 position-relative">
													@include('components.signpost', [
														'bgColourClass' => 'bg-signpost-green2',
														'iconClasses' => 'fa-solid fa-users-rectangle',
														'title' => __('Who\'s who', 'sage'),
														'description' => __('Meet the team', 'sage'),
														'linkURL' => 'https://www.google.co.uk'
													])
												</div>
											</div>
					        	</div>
						        <div class="col-6 megaMenuMain">
						        	<div class="row">
						        		<div class="col-10 offset-2">
								          <ul aria-labelledby="navbarProfessionalDropdownMenuLink">
								            <li><a href="https://google.co.uk">Action</a></li>
								            <li><a href="#">Another action</a></li>
								            <li><a href="#">Something else here</a></li>
								          </ul>	
								        </div>
								      </div>
						      	</div>
					    		</div>
			      		</div>
			    		</div>
						</div>
      		</div>
        </li>{{--
        <!-- Language -->
        <li class="nav-item nav-language d-flex flex-column justify-content-center">
          <a class="nav-link" href="#">Cymraeg</a>
        </li>
        <!-- Search -->
        <li class="nav-item d-flex flex-column justify-content-center nav-search dropdown">
          <a class="nav-link pe-0" href="#" id="navbarSearchDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></a>
          <div class="megaMenu dropdown-menu w-100 bg-white">
          	<div class="container my-4">
          		<div class="row d-flex justify-content-center">
          			<div class="col-12 col-md-8">
          				<div class="row">
          					<div class="col-6 megaMenuFeature">
          						<div class="row">
          							<div class="col-10">
		          						<h3 class="mb-4">Search Estyn</h3>
		          						<div class="input-group mb-3">
													  <input type="text" class="form-control" placeholder="" aria-label="estynSearch" aria-describedby="estynSearch">
													  <button class="btn btn-primary" type="button" id="estynSearch"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
													</div>
												</div>
											</div>
					        	</div>
						        <div class="col-6 megaMenuMain">
						        	<div class="row">
						        		<div class="col-10 offset-2">
						        			<h3 class="mb-4">Popular</h3>
								          <ul aria-labelledby="navbarProfessionalDropdownMenuLink">
								            <li><a href="https://google.co.uk">Action</a></li>
								            <li><a href="#">Another action</a></li>
								            <li><a href="#">Something else here</a></li>
								          </ul>	
								        </div>
								      </div>
						      	</div>
					    		</div>
          			</div>
          		</div>
          	</div>
          </div>
        </li> --}}
      </ul>
    </div>
	<div class="d-flex flex-row justify-content-end order-2 order-xl-3">
		<ul class="d-flex flex-row navbar-nav">
			<!-- Language -->
			<li class="nav-item nav-language d-flex flex-column justify-content-center">
			<a class="nav-link" href="#">Cymraeg</a>
			</li>
			<!-- Search -->
			<li class="nav-item d-flex flex-column justify-content-center nav-search dropdown">
			<a class="nav-link ps-0 ps-xl-4 pe-5 pe-xl-0" href="#" id="navbarSearchDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></a>
			<div class="megaMenu dropdown-menu w-100 bg-white">
				<div class="container my-4">
					<div class="row d-flex justify-content-center">
						<div class="col-12 col-md-8">
							<div class="row">
								<div class="col-6 megaMenuFeature">
									<div class="row">
										<div class="col-10">
											<h3 class="mb-4">Search Estyn</h3>
											<div class="input-group mb-3">
														<input type="text" class="form-control" placeholder="" aria-label="estynSearch" aria-describedby="estynSearch">
														<button class="btn btn-primary" type="button" id="estynSearch"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
														</div>
													</div>
												</div>
									</div>
									<div class="col-6 megaMenuMain">
										<div class="row">
											<div class="col-10 offset-2">
												<h3 class="mb-4">Popular</h3>
											<ul aria-labelledby="navbarProfessionalDropdownMenuLink">
												<li><a href="https://google.co.uk">Action</a></li>
												<li><a href="#">Another action</a></li>
												<li><a href="#">Something else here</a></li>
											</ul>	
											</div>
										</div>
									</div>
									</div>
						</div>
					</div>
				</div>
			</div>
		</li>
		</ul>
		<button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
	</div>
  </div>
</nav>
</header>
