@extends('layouts.inner')
@section('content')

@include('common.flashMessage')


@if(count($appointments)>0)
    @foreach($appointments as $appointment)
        <article class="liveinner">
          <div class="row">
            <div class="col-sm-2 clientpic">
                <img src="{{ $appointment->user->getProfilePicture(true, 'normal') }}" alt="{{ $appointment->user->getFullName() }}">	
            </div>
            <div class="col-sm-6 ques">
                <h4><a href="javascript:void(0);">{{ $appointment->user->getFullName() }}</a></h4>
                <small>
                    <span class="status offline"></span>
                    <strong>{{ $appointment->user->getEmail() }}</strong>               
                </small>
                <p>{{ $appointment->getMessage() }}</p>
            </div>
            <div class="col-sm-4 priceright">
            	<em>CallLength:
                <strong>{{ $appointment->getCallLength() }}</strong></em>
                <br>
                <span class="viewbutt"><a href="{{ route('preCallDecision', ['appointment_id'=> $appointment->id]) }}"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;Take Decision</a></span>                
            </div>
         </div>
        </article>
    @endforeach 
@else

<h1>No calls pending approval</h1>


<h5>Any call request that would be awaiting approval from yourself, or other, would be listed here.</h5>


@endif 





@endsection
