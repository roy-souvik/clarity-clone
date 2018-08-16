@extends('layouts.inner')

@section('content')

{!! Form::model($user, ['method' => 'POST', 'route' => ['expert-post-step1'] ]) !!}
    <div class="row profile">
        <div class="col-sm-8 information">
            <h3>{{ 'Welcome ' . Auth::user()->first_name . '!' }}</h3>
            <strong>Please take a moment to setup your expert account.</strong>
            @include('profile.fields.email_username')
            @include('profile.fields.phone')
            @include('profile.fields.timezone')
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
{!! Form::close() !!}

@endsection