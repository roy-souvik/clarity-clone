@extends('layouts.inner')


@section('content')

<div class="col-sm-8 information">

  <h3>Upload a New Profile Photo </h3>

  <div class="uplpadphoto">
    <img src="/uploads/profile-pictures/normal/{{ $user->profile_picture }}" alt="profile image">
  </div>

  <!-- <form enctype="multipart/form-data" action="{{ route('update_profile_img') }}" method="POST">
    <input type="file" name="profile_picture" id="profile_picture">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" class="pull-right btn btn-primary btn-sm">
  </form> -->

  {!! Form::model($user, ['method' => 'POST', 'route' => 'update_profile_img', 'files' => true]) !!}

  {!! Form::file('profile_picture', ['id' => 'profile_picture']) !!}

  {!! Form::submit('Submit', ['class' => 'pull-right btn btn-primary btn-lg']) !!}

  {!! Form::close() !!}


</div>

<div class="col-sm-4">
  @include('errors.list')
</div>

@endsection
