@extends('layouts.inner')

@section('content')
    <h1>Your Expertise Listings</h1>
    <div class="row profile">
        @include('common.flashMessage')
        @if(count($expertises))
            @foreach($expertises as $expertise)
            <div class="expertise_listings">
                <article class="liveinner">
                    <div class="row">
                        <div class="col-sm-2 clientpic">
                          <img alt="" src="{{ url( '/uploads/expertise-cover-images/' . $expertise['cover_image'] ) }}">
                        </div>
                        <div class="col-sm-7 ques">
                            <h4><a href="{{ route('edit_expertise', ['expertise_id' => $expertise['id']]) }}">{{ $expertise['title'] }}</a></h4>
                            <small>
                                <span class="status offline"></span>
                                @if($expertise['parent_category']->name != 'root')
                                    Created {{ timeAgo($expertise['created_at']) }} in <a href="{{ route('browse_by_category', ['category_slug' => $expertise['parent_category']->slug]) }}">{{ $expertise['parent_category']->name }}</a> / <a href="{{ route('browse_by_subcategory', ['category_slug' => $expertise['parent_category']->slug, 'subcategory_slug' => $expertise['category']->slug]) }}">{{ $expertise['category']->name }}</a>
                                @else
                                    Created {{ timeAgo($expertise['created_at']) }} in <a href="{{ route('browse_by_category', ['category_slug' => $expertise['category']->slug]) }}">{{ $expertise['category']->name }}</a>
                                @endif
                            </small>
                            <p>{{ $expertise['description'] }}</p>
                        </div>
                        <div class="col-sm-3 priceright">
                            <span class="viewbutt"><a href="{{ route('edit_expertise', ['expertise_id' => $expertise['id']]) }}"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Edit</a></span>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        @endif

        <div class="geenbutt">
            <a class="btn btn-primary btn-lg" href="{{ route('show_new_expertise_form') }}">New Area of Expertise</a>
        </div>
    </div>
@endsection