@extends('layouts.inner')

@section('content')


<div class="innercatagory">
  <h1>Account Settings</h1>
  <div class="row profile">

    <div class="col-sm-8">

    @include('common.flashMessage')

    <h3>Settings</h3>

    <ul class="buttonlist">
      <li><a href="{{ route('notifications') }}">Notifications<i class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
      <li>
        <a href="{{ route('changePassword') }}">Change Password<i class="fa fa-chevron-right" aria-hidden="true"></i></a>
      </li>
      <li>
        <a href="#">Delete Account
          <i class="fa fa-chevron-right" aria-hidden="true"></i>
        </a>
      </li>
    </ul>

    <br>

    </div>
    <div class="col-sm-4">
    <h3>Payments</h3>

    <ul class="buttonlist">

      <li>
        <a href="{{ route('money') }}">Money
          <i class="fa fa-chevron-right" aria-hidden="true"></i>
        </a>
      </li>

      <li>
        <a href="{{ route('creditCard') }}">Credit Card
          <i class="fa fa-chevron-right" aria-hidden="true"></i>
        </a>
      </li>

      <li>
        <a href="{{ route('billingAddress') }}">Billing Address
          <i class="fa fa-chevron-right" aria-hidden="true"></i>
        </a>
      </li>
    </ul>
    <br>


    </div>
  </div>
</div>
@endsection
