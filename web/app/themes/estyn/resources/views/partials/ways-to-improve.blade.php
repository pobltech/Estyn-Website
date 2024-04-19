<div class="row">
    <div class="col-12">
        <h2>{{ __('Ways to improve', 'sage') }}</h2>
    </div>
</div>
<div class="row justify-content-between">
    <div class="col-12 col-sm-4">
        <p>Estyn are here to help you improve your secondary school setting. Explore our vast wealth of improvement resources.</p>
    </div>
    <div class="col-12 col-lg-8 col-xl-7">
        <div class="d-flex justify-content-between">
            <div>     
                @include('components.dot-link-arrow', [
                    'linkURL' => '#',
                    'text' => __('Numeracy', 'sage'),
                    'bgColourClass' => 'bg-signpost-blue',
                    'wrapperClasses' => 'mb-4'
                ])
                @include('components.dot-link-arrow', [
                    'linkURL' => '#',
                    'text' => __('Welsh Language', 'sage'),
                    'bgColourClass' => 'bg-signpost-lime'
                ])
            </div>
            <div>
                @include('components.dot-link-arrow', [
                    'linkURL' => '#',
                    'text' => __('Literacy', 'sage'),
                    'bgColourClass' => 'bg-signpost-verylightbrown',
                    'wrapperClasses' => 'mb-4'
                ])
                @include('components.dot-link-arrow', [
                    'linkURL' => '#',
                    'text' => __('Digital Skills', 'sage'),
                    'bgColourClass' => 'bg-signpost-lightpink'
                ])
            </div>
            <div>
                @include('components.dot-link-arrow', [
                    'linkURL' => '#',
                    'text' => __('Poverty', 'sage'),
                    'bgColourClass' => 'bg-signpost-darkpink',
                    'wrapperClasses' => 'mb-4'
                ])
                @include('components.dot-link-arrow', [
                    'linkURL' => '#',
                    'text' => __('Attendance', 'sage'),
                    'bgColourClass' => 'bg-signpost-green'
                ])
            </div>
        </div>
    </div>
</div>