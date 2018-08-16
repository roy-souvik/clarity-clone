@extends('layouts.inner')


@section('content')
<div class="innercatagory">
  <h1>Edit Profile</h1>
  <div class="row profile">

    <div class="col-sm-8">

      @include('common.flashMessage')

      <h3>Profile Settings</h3>

      <ul class="buttonlist">
        <li>
          <a href="{{ route('basic_info') }}">Basic Information<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
        </li>
        <li>
          <a href="{{ route('profile_img') }}">Profile Photo<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
        </li>
        <li>
          <a href="{{ route('verifications') }}">Verifications<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
        </li>
        <li>
          <a href="{{ route('topics') }}">Topics<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
        </li>
      </ul>

    @role('expert')
      <br>
        <h3>Expert Settings</h3>
        <ul class="buttonlist">
          <li>
            <a href="{{ route('all_expertises') }}">Expertise Listings<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
          </li>
          <li>
            <a href="{{ route('rate') }}">Hourly Rate<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
          </li>
          <li>
            <a href="{{ route('video') }}">Video<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
          </li>
        </ul>
      @endrole

</div>



    <div class="col-sm-4">

      <h3>Get More Calls</h3>

      <ul class="buttonlist">
        <li><a href="{{ route('share') }}">Share Your Profile<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
      </ul>
      <br>

    {{-- There will be further logic --}}
    @role('expert')
        <h3>Too Busy or On Vacation?</h3>
        <p>
          Convert to Member so you won't appear in search and won't get any new calls. You can revert back any time.
        </p>
        <a class="btn btn-success btn-block" href="{{ route('change_role') }}">Convert to Member</a>
        <br/>
    @endrole

    @role('user')
        @if($user->expert_applied == 0)
            <h3>Get Paid for Your Professional Advice</h3>
            <p>
              There's a world full of business owners and entrepreneurs out there who are seeking your valued advice and feedback.
            </p>
            <a class="btn btn-success btn-block" href="@if($user->li_id != '') {{ route('expert-get-step1') }} @else {{ url('authenticate/linkedin')}} @endif">Apply To Be An Expert</a>
            <br/>
        @else
            <h3>Get Paid for Your Professional Advice</h3>
            <p>
                There's a world full of business owners and entrepreneurs out there who are seeking your valued advice and feedback.
            </p>
            @if($user->is_approved == 0)
                <a class="btn btn-warning btn-block disabled">Expert Application Pending Review</a>
            @else
                <a href="{{ route('change_role') }}" class="btn btn-success btn-block">Convert to Expert</a>
            @endif
            <br/>
        @endif
    @endrole

    </div>

  </div>
</div>

@endsection
