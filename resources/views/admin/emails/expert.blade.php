<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Congratulation, you are now an expert.</h2>

<div>Hi {{$user->first_name}}
    <div>
        Your account is approved as an expert with MonsterCall.<br/>
        Please follow the link below to your profile
        {{ action('ProfileController@index') }}.
        <br/>

    </div>
</div>
</body>
</html>