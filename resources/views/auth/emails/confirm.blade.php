<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Email Address Verified</h2>
        <div>Hi {{$first_name}}
        <div>

        {!! html_entity_decode($mail->getContents()) !!}
           
            <br/>

        </div>

    </body>
</html>
