<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>New question asked</h2>

<div>Hi {{$user->first_name}}
    <div>
        {!! html_entity_decode($mail_body->getContents()) !!}
        {{ action('QuestionsController@showQuestionDetails', ['question_id' => $question->id]) }}.
        <br/>

    </div>
</div>
</body>
</html>