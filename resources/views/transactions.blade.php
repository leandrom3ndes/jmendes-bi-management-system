@extends('layouts.default')
@section('content')
    <h2>Transacções</h2>
    <div ng-controller="transactionsController">
        <div growl></div>

        <!-- Table-to-load-the-data Part -->
        <table class="table" ng-init="getTransacs()">
            <thead>
            <tr>
                <th>ID</th>
                <th>Transaction Type</th>
                <th>Process</th>
                <th>State</th>
                <th>Created_at</th>
                <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">Adicionar Nova Transacção</button></th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="transaction in transactions">
                <td>[[ transaction.id ]]</td>
                <td>[[ transaction.transaction_type.language[0].pivot.t_name ]]</td> <!--processtype.pivot.name quando é feito da linguagem para o processtype-->
                <td>[[ transaction.process.language[0].pivot.name ]]</td>
                <td>[[ transaction.state ]]</td>
                <td>[[ transaction.created_at ]]</td>
                <td>
                    <button class="btn btn-default btn-xs btn-detail" ng-click="toggle('edit', transaction.id)">Editar</button>
                    <button class="btn btn-danger btn-xs btn-delete">Histórico</button>
                </td>
            </tr>
            </tbody>
        </table>
        <div>
            <posts-pagination></posts-pagination>
        </div>
        <!-- End of Table-to-load-the-data Part -->
        <!-- Modal (Pop up when detail button clicked) -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">[[form_title]]</h4>
                    </div>
                    <div class="modal-body">
                        <form name="frmTransactions" class="form-horizontal" novalidate="">
                            <div class="form-group">
                                <label for="Gender" class="col-sm-3 control-label">Transaction Type:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" ng-model="transaction.transaction_type_id" ng-options="item.id as item.language[0].pivot.t_name for item in transactiontypes">
                                        <option value="">Selecionar Tipo de Transacção</option>
                                    </select>
                                    <span class="help-inline"
                                          ng-show="frmTransactions.language_id.$invalid && frmTransactions.language_id.$touched">State field is required</span>
                                </div>
                                <br>
                                <ul ng-repeat="error in errors">
                                    <li>[[ error[0] ]]</li>
                                </ul>

                            </div>

                            <div class="form-group">
                                <label for="Gender" class="col-sm-3 control-label">Processes:</label>
                                <div class="col-sm-9">
                                    <select class="form-control" ng-model="transaction.process_id" ng-options="item.id as item.language[0].pivot.name for item in processes">
                                        <option value="">Selecionar Tipo de Processo</option>
                                    </select>
                                    <span class="help-inline"
                                          ng-show="frmTransactions.language_id.$invalid && frmTransactions.language_id.$touched">State field is required</span>
                                </div>
                                <br>
                                <ul ng-repeat="error in errors">
                                    <li>[[ error[0] ]]</li>
                                </ul>

                            </div>

                            <div class="form-group">
                                <label for="Gender" class="col-sm-3 control-label">State:</label>
                                <div class="col-sm-9">
                                    <label for="" class="radio-inline state">
                                        <input type="radio" name="transaction_state" value="active" ng-model="transaction.state" required>Active
                                    </label>
                                    <label for="" class="radio-inline state">
                                        <input type="radio" name="transaction_state" value="inactive" ng-model="transaction.state" required>Inactive
                                    </label>
                                    <span class="help-inline"
                                          ng-show="frmTransactions.transaction_state.$invalid && frmTransactions.transaction_state.$touched">State field is required</span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer"><!-- ng-disabled="frmProcessTypes.$invalid" -->
                        <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(modalstate, id)" >Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('footerContent')
    <script src="<?= asset('app/controllers/transactions.js') ?>"></script>
@stop