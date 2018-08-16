@extends('layouts.inner')

@section('content')

<div class="container">

<h1>Live</h1>

<div class="live">
<h3>Past Recordings</h3>

@for($i=0 ; $i<=4; $i++)

<article class="liveinner">
<div class="row">
<div class="col-sm-2">
  <img src="assets/images/hqdefault.jpg" alt=""></div>
<div class="col-sm-6 ques">
<h4><a href="#">From Businessman to Business, Man: How to Build a Powerful...</a></h4>
<p>Michael Parrish DuDell • Bestselling Business Author and Keynote Speake</p>
</div>
<div class="col-sm-2 date"> February 23, 2016   </div>
<div class="col-sm-2">
<span class="viewbutt"><a href="#">VIEW</a></span>
</div>
</div>
</article>
@endfor

<div class="loadmore"><a href="#">Load more</a></div>
</div>
</div>

@endsection