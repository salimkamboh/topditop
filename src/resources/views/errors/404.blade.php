<html>
<head>
    <title>404 Page not found</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/lib/bootstrap.min.css') }}">
    <style>
        html, body {
            height: 100%;
        }
        body {
            margin: 0;
            padding-top: 40px;
            width: 100%;
            font-weight: 100;
        }
        .container {
            text-align: center;
            vertical-align: middle;
        }
        .content {
            text-align: center;
            display: inline-block;
        }
        .title {
            font-size: 30px;
            margin-bottom: 20px;
        }
        a span {
            color: gray;
        }

        a {
            color: #af865c;
        }

        a, u {
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">
            <div class="page-header">
                <h2>
                    Requested page not found!
                </h2>
            </div>
            <br>
            <div>
                <a href="{{ route('default') }}">
                    <img src="{{ asset('assets/img/topditop-logo.jpg') }}"
                         class="topditop-logo img-responsive" alt="TopDiTop Home Logo">
                </a>
                <hr>
                <a href="{{ route('default') }}" class="btn btn-default btn-lg">Go to homepage</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
