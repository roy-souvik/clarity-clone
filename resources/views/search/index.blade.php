@extends('layouts.inner')

@section('content')
    <div class="tabouter1">
        <ul role="tablist" class="nav nav-tabs">
            <li class="active" role="presentation">
                <a data-toggle="tab" role="tab" aria-controls="experts" href="#experts">Experts</a>
            </li>
            <li role="presentation">
                <a data-toggle="tab" role="tab" aria-controls="listings" href="#listings">Listings</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="experts" class="tab-pane active" role="tabpanel">
                <div class="tabouter1">
                    {{-- <ul role="tablist" class="nav nav-tabs">
                        <li class="active" role="presentation">
                            <a data-toggle="tab" role="tab" aria-controls="all" href="#all">All</a>
                        </li>
                        <li role="presentation">
                            <a data-toggle="tab" role="tab" aria-controls="near-me" href="#near-me">Near Me</a>
                        </li>
                    </ul> --}}
                    <div class="tab-content">
                        <div id="all" class="tab-pane active" role="tabpanel">
                          @include('search.partials._showUserListing', $users)
                          {{-- <div class="load"><button class="btn btn-primary btn-lg">Load more</button></div> --}}
                        </div>
                        <div id="near-me" class="tab-pane" role="tabpanel">
                          {{--@include('search.partials._showUserListing', $users)--}}
                        </div>
                    </div>
                </div>
            </div>
            <div id="listings" class="tab-pane" role="tabpanel">
                <div class="tabouter1">
                    <div class="searchby">Sort by : <select data-filter="featured" id="search_sort_by" name="search_sort_by">
                            <option selected="selected" value="highest_price">Highest price</option>
                            <option value="lowest_price">Lowest price</option>
                        </select>
                    </div>
                    <!-- Nav tabs -->
                    <ul role="tablist" id="filter-search-expertise" class="nav nav-tabs">
                        <li class="active" role="presentation">
                            <a data-sort_by="highest_price" data-search="{{ $q }}" data-toggle="tab" role="tab" aria-controls="featured" href="#featured">Featured</a>
                        </li>
                        <li role="presentation">
                            <a data-sort_by="highest_price" data-search="{{ $q }}" data-toggle="tab" role="tab" aria-controls="top_rated" href="#top_rated">Top rated</a>
                        </li>
                        <li role="presentation">
                            <a data-sort_by="highest_price" data-search="{{ $q }}" data-toggle="tab" role="tab" aria-controls="new" href="#new">New</a>
                        </li>
                        <li role="presentation">
                            <a data-sort_by="highest_price" data-search="{{ $q }}" data-toggle="tab" role="tab" aria-controls="popular" href="#popular">Popular</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="featured" class="tab-pane active" role="tabpanel">
                            @include('search.single_list', [
                                'expertises' => $expertises,
                                'search' => $q,
                                'filter_type' => 'featured',
                                'sort_by' => 'highest_price'
                            ])
                        </div>
                        <div id="top_rated" class="tab-pane" role="tabpanel">

                        </div>
                        <div id="new" class="tab-pane" role="tabpanel">

                        </div>
                        <div id="popular" class="tab-pane" role="tabpanel">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
