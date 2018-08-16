@extends('layouts.inner')


@section('content')
			<h1>Public Profile</h1>
			<div class="expert">
				<div class="row">
					<div class="col-sm-8">
            <article class="liveinner">
							<div class="row">
								<div class="col-sm-2 clientpic">
									<img src="/uploads/profile-pictures/normal/{{ $user->getProfilePicture() }}" alt="{{ $user->getFullName() }}">
                </div>
								<div class="col-sm-10 ques">
									<h4>{{ $user->getFullName() }} </h4>
									<small>
										<i aria-hidden="true" class="fa fa-map-marker"></i>&nbsp; {{ $user->getLoction() }}
									</small>
									<p>{{ $user->getShortBio() }}
										{{-- <a href="#">More..</a> --}}
									</p>
								</div>
							</div>
						</article>
						<br>

						@if($user->hasExpertise())
	            <h5>Areas of Expertise</h5>
							<article class="liveinner1">
	              @foreach($user->expertise()->get() as $expertise)
	                <div class="row">
	  								<div class="col-sm-2 clientpic">
	  									<img src="/uploads/expertise-cover-images/{{$expertise->cover_image}}" alt="cover image">
	                  </div>
	  								<div class="col-sm-10 ques">
	  									<h4><a href="#">{{$expertise->title}}</a> </h4>
	  									<small>
	  										<span class="status offline"></span>
	  										<strong>{{ $user->getFullName() }}</strong>
	  										<em>•</em>
	  										<span>{{ $user->getLoction() }}</span>
	  									</small>
	  									<p>{{$expertise->description}}</p>
	  								</div>
	  							</div>
	              @endforeach
							</article>

							<div class="reviewbutt">
								<div class="reviewpoint">Review <span>({{ $user->getExpertiseFeedback()->count() }})</span></div>
								<div class="clearfix"></div>
							</div>
							<div class="reviewpart">

								@if($user->getExpertiseFeedback()->count() > 0)
									@foreach($user->getExpertiseFeedback() as $feedback)
										<div class="testiinner">
											<img src="{{ $user->getProfilePicture('true') }}" alt="{{ $user->getFullName() }}" class="testiinnerpic">
											<p>{{ $feedback->getDescription() }}</p>
											<div class="author">
												<span class="left greentext"><i aria-hidden="true" class="fa fa-user"></i>&nbsp;
													{{ $feedback->appointment->user->getFullName() }}
												</span>
												<span class="right">
													<i aria-hidden="true" class="fa fa-calendar"></i>
													&nbsp;{{  $feedback->getCreatedAt() }}</span>
												<div class="clearfix"></div>
											</div>
										</div>
									@endforeach
								@else
									<h6>No reviews yet</h6>
								@endif

							</div>
						@endif

					</div>

					<div class="col-sm-4">
					<div class="right_sec">
						<strong class="price">${{ $user->getHourlyRateInMins() }}</strong>
						<small>/ minute</small>
						<div class="star">
							{!! displayStarRatings($user->getAverageRating()) !!}
							({{ $user->getExpertiseFeedback()->count() }})
						</div>
						<span class="requestcall">
              <a href="{{ route('precall', ['username'=> $user->username]) }}"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;Request a Call</a>
            </span>
						<span class="message">
              <a href="#"><i aria-hidden="true" class="fa fa-envelope"></i>&nbsp;Send a Message</a>
            </span>
						<button class="buttmessage"><i aria-hidden="true" class="fa fa-heart"></i>&nbsp;Save to Favorites
            </button>saved 5 times
					</div>
					<div class="right_sec">
						<div class="callreview">
							<ul>
								<li> <span>2</span><br>Calls</li>
								<li> <span>{{ $user->getExpertiseFeedback()->count() }}</span><br>Reviews</li>
							</ul>
						<div class="clearfix"></div>
					</div>
					<div class="emailpart">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td><i aria-hidden="true" class="fa fa-heart"></i></td>
								<td>{{ $user->getFullName() }}
									@if($user->hasCharity())
										donates to<br>{{ $user->charity->getUrl() }} ($00.00)
									@endif
								</td>
							</tr>
						</table>
					</div>
					<div class="verified">
						<strong>Verified</strong><br>
						<a href="#"><i aria-hidden="true" class="fa fa-facebook"></i></a>
						<a href="#"><i aria-hidden="true" class="fa fa-linkedin"></i></a>
						<a href="#"><i aria-hidden="true" class="fa fa-twitter"></i></a>
						<a href="#"><i aria-hidden="true" class="fa fa-phone"></i></a>
						<div class="clearfix"></div>
					</div>
					<div class="buttlist">
						<ul>
              @foreach($user->tags()->get() as $tag)
                <li><a href="javascript:void(0);">{{ $tag->getName() }}</a></li>
              @endforeach
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="sharepart">
						Share on &nbsp;<i aria-hidden="true" class="fa fa-facebook-square"></i><i aria-hidden="true" class="fa fa-twitter-square"></i><i aria-hidden="true" class="fa fa-linkedin-square"></i> and more
					</div>
					<div class="member">Member since {{ $user->getCreatedAt() }} </div>
				</div>
			</div>

		</div>
	</div>
@endsection
