{{--
	Template name: Search Page
 --}}
@extends('layouts.app')

@section('content')

<div class="searchHero mt-5">
	<div class="container px-md-4 px-xl-5">
		<div class="row">
			<div class="col-12">
				<h1 class="mb-4">{{ get_the_title() }}</h1>
			</div>
		</div>
	</div>
</div>
<section class="searchBody mb-5">
	<div class="container px-md-4 px-xl-5">
		<div class="row">
			<!-- Search filter -->
			<div class="searchFilter col-12 col-md-4">
				<div class="row">
					<div class="col-12 col-md-11">

						<div class="input-group mb-4">
						  <input type="text" class="form-control" placeholder="" aria-label="Search filter" aria-describedby="searchFilter">
						  <button class="btn btn-primary" type="button" id="searchFilter"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
						</div>

						<h3>Filters</h3>
						<div class="accordion accordion-flush" id="accordionFlushExample">
						  <div class="accordion-item">
						    <h2 class="accordion-header" id="flush-headingOne">
						      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
						        Sector
						      </button>
						    </h2>
						    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
						      <div class="accordion-body">
						      	<div class="form-check">
								  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
								  <label class="form-check-label" for="flexCheckDefault">
								    Default checkbox
								  </label>
								</div>
								<div class="form-check">
								  <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
								  <label class="form-check-label" for="flexCheckChecked">
								    Checked checkbox
								  </label>
								</div>
						      </div>
						    </div>
						  </div>
						  <div class="accordion-item">
						    <h2 class="accordion-header" id="flush-headingTwo">
						      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
						        Local authority
						      </button>
						    </h2>
						    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
						      <div class="accordion-body">Controls</div>
						    </div>
						  </div>
						  <div class="accordion-item">
						    <h2 class="accordion-header" id="flush-headingThree">
						      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
						        Tags
						      </button>
						    </h2>
						    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
						      <div class="accordion-body">Controls</div>
						    </div>
						  </div>
						</div>
					</div>
				</div>
			</div>
			<!-- Search Results -->
			<div class="searchResultsMain col-12 col-md-8">
				<div class="row">
					<div class="col-12">
						<div class="d-flex justify-content-between">
							<span>5181 results</span>
							<span>Order by</span>
						</div>
						<hr class="hrGreen my-3">
					</div>
					<div class="col-12">
						<div class="list-group list-group-flush resourceList">
							<a href="#" class="list-group-item list-group-item-action">
								<div class="d-flex w-100 justify-content-start">
									<span class="searchResourceType me-2">Effective practice</span>
									<span class="searchResourceDate me-2">24/01/2024</span>
								</div>
								Improving teaching through an emphasis on professional learning
							</a>
							<a href="#" class="list-group-item list-group-item-action">
								<div class="d-flex w-100 justify-content-start">
									<span class="searchResourceType me-2">Effective practice</span>
									<span class="searchResourceDate me-2">24/01/2024</span>
								</div>
								Improving attendance in secondary schools</a>
							<a href="#" class="list-group-item list-group-item-action">
								<div class="d-flex w-100 justify-content-start">
									<span class="searchResourceType me-2">Effective practice</span>
									<span class="searchResourceDate me-2">24/01/2024</span>
								</div>
								Improving attendance in secondary schools - training materials
							</a>
							<a href="#" class="list-group-item list-group-item-action">
								<div class="d-flex w-100 justify-content-start">
									<span class="searchResourceType me-2">Effective practice</span>
									<span class="searchResourceDate me-2">24/01/2024</span>
								</div>
								Developing early communication skills with predominantly pre verbal pupils
							</a>
							<a href="#" class="list-group-item list-group-item-action">
								<div class="d-flex w-100 justify-content-start">
									<span class="searchResourceType me-2">Effective practice</span>
									<span class="searchResourceDate me-2">24/01/2024</span>
								</div>
								Motivating pupils to speak Welsh
							</a>
							<a href="#" class="list-group-item list-group-item-action">
								<div class="d-flex w-100 justify-content-start">
									<span class="searchResourceType me-2">Effective practice</span>
									<span class="searchResourceDate me-2">24/01/2024</span>
								</div>
								Developing a programme to provide targeted support for vulnerable learners to improve their attendance
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
