<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>{{ $appointment->expert->getFullName() }} replied to your request</h2>

<div>
  Hi {{ $appointment->user->getFullName() }}
    <div>
        {!! html_entity_decode($email->getContents()) !!}<br/>
        The expert {{ $appointment->expert->getFullName() }} has replied.<br/>

        @if($appointment->isConfirmed())
          {{ $appointment->expert->getFullName() }} is ready to take the call on <b>{{ $appointment->getSelectedSlotsTime() }}</b>
          {{ link_to('/', 'click here to pay the call charges') }}
        @else
           {{ $appointment->expert->getFullName() }} will not be able to take the call on the requested time slots.
        @endif
        <br/>
    </div>
</div>
</body>
</html>
