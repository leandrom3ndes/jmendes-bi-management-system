                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Causal Links - [[type]]</h3>
                                </div>

                                <div ng-repeat="causal_link in ::modal_form.c_act.causallinks">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-3 control-label">Transaction:</label>
                                            <div class="col-sm-9">
                                                <h5>[[causal_link.caused_action_rule.transaction_type.language[0].pivot.t_name]]</h5>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-3 control-label">T State:</label>
                                            <div class="col-sm-9">
                                                <h5>[[causal_link.caused_action_rule.t_state.language[0].pivot.name]]</h5>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-3 control-label">Min:</label>
                                            <div class="col-sm-9">
                                                <h5>[[causal_link.min]]</h5>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-3 control-label">Max:</label>
                                            <div class="col-sm-9">
                                                <h5>[[causal_link.max]]</h5>
                                            </div>
                                        </div>

                                    <form name="frmModalDialog" class="form-horizontal" novalidate="">
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-3 control-label">Number of transactions to iniciate?</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="number_T" name="number_T" placeholder=""
                                                       ng-model="causal_link.numberOfTrs">
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" ng-disabled="frmModalDialog.$invalid || counterSaveAsyncr > 0"
                                        class="btn btn-lg btn-light-green" ng-click="identifyModalToOpen(modal_form.transaction_type_id, modal_form.transaction_id, 1, null, modalInstance, modal_form)"
                                        id="btn-save" >{{trans("dashboard/modal.BTN_CONTINUE")}}</button>
                            </div>