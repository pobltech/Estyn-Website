<div class="dot-link-arrow {{ $wrapperClasses ?? '' }}">
    <a href="{{ $linkURL }}" class="stretched-link dot-link-arrow">
        <div class="d-flex align-items-center">
            @include('components.dot', ['bgColourClass' => $bgColourClass])
            <span class="d-block ms-3 me-1">{{ $text }}</span>
            <i class="fa-sharp fa-regular fa-arrow-up-right"></i>
        </div>
    </a>
</div>