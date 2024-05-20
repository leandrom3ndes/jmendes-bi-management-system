
                                <form name="frmTransactionTypes" class="form-horizontal" novalidate="">

                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-3 control-label">[[ "INPUT_NAME" | translate]]</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="transactiontype_t_name" name="transactiontype_t_name" placeholder=""
                                                   ng-model="modal.transaction.language[0].pivot.name">
                                            <span class="help-inline"
                                                  ng-show="frmTransactionTypes.transactiontype_t_name.$invalid && frmTransactionTypes.transactiontype_t_name.$touched">Name field is required</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputTransactionType" class="col-sm-3 control-label">Transaction Type</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" ng-model="modal.transaction.transaction_type_id" ng-options="item.id as item.language[0].pivot.t_name for item in transactiontypes">
                                                <option value=""></option>
                                            </select>
                                            <span class="help-inline"
                                                  ng-show="frmTransactionTypes.language_id.$invalid && frmTransactionTypes.language_id.$touched">State field is required</span>
                                        </div>
                                        <br>
                                        <ul ng-repeat="error in errors">
                                            <li>[[ error[0] ]]</li>
                                        </ul>

                                    </div>

                                    <div class="form-group">
                                        <label for="Gender" class="col-sm-3 control-label">[[ "INPUT_STATE" | translate]]</label>
                                        <div class="col-sm-9">
                                            <label for="" class="radio-inline state">
                                                <input type="radio" name="transactiontype_state" value="active" ng-model="modal.transaction.state" required>Active
                                            </label>
                                            <label for="" class="radio-inline state">
                                                <input type="radio" name="transactiontype_state" value="inactive" ng-model="modal.transaction.state" required>Inactive
                                            </label>
                                            <span class="help-inline"
                                                  ng-show="frmTransactionTypes.process_state.$invalid && frmTransactionTypes.process_state.$touched">State field is required</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="Gender" class="col-sm-3 control-label">[[ "INPUT_LANGUAGE" | translate]]</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" ng-model="entitytype.language[0].id" ng-options="item.id as item.slug for item in langs">
                                                <option value=""></option>
                                            </select>
                                            <span class="help-inline"
                                                  ng-show="frmTransactionTypes.language_id.$invalid && frmTransactionTypes.language_id.$touched">State field is required</span>
                                        </div>
                                        <br>
                                        <ul ng-repeat="error in errors">
                                            <li>[[ error[0] ]]</li>
                                        </ul>

                                    </div>
                                </form>

                                <button type="button" class="btn btn-default btn-blue" ng-click="changeTabBoot(modal.transaction.transaction_type_id, 'Task Form', 'tabFormTask', 2, 1)">Next</button>