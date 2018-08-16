@extends('layouts.inner')

@section('content')
<div class="col-sm-7 col-sm-offset-1">
    @include('errors.list')
</div>
<div class="innercatagory">
    {!! Form::model($expertise, array('route' => array('edit_expertise', $expertise['id']), 'method'=>'POST', 'class'=>'add-expertise', 'files'=>'true')) !!}
      <div class="row profile">
        <div class="col-sm-8 information">
          <h3>New Area of Expertise</h3>
              <div class="form-group p_bot20">
                Title
                <br/>
                {!! Form::text('title', null, ['class' => 'form-control', 'id' => 'title', 'maxlength' => '80', 'placeholder' => 'I will give you advice on...']) !!}
              </div>
              <div class="form-group p_bot20">
                Select a Category<br/>
                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::select('category_id', $categories->lists('name','id')->toArray(), $category_id, ['class'=>'form-control', 'id'=>'choose_category', 'placeholder'=>'Select a category']) !!}
                    </div>
                    <div class="col-sm-6">
                        @if (count($subcategories) > 0)
                            {!! Form::select('subcategory_id', $subcategories->lists('name','id')->toArray(), $subcategory_id, ['class'=>'form-control', 'id'=>'choose_subcategory', 'placeholder'=>'Select a category']) !!}
                        @else
                            <select id="choose_subcategory" name="subcategory_id" disabled="" class="form-control">
                                <option value="">No subcategory</option>
                            </select>
                        @endif
                    </div>
                </div>
              </div>
              <div class="form-group p_bot20">
                Description:<br/>
                {!! Form::textarea('description', null, ['class' => 'form-control', 'title' => 'Min 80 Characters', 'id' => 'description', 'placeholder' => "Describe your experience, training, etc that demonstrate your skills & passion. Also, describe the benefits they'll receive."]) !!}
                <div class="clearfix"></div>
              </div>
              <div class="form-group p_bot20">
                Add Topics<br/>
                {!! Form::select('tags[]', $expertise->tags->lists('name','id')->toArray(), $expertise->tags->lists('id')->toArray(), ['class'=>'form-control multiple', 'multiple', 'id'=>'expertise_tags', 'placeholder'=>'Select related topics']) !!}
              </div>
              <div class="form-group p_bot20">
                <div class="geenbutt">
                    <button class="btn btn-primary btn-lg" type="submit">Save Expertise</button>
                </div>
              </div>
          
        </div>
        <div class="col-sm-4 editpic">
            <h3>Cover Image</h3>
            <img src="{{ url( '/uploads/expertise-cover-images/' . $expertise['cover_image'] ) }}" />
            <input id="cover_image" name="cover_image" type="file" />
        </div>
      </div>
      {!! Form::close() !!}
    </div>
@endsection