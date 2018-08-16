<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>

        <h2>Verify Your Email Address</h2>

        <div>
            {!! html_entity_decode($mail->getContents()) !!}
            {{ URL::to('register/verify/' . $confirmation_code) }}.<br/>

        </div>
        
    </body>
</html>
