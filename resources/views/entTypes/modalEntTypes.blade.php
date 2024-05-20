
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("entTypes/modalEntTypes.FORM_NAME")}}</h4>
    </div>
    <div class="modal-body">
        <form name="frmEntTypes" class="form-horizontal" novalidate="">

            <div class="form-group">
                <label for="inputName" class="col-sm-3 control-label">{{trans("entTypes/modalEntTypes.INPUT_NAME")}}</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="enttype_name" name="enttype_name" placeholder=""
                           ng-model="entitytype.language[0].pivot.name" required ng-maxlength="enttype_name_maxLength">
                    <div class="help-inline" ng-messages="frmEntTypes.enttype_name.$error" ng-show="frmEntTypes.enttype_name.$invalid && frmEntTypes.enttype_name.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("entTypes/modalEntTypes.INPUT_NAME")}}</p>
                        <p ng-message="maxlength">{{trans("validation.max.string")}} {{trans("entTypes/modalEntTypes.INPUT_NAME")}} {{trans("validation.miniMessage")}} [[enttype_name_maxLength]].</p>
                    </div>
                </div>
            </div>

            <div ng-if="::modalstate!=='add_name_lang'">
            <div class="form-group">
                <label for="inputTransactionType" class="col-sm-3 control-label">{{trans("entTypes/modalEntTypes.INPUT_TRANSACTION_TYPE")}}</label>
                <div class="col-sm-9">
                    <select class="form-control" name="transaction_type_id" ng-model="entitytype.transaction_type_id" ng-options="item.id as item.language[0].pivot.t_name for item in transactiontypes" required>
                        <option value="">{{trans("entTypes/modalEntTypes.INPUT_transaction_type_id")}}</option>
                    </select>
                    <div class="help-inline" ng-messages="frmEntTypes.transaction_type_id.$error" ng-show="frmEntTypes.transaction_type_id.$invalid && frmEntTypes.transaction_type_id.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("entTypes/modalEntTypes.INPUT_TRANSACTION_TYPE")}}</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="Gender" class="col-sm-3 control-label">{{trans("entTypes/modalEntTypes.INPUT_STATE")}}</label>
                <div class="col-sm-9">
                    <label for="" class="radio-inline state">
                        <input type="radio" name="enttype_state" value="active" ng-model="entitytype.state" required>{{trans("entTypes/modalEntTypes.INPUT_STATE_OPT1")}}
                    </label>
                    <label for="" class="radio-inline state">
                        <input type="radio" name="enttype_state" value="inactive" ng-model="entitytype.state" required>{{trans("entTypes/modalEntTypes.INPUT_STATE_OPT2")}}
                    </label>
                    <div class="help-inline" ng-messages="frmEntTypes.enttype_state.$error" ng-show="frmEntTypes.enttype_state.$invalid && frmEntTypes.enttype_state.$touched">
                        <p ng-message="required">{{trans("validation.required")}} {{trans("entTypes/modalEntTypes.INPUT_STATE")}}</p>
                    </div>
                </div>
            </div>
            </div>

        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-green" id="btn-save" ng-disabled="frmEntTypes.$invalid" ng-click="save()" >{{trans("entTypes/modalEntTypes.BTN1FORM")}}</button>
    </div>
</div>