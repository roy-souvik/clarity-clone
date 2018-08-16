@if(count($questions))
    @foreach($questions as $open_question)
        <div class="ansinner" id="question-{{ $open_question->id }}">
            <div class="questiontop">
                <span>{{ tags_stringify($open_question->tags->toArray()) }}</span>
                <br>
                <a href="{{ route('show_question_details', ['question_id'=>$open_question['id'], 'slug'=>$open_question['slug']]) }}">{{ $open_question->question }}</a>
            </div>
            <div class="bottques1">{{ timeAgo($open_question['created_at']) }}</div>
            <a data-question-id="{{ $open_question->id }}" data-action="skip-question" href="javascript:void(0);" class="btn btn-small btn-orange dismiss">Dismiss</a>
        </div>
    @endforeach
    @if($questions->lastPage() > $questions->currentPage())
        <button type="button" id="load_more_answered_questions" class="btn btn-success load_more_questions" data-search="{{ $q }}" data-type="open" data-target="{{ $questions->nextPageUrl() }}"><span class="state-loading"><i class='fa fa-spinner fa-spin '></i> Loading</span><span class="state-normal">Load More</span></button>
    @endif
@else
    No available question
@endif