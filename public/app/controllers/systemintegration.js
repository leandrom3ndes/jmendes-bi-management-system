/**
 * Created by Guilherme on 21/05/2018.
 */
app.controller('systemIntegrationController', function($scope, $http, growl, API_URL, $translatePartialLoader, $translate, NgTableParams, $uibModal) {

    //Listar os Prop_Ext_Names
    $scope.getPropExtNames = function () {
        $http.get('/prop_ext_names/get_prop', [{cache : true}]).then(function(response) {

            $scope.tableParams = new NgTableParams({
                count: 100,
                sorting: { property_id: "asc" },
                group: "property_name"
            }, {
                paginationMaxBlocks: 13,
                paginationMinBlocks: 4,
                dataset: response.data
            });

        });
    };

    //Listar os External_Integrations
    $scope.getEntTypes = function () {
        $http.get('/external_integration/get_ent', [{cache : true}]).then(function(response) {

            $scope.tableParams = new NgTableParams({
                count: 100,
                sorting: { ent_type_name_id: "asc" },
                group: "ent_type_name"
            }, {
                paginationMaxBlocks: 13,
                paginationMinBlocks: 4,
                dataset: response.data
            });

        });
    };

    //Modal - ADD/EDIT do Prop_Ext_Name
    $scope.openModalFormProp = function (size, id, type) {

        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalPropExtNames',
            controller: 'ModalInstanceCtrlProp',
            scope: $scope,
            size: size,
            //appendTo: parentElem,
            resolve: {
                prop_ext_name_id: function() {
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

    $scope.ModalInstanceCtrlProp = function ($scope, $uibModalInstance, $timeout, prop_ext_name_id, modal_state) {
        var modalstate = modal_state;
        var id = prop_ext_name_id;
        $scope.propExtName = [];

        //Buscar as propriedades e External Int
        $scope.getModalInfoProp();

        switch (modalstate) {
            case 'add':
                $scope.id = id;
                $scope.form_title = "ADD_FORM_NAME";
                break;
            case 'edit':
                $scope.form_title = "EDIT_FORM_NAME";
                $scope.id = id;
                $http.get(API_URL + 'prop_ext_names/get_prop/' + id)
                    .then(function(response) {
                        $scope.propExtName = response.data;
                    });
                break;
            default:
                break;
        }

        //save new record / update existing record
        $scope.save = function() {
            var url = API_URL + "System_Integration_Prop";

            //append employee id to the URL if the form is in edit mode
            if (modalstate === 'edit') {
                url += "/" + id ;
            }

            $http({
                method: 'POST',
                url: url,
                data: $.param({'name' : $scope.propExtName.name,
                    'external_integration_id' : $scope.propExtName.external_integration_id,
                    'property_id' : $scope.propExtName.property_id
                }),

                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                if (modalstate === 'edit')
                    growl.success('EDIT_SUCCESS_MESSAGE');
                else
                    growl.success('SAVE_SUCCESS_MESSAGE');
                $scope.cancel();
                $scope.getPropExtNames();
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

    //Modal - ADD/EDIT do Ent Types
    $scope.openModalFormEnt = function (size, id, type) {

        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalPropEntTypes',
            controller: 'ModalInstanceCtrlEnt',
            scope: $scope,
            size: size,
            //appendTo: parentElem,
            resolve: {
                external_integration_id: function() {
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

    $scope.ModalInstanceCtrlEnt = function ($scope, $uibModalInstance, $timeout, external_integration_id, modal_state) {
        var modalstate = modal_state;
        var id = external_integration_id;
        $scope.externalIntegration = [];

        //Buscar as propriedades e External Int
        $scope.getModalInfoEnt();

        switch (modalstate) {
            case 'add':
                $scope.id = id;
                $scope.form_title = "ADD_FORM_NAME";
                break;
            case 'edit':
                $scope.form_title = "EDIT_FORM_NAME";
                $scope.id = id;
                $http.get(API_URL + '/external_integration/get_ent/' + id)
                    .then(function(response) {
                        $scope.externalIntegration = response.data;
                    });
                break;
            default:
                break;
        }

        //save new record / update existing record
        $scope.save = function() {
            var url = API_URL + "System_Integration_Ent";

            //append employee id to the URL if the form is in edit mode
            if (modalstate === 'edit') {
                url += "/" + id ;
            }

            $http({
                method: 'POST',
                url: url,
                data: $.param({
                    'name' : $scope.externalIntegration.name,
                    'task' : $scope.externalIntegration.task,
                    'ent_type_id' : $scope.externalIntegration.ent_type_id,
                    't_state_id' : $scope.externalIntegration.t_state_id
                }),

                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                if (modalstate === 'edit')
                    growl.success('EDIT_SUCCESS_MESSAGE');
                else
                    growl.success('SAVE_SUCCESS_MESSAGE');
                $scope.cancel();
                $scope.getEntTypes();
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

    //SoftDelete da Prop_Ext_Name
    $scope.removeProp = function (prop_ext_name_id)
    {
        var url = API_URL + "system_integration_prop/remove";
        $http({
            method: 'POST',
            url: url,
            data: $.param({'id' : prop_ext_name_id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {
            growl.success('Delete Success');
            $scope.getPropExtNames();
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

    //SoftDelete da external integration
    $scope.removeEnt = function (external_integration_id)
    {
        var url = API_URL + "system_integration_ent/remove";
        $http({
            method: 'POST',
            url: url,
            data: $.param({'id' : external_integration_id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {
            growl.success('Delete Success');
            $scope.getEntTypes();
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
    //Buscar Informação para o modal do Prop_Ext_Name
    $scope.getModalInfoProp = function() {
        $http.get(API_URL + '/system_integration/modal_information_prop')
            .then(function(response) {
                $scope.properties = response.data.properties;
                $scope.external_integrations = response.data.external_integrations;
            });
    };
    //Buscar Informação para o modal do External_Integration
    $scope.getModalInfoEnt = function() {
        $http.get(API_URL + '/system_integration/modal_information_ent')
            .then(function(response) {
                $scope.ent_types = response.data.ent_types;
                $scope.t_states = response.data.t_states;
            });
    };
});
