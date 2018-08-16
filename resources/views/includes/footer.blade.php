<footer>
<section class="contacttop">
<div class="container">

<div class="row">
<div class="col-sm-5 conleft">
<img src="{{ url('assets/images/phoneicon.png') }}" alt="" class="left p_rig10 p_top15">
FOR ANY<br>
<span>HELP OR QUERIES</span> </div>
<div class="col-sm-7 conright">

<span class="left p_top10">Call Us Now {{Config::get('monster_call.site_phone')}}</span>
<span class="contact"><a href="#">CONTACT</a></span>
<div class="clearfix"></div>


</div>
</div>


</div>
</section>
<section class="contactmidd">
<div class="container">

<div class="row">
<div class="col-sm-7 quicklink">

<h4>QUICK LINKS</h4>
<div class="row">
<div class="col-sm-4">
<ul>
<li><a href="{{url('/page/how-it-works')}}">How It Works</a></li>
<li><a href="{{url('/page/about-us')}}">About Us</a></li>
<li><a href="{{url('/page/feedback')}}">Feedback</a></li>
</ul>

</div>
<div class="col-sm-4">

<ul>
<li><a href="{{url('/page/community')}}">Community</a></li>
<li><a href="{{url('/page/trust-safety')}}">Trust : Safety</a></li>
<li><a href="{{url('/page/help-support')}}">Help : Support</a></li>
</ul>

</div>
<div class="col-sm-4">

<ul>
<li><a href="{{url('/page/terms-of-service')}}">Terms Of Service</a></li>
<li><a href="{{url('/page/privacy-policy')}}">Privacy Policy</a></li>
<li><a href="{{url('/page/cookie-policy')}}">Cookie Policy</a></li>
</ul>

</div>
</div>

</div>
<div class="col-sm-3">

<h4>CONTACT DETAILS</h4>
<p class="footcontact"><i aria-hidden="true" class="fa fa-map-marker"></i>&nbsp;roin ac libero tempor, facilisis est<br> eget Nullam blandit<br>
<i aria-hidden="true" class="fa fa-phone"></i>&nbsp; {{Config::get('monster_call.site_phone')}}<br>
<i aria-hidden="true" class="fa fa-globe"></i>&nbsp;www.{{Config::get('monster_call.site_name')}}<br>
<i aria-hidden="true" class="fa fa-envelope"></i>&nbsp; {{Config::get('monster_call.site_email')}} </p>

</div>
<div class="col-sm-2 social">

<h4>SOCIAL</h4>

<a href="{{Config::get('monster_call.site_fb_link')}}">
  <i aria-hidden="true" class="fa fa-facebook-square"></i>
</a>

<a href="{{Config::get('monster_call.site_linkedin_link')}}">
  <i aria-hidden="true" class="fa fa-linkedin-square"></i>
</a>

<a href="{{Config::get('monster_call.site_gplus_link')}}">
  <i aria-hidden="true" class="fa fa-google-plus-square"></i>
</a>

<a href="{{Config::get('monster_call.site_twitter_link')}}">
  <i aria-hidden="true" class="fa fa-twitter-square"></i>
</a>


</div>

</div>

</div>
</section>
  <section class="copyright">&copy;{{date('Y')}} Monstercall LLC.</section>
  <input type="hidden" name="baseUrl" id="baseUrl" value="{{ url('/') }}">
</footer>
