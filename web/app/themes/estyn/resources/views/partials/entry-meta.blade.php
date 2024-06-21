@if(isset($subtitle))
  <span class="reportTypeHero me-4">{{ $subtitle }}</span>
@endif
<span class="reportDateHero me-4">
  <time class="dt-published" datetime="{{ $dateTime ?? get_the_date('c') }}">
    {{ $date ?? get_the_date('j F Y') }}
  </time>
</span>
@php
  $read_time = 0;
  if (isset($readTime)) {
    $read_time = $readTime;
  } else {
    $content = '';
    $pages = explode('<!--nextpage-->', get_the_content());
    foreach ($pages as $page) {
      $content .= strip_tags($page);
    }
    $word_count = str_word_count($content);
    $read_time = ceil($word_count / 200); // Assuming an average reading speed of 200 words per minute
  }
@endphp
@if(empty($noReadtime))
  <span class="reportReadHero me-4">{{ $read_time }} {{ __('min read', 'sage') }}</span>
@endif


{{--<p>
  <span>{{ __('By', 'sage') }}</span>
  <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" class="p-author h-card">
    {{ get_the_author() }}
  </a>
</p>--}}
