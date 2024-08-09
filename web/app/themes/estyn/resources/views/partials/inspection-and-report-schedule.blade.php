<div class="row pt-5">
    <div class="col-12">
        <h2>{{ __('Inspection and report schedule', 'sage') }}</h2>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-12 col-md-6 mb-5">
        <h3>{{ __('Latest inspection reports', 'sage') }}</h3>
        @if(!empty($inspectionReports))
            @include('components.resource-list', ['items' => $inspectionReports])
            <a class="btn btn-outline-primary" href="{{ App\get_permalink_by_template('template-inspection-report-search.blade.php') }}">{{ __('See all inspection reports', 'sage') }}</a>
        @else
            <p>{{ __('No inspection reports available', 'sage') }}</p>
        @endif
        {{--@include('components.resource-list', ['items' => [
            [
                'linkURL' => '#',
                'superText' => 'Adult Learning in the Community',
                'superDate' => '05/02/2024',
                'title' => 'Ceredigion Adult Learning in the Community Partnership'
            ],
            [
                'linkURL' => '#',
                'superText' => 'Adult Learning in the Community',
                'superDate' => '05/02/2024',
                'title' => 'Ceredigion Adult Learning in the Community Partnership'
            ],
            [
                'linkURL' => '#',
                'superText' => 'Adult Learning in the Community',
                'superDate' => '05/02/2024',
                'title' => 'Ceredigion Adult Learning in the Community Partnership'
            ],
            [
                'linkURL' => '#',
                'superText' => 'Adult Learning in the Community',
                'superDate' => '05/02/2024',
                'title' => 'Ceredigion Adult Learning in the Community Partnership'
            ],
            [
                'linkURL' => '#',
                'superText' => 'Adult Learning in the Community',
                'superDate' => '05/02/2024',
                'title' => 'Ceredigion Adult Learning in the Community Partnership'
            ],
            [
                'linkURL' => '#',
                'superText' => 'Adult Learning in the Community',
                'superDate' => '05/02/2024',
                'title' => 'Ceredigion Adult Learning in the Community Partnership'
            ],
            [
                'linkURL' => '#',
                'superText' => 'Adult Learning in the Community',
                'superDate' => '05/02/2024',
                'title' => 'Ceredigion Adult Learning in the Community Partnership'
            ],
            [
                'linkURL' => '#',
                'superText' => 'Adult Learning in the Community',
                'superDate' => '05/02/2024',
                'title' => 'Ceredigion Adult Learning in the Community Partnership'
            ]
        ]])--}}
    </div>
    <div class="col-12 col-md-6">
        <h3>{{ __('Inspection schedule', 'sage') }}</h3>
        @if(!empty($inspectionScheduleResourceListItems))
            @include('components.resource-list', ['items' => $inspectionScheduleResourceListItems])
            <a class="btn btn-outline-primary" href="{{ App\get_permalink_by_template('template-inspection-schedule-search-page.blade.php') }}">{{ __('View the full inspection schedule', 'sage') }}</a>
        @else
            <p>{{ __('No inspection schedule available', 'sage') }}</p>
        @endif
        {{--@include('components.resource-list', ['items' => [
            [
                'linkURL' => '#',
                'superText' => 'Adult Learning in the Community',
                'superDate' => '05/02/2024',
                'title' => 'Ceredigion Adult Learning in the Community Partnership'
            ],
            [
                'linkURL' => '#',
                'superText' => 'Adult Learning in the Community',
                'superDate' => '05/02/2024',
                'title' => 'Ceredigion Adult Learning in the Community Partnership'
            ],
            /*[
                'linkURL' => '#',
                'superText' => 'Adult Learning in the Community',
                'superDate' => '05/02/2024',
                'title' => 'Ceredigion Adult Learning in the Community Partnership'
            ],
            [
                'linkURL' => '#',
                'superText' => 'Adult Learning in the Community',
                'superDate' => '05/02/2024',
                'title' => 'Ceredigion Adult Learning in the Community Partnership'
            ],
            [
                'linkURL' => '#',
                'superText' => 'Adult Learning in the Community',
                'superDate' => '05/02/2024',
                'title' => 'Ceredigion Adult Learning in the Community Partnership'
            ],
            [
                'linkURL' => '#',
                'superText' => 'Adult Learning in the Community',
                'superDate' => '05/02/2024',
                'title' => 'Ceredigion Adult Learning in the Community Partnership'
            ]*/
        ]])--}}
    </div>
</div>