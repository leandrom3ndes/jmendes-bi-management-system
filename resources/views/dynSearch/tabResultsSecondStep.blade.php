
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Dynamic Search Results</h3>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th ng-repeat="entityColumn in data[0].values">
                                                    [[entityColumn.property.language[0].pivot.name]]
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr ng-repeat="entityRow in data">
                                                <td ng-repeat="valueRow in entityRow.values">[[valueRow.value]]</td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                 </div>

