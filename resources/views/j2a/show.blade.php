@extends('layouts.app')
<!-- -->
@section('content')

<div class="panel panel-default">
    @section('title', 'JSON to PHP Array')
    <div class="panel-heading">JSON to PHP Array</div>
    <div class="panel-body">
        <div class="alert alert-info">
            <i class="fa fa-lightbulb-o"></i> Just paste your JSON below and the tool will generate pasteable PHP array. Nice JSON generator
            <a target="_blank" href="https://www.json-generator.com/">here</a>
        </div>
        <j2a-tool></j2a-tool>
    </div>
</div>
@include("ads.google")
@endsection