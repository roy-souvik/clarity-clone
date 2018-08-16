<ul id="slide-menu" class="side-nav fixed" data-simplebar-direction="vertical" style="width: 240px;">
  <div class="simplebar-track">
    <div class="simplebar-scrollbar" style="top: 2px; height: 615px;"></div>
  </div>
  <div class="simplebar-scroll-content" style="height : 625px;">
    <div class="simplebar-content">
      <ul class="side-nav-main">
        <li class="logo hide-on-med-and-down green darken-4">
          <img src="{{ url('/assets/images/logo.png') }}" title="{{Config::get('monster_call.site_name')}}" alt="{{Config::get('monster_call.site_name')}} logo" class="logo responsive-img">
        </li>

    <li class="side-nav-inline hide-on-med-only">
      <!-- <a href="#" class="inline waves-effect" target="_blank">
        <i class="mdi-action-exit-to-app"></i>
      </a>
      <a href="#" class="inline waves-effect"><i class="mdi-action-perm-identity"></i>
      </a>
      <a href="#" class="inline waves-effect modal-trigger"><i class="mdi-action-search"></i></a> -->
    </li>

    <li>
      <a href="{{ route('admin_dashboard') }}" class="waves-effect"> <span>Dashboard</span> </a>
    </li>

    <li>
        <ul class="collapsible" data-collapsible="accordion">
          <li>
            <a class="collapsible-header active waves-effect">
              <span>Manage</span>
              {{-- <span class="neutral badge">2</span> --}}
            </a>
            <div class="collapsible-body" style="">
              <ul>
                <li>
                    {{ link_to_route('reviewexperts', 'Expert Applications') }}
                </li>
                <li class="divider"></li>
                <li>
                    {{ link_to_route('categories', 'Categories') }}
                </li>
                <li class="divider"></li>
                <li>
                    {{ link_to_route('manageusers', 'Users') }}
                </li>
                <li class="divider"></li>
                <li>
                  {{ link_to_route('managetags', 'Tags') }}
                </li>
                <li class="divider"></li>
                <li>
                  {{ link_to_route('managecharity', 'Charities') }}
                </li>
                <li class="divider"></li>
                <li>
                  {{ link_to_route('manage-expertise', 'Expertise') }}
                </li>
                <li class="divider"></li>
                <li>
                  {{ link_to_route('managepage', 'Pages', ['id'=>1]) }}
                </li>
                <li class="divider"></li>
                <li>
                  {{ link_to_route('manageemail', 'Emails', ['id'=>1]) }}
                </li>
                <li class="divider"></li>
                <li>
                  {{ link_to_route('managephoto', 'Photos') }}
                </li>
              </ul>
            </div>
          </li>

        </ul>
      </li>
    </ul>

  </div>
 </div>
</ul>
