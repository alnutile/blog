@extends('layouts.main')


@section('content')
<div id='page-title'>
    <h2>Blog & Stuff</h2>
</div>

<div id="wrapper" class="full">
    <div class="row-fluid">
        @include('posts.search')
    </div>

    <div class="row-fluid">
        <div class="span8 posts">
            @include('posts.list')
        </div>
        <div class="sidebar span4 hidden-phone">
            @if(Auth::user())
            <a class="btn btn-success" href="/posts/create">create</a>
            @endif
            @include('shared._podcast')
            @include('shared._book')
            @include('shared.contactme')
            <div>
                <h2>Articles</h2>
                @include('posts.blog_sidebar')
            </div>
        </div>
    </div>
</div>
@stop