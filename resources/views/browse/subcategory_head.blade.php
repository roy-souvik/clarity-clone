<div class="business_head businessmar">
    <div class="container">
        <div class="business_headinner">
            <h2><a href="{{ route('browse_by_category', ['category_slug' => $parent['slug']]) }}">{{ $parent['name'] }},</a> {{ $category['name'] }}</h2>
            <ul>
                @if(count($children))
                    @foreach($children as $child)
                        <li @if($child['slug'] == $category['slug']) class="active" @endif><a href="{{ route('browse_by_subcategory', ['category_slug' => $parent['slug'], 'subcategory_slug' => $child['slug']]) }}">{{ $child['name'] }}</a></li>
                    @endforeach
                @endif
            </ul>
            <div class="clearfix"></div>

        </div>
    </div>
</div>