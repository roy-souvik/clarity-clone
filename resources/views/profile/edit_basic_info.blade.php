@extends('layouts.inner')


@section('content')

  <div class="col-sm-8 information">

  <h3>Provide Call Information </h3>


  {!! Form::model($user, ['method' => 'PATCH', 'action' => ['ProfileController@updateBasicInfo'] ]) !!}

    @include('profile.basic_info_form_fields', ['submitButtonText' => 'Save'])

  {!! Form::close() !!}

  </div>


  <div class="col-sm-4 rightpicpart">
      @include('errors.list')
  </div>

@endsection
