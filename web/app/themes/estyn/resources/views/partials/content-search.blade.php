<article @php(post_class())>
  @include('partials.page-header', [
    'title' => get_the_title(),
    'subtitle' => __('Search item', 'sage'),
    'readTime' => 11,
    'shareLinkURL' => '#',
    'date' => '31 January 2024'
  ])

  <div class="entry-summary">
    @php(the_excerpt())
  </div>
</article>
