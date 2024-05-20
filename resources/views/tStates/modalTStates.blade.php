
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("tStates/modalTStates.FORM_NAME")}}</h4>
    </div>
    <div class="modal-body">
        <form name="frmTStates" class="form-horizontal" novalidate="">

            <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">{{trans("tStates/modalTStates.INPUT_NAME")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="t_state_name" name="t_state_name" placeholder=""
                           ng-model="tstate.language[0].pivot.name" required ng-maxlength="t_state_name_maxLength">
                    <div class="help-inline" ng-messages="frmTStates.t_state_name.$error" ng-show="frmTStates.t_state_name.$invalid && frmTStates.t_state_name.$touched">
                        <p ng-message="required">{{trans("tStates/validation.required")}} {{trans("tStates/modalTStates.INPUT_NAME")}}</p>
                        <p ng-message="maxlength">{{trans("validation.max.string")}} {{trans("tStates/modalTStates.INPUT_NAME")}} {{trans("validation.miniMessage")}} [[t_state_name_maxLength]].</p>
                    </div>
                </div>
            </div>

            <!--<div class="form-group">
                <label for="selectLanguage" class="col-sm-3 control-label">{{trans("tStates/modalTStates.INPUT_LANGUAGE")}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="t_state_language_id" ng-model="tstate.language[0].id" ng-options="item.id as item.slug for item in langs">
                        <option value="">[[ "INPUT_language_id" | translate]]</option>
                        <option value="">{{trans("tStates/modalTStates.INPUT_language_id")}}</option>
                    </select>
                    <div ng-messages="frmTStates.t_state_language_id.$error" ng-show="frmTStates.t_state_language_id.$invalid && frmTStates.t_state_language_id.$touched">
                        <p ng-message="required">{{trans("tStates/validation.required")}} {{trans("tStates/modalTStates.INPUT_NAME")}}</p>
                    </div>
                </div>
                <br>
                <ul ng-repeat="error in errors">
                    <li>[[ error[0] ]]</li>
                </ul>

            </div>-->
        </form>
    </div>
    <div class="modal-footer"><!-- ng-disabled="frmProcessTypes.$invalid" -->
        <button type="button" class="btn btn-green" id="btn-save" ng-disabled="frmTStates.$invalid" ng-click="save()" >{{trans("common.BTN1FORM")}}</button>
    </div>
</div>