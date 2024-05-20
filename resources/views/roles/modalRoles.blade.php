
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("roles/modalRoles.FORM_NAME")}}</h4>
    </div>
    <div class="modal-body">
        <form name="frmRoles" class="form-horizontal" novalidate="">

            <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">{{trans("roles/modalRoles.INPUT_NAME")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="role_name" name="role_name" placeholder="" value="[[name]]"
                           ng-model="role.name" ng-required="true" ng-maxlength="role_name_maxLength">
                    <span class="help-inline" ng-messages="frmRoles.role_name.$error" ng-show="frmRoles.role_name.$invalid && frmRoles.role_name.$touched">
                        <span ng-message="required">{{trans("validation.required")}} {{trans("roles/modalRoles.INPUT_NAME")}}.</span>
                        <span ng-message="maxlength">{{trans("validation.max.string")}} {{trans("roles/modalRoles.INPUT_NAME")}} {{trans("validation.miniMessage")}} 45.</span>
                    </span>
                </div>
            </div>

        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-green" id="btn-save" ng-disabled="frmRoles.$invalid" ng-click="save()" >{{trans("common.BTN1FORM")}}</button>
    </div>
</div>