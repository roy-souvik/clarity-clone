@extends('layouts.admin')

@section('admin_content')


<div class="col-sm-8 information card">

  <div class="p_bot10 card-content">

    {!! Form::model($charity, ['method' => 'PATCH', 'route' => ['updatecharity'] ]) !!}
    <div class="col-md-12 form-group">
      {!! Form::label('name', 'Charity Name:') !!}
      {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder'=> 'Enter charity name here']) !!}

      {{ Form::hidden('id', null) }}
      {!! Form::submit('Submit', ['class' => 'btn btn-primary btn-lg']) !!}
    </div>

   {!! Form::close() !!}

  </div>

  <div class="col-md-12 rightpicpart">
      @include('errors.list')
  </div>

</div>
@endsection
