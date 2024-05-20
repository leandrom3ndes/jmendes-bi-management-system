
app.controller('rolesController', function($scope, $q, $filter, $http, growl, API_URL, $translatePartialLoader, $translate, NgTableParams, $uibModal) {
    $scope.getRole = function(id)
    {
        var deferred = $q.defer();

        $http.get(API_URL + 'get_roles/' + id)
            .then(function (response) {
                deferred.resolve(response.data);
            });

        return deferred.promise;
    };

    $scope.openModalForm = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalRoles',
            controller: 'ModalInstanceCtrl',
            scope: $scope,
            size: size,
            resolve: {
                role_id: function() {
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

    $scope.ModalInstanceCtrl = function ($scope, $uibModalInstance, $timeout, role_id, modal_state) {
        var modalstate = modal_state;
        var id = role_id;
        $scope.role = [];

        //regras de validação client side, angularjs
        $scope.role_name_maxLength = 45;
        //********************************************//

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD_FORM_NAME";
                break;
            case 'edit':
                $scope.form_title = "EDIT_FORM_NAME";
                $scope.getRole(id).then(function (data) {
                    $scope.role = data;
                });
                break;
            default:
                break;
        }

        //save new record / update existing record
        $scope.save = function() {
            var url = API_URL + "roles";

            if (modalstate === 'edit') {
                url += "/" + id;
            }

            $http({
                method: 'POST',
                url: url,
                data: $.param(
                    {
                        'role_id': $scope.role.id,
                        'name': $scope.role.name,
                    }),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                growl.success(response.data.message);
                $scope.cancel();
                $scope.getRoles();
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


    $scope.getRoles = function() {
        $http.get('/get_roles', [{cache : true}]).then(function(response) {
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
    $scope.getRoles();




    $scope.openModalFormAssignActorsToRole = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalAssignActorsToRole',
            controller: 'ModalInstanceCtrlAssignActorsToRole',
            scope: $scope,
            size: size,
            resolve: {
                role_id: function() {
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

    $scope.ModalInstanceCtrlAssignActorsToRole = function ($scope, $uibModalInstance, $timeout, role_id, modal_state) {
        var modalstate = modal_state;
        var id = role_id;
        $scope.role = [];
        $scope.actors = [];
        $scope.selactors = [];

        $scope.getRole(id).then(function (data) {
            $scope.role = data;
        });

        $http.get(API_URL + '/roles/get_actors')
            .then(function(response) {
                $scope.actors = response.data;
            });
        $http.get(API_URL + '/roles/get_onlyactors/' + id)
            .then(function(response) {
                $scope.selactors.selected = response.data;
            });

        //save new record / update existing record
        $scope.save = function() {
            var url = API_URL + "roles/update_actors/" + id;

            $http({
                method: 'POST',
                url: url,
                data: $.param(
                    {
                        'role_id' : $scope.role.id,
                        'selectedActors': $scope.selactors.selected,
                    }
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                growl.success(response.data.message);
                $scope.cancel();
                $scope.openModalFormRemoveActorsFromRole('md', id, '');
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






    $scope.openModalFormRemoveActorsFromRole = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalRemoveActorsFromRole',
            controller: 'ModalInstanceCtrlRemoveActorsFromRole',
            scope: $scope,
            size: size,
            resolve: {
                role_id: function() {
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

    $scope.ModalInstanceCtrlRemoveActorsFromRole = function ($scope, $uibModalInstance, $timeout, role_id, modal_state) {
        var modalstate = modal_state;
        var id = role_id;
        $scope.role = [];
        $scope.selactors = [];

        $scope.getRole(id).then(function (data) {
            $scope.role = data;
        });

        $scope.getSelActors = function(roleid) {
            $http.get(API_URL + '/roles/get_selactors/' + roleid)
                .then(function (response) {
                    $scope.selactors = response.data;
                });
        };
        $scope.getSelActors(id);

        $scope.openModalFormAssign = function(role_id) {
            $scope.cancel();
            $scope.openModalFormAssignActorsToRole('md', role_id, '');
        };

        $scope.removeactor = function(actorid) {
            var url = API_URL + "remove_actor_role/";
            $http({
                method: 'POST',
                url: url,
                data: $.param(
                    {
                        'role_id' : id,
                        'actor_id' : actorid,
                    }
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                growl.success(response.data.message);
                $scope.getSelActors(roleid);
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






    $scope.openModalFormAssignUsersToRole = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalAssignUsersToRole',
            controller: 'ModalInstanceCtrlAssignUsersToRole',
            scope: $scope,
            size: size,
            resolve: {
                role_id: function() {
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

    $scope.ModalInstanceCtrlAssignUsersToRole = function ($scope, $uibModalInstance, $timeout, role_id, modal_state) {
        var modalstate = modal_state;
        var id = role_id;
        $scope.role = [];
        $scope.users = [];
        $scope.selusers = [];

        $scope.getRole(id).then(function (data) {
            $scope.role = data;
        });

        $http.get(API_URL + '/roles/get_users')
            .then(function(response) {
                $scope.users = response.data;
            });
        $http.get(API_URL + '/roles/get_onlyusers/' + id)
            .then(function(response) {
                $scope.selusers.selected = response.data;
            });

        //save new record / update existing record
        $scope.save = function() {
            var url = API_URL + "roles/update_users/" + id;

            $http({
                method: 'POST',
                url: url,
                data: $.param(
                    {
                        'role_id' : $scope.role.id,
                        'selectedUsers' : $scope.selusers.selected,
                    }
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                growl.success(response.data.message);
                $scope.cancel();
                $scope.openModalFormRemoveUsersFromRole('md', id, '');
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




    $scope.openModalFormRemoveUsersFromRole = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalRemoveUsersFromRole',
            controller: 'ModalInstanceCtrlRemoveUsersFromRole',
            scope: $scope,
            size: size,
            resolve: {
                role_id: function() {
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

    $scope.ModalInstanceCtrlRemoveUsersFromRole = function ($scope, $uibModalInstance, $timeout, role_id, modal_state) {
        var modalstate = modal_state;
        var id = role_id;
        $scope.role = [];
        $scope.selusers = [];

        $scope.getRole(id).then(function (data) {
            $scope.role = data;
        });

        $scope.getSelUsers = function(roleid) {
            $http.get(API_URL + '/roles/get_selusers/' + roleid)
                .then(function (response) {
                    $scope.selusers = response.data;
                });
        };
        $scope.getSelUsers(id);

        $scope.openModalFormAssign = function(role_id) {
            $scope.cancel();
            $scope.openModalFormAssignUsersToRole('md', role_id, '');
        };

        $scope.removeuser = function(roleid, userid) {
            var url = API_URL + "remove_user_role/";
            $http({
                method: 'POST',
                url: url,
                data: $.param(
                    {
                        'role_id' : roleid,
                        'user_id' : userid,
                    }
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                growl.success(response.data.message);
                $scope.getSelUsers(roleid);
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


    $scope.delete = function(id) {
        var url = API_URL + "roles/remove/" + id;

        $http({
            method: 'POST',
            url: url,
            data: $.param(
                {
                    'role_id': $scope.role.id,
                    'name': $scope.role.name,
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {
            growl.success(response.data.message);
            $scope.getRoles();
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

    $scope.getDelegationsForRole = function(id)
    {
        var deferred = $q.defer();

        $http.get(API_URL + '/roles/get_delegations_for_role/' + id)
            .then(function (response) {
                deferred.resolve(response.data);
            });

        return deferred.promise;
    };

    $scope.getRolesForDelegations = function() {
        var deferred = $q.defer();

        $http.get(API_URL + 'get_roles')
            .then(function (response) {
                deferred.resolve(response.data);
            });

        return deferred.promise;
    };

    $scope.getTStates = function() {
        var deferred = $q.defer();

        $http.get(API_URL + '/t_states/get_t_state')
            .then(function (response) {
                deferred.resolve(response.data);
            });

        return deferred.promise;
    };

    $scope.openModalFormDelegateRolesToRole = function (size, id, type, del_id) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalDelegateRolesToRole',
            controller: 'ModalInstanceCtrlDelegateRolesToRole',
            scope: $scope,
            size: size,
            resolve: {
                role_id: function() {
                    return id
                },
                modal_state: function() {
                    return type
                },
                delegation_id: function() {
                    return del_id
                }
            }
        }).result.then(function(reason) {
            //Get triggers when modal is closed
            //alert(reason);
        }, function(){
            //gets triggers when modal is dismissed.
        });
    };

    $scope.ModalInstanceCtrlDelegateRolesToRole = function ($scope, $uibModalInstance, $timeout, role_id, modal_state, delegation_id) {
        var modalstate = modal_state;
        var id = role_id;
        $scope.delegation = [];
        $scope.delegation.state = 'active';
        $scope.delegation.delegates_role_id = role_id;

        $scope.getRole(role_id).then(function (data) {
            $scope.delegation.delegate_name = data.name;
        });

        $scope.getRolesForDelegations().then(function (data) {
            var newArray = _.remove(data, function(n) {
                return n.role_id !== role_id;
            });
            $scope.roles = newArray;
            //console.log(newArray);
        });

        $scope.getTStates().then(function (data) {
           $scope.tstates = data;
        });

        $scope.validationDate = function(startDate,endDate, startTime, endTime) {
            $scope.errMessageTime = '';
            $scope.errMessageDate = '';
            var curDate = new Date();

            if(new Date(startDate) > new Date(endDate)){
                $scope.errMessageDate = 'End Date should be greater than Start Date';
                return false;
            }

            if (endTime === undefined)
                return;

            var resultDates = new Date(startDate) - new Date(endDate);
            if(resultDates === 0){
                //console.log(startTime.getTime() + ' ' + endTime.getTime());
                if (startTime.getTime() > endTime.getTime())
                {
                    $scope.errMessageTime = 'End Time should be greater than Start Time';
                    return false;
                }
            }
            /*if(new Date(startDate) < curDate){
                $scope.errMessageDate = 'Start date should not be before today.';
                return false;
            }*/
        };

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD_FORM_NAME";
                break;
            case 'edit':
                $scope.form_title = "EDIT_FORM_NAME";
                $http.get(API_URL + 'roles/get_spec_delegation/'+delegation_id)
                    .then(function (response) {
                        $scope.delegation = response.data;
                        $scope.delegation.start_time_date = new Date($filter('date')(response.data.start_time, "yyyy-MM-dd"));

                        var start_time_time = new Date(response.data.start_time);
                        $scope.delegation.start_time_time = start_time_time;

                        if (response.data.end_time !== null)
                        {
                            $scope.delegation.end_time_date = new Date($filter('date')(response.data.end_time, "yyyy-MM-dd"));
                            var end_time_time = new Date(response.data.end_time);
                            $scope.delegation.end_time_time = end_time_time;
                        }
                    });
                break;
            default:
                break;
        }

        function prettyDate2(time) {
            var date = new Date(parseInt(time));
            return date.toLocaleTimeString(navigator.language, {
                hour: '2-digit',
                minute:'2-digit'
            });
        }

        //save new record / update existing record
        $scope.save = function() {
            var url = API_URL + "delegation";

            if (modalstate === 'edit') {
                url += "/edit/" + delegation_id; //id = delegates_role_id
            }

            //validations to format the start time and end time
            var start_time = $filter('date')($scope.delegation.start_time_date, "yyyy-MM-dd");

            var start_time_time = $filter('date')($scope.delegation.start_time_time, "HH:mm:ss");
            if (start_time_time !== undefined)
            {
                start_time += ' ' + start_time_time;
            }

            var end_time = $filter('date')($scope.delegation.end_time_date, "yyyy-MM-dd");
            var end_time_time = $filter('date')($scope.delegation.end_time_time, "HH:mm:ss");
            if (end_time_time !== undefined)
            {
                end_time += ' ' + end_time_time;
            }

            if (end_time === undefined)
            {
                end_time = '';
            }

            $http({
                method: 'POST',
                url: url,
                data: $.param({
                        'delegates_role_id' : role_id,
                        'delegated_role_id' : $scope.delegation.delegated_role_id,
                        't_state_id' : $scope.delegation.t_state_id,
                        'start_time' : start_time,
                        'end_time' : end_time,
                        'state' : $scope.delegation.state
                }
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                growl.success(response.data.message);
                $scope.cancel();
                //show list of delegations after inserted data
                $scope.openModalFormRemoveDelegationsFromRole('md', role_id, '');
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

    $scope.openModalFormRemoveDelegationsFromRole = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalRemoveDelegationsFromRole',
            controller: 'ModalInstanceCtrlRemoveDelegationsFromRole',
            scope: $scope,
            size: size,
            resolve: {
                role_id: function() {
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

    $scope.ModalInstanceCtrlRemoveDelegationsFromRole = function ($scope, $uibModalInstance, $timeout, role_id, modal_state) {
        var modalstate = modal_state;
        var id = role_id;
        $scope.delegation = [];
        $scope.seldelegations = [];
        $scope.delegation.delegates_role_id = role_id;

        $scope.getRole(role_id).then(function (data) {
            $scope.delegation.delegate_name = data.name;
        });

        $scope.getDelegationsForRole(role_id).then(function (data) {
            $scope.seldelegations = data;
        });

        $scope.openModalFormAssign = function(del_role_id) {
            $scope.cancel();
            $scope.openModalFormDelegateRolesToRole('md', role_id, 'edit', del_role_id);
        };

        $scope.removedelegation = function(delegation_id) {
            var url = API_URL + "removedelegation/";
            $http({
                method: 'POST',
                url: url,
                data: $.param(
                    {
                        'delegation_id' : delegation_id
                    }
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                growl.success(response.data.message);
                $scope.getDelegationsForRole(role_id).then(function (data) {
                    $scope.seldelegations = data;
                });
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