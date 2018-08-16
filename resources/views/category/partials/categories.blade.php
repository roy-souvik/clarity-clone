<li class="collection-item">
	<a id="{{$category->id}}" href="#category-name" class="category">
	 {{ $category->name }}
	</a>

{{--
	Commenting out the feature : will be opened when needed
	@if(! $category->isOfLevelOne())
		<i data-categoryid="{{$category->id}}" class="remove-category tiny material-icons red-text lighten-1" style="cursor:pointer;">delete</i>
	@endif
 --}}

@if (count($category['relations']) > 0)
	<ul>
		@foreach ($category->childrenRecursive as $key => $category)
			 @include('category.partials.categories', $category)
		@endforeach
	</ul>
@endif
</li>
