@extends('layouts.inner')

@section('content')
<div class="innercatagory">

  <div class="row profile">

      <div class="col-sm-8 information">

        <h3>Connect social accounts to add credibility</h3>

        <a href="{{ route('verifications',['social'=>'li', 'action'=>$user->li_id != '' ? 'disconnect' : 'connect']) }}">
          <div class="{{ $user->li_id != '' ? 'socialconnected' : 'socialdisconnected' }}">
            <span class="spaleft"><i aria-hidden="true" class="fa fa-linkedin-square"></i>Linkedin</span>
            <span class="spanright">{{ $user->li_id != '' ? 'Connected' : 'Disconnected' }}</span>
            <div class="clearfix"></div>
          </div>
        </a>

        <a href="{{ route('verifications',['social'=>'tw', 'action'=>$user->tw_id != '' ? 'disconnect' : 'connect']) }}">
          <div class="{{ $user->tw_id !== '' ? 'socialconnected' : 'socialdisconnected' }}">
            <span class="spaleft"><i aria-hidden="true" class="fa fa-twitter-square"></i>Twitter</span>
            <span class="spanright">{{ $user->tw_id !== '' ? 'Connected' : 'Disconnected' }}</span>
            <div class="clearfix"></div>
          </div>
        </a>
        <a href="{{ route('verifications',['social'=>'fb', 'action'=>$user->fb_id != '' ? 'disconnect' : 'connect']) }}">
          <div class="{{ $user->fb_id !== '' ? 'socialconnected' : 'socialdisconnected' }}">
            <span class="spaleft"><i aria-hidden="true" class="fa fa-facebook-square"></i>Facebook</span>
            <span class="spanright">{{ $user->fb_id !== '' ? 'Connected' : 'Disconnected' }}</span>
            <div class="clearfix"></div>
          </div>
        </a>


      </div>

        <div class="col-sm-4 rightpicpart"> &nbsp; </div>
    </div>
</div>

@endsection
