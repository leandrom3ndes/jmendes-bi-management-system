<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">[[FORM_NAME]]</h4>
    </div>
    <div class="modal-body">
        <form name="frmTransactionTypes" class="form-horizontal" novalidate="">
            {{--<ul class="outerMenu">
                <li ng-repeat="action_form in actions track by $index">
                        <div class="form-group" style="border-style: dashed;">
                            <div ng-class="action_form.then_else != null ? 'col-sm-4' : 'col-sm-6'">
                                <label for="inputTransactionType" class="col-sm-4 control-label">Flow Type</label>
                                <ui-select ng-model="action_form.flow_type" theme="bootstrap" ng-required="true">
                                    <ui-select-match placeholder="">[[$select.selected]]</ui-select-match>
                                    <ui-select-choices repeat="item in flowtypes | filter: $select.search">
                                        <div ng-bind-html="item | highlight: $select.search"></div>
                                    </ui-select-choices>
                                </ui-select>
                            </div>
                            <div class="col-sm-4" ng-if="action_form.then_else != null">
                                <label for="inputTransactionType" class="col-sm-4 control-label">Then Else</label>
                                <ui-select ng-model="action_form.then_else" theme="bootstrap" ng-required="true">
                                    <ui-select-match placeholder="">[[$select.selected]]</ui-select-match>
                                    <ui-select-choices repeat="item in thenelses | filter: $select.search">
                                        <div ng-bind-html="item | highlight: $select.search"></div>
                                    </ui-select-choices>
                                </ui-select>
                            </div>
                            <div ng-class="action_form.then_else != null ? 'col-sm-4' : 'col-sm-6'">
                                <label for="inputTransactionType" class="col-sm-4 control-label">Type</label>
                                <ui-select ng-model="action_form.type" theme="bootstrap" ng-required="true">
                                    <ui-select-match placeholder="">[[$select.selected]]</ui-select-match>
                                    <ui-select-choices repeat="item in types | filter: $select.search">
                                        <div ng-bind-html="item | highlight: $select.search"></div>
                                    </ui-select-choices>
                                </ui-select>
                            </div>

                            <ul>
                                <li ng-repeat="expression in action_form.expressions" style="border-bottom: 2px solid red;">
                                    <div class="form-group">
                                        <div class="col-sm-3">
                                            <label for="inputTransactionType" class="col-sm-3 control-label">Property</label>
                                            <ui-select ng-model="action_form.flow_type" theme="bootstrap" ng-required="true">
                                                <ui-select-match placeholder="">[[$select.selected]]</ui-select-match>
                                                <ui-select-choices repeat="item in flowtypes | filter: $select.search">
                                                    <div ng-bind-html="item | highlight: $select.search"></div>
                                                </ui-select-choices>
                                            </ui-select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="inputTransactionType" class="col-sm-3 control-label">Operator</label>
                                            <ui-select ng-model="action_form.operator" theme="bootstrap" ng-required="true">
                                                <ui-select-match placeholder="">[[$select.selected]]</ui-select-match>
                                                <ui-select-choices repeat="item in operators | filter: $select.search">
                                                    <div ng-bind-html="item | highlight: $select.search"></div>
                                                </ui-select-choices>
                                            </ui-select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="inputTransactionType" class="col-sm-3 control-label">Value</label>
                                            <ui-select ng-model="action_form.flow_type" theme="bootstrap" ng-required="true">
                                                <ui-select-match placeholder="">[[$select.selected]]</ui-select-match>
                                                <ui-select-choices repeat="item in flowtypes | filter: $select.search">
                                                    <div ng-bind-html="item | highlight: $select.search"></div>
                                                </ui-select-choices>
                                            </ui-select>
                                        </div>
                                        <div class="col-sm-3" ng-if="action_form.expressions.length > 1 && expression != action_form.expressions[action_form.expressions.length-1]">
                                            <label for="inputTransactionType" class="col-sm-3 control-label">Condition</label>
                                            <ui-select ng-model="action_form.arcondition_type" theme="bootstrap" ng-required="true">
                                                <ui-select-match placeholder="">[[$select.selected]]</ui-select-match>
                                                <ui-select-choices repeat="item in arcondition_types | filter: $select.search">
                                                    <div ng-bind-html="item | highlight: $select.search"></div>
                                                </ui-select-choices>
                                            </ui-select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="inputTransactionType" class="col-sm-3 control-label">Acts</label><br>
                                            <button class="btn btn-danger">- Exp</button>
                                            <button class="btn btn-green" ng-click="addNewExpressionForm($parent.$index, $index, expression)">+ Exp</button>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <div class="col-sm-4">
                                <button class="btn btn-danger" ng-click="removeActionForm($index)">- AR</button>
                                <button class="btn btn-green" ng-click="addNewActionForm($index, action_form)">+ AR</button>
                            </div>
                        </div>
                </li>
            </ul>--}}

                    <div class="form-group">
                        <div class="col-sm-4">
                            <label for="inputTransactionType" class="col-sm-6 control-label">Flow Type</label>
                            <ui-select ng-model="action.flow_type" theme="bootstrap" ng-required="true" ng-change="addExpressionType(action)">
                                <ui-select-match placeholder="">[[$select.selected]]</ui-select-match>
                                <ui-select-choices repeat="item in flowtypes | filter: $select.search">
                                    <div ng-bind-html="item | highlight: $select.search"></div>
                                </ui-select-choices>
                            </ui-select>
                        </div>
                        <div class="col-sm-4">
                            <label for="inputTransactionType" class="col-sm-6 control-label">Type</label>
                            <ui-select ng-model="action.type" theme="bootstrap" ng-required="true">
                                <ui-select-match placeholder="">[[$select.selected]]</ui-select-match>
                                <ui-select-choices repeat="item in types | filter: $select.search">
                                    <div ng-bind-html="item | highlight: $select.search"></div>
                                </ui-select-choices>
                            </ui-select>
                        </div>
                    </div>

                        <button ng-if="action.flow_type!==undefined && action.type!=='spec_data' && (action.flow_type!=='then' && action.flow_type!=='else')
                        && action.type!=='c-act' && action.type!=='prod_doc'" ng-click="changeTypeExpression(0)">Compute Expression</button>
                        <button ng-if="action.flow_type!==undefined && action.type!=='spec_data' && (action.flow_type!=='then' && action.flow_type!=='else')
                        && action.type!=='c-act' && action.type!=='prod_doc'" ng-click="changeTypeExpression(1)">Informal Expression</button>

                        <ul style="list-style-type: none;" ng-if="action.flow_type==='If' || action.flow_type==='While'">
                            <li ng-repeat="condition in action.conditions">
                                <div class="form-group" ng-if="action.typeArCond === 0">
                                    <div class="col-sm-3">
                                        <label class="col-sm-3 control-label">Type</label>
                                        <ui-select ng-model="condition.expression.compute_exp_type" theme="bootstrap" ng-required="true">
                                            <ui-select-match placeholder="">[[$select.selected.name]]</ui-select-match>
                                            <ui-select-choices repeat="item.id as item in compExpTypes | filter: $select.search">
                                                <div ng-bind-html="item.name | highlight: $select.search"></div>
                                            </ui-select-choices>
                                        </ui-select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="inputTransactionType" class="col-sm-3 control-label">Property</label>
                                        <ui-select ng-model="condition.expression.property_id1" theme="bootstrap" ng-required="true"
                                                   ng-change="getValuesOfProperty(condition.expression.property_id1, $index, 0)">
                                            <ui-select-match placeholder="">[[$select.selected.language[0].pivot.name]]</ui-select-match>
                                            <ui-select-choices repeat="item in properties | filter: $select.search">
                                                <div ng-bind-html="item.language[0].pivot.name | highlight: $select.search"></div>
                                            </ui-select-choices>
                                        </ui-select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="inputTransactionType" class="col-sm-3 control-label">Operator</label>
                                        <ui-select ng-model="condition.expression.operator" theme="bootstrap" ng-required="true">
                                            <ui-select-match placeholder="">[[$select.selected]]</ui-select-match>
                                            <ui-select-choices repeat="item in operators | filter: $select.search">
                                                <div ng-bind-html="item | highlight: $select.search"></div>
                                            </ui-select-choices>
                                        </ui-select>
                                    </div>

                                    <div class="col-sm-3" ng-if="condition.expression.compute_exp_type === 2">
                                        <label for="inputTransactionType" class="col-sm-3 control-label">Value</label>
                                        <ui-select ng-model="condition.expression.value" theme="bootstrap" ng-required="true"
                                                   ng-show="condition.expression.property_id1.value_type==='prop_ref' || condition.expression.property_id1.value_type==='enum'">
                                            <ui-select-match placeholder="">[[$select.selected.value]]</ui-select-match>
                                            <ui-select-choices repeat="item.id as item in condition.expression.values | filter: $select.search">
                                                <div ng-bind-html="item.value | highlight: $select.search"></div>
                                            </ui-select-choices>
                                        </ui-select>
                                        <input type="text" class="form-control" id="actor_name" name="actor_name" placeholder="" value="[[name]]"
                                               ng-model="condition.expression.value" ng-required="true" ng-show="!(condition.expression.property_id1.value_type==='prop_ref' || condition.expression.property_id1.value_type==='enum')">
                                    </div>
                                    <div class="col-sm-3" ng-if="condition.expression.compute_exp_type === 1">
                                        <label for="inputTransactionType" class="col-sm-3 control-label">Property</label>
                                        <ui-select ng-model="condition.expression.property_id2" theme="bootstrap" ng-required="true">
                                            <ui-select-match placeholder="">[[$select.selected.language[0].pivot.name]]</ui-select-match>
                                            <ui-select-choices repeat="item in properties | filter: $select.search">
                                                <div ng-bind-html="item.language[0].pivot.name | highlight: $select.search"></div>
                                            </ui-select-choices>
                                        </ui-select>
                                    </div>
                                </div>

                                <div class="form-group" ng-if="action.typeArCond === 1">
                                    <div class="col-sm-3">
                                        <label for="inputTransactionType" class="col-sm-3 control-label">String</label>
                                        <input type="text" class="form-control" id="actor_name" name="actor_name" placeholder="" value="[[name]]"
                                               ng-model="condition.expression.string" ng-required="true">
                                    </div>
                                </div>

                                <div class="form-group">
                                <div class="col-sm-3" ng-if="action.conditions.length > 1 && condition != action.conditions[action.conditions.length-1]">
                                    <label for="inputTransactionType" class="col-sm-3 control-label">Condition</label>
                                    <ui-select ng-model="condition.arcondition_type" theme="bootstrap" ng-required="true">
                                        <ui-select-match placeholder="">[[$select.selected]]</ui-select-match>
                                        <ui-select-choices repeat="item in arcondition_types | filter: $select.search">
                                            <div ng-bind-html="item | highlight: $select.search"></div>
                                        </ui-select-choices>
                                    </ui-select>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label for="inputTransactionType" class="col-sm-3 control-label">Acts</label><br>
                                        <button class="btn btn-danger" ng-click="removeExpressionForm($index)">- Exp</button>
                                        <button class="btn btn-green" ng-show="showOptionsExpressions(condition)" ng-click="addNewExpressionForm($index)">+ Exp</button>
                                    </div>
                                </div>
                                </div>
                            </li>
                        </ul>

                        <ul style="list-style-type: none;" ng-if="action.flow_type==='Atomic' && action.flow_type!==undefined && action.type!=='c-act'
                        && action.type!=='spec_data' && action.type!=='prod_doc'">
                            <li>
                                <div class="form-group" ng-if="action.typeArCond === 0">
                                    <div class="col-sm-3">
                                        <label class="col-sm-3 control-label">Type</label>
                                        <ui-select ng-model="action.expressions.compute_exp_type" theme="bootstrap" ng-required="true">
                                            <ui-select-match placeholder="">[[$select.selected.name]]</ui-select-match>
                                            <ui-select-choices repeat="item.id as item in compExpTypes | filter: $select.search">
                                                <div ng-bind-html="item.name | highlight: $select.search"></div>
                                            </ui-select-choices>
                                        </ui-select>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="inputTransactionType" class="col-sm-3 control-label">Property</label>
                                        <ui-select ng-model="action.expressions.property_id1" theme="bootstrap" ng-required="true"
                                                   ng-change="getValuesOfProperty(action.expressions.property_id1, $index, 1)">
                                            <ui-select-match placeholder="">[[$select.selected.language[0].pivot.name]]</ui-select-match>
                                            <ui-select-choices repeat="item in properties | filter: $select.search">
                                                <div ng-bind-html="item.language[0].pivot.name | highlight: $select.search"></div>
                                            </ui-select-choices>
                                        </ui-select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="inputTransactionType" class="col-sm-3 control-label">Operator</label>
                                        <ui-select ng-model="action.expressions.operator" theme="bootstrap" ng-required="true">
                                            <ui-select-match placeholder="">[[$select.selected]]</ui-select-match>
                                            <ui-select-choices repeat="item in operators | filter: $select.search">
                                                <div ng-bind-html="item | highlight: $select.search"></div>
                                            </ui-select-choices>
                                        </ui-select>
                                    </div>
                                    <div class="col-sm-3" ng-if="action.expressions.compute_exp_type === 2">
                                        <label for="inputTransactionType" class="col-sm-3 control-label">Value</label>
                                        <ui-select ng-model="action.expressions.value" theme="bootstrap" ng-required="true"
                                                   ng-show="action.expressions.property_id1.value_type==='prop_ref' || action.expressions.property_id1.value_type==='enum'">
                                            <ui-select-match placeholder="">[[$select.selected.value]]</ui-select-match>
                                            <ui-select-choices repeat="item.id as item in action.expressions.values | filter: $select.search">
                                                <div ng-bind-html="item.value | highlight: $select.search"></div>
                                            </ui-select-choices>
                                        </ui-select>
                                        <input type="text" class="form-control" id="actor_name" name="actor_name" placeholder="" value="[[name]]"
                                               ng-model="action.expressions.value" ng-required="true" ng-show="!(action.expressions.property_id1.value_type==='prop_ref' || action.expressions.property_id1.value_type==='enum')">
                                    </div>
                                    <div class="col-sm-3" ng-if="action.expressions.compute_exp_type === 1">
                                        <label for="inputTransactionType" class="col-sm-3 control-label">Property</label>
                                        <ui-select ng-model="action.expressions.property_id2" theme="bootstrap" ng-required="true">
                                            <ui-select-match placeholder="">[[$select.selected.language[0].pivot.name]]</ui-select-match>
                                            <ui-select-choices repeat="item in properties | filter: $select.search">
                                                <div ng-bind-html="item.language[0].pivot.name | highlight: $select.search"></div>
                                            </ui-select-choices>
                                        </ui-select>
                                    </div>
                                </div>

                                <div class="form-group" ng-if="action.typeArCond === 1">
                                    <div class="col-sm-3">
                                        <label for="inputTransactionType" class="col-sm-3 control-label">String</label>
                                        <input type="text" class="form-control" id="actor_name" name="actor_name" placeholder="" value="[[name]]"
                                               ng-model="action.expressions.string" ng-required="true">
                                    </div>
                                </div>
                            </li>
                        </ul>

                        <ul style="list-style-type: none;" ng-if="action.flow_type==='Atomic' && action.type==='c-act'">
                            <li>
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <label class="col-sm-12 control-label">Transaction Type</label>
                                        <ui-select ng-model="action.c_act.transactiontype" theme="bootstrap" ng-required="true">
                                            <ui-select-match placeholder="">[[$select.selected.t_name]]</ui-select-match>
                                            <ui-select-choices repeat="item.id as item in transactiontypes | filter: $select.search">
                                                <div ng-bind-html="item.t_name | highlight: $select.search"></div>
                                            </ui-select-choices>
                                        </ui-select>
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="inputTransactionType" class="col-sm-6 control-label">T State</label>
                                        <ui-select ng-model="action.c_act.t_state" theme="bootstrap" ng-required="true">
                                            <ui-select-match placeholder="">[[$select.selected.name]]</ui-select-match>
                                            <ui-select-choices repeat="item.id as item in tstates | filter: $select.search">
                                                <div ng-bind-html="item.name | highlight: $select.search"></div>
                                            </ui-select-choices>
                                        </ui-select>
                                    </div>


                                    <div class="col-sm-3">
                                        <label for="inputName" class="col-sm-6 control-label">{{trans("causalLinks/modalCausalLinks.INPUT_MIN")}}</label>
                                        <input type="text" class="form-control" id="min" name="min" placeholder=""
                                                   ng-model="action.c_act.min" required ng-pattern="/^(?!00)([0-9])*$/">
                                    </div>

                                    <div class="col-sm-3">
                                        <label for="inputName" class="col-sm-6 control-label">{{trans("causalLinks/modalCausalLinks.INPUT_MAX")}}</label>
                                        <input type="text" class="form-control" id="max" name="max" ng-pattern="/^(?!0)([0-9])*$|^(\*)$/" placeholder=""
                                                   ng-model="action.c_act.max" required>
                                    </div>
                                </div>
                            </li>
                        </ul>
        </form>
    </div>
    <div class="modal-footer"><!-- ng-disabled="frmProcessTypes.$invalid" -->
        <button type="button" class="btn btn-green" id="btn-save" ng-click="save()" >{{trans("common.BTN1FORM")}}</button>
    </div>
</div>