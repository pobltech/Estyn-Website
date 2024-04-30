{{--

    DEV NOTES:

    You should pass the following variables to this partial/component:

    $carouselID: A unique ID for the carousel.
    IMPORTANT! This ID needs to be unique in case you use the carousel multiple times on the same page.

    $carouselHeading: The heading for the carousel.
    $carouselDescription: The description/text for the carousel.
    $carouselButtonText: The text for the 'All/More Posts/whatever' button.
    
    $carouselItems: An array of items/posts to be displayed in the carousel.
        featured_image_src: The URL of the featured image.
        title: The title of the item.
        excerpt: The excerpt of the item.
        [TODO: Alt tag for the image]
    

    
    $doNotDoJavaScript, $carouselSectionClass, $carouselSliderWrapperClass are optional.

    Info: Pobl Tech Carousel Block may pass 'true' as the value of $doNotDoJavaScript, 'pobl-tech-carousel-block' as the value of $carouselSectionClass,
    and 'pobl-tech-carousel-block-slider' as the value of $carouselSliderWrapperClass,
    to this partial so that it can retrieve (multiple instances of) the carousel and apply
    the JavaScript to make the carousel/s work.

 --}}
<section class="slideMenu {{ $carouselSectionClass ?? '' }}" id="{{ $carouselID }}">
	<div class="container px-md-4 px-xl-5">
        @if(isset($carouselHeading) && !empty($carouselHeading))
		<div class="row">
			<div class="col-12">
				<h2 class="mb-1 mb-md-1">{{ $carouselHeading }}</h2>
			</div>
		</div>
        @endif
		<div class="row d-flex align-items-end">
			<div class="col-12 col-md-6">
				<p>{{ $carouselDescription ?? '' }}</p>
			</div>
		    <div class="col-12 col-md-6 d-flex justify-content-between justify-content-md-end mb-2 mb-sm-3">
		    	<a class="btn btn-outline-primary rounded-3 me-sm-4">{{ $carouselButtonText }}</a>
		    	<div class="d-flex justify-content-end">
				    <a id="{{ $carouselID }}-slideLeft" class="btn btn-link pt-carousel-arrow d-flex flex-column justify-content-center"><i class="fa-sharp fa-solid fa-arrow-left"></i></a>
				    <a id="{{ $carouselID }}-slideRight" class="btn btn-link pe-0 pt-carousel-arrow d-flex flex-column justify-content-center"><i class="fa-sharp fa-solid fa-arrow-right"></i></a>
				  </div>
		    </div>
		</div>
	</div>
	<div class="{{ $carouselSliderWrapperClass ?? '' }} scrollCont w-100 overflow-auto" id="{{ $carouselID }}-scrollCont">
	  <div class="container px-md-4 px-xl-5">
	    <div class="row">
	        <div class="d-flex flex-row flex-nowrap">
                <?php foreach($carouselItems as $carouselItem) : ?>
                    <div class="card me-2 me-sm-4 h-100">
                        <div class="slideCardBody">
                            <img class="img-fluid" src="{{ $carouselItem['featured_image_src'] }}"/>
                        </div>
                        <div class="card-footer py-sm-4 pb-0 px-0">
                            <h4 class="mb-0">{{ $carouselItem['title'] }}</h4>
                            <p class="mb-0">{{ $carouselItem['excerpt'] }}</p>
                        </div>
                    </div>
                <?php endforeach; ?>
	        </div>
	    </div>
	  </div>
	</div>
</section>
@push('scripts')
    @if( (isset($doNotDoJavaScript)) && ($doNotDoJavaScript === false) )
        {{-- Include the JavaScript for the carousel --}}
        {{-- (If this partial was being used by the pobl-tech-carousel-block block then the block would do the JavaScript instead) --}}
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                //console.log('Initializing carousel with ID {{ $carouselID }}');

                const carouselID = "{{ $carouselID }}";
                const carouselSliderPartID = "{{ $carouselID }}-scrollCont";
                
                let carouselElement = document.getElementById(carouselID);
                let carouselSliderElement = document.getElementById(carouselSliderPartID);
                //const carousel = new Carousel(carouselElement);
                
                //console.log('Carousel with ID ' + carouselId + ' initialized');

                let buttonRight = carouselElement.querySelector('#' + carouselID + '-slideRight');
                let buttonLeft = carouselElement.querySelector('#' + carouselID + '-slideLeft');

                const scrollAmountDesktop = 500;
                const scrollAmountMobile = 200;

                let scrollAmount = scrollAmountDesktop;


                buttonRight.onclick = function () {
                    if(window.innerWidth < 576) {
                        scrollAmount = scrollAmountMobile;
                    } else {
                        scrollAmount = scrollAmountDesktop;
                    }

                    carouselSliderElement.scrollLeft += scrollAmount;
                };

                buttonLeft.onclick = function () {
                    if(window.innerWidth < 576) {
                        scrollAmount = scrollAmountMobile;
                    } else {
                        scrollAmount = scrollAmountDesktop;
                    }

                    carouselSliderElement.scrollLeft -= scrollAmount;
                };
            });
        </script>
    @else
        <script>
            //console.log('Carousel with ID {{ $carouselID }} not initialized because doNotDoJavaScript is true');
        </script>
    @endif
@endpush