@extends('layouts.main')


@section('content')
<div id='page-title'>
    <h2>Blog &amp; Stuff</h2>
</div>

<div id="wrapper" class="full">
    <div class="row-fluid">
        <div class="span8 posts">
            <div class="post first last">
                <div class="post-content">
                    <div class="post-title">
                        <h2>
                            {{$post->title}}
                        </h2>
                    </div>
                    <div class="createdate">
                        <strong>Posted:</strong> {{$post->created_at}}
                    </div>
                    <div class="post-description">
                        @if ($post->rendered_body && $post->rendered_body != 'Not Done Yet')
                            {!! $post->rendered_body !!}
                        @else
                            {!! $post->body !!}
                        @endif
                    </div>
                    <hr>
                    <div class="tags">
                        <h3>Tags:</h3>
                        @foreach($post->tags as $tag)
                            <a href="/tags/{{$tag->id}}">{{$tag->name}}</a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div>
                @if(App::environment() != 'local')
                  @include('shared._disqus')
                @endif
            </div>
        </div>
        <div class="span4 sidebar hidden-phone">

            @if (Auth::user())
                <a href="/posts/{{$post->id}}/edit" class="btn btn-success">edit</a>
            @endif
            @include('shared._podcast')

            @include('shared.contactme')
            <div>
                <h2>Articles</h2>
                @include('posts.blog_sidebar')
            </div>

        </div>
    </div>
</div>

<!-- had issues merging these in not sure why yet-->
<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js?skin=sons-of-obsidian"></script>
<script src="/lib/google-code-prettify/lang-css.js"></script>
<script defer="defer" src="/lib/google-code-prettify/prettify.js"></script>

@stop

