@extends('layouts.main')

@section('content')
<div id='page-title'>
    <h2>Create Project </h2>
</div>

<div id="wrapper" class="full">

    <div class="row-fluid">

        <div class="">
            {{ Form::model('project', array('route' => array('projects.store'), 'files' => 'true', 'class' => 'form')) }}
            <label>Title</label>
            {{ Form::text('title', null, array('class' => 'controls span6')) }}

            <label>Tags</label>
            {{ Form::text('tags', null, array('class' => 'controls span6')) }}

            <label>Body</label>
            {{ Form::textarea('body', null, array('rows' => 80, 'class' => 'controls span12')) }}
            <div class="controls">
                <div class="checkbox">
                    <label class="checkbox">{{ Form::checkbox('active') }}Active</label>
                </div>
            </div>

            <div class="controls">
                <div class="checkbox">
                    <label class="checkbox">File</label>{{ Form::file('photo_file_name') }}
                </div>
            </div>

            <div class="controls">
                {{ Form::submit('Create Project', array('class' => 'btn btn-success')) }}
                <br>
            </div>

            {{ Form::close() }}
        </div>

    </div></div>
@stop