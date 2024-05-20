/**
 * Created by ASUS on 26/05/2017.
 */
app.controller('WaitingLinksController', function($scope, $http, growl, API_URL, NgTableParams, $uibModal) {
    $scope.openModalForm = function (size, id, type) {
        var modalInstance = $uibModal.open({
            animation: true,
            ariaLabelledBy: 'modal-title',
            ariaDescribedBy: 'modal-body',
            templateUrl: 'modalWaitingLinks',
            controller: 'ModalInstanceCtrl',
            scope: $scope,
            size: size,
            //appendTo: parentElem,
            resolve: {
                waiting_link_id: function() {
                    return id
                },
                modal_state: function() {
                    return type
                }
            }
        }).result.then(function(reason) {
            $scope.waitinglink = [];
        }, function(){
            //gets triggers when modal is dismissed.
        });
    };

    $scope.ModalInstanceCtrl = function ($scope, $uibModalInstance, $timeout, waiting_link_id, modal_state) {
        var modalstate = modal_state;
        var id = waiting_link_id;
        $scope.waitinglink = [];

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD_FORM_NAME";
                break;
            case 'edit':
                $scope.form_title = "EDIT_FORM_NAME";
                $http.get(API_URL + 'waiting_links/get_waiting_links/' + id)
                    .then(function(response) {
                        $scope.waitinglink = response.data;
                    });
                break;
            default:
                break;
        }

        //save new record / update existing record
        $scope.save = function() {
            var url = API_URL + "Waiting_Link";

            //append employee id to the URL if the form is in edit mode
            if (modalstate === 'edit') {
                url += "/" + id;
            }

            $http({
                method: 'POST',
                url: url,
                data: $.param({ 'waited_t' : $scope.waitinglink.waited_t.id,
                        'waited_act': $scope.waitinglink.waited_act.id,
                        'waiting_act': $scope.waitinglink.waiting_act.id,
                        'waiting_t': $scope.waitinglink.waiting_t.id,
                        'min': $scope.waitinglink.min,
                        'max' : $scope.waitinglink.max
                    }
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                //headers: {'Content-Type': 'json'}
            }).then(function (response) {
                growl.success('This is success message.',{title: 'Success!'});
                $scope.getWaitingLinks();
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

    $scope.tableParams = null;
    $scope.getWaitingLinks = function() {
        $http.get('/waiting_links/get_waiting_links', [{cache : true}]).then(function(response) {
            $scope.tableParams = new NgTableParams({
                count: 100,
                group: "tp1_waited_t",
                sorting: { id: "desc" }
            }, {
                paginationMaxBlocks: 13,
                paginationMinBlocks: 2,
                dataset: response.data
            });
        });
    };
    $scope.getWaitingLinks();

    $scope.transacstypes();
    $scope.langs();
    $scope.tstates();

    $scope.delete = function(id) {
        var url = API_URL + "Waiting_Link_del/" + id;

        $http({
            method: 'POST',
            url: url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            //headers: {'Content-Type': 'json'}
        }).then(function (response) {
            growl.success('This is success message.',{title: 'Success!'});
            $('#myModal').modal('hide');
            $scope.getWaitingLinks();
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