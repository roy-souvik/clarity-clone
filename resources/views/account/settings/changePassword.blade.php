@extends('layouts.inner')

@section('content')

<div class="row profile">

  <div class="col-sm-8 information">

    <h3>Change Your Password </h3>

    {!! Form::open(['method' => 'PATCH', 'action' => ['AccountController@updatePassword'] ]) !!}
      <div class="p_bot30">
        New Password<br>
        {!! Form::password('new_password', ['class' => 'form-control']) !!}
      </div>

      <div class="p_bot30">
        Confirm Password<br>
        {!! Form::password('new_password_confirmation', ['class' => 'form-control']) !!}
      </div>

      {{-- {!! Form::hidden('old_password', $user->password) !!} --}}

      {!! Form::submit('Confirm', ['class' => 'btn btn-primary btn-lg']) !!}

    {!! Form::close() !!}

  </div>

  <div class="col-sm-4 rightpicpart">
    @include('errors.list')
  </div>

</div>
@endsection
