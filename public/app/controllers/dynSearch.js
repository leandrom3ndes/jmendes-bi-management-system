/**
 * Created by ASUS on 26/05/2017.
 */
app.controller('dynSearchController', function($scope, $http, growl, API_URL, $translatePartialLoader, $translate, NgTableParams, $uibModal, $timeout) {
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

    $scope.getAllEntTypesWhereHasProps = function() {
        $http.get('/dynamic_search/get_all_ent_types', [{cache : true}]).then(function(response) {
            $scope.entTypes = response.data;
            angular.forEach($scope.entTypes, function(value2, key) {
                var par=false;
                var child = false;
                if (value2.hasOwnProperty('parEntTypes'))
                {
                    par = false;
                }
                else
                {
                    par = true;
                }

                if (value2.hasOwnProperty('childEntTypes'))
                {
                    child = false;
                }
                else
                {
                    child = true;
                }

                if ((value2.hasOwnProperty('childEntTypes') && value2.hasOwnProperty('parEntTypes'))
                || (!value2.hasOwnProperty('childEntTypes') && !value2.hasOwnProperty('parEntTypes')))
                {
                    child = true;
                    par = true;
                }

                var entType = {checked:false, id:value2.id, par: par, child: child, disabled: false };
                $scope.options.push(entType);
                /*$scope.options[key] = false;
                alert($scope.options[value2.id]);*/
            });
            console.log($scope.options);
        });
    };
    $scope.getAllEntTypesWhereHasProps();

    $scope.options = [];
    $scope.disabledContinue = true;
    $scope.toogleEntType = function(index, ent_type) {
        //console.log($scope.options);
        //console.log($scope.options);
        //$scope.state = !$scope.state;
        //console.log($scope.options);

        //var curEntType = $scope.entTypes[index];
        var curEntType = ent_type;
        console.log(curEntType);
        if (curEntType.hasOwnProperty('childEntTypes')) {
            //console.log('current ent type clicked ' + $scope.options[curEntType.id]);
            //debugger;
            //alert($scope.options[index].checked + ' ' + curEntType.id);
            angular.forEach($scope.entTypes, function(value2, key) {
                if (curEntType.id !== value2.id)
                {
                    $scope.options[key].checked = false;
                    $scope.options[key].disabled = false; //para disabilitar tudo na escolha de nova hipótese
                }
            });

            if ($scope.options[index].checked === true)
            {
                /*angular.forEach(curEntType.childEntTypes, function (value2, key1) {
                    const index = $scope.options.findIndex(item => item.id === value2);
                    $scope.options[index].checked = true;
                });*/
                var arrOptions = [];
                angular.forEach($scope.options, function (value, key) {
                    arrOptions.push(value.id);
                });
                var curEntTypeChilds = curEntType.childEntTypes;
                curEntTypeChilds.push(curEntType.id);
                //console.log(arrOptions);
                const sorted = _.differenceBy(arrOptions, curEntTypeChilds);
                //console.log(sorted);
                angular.forEach(sorted, function (value, key) {
                    const index = $scope.options.findIndex(item => item.id === value);
                    $scope.options[index].disabled = true;
                });
            }
        }
        else
        {
            if ($scope.options[index].checked === true) {
                var canAdvance = false;
                var keepGoing = true;
                if (curEntType.hasOwnProperty('parEntTypes'))
                {
                    angular.forEach(curEntType.parEntTypes, function (value1, key1) {
                        if (keepGoing) {
                            var item = $scope.options.filter(function (item) {
                                return item.id === value1;
                            })[0];

                            if (item.checked === true) {
                                keepGoing = false;
                                canAdvance = false;
                            }
                        }
                    });
                }
                else
                {
                    canAdvance = true;
                }

                if (keepGoing)
                {
                    canAdvance = true;
                }

                if (canAdvance === true)
                {
                    angular.forEach($scope.entTypes, function (value2, key) {
                        if (curEntType.id !== value2.id) {
                            $scope.options[key].checked = false;
                        }
                    });
                }
            }
        }

        //$scope.disabledContinue = $scope.options.indexOf(true) === -1;
        $scope.disabledContinue = $scope.options.findIndex(item => item.checked === true) === -1;

        var items = $scope.options.filter(function (item) {
            return item.checked === true;
        });
        var data = { entTypes: items};
        $http({
            method: 'POST',
            url: API_URL + '/dynamic_search/get_all_props_from_ent_types',
            data: data
        }).then(function (response) {
            $scope.propsFromEntTypes = response.data;
        }, function errorCallback(response) {

        });
    };

    $scope.tabs = [];
    $scope.addTab = function($title, $templateurl) {
        $scope.tabs.push({
            title: $title,
            templateUrl: $templateurl,
            disabled: false
        });

        $timeout(function(){
            $scope.activeTabIndex = ($scope.tabs.length - 1);
        });
    };
    /*$scope.mycur_tab = 0;
    $scope.mynext_tab = $scope.mycur_tab + 1;*/ /*not needeed*/
    $scope.addTab('First Step', 'tabSelEntTypesFirstStep');
    $scope.nextTabContinue = function($cur_tab, $next_tab, $title, $templateurl) {
        //$scope.tabs[$cur_tab].disabled = true;
        $scope.tabs.splice($next_tab, 1);

        if ($cur_tab === 0)
        {
            var items = $scope.options.filter(function (item) {
                return item.checked === true;
            });
            var data = { entTypes: $scope.propsFromEntTypes};
            console.log($scope.propsFromEntTypes);
            $http({
                method: 'POST',
                url: API_URL + '/dynamic_search/get_results_from_query',
                data: data
            }).then(function (response) {
                $scope.mydata = response.data;
                $scope.addTab($title, $templateurl);
            }, function errorCallback(response) {

            });
        }
    };

    $scope.checkboxes = [];
    $scope.changeEntTypePar = function($index, $type, $open) {
        if ($open === true)
        {
            if ($type === 1) {
                if ($scope.checkboxes[$index] !== true)
                    $scope.checkboxes[$index] = !$scope.checkboxes[$index];
                console.log("teste ", $scope.checkboxes[$index]);
            }

            $scope.propsFromEntTypes.entTypePar[0].properties[$index].statusChecked = $scope.checkboxes[$index];
            console.log("seleccionado ", $scope.propsFromEntTypes);
        }
    }

    /*$scope.getProcsTypes = function() {
        $http.get('/proc_types/get_proc', [{cache : true}]).then(function(response) {
            $scope.tableParams = new NgTableParams({
                count: 2,
                sorting: { id: "asc" }
            }, {
                paginationMaxBlocks: 13,
                paginationMinBlocks: 2,
                dataset: response.data
            });
        });
    };
    $scope.getProcsTypes();*/

    /*$scope.delete = function(id) {
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
    };*/
});
