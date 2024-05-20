app.controller('actorsController', function($scope, $http, growl, API_URL, $translatePartialLoader, $translate, NgTableParams, MyService, $uibModal) {

    //analisar se está função é necessária
    /*$scope.actors = function() {
        $http.get(API_URL + "/get_actors")
            .then(function (response) {
                $scope.actors = response.data;
            });
    };

    $scope.actors = [];*/
    ///////////////////////////////////////////////


    $scope.getActors = function() {
        $http.get('/get_actors', [{cache : true}]).then(function(response) {
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
    $scope.getActors();


    //repensar delete
    $scope.delete = function(id) {
        var url = API_URL + "actors/remove/" + id;

        $http({
            method: 'POST',
            url: url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            //headers: {'Content-Type': 'json'}
        }).then(function (response) {
            growl.success('This is success message.',{title: 'Success!'});
            $scope.getActors();
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


    $scope.openModalForm = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalActors',
            controller: 'ModalInstanceCtrl',
            scope: $scope,
            size: size,
            resolve: {
                actor_id: function() {
                    return id
                },
                modal_state: function() {
                    return type
                }
            }
        }).result.then(function(reason) {
            //Get triggers when modal is closed
        }, function(){
            //gets triggers when modal is dismissed.
        });
    };

    $scope.ModalInstanceCtrl = function ($scope, $uibModalInstance, $timeout, actor_id, modal_state) {
        var modalstate = modal_state;
        var id = actor_id;
        $scope.actor = [];

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD_FORM_NAME";
                break;
            case 'edit':
                $scope.form_title = "EDIT_FORM_NAME";
                $http.get(API_URL + 'get_actors/' + id)
                    .then(function(response) {
                        $scope.actor = response.data;
                    });
                break;
            default:
                break;
        }

        //save new record / update existing record
        $scope.save = function() {
            var url = API_URL + "actors";

            if (modalstate === 'edit') {
                url += "/" + id;
            }

            $http({
                method: 'POST',
                url: url,
                data: $.param(
                    {
                        'actor_id' : $scope.actor.id,
                        'name': $scope.actor.name,
                    }
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                growl.success(response.data.message);
                $scope.cancel();
                $scope.getActors();
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


    $scope.openModalFormAssignRolesToActor = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalAssignRolesToActor',
            controller: 'ModalInstanceCtrlAssignRolesToActor',
            scope: $scope,
            size: size,
            resolve: {
                actor_id: function() {
                    return id
                },
                modal_state: function() {
                    return type
                }
            }
        }).result.then(function(reason) {
            //Get triggers when modal is closed
        }, function(){
            //gets triggers when modal is dismissed.
        });
    };

    $scope.ModalInstanceCtrlAssignRolesToActor = function ($scope, $uibModalInstance, $timeout, actor_id, modal_state) {
        var modalstate = modal_state;
        var id = actor_id;
        $scope.actor = [];
        $scope.roles = [];
        $scope.selroles = [];

        $http.get(API_URL + 'get_actors/' + id)
            .then(function(response) {
                $scope.actor = response.data;
            });

        $http.get(API_URL + '/actors/get_roles')
            .then(function(response) {
                $scope.roles = response.data;
            });

        $http.get(API_URL + '/actors/get_onlyroles/' + id)
            .then(function(response) {
                $scope.selroles.selected = response.data;
                // debugger;
            });

        //save new record / update existing record
        $scope.save = function() {
            var url = API_URL + "actors/update_roles/" + id;

            $http({
                method: 'POST',
                url: url,
                data: $.param(
                    {
                        'actor_id' : $scope.actor.id,
                        'selectedRoles' : $scope.selroles.selected,

                    }
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                growl.success(response.data.message);
                $scope.cancel();
                $scope.openModalFormRemoveRolesFromActor('md', id, '');
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

    $scope.openModalFormRemoveRolesFromActor = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalRemoveRolesFromActor',
            controller: 'ModalInstanceCtrlRemoveRolesFromActor',
            scope: $scope,
            size: size,
            resolve: {
                actor_id: function() {
                    return id
                },
                modal_state: function() {
                    return type
                }
            }
        }).result.then(function(reason) {
            //Get triggers when modal is closed
        }, function(){
            //gets triggers when modal is dismissed.
        });
    };

    $scope.ModalInstanceCtrlRemoveRolesFromActor = function ($scope, $uibModalInstance, $timeout, actor_id, modal_state) {
        var modalstate = modal_state;
        var id = actor_id;
        $scope.actor = [];
        $scope.selroles = [];

        $http.get(API_URL + 'get_actors/' + id)
            .then(function(response) {
                $scope.actor = response.data;
            });

        $scope.getSelRoles = function(actorid) {
            $http.get(API_URL + '/actors/get_selroles/' + id)
                .then(function (response) {
                    $scope.selroles = response.data;
                });
        };
        $scope.getSelRoles();

        $scope.openModalFormAssign = function(actor_id) {
            $scope.cancel();
            $scope.openModalFormAssignRolesToActor('md', actor_id, '');
        };


        $scope.removerole = function(actorid, roleid) {
            var url = API_URL + "remove_actor_role/";
            $http({
                method: 'POST',
                url: url,
                data: $.param(
                    {
                        'actor_id' : actorid,
                        'role_id' : roleid,
                    }
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                console.log('resposta remove role', response);
                growl.success(response.data.message);
                $scope.getSelRoles();
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


        //save new record / update existing record
        $scope.save = function() {
            var url = API_URL + "actors";

            //append employee id to the URL if the form is in edit mode
            if (modalstate === 'edit') {
                url += "/" + id;
            }

            $http({
                method: 'POST',
                url: url,
                data: $.param(
                    {
                        'actor_id' : $scope.actor.id,
                        'name': $scope.actor.name,
                    }
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                growl.success(response.data.message);
                $scope.cancel();
                $scope.getActors();
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
});

