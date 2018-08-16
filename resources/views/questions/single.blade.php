@extends('layouts.inner')

@section('content')
    <div class="answerdetaistop">
        <div class="expert">

            <h3>{{ $question['question'] }}</h3>
            <p>{{ $question['details'] }}</p>

            @role('expert')
            <a href="{{'/question/answer/'.$question['id'] }}" class="question-input-cta internal">Answer this question..</a>
            @endrole

            <div class="bottonfailed"><p>Filed under: <strong>{{ tags_stringify($question->tags->toArray()) }}</strong></p>
                <p>{{ check_plural($question->answers->count(), 'answer') }} &bull; {{ timeAgo($question["created_at"]) }}</p>
                <span class="bottfail_but"><a href="#"><i aria-hidden="true" class="fa fa-share"></i>Share This Question</a></span>
                <div class="clearfix"></div>
            </div>


        </div>
    </div>

    <div class="container">
        <div class="expert">
            <div class="row">
                <div class="col-sm-8 answerleft">
                    <h3>Answers</h3>
                    @if(count($question->answers))
                        @foreach($question->answers as $answer)

                            <div class="testiinner">
                                <img src="{{ url('/uploads/profile-pictures/thumbs/' . $answer->user->profile_picture) }}" alt="" class="testiinnerpic">
                                <a href="{{ url('/public/'.$answer->user->username) }}"><h5>{{ $answer->user->getFullName() }}</h5>
                                    <strong>Answered:</strong>     </a>
                                <p>{{ $answer['answer'] }}</p>
                                <div class="author bottomlink">
                                    <span class="left greentext"><a href="{{ url('/public/'.$answer->user->username) }}"><i class="fa fa-phone-square" aria-hidden="true"></i>&nbsp;Talk to {{ $answer->user->first_name }}</a></span>
                                    <span class="left greentext"><a href="#"><i class="fa fa-share" aria-hidden="true"></i>&nbsp;Share</a></span>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <em class="no-results">
                            No answers yet! You can <a data-transition="up" class="internal share" href="#">share this question</a>!
                        </em>
                    @endif
                </div>
                <div class="col-sm-4 answerright">
                    <h3>Related Questions</h3>
                    @include('questions.loadmore_answered_question', ['questions' => $related_questions])
                </div>
            </div>
        </div>
    </div>

@endsection