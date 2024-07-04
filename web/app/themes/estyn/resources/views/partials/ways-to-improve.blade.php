{{-- This partial is used for sector landing pages--}}
<div class="row">
    <div class="col-12">
        <h2>{{ __('Ways to improve', 'sage') }}</h2>
    </div>
</div>
<div class="row justify-content-between">
    <div class="col-12 col-md-6 col-lg-4 pb-4 pb-sm-0">
        <p>{{ !empty(get_field('ways_to_improve_section_intro_text', $term)) ? get_field('ways_to_improve_section_intro_text', $term) : __('Estyn are here to help you improve your ' . $term->name . ' sector school/setting. Explore our vast wealth of improvement resources') . '.' }}</p>
    </div>
    <div class="col-12 col-lg-8 col-xl-7">
        <div class="d-md-flex justify-content-lg-end">
            <div class="d-flex d-md-table">
                <div class="me-sm-5 me-md-0 d-md-table-row">
                    @if(!empty($wtpTags))
                        @foreach($wtpTags as $tag)
                            @if($loop->index < 3)
                                <div class="d-md-table-cell {{ $loop->iteration % 3 != 0 ? 'pb-3 pe-md-5' : '' }} pb-md-4">
                                    @include('components.dot-link-arrow', [
                                        'linkURL' => $tag['url'],
                                        'text' => $tag['name'],
                                        'bgColourClass' => $wtpTagLinkDotColours[$loop->index]
                                    ])
                                </div>
                            @endif
                        @endforeach
                    @endif
                    
                    {{--<div class="d-md-table-cell pb-3 pb-md-4 pe-md-5">     
                        @include('components.dot-link-arrow', [
                            'linkURL' => '#',
                            'text' => __('Numeracy', 'sage'),
                            'bgColourClass' => 'bg-signpost-blue'
                        ])
                    </div>
                    <div class="d-md-table-cell pb-3 pb-md-4 pe-md-5">
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
                    </div>--}}
                </div>
                <div class="wtimprove-spacer d-md-none" aria-hidden="true">
                    &nbsp;
                </div>
                <div class="d-md-table-row">
                    @if(!empty($wtpTags))
                        @foreach($wtpTags as $tag)
                            @if($loop->index >= 3)
                                <div class="d-md-table-cell {{ $loop->iteration % 3 != 0 ? 'pb-3 pe-md-5' : '' }} pb-md-4">
                                    @include('components.dot-link-arrow', [
                                        'linkURL' => $tag['url'],
                                        'text' => $tag['name'],
                                        'bgColourClass' => $wtpTagLinkDotColours[$loop->index]
                                    ])
                                </div>
                            @endif
                        @endforeach
                    @endif
                
                {{--<div class="d-md-table-cell pb-3 pb-md-0">
                        @include('components.dot-link-arrow', [
                            'linkURL' => '#',
                            'text' => __('Digital Skills', 'sage'),
                            'bgColourClass' => 'bg-signpost-lightpink'
                        ])
                    </div>
                    <div class="d-md-table-cell pb-3 pb-md-0">
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
                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>