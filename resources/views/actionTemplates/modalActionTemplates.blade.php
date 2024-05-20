<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">[[FORM_NAME]]</h4>
    </div>
    <div class="modal-body">
        <form name="frmActionTemplates" class="form-horizontal" novalidate="">
                    <div class="form-group">
                        <label for="inputTransactionType" class="col-sm-3 control-label">Action Rule</label>
                        <div class="col-sm-9">
                            <ui-select ng-model="actiontemplate.action_rule_id" theme="bootstrap" ng-required="true"
                                       ng-change="getValuesOfAction(actiontemplate.action_rule_id)">
                                <ui-select-match placeholder="">[[$select.selected.transaction_type_name]] -> [[$select.selected.t_state_name]]</ui-select-match>
                                <ui-select-choices group-by="'transaction_type_name'" repeat="item.id as item in action_rules | filter: $select.search">
                                    <div ng-bind-html="item.t_state_name | highlight: $select.search"></div>
                                </ui-select-choices>
                            </ui-select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputTransactionType" class="col-sm-3 control-label">Action</label>
                        <div class="col-sm-9">
                            <ui-select ng-model="actiontemplate.action_id" theme="bootstrap" ng-required="true">
                                <ui-select-match placeholder="">[[$select.selected.order]]
                                    - [[$select.selected.type]] </ui-select-match>
                                <ui-select-choices repeat="item.id as item in actions | filter: $select.search">
                                    [[item.order]]
                                    <div ng-bind-html="item.flow_type | highlight: $select.search">
                                    </div>
                                    [[item.type]]
                                </ui-select-choices>
                            </ui-select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputTransactionType" class="col-sm-3 control-label">Action Template Type</label>
                        <div class="col-sm-9">
                            <ui-select ng-model="actiontemplate.type" theme="bootstrap" ng-required="true">
                                <ui-select-match placeholder="">[[$select.selected]]</ui-select-match>
                                <ui-select-choices repeat="item in types | filter: $select.search">
                                    <div ng-bind-html="item | highlight: $select.search"></div>
                                </ui-select-choices>
                            </ui-select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputTransactionType" class="col-sm-2 control-label">Template Content</label>
                        <div class="col-sm-12">
                            <textarea ui-tinymce="tinymceOptions" ng-model="actiontemplate.text"></textarea>
                            [[actiontemplate.text]]
                        </div>
                    </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-green" id="btn-save" ng-click="save()" >{{trans("common.BTN1FORM")}}</button>
    </div>
</div>