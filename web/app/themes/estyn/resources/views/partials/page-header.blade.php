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
              <div class="col-12 d-flex justify-content-between">
                <div class="d-flex justify-content-start align-items-center">
                    @include('partials.entry-meta')
                </div>
                <div>
                  @if(isset($shareLinkURL))
                    <a class="btn btn-outline-info" href="{{ $shareLinkURL }}">{{ __('Share this page', 'sage') }} <i class="fa-regular fa-arrow-up-from-square"></i></a>
                  @endif
                </div>
              </div>
              <div class="col-12">
                <hr class="hrGreen mt-3">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>