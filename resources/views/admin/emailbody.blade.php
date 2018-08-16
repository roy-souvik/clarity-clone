@extends('layouts.admin')

@section('admin_content')
<div class="row card">
  <div class="card-content">

  {!! Form::model($email, ['method' => 'PATCH', 'route' => 'saveEmail' ]) !!}

    {!! Form::label('subject', 'Email Subject:') !!} <br>

    {!! Form::select('subject', $email->getEmailSubjects(), $email->id, ['id' => 'email-subject', 'class' => 'form-control']) !!}

    <textarea name="content" id="wysiwyg-editor"> {{$email->content}} </textarea>

  <hr>

  {{ Form::hidden('id', null) }}
  {!! Form::submit('Save', ['class' => 'btn btn-primary btn-lg']) !!}

  {!! Form::close() !!}

  </div>
  <div class="col-md-12 rightpicpart">
    @include('errors.list')
  </div>


</div>

@endsection
