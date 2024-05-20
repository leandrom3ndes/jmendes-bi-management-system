@extends('layouts.default')
@section('page_name')
    Action Rules
@stop
@section('content')
    <div ng-controller="actionRulesController">
        <div growl></div>
        <br>
        <button id="btn-add" class="btn btn-primary btn-xs" ng-click="openModalForm('md', 0, 'add')">Add New Action Rule</button>
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
            <tr ng-hide="group.$hideRows" ng-repeat="actionrule in group.data" ng-repeat-end>
                <td sortable="'id'" filter="{id: 'number'}" data-title="'ID'">
                    [[::actionrule.id]]
                </td>
                <td sortable="'transaction_type_name'" filter="{transaction_type_name: 'text'}" data-title="'Transaction Type'" groupable="'transaction_type_name'">
                    [[::actionrule.transaction_type_name]]
                </td>

                <td sortable="'t_state_name'" filter="{t_state_name: 'text'}" data-title="'T State'" groupable="'t_state_name'">
                    [[::actionrule.t_state_name]]
                </td>

                <td>
                    <button class="btn btn-default btn-xs btn-detail" ng-click="openModalForm('md', actionrule.id, 'edit')">{{trans("common.BTNTABLE1")}}</button>
                    <button class="btn btn-info btn-xs btn-detail" ng-click="openModalFormActions('lg', actionrule.id, '', 0)">Add New Action</button>
                    <button class="btn btn-info btn-xs btn-detail" ng-click="openModalViewActions('lg', actionrule.id)">View Actions</button>
                    <button class="btn btn-info btn-xs btn-detail" ng-click="blockly(actionrule.id)">Blockly</button>
                    <button class="btn btn-danger btn-xs btn-delete" ng-click="delete(transactiontype.id)">{{trans("common.BTNTABLE3")}}</button>
                </td>
            </tr>
        </table>
</div>
@stop
@section('footerContent')
<script src="<?= asset('app/controllers/actionRules.js') ?>"></script>
@stop