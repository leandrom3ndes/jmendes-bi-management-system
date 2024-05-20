@extends('layouts.default')
@section('content')
    <div ng-controller="CausalLinksController">
        <h2>{{trans("causalLinks/messages.Page_Name")}}</h2>
        <div growl></div>
        <br><br>
        <button id="btn-add" class="btn btn-primary btn-xs" ng-click="openModalForm('md', 0, 'add')">{{trans("causalLinks/messages.THEADER10")}}</button>
        <br><br>
        <div class="alert alert-danger" ng-show="tableParams==null">
            {{trans("causalLinks/messages.EMPTY_TABLE")}} {{trans("causalLinks/messages.Page_Name")}}
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
            <tr ng-hide="group.$hideRows" ng-repeat="causallink in group.data" ng-repeat-end>
                <td sortable="'id'" filter="{id: 'number'}" data-title="'{{trans("causalLinks/messages.THEADER1")}}'"> <!--ID-->
                    [[::causallink.id]]
                </td>

                <td sortable="'tp1_causing_t'" filter="{tp1_causing_t: 'text'}" data-title="'{{trans("causalLinks/messages.THEADER2")}}'" groupable="'tp1_causing_t'"> <!--Causing_T-->
                    [[::causallink.tp1_causing_t]]
                </td>

                <td sortable="'t_state_name'" filter="{t_state_name: 'number'}" data-title="'{{trans("causalLinks/messages.THEADER3")}}'" groupable="'t_state_name'"> <!--T_State-->
                    [[::causallink.t_state_name]]
                </td>

                <td sortable="'tp2_caused_t'" filter="{tp2_caused_t: 'text'}" data-title="'{{trans("causalLinks/messages.THEADER4")}}'" groupable="'tp2_caused_t'"> <!--Caused_T-->
                    [[::causallink.tp2_caused_t]]
                </td>

                <td sortable="'min'" filter="{min: 'text'}" data-title="'{{trans("causalLinks/messages.THEADER5")}}'"> <!--Min-->
                    [[::causallink.min]]
                </td>

                <td sortable="'max'" filter="{max: 'text'}" data-title="'{{trans("causalLinks/messages.THEADER6")}}'"> <!--Max-->
                    [[::causallink.max]]
                </td>

                <td sortable="'created_at'" data-title="'{{trans("causalLinks/messages.THEADER7")}}'"> <!--Created_at-->
                    [[ ::causallink.created_at ]]
                </td>

                <td sortable="'updated_at'" data-title="'{{trans("causalLinks/messages.THEADER8")}}'"> <!--Updated_at-->
                    [[ ::causallink.updated_at ]]
                </td>

                <td sortable="'updated_at'" data-title="'{{trans("causalLinks/messages.THEADER9")}}'"> <!--Deleted_at-->
                    [[ ::causallink.updated_at ]]
                </td>

                <td>
                    <button class="btn btn-default btn-xs btn-detail" ng-click="openModalForm('md', causallink.id, 'edit')">{{trans("causalLinks/messages.BTNTABLE1")}}</button>
                    <button class="btn btn-danger btn-xs btn-delete" ng-click="delete(causallink.id)">{{trans("causalLinks/messages.BTNTABLE3")}}</button>
                </td>
            </tr>
        </table>
    </div>
@stop
@section('footerContent')
    <script src="<?= asset('app/controllers/CausalLinks.js') ?>"></script>
@stop