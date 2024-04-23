{{--
    Template Name: Annual Report
--}}
@extends('layouts.app')
@section('content')
    @include('partials.inside-hero', [
        'title' => get_the_title(),
        'heroImageSrc' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
        'heroImageAlt' => 'Attendance and attitudes to learning photo 2 BPF ESP 55',
        'secondHeading' => __('The Estyn annual report', 'sage'),
        'introContent' => '
            <p>Every year we publish our annual report on the state of education and training across Wales. We report on what\'s going well and what needs to improve for each sector, as well as providing guidance on how to improve.</p>
            <a class="btn btn-outline-primary">Annual report 2022-23</a>
        ',
        'introImageSrc' => asset('images/annualreportframed.jpg'),
        'introImageAlt' => 'CTA example'
    ])
    <div class="reportMain">
        <div class="container px-md-4 px-xl-5">
            <div class="row pt-5">
                <div class="col-12">
                    <h2>{{ __('Annual report archive', 'sage') }}</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <p>{{ __('Our archive of previous annual report publications', 'sage') }}</p>
                    @include('components.resource-list', ['items' => [
                        [
                            'linkURL' => '#',
                            'title' => 'Annual Report 2021-2022'
                        ],
                        [
                            'linkURL' => '#',
                            'title' => 'Annual Report 2021-2022'
                        ],
                        [
                            'linkURL' => '#',
                            'title' => 'Annual Report 2021-2022'
                        ],
                        [
                            'linkURL' => '#',
                            'title' => 'Annual Report 2021-2022'
                        ],
                        [
                            'linkURL' => '#',
                            'title' => 'Annual Report 2021-2022'
                        ]
                    ]])
                    <a class="btn btn-outline-primary">{{ __('View full archive', 'sage') }}</a>
                </div>
                <div class="col-12 col-md-6">
                    <img class="img-fluid" src="{{ asset('images/estynannualreport2.jpg') }}" alt="Estyn annual report 2" />
                </div>
            </div>
        </div>
    </div>
@endsection