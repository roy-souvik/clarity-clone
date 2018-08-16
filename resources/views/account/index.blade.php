@extends('layouts.inner')

@section('grey_head')
  @include('account.grey_head')
@endsection

@section('content')

<section class="dashinnerpage">

  <div class="container">
    <div class="dashinner">
    <div class="col-sm-8">
      <h3>Your Account</h3>
      <ul class="buttonlist">
      @role('expert')
        <li><a href="{{ route('money') }}">Money<i aria-hidden="true" class="fa fa-chevron-right"></i></a></li>
      @endrole

        <li>
          <a href="{{ route('my_profile') }}">Edit Profile<br>
            <i aria-hidden="true" class="fa fa-chevron-right"></i>
            <span>Basic Information, Hourly Rate, Areas of Expertise, Topics, Photo, Become an expert.</span>
          </a>
        </li>
        <li>
          <a href="{{ route('settings') }}">Settings<br>
            <i aria-hidden="true" class="fa fa-chevron-right"></i>
            <span>Notifications, Promotions, Credit Card, Change Password.</span>
          </a>
        </li>
        <li>
          <a href="#">Support<br>
            <i aria-hidden="true" class="fa fa-chevron-right"></i>
            <span>How It Works, Help Center, Terms of Service</span>
          </a>
        </li>
      </ul>

    </div>

      @role('expert')
        <div class="col-sm-4">
          <h3>Stats — Last 30 Days</h3>

          <div class="state">
            <ul>
              <li><i aria-hidden="true" class="fa fa-file-powerpoint-o"></i>Impressions from Clarity<span>7</span></li>
              <li><i aria-hidden="true" class="fa fa-hand-o-up"></i>Clicks from Impressions<span>0</span></li>
              <li><i aria-hidden="true" class="fa fa-eye"></i>Unique Pageviews<span>1</span></li>
              <li><i aria-hidden="true" class="fa fa-phone"></i>Call Requests<span>0</span></li>
              <li><i aria-hidden="true" class="fa fa-star-o"></i>Conversion Rate<span>10%</span></li>
            </ul>
          </div>
        </div>
      @endrole

    </div>
  </div>
</section>
@endsection
