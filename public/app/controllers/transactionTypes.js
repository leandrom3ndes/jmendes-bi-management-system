/**
 * Created by ASUS on 26/05/2017.
 */
app.controller('transactionTypesController', function($scope, $http, growl, API_URL, $translatePartialLoader, $translate, NgTableParams, MyService, $uibModal) {
    $scope.openModalForm = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalTransactionTypes',
            controller: 'ModalInstanceCtrl',
            scope: $scope,
            size: size,
            resolve: {
                transaction_type_id: function() {
                    return id
                },
                modal_state: function() {
                    return type
                }
            }
        }).result.then(function(reason) {
            //Get triggers when modal is closed
            //alert(reason);
            $scope.transactiontype = [];
        }, function(){
            //gets triggers when modal is dismissed.
        });
    };

    $scope.ModalInstanceCtrl = function ($scope, $uibModalInstance, $timeout, transaction_type_id, modal_state) {
        var modalstate = modal_state;
        $scope.modalstate = modal_state;

        var id = transaction_type_id;
        $scope.transactiontype = [];
        $scope.transactiontype.state = 'active';

        //regras de validação client side, angularjs
        $scope.transactiontype_t_name_maxLength = 200;
        $scope.transactiontype_rt_name_maxLength = 500;
        //********************************************//

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD_FORM_NAME";
                break;
            case 'edit':
                $scope.form_title = "EDIT_FORM_NAME";
                $http.get(API_URL + 'transacs_types/get_transacs_types/' + id)
                    .then(function(response) {
                        $scope.transactiontype = response.data;
                    });
                break;
            default:
                break;
        }

        $scope.save = function() {
            var url = API_URL + "Transaction_Type";

            if (modalstate === 'edit') {
                url += "/" + id;
            }

            if (modalstate === 'add_name_lang') {
                url += "/add_name_lang/" + id;

                dataParams = { 't_name': $scope.transactiontype.language[0].pivot.t_name,
                    'rt_name': $scope.transactiontype.language[0].pivot.rt_name
                };
            }
            else
            {
                dataParams = { 't_name': $scope.transactiontype.language[0].pivot.t_name,
                    'rt_name': $scope.transactiontype.language[0].pivot.rt_name,
                    'process_type_id': $scope.transactiontype.process_type_id,
                    'state': $scope.transactiontype.state,
                    'init_proc': $scope.transactiontype.init_proc,
                    'executer' : $scope.transactiontype.executer_actor.language[0].pivot.actor_id,
                    'auto_activate' : $scope.transactiontype.auto_activate,
                    'freq_activate' : $scope.transactiontype.freq_activate,
                    'when_activate' : $scope.transactiontype.when_activate
                };
            }

            $http({
                method: 'POST',
                url: url,
                data: $.param(dataParams
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                growl.success(response.data.message);
                $scope.cancel();
                $scope.getTransacsTypes();
            }, function errorCallback(response) {
                if (response.status === 400)
                {
                    growl.error(response.data.message);
                }
                else if (response.status === 422)
                {
                    angular.forEach(response.data, function(value, key) {
                        let outputErrors = "";
                        angular.forEach(value, function(sub_value, sub_key) {
                            outputErrors += sub_value + ' <br> ';
                        });
                        growl.error(outputErrors);
                    });
                }
                else
                {
                    //$scope.errors = response.data;
                }
            });
        };

        $scope.cancel = function () {
            $uibModalInstance.close('cancel');
        };
    };

    $scope.langs = function() {
        $http.get(API_URL + "/proc_types/get_langs", [{cache : true}])
            .then(function (response) {
                $scope.langs = response.data;
            });
    };

    $scope.procstypes = function() {
        $http.get(API_URL + "/proc_types/get_procs_types", [{cache : true}])
            .then(function (response) {
                $scope.processtypes = response.data;
            });
    };

    $scope.executers = function() {
        $http.get(API_URL + "/exec/get_executers", [{cache : true}])
            .then(function (response) {
                $scope.executers = response.data;
            });
    };

    $scope.getTransacsTypes = function() {
        $http.get('/transacs_types/get_transacs_types', [{cache : true}]).then(function(response) {
            $scope.tableParams = new NgTableParams({
                count: 100,
                group: "name",
                sorting: { id: "desc" }
            }, {
                paginationMaxBlocks: 13,
                paginationMinBlocks: 2,
                dataset: response.data
            });
        });
    };
    $scope.getTransacsTypes();

    $scope.procstypes();
    $scope.langs();
    $scope.executers();

    $scope.delete = function(id) {
        var url = API_URL + "Transaction_Type_del/" + id;

        $http({
            method: 'POST',
            url: url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {
            growl.success(response.data.message);
            $scope.getTransacsTypes();
        }, function errorCallback(response) {
            if (response.status === 400)
            {
                growl.error(response.data.message);
            }
            else if (response.status === 422)
            {
                angular.forEach(response.data, function(value, key) {
                    let outputErrors = "";
                    angular.forEach(value, function(sub_value, sub_key) {
                        outputErrors += sub_value + ' <br> ';
                    });
                    growl.error(outputErrors);
                });
            }
            else
            {
                //$scope.errors = response.data;
            }
        });
    };

    //Guilherme Actor Initiates
    //Open Modal - Actor Iniciates
    $scope.openModalFormActorsIniciates = function (size, id) {
        /*var parentElem = parentSelector ?
         angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;*/

        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalActorIniciatesT',
            controller: 'ModalInstanceCtrlActorIniciatesT',
            scope: $scope,
            size: size,
            //appendTo: parentElem,
            resolve: {
                transaction_type_id: function() {
                    return id
                },
            }
        }).result.then(function(reason) {


        }, function(){
            //gets triggers when modal is dismissed.
        });
    };

    $scope.ModalInstanceCtrlActorIniciatesT = function ($scope, $uibModalInstance, $timeout, transaction_type_id) {
        var id = transaction_type_id;

        $scope.actors = [];
        $scope.selactors = [];
        $scope.selactors.sel = [];

        $scope.form_title = "ACTOR_FORM_NAME";

        $http.get(API_URL + 'Transaction_Type/get_actor_iniciates_t/' + id)
            .then(function(response) {
                $scope.actors = response.data.actors;
                $scope.selactors.sel = response.data.sel_actors;
                $scope.transactiontype = response.data.transaction_type;
            });

        //save new record / update existing record
        $scope.saveActor = function() {
            var url = API_URL + "Transaction_Type/update_actors/"+ id;

            $http({
                method: 'POST',
                url: url,
                data: $.param({
                    'selectedActors' :  $scope.selactors.sel,
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                growl.success('This is success message.',{title: 'Success!'});
                $scope.getTransacsTypes();
                $scope.cancel();
            },  function errorCallback(response) {
                if (response.status == 400)
                {
                    growl.error('This is error message.',{title: 'error!'});
                }
                else
                {
                    $scope.errors = response.data;
                }
            });
        };

        $scope.cancel = function () {
            $uibModalInstance.close('cancel');
        };
    };

    //Modal View Actors Iniciator
    //Open Modal - Actor Iniciates
    $scope.openModalFormViewActorIniciatesT = function (size, id) {
        /*var parentElem = parentSelector ?
         angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;*/

        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalViewActorIniciatesT',
            controller: 'ModalInstanceCtrlViewActorIniciatesT',
            scope: $scope,
            size: size,
            //appendTo: parentElem,
            resolve: {
                transaction_type_id: function() {
                    return id
                },
            }
        }).result.then(function(reason) {


        }, function(){
            //gets triggers when modal is dismissed.
        });
    };

    $scope.ModalInstanceCtrlViewActorIniciatesT = function ($scope, $uibModalInstance, $timeout, transaction_type_id) {
        var id = transaction_type_id;

        $scope.actors = [];
        $scope.selactors = [];
        $scope.selactors.sel = [];

        $scope.form_title = "ACTOR_FORM_NAME";

        //Buscar informação do tipo de transação escolhido
        $http.get(API_URL + '/transacs_types/get_transacs_types/' + id, [{cache : true}])
            .then(function (response) {
                $scope.transactionType = response.data;
            });

        //Remover Actores
        //Remover Tipos de Entidade associado ao Custom form com ID = customformid
        $scope.removeActor = function(transactiontypeid, actorid) {
            var url = API_URL + "remove_actor_iniciates_t";
            $http({
                method: 'POST',
                url: url,
                data: $.param(
                    {
                        'transaction_type_id' : transactiontypeid,
                        'actor_id' : actorid,
                    }
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                //headers: {'Content-Type': 'json'}
            }).then(function (response) {
                growl.success('Your Request Was Successfully Completed.',{title: 'Success!'});
                $scope.getTransacsTypes();
                $scope.cancel();
            }, function errorCallback(response) {
                if (response.status == 400)
                {
                    growl.error('This is error message.',{title: 'error!'});
                }
                else
                {
                    $scope.errors = response.data;
                }
            });
        };

        $scope.cancel = function () {
            $uibModalInstance.close('cancel');
        };
    };
});