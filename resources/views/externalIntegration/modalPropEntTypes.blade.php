<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel"> {{trans("systemIntegration/modalSystemIntegration.FORM_NAME")}} </h4>
    </div>
    <div class="modal-body">
        <form name="frmsystemIntegration" class="form-horizontal" novalidate="">

            <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">{{trans("systemIntegration/modalSystemIntegration.INPUT_NAME")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="ext_int_name" name="ext_int_name" placeholder="" value="@]]name]]"
                           ng-model="externalIntegration.name" ng-required="true">
                    <div ng-messages="frmsystemIntegration.ext_int_name.$error" ng-show="frmsystemIntegration.ext_int_name.$invalid && frmsystemIntegration.ext_int_name.$touched">
                        <p ng-message="required">{{trans("systemIntegration/modalSystemIntegration.REQUIRED_NAME_UNIT")}}</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputTask" class="col-sm-3 control-label">{{trans("systemIntegration/modalSystemIntegration.INPUT_TASK")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="ext_int_task" name="prop_ext_task" placeholder="" value="@]]name]]"
                           ng-model="externalIntegration.task" ng-required="true">
                    <div ng-messages="frmsystemIntegration.prop_ext_task.$error" ng-show="frmsystemIntegration.prop_ext_task.$invalid && frmsystemIntegration.prop_ext_task.$touched">
                        <p ng-message="required">{{trans("systemIntegration/modalSystemIntegration.REQUIRED_TASK_UNIT")}}</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-3 control-label">{{trans("systemIntegration/modalSystemIntegration.INPUT_ENT")}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="ext_int_ent_type" ng-model="externalIntegration.ent_type_id" ng-options="item.language[0].pivot.ent_type_id as item.language[0].pivot.name for item in ent_types" required>
                        <option value="">{{trans("systemIntegration/modalSystemIntegration.INPUT_SELECT_ENT")}}</option>
                    </select>
                    <div ng-messages="frmsystemIntegration.ext_int_ent_type.$error" ng-show="frmsystemIntegration.ext_int_ent_type.$invalid && frmsystemIntegration.ext_int_ent_type.$touched">
                        <p ng-message="required">{{trans("systemIntegration/modalSystemIntegration.REQUIRED_ENT_ALLOWED")}}</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-3 control-label">{{trans("systemIntegration/modalSystemIntegration.INPUT_T_STATE")}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="ext_int_t_state" ng-model="externalIntegration.t_state_id" ng-options="item.language[0].pivot.t_state_id as item.language[0].pivot.name for item in t_states" required>
                        <option value="">{{trans("systemIntegration/modalSystemIntegration.INPUT_SELECT_T_STATE")}}</option>
                    </select>
                    <div ng-messages="frmsystemIntegration.ext_int_t_state.$error" ng-show="frmsystemIntegration.ext_int_t_state.$invalid && ext_int_t_state.ext_int_t_state.$touched">
                        <p ng-message="required">{{trans("systemIntegration/modalSystemIntegration.REQUIRED_T_STATE_ALLOWED")}}</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn-save" ng-click="save()" ng-disabled="frmsystemIntegration.$invalid">{{trans("systemIntegration/modalSystemIntegration.BTN1FORM")}}</button>
    </div>
</div>
