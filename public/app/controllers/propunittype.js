/**
 * Created by Guilherme on 14/06/2017.
 */

app.controller('propUnitTypeController', function($scope, $http, growl, API_URL, $translatePartialLoader, $translate, NgTableParams, $uibModal) {

    //Translate Function
    $translatePartialLoader.addPart('propUnitType');
    setTimeout(function() { $translate.refresh(); }, 0);

    /*$scope.dotranslate = function() {
        var currentLang = $translate.proposedLanguage() || $translate.use();
        if (currentLang == "en")
            $translate.use('pt');
        else
            $translate.use('en');
    };*/

    //MODAL FUNCTIONS
    $scope.openModalForm = function (size, id, type) {

        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalPropUnitTypes',
            controller: 'ModalInstanceCtrl',
            scope: $scope,
            size: size,
            //appendTo: parentElem,
            resolve: {
                prop_unit_type_id: function() {
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

    $scope.ModalInstanceCtrl = function ($scope, $uibModalInstance, $timeout, prop_unit_type_id, modal_state) {
        var modalstate = modal_state;
        var id = prop_unit_type_id;
        $scope.propUnitType = [];
        $scope.propUnitType.state = 'active';

        switch (modalstate) {
            case 'add':
                $scope.id = id;
                $scope.form_title = "ADD_FORM_NAME";
                break;
            case 'edit':
                $scope.form_title = "EDIT_FORM_NAME";
                $scope.id = id;
                $http.get(API_URL + 'prop_unit_types/get_unit/' + id)
                    .then(function(response) {
                        $scope.propUnitType = response.data;
                    });
                break;
            default:
                break;
        }

        //save new record / update existing record
        $scope.save = function() {
            var url = API_URL + "Prop_Unit_Type";

            //append employee id to the URL if the form is in edit mode
            if (modalstate === 'edit') {
                url += "/" + id ;
            }

            $http({
                method: 'POST',
                url: url,
                data: $.param({'name' : $scope.propUnitType.language[0].pivot.name,
                    'state' : $scope.propUnitType.state,
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                if (modalstate === 'edit')
                    growl.success('EDIT_SUCCESS_MESSAGE');
                else
                    growl.success('SAVE_SUCCESS_MESSAGE');
                $scope.getPropUnitTypes();
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
                //alert('This is embarassing. An error has occured. Please check the log for details');
            });
        };

        $scope.cancel = function () {
            $uibModalInstance.close('cancel');
        };
    };

    $scope.getPropUnitTypes = function() {
        $http.get('/prop_unit_types/get_unit', [{cache : true}]).then(function(response) {
            $scope.tableParams = new NgTableParams({
                count: 100,
                sorting: { id: "asc" }
            }, {
                paginationMaxBlocks: 13,
                paginationMinBlocks: 4,
                dataset: response.data
            });

        });

        //console.log($scope.tableParams);
    };

    //SoftDelete da Prop Unit
    $scope.remove = function (prop_unit_id)
    {
        var url = API_URL + "prop_unit_types/remove";
        $http({
            method: 'POST',
            url: url,
            data: $.param({'id' : prop_unit_id,
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {
            growl.success('Delete Success');
            $scope.getPropUnitTypes();
        },  function errorCallback(response) {
            if (response.status == 400)
            {
                growl.error('This is error message.',{title: 'error!'});
            }
            else
            {
                $scope.errors = response.data;
            }
            //alert('This is embarassing. An error has occured. Please check the log for details');
        });
    };

    $scope.getPropUnitTypes();

});