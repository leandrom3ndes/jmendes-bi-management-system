@extends('layouts.default')
@section('page_name')
    {{trans("users/messages.Page_Name")}}
@stop
@section('content')
    <div ng-controller="usersController">
        <div growl></div>
        <br>
        <button id="btn-add" class="btn btn-primary btn-xs" ng-click="openModalForm('md', 0, 'add')">{{trans("users/messages.THEADER10")}}</button>
        <br><br>
        <div class="alert alert-danger" ng-show="tableParams==null">
            {{trans("users/messages.EMPTY_TABLE")}} {{trans("users/messages.Page_Name")}}
        </div>
        <table ng-table="tableParams" class="table table-condensed table-bordered table-hover" ng-show="tableParams!=null">
            <tr ng-repeat="user in $data">
                <td sortable="'id'" filter="{id: 'number'}" data-title="'{{trans("users/messages.THEADER1")}}'"> <!--ID-->
                    [[::user.id]]
                </td>

                <td sortable="'name'" filter="{name: 'text'}" data-title="'{{trans("users/messages.THEADER2")}}'"> <!--Name-->
                    [[::user.name]]
                </td>

                <td sortable="'email'" filter="{email: 'text'}" data-title="'{{trans("users/messages.THEADER3")}}'"> <!--Email-->
                    [[::user.email]]
                </td>

                <td sortable="'user_name'" filter="{user_name: 'text'}" data-title="'{{trans("users/messages.THEADER4")}}'"> <!--User Name-->
                    [[::user.user_name]]
                </td>

                <td sortable="'languageslug'" filter="{languageslug: 'text'}" data-title="'{{trans("users/messages.THEADER5")}}'"> <!--Language-->
                    [[::user.languageslug]]
                </td>

                <td sortable="'user_type'" filter="{user_type: 'text'}" data-title="'{{trans("users/messages.THEADER6")}}'"> <!--User Type-->
                    [[::user.user_type]]
                </td>

                <td sortable="'selentity'" filter="{selentity: 'text'}" data-title="'{{trans("users/messages.THEADER7")}}'"> <!--Entity-->
                    [[::user.selentity]]
                </td>

                <td sortable="'updated_at'" data-title="'{{trans("users/messages.THEADER8")}}'"> <!--Updated At-->
                    [[ ::user.updated_at ]]
                </td>

                <td data-title="'{{trans("users/messages.THEADER9")}}'"> <!--Roles-->
                    <button class="btn btn-success btn-xs btn-detail" ng-click="openModalFormAssignRolesToUser('md', user.id, '')">{{trans("users/messages.BTNTABLE4")}}</button>
                    <button class="btn btn-primary btn-xs btn-detail" ng-click="openModalFormRemoveRolesFromUser('md', user.id, '')">{{trans("users/messages.BTNTABLE5")}}</button>
                </td>

                <td>
                    <button class="btn btn-default btn-xs btn-detail" ng-click="openModalForm('md', user.id, 'edit')">{{trans("common.BTNTABLE1")}}</button>
                    <button class="btn btn-danger btn-xs btn-delete" ng-click="delete(user.id)">{{trans("common.BTNTABLE3")}}</button>
                </td>
            </tr>
        </table>
    </div>
@stop
@section('footerContent')
    <script src="<?= asset('app/controllers/users.js') ?>"></script>

@stop