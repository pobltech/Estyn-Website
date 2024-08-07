@php
    if(empty($modalID)) {
        $modalID = 'estyn-search-results-modal-' . uniqid();
    }

    $isProviderSearch = (!empty($postType)) && $postType === 'estyn_eduprovider';
@endphp
<div class="estyn-search-container">
<div class="modal estyn-search-results-modal" tabindex="-1" id="{{ $modalID }}">
    <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
        <div class="modal-header">
        {{--<h5 class="modal-title">{{ __('Search results', 'sage') }}</h5>--}}
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close', 'sage') }}"></button>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col">
            <h3 class="mb-3">{{ $heading }}</h3>
            <div class="input-group mb-4">
                <input type="text" list="{{ $modalID }}-datalist-options" class="estyn-search-box form-control" {{ !empty($postType) ? 'data-posttype="' . $postType . '"' : '' }} data-language="{{ empty($language) ? pll_current_language() : $language }}" placeholder="" aria-label="{{ __('Search box') }}">
                <button class="estyn-search-box-button {{ $isProviderSearch ? 'estyn-provider-search-button estyn-provider-search-mobile-modal-button' : 'estyn-search-mobile-modal-button' }}  btn btn-secondary" type="button" aria-label="{{ __('Search button') }}"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                <datalist class="search-datalist" id="{{ $modalID }}-datalist-options">

                </datalist>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
            <ul class="estyn-search-results-list list-group list-group-flush">
                {{-- Search results will be added here. The JS should be in the footer. --}}
            </ul>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
</div>