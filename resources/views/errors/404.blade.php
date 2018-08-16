<!DOCTYPE html>
<html>
    <head>
        <title>404</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
            .list-unstyled{
              padding-left: 0;
              list-style: none;
            }
            li a {
                color: #ff5a5f;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <h1 class="title">Oops!</h1>
                <h2>We can't seem to find the page you're looking for.</h2>
                <h6>Error code: 404</h6>

                <ul class="list-unstyled">
                  <li>Here are some helpful links instead:</li>
                  <li><a href="{{ url('/') }}">Home</a></li>
                  <li><a href="{{ url('/login') }}">Login</a></li>
                </ul>

            </div>
        </div>
    </body>
</html>
