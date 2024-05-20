/**
 * Created by ASUS on 26/05/2017.
 */
app.controller('actionTemplatesController', function($scope, $q, $http, growl, API_URL, $translatePartialLoader, $translate, NgTableParams, MyService, $uibModal) {
    $scope.openModalForm = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalActionTemplates',
            controller: 'ModalInstanceCtrl',
            scope: $scope,
            size: size,
            resolve: {
                action_template_id: function() {
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

    $scope.ModalInstanceCtrl = function ($scope, $uibModalInstance, $timeout, action_template_id, modal_state) {
        $uibModalInstance.opened.then(function() {
            $scope.tinymceOptions = {
                onChange: function(e) {
                    // put logic here for keypress and cut/paste changes
                },
                inline: false,
                branding: false,
                min_height: 300,
                selector: "textarea",
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste template example noneditable"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | example",
                skin: 'lightgray',
                theme : 'modern',
                template_replace_values: {
                    username : "Jack Black",
                    staffid : "991234"
                }
            };

            $scope.tinymceModel = 'Initial content';

            tinymce.PluginManager.add('example', function(editor, url) {
                var selectedText;
                // Add a button that opens a window
                editor.addButton('example', {
                    text: 'Variables',
                    //type: 'menubutton',
                    icon: false,
                    /*menu: [{
                        text: 'Properties',
                        menu: [{
                            type: 'listbox',
                            name: 'type',
                            label: 'Properties',
                            'values': get_properties_list(),
                            tooltip: 'Select the type of panel you want',
                            minHeight:28.4
                        }],
                        onclick: function() {
                            editor.insertContent('&nbsp;<strong>Menu item 1 text inserted here!</strong>&nbsp;');
                        }
                    }, {
                        text: 'Dynamic Search',
                        menu: [{
                            text: 'Submenu item 1',
                            onclick: function() {
                                editor.insertContent('&nbsp;<em>Submenu item 1 text inserted here!</em>&nbsp;');
                            }
                        }]
                    },{
                            text: 'Geral variables',
                            menu: [{
                                text: 'Submenu item 1',
                                onclick: function() {
                                    editor.insertContent('&nbsp;<em>Submenu item 1 text inserted here!</em>&nbsp;');
                                }
                            }]
                    }]*/
                    onclick: function() {
                        // Open window
                        editor.windowManager.open({
                            title: 'Type of Variables',
                            body: [
                                {type: 'textbox', name: 'searchinput', label: 'Search'},
                                {
                                    type: 'listbox',
                                    name: 'variabletype',
                                    label: 'Type',
                                    'values': [{text: 'Properties', value: 0}, {text: 'Geral', value: 1}, {text: 'Dynamic Search', value: 2}],
                                    tooltip: 'Select the type of panel you want',
                                    minHeight:28.4
                                }
                            ],
                            minWidth: 400,
                            onsubmit: function(e) {
                                if ($scope.actiontemplate.action_rule_id === undefined
                                    || $scope.actiontemplate.action_id === undefined
                                )
                                {
                                    growl.error('No options selected!!!', {
                                        ttl: 5000,
                                        title: 'Erro!'
                                    });
                                }
                                else
                                {
                                    editor.windowManager.close();
                                    //console.log($scope.actiontemplate.action_id);
                                    if (e.data.variabletype === 0)
                                    {
                                        $scope.get_properties_list(e.data.searchinput, $scope.actiontemplate.action_id).then(function (response) {
                                            var arrayData = response.data;
                                            var result = [];
                                            for (i = 0; i < arrayData.length; i++) {
                                                var d = {};
                                                d['text'] = arrayData[i].name;
                                                d['value'] = arrayData[i].id;
                                                result.push(d);
                                            }

                                            create_listbox(result);
                                        }, function errorCalback(response) {
                                            growl.error(response.data, {
                                                ttl: 5000,
                                                title: 'Erro!'
                                            });
                                        });
                                    }
                                }
                            }
                        });
                    }
                });

                function create_listbox($values)
                {
                    editor.windowManager.open({
                        title: 'Select a variable',
                        body: [
                            {
                                type: 'listbox',
                                name: 'propertiestype',
                                label: 'Properties',
                                'values': $values,
                                tooltip: 'Select the type of panel you want',
                                minHeight: 28.4,
                                onselect: function (e) {
                                    selectedText = e.target.settings.text;
                                    console.log(e);
                                }
                            }
                        ],
                        minWidth: 400,
                        onsubmit: function (e) {
                            // Insert content when the window form is submitted
                            console.log(e.data.propertiestype + ' ' + selectedText);
                            var propertyText = selectedText;
                            var propertyValue = e.data.propertiestype;
                            editor.insertContent("<span class='variable mceNonEditable'>{" + propertyText + "}<span class='variable_value' style='display: none;'>prop_id:" + propertyValue + "</span></span>");
                        }
                    });
                }


                $scope.get_properties_list = function($search, $action_id)
                {
                    var deferred = $q.defer();

                    $http({
                        method: 'POST',
                        url: API_URL + "act_templates/get_properties_from_action_template/",
                        data: $.param({'search': $search,
                            'action_id': $action_id
                        }),
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


                // Add custom header to XHR request
                tinymce.util.XHR.on('beforeSend', function(e) {
                    e.xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    e.xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                });

                function get_geral_list() {
                    // Sends a low level Ajax request
                    var result = [{text: 'Current Date', value: 'cur_date'},
                        {text: 'Current Time', value: 'cur_time'},
                        {text: 'Current User', value: 'cur_user'}
                    ];
                    return result;
                }

                // Adds a menu item to the tools menu
                editor.addMenuItem('example', {
                    text: 'Example plugin',
                    context: 'tools',
                    onclick: function() {
                        // Open window with a specific url
                        editor.windowManager.open({
                            title: 'TinyMCE site',
                            url: 'https://www.tinymce.com',
                            width: 800,
                            height: 600,
                            buttons: [{
                                text: 'Close',
                                onclick: 'close'
                            }]
                        });
                    }
                });

                return {
                    getMetadata: function () {
                        return  {
                            name: "Example plugin",
                            url: "http://exampleplugindocsurl.com"
                        };
                    }
                };
            });
        });

        var modalstate = modal_state;

        var id = action_template_id;
        $scope.actiontemplate = [];

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD_FORM_NAME";
                break;
            case 'edit':
                $scope.form_title = "EDIT_FORM_NAME";
                $http.get(API_URL + 'act_templates/get_action_template/' + id)
                    .then(function(response) {
                        $scope.actiontemplate = response.data;
                        $scope.getValuesOfAction(response.data.action_rule_id);
                    });
                break;
            default:
                break;
        }

        $scope.save = function() {
            var url = API_URL + "Action_Template";

            if (modalstate === 'edit') {
                url += "/" + id;
            }

            dataParams = { 'action_id': $scope.actiontemplate.action_id,
                    'text': $scope.actiontemplate.text,
                    'type': $scope.actiontemplate.type
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
                $scope.getActionTemplates();
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

        $scope.getValuesOfAction = function(action_rule_id) {
            $http.get(API_URL + "/act_templates/get_actions_from_action_rule/" + action_rule_id, [{cache : true}])
                .then(function (response) {
                    $scope.actions = response.data;
                });
        };

        $scope.cancel = function () {
            $uibModalInstance.close('cancel');
        };
    };

    $scope.getActionTemplates = function() {
        $http.get('/act_templates/get_action_template', [{cache : true}]).then(function(response) {
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
    $scope.getActionTemplates();

    $scope.actionrules = function() {
        $http.get(API_URL + "/act_templates/get_action_rules", [{cache : true}])
            .then(function (response) {
                $scope.action_rules = response.data;
            });
    };
    $scope.actionrules();

    $scope.actiontemplatestypes = function() {
        $http.get(API_URL + "/act_templates/get_action_template_types", [{cache : true}])
            .then(function (response) {
                $scope.types = response.data;
            });
    };
    $scope.actiontemplatestypes();

    $scope.delete = function(id) {
        var url = API_URL + "Acion_Template_del/" + id;

        $http({
            method: 'POST',
            url: url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function (response) {
            growl.success(response.data.message);
            $scope.getActionTemplates();
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