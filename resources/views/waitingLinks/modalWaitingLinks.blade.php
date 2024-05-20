
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("waitingLinks/modalWaitingLinks.FORM_NAME")}}</h4>
    </div>
    <div class="modal-body">
        <form name="frmWaitingLink" class="form-horizontal" novalidate="">

            <div class="form-group">
                <label for="Gender" class="col-sm-3 control-label">{{trans("waitingLinks/modalWaitingLinks.INPUT_WAITED_TRANSACTION")}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="waited_t" ng-model="waitinglink.waited_t.id" ng-options="item.id as item.language[0].pivot.t_name for item in transactionstype" required>
                        <option value="">{{trans("waitingLinks/modalWaitingLinks.INPUT_waited_transaction_id")}}</option>
                    </select>
                    <div ng-messages="frmWaitingLink.waited_t.$error" ng-show="frmWaitingLink.waited_t.$invalid && frmWaitingLink.waited_t.$touched">
                        <p ng-message="required">{{trans("waitingLinks/validation.required")}} {{trans("waitingLinks/modalWaitingLinks.INPUT_WAITED_TRANSACTION")}}</p>
                    </div>
                </div>
                <br>
                <ul ng-repeat="error in errors">
                    <li>[[ error[0] ]]</li>
                </ul>

            </div>

            <div class="form-group">
                <label for="Gender" class="col-sm-3 control-label">{{trans("waitingLinks/modalWaitingLinks.INPUT_WAITED_ACT")}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="waited_act" ng-model="waitinglink.waited_act.id" ng-options="item.id as item.language[0].pivot.name for item in tstates" required>
                        <option value="">{{trans("waitingLinks/modalWaitingLinks.INPUT_waited_act_id")}}</option>
                    </select>
                    <div ng-messages="frmWaitingLink.waited_act.$error" ng-show="frmWaitingLink.waited_act.$invalid && frmWaitingLink.waited_act.$touched">
                        <p ng-message="required">{{trans("waitingLinks/validation.required")}} {{trans("waitingLinks/modalWaitingLinks.INPUT_WAITED_ACT")}}</p>
                    </div>
                </div>
                <br>
                <ul ng-repeat="error in errors">
                    <li>[[ error[0] ]]</li>
                </ul>

            </div>

            <div class="form-group">
                <label for="Gender" class="col-sm-3 control-label">{{trans("waitingLinks/modalWaitingLinks.INPUT_WAITING_ACT")}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="waiting_act" ng-model="waitinglink.waiting_act.id" ng-options="item.id as item.language[0].pivot.name for item in tstates" required>
                        <option value="">{{trans("waitingLinks/modalWaitingLinks.INPUT_waiting_act_id")}}</option>
                    </select>
                    <div ng-messages="frmWaitingLink.waiting_act.$error" ng-show="frmWaitingLink.waiting_act.$invalid && frmWaitingLink.waiting_act.$touched">
                        <p ng-message="required">{{trans("waitingLinks/validation.required")}} {{trans("waitingLinks/modalWaitingLinks.INPUT_WAITING_ACT")}}</p>
                    </div>
                </div>
                <br>
                <ul ng-repeat="error in errors">
                    <li>[[ error[0] ]]</li>
                </ul>

            </div>

            <div class="form-group">
                <label for="Gender" class="col-sm-3 control-label">{{trans("waitingLinks/modalWaitingLinks.INPUT_WAITING_TRANSCTION")}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="waiting_t" ng-model="waitinglink.waiting_t.id" ng-options="item.id as item.language[0].pivot.t_name for item in transactionstype" required>
                        <option value="">{{trans("waitingLinks/modalWaitingLinks.INPUT_waiting_transaction_id")}}</option>
                    </select>
                    <div ng-messages="frmWaitingLink.waiting_t.$error" ng-show="frmWaitingLink.waiting_t.$invalid && frmWaitingLink.waiting_t.$touched">
                        <p ng-message="required">{{trans("waitingLinks/validation.required")}} {{trans("waitingLinks/modalWaitingLinks.INPUT_WAITING_TRANSCTION")}}</p>
                    </div>
                </div>
                <br>
                <ul ng-repeat="error in errors">
                    <li>[[ error[0] ]]</li>
                </ul>

            </div>

            <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">{{trans("waitingLinks/modalWaitingLinks.INPUT_MIN")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="min" name="min" placeholder=""
                           ng-model="waitinglink.min" required ng-pattern="/^(?!00)([0-9])*$/">
                    <div ng-messages="frmWaitingLink.min.$error" ng-show="frmWaitingLink.min.$invalid && frmWaitingLink.min.$touched">
                        <p ng-message="required">{{trans("waitingLinks/validation.required")}} {{trans("waitingLinks/modalWaitingLinks.INPUT_MIN")}}</p>
                        <p ng-message="pattern">{{trans("waitingLinks/validation.regex")}} {{trans("waitingLinks/modalWaitingLinks.INPUT_MIN")}}</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">{{trans("waitingLinks/modalWaitingLinks.INPUT_MAX")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="max" name="max" placeholder=""
                           ng-model="waitinglink.max" required ng-pattern="/^(?!0)([0-9])*$|^(\*)$/">
                    <div ng-messages="frmWaitingLink.max.$error" ng-show="frmWaitingLink.max.$invalid && frmWaitingLink.max.$touched">
                        <p ng-message="required">{{trans("waitingLinks/validation.required")}} {{trans("waitingLinks/modalWaitingLinks.INPUT_MAX")}}</p>
                        <p ng-message="pattern">{{trans("waitingLinks/validation.regex")}} {{trans("waitingLinks/modalWaitingLinks.INPUT_MAX")}}</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-green" id="btn-save" ng-disabled="frmWaitingLink.$invalid" ng-click="save()" >{{trans("waitingLinks/modalWaitingLinks.BTN1FORM")}}</button>
    </div>
</div>