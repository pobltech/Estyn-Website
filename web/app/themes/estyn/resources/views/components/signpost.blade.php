<div class="d-flex justify-content-start">
    <div class="sp-icon-cont d-flex justify-content-center align-items-center {{ $bgColourClass }}">
        @if(isset($svg))
            <img src="{{ $svg }}" alt="{{ $iconImageAlt ?? '' }}"/>
        @else
            <i class="{{ $iconClasses }}"></i>
        @endif
    </div>
    <div class="sp-text ms-3 mt-2">
        <a href="{{ $linkURL }}" class="stretched-link"><p class="sp-title m-0">{{ $title }}</p></a>
        <p class="sp-desc m-0">{{ $description }}</p>
    </div>
</div>