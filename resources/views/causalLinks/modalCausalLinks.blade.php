
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("causalLinks/modalCausalLinks.FORM_NAME")}}</h4>
    </div>
    <div class="modal-body">
        <form name="frmCausalLink" class="form-horizontal" novalidate="">

            <div class="form-group">
                <label for="inputCausingTransaction" class="col-sm-3 control-label">{{trans("causalLinks/modalCausalLinks.INPUT_CAUSING_TRANSACTION")}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="causing_t" ng-model="causallink.causing_t" ng-options="item.id as item.language[0].pivot.t_name for item in transactionstype" required>
                        <option value="">{{trans("causalLinks/modalCausalLinks.INPUT_causing_transaction_id")}}</option>
                    </select>
                    <div ng-messages="frmCausalLink.causing_t.$error" ng-show="frmCausalLink.causing_t.$invalid && frmCausalLink.causing_t.$touched">
                        <p ng-message="required">{{trans("causalLinks/validation.required")}} {{trans("causalLinks/modalCausalLinks.INPUT_CAUSING_TRANSACTION")}}</p>
                    </div>
                </div>
                <br>
                <ul ng-repeat="error in errors">
                    <li>[[ error[0] ]]</li>
                </ul>

            </div>

            <div class="form-group">
                <label for="Gender" class="col-sm-3 control-label">{{trans("causalLinks/modalCausalLinks.INPUT_TRANSACTION_STATE")}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="t_state" ng-model="causallink.t_state_id" ng-options="item.id as item.language[0].pivot.name for item in tstates" required>
                        <option value="">{{trans("causalLinks/modalCausalLinks.INPUT_transaction_state_id")}}</option>
                    </select>
                    <div ng-messages="frmCausalLink.t_state.$error" ng-show="frmCausalLink.t_state.$invalid && frmCausalLink.t_state.$touched">
                        <p ng-message="required">{{trans("causalLinks/validation.required")}} {{trans("causalLinks/modalCausalLinks.INPUT_TRANSACTION_STATE")}}</p>
                    </div>
                </div>
                <br>
                <ul ng-repeat="error in errors">
                    <li>[[ error[0] ]]</li>
                </ul>

            </div>

            <div class="form-group">
                <label for="Gender" class="col-sm-3 control-label">{{trans("causalLinks/modalCausalLinks.INPUT_CAUSED_TRANSACTION")}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="caused_t" ng-model="causallink.caused_t" ng-options="item.id as item.language[0].pivot.t_name for item in transactionstype" required>
                        <option value="">{{trans("causalLinks/modalCausalLinks.INPUT_caused_transaction_id")}}</option>
                    </select>
                    <div ng-messages="frmCausalLink.caused_t.$error" ng-show="frmCausalLink.caused_t.$invalid && frmCausalLink.caused_t.$touched">
                        <p ng-message="required">{{trans("causalLinks/validation.required")}} {{trans("causalLinks/modalCausalLinks.INPUT_CAUSED_TRANSACTION")}}</p>
                    </div>
                </div>
                <br>
                <ul ng-repeat="error in errors">
                    <li>[[ error[0] ]]</li>
                </ul>

            </div>

            <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">{{trans("causalLinks/modalCausalLinks.INPUT_MIN")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="min" name="min" placeholder=""
                           ng-model="causallink.min" required ng-pattern="/^(?!00)([0-9])*$/">
                    <div ng-messages="frmCausalLink.min.$error" ng-show="frmCausalLink.min.$invalid && frmCausalLink.min.$touched">
                        <p ng-message="required">{{trans("causalLinks/validation.required")}} {{trans("causalLinks/modalCausalLinks.INPUT_MIN")}}</p>
                        <p ng-message="pattern">{{trans("causalLinks/validation.regex")}} {{trans("causalLinks/modalCausalLinks.INPUT_MIN")}}</p>
                    </div>
                </div>
            </div>
            <!--^(?!00)([0-9])*$|^(\*)$-->
            <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">{{trans("causalLinks/modalCausalLinks.INPUT_MAX")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="max" name="max" ng-pattern="/^(?!0)([0-9])*$|^(\*)$/" placeholder=""
                           ng-model="causallink.max" required>
                    <div ng-messages="frmCausalLink.max.$error" ng-show="frmCausalLink.max.$invalid && frmCausalLink.max.$touched">
                        <p ng-message="required">{{trans("causalLinks/validation.required")}} {{trans("causalLinks/modalCausalLinks.INPUT_MAX")}}</p>
                        <p ng-message="pattern">{{trans("causalLinks/validation.regex")}} {{trans("causalLinks/modalCausalLinks.INPUT_MAX")}}</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-green" id="btn-save" ng-disabled="frmCausalLink.$invalid" ng-click="save()" >{{trans("causalLinks/modalCausalLinks.BTN1FORM")}}</button>
    </div>
</div>