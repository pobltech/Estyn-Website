<div class="dot-link-arrow position-relative {{ $wrapperClasses ?? '' }}">
    <a class="stretched-link" href="{{ $linkURL }}">
        <div class="d-flex align-items-center">
            @include('components.dot', ['bgColourClass' => $bgColourClass])
            <span class="d-block ms-3 me-1">{{ $text }}</span>
            <i class="fa-sharp fa-regular fa-arrow-up-right"></i>
        </div>
    </a>
</div>