@extends('layouts.main')

@section('content')
<div id='page-title'>
    <h2>Laravel Training: The Laravel Maven and the Laravel Novice</h2>
</div>

<div id="wrapper" class="full">

    <div class="row-fluid">
        <div class="span12">
            <h2>Whom?</h2>
            <p class="lead">
                The two of us come together in this raw footage of building a Blog in Laravel. You get both the insights of
                an experienced Laravel Software Writer (<a href="https://alfrednutile.info" target="_blank" style="text-decoration: underline">Alfred Nutile</a>)
                and the questions of a WordPress developer new to Laravel, (<a href="http://www.digitalblockarea.com/" target="_blank" style="text-decoration: underline">Joe Bacal</a>)
            </p>
            <p class="font-larger">By the time you are done with this series you will know how to go from 0 to Deploy with Laravel.
            We will end up with a fully automated deployment to Forge via a simple push to github!</p>
        </div>
    </div> <!--end top row-->
    <div class="row-fluid">
        <div class="span6">
            <div id="circles">
                <a href="/about">
                    <span id="about-me-circle" class="span3 circ-wrapper"></span>
                </a>
                    <h3>Alfred Nutile</h3>
                <p class="font-larger">
                    Enjoying almost 2 years focusing on Laravel and Angular development for a large enterprise company building
                    internal applications both UI and APIs to help with workflows. Before that 10+ years working with technologies
                    like Drupal, PHP, MySQL, LAMP, Linux Server Admin etc.
                </p>
            </div>
        </div>
        <div class="span6">
            <div id="circles">
                <a href="http://www.digitalblockarea.com/">
                    <span id="about-joe-circle" class="span3 circ-wrapper"></span>
                </a>
                <h3>Joseph Bacal</h3>
                <p class="font-larger">
                    Joe is a former classroom teacher.  Over the last three years he's made a career switch into web development.
                    Now in educational technology at Smith College, he builds and maintains themes and plugins for WordPress and Moodle.
                </p>
            </div>
        </div>
    </div>
    <hr>
    <div class="row-fluid">
        <h2>The RoadMap</h2>

        <div class="span5">
            <ul>
                <li class="font-larger">Getting Started, Install, Scaffolding, Blog/Post Index, Create, Validation etc</li>
                <li class="font-larger">Pagination, Seeding, Search</li>
                <li class="font-larger">Authentication, Relating to a User, Theme getting started, Navigation</li>
                <li class="font-larger">Tags, Image Uploading, Theme Footer and Shared Views Data, Cache.</li>
            </ul>
        </div>

        <div class="span6">
            <ul>
                <li class="font-larger">Setting up Homestead, Forge, Deployment</li>
                <li class="font-larger">Gulp and Assets Management, Static Pages</li>
                <li class="font-larger">Contact Form, Queues, Mail</li>
                <li class="font-larger">Angular Widgets, APIs and SPA (Single Page Applications)</li>
            </ul>
        </div>
    </div> <!--end top row-->
    <hr>

<div class="row-fluid">
        <div class="span5" >
            <h2 id="lesson-4">Episode 4: Tagging, Image Uploads and Searching by Images</h2>
            <p class="p-large">
                We start with Image uploads then go into tagging and searching by tags our blog
            </p>

            <h2>We Cover</h2>
            <ul>
                <li>Image Upload</li>
                <li>Tagging</li>
                <li>Searching by Tag</li>
            </ul>
            <h2>Resources</h2>
            <ul>
                <li>You can get code from our Github page <a href="https://github.com/alnutile/blog_series">here</a></li>
                <li>The Scaffold Library is <a href="https://github.com/alnutile/l5scaffold">here</a></li>
                <li>Theme <a href="https://wrapbootstrap.com/theme/tales-responsive-blog-theme-WB034M8P5">here</a></li>
            </ul>
            <br>
        </div>
        <div class="span7">
            <iframe width="640" height="480" src="https://www.youtube.com/embed/_1DK9V3_1aI" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    <hr>

    <div class="row-fluid">
        <div class="span7">
            <iframe width="640" height="480" src="https://www.youtube.com/embed/MbuVdV2gi7o" frameborder="0" allowfullscreen></iframe>
        </div>

        <div class="span5" >
            <h2 id="lesson-3">Episode 3: Relations, Theme Work and CSS Fun :(</h2>
            <p class="p-large">
                We start by setting up the Relationship from User to Blog post. Then we being the theme setup from WrapBootstrap and show how easy it is to drop in a theme to Laravel.
            </p>

            <h2>We Cover</h2>
            <ul>
                <li>Relationships</li>
                <li>Theme Work</li>
            </ul>
            <h2>Resources</h2>
            <ul>
                <li>You can get code from our Github page <a href="https://github.com/alnutile/blog_series">here</a></li>
                <li>The Scaffold Library is <a href="https://github.com/alnutile/l5scaffold">here</a></li>
                <li>Theme <a href="https://wrapbootstrap.com/theme/tales-responsive-blog-theme-WB034M8P5">here</a></li>
            </ul>
            <br>
        </div>
    </div>
    <hr>

    <div class="row-fluid">
        <div class="span5">
            <h2 id="lesson-2">Episode 2: Pagination, Search and Authentication!</h2>
            <p class="p-large">
                We add more functionality to our posts page and then move into authentication!
            </p>
            <h2>We Cover</h2>
            <ul>
                <li>Pagination</li>
                <li>Search</li>
                <li>Authentication</li>
            </ul>
            <h2>Resources</h2>
            <ul>
                <li>You can get code from our Github page <a href="https://github.com/alnutile/blog_series">here</a></li>
                <li>The Scaffold Library is <a href="https://github.com/alnutile/l5scaffold">here</a></li>
            </ul>
            <br>
        </div>
        <div class="span7">
            <iframe width="640" height="480" src="https://www.youtube.com/embed/UvskS3Nwd7I" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    <hr>
    <div class="row-fluid">
        <div class="span7">
            <iframe width="640" height="480" src="https://www.youtube.com/embed/PunGsDrdeQo" frameborder="0" allowfullscreen></iframe>
        </div>

        <div class="span5">
            <h2 id="lesson-1">Episode 1: Getting Started, Install, Scaffolding, Blog/Post Index, Create, Validation etc</h2>
            <p class="p-large">
                We start from the top here, installation, routes, scaffolding, migrations, validation, how, why and what next?
            </p>

            <h2>We Cover</h2>
            <ul>
                <li>Scaffolding</li>
                <li>Model View Controller</li>
                <li>Blade/Templating</li>
            </ul>
            <h2>Resources</h2>
            <ul>
                <li>You can get code from our Github page <a href="https://github.com/alnutile/blog_series">here</a></li>
                <li>The Scaffold Library is <a href="https://github.com/alnutile/l5scaffold">here</a></li>
            </ul>
            <br>
        </div>
    </div>
    <hr>
    <div>
        @if(App::environment() != 'foo')
            @include('shared._disqus')
        @endif
    </div>
</div>
@stop
