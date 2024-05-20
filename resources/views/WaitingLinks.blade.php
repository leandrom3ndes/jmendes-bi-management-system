@extends('layouts.default')
@section('content')
    <div ng-controller="WaitingLinksController">
        <h2>{{trans("waitingLinks/messages.Page_Name")}}</h2>
        <div growl></div>
        <br><br>
        <button id="btn-add" class="btn btn-primary btn-xs" ng-click="openModalForm('md', 0, 'add')">{{trans("waitingLinks/messages.THEADER11")}}</button>
        <br><br>
        <div class="alert alert-danger" ng-show="tableParams==null">
            {{trans("waitingLinks/messages.EMPTY_TABLE")}} {{trans("waitingLinks/messages.Page_Name")}}
        </div>
        <table ng-table="tableParams" class="table table-condensed table-bordered table-hover" ng-show="tableParams!=null" ng-cloak>
            <tr class="ng-table-group" ng-repeat-start="group in $groups">
                <td colspan="1">
                    <a href="" ng-click="group.$hideRows = !group.$hideRows">
                        <span class="glyphicon" ng-class="{ 'glyphicon-chevron-right': group.$hideRows, 'glyphicon-chevron-down': !group.$hideRows }"></span>
                        <strong>[[ group.value ]]</strong>
                    </a>
                </td>
            </tr>
            <tr ng-hide="group.$hideRows" ng-repeat="waitinglink in group.data" ng-repeat-end>
                <td sortable="'id'" filter="{id: 'number'}" data-title="'{{trans("waitingLinks/messages.THEADER1")}}'"> <!--ID-->
                    [[::waitinglink.id]]
                </td>

                <td sortable="'tp1_waited_t'" filter="{tp1_causing_t: 'text'}" data-title="'{{trans("waitingLinks/messages.THEADER2")}}'" groupable="'tp1_waited_t'"> <!--Causing_T-->
                    [[::waitinglink.tp1_waited_t]]
                </td>

                <td sortable="'wfname1_waited_act'" filter="{wfname1_waited_act: 'number'}" data-title="'{{trans("waitingLinks/messages.THEADER3")}}'" groupable="'wfname1_waited_act'"> <!--T_State-->
                    [[::waitinglink.wfname1_waited_act]]
                </td>

                <td sortable="'tp2_waiting_t'" filter="{tp2_waiting_t: 'text'}" data-title="'{{trans("waitingLinks/messages.THEADER4")}}'" groupable="'tp2_waiting_t'"> <!--Caused_T-->
                    [[::waitinglink.tp2_waiting_t]]
                </td>

                <td sortable="'wfname2_waiting_act'" filter="{wfname2_waiting_act: 'text'}" data-title="'{{trans("waitingLinks/messages.THEADER5")}}'" groupable="'wfname2_waiting_act'"> <!--Caused_T-->
                    [[::waitinglink.wfname2_waiting_act]]
                </td>

                <td sortable="'min'" filter="{min: 'text'}" data-title="'{{trans("waitingLinks/messages.THEADER6")}}'"> <!--Min-->
                    [[::waitinglink.min]]
                </td>

                <td sortable="'max'" filter="{max: 'text'}" data-title="'{{trans("waitingLinks/messages.THEADER7")}}'"> <!--Max-->
                    [[::waitinglink.max]]
                </td>

                <td sortable="'created_at'" data-title="'{{trans("waitingLinks/messages.THEADER8")}}'"> <!--Created_at-->
                    [[ ::waitinglink.created_at ]]
                </td>

                <td sortable="'updated_at'" data-title="'{{trans("waitingLinks/messages.THEADER9")}}'"> <!--Updated_at-->
                    [[ ::waitinglink.updated_at ]]
                </td>

                <td sortable="'updated_at'" data-title="'{{trans("waitingLinks/messages.THEADER10")}}'"> <!--Deleted_at-->
                    [[ ::waitinglink.updated_at ]]
                </td>

                <td>
                    <button class="btn btn-default btn-xs btn-detail" ng-click="openModalForm('md', waitinglink.id, 'edit')">{{trans("waitingLinks/messages.BTNTABLE1")}}</button>
                    <button class="btn btn-danger btn-xs btn-delete" ng-click="delete(waitinglink.id)">{{trans("waitingLinks/messages.BTNTABLE3")}}</button>
                </td>
            </tr>
        </table>
    </div>
@stop
@section('footerContent')
    <script src="<?= asset('app/controllers/WaitingLinks.js') ?>"></script>
@stop