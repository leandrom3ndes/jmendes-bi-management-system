
                                    <div class="form-group">
                                        <label for="inputTransactionType" class="col-sm-3 control-label">{{trans("dashboard/tabProcess.PROC")}}:</label>
                                        <div class="col-sm-9">
                                            <ui-select ng-model="modal_processTab.process.selected" theme="bootstrap">
                                                <ui-select-match placeholder="{{trans("dashboard/tabProcess.INPUT_SEL_PROC")}}">[[$select.selected.language[0].pivot.name]]</ui-select-match>
                                                <ui-select-choices repeat="item.id as item in process | filter: $select.search">
                                                    <div ng-bind-html="item.language[0].pivot.name | highlight: $select.search"></div>
                                                </ui-select-choices>
                                            </ui-select>
                                        </div>
                                    </div>

                               <button type="button" class="btn btn-lg btn-light-green" ng-disabled="!modal_processTab.process.selected" ng-click="identifyModalToOpen(modal_form.transaction_type_id, modal_form.transaction_id, 1, modal_processTab.process.selected, modalInstance)">{{trans("dashboard/modal.BTN_CONTINUE")}}</button>