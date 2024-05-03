{{-- 
    Template name: Working for Us page
--}}
@extends('layouts.app')
@section('content')
    @include('partials.inside-hero', [
        'title' => get_the_title(),
        'heroImageImgTag' => get_the_post_thumbnail(),
        'secondHeading' => __('Working for Estyn', 'sage'),
        'introContent' => '
            <p>We employ both His Majesty\'s Inspectors (HMI) and inspection support staff.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris quis ipsum nec nibh bibendum blandit vitae quis elit.</p>',
        'introImageID' => get_field('intro_image'),
        'introLinks' => [
            [
                'url' => '#',
                'text' => __('Working for Estyn', 'sage')
            ],
            [
                'url' => '#',
                'text' => __('Current vacancies', 'sage')
            ]
        
        ]
    ])
<div class="reportMain pt-5 pb-5">
	<div class="container px-md-4 px-xl-5 mt-5 mb-md-5">
        <div class="row justify-content-lg-between pb-md-5">
            <div class="col-12 col-lg-6 col-xl-5 mb-5 mb-lg-0">
                <h2>{{ __('Current vacancies', 'sage') }}</h2>
                <p>{{ __('Please register for updates to hear about new opportunites.', 'sage') }}</p>
                <p>Accredited as an Investor in People since 1999, we recognise that each person brings different skills and experience to our organisation, and we encourage all staff to develop their talents. At the same time, we welcome diversity and value differences.</p>
                <a href="#" class="btn btn-outline-primary">{{ __('Register for updates', 'sage') }}</a>
            </div>
            <div class="col-12 col-lg-6">
                @include('components.resource-list', [
                    'items' => [
                        [
                            'linkURL' => '#',
                            'title' => __('Youth Work Peer Inspectors', 'sage'),
                            'superText' => __('Recruitment starts from Monday 4 March - Monday 25 March 2024', 'sage'),
                            'extraText' => 'We are recruiting for peer inspectors to work with us on ouro youth inspections.',
                            'greenVersion' => true
                        ],
                        [
                            'linkURL' => '#',
                            'title' => __('Secondary and All-age Peer and Additional Inspectors', 'sage'),
                            'superText' => __('Recruitment starts from Monday 4 March - Monday 25 March 2024', 'sage'),
                            'extraText' => 'We are recruiting for peer inspectors to work with us on our secondary and all-age inspections.',
                            'greenVersion' => true
                        ],
                        [
                            'linkURL' => '#',
                            'title' => __('Another job working for Estyn', 'sage'),
                            'superText' => __('Position type', 'sage'),
                            'superDate' => '31/06/2024'
                        ],
                        [
                            'linkURL' => '#',
                            'title' => __('Another job working for Estyn', 'sage'),
                            'superText' => __('Position type', 'sage'),
                            'superDate' => '31/06/2024'
                        ],
                        [
                            'linkURL' => '#',
                            'title' => __('An Estyn job title', 'sage'),
                            'superText' => __('Position type', 'sage'),
                            'superDate' => '31/06/2024'
                        ]
                    ]
                ])
            </div>
        </div>  
        <div class="mb-md-5">
            @include('partials.cta', [
                'ctaHeading' => __('Becoming an inspector', 'sage'),
                'ctaText' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ultrices nist et risus tristique, et ornare eros vulputate. Vivamus justo sem, elementum congue nist ut, elementum tristique neque.', 'sage'),
                'ctaButtonLinkURL' => '#',
                'ctaButtonText' => __('Becoming an inspector', 'sage'),
                'ctaImageURL' => asset('images/cta-example.png'),
                'ctaImageAlt' => 'CTA example'
            ])
        </div>
    </div>
</div>
@endsection