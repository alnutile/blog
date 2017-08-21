@extends('layouts.main')


@include('posts/_editor')
@section('content')
<div id='page-title'>
    <h2>Create a Project</h2>
</div>

<div id="wrapper" class="full">

    <div class="row-fluid">


<div class="">
    {{ Form::model('post', array('route' => array('posts.store'), 'class' => 'form')) }}
        <label>Title</label>
        {{ Form::text('title', null, array('class' => 'controls span6')) }}

        <label>Tags</label>
        {{ Form::text('tags', null, array('class' => 'controls span6')) }}

        <label>Body</label>

        <div class="form-group">
            <label for="markdown">Body Markdown</label>
            <textarea class="form-control" id="markdown"
                      rows="20" name="body"></textarea>
            <script>
                var simplemde = new SimpleMDE({ element: document.getElementById("markdown") });
            </script>
        </div>

          <div class="controls">
            <div class="checkbox">
                <label class="checkbox">{{ Form::checkbox('active') }}Active</label>
            </div>
        </div>

        <label>Schedule</label>
        {{ Form::text('scheduled', null, array('class' => 'controls span6 scheduler')) }}
        <div class="help-block">Only works if created with Active NOT checked.</div>

        <div class="controls">
            {{ Form::submit('Create Post', array('class' => 'btn btn-success')) }}
        </div>


    {{ Form::close() }}
</div>

    </div></div>
@stop