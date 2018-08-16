@extends('layouts.inner')

@section('content')

	<h1>Answers</h1>
	<div class="tabouter" style="padding:30px 0 0;">
		<ul class="nav nav-tabs" role="tablist">
			<li class="active" role="presentation">
				<a data-toggle="tab" role="tab" aria-controls="answered" href="#answered" aria-expanded="true">Latest</a>
			</li>
			@role('expert')
			<li class="" role="presentation">
				<a data-toggle="tab" role="tab" aria-controls="open" href="#open" aria-expanded="false">
					Open
					<strong id="open_questions_count">({{ $open_questions_count }})</strong>
				</a>
			</li>
			@endrole
			<a class="add_a_question pull-right" href="{{ route('show_new_question_form') }}">Add a question</a>
		</ul>
		<div class="tab-content">
			<div id="answered" class="tab-pane active" role="tabpanel">
				<div class="row">
					<div class="col-sm-8 answerleft">
						<h3>Latest Answers</h3>
						<div id="answered-questions-listing" class="questions-listing">
							@include('questions.loadmore_answered_question', ['questions' => $answered_questions, 'q' => $q])
						</div>
					</div>
					<div class="col-sm-4 answerright">
						<h3>Search Questions</h3>
						<div class="search_div">

							{!! Form::open(['method' => 'GET', 'route' => ['searchQuestions'], 'class' => 'searchQuestionForm', 'data-type' => 'answered' ]) !!}
								{!! Form::text('q', null, ['class' => 'search_divfield', 'placeholder' => 'Search Questions']) !!}
								{!! Form::hidden('type', 'answered') !!}
								{!! Form::submit('', ['class' => 'searchicon1']) !!}
							{!! Form::close() !!}

							<div class="clearfix"></div>
						</div>
						<h3>Popular Answers</h3>
						@include('questions.loadmore_answered_question', ['questions' => $popular_questions, 'q' => $q])
					</div>
				</div>
			</div>
			@role('expert')
			<div id="open" class="tab-pane" role="tabpanel">
				<div class="row">
					<div class="col-sm-8 answerleft">
						<h3>Open Questions</h3>
						<div id="open-questions-listing" class="questions-listing">
							@include('questions.loadmore_open_question', ['questions' => $open_questions, 'q' => $q])
						</div>
					</div>
					<div class="col-sm-4 answerright">
						<h3>Search Questions</h3>
						<div class="search_div">
							{!! Form::open(['method' => 'GET', 'route' => ['searchQuestions'], 'class' => 'searchQuestionForm', 'data-type' => 'open' ]) !!}
							{!! Form::text('q', null, ['class' => 'search_divfield', 'placeholder' => 'Search Questions']) !!}
							{!! Form::hidden('type', 'open') !!}
							{!! Form::submit('', ['class' => 'searchicon1']) !!}
							{!! Form::close() !!}
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
			@endrole
		</div>
	</div>


@endsection
