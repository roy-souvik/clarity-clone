<div class="p_bot10">
  {!! Form::label('first_name', 'First Name') !!}
  {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
</div>

<div class="p_bot30">
  {!! Form::label('last_name', 'Last Name') !!}
  {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>

@include('profile.fields.email_username')

@include('profile.fields.short_bio_mini_resume')

@include('profile.fields.phone')

<div class="p_bot30">
  {!! Form::label('location', 'Your Location') !!}
  {!! Form::text('location', null, ['class' => 'form-control']) !!}
</div>

@include('profile.fields.timezone')

<div class="form-group">
  {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary btn-lg']) !!}
</div>
