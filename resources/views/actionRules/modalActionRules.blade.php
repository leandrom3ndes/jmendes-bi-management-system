<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" ng-click="cancel()" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Add/Edit Action Rule</h4>
    </div>
    <div class="modal-body">
        <form name="frmActionRules" class="form-horizontal" novalidate="">

            <div class="form-group">
                <label for="inputTransactionType" class="col-sm-3 control-label">Transaction Type</label>
                <div class="col-sm-9">
                    <ui-select ng-model="actionrule.transaction_type_id" theme="bootstrap" ng-required="true">
                        <ui-select-match placeholder="">[[$select.selected.language[0].pivot.t_name]]</ui-select-match>
                        <ui-select-choices repeat="item.id as item in transactiontypes | filter: $select.search">
                            <div ng-bind-html="item.language[0].pivot.t_name | highlight: $select.search"></div>
                        </ui-select-choices>
                    </ui-select>
                </div>
            </div>


            <div class="form-group">
                <label for="inputTransactionType" class="col-sm-3 control-label">T State</label>
                <div class="col-sm-9">
                    <ui-select ng-model="actionrule.t_state_id" theme="bootstrap" ng-required="true">
                        <ui-select-match placeholder="">[[$select.selected.language[0].pivot.name]]</ui-select-match>
                        <ui-select-choices repeat="item.id as item in tstates | filter: $select.search">
                            <div ng-bind-html="item.language[0].pivot.name | highlight: $select.search"></div>
                        </ui-select-choices>
                    </ui-select>
                </div>
            </div>

        </form>
    </div>
    <div class="modal-footer"><!-- ng-disabled="frmProcessTypes.$invalid" -->
        <button type="button" ng-disabled="frmActionRules.$invalid" class="btn btn-green" id="btn-save" ng-click="save()" >{{trans("common.BTN1FORM")}}</button>
    </div>
</div>