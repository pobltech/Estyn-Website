<div class="mt-5 pt-5 mb-md-5 pb-md-5">
<section class="cta my-5 position-relative" id="{{ $elemUniqueID }}">
    <!-- Arc for larger screens -->
    <div class="listArc position-absolute w-100 d-none d-md-block">
        <svg width="1600" height="364" viewBox="0 0 1600 364" preserveAspectRatio="none">
        <path d=
        "M0,54.7C0,54.7,392,0,792,0s808,54.7,808,54.7v310H0V54.7z" 
        fill="#2A7AB0" />
        </svg>
    </div>
    <!-- Arc for smaller screens -->
    <div class="listArc position-absolute w-100 d-block d-md-none">
        <svg width="1600" height="182" viewBox="0 0 1600 364" preserveAspectRatio="none">
        <path d=
        "M0,54.7C0,54.7,392,0,792,0s808,54.7,808,54.7v310H0V54.7z" 
        fill="#2A7AB0" />
        </svg>
    </div>
    {{--<div class="ctaArcMapBGFiller position-absolute w-100 bg-blue"></div>--}}
    <div class="w-100 bg-blue pt-md-5 pb-md-5">
        <div class="container py-5 px-md-4 px-xl-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    @if(!empty($heading))
                        <div class="row">
                            <div class="col-12">
                                <h2 class="text-white mb-5">{{ $heading }}</h2>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    @foreach($listItems as $listItem)
                                        @php
                                            // We want the last word of the list item name to be contained within a span (with class no-wrap)
                                            // and next to it we want the arrow icon
                                            $listItemTitleParts = explode(' ', $listItem['title']);
                                            $listItemTitlePartsCount = count($listItemTitleParts);
                                            $listItemTitleLastWord = $listItemTitleParts[$listItemTitlePartsCount - 1];
                                            $listItemTitleParts[$listItemTitlePartsCount - 1] = '<span class="text-nowrap text-decoration-none">' . $listItemTitleLastWord . ' <i class="fa-sharp fa-regular fa-arrow-up-right text-decoration-none"></i></span>';
                                            $listItem['title'] = implode(' ', $listItemTitleParts);
                                        @endphp
                                        @if($loop->iteration > 12) {{-- Only show the first 12 items --}}
                                            </div> {{-- Close the previous row --}}
                                            @break
                                        @endif
                                        @if($loop->iteration == 1)
                                            <div class="row">
                                        {{-- If $loop->iteration is odd, start a new row --}}
                                        @elseif($loop->iteration % 2 == 1)
                                            </div> {{-- Close the previous row --}}
                                            <div class="row">
                                        @endif
                                                <div class="col-12 col-sm-6 {{ $loop->iteration != 12 ? 'mb-3 mb-sm-4' : 'mb-2 mb-sm-4' }}">
                                                    <span class="{{ $loop->iteration != 12 ? 'pb-2 border-bottom' : 'pb-sm-2 border-sm-bottom' }} d-block">
                                                        <a href="{{ $listItem['linkURL'] }}" class="ctaMapLink text-decoration-none">{!! $listItem['title'] !!}</a>
                                                    </span>
                                                </div>
                                        @if($loop->last)
                                            </div> {{-- Close the last row --}}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="row collapse" id="{{ $elemUniqueID }}-collapseSectors">
                                <div class="col-12">
                                    @foreach($listItems as $listItem)
                                        @php
                                            // We want the last word of the list item name to be contained within a span (with class no-wrap)
                                            // and next to it we want the arrow icon
                                            $listItemTitleParts = explode(' ', $listItem['title']);
                                            $listItemTitlePartsCount = count($listItemTitleParts);
                                            $listItemTitleLastWord = $listItemTitleParts[$listItemTitlePartsCount - 1];
                                            $listItemTitleParts[$listItemTitlePartsCount - 1] = '<span class="text-nowrap text-decoration-none">' . $listItemTitleLastWord . ' <i class="fa-sharp fa-regular fa-arrow-up-right text-decoration-none"></i></span>';
                                            $listItem['title'] = implode(' ', $listItemTitleParts);
                                        @endphp
                                        @if($loop->iteration < 13) {{-- Only show the 13th item onwards --}}
                                            @continue
                                        @endif
                                        @if($loop->iteration == 13)
                                            <div class="row">
                                        {{-- If $loop->iteration is odd, start a new row --}}
                                        @elseif($loop->iteration % 2 == 1)
                                            </div> {{-- Close the previous row --}}
                                            <div class="row">
                                        @endif
                                                <div class="col-12 col-sm-6 mb-3 mb-sm-4">
                                                    <span class="pb-2 {{ $loop->iteration == 13 ? 'pt-3 pt-sm-0 border-top border-top-sm-0' : '' }} {{ !$loop->last ? 'border-bottom' : 'border-sm-bottom' }} d-block">
                                                        <a href="{{ $listItem['linkURL'] }}" class="ctaMapLink text-decoration-none">{!! $listItem['title'] !!}</a>
                                                    </span>
                                                </div>
                                        @if($loop->last)
                                            </div> {{-- Close the last row --}}
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center mt-5">
                                    <a id="{{ $elemUniqueID }}-toggle-show-more" class="btn btn-outline-primary px-5 text-white bg-transparent-even-when-active border-white rounded-5 cta-toggle-more-less" data-bs-toggle="collapse" href="#{{ $elemUniqueID }}-collapseSectors" role="button" aria-expanded="false" aria-controls="{{ $elemUniqueID }}-collapseSectors">{{ __('See more') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            //console.log('Initialising list-inside-full-width-arc-container with ID {{ $elemUniqueID }}');
            const elemUniqueID = "{{ $elemUniqueID }}";
            const elemToggleShowMore = document.getElementById("{{ $elemUniqueID }}-toggle-show-more");
            const elemCollapseSectors = document.getElementById("{{ $elemUniqueID }}-collapseSectors");

            elemCollapseSectors.addEventListener('hidden.bs.collapse', event => {
                elemToggleShowMore.innerHTML = "{{ __('See more', 'sage') }}";
            });
            elemCollapseSectors.addEventListener('shown.bs.collapse', event => {
                elemToggleShowMore.innerHTML = "{{ __('See less', 'sage') }}";
            });
        });
    </script>
@endpush