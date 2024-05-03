<div class="list-group list-group-flush {{ isset($noMarginBottom) && $noMarginBottom === true ? 'mb-0' : 'mb-4' }} resourceList">
    @foreach($items as $item)
        @include('components.resource-item-link-box', [
            'linkURL' => $item['linkURL'],
            'superText' => $item['superText'] ?? null,
            'superDate' => $item['superDate'] ?? null,
            'dateOnRight' => $item['dateOnRight'] ?? null,
            'title' => $item['title'],
            'extraText' => $item['extraText'] ?? null,
            'greenVersion' => $item['greenVersion'] ?? null
        ])
    @endforeach
</div>