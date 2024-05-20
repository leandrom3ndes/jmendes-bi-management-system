@extends('layouts.default')
@section('page_name')
    {{trans("roles/messages.Page_Name")}}
@stop
@section('content')
    <div ng-controller="rolesController">
        <div growl></div>
        <br>
        <button id="btn-add" class="btn btn-primary btn-xs" ng-click="openModalForm('md', 0, 'add')">{{trans("roles/messages.THEADER6")}}</button>
        <br><br>
        <div class="alert alert-danger" ng-show="tableParams==null">
            {{trans("roles/messages.EMPTY_TABLE")}} {{trans("roles/messages.Page_Name")}}
        </div>
        <table ng-table="tableParams" class="table table-condensed table-bordered table-hover" ng-show="tableParams!=null">
            <tr ng-repeat="role in $data">
                <td sortable="'id'" filter="{id: 'number'}" data-title="'{{trans("roles/messages.THEADER1")}}'"> <!--ID-->
                    [[::role.id]]
                </td>

                <td sortable="'name'" filter="{name: 'text'}" data-title="'{{trans("roles/messages.THEADER2")}}'"> <!--Name-->
                    [[::role.name]]
                </td>

                <td sortable="'updated_at'" data-title="'{{trans("roles/messages.THEADER3")}}'"> <!--Updated At-->
                    [[ ::role.updated_at ]]
                </td>

                <td data-title="'{{trans("roles/messages.THEADER4")}}'"> <!--Actors-->
                    <button class="btn btn-success btn-xs btn-detail" ng-click="openModalFormAssignActorsToRole('md', role.id, '')">{{trans("roles/messages.BTNTABLE4")}}</button>
                    <button class="btn btn-primary btn-xs btn-detail" ng-click="openModalFormRemoveActorsFromRole('md', role.id, '')">{{trans("roles/messages.BTNTABLE5")}}</button>
                </td>

                <td data-title="'{{trans("roles/messages.THEADER5")}}'"> <!--Users-->
                    <button class="btn btn-success btn-xs btn-detail" ng-click="openModalFormAssignUsersToRole('md', role.id, '')">{{trans("roles/messages.BTNTABLE6")}}</button>
                    <button class="btn btn-primary btn-xs btn-detail" ng-click="openModalFormRemoveUsersFromRole('md', role.id, '')">{{trans("roles/messages.BTNTABLE7")}}</button>
                </td>

                <td data-title="'{{trans("roles/messages.THEADER7")}}'"> <!--Delegation-->
                    <button class="btn btn-success btn-xs btn-detail" ng-click="openModalFormDelegateRolesToRole('md', role.id, '', '', '')">{{trans("roles/messages.BTNTABLE8")}}</button>
                    <button class="btn btn-primary btn-xs btn-detail" ng-click="openModalFormRemoveDelegationsFromRole('md', role.id, '')">{{trans("roles/messages.BTNTABLE9")}}</button>
                </td>

                <td>
                    <button class="btn btn-default btn-xs btn-detail" ng-click="openModalForm('md', role.id, 'edit')">{{trans("common.BTNTABLE1")}}</button>
                    <button class="btn btn-danger btn-xs btn-delete" ng-click="delete(role.id)">{{trans("common.BTNTABLE3")}}</button>
                </td>
            </tr>
        </table>
    </div>
@stop
@section('footerContent')
    <script src="<?= asset('app/controllers/roles.js') ?>"></script>
@stop