<div class="w-100 bg-blue pt-md-5 pb-md-5">
    <div class="container py-5 px-md-4 px-xl-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                @if(!empty($heading))
                    <div class="row">
                        <div class="col-12">
                            <h2 class="text-white mb-5">{{ $heading }}</h2>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="accordion accordion-flush" id="{{ $id }}">
                            @foreach($items as $item)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="{{ $id }}-heading-{{ $loop->iteration }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $id }}-collapse-{{ $loop->iteration }}" aria-expanded="false" aria-controls="{{ $id }}-collapse-{{ $loop->iteration }}">
                                            {{ $item['question'] }}
                                        </button>
                                    </h2>
                                    <div id="{{ $id }}-collapse-{{ $loop->iteration }}" class="accordion-collapse collapse" aria-labelledby="{{ $id }}-heading-{{ $loop->iteration }}" data-bs-parent="#{{ $id }}">
                                        <div class="accordion-body">
                                            {!! $item['answer'] !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>