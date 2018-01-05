@extends('layouts.ads')
<!-- -->
@section('content')

<div class="panel panel-default">
    @section('title', 'Example Help')
    <div class="panel-heading">Example Help Output</div>
    <div class="panel-body">
        <div class="alert alert-info">
            Download file
            <a href="{{ route('pdf') }}">here</a>
        </div>
        {!! $help !!}
    </div>
</div>

@endsection