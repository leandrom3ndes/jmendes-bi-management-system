/**
 * Created by ASUS on 26/05/2017.
 */
app.controller('languagesController', function($scope, $http, growl, API_URL, NgTableParams, $uibModal) {
    $scope.openModalForm = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalLanguages',
            controller: 'ModalInstanceCtrl',
            scope: $scope,
            size: size,
            resolve: {
                language_id: function() {
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

    $scope.ModalInstanceCtrl = function ($scope, $uibModalInstance, $timeout, language_id, modal_state) {
        var modalstate = modal_state;
        var id = language_id;
        $scope.language = [];
        $scope.language.state = 'active';

        //regras de validação client side, angularjs
        $scope.language_name_maxLength = 100;
        $scope.language_slug_maxLength = 5;
        //********************************************//

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD_FORM_NAME";
                break;
            case 'edit':
                $scope.form_title = "EDIT_FORM_NAME";
                $http.get(API_URL + 'get_languages/' + id)
                    .then(function(response) {
                        $scope.language = response.data;
                    });
                break;
            default:
                break;
        }

        //save new record / update existing record
        $scope.save = function() {
            var url = API_URL + "languages";

            if (modalstate === 'edit') {
                url += "/" + id;
            }

            $http({
                method: 'POST',
                url: url,
                data:  $.param(
                    {
                        'language_id' : $scope.language.id,
                        'name': $scope.language.name,
                        'slug': $scope.language.slug,
                        'state': $scope.language.state,
                    }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                growl.success(response.data.message);
                $scope.cancel();
                $scope.getLanguages();
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


    $scope.getLanguages = function() {
        $http.get('/get_languages', [{cache : true}]).then(function(response) {
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
    $scope.getLanguages();


    $scope.delete = function(id) {
        var url = API_URL + "languages/remove/" + id;

        $http({
            method: 'POST',
            url: url
        }).then(function (response) {
            growl.success(response.data.message);
            $scope.getLanguages();
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