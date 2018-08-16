@extends('layouts.admin')

@section('admin_content')
<div class="row card">
  <div class="card-content">

  {!! Form::model($page, ['method' => 'PATCH', 'route' => 'savePages' ]) !!}

    {!! Form::label('title', 'Page Title:') !!} <br>

    {!! Form::select('title', $page->getPageTitles(), $page->id, ['id' => 'page-title', 'class' => 'form-control', 'placeholder'=>'Enter a page title']) !!}

    <textarea name="content" id="wysiwyg-editor"> {{$page->content}} </textarea>

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
