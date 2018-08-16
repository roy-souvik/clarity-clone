<div class="account_head">
  <div class="container">
    <div class="accountinner">

      <div class="row">
        <div class="col-sm-2 clientpic">
          <img src="/uploads/profile-pictures/normal/{{ $user->profile_picture }}" alt="profile image">
        </div>

        <div class="col-sm-7 ques">
          <h4><a href="{{ route('my_profile') }}">{{ $user->getFullName() }}</a></h4>
          <small>{{ $user->short_bio }}</small>
          <p>{{ $user->mini_resume }}</p>
        </div>

        <div class="col-sm-3 priceright">
          <strong>${{$user->getHourlyRateInMins()}}</strong><br>
          <small>per minute</small>
          <span class="viewbutt">
            {{ link_to('/public/' . $user->username, 'View Profile') }}
          </span>
          <div class="icombotpart">
            <a href="#"><i aria-hidden="true" class="fa fa-star"></i></a>--<a href="#"><i aria-hidden="true" class="fa fa-phone"></i></a>--<a href="#"><i aria-hidden="true" class="fa fa-comments"></i></a><sup>0</sup>
          </div>
        </div>
      </div>


    </div>
  </div>
</div>
