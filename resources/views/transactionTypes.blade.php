@extends('layouts.default')
@section('page_name')
    {{trans("transactionTypes/messages.Page_Name")}}
@stop
@section('content')
    <div ng-controller="transactionTypesController">
        <div growl></div>
        <br>
        <button id="btn-add" class="btn btn-primary btn-xs" ng-click="openModalForm('md', 0, 'add')">{{trans("transactionTypes/messages.THEADER10")}}</button>
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
            <tr ng-hide="group.$hideRows" ng-repeat="transactiontype in group.data" ng-repeat-end>
                <td sortable="'name'" filter="{name: 'text'}" data-title="'{{trans("transactionTypes/messages.THEADER5")}}'" groupable="'name'">
                    [[::transactiontype.name]]
                </td>
                <td sortable="'id'" filter="{id: 'number'}" data-title="'{{trans("transactionTypes/messages.THEADER1")}}'">
                    [[::transactiontype.id]]
                </td>
                <td sortable="'t_name'" filter="{t_name: 'text'}" data-title="'{{trans("transactionTypes/messages.THEADER2")}}'" groupable="'t_name'">
                    [[::transactiontype.t_name]]
                    <button ng-if="transactiontype.language_id != '{{$user_lang_id}}'" class="btn btn-success btn-xs btn-detail" ng-click="openModalForm('md', transactiontype.id, 'add_name_lang')">{{trans("common.BTNADDNAMELANG")}}</button>
                </td>
                <td sortable="'rt_name'" filter="{rt_name: 'text'}" data-title="'{{trans("transactionTypes/messages.THEADER3")}}'" groupable="'rt_name'">
                    [[::transactiontype.rt_name]]
                </td>

                <td sortable="'init_proc'" data-title="'{{trans("transactionTypes/messages.THEADER14")}}'" groupable="'init_proc'">
                    [[transactiontype.init_proc === 1 ? '{{trans("transactionTypes/modalTransactionTypes.INPUT_INIT_PROC_OPT1")}}' : '{{trans("transactionTypes/modalTransactionTypes.INPUT_INIT_PROC_OPT2")}}']]
                </td>

                <td sortable="''" data-title="'{{trans("transactionTypes/messages.THEADER15")}}'">
                    <button class="btn btn-default btn-xs btn-detail" ng-click="openModalFormActorsIniciates('md', transactiontype.id)">{{trans("transactionTypes/messages.BTNTABLE4")}}</button>
                    <button class="btn btn-default btn-xs btn-detail" ng-click="openModalFormViewActorIniciatesT('md', transactiontype.id)">{{trans("transactionTypes/messages.BTNTABLE5")}}</button>
                </td>

                <td sortable="'auto_activate'" data-title="'{{trans("transactionTypes/messages.THEADER11")}}'" groupable="'auto_activate'">
                    [[::transactiontype.auto_activate === 1 ? '{{trans("transactionTypes/modalTransactionTypes.INPUT_INIT_PROC_OPT1")}}' : '{{trans("transactionTypes/modalTransactionTypes.INPUT_INIT_PROC_OPT2")}}']]
                </td>

                <td sortable="'freq_activate'" data-title="'{{trans("transactionTypes/messages.THEADER12")}}'" groupable="'freq_activate'">
                    [[::transactiontype.freq_activate]]
                </td>

                <td sortable="'when_activate'" data-title="'{{trans("transactionTypes/messages.THEADER13")}}'" groupable="'when_activate'">
                    [[::transactiontype.when_activate]]
                </td>

                <td sortable="'state'" data-title="'{{trans("transactionTypes/messages.THEADER4")}}'" groupable="'state'">
                    [[::transactiontype.state == 'active' ? '{{trans("transactionTypes/modalTransactionTypes.INPUT_STATE_OPT1")}}' : '{{trans("transactionTypes/modalTransactionTypes.INPUT_STATE_OPT2")}}']]

                </td>

                <td sortable="'created_at'" data-title="'{{trans("transactionTypes/messages.THEADER7")}}'">
                    [[ ::transactiontype.created_at ]]
                </td>

                <td sortable="'updated_at'" data-title="'{{trans("transactionTypes/messages.THEADER8")}}'">
                    [[ ::transactiontype.updated_at ]]
                </td>

                <td sortable="'executer'" data-title="'{{trans("transactionTypes/messages.THEADER6")}}'">
                    [[ ::transactiontype.actor_name_executer ]]
                </td>

                <td ng-if="transactiontype.language_id == '{{$user_lang_id}}'">
                    <button class="btn btn-default btn-xs btn-detail" ng-click="openModalForm('md', transactiontype.id, 'edit')">{{trans("common.BTNTABLE1")}}</button>
                    <button class="btn btn-danger btn-xs btn-delete" ng-click="delete(transactiontype.id)">{{trans("common.BTNTABLE3")}}</button>
                </td>
            </tr>
        </table>
</div>
@stop
@section('footerContent')
<script src="<?= asset('app/controllers/transactionTypes.js') ?>"></script>
@stop