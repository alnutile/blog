@extends('layouts.main') @include('posts/_editor') @section('content')
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

            <div class="form-group @if($errors->has('markdown')) has-error @endif">
                <label for="markdown">Body Markdown</label>
                <textarea class="form-control" id="markdown" rows="20" name="body">{{ is_null(old("body")) ? $post->body : old("body")}}</textarea> @push("scripts")
                <script>
                    var simplemde = new SimpleMDE({ element: document.getElementById("markdown") });
                </script> @endpush @if($errors->has("body"))
                <span class="help-block alert alert-warning">{{ $errors->first("body") }}</span>
                @endif
            </div>

            <div class="controls">
                <div class="checkbox">
                    <label class="checkbox">{{ Form::checkbox('active') }}Active</label>
                </div>
            </div>

            <div class="controls">
                {{ Form::submit('Update Post', array('class' => 'btn btn-success')) }}
                <br>
            </div>


            {{ Form::close() }} {{ Form::open(['method' => 'DELETE', 'action' => ['PostsController@destroy', $post->id]]) }}
            <button type="submit" class="btn btn-danger">Delete</button>
            {{ Form::close() }}
        </div>

    </div>
</div>
@stop