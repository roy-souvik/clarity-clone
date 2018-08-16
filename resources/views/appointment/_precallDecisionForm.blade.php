  <div class="p_bot30">
    <u>Message from <b>{{ $appointment->user->getFullname() }}</b> </u> :
    <br>
    {{ $appointment->getMessage() }}
  </div>

  {{--
  <div class="p_bot30">
    Call Length : <br>
    <b> {{ $appointment->getCallLength() }} mins </b>
  </div>
  --}}

  <h3> <span>2</span>Requested Time options given by {{ $appointment->user->getFullname() }} </h3>

<div class="p_bot30">

  <div class="row">
    <div class="col-sm-12 col-xs-12">

      {{Form::radio('selected_slot', 1, false, ['id' => 'time_preference_1'])}}
      {{ Form::label('time_preference_1', 'Slot 1 : ' . $appointment->time_preference_1) }}
      <br/>

      {{Form::radio('selected_slot', 2, false, ['id' => 'time_preference_2'])}}

      {{ Form::label('time_preference_2', 'Slot 2 : ' . $appointment->time_preference_2) }}

      <br/>

      {{Form::radio('selected_slot', 3, false, ['id' => 'time_preference_3'])}}
      {{ Form::label('time_preference_3', 'Slot 3 : ' . $appointment->time_preference_3) }}

      <br/>

      {{Form::radio('selected_slot', 0, false, ['id' => 'time_preference_4'])}}
      {{ Form::label('time_preference_4', 'I dont want to take the call.') }}

      <br/>

      Duration :   {{ $appointment->getCallLength() }} <br/>
    </div>
  </div>

  <div class="shorttext">Please note that the times you choose will be 9.5 hours earlier for {{ $appointment->expert->getFullname() }} (EDT)</div>

</div>

<div class="p_bot30">
Timezone of {{ $appointment->user->getFullname() }}<br>
{!! Form::text('timezone', $appointment->user->timezone, ['disabled'=>'','class' => 'form-control']) !!}
</div>
