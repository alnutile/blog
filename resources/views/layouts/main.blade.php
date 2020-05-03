<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!--  -->
    <title>Alfred Nutile Inc.::@yield("title", "Developer[PHP, JavaScript, Laravel, Angular]")</title>

    <meta name="description" content="Alfred Nutile - PHP, JavaScript, Laravel, Angular" />
    <meta name="keywords" content="laravel, javascript, angular, php" />
    <meta name="author" content="Alfred Nutile" />
    <link href="/img/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">
    <!-- end: Meta -->

    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- end: Mobile Specific -->

    <!-- start: Facebook Open Graph -->
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- end: Facebook Open Graph -->

    <!-- start: CSS -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Droid+Sans:400,700">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Droid+Serif">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!--  -->
    @stack('head')

    <script>
        window.Blog = {};
        window.Blog.cdn = <?php echo json_encode(config('filesystems.cdn')); ?>;
    </script>
</head>

<body>

    <!--start: Header -->
    @include('shared.nav')
    <!--end: Header-->
    <!--start: Container -->
    <div class="container" id="app">
        @yield('content')
    </div>
    <!-- end: Wrapper  -->

    <!-- start: Footer -->
    <div id="footer">

        <!-- start: Container -->
        <div class="container">

            <!-- start: Row -->
            <div class="row-fluid">

                <span class="span3">
                    <address>
                        <h3>Alfred Nutile</h3>
                        <abbr title="Phone">P:</abbr> (413) 230-4767
                    </address>
                    <address>
                        <a href="mailto:#">me@alfrednutile.info</a>
                        </br>
                        </br>
                        Alfred Nutile, Inc
                        <br> PO Box 72
                        <br> Montague, MA 01351
                    </address>
                </span>
                <span class="span3">
                    <h3>More info</h3>
                    <h3>Resume</h3>
                    <p>
                        <i class="halflings-icon white user"></i>
                        <a href="https://docs.google.com/document/d/1OcjiFV9mhNr6X_yxisQbvb-C9dMDfnP_FJrONyVSZlo" target="_blank">DOC Here</a>
                    </p>
                </span>
                <span id="social-block" class="pull-right span6">
                    <ul class="inline">
                        <li id='linked' class='span2'>
                            <a href="https://www.linkedin.com/in/alfrednutile/">
                                <img src="/img/linkedin-4-xl.png">
                            </a>
                        </li>
                        <li id='twitter' class='span2'>
                            <a href="https://twitter.com/alnutile">
                                <img src="/img/twitter-4-xl.png">
                            </a>
                        </li>
                        <li id='gplus' class='span2'>
                            <a href="https://plus.google.com/u/1/113385596438431897721/posts/p/pub">
                                <img src="/img/google-plus-4-xl.png">
                            </a>
                        </li>
                        <li id='github' class='span2'>
                            <a href="https://github.com/alnutile">
                                <img src="/img/github-9-xl.png">
                            </a>
                        </li>
                        <li id='feed' class='span2'>
                            <a href="/rss">
                                <img src="/img/feed-9-xl.png">
                            </a>
                        </li>
                    </ul>
                </span>


                <!-- end: Follow Us -->

            </div>
            <!-- end: Row -->

        </div>
        <!-- end: Container  -->

    </div>
    <!-- end: Footer -->

    <!-- start: Under Footer -->
    <div id="under-footer">

        <!-- start: Container -->
        <div class="container">

            <!-- start: Row -->
            <div class="row-fluid">

                <!-- start: Under Footer Logo -->
                <div class="span2">
                    <div id="under-footer-logo">
                        <a class="brand" href="#">tabula</a>
                    </div>
                </div>
                <!-- end: Under Footer Logo -->

                <!-- start: Under Footer Copyright -->
                <div class="span9">

                    <div id="under-footer-copyright">
                        &copy; 2012,
                        <a href="http://clabs.co">creativeLabs</a>. Designed by
                        <a href="http://clabs.co">creativeLabs</a> in Poland
                        <img src="/img/poland.png" alt="Poland" style="margin-top:-4px">
                    </div>

                </div>
                <!-- end: Under Footer Copyright -->

                <!-- start: Under Footer Back To Top -->
                <div class="span1">

                    <div id="under-footer-back-to-top">
                        <a href="#"></a>
                    </div>

                </div>
                <!-- end: Under Footer Back To Top -->

            </div>
            <!-- end: Row -->

        </div>
        <!-- end: Container  -->

    </div>
    <!-- end: Under Footer -->

    <!-- start: Java Script -->
    <script src="{{ mix('js/app.js') }}"></script>


    <!--  -->


@if(!\App::environment('local'))
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
@endif

    <!-- -->
    @stack('scripts')
</body>

</html>
