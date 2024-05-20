                {{--TRANSACTION_ID: [[modal_form.transaction_id]]<br>
                TRANSACTION_TYPE_ID: [[modal_form.transaction_type_id]]<br>
                PROCESS_TYPE_ID: [[modal_form.process_type_id]]<br>
                PROCESS_ID: [[modal_form.process_id]]<br>
                T_STATE_ID: [[modal_form.t_state_id]]<br>
                ACTION_ID: [[modal_form.action_id]]<br>--}}

                <div growl reference="[[index]]">
                </div>
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" ng-click="cancel()" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">{{--{{trans("dashboard/modalTask.Modal_Name")}}--}}
                            Action [[order]]
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form name="frmTaskForm" class="form-horizontal" novalidate="">
                            <div ng-include="templateUrl" onload="modalInstance=mymodalInstance;propsform=myPropsform;message=myMessage;transaction_id=myTransactionId;t_state_id=myTStateid;action_id=myActionId"></div>
                        {{--<uib-tabset active="activeTabIndex" type="tabs">
                            <uib-tab ng-repeat="tab in tabs" index="$index" heading="[[tab.title]]" disable="tab.disabled">
                                <br>
                                <div ng-include="tab.templateUrl" onload="log(myPromise);typeid=mytypeid;indexTab=myindexTab;propsform=myPropsform;relTypeExist=myRelTypeExist;type=mytype;tabnumber=myTabNumber;message=myMessage"></div>
                            </uib-tab>
                        </uib-tabset>--}}
                        </form>
                    </div>
                    {{--<div class="modal-footer">
                        <button type="button" ng-disabled="frmTaskForm.$invalid || (tabs.length===1 && tabs[0].templateUrl==='tabProcess')" class="btn btn-lg btn-light-green" id="btn-save" ng-click="save(modal_formTab, modalInstance)" >{{trans("dashboard/modal.BTN_SAVE")}}</button>
                    </div>--}}
                </div>