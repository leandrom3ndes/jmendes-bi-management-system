/**
 * Created by Guilherme on 21/05/2018.
 */
app.controller('dActTemplateController', function($scope, $http, growl, API_URL, $translatePartialLoader, $translate, NgTableParams, $uibModal, textAngularManager) {

    //Listar os Prop_Ext_Names
    $scope.getDActTemplate = function () {
        $http.get('/d_act_template/get_all', [{cache : true}]).then(function(response) {

            $scope.tableParams = new NgTableParams({
                count: 100,
                sorting: { d_act_template_id: "asc" }
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
            templateUrl: 'modalDActTemplate',
            controller: 'ModalInstanceCtrl',
            scope: $scope,
            size: size,
            //appendTo: parentElem,
            resolve: {
                d_act_template_id: function() {
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

    $scope.ModalInstanceCtrl = function ($scope, $uibModalInstance, $timeout, d_act_template_id, modal_state) {
        var modalstate = modal_state;
        var id = d_act_template_id;
        $scope.dActTemplate = [];

        $scope.getModalInfo();

        switch (modalstate) {
            case 'add':
                $scope.id = id;
                $scope.form_title = "ADD_FORM_NAME";
                break;
            case 'edit':
                $scope.form_title = "EDIT_FORM_NAME";
                $scope.id = id;
                $http.get(API_URL + 'd_act_template/get_all/' + id)
                    .then(function(response) {
                        $scope.dActTemplate = response.data;
                    });
                break;
            default:
                break;
        }

        //save new record / update existing record
        $scope.save = function() {
            var url = API_URL + "D_Act_Template";

            //append employee id to the URL if the form is in edit mode
            if (modalstate === 'edit') {
                url += "/" + id ;
            }

            $http({
                method: 'POST',
                url: url,
                data: $.param({
                    'd_action_id' : $scope.dActTemplate.d_action_id,
                    'text' : $scope.dActTemplate.text
                }),

                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                if (modalstate === 'edit')
                    growl.success('EDIT_SUCCESS_MESSAGE');
                else
                    growl.success('SAVE_SUCCESS_MESSAGE');
                $scope.cancel();
                $scope.getDActTemplate();
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

        $scope.getCurrentPosition = function()
        {
            if($scope.dActTemplate.prop_ext_name !== undefined) {
                var sel, range;
                sel = window.getSelection();
                if (sel.getRangeAt && sel.rangeCount) {
                    $scope.rango = sel.getRangeAt(0);
                    $scope.rango.insertNode(document.createTextNode('{{$' + $scope.dActTemplate.prop_ext_name + '}}'));
                    $scope.dActTemplate.prop_ext_name = undefined;

                    return sel.getRangeAt(0);
                }
            }
            /*
             if($scope.dActTemplate.prop_ext_name){
             var sel, range;
             sel = window.getSelection();
             if (sel.getRangeAt && sel.rangeCount) {
             $scope.rango = sel.getRangeAt(0);
             $scope.rango.insertNode(document.createTextNode('{'+vm.variable+'}'));
             $scope.variable = '';

             return sel.getRangeAt(0);
             }
             }
             */
        }


        $scope.cancel = function () {
            $uibModalInstance.close('cancel');
        };
    };

    //SoftDelete data_action
    $scope.remove = function (d_act_template_id)
    {
        var url = API_URL + "d_act_template/remove";
        $http({
            method: 'POST',
            url: url,
            data: $.param({'id' : d_act_template_id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {
            growl.success('Delete Success');
            $scope.getDActTemplate();
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

    //Download PDF
    $scope.downloadPdf = function (d_act_template_id)
    {
        var url = API_URL + "d_act_template/download_pdf/" + d_act_template_id;

        $http.get(url, {responseType: 'arraybuffer'})
            .then(function(response) {
            });
    };

    //Funções Uteis
    $scope.getModalInfo = function() {
        $http.get(API_URL + '/d_act_template/modal_information')
            .then(function(response) {
                $scope.d_actions = response.data.d_actions;
                $scope.prop_ext_name = response.data.prop_ext_name;
            });
    };

    //Editores de html
    //SummerNote


});
