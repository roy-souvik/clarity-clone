@extends('layouts.inner')

@section('content')
<div class="col-sm-6 col-md-offset-1">
  @include('errors.list')
</div>

<div class="innercatagory">
  <div class="row profile">

  <div class="col-sm-12 information">

    {!! Form::model($user, ['method' => 'PATCH', 'action' => ['AccountController@updateCCInfo'] ]) !!}
    <h3>Please provide your payment info.</h3>

    <div class="p_bot20">
      <div class="row">
        <div class="col-sm-4">
          Enter Your Credit Card Numbers<br>
          {!! Form::text('card_number', null, ['class' => 'form-control', 'placeholder' => 'Card Number']) !!}
        </div>

        <div class="col-sm-4">Enter Your CVV<br>
          {!! Form::text('cvv', null, ['class' => 'form-control', 'placeholder' => 'cc-cvc']) !!}
        </div>
      </div>
    </div>

    <div class="p_bot20">
      <div class="row">
        <div class="col-sm-4">
        Expiration<br>
        {!! Form::select('expire_month', Config::get('monster_call.months'), null, ['id' => 'country', 'class' => 'form-control']) !!}
        </div>

        <div class="col-sm-4">
        Year<br>
        {!! Form::select('expire_year', Config::get('monster_call.years'), null, ['id' => 'country', 'class' => 'form-control']) !!}
        </div>
      </div>
      <div class="shorttext">Note: Your information is kept 100% private!<br></div>
    </div>


    <h3>&nbsp;</h3>

    <h3>Please provide your Billing info.</h3>

    @include('account.settings.billingInfoFormFields')

    <div class="geenbutt">
    {!! Form::submit('Save Information', ['class' => 'btn btn-primary btn-lg']) !!}
    </div>

  {!! Form::close() !!}

   </div>
  </div>
</div>

@endsection
