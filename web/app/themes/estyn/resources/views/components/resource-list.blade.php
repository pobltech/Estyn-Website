<div class="list-group list-group-flush mb-4 resourceList">
    @foreach($items as $item)
        @include('components.resource-item-link-box', [
            'linkURL' => $item['linkURL'],
            'superText' => $item['superText'],
            'superDate' => $item['superDate'],
            'title' => $item['title']
        ])
    @endforeach
</div>