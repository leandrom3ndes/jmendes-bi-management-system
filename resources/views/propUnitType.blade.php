@extends('layouts.default')
@section('content')
    <div ng-controller="propUnitTypeController">
        <h2>{{trans("unitTypes/messages.Page_Name")}}</h2>
        <div growl></div>

        {{--<button class="btn btn-default btn-xs btn-detail" ng-click="dotranslate()">TRANSLATE</button>--}}

        <br><br>
        <button id="btn-add" class="btn btn-primary btn-xs" ng-click="openModalForm('md', 0, 'add')">{{trans("unitTypes/messages.BTNTABLE0")}}</button>
        <br><br>

        <div class="alert alert-danger" ng-show="tableParams.data.length == 0" ng-cloak>
            {{--[[ "EMPTY_TABLE" | translate ]] [[  "Page_Name" | translate ]]--}}
            {{trans("unitTypes/messages.EMPTY_TABLE")}}
        </div>

        <table ng-table="tableParams" class="table table-condensed table-bordered table-hover" ng-show="tableParams.data.length != 0" ng-cloak>
            <tr ng-repeat="unittype in $data">
                <td sortable="'id'" filter="{id: 'number'}" data-title="'{{trans("unitTypes/messages.THEADER1")}}'"> <!--ID-->
                    [[::unittype.id]]
                </td>

                <td sortable="'name'" filter="{name: 'text'}" data-title="'{{trans("unitTypes/messages.THEADER2")}}'"> <!--Name-->
                    [[::unittype.name]]
                </td>

                <td sortable="'state'" data-title="'{{trans("unitTypes/messages.THEADER3")}}'"> <!--State-->
                    [[::unittype.state]]
                </td>

                <td sortable="'created_at'" data-title="'{{trans("unitTypes/messages.THEADER4")}}'"> <!--Created_at-->
                    [[ ::unittype.created_at ]]
                </td>

                <td sortable="'updated_at'" data-title="'{{trans("unitTypes/messages.THEADER4")}}'"> <!--Updated_at-->
                    [[ ::unittype.updated_at ]]
                </td>

                <td>
                    <button class="btn btn-warning btn-xs btn-detail" ng-click="openModalForm('md', unittype.id, 'edit')">{{trans("unitTypes/messages.BTNTABLE1")}}</button>
                    {{--<button class="btn btn-primary btn-xs btn-delete">[[ "BTNTABLE2" | translate]]</button>--}}
                    <button class="btn btn-danger btn-xs btn-delete" ng-click="remove(unittype.id)">{{trans("unitTypes/messages.BTNTABLE3")}}</button>
                </td>
            </tr>
        </table>
    </div>
@stop
@section('footerContent')
    <script src="<?= asset('app/controllers/propunittype.js') ?>"></script>
@stop