@extends('layouts.default')
@section('content')
    <div ng-controller="dActionController">
        <h2>{{trans("dAction/messages.Page_Name")}}</h2>
        <div growl></div>

        <br><br>
        <button id="btn-add" class="btn btn-primary btn-xs" ng-click="openModalForm('md', 0, 'add')">{{trans("dAction/messages.BTNTABLE3")}}</button>
        <br><br>

        <div class="alert alert-danger" ng-show="tableParams==null" ng-cloak>
            {{trans("dAction/messages.EMPTY_TABLE")}}
        </div>

        <table ng-table="tableParams" class="table table-condensed table-bordered table-hover" ng-show="tableParams.data.length != 0" ng-init="getDataActions()" ng-cloak>
            <tr class="ng-table-group" ng-repeat-start="group in $groups">
                <td colspan="1">
                    <a href="" ng-click="group.$hideRows = !group.$hideRows">
                        <span class="glyphicon" ng-class="{ 'glyphicon-chevron-right': group.$hideRows, 'glyphicon-chevron-down': !group.$hideRows }"></span>
                        <strong>[[ group.value ]]</strong>
                    </a>
                </td>
            </tr>
            <tr ng-hide="group.$hideRows" ng-repeat="d_action in group.data" ng-repeat-end>

                <td sortable="'d_action_name'" filter="{d_action_name: 'text'}" data-title="'{{trans("dAction/messages.THEADERE0")}}'" groupable="'d_action_name'">
                    [[::d_action.transaction_type_name]]
                </td>

                <td sortable="'transaction_type_name'" filter="{transaction_type_name: 'text'}" data-title="'{{trans("dAction/messages.THEADERE1")}}'" groupable="'transaction_type_name'">
                    [[::d_action.transaction_type_name]]
                </td>

                <td sortable="'t_state_id'" data-title="'{{trans("dAction/messages.THEADERE2")}}'">
                    [[::d_action.t_state_id]]
                </td>

                <td sortable="'t_state_name'" data-title="'{{trans("dAction/messages.THEADERE3")}}'">
                    [[::d_action.t_state_name]]
                </td>

                <td sortable="'type'" data-title="'{{trans("dAction/messages.THEADERE4")}}'">
                    [[::d_action.type]]
                </td>

                <td data-title="'{{trans("dAction/messages.THEADERE5")}}'">
                    <button class="btn btn-warning btn-xs btn-detail" ng-click="openModalForm('md', d_action.id, 'edit')">{{trans("dAction/messages.BTNTABLE1")}}</button>
                    <button class="btn btn-danger btn-xs btn-delete" ng-click="remove(d_action.id)">{{trans("dAction/messages.BTNTABLE2")}}</button>
                </td>
            </tr>
        </table>
    </div>
@stop
@section('footerContent')
    <script src="<?= asset('app/controllers/dAction.js') ?>"></script>
@stop