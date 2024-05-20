/**
 * Created by ASUS on 26/05/2017.
 */
app.controller('dashboardController', function($scope, $q, $http, growl, API_URL, $translatePartialLoader, $translate, NgTableParams, MyService, $uibModal, $timeout, FileUploader) {
    $scope.addGrowl = function() {
        growl.info('Notificação! Actualização da tabela de tarefas', {title: 'Info!', referenceId: 80, ttl: -1});
    };

    $scope.isString = function(item) {
        return angular.isString(item);
    };

    $scope.oneAtATime = true;

    $scope.groups = [
        {
            title: 'Dynamic Group Header - 1',
            content: 'Dynamic Group Body - 1'
        },
        {
            title: 'Dynamic Group Header - 2',
            content: 'Dynamic Group Body - 2'
        }
    ];

    $scope.items = ['Item 1', 'Item 2', 'Item 3'];

    $scope.status = {
        isCustomHeaderOpen: false,
        isFirstOpen: true,
        isFirstDisabled: false
    };

    $scope.dynamicPopover = {
        content: 'Hello, World!',
        templateUrl: 'popover',
        title: 'Title'
    };

    $scope.openModalDialog = function (size, id, min, max, transtypename, tstatename) {
        /*var parentElem = parentSelector ?
         angular.element($document[0].querySelector('.modal-demo ' + parentSelector)) : undefined;*/
        var deferred = $q.defer();

        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalDialog',
            controller: 'ModalInstanceCtrlDialog',
            backdrop: 'static',
            keyboard: false,
            scope: $scope,
            size: size,
            //appendTo: parentElem,
            resolve: {
                trans_id: function() {
                    return id
                },
                trans_min: function() {
                    return min
                },
                trans_max: function() {
                    return max
                },
                trans_type_name: function() {
                    return transtypename
                },
                t_state_name: function() {
                    return tstatename;
                }
            }
        });

        modalInstance.result.then(function (response) {
            ArrModalDialogOpened.pop();
            deferred.resolve(response);
            //alert('Modal success at:' + new Date());
        }, function (response) {
            deferred.reject(response);
            //alert('Modal dismissed at: ' + new Date());
        });

        modalInstance.opened.then(function (response) {
                /*if (min == 1 && max == 1) {
                    $scope.modalDialog = {};
                    //alert("entrou");
                    $scope.modalDialog.number = 1;
                    $scope.modalDialog.id = id;
                    modalInstance.close($scope.modalDialog);
                }*/
            }
        );

        return deferred.promise;
    };

    var ArrModalDialogOpened = [];
    $scope.ModalInstanceCtrlDialog = function ($scope, $uibModalInstance, $timeout, trans_id, trans_min, trans_max, trans_type_name, t_state_name) {
        ArrModalDialogOpened.push($uibModalInstance);

        $scope.transTypeName = trans_type_name;
        $scope.tStateName = t_state_name;
        $scope.transTypeMin = trans_min;
        $scope.transTypeMax = trans_max;

        $scope.cancel = function ($modalDialogForm) {
            if (trans_max == '*')
            {
                if ($modalDialogForm.number < trans_min) {
                    alert("valores fora dos limites de min");
                    return;
                }
            }
            else
            {
                if (($modalDialogForm.number > trans_max) || ($modalDialogForm.number < trans_min)) {
                    alert("valores fora dos limites de max e min");
                    return;
                }
            }
            $modalDialogForm.id = trans_id;
            $uibModalInstance.close($modalDialogForm);
        };
    };

    //metodos fora do MODAL
    //get all the processes from a specific transaction type id
    $scope.processes = function($transaction_type_id) {
        var deferred = $q.defer();

        $http.get(API_URL + "dashboard/get_processes_of_tr/" + $transaction_type_id, {
            ignoreLoadingBar: false
        })
            .then(function (response) {
                deferred.resolve(response);
            }, function errorCalback(response) {
                data = response;
                deferred.reject(response);
            }).finally(function () {
            // called no matter success or failure);
        });

        return deferred.promise;
    };

    $scope.getDataForTabTState = function($proc_id, $trans_type_id, $trans_id)
    {
        var deferred = $q.defer();

        $http({
            method: 'POST',
            url: API_URL + "dashboard/get_data_for_tab",
            data: $.param({ 'process_id': $proc_id,
                    'trans_type_id':$trans_type_id,
                    'trans_id': $trans_id
                }
            ),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            ignoreLoadingBar: false
        }).then(function (response) {
            deferred.resolve(response);
        }, function errorCalback(response) {
            deferred.reject(response);
        }).finally(function () {
            // called no matter success or failure
        });

        return deferred.promise;
    };


    $scope.openModalNotification = function (size, message) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalNotification',
            controller: 'ModalInstanceCtrlNotification',
            backdrop: 'static',
            scope: $scope,
            size: size,
            resolve: {
                messageNotification: function() {
                    return message
                }
            }
        }).result.then(function (response) {

        }, function (response) {

        });
    };

    $scope.ModalInstanceCtrlNotification = function ($scope, $uibModalInstance, messageNotification) {
        $scope.messageNotificationHTML = messageNotification;

        $scope.cancel = function () {
            $uibModalInstance.close('cancel');
        };
    };

    //change variables on action template with values obtained from the database on the backend (LARAVEL/PHP)
    $scope.replaceVarsFromTemplate = function($action_template_id, $transaction_id)
    {
        var deferred = $q.defer();

        $http({
            method: 'POST',
            url: API_URL + "dashboard/replace_vars_on_template",
            data: $.param({ 'action_template_id': $action_template_id,
                    'transaction_id': $transaction_id
                }
            ),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            ignoreLoadingBar: false
        }).then(function (response) {
            deferred.resolve(response);
        }, function errorCalback(response) {
            deferred.reject(response);
        }).finally(function () {
            // called no matter success or failure
        });

        return deferred.promise;
    };


    $scope.identifyModalToOpen = function(trans_type_id, trans_id, flag_inic_process, proc_id, modalInstance, modalForm = null) {
        //console.log('FLAG INIC PROCESS: ' + flag_inic_process);
        if (modalInstance !== null)
        {
            console.log("MODAL FORM CLOSING", modalForm);
            modalInstance.close();

            //console.log(modalForm);

            //only for testing purposes
            //the customized messages are shown before the closing of the actual modal
            if (modalForm !== null)
            {
                //alert("entrou modalform");
                //insert the causal link data, is not done asynchronously
                if (!Array.isArray(modalForm.c_act)) //verify if it's a array because in the beginning it's a empty array, when
                    //filled, it's a object with properties
                {
                    //alert("C_ACT NOT NULL");
                    $scope.saveAsyncr(modalForm, false, null, null, 'c_act');
                }

                if (modalForm.hasOwnProperty('actionTemplates'))
                {
                    var promiseStack = [];
                    angular.forEach(modalForm.actionTemplates, function (valueAT, key)
                    {
                        var result = valueAT.language[0].pivot.text.includes('variable mceNonEditable');

                        var deferred = $q.defer();
                        var promise = deferred.promise;
                        promiseStack.push(deferred);
                        if (result === true)
                        {
                            //change the variables that are shown in the template
                            $scope.replaceVarsFromTemplate(valueAT.id, trans_id).then(function (response) {
                                //deferred.resolve(response.data);
                                promiseStack[key].resolve(response.data);
                                /*var promiseStack = [];
                                angular.forEach(arrayData, function(value, key) {
                                    var deferred = $q.defer();
                                    var promise = deferred.promise;
                                    if (key === 0)
                                    {
                                        deferred.resolve();
                                    }
                                    else
                                    {
                                        promiseStack.push(deferred);
                                    }

                                });*/
                            }); //if fails release promise
                        }
                        else
                        {
                            //deferred.resolve(valueAT.text);
                            promiseStack[key].resolve(valueAT.text);
                        }

                        promise.then(function(text) {
                            if (valueAT.type === 'toast') {
                                var messageNotification;
                                var messageNotificationTitle = 'Notification';
                                messageNotification = text;

                                growl.success(messageNotification
                                    , {
                                        title: messageNotificationTitle,
                                        referenceId: 80,
                                        ttl: -1
                                    });
                            }
                            else if (valueAT.type === 'modal') {
                                $scope.openModalNotification('md', text);
                            }
                        });
                    });
                }
            }
        }

        //verify if the transaction type initiates a new process
        if (parseInt(flag_inic_process) === 1) //if starts a new process, define what view to show
        {
            //get data from the server and inject inside the page
            // defining what view to present to the user basead on the action type
            $scope.getDataForTabTState(proc_id != null ? proc_id : null, trans_type_id, trans_id).then(function (response)
            {
                var actionType=null;
                var modalSize='xl';
                var responseData = response.data;
                if (responseData.hasOwnProperty('actionsToDo'))
                {
                    if (responseData.actionsToDo.hasOwnProperty('specify_data')) {
                        actionType = 'Spec Data';
                    }
                    else if (responseData.actionsToDo.hasOwnProperty('C_ACT')) {
                        actionType = 'C Act';
                        modalSize = 'lg';
                    }
                    else if (responseData.actionsToDo.hasOwnProperty('PRODUCE_DOCUMENT'))
                    {
                        //if (responseData.actionsToDo.prod_doc.action_template.type !== 'modal')
                        actionType = 'Prod Doc';
                        modalSize = 'md';
                    }

                    $scope.openModalTask(modalSize, trans_type_id, trans_id, 1, proc_id, actionType, responseData);
                }
            }, function errorCalback(response) {
                if (response.status === 401)
                {
                    growl.error(response.data.msg, {
                        onclose: function() {

                        },
                        onopen: function() {

                        },
                        ttl: 5000,
                        title: 'Erro!',
                        referenceId: 80
                    });

                }
                else if (response.status === 402)
                {
                    //there is transactions waiting to be executed first
                    angular.forEach(response.data, function(value, key1) {
                        angular.forEach(value.dataTransactionsLacking, function(valueTL, key) {
                            growl.error(value.messageTab1 + value.t_state_name + value.messageTab2 +
                                valueTL.transaction_type_name + value.messageTab3 + valueTL.t_state_name
                                , {
                                    title: value.messageTabError,
                                    referenceId: 80,
                                    ttl: -1
                                });
                        });
                    });
                }
                else if (response.status === 403)
                {
                    //only for testing purposes
                    //já nao existe mais t states a executar para uma dada transacção
                    angular.forEach(response.data.actionsDone, function(valueAD, key) {
                        var messageNotification;
                        var messageNotificationTitle = 'Actions Done';
                        if (valueAD.actionType === 'C-ACT')
                        {
                            messageNotification = valueAD.numberOfTrs + ' transaction type of ' + valueAD.transactionTypeName
                                + ' in the t state ' + valueAD.tStateName + ' was created';
                            messageNotificationTitle += ' - C Act';
                        }
                        else if (valueAD.actionType === 'newTransaction&State')
                        {
                            messageNotification = 'Transaction type of ' + valueAD.transactionTypeName
                                + ' in the t state ' + valueAD.transactionState + ' was created';
                            messageNotificationTitle += ' - Transaction and State';
                        }
                        else if (valueAD.actionType === 'newProcess')
                        {

                        }
                        else if (valueAD.actionType === 'WRITE_VALUE')
                        {
                            messageNotification = 'Write Value action was executed';
                            messageNotificationTitle += ' - Write Value';
                        }

                        growl.success(messageNotification
                            , {
                                title: messageNotificationTitle,
                                referenceId: 80,
                                ttl: -1
                            });

                    });

                    //open again the function to advance into the next state/action of the transaction
                    var responseData = response.data;
                    $scope.identifyModalToOpen(trans_type_id, responseData.transaction_id, 1, null, modalInstance, modalForm);
                }
                else if (response.status === 405)
                {
                    //only for testing purposes
                    //there isn't more actions to execute/run, so the status 405 indicates that the actual transaction is finished
                    //show notifications about the actions done on server
                    angular.forEach(response.data.actionsDone, function(valueAD, key) {
                        var messageNotification;
                        var messageNotificationTitle = 'Actions Done';
                        if (valueAD.actionType === 'C-ACT')
                        {
                            messageNotification = valueAD.numberOfTrs + ' transaction type of ' + valueAD.transactionTypeName
                                + ' in the t state ' + valueAD.tStateName + ' was created';
                            messageNotificationTitle += ' - C Act';
                        }
                        else if (valueAD.actionType === 'newTransaction&State')
                        {
                            messageNotification = 'Transaction type of ' + valueAD.transactionTypeName
                                + ' in the t state ' + valueAD.transactionState + ' was created';
                            messageNotificationTitle += ' - Transaction and State';
                        }
                        else if (valueAD.actionType === 'newProcess')
                        {

                        }
                        else if (valueAD.actionType === 'WRITE_VALUE')
                        {
                            messageNotification = 'Write Value action was executed';
                            messageNotificationTitle += ' - Write Value';
                        }

                        growl.success(messageNotification
                            , {
                                title: messageNotificationTitle,
                                referenceId: 80,
                                ttl: -1
                            });

                    });
                  }

            });
        }
        else //if the transaction type id doesn't start a process then a user need to select a process from a list
        {
            $scope.processes(trans_type_id).then(function (response) {
                $scope.openModalTask('xl', trans_type_id, trans_id, 1, proc_id, 'process', response.data);
            });
        }
    };

    $scope.modal = [];
    $scope.modal_formTab = {};
    //https://stackoverflow.com/questions/36844064/dismiss-uibmodal-from-within
    //used as the main modal to show the action output from the server
    $scope.openModalTask = function (size, trans_type_id, trans_id, flag, proc_id, type_of_template, data) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalTask',
            controller: 'ModalInstanceCtrl',
            scope: $scope,
            size: size,
            //appendTo: parentElem,
            resolve: {
                transaction_type_id: function() {
                    return trans_type_id
                },
                transaction_id: function() {
                    return trans_id
                },
                flag_inic_process: function() {
                    return flag
                },
                process_id: function() {
                    return proc_id
                },
                typeTemplate: function() {
                    return type_of_template
                },
                dataFromServer: function() {
                    return data
                }
            }
        }).result.then(function(result) {
            //Get triggers when modal is closed
            //alert(result);
            $scope.modal = [];
            uploader.clearQueue();
            $scope.modal_form = {};
            console.log('limpo: ',$scope.modal_form);
            if ($scope.modal_processTab !== undefined)
                $scope.modal_processTab.length = 0;
            //alert("entrou closed");
        }, function(reason){
            //gets triggers when modal is dismissed.
            uploader.clearQueue();
            $scope.modal_form = {};
            console.log('limpo: ',$scope.modal_form);
            if ($scope.modal_processTab !== undefined)
                $scope.modal_processTab.length = 0;
            //alert("entrou dismissed");
        });
    };

    var NumeroModal=1;
    var modalsArrData = [];
    $scope.ModalInstanceCtrl = function ($scope, $uibModalInstance, $timeout, transaction_type_id, transaction_id, flag_inic_process, process_id, typeTemplate, dataFromServer) {
        /*$uibModalInstance.rendered.then(function() {
            $uibModalInstance.close();
        });*/
        /*$uibModalInstance.rendered.then(function() {
            console.log("rendere : ", $uibModalInstance.rendered.$$state);
        });*/

        //only for testing purposes
        if (dataFromServer.hasOwnProperty('actionsDone'))
        {
            $uibModalInstance.rendered.then(function() {
                angular.forEach(dataFromServer.actionsDone, function(valueAD, key) {
                    var messageNotification;
                    var messageNotificationTitle = 'Actions Done';
                    if (valueAD.actionType === 'newTransaction&State')
                    {
                        messageNotification = 'Transaction type of ' + valueAD.transactionTypeName
                            + ' in the t state ' + valueAD.transactionState + ' was created';
                        messageNotificationTitle += ' - C Act';
                    }
                    else if (valueAD.actionType === 'newProcess')
                    {
                        messageNotification = 'Process of ' + valueAD.processTypeName + ' was created';
                        messageNotificationTitle += ' - Process';
                    }

                    growl.success(messageNotification
                        , {
                            title: messageNotificationTitle,
                            referenceId: 80,
                            ttl: -1
                        });

                });
            });
        }

        //ACTION TEMPLATES IN MODAL, FORM BEFORE, FORM AFTER, FORM FIELD
        if (dataFromServer.hasOwnProperty('actionTemplates'))
        {
            $scope.actionTemplates = dataFromServer.actionTemplates;
            /*$scope.actionTemplatesBefore = [];
            $scope.actionTemplatesAfter = [];
            angular.forEach(dataFromServer.actionTemplates, function (valueAT, key)
            {
                if (valueAT.type === 'form_before')
                {

                }
                else if (valueAT.type === 'form_after')
                {
                        $scope.openModalNotification('md', text);
                }
            });*/
        }

        console.log(NumeroModal++ + ' ' + typeTemplate);
        $scope.mymodalInstance = $uibModalInstance;

        $scope.modal_form = { c_act: [] };

        $scope.modal_form.transaction_id = transaction_id;
        $scope.modal_form.transaction_type_id = transaction_type_id;
        $scope.modal_form.process_id = process_id;
        /*$scope.modal_form.process_type_id = process_type_id;
        $scope.modal_form.t_state_id = t_state_id;
        $scope.modal_form.action_id = action_id;*/

        console.log(dataFromServer);
        //depending on the action to be shown, show only the data related to that action type
        var resp = dataFromServer.actionsToDo;
        if (typeTemplate === 'process')
        {
            $scope.templateUrl = 'tabProcess';
            $scope.process = dataFromServer;
        }
        else if (typeTemplate === 'Spec Data')
        {
            $scope.type = resp.t_state_name;
            $scope.order = resp.order;

            $scope.templateUrl = 'tabFormTask';

            $scope.modal_form.action_id = dataFromServer.action_id; //get the action id from server
            $scope.modal_form.t_state_id = dataFromServer.t_state_id; //get the actual t state id from server
            $scope.modal_form.transaction_id = dataFromServer.transaction_id; //get the transaction id from server

            $scope.modal_form.actionTemplates = dataFromServer.actionTemplates;

            if (resp.hasOwnProperty('specify_data'))
            {
                var respSpecData = resp.specify_data;
                $scope.modal_form.spec_data = { propsform: respSpecData.data };

                $scope.templateUrl = 'tabFormTask';
            }
        }
        else if (typeTemplate === 'C Act')
        {
            $scope.type = resp.t_state_name;
            $scope.order = resp.order;

            $scope.modal_form.action_id = dataFromServer.action_id;
            $scope.modal_form.t_state_id = dataFromServer.t_state_id;
            $scope.modal_form.transaction_id = dataFromServer.transaction_id;

            if (resp.hasOwnProperty('C_ACT'))
            {
                var causallinks = resp.C_ACT;
                $scope.modal_form.c_act = { causallinks: causallinks };
                $scope.templateUrl = 'formCActTask';
            }
        }
        else if (typeTemplate === 'Prod Doc')
        {
            $scope.type = resp.t_state_name;
            $scope.order = resp.order;

            $scope.modal_form.action_id = dataFromServer.action_id;
            $scope.modal_form.t_state_id = dataFromServer.t_state_id;
            $scope.modal_form.transaction_id = dataFromServer.transaction_id;

            if (resp.hasOwnProperty('PRODUCE_DOCUMENT'))
            {
                var proddoc = resp.PRODUCE_DOCUMENT;
                $scope.modal_form.PRODUCE_DOCUMENT = proddoc ;
                console.log($scope.modal_form);
                $scope.templateUrl = 'tabProdDocTask';
            }
        }

        $scope.downloadDocument = function () {
            $scope.saveAsyncr($scope.modal_form, false, null, null, 'prod_doc');
            // Default export is a4 paper, portrait, using milimeters for units
            /*var doc = new jsPDF();

            doc.text('Hello world!', 10, 10);
            doc.save('a4.pdf');*/

            var doc = new jsPDF(true);
            var elementHandler = {
                '#ignorePDF': function (element, renderer) {
                    return true;
                }
            };
            var source = $scope.modal_form.PRODUCE_DOCUMENT.action_template_text;
            doc.fromHTML(
                source,
                15,
                15,
                {
                    'width': 180,'elementHandlers': elementHandler
                }, function (dispose) {
                    doc.output("dataurlnewwindow");
                });

            //doc.output("dataurlnewwindow");
            //doc.save('A4.pdf');
        };

        $scope.modal_processTab = [];

        $scope.showMessage = false;

        $scope.tabs = [];

        $scope.taberror = [];

        $scope.verifCanUseProc = function($proc_id)
        {
            $http({
                method: 'POST',
                url: API_URL + "dashboard/verify_can_use_proc/",
                data: $.param({ 'process_id': $proc_id,
                        'transaction_type_id':transaction_type_id
                    }
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                if (response.data === false)
                {
                    $scope.cantAdvance = true;
                    growl.error('It is not possible to use this process because the requirements are already met!!! Choose another process', {
                        title: 'Erro!',
                        referenceId: index_m
                    });
                }
                else
                {
                    $scope.cantAdvance = false;
                }
            });
        };

        $scope.cancel = function () {
            $uibModalInstance.close('cancel');
        };
    };

    $scope.counterSaveAsyncr = 0;
    //save the data entered by the user asynchronously
    $scope.saveAsyncr = function ($form_Tab, $open, $prop_send, $prop_index, $typeAsyncr) {
        if ($typeAsyncr==='spec_data')
        {
            if ($open === true)
                return;
            $scope.counterSaveAsyncr++;
            $form_Tab.spec_data.propsform[$prop_index].stateSaveFlag = 1;

            $scope.sendPartialDataAsyncr($form_Tab, $prop_send, $typeAsyncr).then(function (response) {
                $scope.counterSaveAsyncr--;
                $form_Tab.spec_data.propsform[$prop_index].stateSave = 'green';
                //$scope.modal_form.spec_data.propsform[$prop_index].stateSave = {color:'green'};
                //$scope.modal_form.spec_data.propsform.prop.id === $prop_send;
                //alert("entrou");
                //guardar dados
            }).catch(function (response) {
                $form_Tab.spec_data.propsform[$prop_index].stateSave = 'red';
                $form_Tab.spec_data.propsform[$prop_index].stateSaveFlag = 0;
            });
        }
        else if ($typeAsyncr==='c_act' || $typeAsyncr==='prod_doc')
        {
            $scope.counterSaveAsyncr++;
            $scope.sendPartialDataAsyncr($form_Tab, null, $typeAsyncr).then(function (response) {
                $scope.counterSaveAsyncr--;
                //alert("entrou c_act guardar");
                //guardar dados
            }).catch(function (response) {

            });
        }
    };

    $scope.sendPartialDataAsyncr = function ($data, $prop_id, $type_asyncr) {
        var deferred = $q.defer();

        var data = [];
        $data.prop_id = $prop_id;
        $data.type_asyncr = $type_asyncr;
        //console.log('inside http', $data.prop_id);
        data.push($data);

        $http({
            method: 'POST',
            url: API_URL + "/dashboard/send_partial_data",
            data: data,
            headers: {'Content-Type': 'application/json'},
            ignoreLoadingBar: true
        }).then(function (response) {
            deferred.resolve(response);
            /*angular.forEach(response.data, function(value, key) {
                if(value != null)
                    growl.success(value, {ttl: -1, title: 'Success!', referenceId: 80});
            });*/
        }, function errorCalback(response) {
            deferred.reject(response);
        }).finally(function () {
            // called no matter success or failure
        });

        return deferred.promise;
    };

    $scope.modal.transaction_type_id = null;

    //not used
    var reltype = false;
    var enttype = false;
    $scope.propsForm = function($id, $type, $proc_id)
    {
        var deferred = $q.defer();
        //$scope.modal_formTab = [];
        //$scope.modal_formTab.loading = true;
        $http.get(API_URL + "/dashboard/get_props_form/" + $id + "/" + $type + "/" + $proc_id)
            .then(function (response) {
                    deferred.resolve(response);
                }, function errorCalback(response)
                {
                    deferred.reject(response);
                }
            ).finally(function() {
            // called no matter success or failure
            //$scope.modal_formTab.loading = false;
        });

        return deferred.promise;
    };

    //not used
    $scope.verParEntType = function ($id, $indexTab, $type) {
        $scope.showMessage = false;
        $scope.formChild($id, $indexTab, $type);
        if ($scope.modal_formTab.tab.length > 1)
        {
            angular.forEach($scope.modal_formTab.tab, function(value, key) {
                if (value.propsform !== null)
                {
                    $scope.showMessage = false;
                    $scope.formChild($id, key, value.type);
                }
            });
        }
    };
    $scope.templatePath = 'tabChildFormTask';
    //not used
    $scope.formChild = function($id, $indexTab, $type) {
        if ($id == null)
        {

        }
        else
        {
            $http.get(API_URL + "/dashboard/get_props_form_child/" + $id + "/" + $type, {
                ignoreLoadingBar: false
            })
                .then(function (response) {
                    $scope.modal_formTab.tab[$indexTab].showMessage = true;
                    $scope.modal_formTab.tab[$indexTab].relTypeExist_ = false;
                    $scope.modal_formTab.tab[$indexTab].propsform_ = response.data;
                    $scope.modal_formTab.tab[$indexTab].showBtnType_ = true;

                    console.log($scope.modal_formTab.tab[$indexTab]);

                }, function errorCalback(response) {
                    $scope.modal_formTab.tab[$indexTab].showMessage = false;
                    $scope.modal_formTab.tab[$indexTab].relTypeExist_ = null;
                    $scope.modal_formTab.tab[$indexTab].propsform_ = null;
                    $scope.modal_formTab.tab[$indexTab].showBtnType_ = null;
                }).finally(function () {
                // called no matter success or failure
            });
        }
    };

    //not used for now//EM FALTA
    $scope.updateValue = function(choice, i, indexTab){
        console.log($scope.modal_formTab);
        console.log(choice);
        console.log(i);
        var index = $scope.modal_formTab.tab[indexTab].propsform[i].fields[choice];
        console.log(index);
        if (index === false)
        {
            delete $scope.modal_formTab.tab[indexTab].propsform[i].fields[choice];
        }

        if (isEmpty($scope.modal_formTab.tab[indexTab].propsform[i].fields))
        {
            delete $scope.modal_formTab.tab[indexTab].propsform[i].fields;
        }

        //console.log($scope.modal_formTab.tab[indexTab].propsform[i].fields);
    };

    //not used
    $scope.updateValueChild = function(choice, i, indexTab){
        /*console.log($scope.modal_formTab);
        console.log(choice);
        console.log(i);*/
        var index = $scope.modal_formTab.tab[indexTab].propsform_[i].fields[choice];
        //console.log(index);
        if (index === false)
        {
            delete $scope.modal_formTab.tab[indexTab].propsform_[i].fields[choice];
        }

        if (isEmpty($scope.modal_formTab.tab[indexTab].propsform_[i].fields))
        {
            delete $scope.modal_formTab.tab[indexTab].propsform_[i].fields;
        }

        //console.log($scope.modal_formTab.tab[indexTab].propsform[i].fields);
    };

    function isEmpty(obj) {
        return Object.keys(obj).length === 0;
    }

    $scope.langs = function() {
        $http.get(API_URL + "/proc_types/get_langs")
            .then(function (response) {
                $scope.langs = response.data;
            });
    };

    $scope.getAllInicExecTrans = function() {
        $http.get('/dashboard/get_all_inic_exec_trans', [{cache : true}]).then(function(response) {
            $scope.tableParamsInicTrans = new NgTableParams({
                count: 100,
                sorting: { created_at: "desc" }
            }, {
                paginationMaxBlocks: 13,
                paginationMinBlocks: 2,
                dataset: response.data.AllTrans
            });

            $scope.tableParamsCompletedTrans = new NgTableParams({
                count: 100,
                sorting: { created_at: "desc" }
            }, {
                paginationMaxBlocks: 13,
                paginationMinBlocks: 2,
                dataset: response.data.AllTransCompleted
            });
        });
    };
    $scope.getAllInicExecTrans();

    //used for continuing a transaction already created
    $scope.openModalContinueTransaction = function (size, id, actorCan) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalContinueTransaction',
            controller: 'ModalInstanceCtrlContinueTransaction',
            scope: $scope,
            size: size,
            resolve: {
                transaction_id: function() {
                    return id
                },
                actor_can: function() {
                    return actorCan
                }
            }
        }).result.then(function (response) {

        }, function (response) {

        });
    };

    $scope.ModalInstanceCtrlContinueTransaction = function ($scope, $uibModalInstance, transaction_id, actor_can)
    {
        $scope.actorCan = actor_can;

        $scope.getAllStatesForTransaction = function($transaction_id) {
            var deferred = $q.defer();
            $http({
                method: 'GET',
                url: API_URL + "/dashboard/get_all_states_for_transaction/" + $transaction_id,
                headers: {'Content-Type': 'json'}
            }).then(function (response) {
                deferred.resolve(response);
            }).catch(function(response){
                deferred.reject(response);
            });

            return deferred.promise;
        };

        $scope.getAllStatesForTransaction(transaction_id).then(function (response) {
            $scope.transactionstates = response.data;
        }).catch(function (response) {

        });

        //verify and save an acknowledge for a specific transaction and t state
        $scope.trans_ack = function($lastTransactionState) {
            if ((actor_can === 'Iniciator' && ($lastTransactionState.t_state_id === 2 || $lastTransactionState.t_state_id === 3 || $lastTransactionState.t_state_id === 4))
                || (actor_can === 'Executer' && ($lastTransactionState.t_state_id === 1 || $lastTransactionState.t_state_id === 5)))
            {
                //insert the acknowledge into the database
                $scope.insertTransactionAck($lastTransactionState.transaction_id).then(function (response) {
                    growl.success('Acknowledge made with success!!!'
                        , {
                            title: 'Acknowledge',
                            referenceId: 80,
                            ttl: -1
                        });

                    $scope.getAllStatesForTransaction(transaction_id).then(function (response) {
                        $scope.transactionstates = response.data;
                    }).catch(function (response) {

                    });
                }).catch(function (response) {
                    if (response.status === 400)
                    {
                        alert("Ocorreu um erro");
                    }
                    else if (response.status === 401)
                    {
                        alert("O acknowledge da transacção já existe");
                    }
                });
            }
        };

        $scope.insertTransactionAck = function($transaction_id) {
            var deferred = $q.defer();

            $http({
                method: 'POST',
                url: API_URL + "dashboard/trans_ack/",
                data: $.param({
                        'transaction_id' : $transaction_id
                    }
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                deferred.resolve(response);
            }).catch(function (response) {
                deferred.reject(response);
            });

            return deferred.promise;
        };

        $scope.cancel = function () {
            $uibModalInstance.close('cancel');
        };
    };

    $scope.values = {};

    //FileUploader Functions
    var uploader = $scope.uploader = new FileUploader({
        url: 'fileUpload'
    });

    // CALLBACKS
    uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
        console.info('onWhenAddingFileFailed', item, filter, options);
    };
    uploader.onAfterAddingFile = function(fileItem) {
        var namePath = fileItem.file.name;
        //debugger;
        var arrayKeys = Object.keys($scope.files);
        console.log('arrayKeys',arrayKeys);
        var lastItem = arrayKeys[arrayKeys.length-1];
        console.log('lastItem', lastItem);
        var fileName = lastItem;
        var fileExtension = '.' + fileItem.file.name.split('.').pop();
        var fileNameOriginal = fileItem.file.name;
        fileItem.file.name = fileName + fileExtension;

        //Colocar o File como data64
        var reader = new FileReader();
        reader.readAsDataURL(fileItem._file);
        reader.onload = function (event) {
            var base64 = event.target.result;
            fileItem.file['data'] = base64;
            fileItem.file['fileName'] = fileNameOriginal;
        };

        if(customFormfileUpload)
        {
            angular.forEach($scope.modal_formTab1[0].tab[0].propsform.transaction_types, function(value, key1) {
                angular.forEach(value.ent_type[0].properties, function(value, key) {
                    if (value.language[0].pivot.form_field_name === fileName)
                    {
                        var obj = {};
                        obj[fileName] = fileItem.file;
                        value['fields'] = obj;
                    }
                });
            });
        }
        else
        {
            console.log($scope.modal_formTab);
            angular.forEach($scope.modal_formTab.tab, function(value, key1) {
                angular.forEach(value.propsform, function(value, key) {
                    if (value.language[0].pivot.form_field_name === fileName)
                    {
                        var obj = {};
                        obj[fileName] = fileItem.file;
                        value['fields'] = obj;
                    }
                });

                if (value.hasOwnProperty( "propsform_" ))
                {
                    angular.forEach(value.propsform_, function (value, key) {
                        if (value.language[0].pivot.form_field_name === fileName) {
                            var obj = {};
                            obj[fileName] = fileItem.file;
                            value['fields'] = obj;
                        }
                    });
                }
            });
        }

        //console.log('modaformtab', $scope.modal_formTab);
        //console.log('onAfterAddingFile', fileItem);
    };
    $scope.files = [];
    uploader.onAfterRemovingFile = function(fileItem) {
        var fileName = fileItem.file.name.split('.').shift();
        //$scope.files[0][fileName] = null;
        delete $scope.files[fileName];

        var fileName = fileItem.file.name.replace(/\.\w+/, "");

        if(customFormfileUpload)
        {
            angular.forEach($scope.modal_formTab1[0].tab[0].transaction_types, function(value, key1) {
                angular.forEach(value.ent_type[0].properties, function(value, key) {
                    if (value.language[0].pivot.form_field_name === fileName)
                    {
                        delete value['fields'];
                    }
                });
            });
        }
        else
        {
            angular.forEach($scope.modal_formTab.tab, function(value, key1) {
                angular.forEach(value.propsform, function(value, key) {
                    if (value.language[0].pivot.form_field_name === fileName)
                    {
                        delete value['fields'];
                    }
                });

                if (value.hasOwnProperty( "propsform_" ))
                {
                    angular.forEach(value.propsform_, function (value, key) {
                        if (value.language[0].pivot.form_field_name === fileName) {
                            var obj = {};
                            obj[fileName] = fileItem.file;
                            value['fields'] = obj;
                        }
                    });
                }
            });
        }

        //console.info('onAfterRemovingFile', fileItem);
    };
    uploader.onAfterAddingAll = function(addedFileItems) {
        console.info('onAfterAddingAll', addedFileItems);
    };
    uploader.onBeforeUploadItem = function(item) {
        console.info('onBeforeUploadItem', item);
    };
    uploader.onProgressItem = function(fileItem, progress) {
        console.info('onProgressItem', fileItem, progress);
    };
    uploader.onProgressAll = function(progress) {
        console.info('onProgressAll', progress);
    };
    uploader.onSuccessItem = function(fileItem, response, status, headers) {
        console.info('onSuccessItem', fileItem, response, status, headers);
    };
    uploader.onErrorItem = function(fileItem, response, status, headers) {
        console.info('onErrorItem', fileItem, response, status, headers);
    };
    uploader.onCancelItem = function(fileItem, response, status, headers) {
        console.info('onCancelItem', fileItem, response, status, headers);
    };
    uploader.onCompleteItem = function(fileItem, response, status, headers) {
        console.info('onCompleteItem', fileItem, response, status, headers);
    };
    uploader.onCompleteAll = function() {
        console.info('onCompleteAll');
    };

    $scope.exampleCallback = function() {
        alert("mudou");
    }
}).directive('validFile', function () {
    return {
        require: "ngModel",
        restrict: 'A',
        link: function ($scope, el, attrs, ngModel) {
            el.bind('change', function (event) {
                ngModel.$setViewValue(event.target.files[0]);
                $scope.$apply();
            });

            $scope.$watch(function () {
                return ngModel.$viewValue;
            }, function (value) {
                console.log(value);
                if (!value) {
                    el.val("");
                }
            });
        }
    };
}).directive('dynamic', function ($timeout, $compile) {
    return {
        restrict: 'A',
        /*link: function (scope, ele, attrs) {
            scope.$watch(attrs.dynamic, function(html) {
                if (scope.modal_formTab.tab[1].propsform[0].fields[0]!==null)
                {
                    alert("asdsad");
                }
                //console.log(scope.modal_formTab.tab[1].propsform[0]);
                /*ele.html("ng-show=modal_formTab.tab[1].propsform[0].fields[0]!=null");
                $compile(ele.contents())(scope);*/
            //});
        //}
        scope: {
            callback : '&exampleFunction',
            data : '@dados',
        },
        require: 'ngModel',
        link: function(scope, element, attr, ngModel){
            eval(scope.data);

            //dados="element.bind('change', function() { var arrayKeys = Object.keys(scope.$parent.modal_formTab.tab[0].propsform[3].fields); if (scope.$parent.modal_formTab.tab[0].propsform[3].fields[arrayKeys[arrayKeys.length-1]]==5) { angular.element(document.getElementById('11'))[0].disabled = true; scope.$parent.modal_formTab.tab[0].propsform[4].mandatory=0;} else { angular.element(document.getElementById('11'))[0].disabled = false; scope.$parent.modal_formTab.tab[0].propsform[4].mandatory=1;} scope.$parent.$apply(); });"

            //dados="var arrayKeys = Object.keys(scope.$parent.modal_formTab.tab[0].propsform[3].fields); if (scope.$parent.modal_formTab.tab[0].propsform[3].fields[arrayKeys[arrayKeys.length-1]]==5) { angular.element(document.getElementById('11'))[0].disabled = true; scope.$parent.modal_formTab.tab[0].propsform[4].mandatory=0;} else { angular.element(document.getElementById('11'))[0].disabled = false; scope.$parent.modal_formTab.tab[0].propsform[4].mandatory=1;} scope.$parent.$apply();"
            /*console.log(scope);
            element.bind("change", function() {
                //scope.callback(scope.data);
                var arrayKeys = Object.keys(scope.$parent.modal_formTab.tab[0].propsform[3].fields);
                console.log(scope.$parent.modal_formTab.tab[0].propsform[3].fields[arrayKeys[arrayKeys.length-1]]);
                //eval(scope.data);
                console.log(eval(scope.data));
                console.log(angular.element(document.getElementById('11'))[0]);
            });*/

            /*console.log(element);
            scope.$watch(function (){
                return ngModel.$modelValue;
            }, function (v) {
                console.log('!!!' + v);
                alert(v);
            })*/
            /*element.on("click", function() {
                alert("clicou");
            });*/
            /*element.on("click", function() {
                scope.$apply(function() {
                    var content = $compile(template)(scope);
                    element.append(content);
                })
            });
             element.bind("click",function() {
             scope.$apply(function() {
             callback(data);                        // ...or this way
             });
             });
            */
        }
    };
});