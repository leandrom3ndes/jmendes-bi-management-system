/**
 * Created by Guilherme on 21/05/2018.
 */
app.controller('dActionController', function($scope, $http, growl, API_URL, $translatePartialLoader, $translate, NgTableParams, $uibModal) {

    //Listar os Prop_Ext_Names
    $scope.getDataActions = function () {
        $http.get('/d_action/get_all', [{cache : true}]).then(function(response) {

            $scope.tableParams = new NgTableParams({
                count: 100,
                sorting: { id: "asc" },
                group: "d_action_name"
            }, {
                paginationMaxBlocks: 13,
                paginationMinBlocks: 4,
                dataset: response.data
            });
        });
    };

    //Open Modal - d_action
    $scope.openModalForm = function (size, id, type) {

        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalDAction',
            controller: 'ModalInstanceCtrl',
            scope: $scope,
            size: size,
            //appendTo: parentElem,
            resolve: {
                d_action_id: function() {
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

    $scope.ModalInstanceCtrl = function ($scope, $uibModalInstance, $timeout, d_action_id, modal_state) {
        var modalstate = modal_state;
        var id = d_action_id;
        $scope.dAction = [];

        $scope.getModalInfo();

        switch (modalstate) {
            case 'add':
                $scope.id = id;
                $scope.form_title = "ADD_FORM_NAME";
                break;
            case 'edit':
                $scope.form_title = "EDIT_FORM_NAME";
                $scope.id = id;
                $http.get(API_URL + 'd_action/get_all/' + id)
                    .then(function(response) {
                        $scope.dAction = response.data;
                    });
                break;
            default:
                break;
        }

        //save new record / update existing record
        $scope.save = function() {
            var url = API_URL + "D_Action";

            //append employee id to the URL if the form is in edit mode
            if (modalstate === 'edit') {
                url += "/" + id ;
            }

            $http({
                method: 'POST',
                url: url,
                data: $.param({
                    'name' : $scope.dAction.language[0].pivot.name,
                    'transaction_type_id' : $scope.dAction.transaction_type_id,
                    't_state_id' : $scope.dAction.t_state_id,
                    'type' : $scope.dAction.type
                }),

                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                if (modalstate === 'edit')
                    growl.success('EDIT_SUCCESS_MESSAGE');
                else
                    growl.success('SAVE_SUCCESS_MESSAGE');
                $scope.cancel();
                $scope.getDataActions();
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

    //SoftDelete data_action
    $scope.remove = function (d_action_id)
    {
        var url = API_URL + "d_action/remove";
        $http({
            method: 'POST',
            url: url,
            data: $.param({'id' : d_action_id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {
            growl.success('Delete Success');
            $scope.getDataActions();
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
    $scope.getModalInfo = function() {
        $http.get(API_URL + '/d_action/modal_information')
            .then(function(response) {
                $scope.transaction_types = response.data.transaction_types;
                $scope.t_states = response.data.t_states;
                $scope.types = response.data.types;
            });
    };

});
