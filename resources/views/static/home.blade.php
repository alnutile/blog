@extends('layouts.main')

@section('content')
<div id="page-title">
    <h2>Alfred Nutile</h2>
</div>
<!--start: Wrapper-->
<div id="wrapper">
<div id="circles" class="row-fluid">
    <div class="posts">
        <div class="span2">
            @include('shared.me')
        </div>
        <div class="span10">
            <div class="span8 home-intro">
                <div class="row-fluid">
                    <h3>Who?</h3>
                    <p>
                        <span class="dropcap dark">A</span>lfred Nutile 15+ years in the tech industry.
                        Focused on building RESTful APIs in Laravel/PHP, and building apps in AngularJS.
                    </p>
                    <p>
                        Resume <a href="https://goo.gl/z9R72W">doc version</a> and <a href="https://goo.gl/z9R72W">pdf version</a>, past work can be seen below and on <a href="/portfolio">portfolio page</a>.
                    </p>
                    <p>
                        <a class="btn btn-default btn-inverse"
                           href='http://www.developershangout.io/'>
                            <i class="fa fa-icon-headphones"></i>
                            &nbsp;DevelopersHangout Podcast!
                        </a>
                    </p>
                </div>
                <div class="row-fluid">
                    <div class="text-center">
                        <div class="tags">
                            <a href="/tags/78">Laravel</a>
                            <a href="/tags/27">PHP</a>
                            <a href="/tags/145">Serverless</a>
                            <a href="/tags/133">AWS</a>
                            <a href="/tags/7">REST</a>
                            <a href="/tags/3">Angular</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span4 testimonials-wrapper">
                @include('static.testimonies')
            </div>
        </div>
    </div>
</div>

<hr>
<!-- start: Wall -->

<div id="wall" class="row-fluid">
    @include('projects.grid', array('span'=>'span3'))
</div>
<!-- end: Wall -->
</div>

@stop
