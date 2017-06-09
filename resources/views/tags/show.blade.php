@extends('layouts.main')

@section('content')

        <div id='page-title'>
            <h2>Tag {{$tag->name}}</h2>
        </div>

        <!--start: Wrapper-->
        <div id="wrapper">
            <div class="row-fluid">
                <div class="span12 posts">
                    <div class="span3 ">
                        <h2>Tag: {{$tag->name}}</h2>
                    </div>
                    <div class="span6">
                        <h2>All related tags</h2>
                        <div class="tags">
                            @foreach ($tagsAll as $tag)
                                <a href="/tags/{{$tag['id']}}">
                                    <i class="icon icon-tag"></i>{{$tag['name']}}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="span3">
                        <h2>Content Types</h2>
                        <a href="/projects"><i class="icon icon-file"></i>Project</a>
                        <br>
                        <a href="/posts"><i class="icon icon-file"></i>Posts</a>
                    </div>
                </div>
            </div>
            <hr>

            <!-- start: Wall -->
            <div class="row-fluid">
                <div class="span6">
                    <h2>Projects</h2>
                    <div id="wall" class="row-fluid">
                        @if(count($posts) == 0)
                            Sorry no projects with this tag. :(
                        @else
                            @include('projects.grid', array('span' => 'span6'))
                        @endif
                    </div>
                </div>
                <div class="span6">
                    <h2>Posts</h2>
                    @if(count($posts) == 0)
                        Sorry no posts with this tag. :(
                    @else
                        @include('posts.blog_sidebar')
                    @endif
                </div>
            </div>
        </div>


@endsection