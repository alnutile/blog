@extends('layouts.app')
<!-- -->
@section('content')
@include("ads.google")
<div class="panel panel-default">
    @section('title', 'YACG Yet Another CodeName Generator')
    <div class="panel-heading">YACG Yet Another CodeName Generator</div>
    <div class="panel-body">
        <div class="alert alert-info">
            <i class="fa fa-lightbulb-o"></i> Using the api "https://api.themoviedb.org" I get some of the worse moves made and generate a codename!
        </div>
        <codename-tool></codename-tool>
    </div>
</div>
@endsection