<!doctype html>
<html @php(language_attributes())>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Museo font -->
    <link rel="stylesheet" href="https://use.typekit.net/iiq5eeh.css">
    <!-- Source Sans font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <script src="https://kit.fontawesome.com/f460c66ec1.js" crossorigin="anonymous"></script>

    @php(do_action('get_header'))
    @php(wp_head())
  </head>

  <body @php(body_class())>
    @php(wp_body_open())

    <div id="app">
      <a class="sr-only focus:not-sr-only" href="#main">
        {{ __('Skip to content') }}
      </a>

      @include('sections.header', [
        'sectors' => isset($sectors) ? $sectors : get_terms([
            'taxonomy' => 'sector',
            'hide_empty' => false,
          ])
      ])

      <main id="main" class="main">
        @yield('content')
      </main>

      @hasSection('sidebar')
        <aside class="sidebar">
          @yield('sidebar')
        </aside>
      @endif

      @include('sections.footer')
    </div>

    @stack('scripts')

    @php(do_action('get_footer'))
    @php(wp_footer())
  </body>
</html>
