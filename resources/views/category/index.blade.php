<!-- resources/views/tasks/index.blade.php -->

@extends('layouts.admin')

@section('admin_content')

  <div class="row">
    <div class="col s4 card">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Task Form -->
        <form action="{{ url('category') }}" method="POST" class="form-horizontal card-content">
            {{ csrf_field() }}

            <!-- Parent Category Name -->
            <div class="form-group">
                <p for="parent-category-name" class="col-sm-3 control-label">
                  Parent Category :
                  <u> <span id="parent-category-name" class="form-control-label blue-text">{{ $root->name }}</span> </u>
                </p>
								<input type="hidden" name="parent" id="parent-category-id" class="form-control" value="{{ $root->id }}" readonly>
            </div>
            <br>
            <!-- New Category Name -->
            <div class="form-group">
                <div class="col-sm-6">
                    <input type="text" name="name" id="category-name" class="form-control" placeholder="Enter category name here">
                </div>
            </div>

            <!-- Add Category Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Category
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Current Categories -->
		@if (count($categories) > 0)
		<div class="col s6 push-s2">
			<div class="panel-heading">
				Current Categories
			</div>
			<div class="collection">
				<ul class="tree">
					@each('category.partials.categories', $categories, 'category')
				</ul>
			</div>
		</div>
		@else
			@include('category.partials.categories-none')
		@endif
</div>
@endsection
