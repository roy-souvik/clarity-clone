<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>New answer on your question</h2>

<div>Hi {{$admin->first_name}}
    <div>
        {!! html_entity_decode($mail_body->getContents()) !!}
        {{ action('AdminController@expertApply') }}.
        <br/>

    </div>
</div>
</body>
</html>