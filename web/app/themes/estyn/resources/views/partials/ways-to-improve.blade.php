<div class="row justify-content-between">
    <div class="col-12 col-sm-4">
        <h2>{{ __('Ways to improve', 'sage') }}</h2>
        <p>Estyn are here to help you improve your secondary school setting. Explore our vast wealth of improvement resources.</p>
    </div>
    <div class="col-12 col-sm-6">
        <div class="d-flex h-100 flex-column justify-content-center">
            <div class="row gy-4">
                <div class="col-4">
                    @include('components.dot-link-arrow', [
                        'linkURL' => '#',
                        'text' => __('Numeracy', 'sage'),
                        'bgColourClass' => 'bg-signpost-blue'
                    ])
                </div>
                <div class="col-4">
                    @include('components.dot-link-arrow', [
                        'linkURL' => '#',
                        'text' => __('Welsh Language', 'sage'),
                        'bgColourClass' => 'bg-signpost-lime'
                    ])
                </div>
                <div class="col-4">
                    @include('components.dot-link-arrow', [
                        'linkURL' => '#',
                        'text' => __('Literacy', 'sage'),
                        'bgColourClass' => 'bg-signpost-verylightbrown'
                    ])
                </div>
                <div class="col-4">
                    @include('components.dot-link-arrow', [
                        'linkURL' => '#',
                        'text' => __('Digital Skills', 'sage'),
                        'bgColourClass' => 'bg-signpost-lightpink'
                    ])
                </div>
                <div class="col-4">
                    @include('components.dot-link-arrow', [
                        'linkURL' => '#',
                        'text' => __('Poverty', 'sage'),
                        'bgColourClass' => 'bg-signpost-darkpink'
                    ])
                </div>
                <div class="col-4">
                    @include('components.dot-link-arrow', [
                        'linkURL' => '#',
                        'text' => __('Attendance', 'sage'),
                        'bgColourClass' => 'bg-signpost-green'
                    ])
                </div>
            </div>
        </div>
    </div>
</div>