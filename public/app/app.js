/**
 * Created by ASUS on 26/05/2017.
 */
var app = angular.module('umaeeteam', ['angular-growl','ui.sortable','pascalprecht.translate','ngTable','ui.select','ngSanitize','ui.bootstrap','ngAnimate','angular-loading-bar','angularFileUpload', 'ngMessages', 'froala', 'textAngular', 'ui.tinymce'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
})
    .constant('API_URL','http://localhost:8000/');

app.config(['growlProvider', function (growlProvider) {
    growlProvider.globalTimeToLive({success: 3000, error: 10000, warning: 3000, info: 4000});
}]);

app.config(['$httpProvider', function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
}]);

app.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = false;
    cfpLoadingBarProvider.includeBar = true;
    cfpLoadingBarProvider.loadingBarTemplate = '<div id="loading-bar"><img style="width:10%" src="http://localhost:8000/91.gif" /></div>';
}]);

app.service('MyService', function ($http, $q, API_URL) {
    return {
        filter: function(params) {
            for (i=0; i<params.length; i++) {
                if (params[i])
                {
                    return true;
                }
            }
            return false;
        },
        verifyCanDoNextTransState: function($id,$t_state_id,$actorCan, $title, $templateurl, $trans_type_id) {
            var deferred = $q.defer();
            $http({
                method: 'POST',
                url: API_URL + "/dashboard/verify_can_do_next_trans_state/" + $id,
                data: $.param({ 't_state_id' : $t_state_id,
                        'actorCan': $actorCan
                    }
                ),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                //headers: {'Content-Type': 'json'}
            }).then(function (response) {
                deferred.resolve(response);
            }).catch(function(response){
                deferred.reject(response);
            });

            return deferred.promise;
        }
    };
});



app.config(function($translateProvider, $translatePartialLoaderProvider) {
    //$translateProvider.useMissingTranslationHandlerLog();
    /*$translateProvider.translations('en', {
        "Page_Name" : "Geweldige Whatsapp gesprekken.",
    });*/
    //$translatePartialLoaderProvider.addPart('main');
    $translateProvider.useLoader('$translatePartialLoader', {
        urlTemplate: 'translations/{lang}/{part}.json',
        loadFailureHandler: 'MyErrorHandler',
        $http: { cache: true }
    });
    $translateProvider.preferredLanguage('en');
    $translateProvider.useLoaderCache(true);
});

app.run(function ($rootScope, $translate) {
    $rootScope.$on('$translatePartialLoaderStructureChanged', function () {
        $translate.refresh();
    });
});

app.factory('MyErrorHandler', function ($q, $log) {
    return function (part, lang, response) {
        $log.error('The "' + part + '/' + lang + '" part was not loaded.');
        return $q.when({});
    };
});

app.filter('propsFilter', function() {
    return function(items, props) {
        var out = [];

        if (angular.isArray(items)) {
            var keys = Object.keys(props);

            items.forEach(function(item) {
                var itemMatches = false;

                for (var i = 0; i < keys.length; i++) {
                    var prop = keys[i];
                    var text = props[prop].toLowerCase();
                    if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
                        itemMatches = true;
                        break;
                    }
                }

                if (itemMatches) {
                    out.push(item);
                }
            });
        } else {
            // Let the output be the input untouched
            out = items;
        }

        return out;
    };
});

app.directive('emitLastRepeaterElement', function() {
    return function(scope) {
        if (scope.$last){
            scope.$emit('LastRepeaterElement');
        }
    };
});

app.config(['$compileProvider', function ($compileProvider) {
    // disable debug info
    $compileProvider.debugInfoEnabled(true);
}]);

app.config(function ($httpProvider) {
    $httpProvider.useApplyAsync(true);
});

app.factory('Resource', ['$q', '$filter', '$timeout', '$http', function ($q, $filter, $timeout, $http) {

    var randomsItems = [];

    function getRandomsItems(cb) {
        return $http.get('/ents_types/get_ents_types', {cache: 'true'}).then(function(randomsItems) {
            cb(randomsItems.data);
        });
    }

    //fake call to the server, normally this service would serialize table state to send it to the server (with query parameters for example) and parse the response
    //in our case, it actually performs the logic which would happened in the server
    function getPage(start, number, params) {

        var result;
        var totalRows;

        getRandomsItems(function cb(randomsItems) {
            var filtered = params.search.predicateObject ? $filter('customFilter')(randomsItems, params.search.predicateObject) : randomsItems;
            console.log("Filtro:" + JSON.stringify(params.search.predicateObject));

            if (params.sort.predicate) {
                filtered = $filter('orderBy')(filtered, params.sort.predicate, params.sort.reverse);
            }

            result = filtered.slice(start, start + number);
            totalRows = randomsItems.length;

            /*console.log("Result : " + JSON.stringify(result));
            console.log("Total Rows : " + JSON.stringify(totalRows));*/
        });


        var deferred = $q.defer();

        $timeout(function () {

            deferred.resolve({
                data: result,
                numberOfPages: Math.ceil(totalRows / number)
            });

        }, 1500);

        return deferred.promise;

    }

    return {
        getPage: getPage
    };

}]);
