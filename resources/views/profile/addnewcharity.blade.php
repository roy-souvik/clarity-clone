@extends('layouts.inner')

@section('content')


<div class="col-sm-8 information">

  <h3>Add any Charity of your choice and we'll connect with them to complete their profile.</h3>

  <div class="p_bot10">

    {!! Form::open(['method' => 'PATCH', 'action' => ['ProfileController@addcharity'] ]) !!}
    <div class="col-md-12 form-group">
      {!! Form::label('New_Charity', 'Charity Website:') !!}
      {!! Form::text('url', null, ['class' => 'form-control','placeholder'=>'Enter a charity website(http://example.com)']) !!}

      <hr>
      {!! Form::submit('Submit', ['class' => 'btn btn-primary btn-lg']) !!}
    </div>

   {!! Form::close() !!}

  </div>

  <div class="col-md-12 rightpicpart">
      @include('errors.list')
  </div>

</div>
@stop
