@extends('layouts.inner')

@section('content')

<div class="container">
<div class="dashinner">
<div class="col-sm-6">
<h3>Share Profile</h3>

<ul class="buttonlist1">
<li><a href="#"><span><i aria-hidden="true" class="fa fa-envelope"></i></span>Share by email<i aria-hidden="true" class="fa fa-chevron-right"></i></a></li>
<li><a href="#"><span><i aria-hidden="true" class="fa fa-facebook-square"></i></span>Share on Facebook<i aria-hidden="true" class="fa fa-chevron-right"></i></a></li>
<li><a href="#"><span><i aria-hidden="true" class="fa fa-twitter-square"></i></span>Share on Twitter<i aria-hidden="true" class="fa fa-chevron-right"></i></a>
</li>
<li><a href="#"><span><i aria-hidden="true" class="fa fa-google-plus-square"></i></span>Share on Google+<i aria-hidden="true" class="fa fa-chevron-right"></i></a>
</li>
<li><a href="#"><span><i aria-hidden="true" class="fa fa-linkedin-square"></i></span>Share on LinkedIn<i aria-hidden="true" class="fa fa-chevron-right"></i></a>
</li>

</ul>

</div>
<div class="col-sm-6">

<h3>Profile URL</h3>

<div class="p_bot30">
Hourly Rate<br>
<input name="" type="text" class="form-control">
</div>
</div>
</div>
</div>



@endsection