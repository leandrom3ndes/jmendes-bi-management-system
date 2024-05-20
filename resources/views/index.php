<!DOCTYPE html>
<html lang="en-US" ng-app="process_types">
<head>
    <title>Gestão de Tipos de Processos</title>

    <!-- Load Bootstrap CSS -->
    <link href="<?= asset('../css/bootstrap.min.css') ?>" rel="stylesheet">

</head>
<body>
<h2>Tipos de Processos</h2>
<div  ng-controller="processTypesController">

    <!-- Table-to-load-the-data Part -->
    <table class="table" ng-init="getProc()">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>State</th>
            <th>Updated_On</th>
            <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">Adicionar Novo Tipo de Processo</button></th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="processtype in processtypes">
            <td>{{  processtype.id }}</td>
            <td>{{ processtype.name }}</td>
            <td>{{ processtype.state }}</td>
            <td>{{ processtype.updated_on }}</td>
            <td>
                <button class="btn btn-default btn-xs btn-detail" ng-click="toggle('edit', processtype.id)">Editar</button>
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
                    <h4 class="modal-title" id="myModalLabel">{{form_title}}</h4>
                </div>
                <div class="modal-body">
                    <form name="frmProcessTypes" class="form-horizontal" novalidate="">

                        <div class="form-group">
                            <label for="inputName" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="process_type_name" name="process_type_name" placeholder="" value="{{name}}"
                                       ng-model="processtype.name" ng-required="true">
                                <span class="help-inline"
                                      ng-show="frmProcessTypes.contact_number.$invalid && frmProcessTypes.process_type_name.$touched">Name field is required</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Gender" class="col-sm-3 control-label">State:</label>
                            <div class="col-sm-9">
                                <label for="" class="radio-inline state">
                                    <input type="radio" name="process_type_state" value="active" ng-model="processtype.state" required>Active
                                </label>
                                <label for="" class="radio-inline state">
                                    <input type="radio" name="process_type_state" value="inactive" ng-model="processtype.state" required>Inactive
                                </label>
                                <span class="help-inline"
                                      ng-show="frmProcessTypes.position.$invalid && frmProcessTypes.position.$touched">State field is required</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(modalstate, id)" ng-disabled="frmProcessTypes.$invalid">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-animate.js"></script>

<script src="<?= asset('../js/jquery.js') ?>"></script>
<script src="<?= asset('../js/bootstrap.min.js') ?>"></script>

<!-- AngularJS Application Scripts -->
<script src="<?= asset('app/app.js') ?>"></script>
<script src="<?= asset('app/controllers/processtypes.js') ?>"></script>
</body>
</html>