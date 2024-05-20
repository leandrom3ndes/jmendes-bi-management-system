@extends('layouts.default')
@section('content')
    <div ng-controller="entityTypesController">
        <h2>{{trans("entTypes/messages.Page_Name")}}</h2>
        <div growl></div>
        <br><br>
        <button id="btn-add" class="btn btn-primary btn-xs" ng-click="openModalForm('md', 0, 'add')">{{trans("entTypes/messages.THEADER11")}}</button>
        <br><br>
        <div class="alert alert-danger" ng-show="tableParams==null" ng-cloak>
            {{trans("entTypes/messages.EMPTY_TABLE")}} {{trans("entTypes/messages.Page_Name")}}
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
            <tr ng-hide="group.$hideRows" ng-repeat="entitytype in group.data" ng-repeat-end>
                <td sortable="'process_type_name'" filter="{process_type_name: 'text'}" data-title="'{{trans("entTypes/messages.THEADER1")}}'" groupable="'process_type_name'"> <!--Process Type-->
                    [[entitytype.process_type_name]]
                </td>

                <td sortable="'transaction_type_t_name'" filter="{transaction_type_t_name: 'number'}" data-title="'{{trans("entTypes/messages.THEADER2")}}'" groupable="'transaction_type_t_name'"> <!--Transaction Type-->
                    [[entitytype.transaction_type_t_name]]
                </td>

                <td sortable="'id'" filter="{id: 'number'}" data-title="'{{trans("entTypes/messages.THEADER3")}}'" groupable="'id'"> <!--ID-->
                    [[entitytype.id]]
                </td>

                <td sortable="'ent_type_name'" filter="{ent_type_name: 'text'}" data-title="'{{trans("entTypes/messages.THEADER4")}}'" groupable="'ent_type_name'"> <!--Entity Type-->
                    [[entitytype.ent_type_name]]
                    <button ng-if="entitytype.language_id != '{{$user_lang_id}}'" class="btn btn-success btn-xs btn-detail" ng-click="openModalForm('md', entitytype.id, 'add_name_lang')">{{trans("common.BTNADDNAMELANG")}}</button>
                </td>

                <td sortable="'state'" data-title="'{{trans("entTypes/messages.THEADER7")}}'" groupable="'state'"> <!--State-->
                    [[::entitytype.state == 'active' ? '{{trans("entTypes/modalEntTypes.INPUT_STATE_OPT1")}}' : '{{trans("entTypes/modalEntTypes.INPUT_STATE_OPT2")}}']]

                </td>

                <td sortable="'created_at'" data-title="'{{trans("entTypes/messages.THEADER8")}}'"> <!--Created_at-->
                    [[ ::entitytype.created_at ]]
                </td>

                <td sortable="'updated_at'" data-title="'{{trans("entTypes/messages.THEADER9")}}'"> <!--Updated_at-->
                    [[ ::entitytype.updated_at ]]
                </td>

                <td ng-if="entitytype.language_id == '{{$user_lang_id}}'">
                    <button class="btn btn-default btn-xs btn-detail" ng-click="openModalForm('md', entitytype.id, 'edit')">{{trans("entTypes/messages.BTNTABLE1")}}</button>
                    <button class="btn btn-danger btn-xs btn-delete" ng-click="delete(entitytype.id)">{{trans("entTypes/messages.BTNTABLE3")}}</button>
                </td>
            </tr>
        </table>
    </div>
@stop
@section('footerContent')
    <script src="<?= asset('app/controllers/entTypes.js') ?>"></script>
@stop