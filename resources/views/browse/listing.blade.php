@extends('layouts.inner')

@section('grey_head')
    @include($head)
@endsection

@section('content')
    <div class="tabouter1">
        <div class="searchby">Sort by : <select data-filter="featured" id="browse_sort_by" name="browse_sort_by">
                <option selected="selected" value="highest_price">Highest price</option>
                <option value="lowest_price">Lowest price</option>
            </select>
        </div>
        <!-- Nav tabs -->
        <ul role="tablist" id="filter-expertise" class="nav nav-tabs">
            <li class="active" role="presentation">
                <a data-sort_by="highest_price" data-category="{{ $category->slug }}" data-toggle="tab" role="tab" aria-controls="featured" href="#featured">Featured</a>
            </li>
            <li role="presentation">
                <a data-sort_by="highest_price" data-category="{{ $category->slug }}" data-toggle="tab" role="tab" aria-controls="top_rated" href="#top_rated">Top rated</a>
            </li>
            <li role="presentation">
                <a data-sort_by="highest_price" data-category="{{ $category->slug }}" data-toggle="tab" role="tab" aria-controls="new" href="#new">New</a>
            </li>
            <li role="presentation">
                <a data-sort_by="highest_price" data-category="{{ $category->slug }}" data-toggle="tab" role="tab" aria-controls="popular" href="#popular">Popular</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div id="featured" class="tab-pane active" role="tabpanel">
                @include('browse.single_list', [
                    'expertises' => $expertises,
                    'category' => $category->slug,
                    'filter_type' => $filter_type,
                    'sort_by' => $sort_by
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
@endsection
