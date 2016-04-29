@extends('layouts.main')

@section('content')
<div id='page-title'>
    <h2>Public Key</h2>
</div>

<div id="wrapper" class="full">

    <div class="row-fluid">
        <div class="span8 separate">
            <h2>Public Key</h2>
            <p>
               You can find a link to it <a href="https://dl.dropboxusercontent.com/u/54803135/public.txt" class="btn btn-success btn-small">
                <i class="fa-icon-key">&nbsp; here</i>
               </a>
            </p>
        </div>
        <div class="span4 sidebar">
            <div class="more-info">
                <h3><i class="icon-globe"></i> Quotes</h3>
                <blockquote>
                    <p>
                        "When you build an web application, you shouldn’t be building a “Laravel Application”. You should think about it as building your application, Laravel just happens to be one implementation of it."
                    </p>
                    -<a href="http://culttt.com/2014/01/27/creating-entities-laravel-4/">http://culttt.com/2014/01/27/creating-entities-laravel-4/</a>
                </blockquote>
                <blockquote>
                    <p>"it is not that I am so smart it is that I stay with problems longer"</p>
                    -Einstein
                </blockquote>
                <blockquote>
                    <p>
                        Carefully crafted, your controllers will become reusable with multiple frameworks. By keeping careful control of your dependencies, your controllers could easily become compatible with Silex, Symfony (full stack) and Drupal, to name just a few.
                    </p>
                    --<a href="http://silex.sensiolabs.org/doc/providers/service_controller.html">http://silex.sensiolabs.org/doc/providers/service_controller.html</a>
                </blockquote>
                <blockquote>
                    <p>"We make the mistake that so many programmers have made before us. We bind ourselves to the framework."</p>
                    -<a href="http://blog.8thlight.com/uncle-bob/2014/05/11/FrameworkBound.html">http://blog.8thlight.com/uncle-bob/2014/05/11/FrameworkBound.html</a>
                </blockquote>
                <blockquote>
                    <p>"Nearly all men can stand adversity, but if you want to test a man's character give him power."</p>
                    -Abraham Lincoln
                </blockquote>
                <blockquote>
                    <p>Shane Warden, tweeted something about the waterfall design process that said,
                        “Essentially waterfall amounts to an agreement between all parties not to learn anything at all for the entire duration of the project.”
                    </p>
                    -Shane Warden
                </blockquote>
            </div>
        </div>
    </div>
</div>
@stop