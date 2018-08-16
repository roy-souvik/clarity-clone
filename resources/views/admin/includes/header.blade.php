<header>
  <!-- Navigation Bar on the top, for medium and small devices -->
  <div class="brand-logo hide-on-large-only">
    <img src="{{ url('/assets/images/logo.png') }}" title="{{Config::get('monster_call.site_name')}}" alt="{{ Config::get('monster_call.site_name') }} logo" class="logo responsive-img">
  </div>

  <div class="navbar-fixed hide-on-large-only">
    <nav>
      <div class="nav-wrapper">
        <ul class="right">
          <li> {{ link_to('/', 'Frontend') }} </li>
          <li> {{ link_to('/logout', 'Logout') }} </li>
          <li class="toogle-side-nav">
            <a href="#" data-activates="slide-menu" class="button-collapse">
              <i class="material-icons">menu</i>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </div>

  <!-- Side Navigation - fixed for large (nice scroll with Simplebar plugin), slide/drag for medium and small devices -->
  @include('admin.includes.sidebar')

  <nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li> {{ link_to('/', 'Frontend') }} </li>
        <li> {{ link_to('/logout', 'Logout') }} </li>
      </ul>
    </div>
  </nav>

</header>
