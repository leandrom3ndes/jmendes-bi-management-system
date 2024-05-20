@extends('layouts.default')
@section('content')
    <div ng-controller="tStatesController" ng-cloak>
        <h2>{{trans("tStates/messages.Page_Name")}}</h2>
        <div growl></div>
        <br><br>
        <button id="btn-add" class="btn btn-primary btn-xs" ng-click="openModalForm('md', 0, 'add')">{{trans("tStates/messages.THEADER7")}}</button>
        <br><br>
        <div class="alert alert-danger" ng-show="tableParams==null">
            {{trans("tStates/messages.EMPTY_TABLE")}} {{trans("tStates/messages.Page_Name")}}
        </div>

        <table ng-table="tableParams" class="table table-condensed table-bordered table-hover" ng-show="tableParams!=null">
            <tr ng-repeat="tstate in $data">
                <td sortable="'id'" filter="{id: 'number'}" data-title="'{{trans("tStates/messages.THEADER1")}}'"> <!--ID-->
                    [[::tstate.id]]
                </td>

                <td sortable="'name'" filter="{name: 'text'}" data-title="'{{trans("tStates/messages.THEADER2")}}'"> <!--Name-->
                    [[::tstate.name]]
                    <button ng-if="tstate.language_id != '{{$user_lang_id}}'" class="btn btn-success btn-xs btn-detail" ng-click="openModalForm('md', tstate.id, 'add_name_lang')">{{trans("common.BTNADDNAMELANG")}}</button>
                </td>

                <td sortable="'created_at'" data-title="'{{trans("tStates/messages.THEADER4")}}'"> <!--Created_at-->
                    [[ ::tstate.created_at ]]
                </td>

                <td sortable="'updated_at'" data-title="'{{trans("tStates/messages.THEADER5")}}'"> <!--Updated_at-->
                    [[ ::tstate.updated_at ]]
                </td>

                <td ng-if="tstate.language_id == '{{$user_lang_id}}'">
                    <button class="btn btn-default btn-xs btn-detail" ng-click="openModalForm('md', tstate.id, 'edit')">{{trans("common.BTNTABLE1")}}</button>
                    <button class="btn btn-danger btn-xs btn-delete" ng-click="delete(tstate.id)">{{trans("common.BTNTABLE3")}}</button>
                </td>
            </tr>
        </table>
    </div>
@stop
@section('footerContent')
    <script src="<?= asset('app/controllers/tStates.js') ?>"></script>
@stop