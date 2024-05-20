/**
 * Created by ASUS on 26/05/2017.
 */
app.controller('tStatesController', function($scope, $http, growl, API_URL, $translatePartialLoader, $translate, NgTableParams, $uibModal) {
    $scope.openModalForm = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalTStates',
            controller: 'ModalInstanceCtrl',
            scope: $scope,
            size: size,
            //appendTo: parentElem,
            resolve: {
                t_state_id: function() {
                    return id
                },
                modal_state: function() {
                    return type
                }
            }
        }).result.then(function(reason) {
            //Get triggers when modal is closed
            //alert(reason);
        }, function(){
            //gets triggers when modal is dismissed.
        });
    };

    $scope.ModalInstanceCtrl = function ($scope, $uibModalInstance, $timeout, t_state_id, modal_state) {
        var modalstate = modal_state;
        var id = t_state_id;
        $scope.tstate = [];

        //regras de validação client side, angularjs
        $scope.t_state_name_maxLength = 45;
        //********************************************//

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD_FORM_NAME";
                break;
            case 'edit':
                $scope.form_title = "EDIT_FORM_NAME";
                $http.get(API_URL + 't_states/get_t_state/' + id)
                    .then(function(response) {
                        $scope.tstate = response.data;
                    });
                break;
            default:
                break;
        }

        //save new record / update existing record
        $scope.save = function() {
            var url = API_URL + "T_State";

            //se o tipo de modal for para editar, ajustar a rota para o lugar certo
            if (modalstate === 'edit') {
                url += "/" + id;
            }

            if (modalstate === 'add_name_lang') {
                url += "/add_name_lang/" + id;
            }

            $http({
                method: 'POST',
                url: url,
                data: $.param({ 'name': $scope.tstate.language[0].pivot.name
                    }
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                growl.success(response.data.message);
                $scope.cancel();
                $scope.getTStates();
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
                //console.log(response);
            });
        };

        $scope.cancel = function () {
            $uibModalInstance.close('cancel');
        };
    };


    $scope.getTStates = function() {
        $http.get('/t_states/get_t_state', [{cache : true}]).then(function(response) {
            $scope.tableParams = new NgTableParams({
                count: 100,
                sorting: { id: "asc" }
            }, {
                paginationMaxBlocks: 13,
                paginationMinBlocks: 2,
                dataset: response.data
            });
        });
    };
    $scope.getTStates();


    $scope.langs = function() {
        $http.get(API_URL + "/proc_types/get_langs")
            .then(function (response) {
                $scope.langs = response.data;
            });
    };

    $scope.langs();


    $scope.delete = function(id) {
        var url = API_URL + "T_State_del/" + id;

        $http({
            method: 'POST',
            url: url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {
            growl.success(response.data.message);
            $scope.getTStates();
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
});