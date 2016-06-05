@extends('layouts.main')

@section('content')
<div id='page-title'>
    <h2>Learnings</h2>
</div>

<div id="wrapper" class="full">

    <div class="row-fluid">
        <div class="span12">
            <h3><i class="icon-book"></i> Colection of Readings, Podcasts etc</h3>
            <img src="/images/learnings.png" class="thumbnail">
            <br>
            <p class="lead">
                <span class="dropcap dark">J</span>ust wanted to stash here many of the books read, podcasts listened to, sites visited that have helped to bring about
                a better sense of code design, team work and overall day to day goals. 
            </p>
            <p class="lead"><span class="dropcap dark">A</span>lso check out my podcast
                <a class="btn btn-default btn-inverse" href='http://www.developershangout.io/'>
                    <i class="fa fa-icon-headphones"></i>&nbsp;DevelopersHangout.io</a></p>
        </div>
    </div> <!--end top row-->
    <hr>
    <div class="row-fluid">
        <div class="span8 separate">
            <h2>Books</h2>
            <p>
            <div class="media">
              <a class="pull-left" href="#">
                <img class="media-object" src="https://images-na.ssl-images-amazon.com/images/I/51MoTaVrS7L._SS130_.jpg" alt="clean code">
              </a>
              <div class="media-body">
                <h4 class="media-heading">The Clean Coder</h4>
                    <p>
                    <a href="https://kindle.amazon.com/work/the-clean-coder-professional-programmers-ebook/B004SJU478/B0050JLC9Y">The Clean Coder</a> by Robert Martin book is a look at being a "Professional" coder and all that comes with it.
                                                      It is a great look at not only how one should be in the role of a Programmer but what to expect of each other as a team.
                    </p>
              </div>
            </div>
            <div class="media">
              <a class="pull-left" href="#">
                <img class="media-object" src="https://images-na.ssl-images-amazon.com/images/I/51WLtI-uLcL._SS130_.jpg" alt="clean code">
              </a>
              <div class="media-body">
                <h4 class="media-heading">Domain Driven Design</h4>
                    <p>
                    <a href="https://kindle.amazon.com/work/domain-driven-design-tackling-complexity-software-ebook/B001KBG6RO/B00794TAUG">Domain Driven Design</a>
                                        A great look at being a programmer that not only makes code but more importantly bridges the gap between the vision of the business with the goals of the code.
                    </p>
              </div>
            </div>
              <div class="media">
                <a class="pull-left" href="#">
                  <img class="media-object" src="https://images-na.ssl-images-amazon.com/images/I/41XojFFhYlL._SS130_.jpg" alt="clean code">
                </a>
                <div class="media-body">
                  <h4 class="media-heading">Clean Code</h4>
                      <p>It is not about PHP directly but it all applies to good Oo PHP design patterns and thinking. There are so many classics he quotes that could be added here as well.</p>
                </div>
              </div>
                <div class="media">
                  <a class="pull-left" href="#">
                    <img class="media-object" src="https://s3.amazonaws.com/titlepages.leanpub.com/build-apis-you-wont-hate/small?1408731468" alt="clean code">
                  </a>
                  <div class="media-body">
                    <h4 class="media-heading">Build APIs You Won't Hate</h4>
                        <p>There are a number of great books on this as well. Right now a short and simple look at how to make an API, I think, is <a href="https://leanpub.com/build-apis-you-wont-hate">Build APIs You Won't Hate</a> by Phil Sturgeon. Great code example too on Behat and API testing</p>
                  </div>
                </div>
            </p>
            <hr>
            <h2> <a name="podcasts">Podcasts Episodes</a></h2>
            <p>
            <ul class="list" >
                <li>Pragmatic Programmers Podcast: <a href="https://pragprog.com/podcasts/show/32">Robert Martin interview</a></li>
                <li>Adventures in Angular: <a href="http://devchat.tv/adventures-in-angular/010-aia-preferred-backends">Preferred Backends</a></li>
                <li>RubyRogues: <a href="http://devchat.tv/ruby-rogues/186-rr-the-4-rules-of-simple-design-with-corey-haines">The 4 Rules of Simple Design with Corey Haine</a></li>
                <li>RubyRogues: <a href="http://devchat.tv/ruby-rogues/187-marketing-yourself-as-a-software-developer-with-john-sonmez">Marketing Yourself as a Software Developer with John Sonmez</a></li>
                <li>Javascript Jabber: <a href="http://devchat.tv/js-jabber/picks">#119 Chrome Apps with Joe Marini</a></li>
                <li>FullStack: Great interviews including this one with <a href='http://fullstackradio.com/episodes/9/'>DHH</a></li>
                <li>Laravel Podcast with Tyler Otwell and Jeffery Way <a href='http://www.laravelpodcast.com/'>laravel.io</a>
            </ul>
            </p>
            
            <hr>
            <h2>Presentations</h2>
            <p>
              <ul class="list">
                <li><a href="https://amsterdam2014.drupal.org/session/doing-behaviour-driven-development-behat">BDD from the creator of Behat</a></li>
              </ul>
            </p>
            <hr>
            <h2>Websites</h2>
            <p>
                <ul class="list">
                    <li><a href="http://mattstauffer.co/tags/laravel">Matt Stauffer great articles on Laravel</a></li>
                    <li><a href="http://laracasts.com">Laracasts for PHP or Laravel Programmers</a></li>
                    <li><a href="http://devchat.tv/adventures-in-angular/">Adventures in Angular</a> </li>
                    <li><a href="http://devchat.tv/ruby-rogues/">Ruby Rogues not matter what language you program in</a> </li>
                    
                </ul>
            </p>
            <hr>
        </div>
        <div class="span4 sidebar">
            <div class="more-info">
                <h3><i class="icon-globe"></i> Quotes</h3>
                <blockquote>
                     <p>"I get paid for code that works, not for tests, so my philosophy is to test as little as possible to reach a given level of confidence"</p>
                     - Kent Beck
                </blockquote>
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
