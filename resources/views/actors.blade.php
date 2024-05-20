@extends('layouts.default')
@section('page_name')
    {{trans("actors/messages.Page_Name")}}
@stop
@section('content')
    <div ng-controller="actorsController">
        <div growl></div>
        <br>
        <button id="btn-add" class="btn btn-primary btn-xs" ng-click="openModalForm('md', 0, 'add')">{{trans("actors/messages.THEADER5")}}</button>
        <br><br>
        <div class="alert alert-danger" ng-show="tableParams==null">
            {{trans("actors/messages.EMPTY_TABLE")}} {{trans("actors/messages.Page_Name")}}
        </div>
        <table ng-table="tableParams" class="table table-condensed table-bordered table-hover" ng-show="tableParams!=null">
            <tr ng-repeat="actor in $data">
                <td sortable="'id'" filter="{id: 'number'}" data-title="'{{trans("actors/messages.THEADER1")}}'"> <!--ID-->
                    [[::actor.id]]
                </td>

                <td sortable="'name'" filter="{name: 'text'}" data-title="'{{trans("actors/messages.THEADER2")}}'"> <!--Name-->
                    [[::actor.name]]
                </td>

                <td sortable="'updated_at'" data-title="'{{trans("actors/messages.THEADER3")}}'"> <!--Updated At-->
                    [[ ::actor.updated_at ]]
                </td>

                <td data-title="'{{trans("actors/messages.THEADER4")}}'"> <!--Roles-->
                    <button class="btn btn-success btn-xs btn-detail" ng-click="openModalFormAssignRolesToActor('md', actor.id, '')">{{trans("actors/messages.BTNTABLE4")}}</button>
                    <button class="btn btn-primary btn-xs btn-detail" ng-click="openModalFormRemoveRolesFromActor('md', actor.id, '')">{{trans("actors/messages.BTNTABLE5")}}</button>
                </td>

                <td>
                    <button class="btn btn-default btn-xs btn-detail" ng-click="openModalForm('md', actor.id, 'edit')">{{trans("common.BTNTABLE1")}}</button>
                    <button class="btn btn-danger btn-xs btn-delete" ng-click="delete(actor.id)">{{trans("common.BTNTABLE3")}}</button>
                </td>
            </tr>
        </table>
    </div>

@stop
@section('footerContent')
    <script src="<?= asset('app/controllers/actors.js') ?>"></script>

@stop

