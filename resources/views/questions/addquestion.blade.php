@extends('layouts.inner')

@section('content')


    <div class="dashinner">
        <div class="col-sm-8">
            @include('errors.list')
        </div>
        <div class="col-sm-8 askquestion">
          <h3>Ask a Question</h3>
          <form class="add-question" role="form" method="POST" action="{{ route('add_new_question') }}">
            {{ csrf_field() }}
            <div class="p_bot15">
                Question
                <br/>
                <textarea id="question" placeholder="Enter your question" name="question" maxlength="150" class="form-control">{{ old('question') }}</textarea>
            </div>
            <div class="p_bot15">
                Details (optional)
                <br /> 
                <textarea id="details" placeholder="Provide more details" name="details" class="form-control">{{ old('details') }}</textarea>
            </div>
            <div class="p_bot15">
                Add Topics
                <br/>
                <select id="question_tags" name="tags[]" class="form-control multiple" multiple="multiple">
                </select>
            </div>
            <div class="p_bot15">
                Post anonymously?
                <br/>
                <span class="p_rig15">
                    <input type="radio" value="1" name="is_anonymous"/>
                    Yes
                </span>
                <span>
                    <input type="radio" value="0" checked="" name="is_anonymous"/>
                    No
                </span>
            </div>
            <button class="btn btn-primary btn-lg" type="submit">Ask your question</button>
            
          </form>
        </div>
        <div class="col-sm-4">
            <h3>Tips</h3>
            <div class="state">
                <ul>
                    <li>Ask a specific question.</li>
                    <li>Be brief and to the point.</li>
                    <li>Stay focused on a single topic.</li>
                </ul>
            </div>
        </div>
    </div>

@endsection