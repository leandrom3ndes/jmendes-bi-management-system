@extends('layouts.default')
@section('page_name')
    {{trans("processTypes/messages.Page_Name")}}
@stop
@section('content')
    <div ng-controller="processTypesController">
        <div growl></div>
        <br>
        <button id="btn-add" class="btn btn-primary btn-xs" ng-click="openModalForm('md', 0, 'add')">{{trans("processTypes/messages.THEADER7")}}</button>
        <br><br>
        <div class="alert alert-danger" ng-show="tableParams==null">
            {{trans("processTypes/messages.EMPTY_TABLE")}} {{trans("processTypes/messages.Page_Name")}}
        </div>
        <table ng-table="tableParams" class="table table-condensed table-bordered table-hover" ng-show="tableParams!=null">
            <tr ng-repeat="processtype in $data">
                <td sortable="'id'" filter="{id: 'number'}" data-title="'{{trans("processTypes/messages.THEADER1")}}'"> <!--ID-->
                    [[::processtype.id]]
                </td>

                <td sortable="'name'" filter="{name: 'text'}" data-title="'{{trans("processTypes/messages.THEADER2")}}'"> <!--Name-->
                    [[::processtype.name]]
                    <button ng-if="processtype.language_id != '{{$user_lang_id}}'" class="btn btn-success btn-xs btn-detail" ng-click="openModalForm('md', processtype.id, 'add_name_lang')">{{trans("common.BTNADDNAMELANG")}}</button>
                </td>

                <td sortable="'state'" data-title="'{{trans("processTypes/messages.THEADER3")}}'"> <!--State-->
                    [[::processtype.state=='active' ? '{{trans("processTypes/modalProcessTypes.INPUT_STATE_OPT1")}}' : '{{trans("processTypes/modalProcessTypes.INPUT_STATE_OPT2")}}']]
                </td>

                <td sortable="'created_at'" data-title="'{{trans("processTypes/messages.THEADER4")}}'"> <!--Created_at-->
                    [[ ::processtype.created_at ]]
                </td>

                <td sortable="'updated_at'" data-title="'{{trans("processTypes/messages.THEADER5")}}'"> <!--Updated_at-->
                    [[ ::processtype.updated_at ]]
                </td>

                <td ng-if="processtype.language_id == '{{$user_lang_id}}'">
                    <button class="btn btn-default btn-xs btn-detail" ng-click="openModalForm('md', processtype.id, 'edit')">{{trans("common.BTNTABLE1")}}</button>
                    <button class="btn btn-danger btn-xs btn-delete" ng-click="delete(processtype.id)">{{trans("common.BTNTABLE3")}}</button>
                </td>
            </tr>
        </table>
    </div>
@stop
@section('footerContent')
<script src="<?= asset('app/controllers/processtypes.js') ?>"></script>
@stop