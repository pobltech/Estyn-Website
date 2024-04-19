@extends('layouts.app')

@section('content')
    @php
        $term = get_queried_object();
    @endphp
    @include('partials.inside-hero', [
        'title' => $term->name,
        'super' => __('Education Sector', 'sage'),
        'heroImageSrc' => get_field('hero_image', $term) ?? asset('images/sectordefaulthero.jpg'),
        'heroImageAlt' => get_field('hero_image_alt', $term) ?? $term->name,
        'secondHeading' => __('Education in the ' . $term->name . ' sector', 'sage'),
        'introContent' => get_field('intro_summary', $term) ?? __('Find out what Estyn can do to help providers in the ' . $term->name . ' sector.', 'sage'),
        'introImageSrc' => get_field('intro_image', $term) ?? asset('images/sectordefaultintro.jpg'),
        'introImageAlt' => get_field('intro_image_alt', $term) ?? __('Education in the ' . $term->name . ' sector', 'sage'),
    ])
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p>Testing 123</p>
            </div>
        </div>
    </div>
@endsection