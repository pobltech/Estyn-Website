<div class="position-relative">
    <a href="{{ $linkURL }}" class="stretched-link text-decoration-none signpost-link">
        <div class="d-flex justify-content-start">
            <div class="sp-icon-cont d-flex flex-shrink-0 justify-content-center align-items-center {{ $bgColourClass ?? '' }}" style="{{ isset($bgColour) ? 'background-color: ' . $bgColour : '' }}">
                @if(isset($svg) && !empty($svg))
                    <img src="{{ $svg }}" alt="{{ $iconImageAlt ?? '' }}"/>
                @elseif(isset($useEstynLogoAsIcon) && $useEstynLogoAsIcon === true)
                    <img src="{{ asset('images/estyn-logo-icon-only-darkblue.svg') }}" alt="{{ __('Estyn logo', 'sage') }}"/>
                @else
                    <i class="{{ $iconClasses }}"></i>
                @endif
            </div>
            <div class="sp-text ms-3 d-flex flex-column justify-content-center">
                <h3 class="sp-title m-0">{{ $title }}</h3>
                <p class="sp-desc m-0">{{ $description }}</p>
            </div>
            @if(isset($arrow) && $arrow)
                <div class="d-none d-xl-flex flex-column justify-content-center ms-5">
                    <i class="fa-sharp fa-regular fa-arrow-up-right" aria-hidden="true"></i>
                </div>
            @endif
        </div>
    </a>
</div>

