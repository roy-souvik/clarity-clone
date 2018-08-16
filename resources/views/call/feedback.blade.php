@extends('layouts.inner')

@section('content')

<div class="container">
<div class="innercatagory">
  <h1>Provide Feedback</h1>
    <div class="row">
    <div class="col-sm-8 leftprecall">

    {!! Form::model($data->user, ['method' => 'POST', 'route' => ['saveFeedback'] ]) !!}
      
      <p> You are providing Feedback for <b>{{ $data->appointment->expert->getFullName() }}</b> ( {{$data->appointment->expert->getEmail()}} )</p>
      
      <div class="p_bot30">
	    Title *<br>
	    {!! Form::text('title', null , ['class' => 'form-control']) !!}
	  </div>

	  <div class="p_bot30">
	    Description (optional) *<br>
	    {!! Form::text('description', null , ['class' => 'form-control']) !!}
	  </div>

	  <div class="p_bot30">
	    Rating *<br>
	    {!! Form::select('rating', Config::get('monster_call.rating'), null, ['id' => 'rating', 'class' => 'form-control']) !!}
	  </div>

	  {{ Form::hidden('id', $data->user->id) }}

	  {{ Form::hidden('appointment_id', $data->appointment->id) }}

	  {{ Form::hidden('call_id', $data->call_id) }}


	  {!! Form::submit('Save Feedback', ['class' => 'btn btn-primary btn-md']) !!}

	  {!! Form::close() !!}
	  
</div>


  </div>
</div>

  <div class="col-md-12 rightpicpart">
    @include('errors.list')
  </div>

</div>


@endsection