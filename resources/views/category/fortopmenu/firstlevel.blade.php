<li><a id="{{$category->id}}" href="{{ route('browse_by_category', ['category_slug' => $category->slug]) }}" class="category">{{ $category->name }}</a>
    @if (count($category['relations']) > 0)
        <ul>
            @foreach ($category->childrenRecursive as $key => $subcategory)
                @include('category.fortopmenu.children', [$category, $subcategory])
            @endforeach
        </ul>
    @endif
</li>