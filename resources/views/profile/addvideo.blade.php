@extends('layouts.inner')

@section('content')

<div class="col-sm-8 information">
  <h3>Add a video to your profile</h3>

  <div class="p_bot10">

    {!! Form::model($user, ['method' => 'PATCH', 'action' => ['ProfileController@storeVideo'] ]) !!}

    <div class="col-md-12 form-group">
      {!! Form::label('video_link', 'Video Link:') !!}
      {!! Form::text('video_link', null, ['class' => 'form-control','placeholder'=>'http://']) !!}

      <div class="shorttext">YouTube, Vimeo or Blip link. Other video support coming soon</div>

      <hr>
      {!! Form::submit('Save', ['class' => 'btn btn-primary btn-lg']) !!}
    </div>

   {!! Form::close() !!}

  </div>

  <div class="col-md-12 rightpicpart">
      @include('errors.list')
  </div>

</div>
@stop
