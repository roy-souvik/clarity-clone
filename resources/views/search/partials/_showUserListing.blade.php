@if(count($users))
  @foreach($users as $user)
    <article class="liveinner">
        <div class="row">
            <div class="col-sm-2 clientpic">
                <img src="{{ $user->getProfilePicture(true) }}" alt="{{$user->getFullName()}} profile-picture"></div>
            <div class="col-sm-6 ques">
                <h4><a href="javascript:void(0);">{{ $user->getFullName() }}</a></h4>
                <small>
                    <span class="status offline"></span>
                    <strong>{{ wordlimit($user->getShortBio(), 20) }}</strong>
                    <em>&bull;</em>
                    <span>{{ $user->location }}</span>
                </small>
                <p>{{ wordlimit($user->getMiniResume(), 50) }}</p>
            </div>
            <div class="col-sm-4 priceright">
                <strong>${{ $user->hourly_rate }}</strong><br>
                <small>per minute</small>
                <span class="viewbutt">
                  <a href="{{ route('precall', ['username'=> $user->username]) }}">
                    <i class="fa fa-phone" aria-hidden="true"></i>&nbsp;Request a Call</a>
                </span>
                <div class="star">
                  {!! displayStarRatings($user->getAverageRating()) !!}
                  ({{ $user->getExpertiseFeedback()->count() }})
                </div>
            </div>
        </div>
    </article>
  @endforeach

  @if($users->lastPage() > $users->currentPage())
      <div class="load">
          <button data-search="{{ $q }}" data-target="{{ $users->nextPageUrl() }}"  class="btn btn-primary btn-lg loadmore-search-users">Load more</button>
      </div>
  @endif

@else
  <br>
  <h3>Nothing to display</h3>
@endif
