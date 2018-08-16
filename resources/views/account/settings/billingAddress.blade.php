@extends('layouts.inner')

@section('content')
<div class="innercatagory">
  <div class="row profile">
    <div class="col-sm-12 information">

      <h3>Please provide your Billing info.</h3>

      {!! Form::model($user, ['method' => 'PATCH', 'action' => ['AccountController@updateBillingInfo'] ]) !!}

      @include('account.settings.billingInfoFormFields')

      <div class="geenbutt">
        {!! Form::submit('Save Information', ['class' => 'btn btn-primary btn-lg']) !!}
      </div>

      {!! Form::close() !!}

     </div>
  </div>
</div>

<div class="col-sm-6">
  @include('errors.list')
</div>
@endsection
