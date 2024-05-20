
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">{{trans("roles/modalDelegateRolesToRole.MODAL_TITLE")}}</h4>
    </div>
    <div class="modal-body">
        <form name="frmDelegateRolesToRole" class="form-horizontal" novalidate="">

            <label class="col-sm-12 text-center">{{trans("roles/modalDelegateRolesToRole.LBL1")}} [[delegation.delegate_name]]</label>

            <div class="form-group">
                <label for="inputRoles" class="col-sm-3 control-label">{{trans("roles/modalDelegateRolesToRole.LBL2")}}</label>
                <div class="col-sm-9">
                    <ui-select ng-model="delegation.delegated_role_id" theme="bootstrap" ng-required="true">
                        <ui-select-match placeholder="">[[$select.selected.name]]</ui-select-match>
                        <ui-select-choices repeat="item.id as item in roles | filter: $select.search">
                            <div ng-bind-html="item.name | highlight: $select.search"></div>
                        </ui-select-choices>
                    </ui-select>
                </div>
            </div>


            <div class="form-group">
                <label for="inputTState" class="col-sm-3 control-label">{{trans("roles/modalDelegateRolesToRole.LBL3")}}</label>
                <div class="col-sm-9">
                    <ui-select ng-model="delegation.t_state_id" theme="bootstrap" ng-required="true">
                        <ui-select-match placeholder="">[[$select.selected.name]]</ui-select-match>
                        <ui-select-choices repeat="item.id as item in tstates | filter: $select.search">
                            <div ng-bind-html="item.name | highlight: $select.search"></div>
                        </ui-select-choices>
                    </ui-select>
                </div>
            </div>

            <div class="form-group"> <!--por fazer, alterar para a traduçao correspondente START TIME-->
                <label for="InputTState" class="col-sm-3 control-label">Start Time</label>
                <div class="col-sm-9">
                    <input type="date" id="start_time_date" name="start_time_date" ng-model="delegation.start_time_date"
                           ng-change="validationDate(delegation.start_time_date, delegation.end_time_date, delegation.start_time_time,
                            delegation.end_time_time)" required />
                    <!--ng-required="delegation.start_time_time || delegation.end_time_date"-->

                    <div uib-timepicker id="start_time_time" ng-model="delegation.start_time_time" ng-disabled="!delegation.start_time_date"
                         hour-step="1" minute-step="1" show-meridian="false"
                         ng-change="validationDate(delegation.start_time_date, delegation.end_time_date, delegation.start_time_time,
                            delegation.end_time_time)"
                    ></div>

                    <div class="help-inline" ng-messages="frmDelegateRolesToRole.start_time_date.$error" ng-show="frmDelegateRolesToRole.start_time_date.$invalid && frmDelegateRolesToRole.start_time_date.$touched">
                        <p ng-message="required">{{trans("processTypes/validation.required")}} Start Time Date</p>
                    </div>
                    <!--<div class="help-inline" ng-messages="frmDelegateRolesToRole.start_time_time.$error" ng-show="frmDelegateRolesToRole.start_time_time.$invalid && frmDelegateRolesToRole.start_time_time.$touched">
                        <p ng-message="required">{{trans("processTypes/validation.required")}} Start Time Time</p>
                    </div>-->
                </div>
            </div>

            <div class="form-group"> <!--por fazer, alterar para a traduçao correspondente END TIME-->
                <label for="InputTState" class="col-sm-3 control-label">End Time</label>
                <div class="col-sm-9">
                    <input type="date" id="end_time_date" name="end_time_date" ng-model="delegation.end_time_date"
                           ng-disabled="!delegation.start_time_date"
                            ng-change="validationDate(delegation.start_time_date, delegation.end_time_date, delegation.start_time_time,
                            delegation.end_time_time)" />
                    <!--ng-required="delegation.start_time_date || delegation.end_time_time"-->
                    <div uib-timepicker id="end_time_time" ng-model="delegation.end_time_time" ng-disabled="!delegation.end_time_date"
                         hour-step="1" minute-step="1" show-meridian="false"
                         ng-change="validationDate(delegation.start_time_date, delegation.end_time_date, delegation.start_time_time,
                            delegation.end_time_time)" ></div>

                    [[errMessageDate]]
                    [[errMessageTime]]
                    <!--<div class="help-inline" ng-messages="frmDelegateRolesToRole.end_time_date.$error" ng-show="frmDelegateRolesToRole.end_time_date.$invalid && frmDelegateRolesToRole.end_time_date.$touched">
                        <p ng-message="required">{{trans("processTypes/validation.required")}} End Time Date</p>
                    </div>-->
                    <!--<div class="help-inline" ng-messages="frmDelegateRolesToRole.end_time_time.$error" ng-show="frmDelegateRolesToRole.end_time_time.$invalid && frmDelegateRolesToRole.end_time_time.$touched">
                        <p ng-message="required">{{trans("processTypes/validation.required")}} End Time Time</p>
                    </div>-->
                </div>
            </div>

            {{--<div class="form-group"> <!--por fazer, alterar para a traduçao correspondente--> START TIME AND END TIME
                <label for="InputTState" class="col-sm-3 control-label">Start Time</label>
                <div class="col-sm-9">
                    <input type="datetime-local" id="exampleInput" name="input" ng-model="delegation.start_time"
                           placeholder="yyyy-MM-ddTHH:mm:ss" min="2001-01-01T00:00:00" max="2013-12-31T00:00:00" required />
                    <div class="help-inline" ng-messages="frmDelegateRolesToRole.delegation_state.$error" ng-show="frmDelegateRolesToRole.delegation_state.$invalid && frmDelegateRolesToRole.delegation_state.$touched">
                        <p ng-message="required">{{trans("processTypes/validation.required")}} {{trans("processTypes/modalProcessTypes.INPUT_STATE")}}</p>
                    </div>
                </div>
            </div>--}}

            <div class="form-group">
                <label for="InputTState" class="col-sm-3 control-label">{{trans("roles/modalDelegateRolesToRole.INPUT_STATE")}}</label>
                <div class="col-sm-9">
                    <label for="" class="radio-inline state">
                        <input type="radio" name="delegation_state" value="active" ng-model="delegation.state" required>{{trans("roles/modalDelegateRolesToRole.INPUT_STATE_OPT1")}}
                    </label>
                    <label for="" class="radio-inline state">
                        <input type="radio" name="delegation_state" value="inactive" ng-model="delegation.state" required>{{trans("roles/modalDelegateRolesToRole.INPUT_STATE_OPT2")}}
                    </label>
                    <div class="help-inline" ng-messages="frmDelegateRolesToRole.delegation_state.$error" ng-show="frmDelegateRolesToRole.delegation_state.$invalid && frmDelegateRolesToRole.delegation_state.$touched">
                        <p ng-message="required">{{trans("processTypes/validation.required")}} {{trans("roles/modalDelegateRolesToRole.INPUT_STATE")}}</p>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-green" id="btn-save" ng-disabled="frmDelegateRolesToRole.$invalid" ng-click="save()" >{{trans("common.BTN1FORM")}}</button>
    </div>
</div>