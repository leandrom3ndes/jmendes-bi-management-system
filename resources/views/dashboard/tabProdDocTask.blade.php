
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Produce Document - [[type]]</h3>
                    </div>
                    <div ng-bind-html="messageNotificationHTML"></div>
                    <div class="panel-body">
                        <button type="button"
                                class="btn btn-lg btn-light-red" ng-click="downloadDocument(modal_form.prod_doc)"
                                id="btn-save" >Download File</button>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" ng-disabled="counterSaveAsyncr > 0"
                            class="btn btn-lg btn-light-green" ng-click="identifyModalToOpen(modal_form.transaction_type_id, modal_form.transaction_id, 1, null, modalInstance, modal_form)"
                            id="btn-save" >{{trans("dashboard/modal.BTN_CONTINUE")}}</button>
                </div>