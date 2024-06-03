<article @php(post_class('h-entry'))>
@include('partials.page-header', [
  'title' => $title ?? get_the_title(),
  'subtitle' => $subtitle ?? null,
  'readTime' => $readTime ?? null,
  'shareLinkURL' => $shareLinkURL ?? '#',
  'date' => $date ?? null
])
<div class="reportMain">
	<div class="container px-md-4 px-xl-5">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10 col-xl-8">
            <div class="row">
              <div class="col-12">
                  @if (has_post_thumbnail())
                    @php(the_post_thumbnail(null, ['class' => 'w-100 img-fluid rounded-2 mb-4']))
                  @endif

                  @php(the_content())

                  @if ($pagination)
                    <footer>
                      <nav class="page-nav" aria-label="Page">
                        {!! $pagination !!}
                      </nav>
                    </footer>
                  @endif
      
              </div>
            </div>
      </div>
    </div>
  </div>
</div>
</article>
