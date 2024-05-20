@extends('layouts.default')
@section('page_name')
    Dynamic Search Choose a Ent Type
@stop
@section('content')
    <div ng-controller="dynSearchController">
        <div growl></div>
        <br>
        <uib-tabset active="activeTabIndex" type="tabs">
            <uib-tab ng-repeat="tab in tabs" index="$index" heading="[[tab.title]]" disable="tab.disabled">
                <br>
                <div ng-include="tab.templateUrl" onload="data=mydata;curTab=mycur_tab;nextTab=mynext_tab"></div>
            </uib-tab>
        </uib-tabset>
    </div>
@stop
@section('footerContent')
<script src="<?= asset('app/controllers/dynSearch.js') ?>"></script>
@stop