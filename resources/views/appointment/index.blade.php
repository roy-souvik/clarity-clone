@extends('layouts.inner')

@section('content')

<div class="container">
<div class="innercatagory">
  <h1>precall</h1>
    <div class="row">
      <div class="col-sm-8 leftprecall">
        <h3> <span>1</span>Provide Call Information </h3>

        {!! Form::model($data->user, ['method' => 'POST', 'route' => ['save_precall'] ]) !!}

          @include('appointment._precallForm')

        {{ Form::hidden('id', $data->expertuser->id) }}
        {!! Form::submit('Book Now', ['class' => 'btn btn-primary btn-lg']) !!}
        {!! Form::close() !!}
  </div>

  <div class="col-sm-4 rightpicpart">
    <img src="{{ $data->expertuser->getProfilePicture(true,'thumbs') }}" alt="" class="rightprofile">
    <strong>{{$data->expertuser->username}}</strong><br>
    {{$data->expertuser->location}}<br>
    ${{$data->expertuser->getHourlyRateInMins()}}/min
    <div class="clearfix"></div>
  </div>

  </div>
</div>

  <div class="col-md-12 rightpicpart">
    @include('errors.list')
  </div>

</div>

@endsection
