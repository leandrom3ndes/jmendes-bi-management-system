
                <div growl reference="[[index]]"></div>
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" ng-click="cancel()" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">{{trans("dashboard/modalTransactionState.Modal_Name")}}</h4>
                    </div>
                    <div class="modal-body">
                        <form name="frmTaskForm" class="form-horizontal" novalidate="">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>{{trans("dashboard/modalTransactionState.TRANS_ID")}}</th>
                                        <th>{{trans("dashboard/modalTransactionState.TRANS_TYPE")}}</th>
                                        <th>{{trans("dashboard/modalTransactionState.TRANS_STATE")}}</th>
                                        <th>{{trans("dashboard/modalTransactionState.TRANS_ACK")}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="transactionstate in transactionstates">
                                        <td>[[ transactionstate.transaction_id ]]</td>
                                        <td>[[ transactionstate.transaction.transaction_type.language[0].pivot.t_name ]]</td>
                                        <td>[[ transactionstate.t_state.language[0].pivot.name ]]</td>
                                        <td>[[ transactionstate.transaction_ack[0].viewed_on ]] [[ transactionstate.transaction_ack[0].user.user_name ]]</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        <button type="button" class="btn btn-default btn-info"
                                ng-if="((transactionstates[transactionstates.length-1].transaction_ack.length === 0 || transactionstates[transactionstates.length-1].transaction_ack[0] == null)
                                         && ((actorCan === 'Iniciator' && (transactionstates[transactionstates.length-1].t_state_id === 2 || transactionstates[transactionstates.length-1].t_state_id === 3 || transactionstates[transactionstates.length-1].t_state_id === 4))
                                        || ((actorCan === 'Executer') && (transactionstates[transactionstates.length-1].t_state_id === 1 || transactionstates[transactionstates.length-1].t_state_id === 5))))"
                                ng-click="trans_ack(transactionstates[transactionstates.length-1])">{{trans("dashboard/modalTransactionState.BTN_ACK")}}</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-lg btn-light-green" ng-click="identifyModalToOpen(transactionstates[transactionstates.length-1].transaction.transaction_type_id, transactionstates[transactionstates.length-1].transaction_id, 1, transactionstates[transactionstates.length-1].transaction.process_id, null, null)">{{trans("dashboard/modal.BTN_CONTINUE")}}</button>
                    </div>
                </div>