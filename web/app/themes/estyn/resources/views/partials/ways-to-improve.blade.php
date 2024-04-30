<div class="row">
    <div class="col-12">
        <h2>{{ __('Ways to improve', 'sage') }}</h2>
    </div>
</div>
<div class="row justify-content-between">
    <div class="col-12 col-md-6 col-lg-4">
        <p>Estyn are here to help you improve your secondary school setting. Explore our vast wealth of improvement resources.</p>
    </div>
    <div class="col-12 col-lg-8 col-xl-7">
        <div class="d-md-flex justify-content-lg-end">
            <div class="d-flex d-md-table">
                <div class="me-2 me-sm-5 me-md-0 d-md-table-row">
                    <div class="d-md-table-cell pb-2 pb-sm-3 pb-md-4 pe-md-5">     
                        @include('components.dot-link-arrow', [
                            'linkURL' => '#',
                            'text' => __('Numeracy', 'sage'),
                            'bgColourClass' => 'bg-signpost-blue'
                        ])
                    </div>
                    <div class="d-md-table-cell pb-2 pb-sm-3 pb-md-4 pe-md-5">
                        @include('components.dot-link-arrow', [
                            'linkURL' => '#',
                            'text' => __('Welsh Language', 'sage'),
                            'bgColourClass' => 'bg-signpost-lime'
                        ])
                    </div>
                    <div class="d-md-table-cell pb-md-4">
                        @include('components.dot-link-arrow', [
                            'linkURL' => '#',
                            'text' => __('Literacy', 'sage'),
                            'bgColourClass' => 'bg-signpost-verylightbrown'
                        ])
                    </div>
                </div>
                <div class="d-md-table-row">
                    <div class="d-md-table-cell pb-2 pb-sm-3 pb-md-0">
                        @include('components.dot-link-arrow', [
                            'linkURL' => '#',
                            'text' => __('Digital Skills', 'sage'),
                            'bgColourClass' => 'bg-signpost-lightpink'
                        ])
                    </div>
                    <div class="d-md-table-cell pb-2 pb-sm-3 pb-md-0">
                        @include('components.dot-link-arrow', [
                            'linkURL' => '#',
                            'text' => __('Poverty', 'sage'),
                            'bgColourClass' => 'bg-signpost-darkpink'
                        ])
                    </div>
                    <div class="d-md-table-cell">
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
</div>