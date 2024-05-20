/**
 * Created by ASUS on 26/05/2017.
 */
app.controller('actionRulesController', function($scope, $http, growl, API_URL, $translatePartialLoader, $translate, NgTableParams, MyService, $uibModal) {
    $scope.blockly = function(id) {
        window.location = "/blocklynewpage?id=" + id;
    };

    $scope.openModalForm = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalActionRules',
            controller: 'ModalInstanceCtrl',
            scope: $scope,
            size: size,
            resolve: {
                action_rule_id: function() {
                    return id
                },
                modal_state: function() {
                    return type
                }
            }
        }).result.then(function(reason) {
            //Get triggers when modal is closed
            //alert(reason);
            $scope.transactiontype = [];
        }, function(){
            //gets triggers when modal is dismissed.
        });
    };

    $scope.ModalInstanceCtrl = function ($scope, $uibModalInstance, $timeout, action_rule_id, modal_state) {
        var modalstate = modal_state;

        var id = action_rule_id;
        $scope.actionrule = [];

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD_FORM_NAME";
                break;
            case 'edit':
                $scope.form_title = "EDIT_FORM_NAME";
                $http.get(API_URL + 'act_rules/get_action_rule/' + id)
                    .then(function(response) {
                        $scope.actionrule = response.data;
                    });
                break;
            default:
                break;
        }

        $scope.save = function() {
            var url = API_URL + "Action_Rule";

            if (modalstate === 'edit') {
                url += "/" + id;
            }

            dataParams = { 'transaction_type_id': $scope.actionrule.transaction_type_id,
                    't_state_id': $scope.actionrule.t_state_id
            };


            $http({
                method: 'POST',
                url: url,
                data: $.param(dataParams
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                growl.success(response.data.message);
                $scope.cancel();
                $scope.getActionRules();
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

    $scope.getActionRules = function() {
        $http.get('/act_rules/get_action_rule', [{cache : true}]).then(function(response) {
            $scope.tableParams = new NgTableParams({
                count: 100,
                group: "transaction_type_name",
                sorting: { id: "desc" }
            }, {
                paginationMaxBlocks: 13,
                paginationMinBlocks: 2,
                dataset: response.data
            });
        });
    };
    $scope.getActionRules();

    $scope.transactiontypes = function() {
        $http.get(API_URL + "/act_rules/get_transaction_types", [{cache : true}])
            .then(function (response) {
                $scope.transactiontypes = response.data;
            });
    };
    $scope.transactiontypes();

    $scope.tstates = function() {
        $http.get(API_URL + "/act_rules/get_t_states", [{cache : true}])
            .then(function (response) {
                $scope.tstates = response.data;
            });
    };
    $scope.tstates();

    $scope.delete = function(id) {
        var url = API_URL + "Transaction_Type_del/" + id;

        $http({
            method: 'POST',
            url: url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {
            growl.success(response.data.message);
            $scope.getTransacsTypes();
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





    $scope.openModalFormActions = function (size, id, type, par_action_id) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalActions',
            controller: 'ModalInstanceCtrlActions',
            scope: $scope,
            size: size,
            resolve: {
                action_rule_id: function() {
                    return id
                },
                modal_state: function() {
                    return type
                },
                par_action : function() {
                    return par_action_id
                }
            }
        }).result.then(function(reason) {
            //Get triggers when modal is closed
            //alert(reason);
            $scope.transactiontype = [];
        }, function(){
            //gets triggers when modal is dismissed.
        });
    };

    $scope.sortableOptions = {
        'update': function(e, ui) {
            var url = API_URL + "action/update_order_of_actions";

            $http({
                method: 'POST',
                url: url,
                data: $.param({ 'action_id' : ui.item.sortable.model.id,
                        'action_new_order': ui.item.sortable.dropindex+1, //foi adicionado o +1, duvida, testar
                        'action_old_order': ui.item.sortable.index+1
                    }
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                growl.success('This is success message.',{title: 'Success!'});
            }, function errorCallback(response) {

            });
        }
    };
    $scope.tinymceOptions = {
        onChange: function(e) {
            // put logic here for keypress and cut/paste changes
        },
        inline: false,
        //plugins : 'advlist autolink link image lists charmap print preview table',
        selector: "textarea",
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table contextmenu paste"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        skin: 'lightgray',
        theme : 'modern'
    };

    $scope.tinymceModel = 'Initial content';
    $scope.ModalInstanceCtrlActions = function ($scope, $uibModalInstance, $timeout, action_rule_id, modal_state, par_action) {

        //tudo num só
        /*$scope.actions = [{id: 'choice1', name: 'choice1', expressions: [], childs: []}];
        $scope.addNewActionForm = function($index, $action) {
            var newItemNo = $scope.actions.length+1;
            if ($action.flow_type === 'If')
            {
                $scope.actions.splice($index + 1, 0, {'id' : 'choice' + newItemNo, 'name' : 'choice' + newItemNo, expressions: []});
                $scope.actions.splice($index + 2, 0, {'id' : 'choice' + newItemNo, 'name' : 'choice' + newItemNo, expressions: []});
                $scope.actions[$index+1].then_else = 'then';
                $scope.actions[$index+2].then_else = 'else';
                $scope.actions[$index].expressions.push({'id' : 'choice' + newItemNo});
            }
            else
            {
                $scope.actions.splice($index + 1, 0, {'id' : 'choice' + newItemNo, 'name' : 'choice' + newItemNo, expressions: []});
            }

            console.log($scope.actions);
        };

        $scope.removeActionForm = function(index) {
            var newItemNo = $scope.actions.length-1;
            if ( newItemNo !== 0 ) {
                $scope.actions.splice(index, 1);
            }
        };

        $scope.addNewExpressionForm = function($parent_index, $index, $expression) {
            var newItemNo = $scope.actions[$parent_index].expressions.length+1;
            $scope.actions[$parent_index].expressions.splice($index + 1, 0, {'id' : 'choice' + newItemNo});
        };*/
        //end - tudo num só

        $scope.FORM_NAME = 'Add/Edit Actions';
        if (par_action !== 0)
        {
            $scope.FORM_NAME = 'Add/Edit Sub Actions';
        }

        $scope.action = {};
        $scope.action.expressions = {};
        $scope.action.conditions = [];
        $scope.action.c_act = {};
        console.log("teste", $scope.action);

        $scope.compExpTypes = [ { id: 1, name: 'Property to Property'},
                                    { id: 2, name: 'Property to Value'} ];

        $scope.addExpressionType = function($action) {
            //var newItemNo = $scope.action.expressions.length+1;

            if ($action.flow_type === 'If' || $action.flow_type === 'While')
            {
                if ($scope.action.conditions.length === 0)
                    $scope.action.conditions.push({expression:{}});
                    console.log("scope action expression", $scope.action);
            }

            console.log($scope.action);
        };

        $scope.addNewExpressionForm = function($index) {
            var newItemNo = $scope.action.conditions.length+1;
            $scope.action.conditions.splice($index + 1, 0, {expression:{}});
        };

        $scope.removeExpressionForm = function($index) {
            var newItemNo = $scope.action.conditions.length-1;
            if ( newItemNo !== 0 ) {
                $scope.action.conditions.splice($index, 1);
            }
        };

        $scope.showOptionsExpressions = function(expression) {
            if ($scope.action.conditions.length === 0)
                return false;
            return expression.id === $scope.action.conditions[$scope.action.conditions.length-1].id;
        };

        $scope.changeTypeExpression = function(type)
        {
            console.log("TYPE EXPRESSION", $scope.action.typeArCond);
            $scope.action.typeArCond = type;
        };

        $scope.getFlowtypes = function() {
            $http.get(API_URL + "/actions/get_flow_types", [{cache : true}])
                .then(function (response) {
                    $scope.flowtypes = response.data;
                });
        };
        $scope.getFlowtypes();

        $scope.getTypes = function() {
            $http.get(API_URL + "/actions/get_types", [{cache : true}])
                .then(function (response) {
                    $scope.types = response.data;
                });
        };
        $scope.getTypes();

        $scope.getOperators = function() {
            $http.get(API_URL + "/actions/get_operators", [{cache : true}])
                .then(function (response) {
                    $scope.operators = response.data;
                });
        };
        $scope.getOperators();

        $scope.getArconditions_types = function() {
            $http.get(API_URL + "/actions/get_arconditions_types", [{cache : true}])
                .then(function (response) {
                    $scope.arcondition_types = response.data;
                });
        };
        $scope.getArconditions_types();

        $scope.getProperties = function() {
            $http.get(API_URL + "/actions/get_properties", [{cache : true}])
                .then(function (response) {
                    $scope.properties = response.data;
                });
        };
        $scope.getProperties();

        //quando é atomic e c-act
        $scope.getTransactionsTypes = function() {
            $http.get(API_URL + "transacs_types/get_transacs_types/", [{cache : true}])
                .then(function (response) {
                    $scope.transactiontypes = response.data;
                });
        };
        $scope.getTransactionsTypes();

        $scope.getTStates = function() {
            $http.get(API_URL + "t_states/get_t_state/", [{cache : true}])
                .then(function (response) {
                    $scope.tstates = response.data;
                });
        };
        $scope.getTStates();
        //******************************************************************************

        //refazer já não é enviado o objecto completo
        $scope.getValuesOfProperty = function(property_id, index_condition, flow_type) {
            //alert(index_expression);
            if (flow_type === 0)
            {
                if (property_id.value_type === 'prop_ref' || property_id.value_type === 'enum') {
                    $http.get(API_URL + "/actions/get_values_of_property/" + property_id.id, [{cache: true}])
                        .then(function (response) {
                            $scope.action.conditions[index_condition].expression.values = response.data;
                        });
                }
            }
            else
            {
                if (property_id.value_type === 'prop_ref' || property_id.value_type === 'enum') {
                    $http.get(API_URL + "/actions/get_values_of_property/" + property_id.id, [{cache: true}])
                        .then(function (response) {
                            $scope.action.expressions.values = response.data;
                        });
                }
            }
        };

        var modalstate = modal_state;

        var id = action_rule_id;

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD_FORM_NAME";
                break;
            case 'edit':
                $scope.form_title = "EDIT_FORM_NAME";
                $http.get(API_URL + 'actions/get_action_from_action_rule/' + id)
                    .then(function(response) {
                        //re fazer
                        console.log("actions", $scope.actions);
                        $scope.action.flow_type = response.data.flow_type;
                        $scope.action.type = response.data.type;

                        if ($scope.action.flow_type === 'If' || $scope.action.flow_type === 'While') {
                            if (response.data.ar_conditions.length > 1)
                            {
                                var typeCond = response.data.ar_conditions[1].type;
                            }
                            var typeInfComp = response.data.ar_conditions[0].type;
                            $scope.action.typeArCond = (typeInfComp === 'Informal Expression' ? 1 : 0);

                            angular.forEach(response.data.ar_conditions, function (value, key) {
                                $scope.action.conditions.push({expression:{}});
                                console.log("teste_saida", $scope.action);
                                if (response.data.ar_conditions.length > 1 && key + 1 < response.data.ar_conditions.length) {
                                    $scope.action.conditions[key].arcondition_type = response.data.ar_conditions[key + 1].type;
                                }

                                if (typeInfComp === 'Informal Expression') {
                                    $scope.action.conditions[key].expression.string = value.informal_expressions[0].string;
                                }
                                else {
                                    $scope.action.conditions[key].expression.property_id1 = value.comp_expressions[0].property1;
                                    $scope.getValuesOfProperty($scope.action.conditions[key].expression.property_id1, 0, 1);

                                    $scope.action.conditions[key].expression.operator = value.comp_expressions[0].operator;

                                    if (value.comp_expressions[0].property_id2 !== null)
                                    {
                                        $scope.action.conditions[key].expression.compute_exp_type = 1;
                                        $scope.action.conditions[key].expression.property_id2 = value.comp_expressions[0].property2;
                                    }
                                    else
                                    {
                                        $scope.action.conditions[key].expression.compute_exp_type = 2;
                                        if (value.comp_expressions[0].value1 !== null)
                                        {
                                            $scope.action.conditions[key].expression.value = value.comp_expressions[0].value1;
                                        }
                                        else
                                        {
                                            $scope.action.conditions[key].expression.value = value.comp_expressions[0].value_id1;
                                        }
                                    }
                                }

                            });
                        }
                        else if ($scope.action.flow_type === 'Atomic' && $scope.action.type === 'c-act')
                        {
                            if (response.data.causal_link !== null)
                            {
                                $scope.action.c_act.transactiontype = response.data.causal_link[0].caused_action_rule.transaction_type_id;
                                $scope.action.c_act.t_state = response.data.causal_link[0].caused_action_rule.t_state_id;
                                $scope.action.c_act.min = response.data.causal_link[0].min;
                                $scope.action.c_act.max = response.data.causal_link[0].max;
                            }
                        }
                        else if ($scope.action.flow_type === 'Atomic' && $scope.action.type !== 'spec_data' && $scope.action.type !== 'prod_doc')
                        {
                            var typeInfComp;
                            if (response.data.comp_expressions !== null)
                                typeInfComp = 'Compute Expression';
                            else
                                typeInfComp = 'Informal Expression';

                            $scope.action.typeArCond = (typeInfComp === 'Informal Expression' ? 1 : 0);

                            if (typeInfComp === 'Informal Expression')
                            {

                            }
                            else
                            {
                                $scope.action.expressions.property_id1 = response.data.comp_expressions[0].property1;
                                $scope.getValuesOfProperty($scope.action.expressions.property_id1, 0, 1);

                                $scope.action.expressions.operator = response.data.comp_expressions[0].operator;

                                if (response.data.comp_expressions[0].property_id2 !== null)
                                {
                                    $scope.action.expressions.compute_exp_type = 1;
                                    $scope.action.expressions.property_id2 = response.data.comp_expressions[0].property2;
                                }
                                else
                                {
                                    $scope.action.expressions.compute_exp_type = 2;
                                    if (response.data.comp_expressions[0].value1 !== null)
                                    {
                                        $scope.action.expressions.value = response.data.comp_expressions[0].value1;
                                    }
                                    else
                                    {
                                        $scope.action.expressions.value = response.data.comp_expressions[0].value_id1;
                                    }
                                }
                            }
                        }
                    });
                break;
            default:
                break;
        }

        function arrayCleaningSave()
        {
            //limpeza do array para envio
            if ($scope.action.flow_type === 'Atomic' && $scope.action.type === 'c-act')
            {
                $scope.action.conditions = [];
                $scope.action.expressions = {};
            }
            else if ($scope.action.flow_type === 'Atomic' && $scope.action.type !== 'c-act')
            {
                $scope.action.conditions = [];
                $scope.action.c_act = {};

                //apagar chaves quando é seleccionado property to property ou property to value
                if ($scope.action.expressions.compute_exp_type === 1)
                {
                    delete $scope.action.expressions.values;
                    delete $scope.action.expressions.value;
                }
                else
                {
                    delete $scope.action.expressions.property_id2;
                }
            }
            else if ($scope.action.flow_type === 'If' || $scope.action.flow_type === 'While')
            {
                $scope.action.expressions = {};
                $scope.action.c_act = {};

                if ($scope.action.typeArCond === 0)
                {
                    angular.forEach($scope.action.conditions, function(value, key) {
                        delete value.expression.string;

                        //analisar esta situação
                        //se a propriedade não é de nenhum destes tipos apagar a key que pode existir anteriormente
                        if (!(value.expression.property_id1.value_type === 'enum' || value.expression.property_id1.value_type === 'prop_ref'))
                        {
                            delete value.expression.values;
                        }

                        //apagar chaves quando é seleccionado property to property ou property to value
                        if (value.expression.compute_exp_type === 1)
                        {
                            delete value.expression.values;
                            delete value.expression.value;
                        }
                        else
                        {
                            delete value.expression.property_id2;
                        }
                    });
                }
                else
                {
                    angular.forEach($scope.action.conditions, function(value, key) {
                        delete value.expression.value;
                        delete value.expression.operator;
                        delete value.expression.values;
                        delete value.expression.value;
                        delete value.expression.property_id1;
                        delete value.expression.property_id2;
                    });
                }
            }
        }

        $scope.save = function() {
            arrayCleaningSave();
            console.log("save", $scope.action);

            var url = API_URL + "Action";

            if (modalstate === 'edit') {
                url += "/" + id;
            }

            dataParams = { 'action': $scope.action,
                            'action_rule_id' : action_rule_id,
                            'par_action_id' : par_action
            };


            $http({
                method: 'POST',
                url: url,
                data: dataParams,
                headers: {'Content-Type': 'application/json'}
            }).then(function (response) {
                growl.success(response.data.message);
                $scope.cancel();
                $scope.getActionRules();
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

    $scope.getActionRules = function() {
        $http.get('/act_rules/get_action_rule', [{cache : true}]).then(function(response) {
            $scope.tableParams = new NgTableParams({
                count: 100,
                group: "transaction_type_name",
                sorting: { id: "desc" }
            }, {
                paginationMaxBlocks: 13,
                paginationMinBlocks: 2,
                dataset: response.data
            });
        });
    };
    $scope.getActionRules();

    $scope.transactiontypes = function() {
        $http.get(API_URL + "/act_rules/get_transaction_types", [{cache : true}])
            .then(function (response) {
                $scope.transactiontypes = response.data;
            });
    };
    $scope.transactiontypes();

    $scope.tstates = function() {
        $http.get(API_URL + "/act_rules/get_t_states", [{cache : true}])
            .then(function (response) {
                $scope.tstates = response.data;
            });
    };
    $scope.tstates();

    $scope.delete = function(id) {
        var url = API_URL + "Transaction_Type_del/" + id;

        $http({
            method: 'POST',
            url: url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {
            growl.success(response.data.message);
            $scope.getTransacsTypes();
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


    $scope.openModalViewActions = function (size, id) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalViewActions',
            controller: 'ModalInstanceCtrlViewActions',
            scope: $scope,
            size: size,
            resolve: {
                action_rule_id: function() {
                    return id
                }
            }
        }).result.then(function(reason) {
            //Get triggers when modal is closed
            //alert(reason);
            $scope.transactiontype = [];
        }, function(){
            //gets triggers when modal is dismissed.
        });
    };

    $scope.ModalInstanceCtrlViewActions = function ($scope, $uibModalInstance, $timeout, action_rule_id) {
        var id = action_rule_id;
        $scope.getActionsFromActionRule = function() {
            $http.get('/actions/get_actions_from_action_rule/' + id, [{cache : true}]).then(function(response) {
                $scope.actionsFromAR = response.data;
            });
        };
        $scope.getActionsFromActionRule();


        $scope.openModalFormAddNewAction = function($par_action_id) {
            $scope.cancel();
            $scope.openModalFormActions('lg', id, '', $par_action_id);
        };

        $scope.openModalFormEditAction = function($id) {
            //$scope.cancel();
            $scope.openModalFormActions('lg', $id, 'edit', 0);
        };

        $scope.cancel = function () {
            $uibModalInstance.close('cancel');
        };

    };
});