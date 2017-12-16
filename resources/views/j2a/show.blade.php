@extends('layouts.app')
<!-- -->
@section('content')
<div id='page-title'>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    @section('title', 'JSON to PHP Array')
                    <div class="panel-heading">JSON to PHP Array</div>
                    <div class="panel-body">
                        <div class="alert alert-info">
                            <i class="fa fa-lightbulb-o"></i> Just paste your JSON below and the tool will generate pasteable PHP array. Nice JSON generator <a target="_blank" href="https://www.json-generator.com/">here</a>
                        </div>
                        <j2a-tool></j2a-tool>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="alignleft">
                    <script type="text/javascript">
                        amzn_assoc_ad_type = "banner";
                        amzn_assoc_marketplace = "amazon";
                        amzn_assoc_region = "US";
                        amzn_assoc_placement = "assoc_banner_placement_default";
                        amzn_assoc_campaigns = "electronics";
                        amzn_assoc_banner_type = "rotating";
                        amzn_assoc_p = "12";
                        amzn_assoc_width = "300";
                        amzn_assoc_height = "250";
                        amzn_assoc_tracking_id = "alfrednutilei-20";
                        amzn_assoc_linkid = "537c575b38fbade299d5e43bf362fcae";
                    </script>
                    <script src="//z-na.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&Operation=GetScript&ID=OneJS&WS=1"></script>
                </div>
            </div>
        </div>
        @endsection