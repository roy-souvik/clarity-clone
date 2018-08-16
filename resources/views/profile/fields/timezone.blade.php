<div class="p_bot30">
    {!! Form::label('time_zone', 'Your Timezone') !!}
    {!! Form::select('timezone', Config::get('monster_call.timezones'), null, ['id' => 'time_zone', 'class' => 'form-control']) !!}
    <div class="shorttext">This is never shared and only used to send you notifications.</div>
</div>