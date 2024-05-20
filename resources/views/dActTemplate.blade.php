@extends('layouts.default')
@section('content')
    <div ng-controller="dActTemplateController">
        <h2>{{trans("dActTemplate/messages.Page_Name")}}</h2>
        <div growl></div>
	
        <br><br>
        <button id="btn-add" class="btn btn-primary btn-xs" ng-click="openModalForm('lg', 0, 'add')">{{trans("dActTemplate/messages.BTNTABLE3")}}</button>
        <br><br>

        <div class="alert alert-danger" ng-show="tableParams.data.length == 0" ng-cloak>
            {{trans("dActTemplate/messages.EMPTY_TABLE")}}
        </div>

        <table ng-table="tableParams" class="table table-condensed table-bordered table-hover" ng-show="tableParams.data.length != 0" ng-init="getDActTemplate()"  ng-cloak>
            <tr ng-repeat="d_act_template in $data">

                <td sortable="'transaction_type_name'" filter="{transaction_type_name: 'text'}" data-title="'{{trans("dActTemplate/messages.THEADERE1")}}'">
                    [[::d_act_template.d_act_template_id]]
                </td>

                <td sortable="'t_state_id'" data-title="'{{trans("dActTemplate/messages.THEADERE2")}}'">
                    [[::d_act_template.d_action_id]]
                </td>

                <td data-title="'{{trans("dActTemplate/messages.THEADERE3")}}'">
                    {{--<a target="_self" href="/d_act_template/download_pdf/[[::d_act_template.d_act_template_id]]" download="text-[[::d_act_template.d_act_template_id]].pdf">Download</a>--}}
                    <button class="btn btn-success btn-xs btn-detail" ng-click="downloadPdf(d_act_template.d_act_template_id)">Download</button>
                </td>

                <td data-title="'{{trans("dActTemplate/messages.THEADERE4")}}'">
                    <button class="btn btn-warning btn-xs btn-detail" ng-click="openModalForm('lg', d_act_template.d_act_template_id, 'edit')">{{trans("dActTemplate/messages.BTNTABLE1")}}</button>
                    <button class="btn btn-danger btn-xs btn-delete" ng-click="remove(d_act_template.d_act_template_id)">{{trans("dActTemplate/messages.BTNTABLE2")}}</button>
                </td>
            </tr>
        </table>
    </div>
@stop
@section('footerContent')
    <script src="<?= asset('app/controllers/dActTemplate.js') ?>"></script>
@stop