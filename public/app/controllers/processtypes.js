/**
 * Created by ASUS on 26/05/2017.
 */
app.controller('processTypesController', function($scope, $http, growl, API_URL, $translatePartialLoader, $translate, NgTableParams, $uibModal) {
    $scope.openModalForm = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalProcessTypes',
            controller: 'ModalInstanceCtrl',
            scope: $scope,
            size: size,
            resolve: {
                process_type_id: function() {
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

    $scope.ModalInstanceCtrl = function ($scope, $uibModalInstance, $timeout, process_type_id, modal_state) {
        var modalstate = modal_state;
        $scope.modalstate = modal_state;

        var id = process_type_id;
        $scope.processtype = [];
        $scope.processtype.state = 'active';

        //regras de validação client side, angularjs
        $scope.process_type_name_maxLength = 128;
        //********************************************//

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD_FORM_NAME";
                break;
            case 'edit':
                $scope.form_title = "EDIT_FORM_NAME";
                $http.get(API_URL + 'proc_types/get_proc/' + id)
                    .then(function(response) {
                        $scope.processtype = response.data;
                    });
                break;
            default:
                break;
        }

        //save new record / update existing record
        $scope.save = function() {
            var url = API_URL + "Process_Type";

            if (modalstate === 'edit') {
                url += "/" + id;
            }

            if (modalstate === 'add_name_lang') {
                url += "/add_name_lang/" + id;

                var dataParams = { 'name': $scope.processtype.language[0].pivot.name };
            }
            else
            {
                var dataParams = { 'name': $scope.processtype.language[0].pivot.name,
                    'state': $scope.processtype.state
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
                $scope.getProcsTypes();
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


    $scope.getProcsTypes = function() {
        $http.get('/proc_types/get_proc', [{cache : true}]).then(function(response) {
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
    $scope.getProcsTypes();

    $scope.delete = function(id) {
        var url = API_URL + "Process_Type_del/" + id;

        $http({
            method: 'POST',
            url: url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {
            growl.success(response.data.message);
            $scope.getProcsTypes();
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
