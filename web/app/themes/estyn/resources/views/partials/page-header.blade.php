  <header>
    <div class="reportHero mt-5">
      <div class="container px-md-4 px-xl-5">
        <div class="row d-flex justify-content-center">
          @if(isset($fullWidth) && $fullWidth)
            <div class="col-12">
          @else
            <div class="col-12 col-lg-10 col-xl-8">
          @endif
            <div class="row">
              <div class="col-12">
                <h1 class="p-name mb-4">{!! $title !!}</h1>
              </div>
              <div class="col-12 d-flex justify-content-sm-between">
                <div class="d-flex justify-content-start align-items-center">
                    @include('partials.entry-meta')
                </div>
                <div class="pt-share-button-container">
                  @if(isset($shareLinkURL))
                    <a class="btn btn-outline-info" href="{{ $shareLinkURL }}"><span class="d-none d-sm-inline">{{ __('Share this page', 'sage') }} </span><i class="fa-regular fa-arrow-up-from-square"></i></a>
                  @endif
                </div>
              </div>
            </div>
            @if(isset($extraButtons))
              <hr class="my-4">
              <div class="row">
                <div class="col-12">
                  <div class="d-flex">
                    @foreach($extraButtons as $button)
                      <a href="{{ $button['url'] }}" class="btn btn-outline-info me-3">
                        <span>{{ $button['text'] }}</span>
                        <i class="{{ $button['iconClasses'] }}"></i>
                      </a>
                    @endforeach
                  </div>
                </div>
              </div>
            @endif
            @if(isset($providerDetails))
              <hr class="my-4">
              <div class="row">
                <div class="col-12">
                  <div class="d-flex">
                      @if(isset($providerDetails['icon_image']))
                        <img src="{{ $providerDetails['icon_image']['url'] }}" alt="{{ $providerDetails['icon_image']['alt'] }}" class="img-fluid rounded-circle me-3 border resource-creator-circle-image">
                      @endif
                      <div class="d-flex flex-column justify-content-center">
                        <span class="d-block"><strong>{{ $providerDetails['name'] }}</strong></span>
                        @if(isset($providerDetails['number_of_pupils']) || isset($providerDetails['age_range']))
                          <span class="d-block">
                            @if(isset($providerDetails['number_of_pupils']))
                              <span class="d-inline-block me-3">{{ __('Number of pupils', 'sage') . ': ' . $providerDetails['number_of_pupils'] }}</span>
                            @endif
                            @if(isset($providerDetails['age_range']))
                              <span>{{ __('Age range', 'sage') . ': ' . $providerDetails['age_range'] }}</span>
                            @endif
                          </span>
                        @endif
                      </div>
                  </div>
                </div>
              </div>
            @endif
            <div class="row">
              <div class="col-12">
                <hr class="hrGreen">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>