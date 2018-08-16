<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>You have a new Appointment Request from <b>{{$data->user->getFullname()}}</b> </h2>

<div>
  Hi <b>{{$data->expert->getFullname()}}</b> ,
    <div>
        {!! html_entity_decode($data->mail->getContents()) !!} <br/>
        
        The user <b>{{$data->user->first_name}}</b> has requested a meeting with you.<br/>
        Meeting details:<br/>
        Slot1 = {{$data->appointment->time_preference_1}}<br/>
        Slot2 = {{$data->appointment->time_preference_2}}<br/>
        Slot3 = {{$data->appointment->time_preference_3}}<br/>
        Duration = {{$data->appointment->requested_call_length}} minutes<br/>
        Please follow the link below to confirm appointment<br/>
        <u>{{ link_to('/call/decision/' . $data->appointment->id, 'Click here', array(), null) }}.</u>
        <br/>
    </div>
</div>
</body>
</html>
