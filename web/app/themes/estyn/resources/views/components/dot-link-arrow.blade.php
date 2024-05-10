<div class="dot-link-arrow position-relative {{ $wrapperClasses ?? '' }}">
    <a class="stretched-link" href="{{ $linkURL }}">
        <div class="d-flex align-items-center">
            @include('components.dot', ['bgColourClass' => $bgColourClass])
            <span class="ms-2 text-nowrap d-flex align-items-center">
                <span class="d-block me-1">{{ $text }}</span>
                <i class="fa-sharp fa-regular fa-arrow-up-right"></i>
            </span>
        </div>
    </a>
</div>