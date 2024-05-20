<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("transactionTypes/modalTransactionTypes.FORM_NAME")}}</h4>
    </div>
    <div class="modal-body">
        <form name="frmTransactionTypes" class="form-horizontal" novalidate="">

            <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">{{trans("transactionTypes/modalTransactionTypes.INPUT_NAME")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="transactiontype_t_name" name="transactiontype_t_name" placeholder=""
                           ng-model="transactiontype.language[0].pivot.t_name" required ng-maxlength="transactiontype_t_name_maxLength">
                    <div class="help-inline" ng-messages="frmTransactionTypes.transactiontype_t_name.$error" ng-show="frmTransactionTypes.transactiontype_t_name.$invalid && frmTransactionTypes.transactiontype_t_name.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("transactionTypes/modalTransactionTypes.INPUT_NAME")}}</p>
                        <p ng-message="maxlength">{{trans("validation.max.string")}} {{trans("transactionTypes/modalTransactionTypes.INPUT_NAME")}} {{trans("validation.miniMessage")}} [[transactiontype_t_name_maxLength]].</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputResultType" class="col-sm-3 control-label">{{trans("transactionTypes/modalTransactionTypes.INPUT_RESULT_TYPE")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="transactiontype_rt_name" name="transactiontype_rt_name" placeholder=""
                           ng-model="transactiontype.language[0].pivot.rt_name" required ng-maxlength="transactiontype_rt_name_maxLength">
                    <div class="help-inline" ng-messages="frmTransactionTypes.transactiontype_rt_name.$error" ng-show="frmTransactionTypes.transactiontype_rt_name.$invalid && frmTransactionTypes.transactiontype_rt_name.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("transactionTypes/modalTransactionTypes.INPUT_RESULT_TYPE")}}</p>
                        <p ng-message="maxlength">{{trans("validation.max.string")}} {{trans("transactionTypes/modalTransactionTypes.INPUT_RESULT_TYPE")}} {{trans("validation.miniMessage")}} [[transactiontype_rt_name_maxLength]].</p>
                    </div>
                </div>
            </div>

            <div ng-if="::modalstate!=='add_name_lang'">
            <div class="form-group">
                <label for="Gender" class="col-sm-3 control-label">{{trans("transactionTypes/modalTransactionTypes.INPUT_PROCESS_TYPE")}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="transaction_type_process_type" ng-model="transactiontype.process_type_id" ng-options="item.id as item.language[0].pivot.name for item in processtypes" required>
                        <option value="">{{trans("transactionTypes/modalTransactionTypes.INPUT_process_type_id")}}</option>
                    </select>
                    <div class="help-inline" ng-messages="frmTransactionTypes.transaction_type_process_type.$error" ng-show="frmTransactionTypes.transaction_type_process_type.$invalid && frmTransactionTypes.transaction_type_process_type.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("transactionTypes/modalTransactionTypes.INPUT_PROCESS_TYPE")}}</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="state" class="col-sm-3 control-label">{{trans("transactionTypes/modalTransactionTypes.INPUT_INIT_PROC")}}</label>
                <div class="col-sm-9">
                    <label for="" class="radio-inline state">
                        <input type="radio" name="transactiontype_init_proc" ng-value="1" ng-model="transactiontype.init_proc" required>{{trans("transactionTypes/modalTransactionTypes.INPUT_INIT_PROC_OPT1")}}
                    </label>
                    <label for="" class="radio-inline state">
                        <input type="radio" name="transactiontype_init_proc" ng-value="0" ng-model="transactiontype.init_proc" required>{{trans("transactionTypes/modalTransactionTypes.INPUT_INIT_PROC_OPT2")}}
                    </label>
                    <div class="help-inline" ng-messages="frmTransactionTypes.transactiontype_init_proc.$error" ng-show="frmTransactionTypes.transactiontype_init_proc.$invalid && frmTransactionTypes.transactiontype_init_proc.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("transactionTypes/modalTransactionTypes.INPUT_INIT_PROC")}}</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="state" class="col-sm-3 control-label">{{trans("transactionTypes/modalTransactionTypes.INPUT_AUTO_ACTIVATE")}}</label>
                <div class="col-sm-9">
                    <label for="" class="radio-inline state">
                        <input type="radio" name="transactiontype_auto_activate" ng-value="1" ng-model="transactiontype.auto_activate" required>{{trans("transactionTypes/modalTransactionTypes.INPUT_INIT_PROC_OPT1")}}
                    </label>
                    <label for="" class="radio-inline state">
                        <input type="radio" name="transactiontype_auto_activate" ng-value="0" ng-model="transactiontype.auto_activate" required>{{trans("transactionTypes/modalTransactionTypes.INPUT_INIT_PROC_OPT2")}}
                    </label>
                    <div class="help-inline" ng-messages="frmTransactionTypes.transactiontype_auto_activate.$error" ng-show="frmTransactionTypes.transactiontype_auto_activate.$invalid && frmTransactionTypes.transactiontype_init_proc.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("transactionTypes/modalTransactionTypes.INPUT_AUTO_ACTIVATE")}}</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">{{trans("transactionTypes/modalTransactionTypes.INPUT_FREQ_ACTIVATE")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="transactiontype_freq_activate" name="transactiontype_freq_activate" placeholder=""
                           ng-model="transactiontype.freq_activate" ng-required="transactiontype.auto_activate" ng-disabled="transactiontype.auto_activate==0">
                    <div class="help-inline" ng-messages="frmTransactionTypes.transactiontype_freq_activate.$error" ng-show="frmTransactionTypes.transactiontype_freq_activate.$invalid && frmTransactionTypes.transactiontype_freq_activate.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("transactionTypes/modalTransactionTypes.INPUT_FREQ_ACTIVATE")}}</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">{{trans("transactionTypes/modalTransactionTypes.INPUT_WHEN_ACTIVATE")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="transactiontype_when_activate" name="transactiontype_when_activate" placeholder=""
                           ng-model="transactiontype.when_activate" ng-required="transactiontype.auto_activate" ng-disabled="transactiontype.auto_activate==0">
                    <div class="help-inline" ng-messages="frmTransactionTypes.transactiontype_when_activate.$error" ng-show="frmTransactionTypes.transactiontype_when_activate.$invalid && frmTransactionTypes.transactiontype_when_activate.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("transactionTypes/modalTransactionTypes.INPUT_WHEN_ACTIVATE")}}</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="state" class="col-sm-3 control-label">{{trans("transactionTypes/modalTransactionTypes.INPUT_STATE")}}</label>
                <div class="col-sm-9">
                    <label for="" class="radio-inline state">
                        <input type="radio" name="transactiontype_state" ng-value="'active'" ng-model="transactiontype.state" required>{{trans("transactionTypes/modalTransactionTypes.INPUT_STATE_OPT1")}}
                    </label>
                    <label for="" class="radio-inline state">
                        <input type="radio" name="transactiontype_state" ng-value="'inactive'" ng-model="transactiontype.state" required>{{trans("transactionTypes/modalTransactionTypes.INPUT_STATE_OPT2")}}
                    </label>
                    <div class="help-inline" ng-messages="frmTransactionTypes.transactiontype_state.$error" ng-show="frmTransactionTypes.transactiontype_state.$invalid && frmTransactionTypes.transactiontype_state.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("transactionTypes/modalTransactionTypes.INPUT_STATE")}}</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="executer" class="col-sm-3 control-label">{{trans("transactionTypes/modalTransactionTypes.INPUT_EXECUTER")}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="transactiontype_executer" ng-model="transactiontype.executer_actor.language[0].pivot.actor_id" ng-options="item.language[0].pivot.actor_id as item.language[0].pivot.name for item in executers" required>
                        <option value="">{{trans("transactionTypes/modalTransactionTypes.INPUT_executer_id")}}</option>
                    </select>
                    <div class="help-inline" ng-messages="frmTransactionTypes.transactiontype_executer.$error" ng-show="frmTransactionTypes.transactiontype_executer.$invalid && frmTransactionTypes.transactiontype_executer.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("transactionTypes/modalTransactionTypes.INPUT_EXECUTER")}}</p>
                    </div>
                </div>
                <br>
                <ul ng-repeat="error in errors">
                    <li>[[ error[0] ]]</li>
                </ul>

            </div>
            </div>
        </form>
    </div>
    <div class="modal-footer"><!-- ng-disabled="frmProcessTypes.$invalid" -->
        <button type="button" ng-disabled="frmTransactionTypes.$invalid" class="btn btn-green" id="btn-save" ng-click="save()" >{{trans("common.BTN1FORM")}}</button>
    </div>
</div>