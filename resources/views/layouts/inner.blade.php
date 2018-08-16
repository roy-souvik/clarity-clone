<!doctype html>
<html>
@include('includes.head')

<body>
  <header>
    @include('includes.top_header')
    @include('includes.bottom_header')
  </header>

  @yield('grey_head')
  
    <section class="innerpage">
      <div class="container" >
          <div class="row">

            @yield('content')

          </div>
        </div>
    </section>

    @include('includes.footer')

    @include('includes.site_assets')

  </body>
</html>
