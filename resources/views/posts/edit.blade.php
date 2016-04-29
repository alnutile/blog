@extends('layouts.main')

@section('content')
<div id='page-title'>
    <h2>Update Post {{ $post->title }}</h2>
</div>

<div id="wrapper" class="full">

    <div class="row-fluid">
        <div class="">
            {{ Form::model($post, array('method' => 'PUT', 'route' => array('posts.update', $post->id), 'class' => 'form')) }}
            <label>Title</label>
            {{ Form::text('title', null, array('class' => 'controls span6')) }}

            <label>Tags</label>
            {{ Form::text('tags', $tags_string, array('class' => 'controls span6')) }}

            <label>Body</label>
            {{ Form::textarea('body', null, array('rows' => 80, 'class' => 'controls span12')) }}
            <div class="controls">
                <div class="checkbox">
                    <label class="checkbox">{{ Form::checkbox('active') }}Active</label>
                </div>
            </div>
            <div class="controls">
                {{ Form::submit('Update Post', array('class' => 'btn btn-success')) }}
                <br>
            </div>


            {{ Form::close() }}

            {{ Form::open(['method' => 'DELETE', 'action' => ['PostsController@destroy', $post->id]]) }}
                <button type="submit" class="btn btn-danger">Delete</button>
            {{ Form::close() }}
        </div>

    </div></div>
@stop