/**
 * Created by Guilherme on 15/06/2017.
 */

app.controller('propAllowedValueController', function($scope, $http, API_URL, growl,$translatePartialLoader, NgTableParams, $translate, $uibModal ) {

    //Translate Function
    /*$translatePartialLoader.addPart('propAllowedValue');
    setTimeout(function() { $translate.refresh(); }, 0);

    $scope.dotranslate = function() {
        var currentLang = $translate.proposedLanguage() || $translate.use();
        if (currentLang == "en")
            $translate.use('pt');
        else
            $translate.use('en');
    };*/

    $scope.getPropAllowedValues = function() {
        $http.get('/prop_allowed_value/get_unit', [{cache : true}]).then(function(response) {
            $scope.tableParams = new NgTableParams({
                count: 100,
                sorting: { ent_id: "asc" },
                group: "ent_name"
            }, {
                paginationMaxBlocks: 13,
                paginationMinBlocks: 4,
                dataset: response.data
            });
        });
    };

    $scope.getPropAllowedValues();

    //MODAL FUNCTIONS
    $scope.openModalForm = function (size, id, type) {

        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalPropAllowedValues',
            controller: 'ModalInstanceCtrl',
            scope: $scope,
            size: size,
            resolve: {
                prop_allowed_value_id: function() {
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

    $scope.ModalInstanceCtrl = function ($scope, $uibModalInstance, $timeout, prop_allowed_value_id, modal_state) {
        var modalstate = modal_state;
        var id = prop_allowed_value_id;
        $scope.propAllowedValue = [];
        $scope.propAllowedValue.state = 'active';

        //Buscar as todas Propriedades
        $scope.getAllProps();

        switch (modalstate) {
            case 'add':
                $scope.id = id;
                $scope.form_title = "ADD_FORM_NAME";
                $scope.checkProp = false;
                break;

            case 'edit':
                $scope.form_title = "EDIT_FORM_NAME";
                $scope.id = id;
                $scope.checkProp = true;
                $http.get(API_URL + 'prop_allowed_value/get_unit/' + id)
                    .then(function(response) {
                        $scope.propAllowedValue = response.data;
                    });
                break;
            default:
                break;
        }

        //save new record / update existing record
        $scope.save = function() {
            var url = API_URL + "Prop_Allowed_Value";

            //append employee id to the URL if the form is in edit mode
            if (modalstate === 'edit') {
                url += "/" + id ;
            }

            $http({
                method: 'POST',
                url: url,
                data: $.param({'name' : $scope.propAllowedValue.language[0].pivot.name,
                    'state' : $scope.propAllowedValue.state,
                    'property_id' : $scope.propAllowedValue.property_id
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                if (modalstate === 'edit')
                    growl.success('EDIT_SUCCESS_MESSAGE');
                else
                    growl.success('SAVE_SUCCESS_MESSAGE');

                $scope.getPropAllowedValues();
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

    //SoftDelete da Prop Allowed Value
    $scope.remove = function (prop_allowed_value_id)
    {
        var url = API_URL + "prop_allowed_value/remove";
        $http({
            method: 'POST',
            url: url,
            data: $.param({'id' : prop_allowed_value_id,
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {
            growl.success('Delete Success');
            $scope.getPropAllowedValues();
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

    //Funções Uteis
    $scope.getAllProps = function() {
        $http.get(API_URL + '/prop_allowed_value/get_properties')
            .then(function(response) {
                $scope.properties = response.data;
            });
    };
});