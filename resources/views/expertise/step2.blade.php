@extends('layouts.inner')

@section('content')

{{ Form::model($user, ['method' => 'POST', 'route' => ['expert-post-step2'] ]) }}
  <div class="row profile">
    <div class="col-sm-8 information">
      <h3>Personalize your profile page</h3>
      <strong>Your profile page is where others can learn more about you when making calls.</strong>
        @include('profile.fields.short_bio_mini_resume')
        @include('profile.fields.hourly_rate_form_field')
          <div class="form-group p_bot20">
            <div class="geenbutt">
                <button class="btn btn-primary btn-lg" type="submit">Continue</button>
            </div>
          </div>

    </div>
    <div class="col-sm-4 rightpicpart">
      @include('errors.list')
    </div>
  </div>
{{ Form::close() }}

@endsection