@extends('layouts.default')
@section('page_name')
    {{trans("languages/messages.Page_Name")}}
@stop
@section('content')
    <div ng-controller="languagesController">
        <div growl></div>
        <br>
        <button id="btn-add" class="btn btn-primary btn-xs" ng-click="openModalForm('md', 0, 'add')">{{trans("languages/messages.THEADER6")}}</button>
        <br><br>
        <div class="alert alert-danger" ng-show="tableParams==null">
            {{trans("languages/messages.EMPTY_TABLE")}} {{trans("languages/messages.Page_Name")}}
        </div>
        <table ng-table="tableParams" class="table table-condensed table-bordered table-hover" ng-show="tableParams!=null">
            <tr ng-repeat="language in $data">
                <td sortable="'id'" filter="{id: 'number'}" data-title="'{{trans("languages/messages.THEADER1")}}'"> <!--ID-->
                    [[::language.id]]
                </td>

                <td sortable="'name'" filter="{name: 'text'}" data-title="'{{trans("languages/messages.THEADER2")}}'"> <!--Name-->
                    [[::language.name]]
                </td>

                <td sortable="'slug'" filter="{slug: 'text'}" data-title="'{{trans("languages/messages.THEADER3")}}'"> <!--Name-->
                    [[::language.slug]]
                </td>

                <td sortable="'state'" data-title="'{{trans("languages/messages.THEADER4")}}'"> <!--State-->
                    [[::language.state=='active' ? '{{trans("languages/modalLanguages.INPUT_STATE_OPT1")}}' : '{{trans("languages/modalLanguages.INPUT_STATE_OPT2")}}']]
                </td>

                <td sortable="'updated_on'" data-title="'{{trans("languages/messages.THEADER5")}}'"> <!--Updated_at-->
                    [[ ::language.updated_on ]]
                </td>

                <td>
                    <button class="btn btn-default btn-xs btn-detail" ng-click="openModalForm('md', language.id, 'edit')">{{trans("common.BTNTABLE1")}}</button>
                    <button class="btn btn-danger btn-xs btn-delete" ng-click="delete(language.id)">{{trans("common.BTNTABLE3")}}</button>
                </td>
            </tr>
        </table>
    </div>
@stop
@section('footerContent')
    <script src="<?= asset('app/controllers/languages.js') ?>"></script>
@stop