@include('partials.inside-hero', [
    'title' => get_the_title(),
    'heroImageSrc' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
    'heroImageAlt' => 'Attendance and attitudes to learning photo 2 BPF ESP 55',
    'sectors' => get_the_terms(get_the_ID(), 'sector'),
    'localAuthorities' => get_the_terms(get_the_ID(), 'local_authority'),
    'followUpStatusses' => get_the_terms(get_the_ID(), 'provider_status'),
    'insideIntroLinks' => [
        [
            'url' => '#inspection-reports',
            'bgColourClass' => 'bg-signpost-blue',
            'iconClasses' => 'fas fa-graduation-cap',
            'title' => __('Inspection report', 'sage'),
            'description' => __('Read the latest report for this provider', 'sage')
        ],
        [
            'url' => '#contact-details',
            'bgColourClass' => 'bg-signpost-verylightbrown',
            'iconClasses' => 'fas fa-book',
            'title' => __('Provider details', 'sage'),
            'description' => __('Contact details and location', 'sage')
        ],
        [
            'url' => '#',
            'bgColourClass' => 'bg-signpost-lightpink',
            'iconClasses' => 'fas fa-calendar-alt',
            'title' => __('Estyn widget', 'sage'),
            'description' => __('Find out when your inspection is due', 'sage')
        ]
    ]
])
<div class="reportMain pb-5">
    <div class="container px-md-4 px-xl-5 mt-5 pt-md-5">
        <div class="row" id="inspection-reports">
            <div class="col-12">
                <h2>{{ __('Inspections', 'sage') }}</h2>
            </div>
        </div>
        <div class="row justify-content-center justify-content-md-between mb-5">
            <div class="col-12 col-md-6 mb-4 mb-md-0">
                @include('components.resource-list', [
                    'items' => [
                        [
                            'linkURL' => '#',
                            'superDate' => '07/11/2021',
                            'title' => __('Inspection report 2021', 'sage'),
                            'dateOnRight' => true
                        ],
                        [
                            'linkURL' => '#',
                            'superDate' => '02/03/2017',
                            'title' => __('Inspection report 2017', 'sage'),
                            'dateOnRight' => true
                        ],
                        [
                            'linkURL' => '#',
                            'superDate' => '22/11/2013',
                            'title' => __('Inspection report 2013', 'sage'),
                            'dateOnRight' => true
                        ]
                    ],
                    'noMarginBottom' => true
                ])
            </div>
            <div class="col-auto col-md-5">
                <div class="mt-2 mb-4">
                    @include('components.dot-text-date', [
                        'text' => __('Next scheduled inspection/visit', 'sage'),
                        'date' => '23 October 2023',
                        'bgColourClass' => 'bg-signpost-blue',
                        'dontShrink' => true
                    ])
                </div>
                <div>
                    @include('components.dot-text-date', [
                        'text' => __('Report publication date', 'sage'),
                        'date' => '28 December 2023',
                        'bgColourClass' => 'bg-signpost-blue',
                        'dontShrink' => true
                    ])
                </div>
            </div>
        </div>
    </div>
    <div class="container px-md-4 px-xl-5">
        <div class="row" id="contact-details">
            <div class="col-12">
                <hr>
            </div>
        </div>
    </div>
    <div class="container px-md-4 px-xl-5 mt-5">
        <div class="row">
            <div class="col-12">
                <h2>{{ __('Details', 'sage') }}</h2>
            </div>
        </div>
        <div class="row justify-content-between mb-5">
            <div class="col-12 pb-4 pb-md-0 col-md-6">
                <img src="{{ asset('images/googlemapplaceholderimage.png') }}" alt="Google map placeholder" class="rounded-3 img-fluid"/>
            </div>
            <div class="col-12 col-md-5">
                <h4>{{ __('Address', 'sage') }}</h4>
                <p>
                    @if(!empty($providerData['address_line_1']))
                        {{ $providerData['address_line_1'] }}<br>
                    @endif
                    @if(!empty($providerData['address_line_2']))
                        {{ $providerData['address_line_2'] }}<br>
                    @endif
                    @if(!empty($providerData['address_line_3']))
                        {{ $providerData['address_line_3'] }}<br>
                    @endif
                    @if(!empty($providerData['address_line_4']))
                        {{ $providerData['address_line_4'] }}<br>
                    @endif
                    @if(!empty($providerData['town']))
                        {{ $providerData['town'] }}<br>
                    @endif
                    @if(!empty($providerData['county']))
                        {{ $providerData['county'] }}<br>
                    @endif
                    @if(!empty($providerData['postcode']))
                        {{ $providerData['postcode'] }}<br>
                    @endif
                </p>
                
                @if(!empty($providerData['phone']))
                    <h4>{{ __('Telephone', 'sage') }}</h4>
                    <p {{ empty($providerData['email']) ? 'class="mb-0"' : '' }}>{{ $providerData['phone'] }}</p>
                @endif

                @if(!empty($providerData['email']))
                    <h4>{{ __('Email', 'sage') }}</h4>
                    <p class="mb-0"><a href="mailto:{{ $providerData['email'] }}">{{ $providerData['email'] }}</a></p>
                @endif
            </div>
        </div>
    </div>
    <div class="container px-md-4 px-xl-5">
        <div class="row">
            <div class="col-12">
                <hr>
            </div>
        </div>
    </div>
    <div class="container px-md-4 px-xl-5 mt-5">
        <div class="row">
            <div class="col-12">
                <h2>{{ __('Improvement resources from this provider', 'sage') }}</h2>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12 col-md-6">
                @include('partials.provider-resources-list', [
                    'noHeading' => true,
                    'providerPost' => $post
                ])
            </div>
            <div class="col-12 col-md-6"></div>
        </div>
    </div>
    <div class="container px-md-4 px-xl-5">
        <div class="row">
            <div class="col-12">
                <hr>
            </div>
        </div>
    </div>
    <div class="container px-md-4 px-xl-5 mt-5">
        <div class="row">
            <div class="col-12">
                <h2>{{ __('Estyn widget for this service', 'sage') }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <p>{{ __('Display this providers Estyn widget on your website', 'sage') }}</p>
                <p>
                    <img class="img-fluid border rounded-2" src="{{ asset('images/estynwidgetplaceholder.png') }}" alt="Estyn widget example"/>
                </p>
                <p>{{ __('Simply copy and paste the code below into an HTML webpage:', 'sage') }}</p>

                <pre class="p-3 border border-dark bg-secondary-subtle"><code>&lt;script type="text/javascript" src="https://www.estyn.gov.wales/sites/all/modules/custom/widget/widget.js?data-id=1-136731141&data-host=https://www.estyn.gov.wales&type=location"&gt;&lt;/script&gt;</code></pre>
            </div>
            <div class="col-12 col-md-6"></div>
        </div>
    </div>
</div>