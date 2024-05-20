@extends('layouts.default')
@section('content')
    <div ng-controller="propAllowedValueController">
        <h2>{{trans("propAllowedValues/messages.Page_Name")}}</h2>
        <div growl></div>

        {{--<button class="btn btn-default btn-xs btn-detail" ng-click="dotranslate()">TRANSLATE</button>--}}

        <br><br>
        <button id="btn-add" class="btn btn-primary btn-xs" ng-click="openModalForm('md', 0, 'add')">{{trans("propAllowedValues/messages.THEADER7")}}</button>
        <br><br>

        <div class="alert alert-danger" ng-show="tableParams.data.length == 0" ng-cloak>
            {{trans("propAllowedValues/messages.EMPTY_TABLE")}}
        </div>

        <table ng-table="tableParams" class="table table-condensed table-bordered table-hover" ng-show="tableParams.data.length != 0" ng-cloak>
            <tr class="ng-table-group" ng-repeat-start="group in $groups">
                <td colspan="1">
                    <a href="" ng-click="group.$hideRows = !group.$hideRows">
                        <span class="glyphicon" ng-class="{ 'glyphicon-chevron-right': group.$hideRows, 'glyphicon-chevron-down': !group.$hideRows }"></span>
                        <strong>[[ group.value ]]</strong>
                    </a>
                </td>
            </tr>
            <tr ng-hide="group.$hideRows" ng-repeat="prop_all_value in group.data" ng-repeat-end>
                <td sortable="'ent_name'" filter="{ent_name: 'text'}" data-title="'{{trans("propAllowedValues/messages.THEADER1")}}'" groupable="'ent_name'"> <!--Entity Type Name-->
                    [[::prop_all_value.ent_name]]
                </td>

                <td sortable="'prop_id'" filter="{prop_id: 'number'}"data-title="'{{trans("propAllowedValues/messages.THEADER2")}}'" groupable="'prop_id'"> <!--Entity Type Id-->
                    [[::prop_all_value.prop_id]]
                </td>

                <td sortable="'prop_name'" filter="{prop_name: 'text'}" data-title="'{{trans("propAllowedValues/messages.THEADER3")}}'" groupable="'prop_name'"> <!--Entity Type Name-->
                    [[::prop_all_value.prop_name]]
                </td>

                <td sortable="'prop_all_value_id'" filter="{prop_all_value_id: 'number'}" data-title="'{{trans("propAllowedValues/messages.THEADER4")}}'" ng-if="prop_all_value.prop_all_value_name == null" colspan="4"> <!--Prop Allowed Value Id-->
                    [["THEADER_EMPTY_VALUES" | translate]]
                </td>

                <td sortable="'prop_all_value_id'" filter="{prop_all_value_id: 'number'}" data-title="'{{trans("propAllowedValues/messages.THEADER4")}}'" ng-if="prop_all_value.prop_all_value_name != null"> <!--Prop Allowed Value Id-->
                    [[ ::prop_all_value.prop_all_value_id ]]
                </td>

                {{--Não apresentar nada nas ultima Duas colunas, caso não existe Prop allowed Values--}}
                <td sortable="'prop_all_value_name'" data-title="'{{trans("propAllowedValues/messages.THEADER5")}}'" ng-if="prop_all_value.prop_all_value_name == null"> <!--Prop Allowed Value Name-->
                </td>

                <td data-title="Action" ng-if="prop_all_value.prop_all_value_name == null">
                </td>

                {{--Apresentar nada nas ultima Duas colunas, caso existe Prop allowed Values--}}
                <td sortable="'prop_all_value_name'" data-title="'{{trans("propAllowedValues/messages.THEADER5")}}'" ng-if="prop_all_value.prop_all_value_name != null"> <!--Prop Allowed Value Name-->
                    [[ ::prop_all_value.prop_all_value_name ]]
                </td>

                <td data-title="Action" ng-if="prop_all_value.prop_all_value_name != null">
                    <button class="btn btn-warning btn-xs btn-detail" ng-click="openModalForm('md', prop_all_value.prop_all_value_id , 'edit')">{{trans("propAllowedValues/messages.BTNTABLE1")}}</button>
                    {{--<button class="btn btn-primary btn-xs btn-delete">[[ "BTNTABLE2" | translate]]</button>--}}
                    <button class="btn btn-danger btn-xs btn-delete" ng-click="remove(prop_all_value.prop_all_value_id)">{{trans("propAllowedValues/messages.BTNTABLE3")}}</button>
                </td>

            </tr>
        </table>
    </div>
@stop
@section('footerContent')
    <script src="<?= asset('app/controllers/propallowedvalue.js') ?>"></script>
@stop
