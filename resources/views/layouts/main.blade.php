<!doctype html>
<html>
@include('includes.head')

<body>

<header>

  @include('includes.top_header')

  @include('includes.bottom_header')

</header>

@yield('banner')

@yield('content')

@include('includes.footer')

@include('includes.site_assets')

</body>
</html>
