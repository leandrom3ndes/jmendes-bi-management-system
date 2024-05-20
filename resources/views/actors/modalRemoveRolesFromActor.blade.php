
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("actors/modalRemoveRolesFromActor.MODAL_TITLE")}}</h4>
    </div>
    <div class="modal-body">
        <form name="frmRemoveRolesFromActor" class="form-horizontal" novalidate="">

            <label class="col-sm-12 text-center">[[ actor.name ]]</label>
            <label class="col-sm-12 text-center">{{trans("actors/modalRemoveRolesFromActor.FORM_NAME")}}</label>
            <div class="form-group">
                <div class="col-sm-12">
                    <table class="table" ng-init="selroles">
                        <thead>
                        <tr>
                            <th>{{trans("actors/modalRemoveRolesFromActor.THEADER1")}}</th>
                            <th>{{trans("actors/modalRemoveRolesFromActor.THEADER2")}}</th>
                            <th>{{trans("actors/modalRemoveRolesFromActor.THEADER3")}}</th>
                            <th>
                                <button class="btn btn-success btn-xs btn-detail" ng-click="openModalFormAssign(actor.id)">{{trans("actors/messages.BTNTABLE4")}}</button>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="selrole in selroles">
                            <td>[[ selrole.id ]]</td>
                            <td>[[ selrole.name ]]</td>
                            <td>[[ selrole.updated_at]]</td>
                            <td>
                                <button class="btn btn-danger btn-xs btn-delete" id="btn-delete" ng-click="removerole(actor.id,selrole.id)">{{trans("common.BTNTABLE3")}}</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </form>
    </div>
    <div class="modal-footer">

    </div>
</div>