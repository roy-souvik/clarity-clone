@extends('layouts.inner')

@section('content')

<div class="col-md-12 rightpicpart">
  @include('errors.list')
</div>

<div class="innercatagory">
  <div class="row profile">

  {!! Form::model($user, ['method' => 'PATCH', 'action' => ['AccountController@updateNotifications'] ]) !!}
    <div class="col-sm-12 information">

    <h3>Notifications</h3>

    <div class="p_bot20">

      <div class="row">
        <div class="col-sm-4">
         <strong>Call Requests</strong><br>
             <p>
               {{ Form::radio('call_requests', 1, null, ['id' => 'call_requests_yes']) }}
               {!! Form::label('call_requests_yes', 'Yes') !!}
               <br>
               {{ Form::radio('call_requests', 0, null, ['id' => 'call_requests_no']) }}
               {!! Form::label('call_requests_no', 'No') !!}
               <br>
             </p>
        </div>
        <div class="col-sm-4"><strong>Call Reminder</strong>
          <br>
            <p>
              {{ Form::radio('call_reminder', 1, null, ['id' => 'call_reminder_yes']) }}
              {!! Form::label('call_reminder_yes', 'Yes') !!}
              <br>
              {{ Form::radio('call_reminder', 0, null, ['id' => 'call_reminder_no']) }}
              {!! Form::label('call_reminder_no', 'No') !!}
              <br>
            </p>
        </div>

        <div class="col-sm-4"><strong>Monster Call Updates</strong><br>
            <p>
              {{ Form::radio('mc_updates', 1, null, ['id' => 'mc_updates_yes']) }}
              {!! Form::label('mc_updates_yes', 'Yes') !!}
              <br>
              {{ Form::radio('mc_updates', 0, null, ['id' => 'mc_updates_no']) }}
              {!! Form::label('mc_updates_no', 'No') !!}
              <br>
            </p>
        </div>
        </div>
      </div>

    <div class="p_bot20">
      <div class="row">
        <div class="col-sm-4"><strong>Call Management</strong>
          <br>
            <p>
              {{ Form::radio('call_management', 1, null, ['id' => 'call_management_yes']) }}
              {!! Form::label('call_management_yes', 'Yes') !!}
              <br>
              {{ Form::radio('call_management', 0, null, ['id' => 'call_management_no']) }}
              {!! Form::label('call_management_no', 'No') !!}
              <br>
            </p>
        </div>

          <div class="col-sm-4"><strong>Monster Call Questions</strong>
            <br>
              <p>
                {{ Form::radio('mc_questions', 1, null, ['id' => 'mc_questions_yes']) }}
                {!! Form::label('mc_questions_yes', 'Yes') !!}
                <br>
                {{ Form::radio('mc_questions', 0, null, ['id' => 'mc_questions_no']) }}
                {!! Form::label('mc_questions_no', 'No') !!}
                <br>
              </p>
          </div>
        </div>
      </div>

      <div class="geenbutt">
        {!! Form::submit('Save Notifications', ['class' => 'btn btn-primary btn-lg']) !!}
      </div>
    </div>

  {!! Form::close() !!}

  </div>
</div>

@endsection
