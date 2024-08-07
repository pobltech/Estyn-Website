{{-- 
    Template name: Inspectors Page
--}}
@extends('layouts.app')
@section('content')

@include('partials.page-header', [
	  'title' => get_the_title(),
    'fullWidth' => true,
    'showProviderSearch' => true
])
<div class="reportMain pt-2 pt-md-4">
	<div class="container px-md-4 px-xl-5">
        <div class="row">
            <div class="col-12">
                <div class="row gy-4">
                    @foreach($pictureLinks as $pictureLink)
                        <div class="col-12 col-md-6 col-xl-3">
                            
                                <div class="position-relative">

                                    <div class="magic-responsive-image-container">
                                        {!! wp_get_attachment_image($pictureLink['imageID'], 'full', false, ['class' => 'img-fluid rounded-3']) !!}</a>
                                    </div>
                            
                                
                                    <a href="{{ $pictureLink['linkURL'] }}" class="stretched-link text-decoration-none colour-black"><h3 class="mb-0 py-2">{{ $pictureLink['linkText'] }}</h3></a>
                                </div>
                                
                            
                        </div>
                    @endforeach

                    {{--<div class="col-12 col-md-6 col-xl-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="magic-responsive-image-container">
                                    <a href="#"><img src="{{ asset('images/sectordefaultintro.jpg') }}" alt="Inspectors" class="img-fluid rounded-3"></a>
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="#" class="text-decoration-none colour-black"><h3 class="mb-0 py-2">{{ __('VIR (Sharepoint)', 'sage') }}</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="magic-responsive-image-container">
                                    <a href="#"><img src="{{ asset('images/sectordefaulthero.jpg') }}" alt="Inspectors" class="img-fluid rounded-3"></a>
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="#" class="text-decoration-none colour-black"><h3 class="mb-0 py-2">{{ __('VIR (Portal)', 'sage') }}</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="magic-responsive-image-container">
                                    <a href="#"><img src="{{ asset('images/homeherofallback.png') }}" alt="Inspectors" class="img-fluid rounded-3"></a>
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="#" class="text-decoration-none colour-black"><h3 class="mb-0 py-2">{{ __('Inspector profiles', 'sage') }}</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="magic-responsive-image-container">
                                    <a href="#"><img src="{{ asset('images/attendance and attitudes to learning - photo 2 - BPF-ESP-55.jpg') }}" alt="Inspectors" class="img-fluid rounded-3"></a>
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="#" class="text-decoration-none colour-black"><h3 class="mb-0 py-2">{{ __('My concern', 'sage') }}</span></a>
                            </div>
                        </div>
                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pb-5">
@include('partials.inspectors-page-signposting')
</div>
@endsection