@extends('layouts.app')
<!-- -->
@section('content')
<div class="panel panel-default">
    @section('title', 'PHP Array to JSON')
    <div class="panel-heading">PHP Array to JSON</div>
    <div class="panel-body">
        <div class="alert alert-info">
            <i class="fa fa-lightbulb-o"></i>
            Just paste your Array below and the tool will generate pasteable JSON
        </div>
        <a2j-tool></a2j-tool>
    </div>
</div>
@endsection