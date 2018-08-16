@extends('layouts.main')

@section('banner')
  @include('includes.banner')
@endsection


@section('content')
<section>
<div class="container">
<div class="howitworks_part">

<h1>How it <span>works</span></h1>

<div class="row">
<div class="col-sm-6">

<div class="how_inner">
<div class="how_innertop">
<img src="assets/images/icon1.jpg" alt=""> <br>
Step-by-Step </div>

<div class="searchheight">
<div class="rounddiv">
<img src="assets/images/round_icon1.png" alt="">
<h3>Find an Expert</h3>
<p>Browse our community of experts to find the right one for you.</p>
<div class="clearfix"></div>
</div>
<div class="rounddiv">
<img src="assets/images/round_icon2.png" alt="">
<h3>Request a Call</h3>
<p>Browse our community of experts to find the right one for you. </p>
<div class="clearfix"></div>
</div>
<div class="rounddiv">
<img src="assets/images/round_icon3.png" alt="">
<h3>Connect Directly</h3>
<p>Browse our community of experts to find the right one for you.</p>
<div class="clearfix"></div>
</div>
</div>

<span class="graybutt"><a href="#">Find Experts</a></span>



</div>

</div>
<div class="col-sm-6">

<div class="how_inner1">
<div class="how_innertop">
<img src="assets/images/icon2.jpg" alt=""> <br>
SEARCH Topics </div>
<div class="searchheight">
<div class="search_div">
<input name="" type="text" placeholder="Search topic" class="search_divfield">
<input name="" type="button" class="searchicon1">
<div class="clearfix"></div>
</div>
<div class="row">
<div class="col-sm-6">
<ul class="list">
    <li><a href="#">Entrepreneurship</a></li>
    <li><a href="#">Marketing Strategy</a></li>
    <li><a href="#">Start-ups</a></li>
    <li><a href="#">Social Media Marketing</a></li>
    <li><a href="#">Social Media</a></li>
    <li><a href="#">Business Strategy</a></li>
</ul>

</div>
<div class="col-sm-6">

<ul class="list">
    <li><a href="#">Online Marketing</a></li>
    <li><a href="#">Business Development</a></li>
    <li><a href="#">Digital Marketing</a></li>
    <li><a href="#">Marketing</a></li>
    <li><a href="#">SEO</a></li>
    <li><a href="#">Strategic Planning</a></li>
</ul>

</div>
</div>


</div>

<span class="graybutt"><a href="#">View All Topics</a></span>





</div>


</div>
</div>


</div>
</div>
<section class="catagorypart">
<div class="container">

<h1>OUR <span>categories</span></h1>

<ul class="catagorylist">
	@include('category.partials.categories-8icon')
</ul>
<div class="clearfix"></div>


</div>
</section>
<section class="expert_part">
<div class="container">
<div class="row">
<div class="col-sm-4"><h3>Are you an Expert?</h3></div>
<div class="col-sm-4 middletext">Join a community of passionate experts and thought-leaders who are being sought out by fellow entrepreneurs.</div>
<div class="col-sm-4">

<span class="joinus"><a href="#">JOIN US</a></span>
<div class="clearfix"></div>

</div>
</div>
</div>
</section>
<section class="graypart">
<div class="container">
<div class="row">

<div class="col-sm-6 leftlisting">

<h3>Neque porro quisquam est qui dolorem quia</h3>
<ul>
<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard </li>
<li>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</li>
<li>It is a long established fact that a reader will be distracted by the readable content of a page when.</li>
<li>Contrary to popular belief, Lorem Ipsum is not simply random text.</li>
<li>There are many variations of passages of Lorem Ipsum available, but the majority</li>
</ul>

</div>
<div class="col-sm-6">



<div id="owl-demo" class="owl-carousel testislider">

                <div class="item">
            <img src="assets/images/testi_pic1.jpg" alt="" class="testisliderpic">
            <h4>Vestibulum pharetra</h4>
            Founders of Pitchbox

           <div class="cont_texti">
           <div class="invited"><img src="assets/images/inviterd.png" alt=""></div>
           <p>Curabitur nec lobortis nunc. Nam ut dolor ut purus cursus ultricies. Curabitur ac tempor erat. Quisque vitae turpis risus. Phasellus malesuada et augue nec egestas. ....</p>

           </div>


            </div>
                <div class="item">
            <img src="assets/images/testi_pic2.jpg" alt="" class="testisliderpic">
            <h4>Vestibulum pharetra</h4>
            Founders of Pitchbox

           <div class="cont_texti">
           <div class="invited"><img src="assets/images/inviterd.png" alt=""></div>
           <p>Curabitur nec lobortis nunc. Nam ut dolor ut purus cursus ultricies. Curabitur ac tempor erat. Quisque vitae turpis risus. Phasellus malesuada et augue nec egestas. ....</p>

           </div>


            </div>
                <div class="item">
            <img src="assets/images/testi_pic3.jpg" alt="" class="testisliderpic">
            <h4>Vestibulum pharetra</h4>
            Founders of Pitchbox

           <div class="cont_texti">
           <div class="invited"><img src="assets/images/inviterd.png" alt=""></div>
           <p>Curabitur nec lobortis nunc. Nam ut dolor ut purus cursus ultricies. Curabitur ac tempor erat. Quisque vitae turpis risus. Phasellus malesuada et augue nec egestas. ....</p>

           </div>


            </div>

              </div>





</div>


</div>
</div>
</section>
</section>

@endsection
