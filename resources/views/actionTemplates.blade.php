@extends('layouts.default')
@section('page_name')
    Action Templates
@stop
@section('content')
    <div ng-controller="actionTemplatesController">
        <div growl></div>
        <br>
        <button id="btn-add" class="btn btn-primary btn-xs" ng-click="openModalForm('lg', 0, 'add')">Add New Action Template</button>
        <br><br>
        <div class="alert alert-danger" ng-show="tableParams==null">
            {{trans("transactionTypes/messages.EMPTY_TABLE")}} {{trans("transactionTypes/messages.Page_Name")}}
        </div>
        <table ng-table="tableParams" class="table table-condensed table-bordered table-hover" ng-show="tableParams!=null">
            <tr class="ng-table-group" ng-repeat-start="group in $groups">
                <td colspan="1">
                    <a href="" ng-click="group.$hideRows = !group.$hideRows">
                        <span class="glyphicon" ng-class="{ 'glyphicon-chevron-right': group.$hideRows, 'glyphicon-chevron-down': !group.$hideRows }"></span>
                        <strong>[[ group.value ]]</strong>
                    </a>
                </td>
            </tr>
            <tr ng-hide="group.$hideRows" ng-repeat="actiontemplate in group.data" ng-repeat-end>
                <td sortable="'id'" filter="{id: 'number'}" data-title="'ID Action Template'">
                    [[::actiontemplate.id]]
                </td>
                <td sortable="'transaction_type_name'" filter="{transaction_type_name: 'text'}" data-title="'Transaction Type'" groupable="'transaction_type_name'">
                    [[::actiontemplate.transaction_type_name]]
                </td>

                <td sortable="'t_state_name'" filter="{t_state_name: 'text'}" data-title="'T State'" groupable="'t_state_name'">
                    [[::actiontemplate.t_state_name]]
                </td>

                <td sortable="'flow_type'" filter="{flow_type: 'text'}" data-title="'Flow Type'" groupable="'flow_type'">
                    [[::actiontemplate.flow_type]]
                </td>

                <td sortable="'action_type'" filter="{action_type: 'text'}" data-title="'Action Type'" groupable="'action_type'">
                    [[::actiontemplate.action_type]]
                </td>

                <td sortable="'action_template_type'" filter="{action_template_type: 'text'}" data-title="'Action Template Type'" groupable="'action_template_type'">
                    [[::actiontemplate.action_template_type]]
                </td>

                <td>
                    <button class="btn btn-default btn-xs btn-detail" ng-click="openModalForm('lg', actiontemplate.id, 'edit')">{{trans("common.BTNTABLE1")}}</button>
                    <button class="btn btn-danger btn-xs btn-delete" ng-click="delete(actiontemplate.id)">{{trans("common.BTNTABLE3")}}</button>
                </td>
            </tr>
        </table>
</div>
@stop
@section('footerContent')
<script src="<?= asset('app/controllers/actionTemplates.js') ?>"></script>
@stop