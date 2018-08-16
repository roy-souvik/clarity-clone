@if(count($questions))
    @foreach($questions as $answered_question)
        <div class="ansinner">
            <div class="questiontop">
                <span>{{ tags_stringify($answered_question->tags->toArray()) }}</span>
                <br/>
                <a href="{{ route('show_question_details', ['question_id'=>$answered_question['id'], 'slug'=>$answered_question['slug']])}}">{{ $answered_question['question'] }}</a>
            </div>
            <div class="bottques">{{ check_plural($answered_question->answers->count(), 'answer') }} &bull; {{ timeAgo($answered_question["created_at"]) }}</div>
            <div class="quetbox">
                <img alt="" class="ticktop" src="{{ url('/assets/images/ticktop.png') }}" />
                {{ $answered_question->answers->last()->toArray()['answer'] }}
                <div class="profile">
                    <img alt="" src="{{ url('/uploads/profile-pictures/thumbs/' . $answered_question->answers->last()->user->profile_picture) }}" />
                    {{ $answered_question->answers->last()->user->getFullName() }}
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    @endforeach
    @if($questions->lastPage() > $questions->currentPage())
        <button type="button" id="load_more_answered_questions" class="btn btn-success load_more_questions" data-search="{{ $q }}" data-type="answered" data-target="{{ $questions->nextPageUrl() }}"><span class="state-loading"><i class='fa fa-spinner fa-spin '></i> Loading</span><span class="state-normal">Load More</span></button>
    @endif
@else
    No available question
@endif