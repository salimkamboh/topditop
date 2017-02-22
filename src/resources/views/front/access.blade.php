<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Access | TopDiTop.com</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/css/lib/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/front.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/access.css') }}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="access-logo-wrapper">
                    <h1 class="text-center logo">Top<span class="logo-alt-color">di</span>Top
                        H.O.M.E.</h1>
                </div>
                <form class="form-horizontal" role="form" method="POST" action="{{ route('access.attempt') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Passwort eingeben</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password">

                            @if (session()->has('wrong-password'))
                                <span class="help-block help-block-error">
                                        <strong>Falsches Passwort</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-access">
                                <i class="fa fa-btn fa-sign-in"></i> Zutritt
                            </button>

                            <a class="btn btn-link" href="{{ route('access.clear') }}">Klarer Zugang</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>