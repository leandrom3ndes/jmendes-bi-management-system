
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("roles/modalRemoveActorsFromRole.MODAL_TITLE")}}</h4>
    </div>
    <div class="modal-body">
        <form name="frmRemoveRolesFromActor" class="form-horizontal" novalidate="">

            <label class="col-sm-12 text-center">[[ role.name ]]</label>
            <label class="col-sm-12 text-center">{{trans("roles/modalRemoveActorsFromRole.FORM_NAME")}}</label>
            <div class="form-group">
                <div class="col-sm-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{trans("roles/modalRemoveActorsFromRole.THEADER1")}}</th>
                            <th>{{trans("roles/modalRemoveActorsFromRole.THEADER2")}}</th>
                            <th>{{trans("roles/modalRemoveActorsFromRole.THEADER3")}}</th>
                            <th>
                                <button class="btn btn-success btn-xs btn-detail" ng-click="openModalFormAssign(role.id)">{{trans("roles/messages.BTNTABLE4")}}</button>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="selactor in selactors">
                            <td>[[ selactor.id ]]</td>
                            <td>[[ selactor.name ]]</td>
                            <td>[[ selactor.updated_at]]</td>
                            <td>
                                <button class="btn btn-danger btn-xs btn-delete" id="btn-delete" ng-click="removeactor(selactor.id)">{{trans("common.BTNTABLE3")}}</button>
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