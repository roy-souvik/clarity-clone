<div class="business_banner" style="background-image: url('{{ url('/uploads/category/banners/'.$category['banner']) }}')">
    <div class="business_banner_inner">
        <div class="container">

            <h2>{{ $category['name'] }}</h2>

            <p>{{ $category['description'] }}</p>

        </div>
    </div>
</div>
<div class="business_head" >
    <div class="container">
        <div class="business_headinner">
            <ul>
                @if(count($children))
                @foreach($children as $child)
                <li><a href="{{ route('browse_by_subcategory', ['category_slug' => $category['slug'], 'subcategory_slug' => $child['slug']]) }}">{{ $child['name'] }}</a></li>
                @endforeach
                @endif
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
</div>