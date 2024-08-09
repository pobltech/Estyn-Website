{{-- 
    Template name: Working for Us page
--}}
@extends('layouts.app')
@section('content')
    @include('partials.inside-hero', $insideHeroPartialArgs)
    {{--@include('partials.inside-hero', [
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
    ])--}}
<div class="reportMain pt-5">
	<div class="container px-md-4 px-xl-5 mt-5 mb-md-5">
        <div class="row justify-content-lg-between pb-md-5">
            <div class="col-12 col-lg-6 col-xl-5 mb-5 mb-lg-0">
                {{--<h2>{{ __('Current vacancies', 'sage') }}</h2>
                <p>{{ __('Please register for updates to hear about new opportunites.', 'sage') }}</p>
                <p>Accredited as an Investor in People since 1999, we recognise that each person brings different skills and experience to our organisation, and we encourage all staff to develop their talents. At the same time, we welcome diversity and value differences.</p>
                <a href="#" class="btn btn-outline-primary">{{ __('Register for updates', 'sage') }}</a>--}}
                {!! get_the_content() !!}
            </div>
            <div class="col-12 col-lg-6">
                @include('components.resource-list', [ 'items' => $jobVacanciesListItems ])
            </div>
        </div>  
        <div class="mb-md-5 pb-md-5">
            @include('partials.cta', $generalCTAPartialArgs)
            {{--@include('partials.cta', [
                'ctaHeading' => __('Becoming an inspector', 'sage'),
                'ctaText' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ultrices nist et risus tristique, et ornare eros vulputate. Vivamus justo sem, elementum congue nist ut, elementum tristique neque.', 'sage'),
                'ctaButtonLinkURL' => '#',
                'ctaButtonText' => __('Becoming an inspector', 'sage'),
                'ctaImageURL' => asset('images/cta-example1.png'),
                'ctaImageAlt' => 'CTA example'
            ])--}}
        </div>
    </div>
    <div class="py-5 bg-lightblue">
        <div class="container py-5 px-md-4 px-xl-5">
            <div class="row mb-md-4">
                <div class="col-12">
                    <h2>{{ get_field('jobs_page_enquires_section_heading') }}</h2>
                </div>
            </div>
            <div class="row">
                @if(have_rows('jobs_page_enquiries_info_boxes'))
                    @while(have_rows('jobs_page_enquiries_info_boxes')) @php(the_row())
                        <div class="col-12 col-md-6 mb-4 mb-md-0">
                            <div class="card card-body p-md-5 rounded-3 h-100 bg-white">
                                <h3>{{ get_sub_field('heading') }}</h3>
                                {!! get_sub_field('content') !!}
                            </div>
                        </div>
                    @endwhile
                @endif

                {{--<div class="col-12 col-md-6 mb-4 mb-md-0">
                    <div class="card card-body p-md-5 rounded-3 h-100 bg-white">
                        <h3>{{ __('Human Resources', 'sage') }}</h3>
                        <p>{{ __('For general enquiries about working for us, contact:', 'sage') }}</p>
                        <a href="#">02920 446336</a>
                        <a href="#">recruitment@estyn.gov.wales</a>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card card-body p-md-5 rounded-3 h-100 bg-white">
                        <h3>{{ __('Events', 'sage') }}</h3>
                        <p>{{ __('For general enquiries about training to become a Peer Inspector, Registered Inspector, or an Additional Inspector, contact:', 'sage') }}</p>
                        <a href="#">02920 446510</a>
                        <a href="#">events@estyn.gov.wales</a>
                    </div>
                </div>--}}
            </div>
        </div>
    </div>
</div>
@php($footerNoMT = true)
@endsection