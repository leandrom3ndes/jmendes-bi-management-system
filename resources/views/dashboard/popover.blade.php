
                <div class="table-responsive">
                    <h4>Properties</h4>
                    <table class="table-bordered" ng-if="prop.PropertiesInfo!=null">
                        <tr>
                            <th>Transaction Type</th>
                            <th>Transaction ID</th>
                            <th>Transaction State</th>
                            <th>Transaction State Date</th>
                            <th>Property Name</th>
                            <th>Value</th>
                        </tr>
                        <tr ng-repeat="transaction in prop.PropertiesInfo">
                            <td>[[transaction.t_name]]</td>
                            <td>[[transaction.transaction_id]]</td>
                            <td>[[transaction.t_state_name]]</td>
                            <td>[[transaction.created_at]]</td>
                            <td>[[transaction.prov_prop_name]]</td>
                            <td>[[transaction.value]]</td>
                        </tr>
                    </table>
                    <br>
                    <h4>Entity Types Properties</h4>
                    <table class="table-bordered" ng-if="prop.PropertiesInfoEntType!=null">
                        <tr>
                            <th>Transaction Type</th>
                            <th>Transaction ID</th>
                            <th>Transaction State</th>
                            <th>Transaction State Date</th>
                            <th>Property Name</th>
                            <th>Value</th>
                        </tr>
                        <tr ng-repeat="transaction in prop.PropertiesInfoEntType">
                            <td>[[transaction.t_name]]</td>
                            <td>[[transaction.transaction_id]]</td>
                            <td>[[transaction.t_state_name]]</td>
                            <td>[[transaction.created_at]]</td>
                            <td>[[transaction.prov_prop_name]]</td>
                            <td>[[transaction.value]]</td>
                        </tr>
                    </table>
                </div>

                {{--<div ng-repeat="transaction in prop.PropertiesInfo">
                    Transaction Type: [[transaction.transaction_type.language[0].pivot.t_name]]
                    <div ng-repeat="transactionState in transaction.transaction_states">
                        Transaction State: [[transactionState.t_state.language[0].pivot.name]]
                        <div ng-repeat="property in transactionState.entities[0].ent_type.properties">
                            Property Name: [[property.language[0].pivot.name]] - Value: [[property.values[0].value]]
                        </div>
                    </div>
                </div>--}}