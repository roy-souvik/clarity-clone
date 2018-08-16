<header>
  @include(includes.top_header)
<section class="bottomheader">
<div class="container">

<div class="logo">
  <a href="{{ url('/') }}">
    <img src="images/logo.png" title="{{ ucfirst(Config::get('monster_call.site_name')) }}"  alt="{{ ucfirst(Config::get('monster_call.site_name')) }} logo">
  </a>
</div>

<section class="searchicon">
  <a href="javascript:toggle1();" id="displayText1">
    <img src="images/search_icon.png" alt=""></a>
  <div id="toggleText1" style="display:none;" class="search_link">
    <div class="serachinner">
      <img src="images/arrowtop.png" class="toparrow" alt="">
      <input name="" type="text" placeholder="Search here..." class="serachinner_field">
      <input name="" type="button" class="popsearch">
    </div>
  </div>
</section>

@include('includes.navigation')

</div>
</section>
</header>
