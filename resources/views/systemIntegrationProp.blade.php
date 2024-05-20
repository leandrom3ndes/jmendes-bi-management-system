@extends('layouts.default')
@section('content')
    <div ng-controller="systemIntegrationController">
        <h2>{{trans("systemIntegration/messages.Page_Name")}}</h2>
        <div growl></div>

        <br><br>
        <button id="btn-add" class="btn btn-primary btn-xs" ng-click="openModalFormProp('md', 0, 'add')">{{trans("systemIntegration/messages.BTNTABLE0")}}</button>
        <br><br>

        <div class="alert alert-danger" ng-show="tableParams.data.length == 0" ng-cloak>
            {{trans("systemIntegration/messages.EMPTY_TABLE")}}
        </div>

        <table ng-table="tableParams" class="table table-condensed table-bordered table-hover" ng-show="tableParams.data.length != 0" ng-init="getPropExtNames()" ng-cloak>
            <tr class="ng-table-group" ng-repeat-start="group in $groups">
                <td colspan="1">
                    <a href="" ng-click="group.$hideRows = !group.$hideRows">
                        <span class="glyphicon" ng-class="{ 'glyphicon-chevron-right': group.$hideRows, 'glyphicon-chevron-down': !group.$hideRows }"></span>
                        <strong>[[ group.value ]]</strong>
                    </a>
                </td>
            </tr>
            <tr ng-hide="group.$hideRows" ng-repeat="prop_ext_name in group.data" ng-repeat-end>
                <td sortable="'property_name'" filter="{name: 'text'}" data-title="'{{trans("systemIntegration/messages.THEADER1")}}'" groupable="'property_name'">
                    [[::prop_ext_name.property_name]]
                </td>

                <td sortable="'prop_ext_name_id'" data-title="'{{trans("systemIntegration/messages.THEADER2")}}'">
                    [[::prop_ext_name.prop_ext_name_id]]
                </td>

                <td sortable="'prop_ext_name'" data-title="'{{trans("systemIntegration/messages.THEADER3")}}'">
                    [[::prop_ext_name.prop_ext_name]]
                </td>

                <td data-title="'{{trans("systemIntegration/messages.THEADER7")}}'">
                    <button class="btn btn-warning btn-xs btn-detail" ng-click="openModalFormProp('md', prop_ext_name.prop_ext_name_id, 'edit')">{{trans("unitTypes/messages.BTNTABLE1")}}</button>
                    <button class="btn btn-danger btn-xs btn-delete" ng-click="removeProp(prop_ext_name.prop_ext_name_id)">{{trans("unitTypes/messages.BTNTABLE3")}}</button>
                </td>
            </tr>
        </table>
    </div>
@stop
@section('footerContent')
    <script src="<?= asset('app/controllers/systemintegration.js') ?>"></script>
@stop