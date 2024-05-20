app.controller('usersController', function($scope, $http, growl, API_URL, $translatePartialLoader, $translate, NgTableParams, $uibModal) {
    $scope.openModalForm = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalUsers',
            controller: 'ModalInstanceCtrl',
            scope: $scope,
            size: size,
            resolve: {
                user_id: function() {
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

    $scope.ModalInstanceCtrl = function ($scope, $uibModalInstance, $timeout, user_id, modal_state) {
        $scope.modalstate_view = modal_state;
        var modalstate = modal_state;
        var id = user_id;
        $scope.user = [];
        $scope.langs = [];
        $scope.entities = [];

        //regras de validação client side, angularjs
        $scope.user_name_maxLength = 255;
        $scope.user_user_name_maxLength = 45;
        $scope.user_email_maxLength = 255;
        $scope.user_password_maxLength = 255;
        //********************************************//

        $http.get(API_URL + "/users/get_langs")
            .then(function (response) {
                $scope.langs = response.data;
            });
        $http.get(API_URL + "/users/get_entities")
            .then(function (response) {
                $scope.entities = response.data;
            });

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD_FORM_NAME";
                break;
            case 'edit':
                $scope.form_title = "EDIT_FORM_NAME";
                $http.get(API_URL + 'get_users/' + id)
                    .then(function(response) {
                        $scope.user = response.data;
                    });
                break;
            default:
                break;
        }

        //save new record / update existing record
        $scope.save = function() {
            var url = API_URL + "users";

            if (modalstate === 'edit') {
                url += "/" + id;
            }

            if ($scope.user.user_type == "internal"){
                $scope.user.entities_id = null;
            }

            $http({
                method: 'POST',
                url: url,
                data:  $.param(
                    {
                        'user_id' : $scope.user.id,
                        'name': $scope.user.name,
                        'email': $scope.user.email,
                        'password': $scope.user.password,
                        'user_name': $scope.user.user_name,
                        'user_type': $scope.user.user_type,
                        'entity_id': $scope.user.entity_id,
                        'language_id': $scope.user.language_id,

                    }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                growl.success(response.data.message);
                $scope.cancel();
                $scope.getUsers();
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


    $scope.getUsers = function() {
        $http.get('/get_users', [{cache : true}]).then(function(response) {
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
    $scope.getUsers();



    $scope.openModalFormAssignRolesToUser = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalAssignRolesToUser',
            controller: 'ModalInstanceCtrlAssignRolesToUser',
            scope: $scope,
            size: size,
            resolve: {
                user_id: function() {
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

    $scope.ModalInstanceCtrlAssignRolesToUser = function ($scope, $uibModalInstance, $timeout, user_id, modal_state) {
        var modalstate = modal_state;
        var id = user_id;
        $scope.user = [];
        $scope.roles = [];
        $scope.selroles = [];

        $http.get(API_URL + 'get_users/' + id)
            .then(function(response) {
                $scope.user = response.data;
            });
        $http.get(API_URL + '/users/get_roles')
            .then(function(response) {
                $scope.roles = response.data;
            });
        $http.get(API_URL + '/users/get_onlyroles/' + id)
            .then(function(response) {
                $scope.selroles.selected = response.data;
            });

        //save new record / update existing record
        $scope.save = function() {
            var url = API_URL + "users/update_roles/" + id;

            $http({
                method: 'POST',
                url: url,
                data:  $.param(
                    {
                        'user_id' : $scope.user.id,
                        'selectedRoles' : $scope.selroles.selected,
                    }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                growl.success(response.data.message);
                $scope.cancel();
                //$scope.toggle('view_roles', id); falta mudar para ver lista de roles
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







    $scope.openModalFormRemoveRolesFromUser = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalRemoveRolesFromUser',
            controller: 'ModalInstanceCtrlRemoveRolesFromUser',
            scope: $scope,
            size: size,
            resolve: {
                user_id: function() {
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

    $scope.ModalInstanceCtrlRemoveRolesFromUser = function ($scope, $uibModalInstance, $timeout, user_id, modal_state) {
        var modalstate = modal_state;
        var id = user_id;
        $scope.user = [];
        $scope.selroles = [];

        $http.get(API_URL + 'get_users/' + id)
            .then(function(response) {
                $scope.user = response.data;
            });

        $scope.getSelRoles = function(user_id) {
            $http.get(API_URL + '/users/get_selroles/' + user_id)
                .then(function (response) {
                    $scope.selroles = response.data;
                });
        };
        $scope.getSelRoles(id);

        $scope.openModalFormAssign = function(user_id) {
            $scope.cancel();
            $scope.openModalFormAssignRolesToUser('md', user_id, '');
        };

        $scope.removerole = function(roleid) {
            var url = API_URL + "remove_user_role/";
            $http({
                method: 'POST',
                url: url,
                data: $.param(
                    {
                        'user_id' : id,
                        'role_id' : roleid,
                    }
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                growl.success(response.data.message);
                $scope.getSelRoles(id);
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

app.directive("passwordVerify", function() {
    return {
        require: "ngModel",
        scope: {
            passwordVerify: '='
        },
        link: function(scope, element, attrs, ctrl) {
            scope.$watch(function() {
                var combined;

                if (scope.passwordVerify || ctrl.$viewValue) {
                    combined = scope.passwordVerify + '_' + ctrl.$viewValue;
                }
                return combined;
            }, function(value) {
                if (value) {
                    ctrl.$parsers.unshift(function(viewValue) {
                        var origin = scope.passwordVerify;
                        if (origin !== viewValue) {
                            ctrl.$setValidity("passwordVerify", false);
                            return undefined;
                        } else {
                            ctrl.$setValidity("passwordVerify", true);
                            return viewValue;
                        }
                    });
                }
            });
        }
    };
});