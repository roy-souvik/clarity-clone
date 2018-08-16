@extends('layouts.inner')

@section('content')

<div class="col-sm-8 information">
<h3>Add topics that match your expertise</h3>

<div class="p_bot30">

{!! Form::model($tags, ['method' => 'POST', 'action' => ['TagsController@store'] ]) !!}
  <div class="col-md-12 form-group">
    {!! Form::label('tags', 'Add Topics:') !!}

    {!! Form::select('tags[]', $tags, $tags, ['id' => 'tags', 'class' => 'form-control','multiple']) !!}
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
