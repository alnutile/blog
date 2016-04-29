@extends('layouts.main')

@section('content')
<div id='page-title'>
    <h2>Projects</h2>
</div>

<!--start: Wrapper-->
<div id="wrapper">
    <div class="row-fluid">
        <div class="span12 posts">
            @include('projects.top')
        </div>
    </div>
    <hr>
    <!-- start: Wall -->
    <div id="wall" class="row-fluid">
        @include('projects.grid', array('span' => 'span3'))
    </div>
</div>
@stop