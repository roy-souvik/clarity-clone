<li><a id="{{$category->id}}" href="#" class="category">{{ $category->name }}</a>
@if (count($category['relations']) > 0)
	<ul>
		@foreach ($category->childrenRecursive as $key => $category)
			 @include('category.partials.categories', $category)
		@endforeach
	</ul>
@endif
</li>