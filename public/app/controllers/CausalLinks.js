/**
 * Created by ASUS on 26/05/2017.
 */
app.controller('CausalLinksController', function($scope, $http, growl, API_URL, MyService, NgTableParams, $uibModal) {
    $scope.openModalForm = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalCausalLinks',
            controller: 'ModalInstanceCtrl',
            scope: $scope,
            size: size,
            //appendTo: parentElem,
            resolve: {
                causal_link_id: function() {
                    return id
                },
                modal_state: function() {
                    return type
                }
            }
        }).result.then(function(reason) {
            $scope.causallink = [];
        }, function(){
            //gets triggers when modal is dismissed.
        });
    };

    $scope.ModalInstanceCtrl = function ($scope, $uibModalInstance, $timeout, causal_link_id, modal_state) {
        var modalstate = modal_state;
        var id = causal_link_id;
        $scope.causallink = [];

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD_FORM_NAME";
                break;
            case 'edit':
                $scope.form_title = "EDIT_FORM_NAME";
                $http.get(API_URL + 'causal_links/get_causal_links/' + id)
                    .then(function(response) {
                        $scope.causallink = response.data;
                    });
                break;
            default:
                break;
        }

        $scope.save = function() {
            var url = API_URL + "Causal_Link";

            //append employee id to the URL if the form is in edit mode
            if (modalstate === 'edit') {
                url += "/" + id;
            }

            $http({
                method: 'POST',
                url: url,
                data: $.param({ 'causing_t' : $scope.causallink.causing_t,
                        't_state_id': $scope.causallink.t_state_id,
                        'caused_t': $scope.causallink.caused_t,
                        'min': $scope.causallink.min,
                        'max' : $scope.causallink.max
                    }
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                //headers: {'Content-Type': 'json'}
            }).then(function (response) {
                growl.success('This is success message.',{title: 'Success!'});
                $scope.getCausalLinks();
                $uibModalInstance.close();
            }, function errorCallback(response) {
                if (response.status == 400)
                {
                    growl.error('This is error message.',{title: 'error!'});
                }
                else
                {
                    $scope.errors = response.data;
                }
                //console.log(response);
            });
        };

        $scope.cancel = function () {
            $uibModalInstance.close('cancel');
        };
    };

    $scope.langs = function() {
        $http.get(API_URL + "/proc_types/get_langs")
            .then(function (response) {
                $scope.langs = response.data;
            });
    };

    $scope.transacstypes = function() {
        $http.get(API_URL + "/ents_types/get_transacs_types")
            .then(function (response) {
                $scope.transactionstype = response.data;
            });
    };

    $scope.tstates = function() {
        $http.get(API_URL + "/ents_types/get_tstates")
            .then(function (response) {
                $scope.tstates = response.data;
            });
    };

    $scope.getCausalLinks = function() {
        $http.get('/causal_links/get_causal_links', [{cache : true}]).then(function(response) {
            $scope.tableParams = new NgTableParams({
                count: 100,
                group: "tp1_causing_t",
                sorting: { id: "desc" }
            }, {
                paginationMaxBlocks: 13,
                paginationMinBlocks: 2,
                dataset: response.data
            });
        });
    };
    $scope.getCausalLinks();

    $scope.transacstypes();
    $scope.langs();
    $scope.tstates();
    //show modal form

    $scope.delete = function(id) {
        var url = API_URL + "Causal_Link_del/" + id;

        $http({
            method: 'POST',
            url: url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            //headers: {'Content-Type': 'json'}
        }).then(function (response) {
            growl.success('This is success message.',{title: 'Success!'});
            $('#myModal').modal('hide');
            $scope.getCausalLinks();
        }, function errorCallback(response) {
            if (response.status == 400)
            {
                growl.error('This is error message.',{title: 'error!'});
            }
            else
            {
                $scope.errors = response.data;
            }
        });
    };

});