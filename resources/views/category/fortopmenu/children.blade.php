<li>
    <a id="{{$subcategory->id}}" href="{{ route('browse_by_subcategory', ['category_slug' => $category->slug, 'subcategory_slug' => $subcategory->slug]) }}" class="collection-item category">{{ $subcategory->name }}</a>
</li>