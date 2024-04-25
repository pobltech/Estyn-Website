<div class="d-flex justify-content-start">
    <div class="sp-icon-cont d-flex flex-shrink-0 justify-content-center align-items-center {{ $bgColourClass }}">
        @if(isset($svg))
            <img src="{{ $svg }}" alt="{{ $iconImageAlt ?? '' }}"/>
        @else
            <i class="{{ $iconClasses }}"></i>
        @endif
    </div>
    <div class="sp-text ms-3 d-flex flex-column justify-content-center">
        <a href="{{ $linkURL }}" class="stretched-link">
            <p class="sp-title m-0">{{ $title }}</p>
            <p class="sp-desc m-0">{{ $description }}</p>
        </a>
    </div>
    @if(isset($arrow) && $arrow)
        <div class="d-none d-xl-flex flex-column justify-content-center ms-5">
            <i class="fa-sharp fa-regular fa-arrow-up-right" aria-hidden="true"></i>
        </div>
    @endif
</div>

