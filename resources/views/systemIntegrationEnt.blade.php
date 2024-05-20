@extends('layouts.default')
@section('content')
    <div ng-controller="systemIntegrationController">
        <h2>{{trans("systemIntegration/messages.Page_Name_ENT")}}</h2>
        <div growl></div>

        <br><br>
        <button id="btn-add" class="btn btn-primary btn-xs" ng-click="openModalFormEnt('md', 0, 'add')">{{trans("systemIntegration/messages.BTNTABLE3")}}</button>
        <br><br>

        <div class="alert alert-danger" ng-show="tableParams.data.length == 0" ng-cloak>
            {{trans("systemIntegration/messages.EMPTY_TABLE")}}
        </div>

        <table ng-table="tableParams" class="table table-condensed table-bordered table-hover" ng-show="tableParams.data.length != 0" ng-init="getEntTypes()" ng-cloak>
            <tr class="ng-table-group" ng-repeat-start="group in $groups">
                <td colspan="1">
                    <a href="" ng-click="group.$hideRows = !group.$hideRows">
                        <span class="glyphicon" ng-class="{ 'glyphicon-chevron-right': group.$hideRows, 'glyphicon-chevron-down': !group.$hideRows }"></span>
                        <strong>[[ group.value ]]</strong>
                    </a>
                </td>
            </tr>
            <tr ng-hide="group.$hideRows" ng-repeat="external_integration in group.data" ng-repeat-end>
                <td sortable="'ent_type_name'" filter="{ent_type_name: 'text'}" data-title="'{{trans("systemIntegration/messages.THEADERE1")}}'" groupable="'ent_type_name'">
                    [[::external_integration.ent_type_name]]
                </td>

                <td sortable="'external_integration_name'" data-title="'{{trans("systemIntegration/messages.THEADERE2")}}'">
                    [[::external_integration.external_integration_name]]
                </td>

                <td sortable="'task'" data-title="'{{trans("systemIntegration/messages.THEADERE3")}}'">
                    [[::external_integration.task]]
                </td>

                <td sortable="'t_state_id'" data-title="'{{trans("systemIntegration/messages.THEADERE4")}}'">
                    [[::external_integration.t_state_id]]
                </td>

                <td sortable="'t_state_name'" data-title="'{{trans("systemIntegration/messages.THEADERE5")}}'">
                    [[::external_integration.t_state_name]]
                </td>

                {{-- Caso tenha propriedades externas --}}
                <td ng-if="external_integration.prop_ext_name_id != null" sortable="'prop_ext_name_id'" data-title="'{{trans("systemIntegration/messages.THEADERE6")}}'">
                    [[::external_integration.prop_ext_name_id]]
                </td>

                <td ng-if="external_integration.prop_ext_name != null" sortable="'prop_ext_name'" data-title="'{{trans("systemIntegration/messages.THEADERE7")}}'">
                    [[::external_integration.prop_ext_name]]
                </td>

                {{-- Caso não tenha propriedades externas --}}
                <td ng-if="external_integration.prop_ext_name_id == null" sortable="'prop_ext_name_id'" data-title="'{{trans("systemIntegration/messages.THEADERE6")}}'">
                    {{trans("systemIntegration/messages.EMPTYPROPEXT")}}
                </td>
                <td ng-if="external_integration.prop_ext_name_id == null" sortable="'prop_ext_name'" data-title="'{{trans("systemIntegration/messages.THEADERE7")}}'">
                </td>

                <td data-title="'{{trans("systemIntegration/messages.THEADERE8")}}'">
                    <button class="btn btn-warning btn-xs btn-detail" ng-click="openModalFormEnt('md', external_integration.external_integration_id, 'edit')">{{trans("unitTypes/messages.BTNTABLE1")}}</button>
                    <button class="btn btn-danger btn-xs btn-delete" ng-click="removeEnt(external_integration.external_integration_id)">{{trans("unitTypes/messages.BTNTABLE3")}}</button>
                </td>
            </tr>
        </table>
    </div>
@stop
@section('footerContent')
    <script src="<?= asset('app/controllers/systemintegration.js') ?>"></script>
@stop