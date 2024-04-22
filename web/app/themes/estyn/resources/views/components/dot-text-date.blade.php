<div class="d-flex dot-text-date">
    <div class="me-3">
        @include('components.dot', ['bgColourClass' => $bgColourClass])
    </div>
    <div>
        <span class="d-block"><strong>{{ $text }}</strong></span>
        <span class="d-block">{{ $date }}</span>
    </div>
</div>
