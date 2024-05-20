
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">View Actions</h4>
    </div>
    <div class="modal-body">
        <form name="frmRemoveRolesFromActor" class="form-horizontal" novalidate="">
            <label class="col-sm-12 text-center">[[ role.name ]]</label>
            <div class="form-group">
                <div class="col-sm-12">
                    <table class="table" ui-sortable="sortableOptions" ng-model="actionsFromAR" ui-sortable-update="updateOrderActions">
                        <thead>
                        <tr>
                            <th>Actions</th>
                            <th>Expressions</th>
                            <th>ID</th>
                            <th>Flow Type</th>
                            <th>Type</th>
                            <th>
                                <button class="btn btn-success btn-xs btn-detail" ng-click="openModalFormAddNewAction()">Add New Action</button>
                            </th>
                        </tr>
                        </thead>
                        <tbody ng-repeat="action in actionsFromAR" ng-init="action.expanded = true">
                        <tr>
                            <td>
                                <button class="btn btn-danger btn-xs btn-delete" id="btn-delete" ng-click="removeactor(selactor.id)">{{trans("common.BTNTABLE3")}}</button>
                                <button class="btn btn-danger btn-xs btn-delete" id="btn-delete" ng-if="action.flow_type==='then' || action.flow_type==='else'" ng-click="openModalFormAddNewAction(action.id)">Add New Sub Action</button>
                                <button class="btn btn-info btn-xs btn-info" id="btn-info" ng-click="openModalFormEditAction(action.id)">Edit</button>
                                <button ng-disabled="true" ng-if="action.flow_type==='Atomic'" class="btn btn-info btn-xs btn-info" id="btn-info">Template</button>
                            </td>
                            <td colspan="[[action.numberLevels+1]]">
                                <button ng-if="(action.ar_conditions != '' || action.causal_link != '' || action.comp_expressions != '' || action.informal_expressions != '') && action.expanded" ng-click="action.expanded = false">-</button>
                                <button ng-if="(action.ar_conditions != '' || action.causal_link != '' || action.comp_expressions != '' || action.informal_expressions != '') && !action.expanded" ng-click="action.expanded = true">+</button>
                            </td>
                            <td>[[ action.id ]]</td>
                            <td>[[ action.flow_type ]]</td>
                            <td>[[ action.type]]</td>
                        </tr>
                        <tr ng-if="action.expanded" ng-repeat="ar_condition in action.ar_conditions">
                            <td colspan="[[action.numberLevels+3]]"></td>
                            <td colspan="[[6-(action.numberLevels+3)]]">[[ (ar_condition.type === 'Comp Expression' || ar_condition.type === 'Informal Expression') ? '' : ar_condition.type + '|']]
                                [[ ar_condition.comp_expressions[0].property1.language[0].pivot.name]]
                                [[ ar_condition.comp_expressions[0].operator]] [[ ar_condition.comp_expressions[0].values1.value]]
                                [[ ar_condition.comp_expressions[0].value1 ]] [[ ar_condition.informal_expressions[0].string ]]
                                [[ ar_condition.comp_expressions[0].property2.language[0].pivot.name]]
                            </td>
                        </tr>
                        <tr ng-if="action.expanded && (action.comp_expressions != '' || action.informal_expressions != '')">
                            <td colspan="[[action.numberLevels+3]]"></td>
                            <td colspan="[[6-(action.numberLevels+3)]]">
                                [[ action.comp_expressions[0].property1.language[0].pivot.name]]
                                [[ action.comp_expressions[0].operator]] [[ action.comp_expressions[0].values1.value]]
                                [[ action.comp_expressions[0].value1 ]] [[ action.informal_expressions[0].string ]]
                                [[ action.comp_expressions[0].property2.language[0].pivot.name]]
                            </td>
                        </tr>
                        <tr ng-if="action.expanded" ng-repeat="causallink in action.causal_link">
                            <td colspan="[[action.numberLevels+3]]"></td>
                            <td colspan="[[6-(action.numberLevels+3)]]">[[ causallink.caused_action_rule.transaction_type.language[0].pivot.t_name ]] [must be]
                                [[ causallink.caused_action_rule.t_state.language[0].pivot.name ]]
                            </td>
                        </tr>
                        </tbody>
                        {{--<tbody>
                        <tr ng-repeat-start="action in actionsFromAR">
                            <td>
                                <button ng-if="action.ar_conditions != '' && action.expanded" ng-click="action.expanded = false">-</button>
                                <button ng-if="action.ar_conditions != '' && !action.expanded" ng-click="action.expanded = true">+</button>
                            </td>
                            <td>[[ action.id ]]</td>
                            <td>[[ action.flow_type ]]</td>
                            <td>[[ action.then_else ]]</td>
                            <td>[[ action.type]]</td>
                            <td>
                                <button class="btn btn-danger btn-xs btn-delete" id="btn-delete" ng-click="removeactor(selactor.id)">{{trans("common.BTNTABLE3")}}</button>
                                <button class="btn btn-danger btn-xs btn-delete" id="btn-delete" ng-if="action.flow_type==='Block'" ng-click="openModalFormAddNewAction(action.id)">Add New Sub Action</button>
                            </td>
                        </tr>
                        <tr ng-if="action.expanded" ng-repeat-end ng-repeat="ar_condition in action.ar_conditions">
                            <td colspan="6">[[ ar_condition.type ]] | [[ ar_condition.comp_expressions[0].property.language[0].pivot.name]]
                                [[ ar_condition.comp_expressions[0].operator]] [[ ar_condition.comp_expressions[0].values.value]]
                                [[ ar_condition.comp_expressions[0].value ]] [[ ar_condition.informal_expressions[0].string ]]
                            </td>
                        </tr>
                        </tbody>--}}
                    </table>
                </div>
            </div>

        </form>
    </div>
    <div class="modal-footer">

    </div>
</div>