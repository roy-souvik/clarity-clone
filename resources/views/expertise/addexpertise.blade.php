@extends('layouts.inner')

@section('content')
<div class="col-sm-7 col-sm-offset-1">
    @include('errors.list')
</div>
<div class="innercatagory">
    <form class="add-expertise" role="form" method="POST" action="{{ route('add_new_expertise') }}" enctype="multipart/form-data">
        <div class="row profile">
            <div class="col-sm-8 information">
                <h3>New Area of Expertise</h3>

                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />
                <div class="form-group p_bot20">
                    Title
                    <br/>
                    <input id="title" maxlength="80" value="{{ old('title') }}" placeholder="I will give you advice on..." name="title" class="form-control" />
                </div>
                <div class="form-group p_bot20">
                    Select a Category<br/>
                    <div class="row">
                        <div class="col-sm-6">
                            {!! Form::select('category_id', $categories->lists('name','id')->toArray(), null, ['class'=>'form-control', 'id'=>'choose_category', 'placeholder'=>'Select a category']) !!}
                        </div>
                        <div class="col-sm-6">
                        <select id="choose_subcategory" name="subcategory_id" disabled="" class="form-control">
                            <option value="">No subcategory</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="form-group p_bot20">
                    Description:<br/>
                    <textarea id="description" title="Min 80 Characters" placeholder="Describe your experience, training, etc that demonstrate your skills & passion. Also, describe the benefits they'll receive." name="description" class="form-control">{{ old('description') }}</textarea>
                    <div class="clearfix"></div>
                </div>
                <div class="form-group p_bot20">
                    Add Topics<br/>
                    <select id="expertise_tags" name="tags[]" class="form-control multiple" multiple="multiple">
                    </select>
                </div>
                <div class="form-group p_bot20">
                    <div class="geenbutt">
                        <button class="btn btn-primary btn-lg" type="submit">Save Expertise</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 editpic">
                <h3>Cover Image</h3>
                <input id="cover_image" name="cover_image" type="file" />
            </div>
        </div>
    </form>
</div>

@endsection