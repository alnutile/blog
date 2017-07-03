@extends('layouts.main')

@section('content')
<div id='page-title'>
    <h2>Products</h2>
</div>

<div id="wrapper" class="full">
    <hr>
    <div class="row-fluid">
        <div class="span7">
            <a class="statuschecker" href="https://www.packtpub.com/web-development/laravel-5x-cookbook">
                <img class="img-responsive img-thumbnail" src="https://s3.amazonaws.com/als-blog-production/smaller_book.jpg" alt=""/>
            </a>
        </div>
        <div class="span5">
            <h2>Laravel Recipe Book</h2>
            <p class="lead">
                Laravel 5.2 Recipe Cookbook!
                Check it out at <a href="https://www.packtpub.com/web-development/laravel-5x-cookbook">https://www.packtpub.com/web-development/laravel-5x-cookbook</a>
            </p>
        </div>
    </div> <!--end top row-->
    <hr>
    <div class="row-fluid">
        <div class="span6">
            <h2>DevelopersHangout.io PodCast</h2>
            <p class="lead">
                Developers get together; as often as possible, and discuss topics about coding and all that comes with it. These topics range from what we are reading, latest news, and comments about other podcasts we have listened to.
                Check it out at <a href="http://www.developershangout.io/">http://www.developershangout.io/</a>
            </p>
        </div>
        <div class="span6">
            <a class="devs" href="https://developershangout.io">
                <img class="img-responsive img-thumbnail" src="/images/devshangout.png" alt=""/>
            </a>
        </div>
    </div> <!--end top row-->
    <hr>
    <div class="row-fluid">
        <div class="span7">
            <a class="statuschecker" href="http://readorlisten.com/">
                <img class="img-responsive img-thumbnail" src="/images/readorlisten_logo.png" alt=""/>
            </a>
        </div>

        <div class="span5">
            <h2>ReadOrListen.com</h2>
            <p class="lead">
                Listen to some great articles read to you or read them yourself.
                Check it out at <a href="http://readorlisten.com">http://readorlisten.com</a>
            </p>
        </div>
    </div> <!--end top row-->

    <hr>
    <div class="row-fluid">
        <div class="span5">
            <h2>Incomings.io)</h2>
            <p class="lead">
                Need a central place to watch a complex application flow?

                Your App talks to a queue that talks to Iron.io worker that then talks to a queue and back to your app, and you have 5 places to watch the process? Now reduce it to ONE!


                Check it out at <a href="http://incomings.io/">http://incomings.io/</a>
            </p>
        </div>

        <div class="span7">
            <a class="statuschecker" href="https://incomings.io/">
                <img class="img-responsive img-thumbnail" src="/images/incomings.png" alt=""/>
            </a>
        </div>


    </div> <!--end top row-->
</div>
@stop