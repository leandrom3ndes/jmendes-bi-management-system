
                <div class="table-responsive">
                    <h4>Properties</h4>
                    <table class="table-bordered">
                        <tr>
                            <th>Transaction Type</th>
                            <th>Transaction ID</th>
                            <th>Transaction State</th>
                            <th>Transaction State Date</th>
                            <th>Property Name</th>
                            <th>Value</th>
                        </tr>
                        <tr ng-repeat="transaction in prop.properties_reading">
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
