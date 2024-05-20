
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("roles/modalRemoveDelegationsFromRole.MODAL_TITLE")}}</h4>
    </div>
    <div class="modal-body">
        <form name="frmRemoveRolesFromActor" class="form-horizontal" novalidate="">

            <label class="col-sm-12 text-center">[[ delegation.delegate_name ]]</label>
            <label class="col-sm-12 text-center">{{trans("roles/modalRemoveDelegationsFromRole.FORM_NAME")}}</label>
            <div class="form-group">
                <div class="col-sm-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Delegation {{trans("roles/modalRemoveDelegationsFromRole.THEADER1")}}</th>
                            <th>{{trans("roles/modalRemoveDelegationsFromRole.THEADER2")}}</th>
                            <th>{{trans("roles/modalRemoveDelegationsFromRole.THEADER3")}}</th>
                            <th>{{trans("roles/modalRemoveDelegationsFromRole.THEADER4")}}</th>
                            <th>
                                <button class="btn btn-success btn-xs btn-detail" ng-click="openModalFormDelegateRolesToRole('md', delegation.delegates_role_id, '', '')">{{trans("roles/messages.BTNTABLE8")}}</button>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr ng-repeat="seldelegate in seldelegations">
                            <td>[[ seldelegate.id ]]</td>
                            <td>[[ seldelegate.delegated_role.language[0].pivot.name ]]</td>
                            <td>[[ seldelegate.updated_at]]</td>
                            <td>[[ seldelegate.t_state.language[0].pivot.name]]</td>
                            <td>
                                <button class="btn btn-info btn-xs btn-detail" id="btn-info" ng-click="openModalFormAssign(seldelegate.id)">{{trans("common.BTNTABLE1")}}</button>
                                <button class="btn btn-danger btn-xs btn-delete" id="btn-delete" ng-click="removedelegation(seldelegate.id)">{{trans("common.BTNTABLE3")}}</button>
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