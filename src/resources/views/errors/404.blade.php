
<html>
    <head>
        <title>404 not found</title>

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
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
                	    <h3>Oops!</h3>
                	    <h4>Requested page not found!</h4>
                	    <div>
                          <a class="navbar-brand"  href="{{route('default')}}">Top<span> Di </span>Top H.O.M.E.</a>
                	    </div>
                	  </div>
            </div>
        </div>
    </body>
</html>
