<article @php(post_class('h-entry'))>
@include('partials.page-header', [
	  'title' => get_the_title(),
	  'subtitle' => __('Thematic report', 'sage'),
	  'readTime' => 11,
	  'shareLinkURL' => '#',
	  'date' => '31 January 2024',
    'fullWidth' => true
])
<div class="reportMain">
	<div class="container px-md-4 px-xl-5">
    <div class="row d-flex justify-content-between">
      <div class="col-12 col-md-4">
        <div class="row">
          <div class="col-12 col-md-11">
            <h3 class="mb-4">Contents</h3>

            <div class="reportContents list-group list-group-flush">
              <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                The current link item
              </a>
              <a href="#" class="list-group-item list-group-item-action">A second link item</a>
              <a href="#" class="list-group-item list-group-item-action">A third link item</a>
              <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
            </div>

          </div>
        </div>
      </div>
      <div class="col-12 col-md-8">
        @php(the_content())

        @if ($pagination)
          <footer>
            <nav class="page-nav" aria-label="Page">
              {!! $pagination !!}
            </nav>
          </footer>
        @endif

        {{-- comments_template(); --}}
      </div>
    </div>
  </div>
</div>

</article>
