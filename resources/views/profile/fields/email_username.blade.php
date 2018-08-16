<div class="p_bot30">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', null, ['readonly' => '', 'class' => 'form-control']) !!}
</div>

<div class="p_bot30">
    {!! Form::label('username', 'Username') !!}
    {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => strtolower($user->first_name . '-' . $user->last_name)]) !!}
    <div class="shorttext">Your Public Profile is : <u>{{ url('/') . '/public/' . $user->username }}</u>  </div>
</div>