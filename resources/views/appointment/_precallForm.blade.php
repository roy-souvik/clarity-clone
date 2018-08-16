  <div class="p_bot30">
    Select Expertise<br>
    {!! Form::select('expertise_id', $data->expertises, null, ['id' => 'expertise_id', 'class' => 'form-control']) !!}
  </div>

  <div class="p_bot30">
    Message to {{$data->expertuser->username}}<br>
    {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
  </div>

  <div class="p_bot30">
    Set Estimated Length<br>
    {!! Form::select('call_length', Config::get('monster_call.callLength'), null, ['id' => 'calllength', 'class' => 'form-control']) !!}
  </div>
  <div class="p_bot30">
    Full Name *<br>
    {!! Form::text('fullname', $data->user->getFullname(), ['readonly'=>'', 'class' => 'form-control']) !!}
  </div>
  <div class="p_bot30">
    Email Address *<br>
    {!! Form::text('email', $data->user->email, ['readonly'=>'', 'class' => 'form-control']) !!}
    <a href="#" style="font-size:13px;">Already a member?</a>
  </div>
  <div class="p_bot30">
    Cell Phone *<br>
    {!! Form::text('phone', $data->user->phone, ['readonly'=>'','class' => 'form-control']) !!}
    <span style="font-size:13px;">Cell phone is only used for notifications. <a href="#">Learn more about how Clarity works.</a></span>
  </div>
  <h3> <span>2</span>Suggest Times When You're Free to Talk </h3>

<div class="p_bot30">

  <div class="row">
    <div class="col-sm-8 col-xs-7">
      {!! Form::text('date1',null, ['class' => 'form-control' , 'id' => 'datepicker1']) !!}
    </div>
    <div class="col-sm-4 col-xs-5">
      {!! Form::select('time1', Config::get('monster_call.callTime'), null, ['id' => 'calltime1', 'class' => 'form-control']) !!}
    </div>
  </div>

  <div class="row">
    <div class="col-sm-8 col-xs-7">
      {!! Form::text('date2',null, ['class' => 'form-control' , 'id' => 'datepicker2']) !!}
    </div>
    <div class="col-sm-4 col-xs-5">
      {!! Form::select('time2', Config::get('monster_call.callTime'), null, ['id' => 'calltime2', 'class' => 'form-control']) !!}
    </div>
  </div>

  <div class="row">
    <div class="col-sm-8 col-xs-7">
      {!! Form::text('date3',null, ['class' => 'form-control' , 'id' => 'datepicker3']) !!}
    </div>
    <div class="col-sm-4 col-xs-5">
      {!! Form::select('time3', Config::get('monster_call.callTime'), null, ['id' => 'calltime3', 'class' => 'form-control']) !!}
    </div>
  </div>

  <div class="shorttext">Please note that the times you choose will be 9.5 hours earlier for {{$data->expertuser->username}} (EDT)</div>

</div>

<div class="p_bot30">
Your Timezone<br>
{!! Form::text('timezone', null, ['readonly'=>'','class' => 'form-control']) !!}
</div>
