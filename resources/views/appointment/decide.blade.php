@extends('layouts.inner')

@section('content')

<div class="container">
<div class="innercatagory">
  <h1>precall : take action</h1>
    <div class="row">

      <div class="col-sm-8 leftprecall">
        <h3> <span>1</span>Call Information </h3>

        {!! Form::model($appointment, ['method' => 'PATCH', 'route' => ['updatePreCallDecision'] ]) !!}

          @include('appointment._precallDecisionForm')
          {{ Form::hidden('id', $appointment->id) }}

        {!! Form::submit('Send', ['class' => 'btn btn-primary btn-lg']) !!}
        {!! Form::close() !!}

      </div>

      <div class="col-sm-4 rightpicpart">
        <img src="{{ $appointment->user->getProfilePicture(true, 'thumbs') }}" alt="{{ $appointment->user->getFullname() }} profile picture" class="rightprofile">

        <strong>{{ $appointment->user->getFullname() }}</strong>
        <br>
        {{ $appointment->user->location }}<br>
        <div class="clearfix"></div>
      </div>

  </div>

</div>

<div class="col-md-12 rightpicpart">
    @include('errors.list')
</div>

</div>

@endsection
