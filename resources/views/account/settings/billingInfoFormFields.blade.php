<div class="p_bot20">
  <div class="row">

    <div class="col-sm-4">
     Address 1<br>
       {!! Form::text('address_line1', null, ['class' => 'form-control', 'placeholder' => '123 Smith St.']) !!}
    </div>

    <div class="col-sm-4">Address 2<br>
    {!! Form::text('address_line2', null, ['class' => 'form-control', 'placeholder' => 'Optional']) !!}
    </div>

    <div class="col-sm-4">City<br>
      {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => 'New York']) !!}
    </div>

  </div>
</div>

<div class="p_bot20">
  <div class="row">

    <div class="col-sm-4">State/Province<br>
      {!! Form::text('state', null, ['class' => 'form-control', 'placeholder' => 'NY']) !!}
    </div>

    <div class="col-sm-4">Postal Code / ZIP<br>
      {!! Form::text('zip_code', null, ['class' => 'form-control', 'placeholder' => '10001']) !!}
    </div>

    <div class="col-sm-4" >
    Country<br>
      {!! Form::select('country', Config::get('monster_call.countries'), null, ['id' => 'country', 'class' => 'form-control']) !!}
    </div>
    
  </div>
</div>
