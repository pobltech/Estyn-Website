  <header>
    <div class="reportHero mt-5">
      <div class="container px-md-4 px-xl-5">
        <div class="row d-flex justify-content-center">
          @if(isset($fullWidth) && $fullWidth)
            <div class="col-12">
          @else
            <div class="col-12 col-lg-10 col-xl-8">
          @endif
              @if(isset($showProviderSearch) && $showProviderSearch)
              <div class="row justify-content-md-between">
              <div class="col-12 col-md-auto">
                <h1 class="p-name mb-4">{!! $title !!}</h1>
              </div>
                <div class="col-12 col-md-4">
                  <span class="d-block"> {{ __('Find a provider', 'sage') }}</span>
										<div class="estyn-search-container input-group mb-3 rounded">
                      @include('components.search-modal', [
                        'modalID' => 'estyn-page-header-search-results-modal',
                        'postType' => 'estyn_eduprovider',
                        'language' => pll_current_language(),
                        'heading' => __('Find a provider', 'sage')
                      ])
                      {{--<div class="modal estyn-search-results-modal" tabindex="-1" id="estyn-page-header-search-results-modal">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">{{ __('Search results', 'sage') }}</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close', 'sage') }}"></button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col">
                                  <ul class="estyn-search-results-list list-group list-group-flush">
                                  
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>--}}
											<input type="text" data-modal-id="estyn-page-header-search-results-modal" list="page-header-provider-search-datalist-options" class="estyn-search-box form-control" data-posttype="estyn_eduprovider" placeholder="{{ __('Primary schools', 'sage') }}" aria-label="{{ __('Primary schools', 'sage') }}" aria-describedby="button-addon2">
											<button class="estyn-search-box-button estyn-provider-search-button btn btn-primary" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                      <datalist class="search-datalist" id="page-header-provider-search-datalist-options">

                      </datalist>
										</div>
                </div>
              @else
              <div class="row">
              <div class="col-12">
                <h1 class="p-name mb-4">{!! $title !!}</h1>
              </div>
              <div class="col-12 d-flex justify-content-sm-between">
                <div class="d-flex justify-content-start align-items-center">
                    @include('partials.entry-meta')
                </div>
                <div class="pt-share-button-container">
                  @if(!empty($shareLinkURL))
                    <a class="btn btn-outline-info" href="{{ $shareLinkURL }}"><span class="d-none d-sm-inline">{{ __('Share this page', 'sage') }} </span><i class="fa-regular fa-arrow-up-from-square"></i></a>
                  @endif
                  @if(!empty($showShareButton))
                    {{-- AddToAny Share Buttons --}}
                    {!! ADDTOANY_SHARE_SAVE_KIT() !!}
                  @endif
                </div>
              </div>
              @endif
            </div>
            @if( (!empty($extraButtons)) || (!empty($dropdownButtons)) )
              <hr class="my-4">
              <div class="row">
                <div class="col-12">
                  <div class="d-flex">
                    @if(!empty($extraButtons))
                      @foreach($extraButtons as $button)
                        <a href="{{ $button['url'] }}" class="btn btn-outline-info me-3">
                          <span>{{ $button['text'] }}</span>
                          <i class="{{ $button['iconClasses'] }}"></i>
                        </a>
                      @endforeach
                    @endif
                    @if(!empty($dropdownButtons))
                      @foreach($dropdownButtons as $button)
                        <div class="dropdown">
                          <button class="btn btn-outline-info me-3 dropdown-toggle" type="button" id="resourceDropdownMenuButton-{{ $loop->iteration }}" data-bs-toggle="dropdown" aria-expanded="false">
                            <span>{{ $button['buttonLabel'] }}</span>
                            {{--<i class="{{ $button['iconClasses'] }}"></i>--}}
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="resourceDropdownMenuButton-{{ $loop->iteration }}">
                            @foreach($button['items'] as $item)
                              <li><a class="dropdown-item" href="{{ $item['url'] }}">{{ $item['title'] }}</a></li>
                            @endforeach
                          </ul>
                        </div>
                      @endforeach
                    @endif
                  </div>
                </div>
              </div>
            @endif
            @if(isset($providerDetails))
              <hr class="my-4">
              <div class="row">
                <div class="col-12">
                  <div class="d-flex resource-creator">
                      @if(isset($providerDetails['icon_image']))
                        <img src="{{ $providerDetails['icon_image']['url'] }}" alt="{{ $providerDetails['icon_image']['alt'] }}" class="img-fluid rounded-circle me-3 border resource-creator-circle-image">
                      @endif
                      <div class="d-flex flex-column justify-content-center">
                        <span class="d-block"><strong>{{ $providerDetails['name'] }}</strong></span>
                        @if(isset($providerDetails['number_of_pupils']) || isset($providerDetails['age_range']))
                          <span class="d-block">
                            @if(isset($providerDetails['number_of_pupils']))
                              <span class="d-inline-block me-2 me-md-3">{{ __('Number of pupils', 'sage') . ': ' . $providerDetails['number_of_pupils'] }}</span>
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