@extends('layouts.main')

@section('content')
<div id='page-title'>
    <h2>About</h2>
</div>

<div id="wrapper" class="full">

    <div class="row-fluid">
        <div class="span9">
            <h3>Me?</h3>
            <p class="lead">
                Software Writer and System Architect
            </p>
            <p>
            <div class="lead">
                Author of <a href="https://www.packtpub.com/web-development/laravel-5x-cookbook" target="_blank"
                style="text-decoration: underline;">
                    Laravel 5.x Cookbook
                </a>
            </div>
            <ul class="check_list about">
                <li>Over 8 years building websites and web apps from start to end. Using technologies like Angular.js, Laravel, AWS, Linux, PHP, Drupal, Rails, JavaScript, jQuery, Apache, etc.</li>
                <li>Over 7 years managing projects, clients and staff. Working alone or with a team to make sure the projects get done.</li>
                <li>Over 15 years working on Linux systems and managing LAMP</li>
                <li>Over 3 years experience as a presenter at numerous Drupal and other Web related events. Yale, MIT, Smith College and UMASS Amherst.</li>
            </ul>
            </p>
        </div>
        <div id="about-circle" class="span3">
            <div id="circles">
                @include('shared.me')
            </div>
        </div>
    </div> <!--end top row-->
    <hr>



    <div class="row-fluid">
        <div class="span8 separate">
            <h2>Sites</h2>
            <p>
                <span class="dropcap">Y</span>ou can see a long list of sites below that I have built alone or with a team, some of which I also managed.
            </p>
            <div class="sites">
                @include('static.sites')
            </div>
        </div>
        <div class="span4 sidebar">
            @include('shared._podcast')

            <div class="keys well">
                <h4>Keys</h4>
                <div><i class="halflings-icon star"></i>In on Full Build</div>
                <div><i class="halflings-icon cog"></i>Some Work</div>
                <div><i class="halflings-icon stop"></i>PHP</div>
                <div><i class="halflings-icon play"></i>Laravel</div>
                <div><i class="halflings-icon magnet"></i>Angular</div>
                <div><i class="halflings-icon leaf"></i>JavaScript</div>
                <div><i class="halflings-icon eye-open"></i>Rails</div>
                <div><i class="halflings-icon certificate"></i>Drupal</div>
                <div><i class="halflings-icon user"></i>Front End</div>
                <div><i class="halflings-icon tag"></i>Project Manager</div>
                <div><i class="halflings-icon refresh"></i>No Longer Active</div>
            </div>
            <hr>
            <div class="more-info">
                <h3>More info</h3>
                <h4>Resume</h4>
                <p>
                    <i class="halflings-icon  user"></i><a href="https://goo.gl/z9R72W" target="_blank">PDF Here</a></br>
                    <i class="halflings-icon  user"></i><a href="https://goo.gl/z9R72W" target="_blank">DOC Here</a>
                </p>
            </div>
            <hr>
            <div>@include('static.testimonies')</div>
        </div>
    </div>
</div>
@stop
