/**
 * Created by ASUS on 26/05/2017.
 */
app.controller('entityTypesController', function($scope, $http, growl, API_URL, NgTableParams, MyService, $uibModal) {
    $scope.openModalForm = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalEntTypes',
            controller: 'ModalInstanceCtrl',
            scope: $scope,
            size: size,
            //appendTo: parentElem,
            resolve: {
                ent_type_id: function() {
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

    $scope.ModalInstanceCtrl = function ($scope, $uibModalInstance, $timeout, ent_type_id, modal_state) {
        var modalstate = modal_state;
        $scope.modalstate = modal_state;
        var id = ent_type_id;
        $scope.entitytype = [];
        $scope.entitytype.state = 'active';

        //regras de validação client side, angularjs
        $scope.enttype_name_maxLength = 200;
        //********************************************//

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD_FORM_NAME";
                break;
            case 'edit':
                $scope.form_title = "EDIT_FORM_NAME";
                $http.get(API_URL + 'ents_types/get_ents_types/' + id)
                    .then(function(response) {
                        $scope.entitytype = response.data;
                    });
                break;
            default:
                break;
        }

        //save new record / update existing record
        $scope.save = function() {
            var url = API_URL + "Entity_Type";

            if (modalstate === 'edit') {
                url += "/" + id;
            }

            if (modalstate === 'add_name_lang') {
                url += "/add_name_lang/" + id;

                dataParams = { 'name': $scope.entitytype.language[0].pivot.name
                };
            }
            else
            {
                dataParams = { 'name': $scope.entitytype.language[0].pivot.name,
                    'state': $scope.entitytype.state,
                    'transaction_type_id': $scope.entitytype.transaction_type_id
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
                $scope.getEntityTypes();
                $scope.cancel();
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

    $scope.getall = function() {
        $http.get(API_URL + "/ents_types/get_all_http")
            .then(function (response) {
                $scope.transactiontypes = response.data.tr;
                $scope.tstates = response.data.ts;
            });
    };

    $scope.getEntityTypes = function() {
        $http.get('/ents_types/get_ents_types', [{cache : true}]).then(function(response) {
            $scope.tableParams = new NgTableParams({
                count: 100,
                group: "process_type_name",
                sorting: { id: "desc" }
            }, {
                paginationMaxBlocks: 13,
                paginationMinBlocks: 2,
                dataset: response.data
            });
        });
    };
    $scope.getEntityTypes();

    $scope.getall();

    $scope.delete = function(id) {
        var url = API_URL + "Entity_Type_del/" + id;

        $http({
            method: 'POST',
            url: url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            //headers: {'Content-Type': 'json'}
        }).then(function (response) {
            growl.success('This is success message.',{title: 'Success!'});
            $scope.getEntityTypes();
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
});