app.controller('dynamicSearchControllerJs', function($scope, $http, growl, API_URL, $translatePartialLoader, $translate, NgTableParams, MyService, $uibModal, $timeout) {

    $scope.entities = [];
    $scope.ents = [];
    $scope.operators = [];
    $scope.propAllowedValues = [];
    $scope.fkEnt = [];
    $scope.entRefs = [];
    $scope.propsOfEnts = [];
    $scope.relsWithEnt = [];
    $scope.entsRelated = [];
    $scope.propsEntRelated = [];
    $scope.information = [];
    $scope.resultDynamincSearch = [];
    //Porque vou precisar do id da ent_Type no método inactiveActive
    $scope.idEntityType = [];
    $scope.state = [];
    $scope.propRefs = [];
    $scope.formData = [];
    $scope.query_name = [];
    $scope.dataCondition = [];

    $scope.getEntities = function () {

        $http.get('/dynamicSearch/entities').then(function(response) {
            $scope.entities = response.data;
            console.log($scope.entities);
        });
    };

    $scope.getEntitiesData = function (id) {

        console.log(id);

        $http.get(API_URL + '/dynamicSearch/entity/' + id)
        .then(function(response) {
            $scope.ents = response.data;
            $scope.getPropertiesQuery('ET');
            console.log('Get Entities Data: ');
            console.log($scope.ents);
        });
    };

    $scope.getPropertiesQuery = function (tableType) {
        var idQuery = $("#idQuery").val();

        if (idQuery != null && idQuery != undefined && idQuery != "") {

            $http.get(API_URL + '/dynamicSearch/getPropertiesQuery/' + idQuery + '/' + tableType).then(function(response) {
                $scope.dataCondition = response.data;
                console.log("data Condition");
                console.log($scope.dataCondition);

                dataCondition = $scope.dataCondition;

                for (var i = 0; i < dataCondition.length; i++) {
                    
                    var idProp  = dataCondition[i].property.id,
                        idTable = "";

                    console.log("O ID DA PROP É : " + idProp);

                    if (tableType == "ET") {
                        idTable = "table1";
                    } else if (tableType == "VT") {
                        idTable = "table2";
                    } else if (tableType == "RL") {
                        idTable = "table3";
                    } else if (tableType == "ER") {
                        idTable = "table4";
                    }

                    var keyProp = $("#" + idTable).find("#key" + tableType + "" + idProp).val();

                    //da tabela x vou encontrar os checkbox que tem como value o id da prop e selecionar essas props
                    $("#" + idTable).find("[type=checkbox][name=check" + tableType + keyProp + "]").prop("checked", true);

                    //Conforme o value type preencher os dados
                    if (dataCondition[i].property.value_type == "text") {
                        $("#" + idTable).find("[name=text" + tableType + keyProp + "]").val(dataCondition[i].value);

                    } else if (dataCondition[i].property.value_type == "int") {
                        var idOperator  = dataCondition[i].operator_id;
                        $("#" + idTable).find("[name=operators" + tableType + keyProp + "] option[value='"+idOperator+"']").prop("selected", "selected");

                        $("#" + idTable).find("[name=int" + tableType + keyProp + "]").val(dataCondition[i].value);

                    } else if (dataCondition[i].property.value_type == "double") {
                        var idOperator  = dataCondition[i].operator_id;
                        $("#" + idTable).find("[name=operators" + tableType + keyProp + "] option[value='"+idOperator+"']").prop("selected", "selected");

                        $("#" + idTable).find("[name=double" + tableType + keyProp + "]").val(dataCondition[i].value);

                    } else if (dataCondition[i].property.value_type == "enum") {

                        var valueEnum = dataCondition[i].id_values;
                        console.log("Valor enum: " + valueEnum);

                        $("#" + idTable).find("[name=select" + tableType + keyProp + "] option[value='"+valueEnum+"']").prop("selected", "selected");

                    } else if (dataCondition[i].property.value_type == "bool") {
                        var valueRadio = dataCondition[i].id_values;
                        console.log("Valor radio: " + valueRadio);
                        $("#" + idTable).find("[name=radio" + tableType + keyProp + "][value='"+valueRadio+"']").prop("checked", true);
                    } else if (dataCondition[i].property.value_type == "file") {
                        $("#" + idTable).find("[name=file" + tableType + keyProp + "]").val(dataCondition[i].value);

                    } else if (dataCondition[i].property.value_type == "prop_ref") {
                        $("#" + idTable).find("[name=propRef" + tableType + keyProp + "]").val(dataCondition[i].id_values);
                    }
                }

                $scope.clickTable1();
                $scope.clickTable2();
                $scope.clickTable3();
                $scope.clickTable4();

                var searchExist = $("#idSearch").val();

                if (searchExist != null && searchExist != undefined && searchExist != "" && searchExist == 1) {

                    if (tableType == "ER") {
                        console.log("TESTEE: " + $("#showResultButton").length);
                        
                        setTimeout(function() {
                            $("#showResultButton").trigger("click");
                        }, 100);
                    }
                }
            });
        }
    };

    $scope.getOperators = function () {

        $http.get('/dynamicSearch/getOperators').then(function(response) {
            $scope.operators = response.data;
            console.log($scope.operators);
        });
    };

    $scope.getOperators();

    $scope.getEnumValues = function (id) {

        $http.get(API_URL + '/dynamicSearch/getEnumValues/' + id).then(function(response) {
            $scope.propAllowedValues[id] = response.data;
            console.log("Prop Allowed value");
            console.log($scope.propAllowedValues);
        });
    };

    $scope.getEntityInstances = function (entityId, propId) {

        console.log("getEntityInstances: o id da Entity é " + entityId + " e o id da prop é: " + propId);

        $http.get(API_URL + '/dynamicSearch/getEntityInstances/' + entityId + '/' + propId).then(function(response) {
            $scope.fkEnt[propId] = response.data[0];
            console.log("Dados instancias getEntityInstances");
            console.log($scope.fkEnt);
        });
    };

    $scope.getEntRefs = function (id) {

        $http.get(API_URL + '/dynamicSearch/getEntRefs/' + id).then(function(response) {
            $scope.entRefs = response.data;
            console.log("Dados das ent refs");
            console.log($scope.entRefs);
        });
    };

    $scope.getPropRefs = function (id) {

        $http.get(API_URL + '/dynamicSearch/getPropRefs/' + id).then(function(response) {
            $scope.entRefs = response.data;
            $scope.getPropertiesQuery('VT');
            console.log("Dados das prop refs");
            console.log($scope.entRefs);
        });
    };


    $scope.clickTable1 = function ($event) {
        // Verificar se existe alguma checkbox selecionada na tabela 1
        var existeChecked = false;
        $("#table1").find("[type=checkbox]").each(function(index) {
            if ($(this).is(":checked")) {
                existeChecked = true;
                return;
            }
        });

        // Se existir, então vamos desbloquear todos os campos da tabela 2, 3 e 4.
        // Caso contrario, bloquear.
        if (existeChecked) {
            $("#checkRL").find("[type=checkbox], [type=text], [type=number], [type=radio], select").removeAttr('disabled');
            $("#table4").find("[type=checkbox], [type=text], [type=number], [type=radio], select").removeAttr('disabled');
            $("#table3").find("[type=checkbox], [type=text], [type=number], [type=radio], select").removeAttr('disabled');
        } else {
            $("#checkRL, #table3, #table4").find("[type=checkbox]").prop("checked", false);
            $("#checkRL, #table3, #table4").find("[type=checkbox], [type=text], [type=number], [type=radio], select").attr('disabled', true);
        }
    };

    $scope.clickTable2 = function ($event) {
        // Verificar se existe alguma checkbox selecionada na tabela 2
        var existeChecked = false;
        $("#checkRL").find("[type=checkbox]").each(function(index) {
            if ($(this).is(":checked")) {
                existeChecked = true;
                return;
            }
        });

        // Se existir, então vamos bloquear todos os campos da tabela 3 e 4.
        // Caso contrario, desbloquear.
        if (existeChecked) {
            $("#table3, #table4").find("[type=checkbox]").prop("checked", false);
            $("#table3, #table4").find("[type=checkbox], [type=text], [type=number], [type=radio], select").attr('disabled', true);
        } else {
            $("#table3, #table4").find("[type=checkbox], [type=text], [type=number], [type=radio], select").removeAttr('disabled');
        }
    };

    $scope.clickTable3 = function ($event) {
        // Verificar se existe alguma checkbox selecionada na tabela 3
        var existeCheckedTable3 = false;
        $("#table3").find("[type=checkbox]").each(function(index) {
            if ($(this).is(":checked")) {
                existeCheckedTable3 = true;
                return;
            }
        });

        var existeCheckedTable1 = false;
        $("#table1").find("[type=checkbox]").each(function(index) {
            if ($(this).is(":checked")) {
                existeCheckedTable1 = true;
                return;
            }
        });

        if ((existeCheckedTable1 && existeCheckedTable3) || existeCheckedTable3) {
            $("#checkRL").find("[type=checkbox]").prop("checked", false);
            $("#checkRL").find("[type=checkbox], [type=text], [type=number], [type=radio], select").attr('disabled', true);
        } else {
            $("#checkRL").find("[type=checkbox], [type=text], [type=number], [type=radio], select").removeAttr('disabled');
        }
    };

    $scope.clickTable4 = function() {

        var existeCheckedTable4 = false;
        $("#table4").find("[type=checkbox]").each(function(index) {
            if ($(this).is(":checked")) {
                existeCheckedTable4 = true;
                return;
            }
        });

        var existeCheckedTable1 = false;
        $("#table1").find("[type=checkbox]").each(function(index) {
            if ($(this).is(":checked")) {
                existeCheckedTable1 = true;
                return;
            }
        });

        if ((existeCheckedTable1 && existeCheckedTable4) || existeCheckedTable4) {
            $("#checkRL").find("[type=checkbox]").prop("checked", false);
            $("#checkRL").find("[type=checkbox], [type=text], [type=number], [type=radio], select").attr('disabled', true);
        } else {
            $("#checkRL").find("[type=checkbox], [type=text], [type=number], [type=radio], select").removeAttr('disabled');
        }
    };

    $scope.getPropsOfEnts = function (id) {

        $http.get(API_URL + '/dynamicSearch/getPropsOfEnts/' + id).then(function(response) {
            $scope.propsOfEnts[id] = response.data;
            console.log("Ddos getPropsOfEnts");
            console.log($scope.propsOfEnts);
        });
    };

    $scope.getRelsWithEnt = function (id) {

        console.log("teste com id getRelsWithEnt: " + id);

        $http.get(API_URL + '/dynamicSearch/getRelsWithEnt/' + id).then(function(response) {
            $scope.relsWithEnt = response.data;
            $scope.getPropertiesQuery('RL');
            console.log("Ddos relsWithEnt");
            console.log($scope.relsWithEnt);
        });
    };

    $scope.getEntsRelated = function (idRelType, idEntType) {

        $http.get(API_URL + '/dynamicSearch/getEntsRelated/' + idRelType + '/' + idEntType).then(function(response) {
            $scope.entsRelated = response.data;
            $scope.getPropertiesQuery('ER');
            console.log("Dados entsRelated TETETE: ");
            console.log($scope.entsRelated);
        });
    };

    $scope.getPropsEntRelated = function (id) {

        $http.get(API_URL + '/dynamicSearch/getPropsEntRelated/' + id).then(function(response) {
            $scope.propsEntRelated = response.data[0];
            console.log("Dados propsEntRelated");
            console.log($scope.propsEntRelated);
        });
    };

    $scope.search = function (idEntityType) {

        $scope.idEntityType = idEntityType;

        console.log("ID DA ENTIDADE: " + idEntityType);

        var formData   = JSON.parse(JSON.stringify($('#dynamic-search').serializeArray())),
            numChecked = $('#dynamic-search').find('[type=checkbox]:checked').length,
            numTableET = 0,
            numTableVT = 0,
            numTableRL = 0,
            numTableER = 0;

        console.log("Valores do form DATA");
        console.log(formData);
        //console.log("Numero de checks");
        //console.log(numChecked);

        // Para saber quantas propriedades tem em cada tabela
        if ($scope.ents.properties != '' && $scope.ents.properties != undefined) {
            numTableET = $scope.ents.properties.length;
        }
        if ($scope.entRefs != '' && $scope.entRefs != undefined) {
            var len = $scope.entRefs.length;
            for (var i = 0; i < len; i++) {
                numTableVT = numTableVT + $scope.entRefs[i].properties.length;
            }
        }
        if ($scope.relsWithEnt != '' && $scope.relsWithEnt != undefined) {
            var len = $scope.relsWithEnt.length;
            for (var i = 0; i < len; i++) {
                numTableRL = numTableRL + $scope.relsWithEnt[i].properties.length;
            }
        }
        if ($scope.entsRelated != '' && $scope.entsRelated != undefined) {
            var len = $scope.entsRelated.length;
            for (var i = 0; i < len; i++) {
                numTableER = numTableER + $scope.entsRelated[i].properties.length;
            }
        }

        console.log("numTableET");
        console.log(numTableET);
        console.log(numTableVT);
        console.log(numTableRL);
        console.log(numTableER);

        //Acrescento ao form data o nr de propriedades existente em cada tabela
        formData.push({'name': 'numTableET', 'value': numTableET});
        formData.push({'name': 'numTableVT', 'value': numTableVT});
        formData.push({'name': 'numTableRL', 'value': numTableRL});
        formData.push({'name': 'numTableER', 'value': numTableER});
        formData.push({'name': 'numChecked', 'value': numChecked});

        console.log("SEGUNDOS VALORES DO FORMDATA");
        console.log(formData);

        $scope.formData = formData;

        $http({
            method: 'POST',
            url: API_URL + "dynamicSearch/search/" + idEntityType,
            data: $.param(formData),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(response) {
            console.log("RESUL FINAL");
            console.log(response);
            $scope.resultDynamincSearch = response.data;
            $("#dynamic-search").hide();
            $("#dynamic-search-presentation").show();
        });
    };
    
    $scope.showQueryResults = function (idQuery, idEntityType) {

        //Para fazer outra vez a pesquisa que já tinha sido feita faço um redirect para o form com os dados já selecionados
        window.location.href = "/dynamicSearch/entityDetails/" + idEntityType + "?query=" + idQuery;
    };

    $scope.showResult = function (idQuery, idEntityType) {

        console.log("Tá a chegar e o idQuery é " + idQuery + " e o id Entity é: " + idEntityType);

        window.location.href = "/dynamicSearch/entityDetails/" + idEntityType + "?query=" + idQuery + "&pesquisa=1";

    };

    $scope.voltar = function() {
        $("#dynamic-search").show();
        $("#dynamic-search-presentation").hide();
        $("#query_name").val("");
    };
     
    $scope.inactiveActive = function(idEntity) {

        console.log("Id da entidadeeee");
        console.log(idEntity);

        $http.post(API_URL + '/dynamicSearch/inactiveActive/' + idEntity).then(function(response) {
            console.log("Chegou");
            console.log(response.data);
            $scope.state = response.data;
            $scope.search($scope.idEntityType);
            growl.success('A instância foi ' + ($scope.state == 'active' ? 'Desativada' : 'Ativada' + '.'),{title: 'Success!'});
        });
    };

    $scope.saveSearch = function (idEntityType) {

        var queryName = $("#query_name").val();
        console.log("Nome da query: ");
        console.log(queryName);

        var formData = $scope.formData;

        formData.push({'name': 'query_name', 'value': queryName});

        $http({
            method: 'POST',
            url: API_URL + "/dynamicSearch/saveSearch/" + idEntityType,
            data: $.param(formData),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(response) {
            console.log("RESUL FINAL");
            console.log(response);
            $scope.res = response.data;
            growl.success('Pesquisa guardada com sucesso',{title: 'Sucesso'});

        });
    };

    $scope.getSavedQueries = function () {

        $http.get(API_URL + '/dynamicSearch/getSavedQueries').then(function(response) {
            $scope.queries = response.data;
            console.log("Nome da query");
            console.log($scope.queries);
        });
    };

    $scope.checkUncheckAll = function (tableType) {

        if(tableType == 'ET') {
            console.log("É da primeira tabela");

            $(".checkstable1").each(function() {
                if($(this).is(":checked")) {
                    $(this).prop('checked', false);
                } else {
                    $(this).prop('checked', true);
                }
            });

            $scope.clickTable1();
        } else if (tableType == 'VT') {
            console.log("É da segunda tabela");

            $(".checkstable2").each(function() {
                if($(this).is(":checked")) {
                    $(this).prop('checked', false);
                } else {
                    $(this).prop('checked', true);
                }
            });
            $scope.clickTable2();
        }
    };

    $scope.blockUnblockSaveButton = function () {

        var queryName = $("input[name=query_name]").val();
        console.log("O nome da query é: " + queryName);
        
        if (queryName == "" || queryName == undefined) {
            $("#save_button").prop("disabled", true);
        } else {
             $("#save_button").prop("disabled", false);
        }
    };


    //TESTES NG TBLE NO SAVED QUERIES----------------------------------------------------------------

    $scope.getSavesQueryTable = function () {

        var initialParams = {
            sorting: { created_at: "desc" }, // Ordenação por defeito da tabela
            count: 100, // Número de dados por página na tabela
        };

        var initialSettings = {
            counts: [5, 10, 15], // Número possiveis de apresentação dos dados da tabela
            getData: function (params) {
                var filterObj = params.filter(),
                    sortObj   = params.sorting();

                return $scope.getSavesQuery(params, filterObj, sortObj);
            }
        };

        $scope.tableParams = new NgTableParams(initialParams, initialSettings);
    };

    $scope.getSavesQuery = function (params, filter, sort) {

        var url = '/dynamicSearch/getSavedQuery?page=' + params.page();

        url += '&count=' + params.count();

        // Parametro de pesquisa quando é pesquisado pelo nome da query
        if (filter.queryFilter != undefined && filter.queryFilter != '') {
            url += '&query=' + filter.queryFilter;
        }
        // Parametro de pesquisa quando é pesquisado pelo nome da entidade
        if (filter.propertyFilter != undefined && filter.propertyFilter != '') {
            url += '&entity=' + filter.propertyFilter;
        }

        // Parametro de pesquisa quando é pesquisado pelo nome da propriedade
        if (filter.propertyFilter != undefined && filter.propertyFilter != '') {
            url += '&property=' + filter.propertyFilter;
        }

        var colSorting  = Object.keys(sort)[0],
            typeSorting = sort[colSorting];
        // Parametro para ordenar os dados
        url += '&colSorting=' + colSorting + "&typeSorting=" + typeSorting;

        return $http.get(url).then(function (response) {
                params.total(response.data.total);
                return response.data.data;
            });
    };

	$scope.exportar_dados_excel = function() {

        $.ajax({
            type: "GET",
            url: API_URL + "dynamicSearch/formExcel/" + $scope.idEntityType,
            data: $.param($scope.formData),
            dataType:'json',
            success: function(data) {
                var $a = $("<a href='" + data.file + "'>");
                $("body").append($a);
                $a.attr("download","pesquisa.xls");
                $a[0].click();
                $a.remove();
            }
        });
    };
});

