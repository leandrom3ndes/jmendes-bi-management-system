<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel"> {{trans("dAction/modalDAction.FORM_NAME")}} </h4>
    </div>
    <div class="modal-body">
        <form name="frmdAction" class="form-horizontal" novalidate="">

            <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">{{trans("dAction/modalDAction.INPUT_NAME")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="d_action_name" name="d_action_name" placeholder="" value="@]]name]]"
                           ng-model="dAction.language[0].pivot.name" ng-required="true">
                    <div ng-messages="frmdAction.d_action_name.$error" ng-show="frmdAction.d_action_name.$invalid && frmdAction.d_action_name.$touched">
                        <p ng-message="required">{{trans("dAction/modalDAction.REQUIRED_NAME")}}</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-3 control-label">{{trans("dAction/modalDAction.INPUT_TRAN_TYPE")}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="transaction_type" ng-model="dAction.transaction_type_id" ng-options="item.language[0].pivot.transaction_type_id as item.language[0].pivot.t_name for item in transaction_types" required>
                        <option value="">{{trans("dAction/modalDAction.INPUT_SELECT_TRAN_TYPE")}}</option>
                    </select>
                    <div ng-messages="frmdAction.transaction_type.$error" ng-show="frmdAction.transaction_type.$invalid && frmdAction.transaction_type.$touched">
                        <p ng-message="required">{{trans("dAction/modalDAction.REQUIRED_TRAN_TYPE_ALLOWED")}}</p>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="" class="col-sm-3 control-label">{{trans("dAction/modalDAction.INPUT_T_STATE")}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="t_state" ng-model="dAction.t_state_id" ng-options="item.language[0].pivot.t_state_id as item.language[0].pivot.name for item in t_states" required>
                        <option value="">{{trans("dAction/modalDAction.INPUT_SELECT_T_STATE")}}</option>
                    </select>
                    <div ng-messages="frmdAction.t_state.$error" ng-show="frmdAction.t_state.$invalid && frmdAction.t_state.$touched">
                        <p ng-message="required">{{trans("dAction/modalDAction.REQUIRED_T_STATE_ALLOWED")}}</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="col-sm-3 control-label">{{trans("dAction/modalDAction.INPUT_TYPE")}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="type" ng-model="dAction.type" ng-options="item as item for item in types" required>
                        <option value="">{{trans("dAction/modalDAction.INPUT_SELECT_TYPE")}}</option>
                    </select>
                    <div ng-messages="frmdAction.type.$error" ng-show="frmdAction.type.$invalid && frmdAction.type.$touched">
                        <p ng-message="required">{{trans("dAction/modalDAction.REQUIRED_TYPE_ALLOWED")}}</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="btn-save" ng-click="save()" ng-disabled="frmdAction.$invalid">{{trans("dAction/modalDAction.BTN1FORM")}}</button>
    </div>
</div>
