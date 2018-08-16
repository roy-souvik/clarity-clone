  <div class="form-group p_bot10">
    {!! Form::label('hourly_rate', 'Hourly Rate:') !!}
    {!! Form::select('hourly_rate', Config::get('monster_call.hourlyRates'), null, ['id' => 'hourly_rate', 'class' => 'form-control']) !!}
  </div>
