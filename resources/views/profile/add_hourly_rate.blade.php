@extends('layouts.inner')

@section('content')
@include('common.flashMessage')

<div class="col-sm-8 information">
  <h3>Your Hourly Rate</h3>

  <div class="p_bot30">

    {!! Form::model($data->user, ['method' => 'PATCH', 'action' => ['ProfileController@storeHourlyRate'] ]) !!}

    @include('profile.fields.hourly_rate_form_field')

    <div class="shorttext">Your hourly income after fees (15%): $51.00</div>

    <hr/>

      {!! Form::label('charity', 'Charity:') !!}
      {!! Form::select('charity', $data->charity, $data->user->charity_id, ['id' => 'charity', 'class' => 'form-control' , 'placeholder' => 'Select a charity From the List']) !!}

       <a href="{{ route('addcharities') }}" class="pull-right">
        <i aria-hidden="true" class="fa fa-plus"></i> Add New Charity
       </a>

      <hr/>

      {!! Form::submit('Save', ['class' => 'btn btn-primary btn-lg']) !!}

      {!! Form::close() !!}
  </div>
  </div>

<div class="col-md-12 rightpicpart">
    @include('errors.list')
</div>

@endsection
