<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Alfred Nutile | @yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('/css/sass.css') }}">
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

</head>

<body>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Alfred Nutile
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ url('/') }}">
                            <i class="fa fa-book"></i>&nbsp;Blog/Home</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/j2a">
                            <i class="fa fa-s15"></i>&nbsp;JSON to PHP Array</a>
                    </li>
                    <li>
                        <a href="/codenames">
                            <i class="fa fa-film"></i>&nbsp;Generate CodeNames</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="ads col-md-12">
                <!--  -->
                @if(!\App::environment("foo"))
                <!-- Homepage Leaderboard -->
                <!-- tools -->
                <!-- tools -->
                <ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-1002021299472446" data-ad-slot="2583363170"></ins>

                <!--  -->
                @endif
            </div>
            <div id="app">
                <div class="col-md-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
    <script src="{{ mix('js/app.js') }}"></script>

    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <!-- end: Java Script -->
    <script>
        var _gaq = [
            ['_setAccount', 'UA-39925227-1'],
            ['_trackPageview']
        ];
        (function (d, t) {
            var g = d.createElement(t),
                s = d.getElementsByTagName(t)[0];
            g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g, s)
        }(document, 'script'));
    </script>
</body>
</html