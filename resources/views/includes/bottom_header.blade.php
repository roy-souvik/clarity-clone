<section class="bottomheader">
<div class="container">

<div class="logo">
  <a href="{{url('/')}}">
    <img src="{{ url('/assets/images/logo.png') }}" title="{{Config::get('monster_call.site_name')}}" alt="{{Config::get('monster_call.site_name')}} logo">
  </a>
</div>

@if (!Auth::guest())
<div class="username dropdown">
    <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <img src="{{ url('/uploads/profile-pictures/thumbs/' . Auth::user()->profile_picture) }}" alt="My Image">Me</a>

   <ul aria-labelledby="drop3" class="dropdown-menu">
     <li> {{ link_to_route('account', 'Account') }} </li>
     <li><a href="#">Calls</a></li>
     <li><a href="#">Inbox</a></li>
     <li> {{ link_to_route('my_profile', 'Edit Profile') }} </li>
     <li> {{ link_to_route('settings', 'Settings') }} </li>
     <li> <a href="{{ url('/logout') }}">Logout</a> </li>
  </ul>
</div>
@endif

@include('includes.searchForm')

<nav>
<a class="toggleMenu" href="#">Menu</a>

  <ul class="navi">
    @role('admin')
      <li> {{ link_to_route('admin_dashboard', 'Administration') }} </li>
    @endrole

    <!-- Current Categories -->

    @if (count($categories) > 0)
  	<li><a href="javascript:void(0);">Categories</a>
  		<ul>
          @each('category.fortopmenu.firstlevel', $categories, 'category')
  		</ul>
  	</li>
  	@else
  		<li><a href="javascript:void(0);">Ouch! No Categories Here</a></li>
  	@endif

    <li class="{{ setActive('dashboard') }}">
      <a href="{{ url('/dashboard') }}">Dashboard</a>
    </li>

    <li class="{{ setActive('questions') }}">
      <a href="{{ url('/questions')  }}">Answers</a>
    </li>

    <li class="{{ setActive('topics') }}">
       <a href="{{ url('/profile/topics')  }}">Topics</a>
    </li>
    <li><a href="#">Inbox</a></li>
    <li class="{{ setActive('live') }}">
    <a href="{{ url('/live') }}">Live</a>
    </li>
    
  </ul>
</nav>


</div>
</section>
