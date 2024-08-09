    <div class="w-100 bg-lightblue my-5 pt-5 pb-5">
        <div class="container py-md-5 px-md-4 px-xl-5">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h2 class="mb-3 mb-md-4">{{ get_field('our_work_heading') }}</h2>
                        <p class="mb-3 mb-md-4">{{ get_field('our_work_description') }}</p>
                    </div>
                </div>
                <div class="row">
                    @if(have_rows('our_work_work_links'))
                        @while(have_rows('our_work_work_links')) @php(the_row())
                            <!-- Box -->
                            <div class="col-12 col-md-6 py-md-4 position-relative">
                                <div class="landscapeImg mb-2 mb-md-4">
                                    {!! wp_get_attachment_image(get_sub_field('image')['ID'], 'full', false, ['class' => 'img-fluid']) !!}
                                </div>
                                <a class="stretched-link text-decoration-none" href="{{ empty(get_sub_field('external_link')) ? get_permalink(get_sub_field('link')[0]) : get_sub_field('external_link') }}"><h4 class="mb-0">{{ get_sub_field('title') }}</h4></a>
                                <p>{{ get_sub_field('description') }}</p>
                            </div>
                        @endwhile
                    @endif
                    @php(wp_reset_postdata())
                    <!-- Box -->
                    {{--<div class="col-12 col-md-6 py-md-4">
                        <div class="landscapeImg mb-2 mb-md-4">
                            <img src="{{ asset('images/sectordefaulthero1.jpg') }}" alt=""/>
                        </div>
            <h4 class="mb-0">Title</h4>
            <p>Desc</p>
                    </div>
                    <!-- Box -->
                    <div class="col-12 col-md-6 py-md-4">
                        <div class="landscapeImg mb-2 mb-md-4">
                            <img src="{{ asset('images/sectordefaulthero1.jpg') }}" alt=""/>
                        </div>
            <h4 class="mb-0">Title</h4>
            <p>Desc</p>
                    </div>
                    <!-- Box -->
                    <div class="col-12 col-md-6 py-md-4">
                        <div class="landscapeImg mb-2 mb-md-4">
                            <img src="{{ asset('images/sectordefaulthero1.jpg') }}" alt=""/>
                        </div>
            <h4 class="mb-0">Title</h4>
            <p>Desc</p>
                    </div>
                    <!-- Box -->
                    <div class="col-12 col-md-6 py-md-4">
                        <div class="landscapeImg mb-2 mb-md-4">
                            <img src="{{ asset('images/sectordefaulthero1.jpg') }}" alt=""/>
                        </div>
            <h4 class="mb-0">Title</h4>
            <p class="mb-0">Desc</p>
                    </div>--}}
                </div>
            </div>
        </div>
    </div>