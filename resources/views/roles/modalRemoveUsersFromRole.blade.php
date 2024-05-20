
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("roles/modalRemoveUsersFromRole.MODAL_TITLE")}}</h4>
    </div>
    <div class="modal-body">
        <form name="frmRemoveRolesFromActor" class="form-horizontal" novalidate="">

            <label class="col-sm-12 text-center">[[ role.name ]]</label>
            <label class="col-sm-12 text-center">{{trans("roles/modalRemoveUsersFromRole.FORM_NAME")}}</label>
            <div class="form-group">
                <div class="col-sm-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{trans("roles/modalRemoveUsersFromRole.THEADER1")}}</th>
                            <th>{{trans("roles/modalRemoveUsersFromRole.THEADER2")}}</th>
                            <th>{{trans("roles/modalRemoveUsersFromRole.THEADER3")}}</th>
                            <th>
                                <button class="btn btn-success btn-xs btn-detail" ng-click="openModalFormAssign(role.id)">{{trans("roles/messages.BTNTABLE6")}}</button>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="seluser in selusers">
                            <td>[[ seluser.id ]]</td>
                            <td>[[ seluser.name ]]</td>
                            <td>[[ seluser.updated_at]]</td>
                            <td>
                                <button class="btn btn-danger btn-xs btn-delete" id="btn-delete" ng-click="removeuser(role.id,seluser.id)">{{trans("common.BTNTABLE3")}}</button>
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