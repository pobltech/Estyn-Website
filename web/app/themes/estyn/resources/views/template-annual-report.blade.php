{{--
    Template Name: Annual Report
--}}
@extends('layouts.app')
@section('content')
    @include('partials.inside-hero', [...$insideHeroPartialArgs,
        'introImageWidth' => 300
    ])
    <div class="pb-md-5">
    <div class="reportMain pt-md-5 pb-md-5">
        <div class="container px-md-4 px-xl-5">
            <div class="row pt-5">
                <div class="col-12">
                    <h2>{{ __('Annual report archive', 'sage') }}</h2>
                </div>
            </div>
            <div class="row justify-content-center gy-5">
                <div class="col-12 col-md-6">
                    <p>{{ __('Our archive of previous annual report publications', 'sage') }}</p>
                    @include('components.resource-list', ['items' => $annualReportArchiveResourceListItems])
                    <a class="btn btn-outline-primary" href="{{ \App\get_permalink_by_template('template-annual-reports-archive.blade.php') . '?type=Annual Report' }}">{{ __('View full archive', 'sage') }}</a>
                </div>
                <div class="col-12 col-md-6">
                    <div class="d-flex justify-content-center">
                        <img class="img-fluid" width="377" src="{{ asset('images/estynannualreport2.jpg') }}" alt="Estyn annual report 2" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection