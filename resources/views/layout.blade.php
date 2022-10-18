<!DOCTYPE html>
<html>
<head>
    <title>Live User Visitor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);

        body{
            margin: 0;
            font-size: .9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            text-align: left;
            background-color: #f5f8fa;
        }
        .navbar-laravel
        {
            box-shadow: 0 2px 4px rgba(0,0,0,.04);
        }
        .navbar-brand , .nav-link, .my-form, .login-form
        {
            font-family: Raleway, sans-serif;
        }
        .my-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .my-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }
        .login-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .login-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="#">Live User Visitor</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                @endguest

            </ul>

        </div>
    </div>
</nav>
<input type="hidden" id="user_id" value="@if(isset(auth()->user()->id)){{ auth()->user()->id }}@endif"/>
@yield('content')

<script>
    $(document).ready(function() {
        update_live();
        update_live_status();
        setInterval(function () {
            update_live();
        }, 5000);
        setInterval(function () {
            update_live_status();
        }, 3000);
    });
    function update_live() {
        $.post("api/livestore",{
            user_id: $("#user_id").val(),
        });
    }
    function update_live_status() {
        const settings = {
            "async": true,
            "crossDomain": true,
            "url": "api/getusers",
            "method": "POST"
        };
        $.ajax(settings).done(function (response) {
            const result = response;
            $("#visitor_live").html(result.visitor_live);
            $("#user_live").html(result.user_live);
        });
    }
</script>
</body>
</html>
