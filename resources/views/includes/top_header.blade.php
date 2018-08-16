<section class="topheader">

  <div class="container">

    <span class="phone">
      <i aria-hidden="true" class="fa fa-phone"></i>{{Config::get('monster_call.site_phone')}}
    </span>

    <span class="email"><i aria-hidden="true" class="fa fa-envelope-o"></i>
      <a href="mailto:{{Config::get('monster_call.site_email')}}">{{Config::get('monster_call.site_email')}}</a>
    </span>
    @if (Auth::guest())

	<span class="rightlink">

		<input type="hidden" id="popup-action-required" name="popup-action-required" @if (isset($popup)) value="{{$popup}}" @endif  >

		<a href="#" data-toggle="modal" data-target="#signUpModalDiv" id="signUpModalDiv-popup-link" >Sign Up</a>     |
		<a href="#" data-toggle="modal" data-target="#loginModalDiv"  id="loginModalDiv-popup-link" >Log In</a>

    </span>

	@else

	<span class="rightlink">
          {{ link_to_route('my_profile', 'Welcome ' . Auth::user()->getFirstName() ) }}
          |
          <a href="{{ url('/logout') }}">Logout</a>
    </span>

	@endif
    <div class="clearfix"></div>


	@include('auth.login')
	@include('auth.register')

  </div>  <!--  Container close -->

</section>
