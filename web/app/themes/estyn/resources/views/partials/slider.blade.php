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
    

    
    $doNotDoJavaScript, $carouselSectionClass, $carouselSliderWrapperClass are optional.

    Info: Pobl Tech Carousel Block may pass 'true' as the value of $doNotDoJavaScript, 'pobl-tech-carousel-block' as the value of $carouselSectionClass,
    and 'pobl-tech-carousel-block-slider' as the value of $carouselSliderWrapperClass,
    to this partial so that it can retrieve (multiple instances of) the carousel and apply
    the JavaScript to make the carousel/s work.

 --}}
<section class="slideMenu {{ $carouselSectionClass ?? '' }}" id="{{ $carouselID }}">
	<div class="container px-md-4 px-xl-5 mb-4">
        @if(isset($carouselHeading) && !empty($carouselHeading))
		<div class="row">
			<div class="col-12">
                @if(isset($carouselDescription) && !empty($carouselDescription))
                    @if(isset($carouselHeadingNumber) && !empty($carouselHeadingNumber))
                        <h{{ $carouselHeadingNumber }} class="mb-2 mb-sm-3">{{ $carouselHeading }}</h{{ $carouselHeadingNumber }}>
                    @else
                        <h2 class="mb-2 mb-sm-3">{{ $carouselHeading }}</h2>
                    @endif
                @endif
			</div>
		</div>
        @endif
        @if(isset($carouselLeftButtons) && !empty($carouselLeftButtons))
		    <div class="d-flex justify-content-between align-items-sm-center">
            <div>
        @else
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center">
            <div class="mb-4 mb-sm-0">
        @endif
                @if(isset($carouselDescription) && !empty($carouselDescription))
				    <p class="mb-0">{{ $carouselDescription }}</p>
                @else
                    @if(!empty($carouselHeadingNumber))
                        <h{{ $carouselHeadingNumber }} class="mb-2 mb-sm-3">{{ $carouselHeading }}</h{{ $carouselHeadingNumber }}>
                    @else
                        <h2 class="mb-0">{{ $carouselHeading }}</h2>
                    @endif
                @endif
                @if(isset($carouselLeftButtons) && !empty($carouselLeftButtons))
                    @foreach($carouselLeftButtons as $carouselLeftButton)
                        <a class="d-inline-block btn btn-outline-primary {{ (!empty($dynamicFiltering)) ? 'dynamic-filter-button' : '' }} {{ $loop->iteration > 1 ? 'ms-sm-4' : '' }}" href="{{ $carouselLeftButton['link'] }}" {!! (!empty($dynamicFiltering)) ? 'data-filter-term-id="' . $carouselLeftButton['id'] . '"' . ' data-filter-term-slug="' . $carouselLeftButton['slug'] . '"' : '' !!}>{{ $carouselLeftButton['text'] }}</a>
                    @endforeach
                @endif
			</div>
		    <div class="d-flex justify-content-between justify-content-md-end">
                @if(isset($carouselButtonText) && !empty($carouselButtonText))
		    	    <a class="btn btn-outline-primary rounded-pill me-sm-4" href="{{ $carouselButtonLink ?? '#' }}">{{ $carouselButtonText }}</a>
                @endif
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
	        <div class="slider-carousel-items-container d-flex flex-row flex-nowrap">
                <?php foreach($carouselItems as $carouselItem) : ?>
                    <div class="slider-carousel-item card me-2 me-sm-4 h-100" {!! (!empty($carouselItem['team_member_category_term'])) ? 'data-team-member-category-id="' . ((!empty($carouselItem['team_member_category_term'])) ? $carouselItem['team_member_category_term']->term_id : '-1') . '"' : '' !!}>
                        @if(!empty($carouselItem['tag']))
                            <div class="carousel-item-tag text-white px-2 py-1">{{ $carouselItem['tag'] }}</div>
                        @endif
                        <div class="slideCardBody">
                            @if(!empty($carouselItem['featured_image_ID']))
                                {!! wp_get_attachment_image($carouselItem['featured_image_ID'], 'full', false, ['class' => 'img-fluid']) !!}
                            @else
                                <img class="img-fluid" src="{{ $carouselItem['featured_image_src'] }}" alt="{{ $carouselItem['featured_image_alt'] ?? '' }}" />
                            @endif
                        </div>
                        <div class="card-footer py-sm-4 pb-0 px-0">
                            @if( (!empty($carouselItem['date'])) || (!empty($carouselItem['formatted_date'])) )
                                <p class="slider-item-date mb-0">{{ empty($carouselItem['formatted_date']) ? ((\App\estynFormatDate($carouselItem['date']))) : $carouselItem['formatted_date'] }}</p>
                            @endif
                            @if(!empty($carouselItem['link']))
                            <a class="stretched-link" href="{{ $carouselItem['link'] ?? '#' }}"><h4 class="mb-0 {{ !empty($carouselItem['excerpt']) ? 'mb-2' : '' }}">{{ html_entity_decode($carouselItem['title'], ENT_QUOTES, 'UTF-8') }}</h4></a>
                            @elseif(!empty($carouselItem['title']))
                            <h4 class="mb-0 {{ !empty($carouselItem['excerpt']) ? 'mb-2' : '' }}">{{ html_entity_decode($carouselItem['title'], ENT_QUOTES, 'UTF-8') }}</h4>
                            @endif
                            @if(!empty($carouselItem['excerpt']))
                                <p class="mb-0 carousel-item-excerpt">{{ wp_strip_all_tags($carouselItem['excerpt']) }}</p>
                            @endif
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
                //let carousel = null;
                //console.log('Carousel with ID ' + carouselId + ' initialized');

                //const allCarouselItems = carouselElement.querySelectorAll('.slider-carousel-item');
                //let currentCarouselItems = allCarouselItems;

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

                // If there are elements with class 'dynamic-filter-button' then add event listeners to them
                let dynamicFilterButtons = carouselElement.querySelectorAll('.dynamic-filter-button');

                dynamicFilterButtons.forEach(function(button) {
                    button.onclick = function(event) {
                        // Prevent default
                        event.preventDefault();

                        //console.log('Dynamic filter button clicked');

                        carouselSliderElement.scrollLeft = 0;

                        dynamicFilterCarouselItems(button.getAttribute('data-filter-term-id'));
                    };
                });

                function fadeOutEffect(element) {
                    var fadeEffect = setInterval(function () {
                        if (!element.style.opacity) {
                            element.style.opacity = 1;
                        }
                        if (element.style.opacity > 0) {
                            element.style.opacity -= 0.1;
                        } else {
                            clearInterval(fadeEffect);
                            element.style.display = 'none';
                        }
                    }, 50); // Adjust the interval to control the speed of the fade-out
                }

                function fadeInEffect(element) {
                    var fadeEffect = setInterval(function () {
                        if (!element.style.opacity) {
                            element.style.opacity = 0;
                        }

                        element.style.display = 'block';

                        if (element.style.opacity < 1) {
                            element.style.opacity = parseFloat(element.style.opacity) + 0.1;
                        } else {
                            clearInterval(fadeEffect);
                        }
                    }, 50); // Adjust the interval to control the speed of the fade-in
                }

                function dynamicFilterCarouselItems(filterTermID) {
                    //console.log('Filtering carousel items by term: ' + filterTermID);

                    carouselElement.querySelectorAll('.slider-carousel-item').forEach(function(item) {
                        let itemTermID = item.getAttribute('data-team-member-category-id');

                        if(itemTermID !== filterTermID) {
                            fadeOutEffect(item);
                        } else {
                            fadeInEffect(item);
                        }
                    });


                    /*carouselElement.querySelectorAll('.slider-carousel-item').forEach(function(item) {
                        item.remove();
                    });

                    currentCarouselItems = [];

                    allCarouselItems.forEach(function(item) {
                        let itemTermID = item.getAttribute('data-team-member-category-id');

                        if(itemTermID === filterTermID) {
                            currentCarouselItems.push(item);
                        }
                    });

                    currentCarouselItems.forEach(function(item) {
                        carouselElement.querySelector('.slider-carousel-items-container').appendChild(item);
                    });*/               
                }
            });
        </script>
    @else
        <script>
            //console.log('Carousel with ID {{ $carouselID }} not initialized because doNotDoJavaScript is true');
        </script>
    @endif
@endpush