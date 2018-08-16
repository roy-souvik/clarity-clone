@extends('layouts.admin')
@section('admin_content')

<div class="col-sm-8 information card">
<div class="p_bot10 card-content">

  <h3>Upload a New Photo</h3>
  {!! Form::model($photo, ['method' => 'POST', 'route' => 'savephoto', 'files' => true]) !!}
  {!! Form::label('name', 'Album Name:') !!} <br>
  {!! Form::select('name',$photo->album->getAlbumNames(), $photo->id, ['id' => 'add-photo', 'class' => 'form-control']) !!}<hr>
  {!! Form::file('new_picture', ['id' => 'new_picture']) !!}<hr>
  {{ Form::hidden('id', null) }}	
  {!! Form::submit('Submit', ['class' => 'pull-right btn btn-primary btn-lg']) !!}<hr>
  {!! Form::close() !!}

</div>
</div>

<div class="col-sm-4">
  @include('errors.list')
</div>
@endsection

 

