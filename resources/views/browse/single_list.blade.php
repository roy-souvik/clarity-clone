@if(count($expertises))
    @foreach($expertises as $expertise)
        <article class="liveinner">
            <div class="row">
            <div class="col-sm-2 clientpic">
                <img src="{{ url( '/uploads/expertise-cover-images/' . $expertise['cover_image'] ) }}" alt=""></div>
            <div class="col-sm-6 ques">
                <h4><a href="#">{{ $expertise['title'] }}</a></h4>
                <small>
                    <span class="status offline"></span>
                    <strong>{{ $expertise->user['first_name'].' '.$expertise->user['last_name'] }}</strong>
                    <em>&bull;</em>
                    <span>{{ $expertise->user['location'] }}</span>

                </small>
                <p>{{ wordlimit($expertise['description'], 20) }}</p>
            </div>
            <div class="col-sm-4 priceright">
                <strong>${{ $expertise->user->getHourlyRateInMins() }}</strong><br>
                <small>per minute</small>
                <span class="viewbutt"><a href="{{ route('precall', ['username'=> $expertise->user['username']]) }}"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;Request a Call</a></span>

                @if($expertise->hasFeedback())
                  <div class="star">
                    {!! displayStarRatings($expertise->getAverageRating()) !!}
                    ({{ $expertise->feedback->count() }})
                  </div>
                @endif

            </div>
        </div>
        </article>
    @endforeach
    @if($expertises->lastPage() > $expertises->currentPage())
        <div class="load">
            <button data-category="{{ $category }}" data-filter_type="{{ $filter_type }}" data-target="{{ $expertises->nextPageUrl() }}" data-sort_by="{{ $sort_by }}" class="btn btn-primary btn-lg loadmore-expertise">Load more</button>
        </div>
    @endif
@else
    No result found
@endif
