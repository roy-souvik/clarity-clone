@extends('layouts.inner')


@section('content')
    <div class="answerdetaistop">
        <div class="expert">

            <h3>{{ $question['question'] }}</h3>
            <p>{{ $question['details'] }}</p>
            <div class="clearfix"></div>
        </div>


    </div>
    <div class="container">
        <div class="expert">
            <div class="row">
                <div class="col-sm-8">
                    @include('errors.list')
                </div>
            </div>
            <div>
                <div class="col-sm-8">
                  <h3>Answer This Question</h3>
                  <form class="add-question askquestion" role="form" method="POST" action="{{ route('submit_answer', ['question_id'=>$question['id']]) }}">
                    {{ csrf_field() }}
                    <div class="p_bot15">
                        Answer
                        <br/>
                        <textarea id="answer" placeholder="Enter your answer" name="answer" class="form-control">{{ old('answer') }}</textarea>
                    </div>

                    <button class="btn btn-primary btn-lg" type="submit">Submit your answer</button>

                  </form>
                </div>
                <div class="col-sm-4">
                    <h3>Tips</h3>
                    <div class="state">
                        <ul>
                            <li>Start by covering your related experience.</li>
                            <li>Answer the question in detail, giving examples, tips, etc.</li>
                            <li>End by offering a call for follow up questions.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection