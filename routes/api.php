<?php

use Illuminate\Http\Request;

//TESTE
Route::group(
    [
        'prefix' => 'auth',
    ],
    function () {
        Route::post('login', 'AuthController@login');
        Route::post('signup', 'AuthController@signup');

        Route::group(
            [
                'middleware' => 'auth:api',
            ],
            function () {
                Route::get('logout', 'AuthController@logout');
                Route::get('user', 'AuthController@user');

                //Spreadsheet stuff
                Route::post(
                    '/spreadsheet/uploadSpreadsheet/',
                    'SpreadsheetController@uploadSpreadsheet'
                );

                Route::post(
                    '/spreadsheet/uploadSelectedSheets/',
                    'SpreadsheetController@uploadSelectedSheets'
                );

                Route::apiResource('languages', 'LanguageController');
                Route::apiResource(
                    'language_states',
                    'LanguageStateController'
                );

                //Importante: Esta rota tem de aparecer antes da seguinte senão o matching quando faço o pedido http é com o show($id) onde $id é getAllActors
                Route::get(
                    '/roles/getAllActors',
                    'RoleController@getAllActors'
                );
                Route::get(
                    '/roles/getAllActors',
                    'RoleController@getAllActors'
                );
                Route::delete(
                    '/roles/removeActors/{actorId}/{roleId}',
                    'RoleController@removeActors'
                );
                Route::apiResource('roles', 'RoleController');
                Route::get(
                    '/roles/getSelActors/{id}',
                    'RoleController@getSelActors'
                );
                Route::get(
                    '/roles/getSelUsers/{id}',
                    'RoleController@getSelUsers'
                );
                Route::get(
                    '/roles/getDelegationsForRole/{id}',
                    'RoleController@getDelegationsForRole'
                );
                Route::get(
                    '/roles/getOnlyActors/{id}',
                    'RoleController@getOnlyActors'
                );
                Route::get(
                    '/roles/getOnlyUsers/{id}',
                    'RoleController@getOnlyUsers'
                );
                Route::post(
                    '/roles/updateActors/{id}',
                    'RoleController@updateActors'
                );
                Route::post(
                    '/roles/updateUsers/{id}',
                    'RoleController@updateUsers'
                );

                /*Route::get('/roles/get_actors', 'RoleController@get_actors');
                 Route::get('/roles/get_onlyactors', 'RoleController@get_onlyactors');*/

                //Importante: Esta rota tem de aparecer antes da seguinte senão o matching quando faço o pedido http é com o show($id) onde $id é getAllActors
                Route::get('/roles/getAllActors', 'RoleController@getAllActors');
                Route::apiResource('roles', 'RoleController');
                Route::get('/roles/getSelActors/{id}', 'RoleController@getSelActors');
                Route::get('/roles/getSelUsers/{id}', 'RoleController@getSelUsers');
                Route::get('/roles/getDelegationsForRole/{id}', 'RoleController@getDelegationsForRole');
                Route::get('/roles/getOnlyActors/{id}', 'RoleController@getOnlyActors');
                Route::get('/roles/getOnlyUsers/{id}', 'RoleController@getOnlyUsers');
                Route::post('/roles/updateActors/{id}', 'RoleController@updateActors');
                Route::post('/roles/updateUsers/{id}', 'RoleController@updateUsers');

                /*Route::get('/roles/get_actors', 'RoleController@get_actors');
                Route::get('/roles/get_onlyactors', 'RoleController@get_onlyactors');*/


                //Actors Bernardo
                Route::apiResource('actors', 'ActorController');
                //Route::apiResource('actor_states', 'ActorStateController');

                //Process Types
                Route::apiResource('processtypes', 'ProcessTypeController');
                Route::apiResource(
                    'processtypestates',
                    'ProcessTypeStateController'
                );

                //<editor-fold desc="EDMS section">
                Route::apiResource('documenttypes', 'DocumentTypeController');
                Route::apiResource('cabinets', 'CabinetController');
                Route::apiResource('cabinetdocuments', 'CabinetDocumentController');
                Route::apiResource('currentusers', 'CurrentUserController');
                Route::apiResource('documentcomments', 'DocumentCommentController');
                Route::apiResource('documents', 'DocumentController');
                Route::apiResource('documentmetadata', 'DocumentMetadataController');
                Route::apiResource('documenttags', 'DocumentTagController');
                Route::apiResource('documentversions', 'DocumentVersionController');
                Route::apiResource('groups', 'GroupController');
                Route::apiResource('indexes', 'IndexController');
                Route::apiResource('indextemplates', 'IndexTemplateController');
                Route::apiResource('keys', 'KeyController');
                Route::apiResource('messages', 'MessageController');
                Route::apiResource('metadatatypes', 'MetadataTypeController');
                Route::apiResource('objectacls', 'ObjectAclController');
                Route::apiResource('objectaclpermissions', 'ObjectAclPermissionController');
                Route::apiResource('rolesedms', 'RoleEdmsController');
                Route::apiResource('smartlinkconditions', 'SmartLinkConditionController');
                Route::apiResource('smartlinks', 'SmartLinkController');
                Route::apiResource('stagingfolders', 'StagingFolderController');
                Route::apiResource('stagingfolderfiles', 'StagingFolderFileController');
                Route::apiResource('tags', 'TagController');
                Route::apiResource('trasheddocuments', 'TrashedDocumentController');
                Route::apiResource('usersedms', 'UserEdmsController');
                Route::apiResource('workflows', 'WorkflowController');
                Route::apiResource('workflowdocumenttypes', 'WorkflowDocumentTypeController');
                Route::apiResource('workflowstates', 'WorkflowStateController');
                Route::apiResource('workflowtransitions', 'WorkflowTransitionController');
                //</editor-fold>

                //Baptista
                Route::put('/forms/json_update/{id}', 'FormController@updateJSON');
                Route::apiResource('properties', 'PropertyController');
                Route::apiResource('actions', 'ActionController');
                Route::apiResource('actions_prop', 'ActionPropController');
                Route::apiResource('actions_prop_form', 'ActionPropFormController');
                Route::apiResource('forms', 'FormController');
                Route::apiResource('validation_cond', 'ValidationCondController');

                //Form Controller
                Route::get('/forms/action_properties/{id}', 'FormController@getPropertiesToAction');
                Route::get('/forms/action_properties_other_lang/{id}/{idLanguage}', 'FormController@getPropertiesToActionOtherLanguage');
                Route::get('/forms/action_properties/{ActionID}/{PropertyID}', 'FormController@getPropertyToAction');
                Route::post('/forms/action_prop_form', 'FormController@insertActionPropForm');
                Route::post('/forms/action_prop_form_other_lang', 'FormController@insertActionPropFormOtherLang');
                Route::delete('/forms/action_prop_form/{id}', 'FormController@destroyActionPropForm');
                Route::get('/property/prop_allowed_values/{id}', 'PropertyController@getPropertyAllowedValues');
                Route::get('/property/prop_ref_values/{id}', 'PropertyController@getPropRefValues');
                Route::get('/property/prop_allowed_values_other_lang/{id}/{langID}', 'PropertyController@getPropertyAllowedValuesOtherLang');
                Route::get('/property/prop_ref_values_other_lang/{id}/{langID}', 'PropertyController@getPropRefValuesOtherLang');
                Route::get('/forms/getActionPropForm/{idForm}/{propID}', 'FormController@getActionPropIDFromPropID');
                Route::get('/forms/getJSON/{idForm}', 'FormController@getFormJSON');
                Route::post('/forms/create_form_other_language', 'FormController@createFormOtherLanguage');
                Route::get('/forms/getLanguages/{idForm}', 'FormController@getFormAvailableLanguages');
                Route::get('/formsToTranslate', 'FormController@getFormsToTranslate');
                Route::get('/formToTranslate/{idForm}/{idLang}', 'FormController@getFormToTranslate');

                // ValidationCond Controller
                Route::get('/validation_cond/get_by_action_prop/{actionPropID}', 'ValidationCondController@getValidationConditionsFromActionProp');
                Route::get('/validation_cond/get_by_action_prop_other_lang/{actionPropID}/{langID}', 'ValidationCondController@getValidationConditionsFromActionPropOtherLang');
                Route::apiResource('tstates', 'TstatesController');



                //Dashboard
                Route::get('/dashboardManage', 'DashboardController@index');
                Route::get(
                    '/dashboard/get_all_inic_trans',
                    'DashboardController@getAllInicTransactions'
                );
                Route::post(
                    '/dashboard/get_data_for_tab',
                    'DashboardController@startNewTransaction'
                );

                //Blockly Vítor
                Route::get('/blockly/get_transactiontypes', 'BlocklyController@getTransactionTypes');
                Route::get('/blockly/get_transactionstates','BlocklyController@getTransactionStates');
                Route::get('/blockly/get_properties/{id}','BlocklyController@getPropertiesFromEntType');
                Route::get('/blockly/get_property/{id}','BlocklyController@getProperty');
                Route::get('/blockly/get_propertyvalues/{id}','BlocklyController@getPropertyValues');
                Route::get('/blockly/get_fkpropertyvalues/{id}','BlocklyController@getFkPropertyValues');
                Route::get('/blockly/get_enttypes','BlocklyController@getEntTypes');
                Route::get('/blockly/get_templates','BlocklyController@getTemplates');
                Route::get('/blockly/get_userevaluatedexpressions','BlocklyController@getUserEvaluatedExpressions');
                Route::get('/blockly/get_queries','BlocklyController@getQueries');
                Route::get('/blockly/get_constants','BlocklyController@getConstants');
                Route::get('/blockly/get_actionrules','BlocklyController@getActionRules');
                Route::get('/blockly/get_queryparameters/{id}','BlocklyController@getQueryParameters');
                Route::get('/blockly/get_allproperties', 'BlocklyController@getProperties');
                Route::get('/blockly/get_allfkpropertyvalues', 'BlocklyController@getAllFkPropertyValues');
                Route::get('/blockly/get_allpropallowedvalues', 'BlocklyController@getPropAllowedValues');
                Route::post('/blockly/store_action_rule','BlocklyController@storeActionRule');

                // Dashboard Vítor
                Route::get('/dashboard/get_form/{action_id}', 'ARDashboardController@getFormFromAction');
                Route::get('/dashboard/get_executing_action/{transaction_type_id}_{t_state_id}_{transaction_id}', 'ARDashboardController@getExecutingAction');
                Route::post('/dashboard/store_action_log','ARDashboardController@storeActionLog');
                Route::post('/dashboard/store_form_input','ARDashboardController@storeFormInput');
                Route::get('/dashboard/get_template/{action_id}','ARDashboardController@getTemplateFromAction');

                // Template Management - Vitor
                Route::apiResource('templates', 'TemplateController');


                Route::get(
                    '/dashboard/get_processes_of_tr/{id}',
                    'DashboardController@getAllProcessOfTr'
                );

                Route::get(
                    '/dashboard/get_all_inic_exec_trans',
                    'DashboardController@getAllInicExecTrans'
                );

                //        Route::get('/dashboard/get_inic_trans_by_id', 'DashboardController@getInicTransactionbyId');

                Route::post(
                    '/dashboard/verify_can_use_proc/',
                    'DashboardController@verifCanUseProc'
                );

                Route::get('/tabError', function () {
                    return view('dashboard/tabError');
                });

                Route::get('/tabProcess', function () {
                    return view('dashboard/tabProcess');
                });

                Route::get('/modalDialog', function () {
                    return view('dashboard/modalDialog');
                });

                Route::get('/modalTask', function () {
                    return view('dashboard/modalTask');
                });
                Route::get('/tabTask', function () {
                    return view('dashboard/tabTask');
                });
                Route::get('/tabFormTask', function () {
                    return view('dashboard/tabFormTask');
                });
                Route::get('/formCActTask', function () {
                    return view('dashboard/formCActTask');
                });
                Route::get('/tabProdDocTask', function () {
                    return view('dashboard/tabProdDocTask');
                });
                Route::get('/tabChildFormTask', function () {
                    return view('dashboard/tabChildFormTask');
                });

                Route::get('/popover', function () {
                    return view('dashboard/popover');
                });

                Route::post(
                    '/dashboard/send_partial_data',
                    'DashboardController@insertPartialData'
                );

                Route::get('/modalNotification', function () {
                    return view('dashboard/modalNotification');
                });
                Route::post(
                    '/dashboard/trans_ack',
                    'DashboardController@transactionAckAll'
                );
                //MODAL CONTINUE TRANSACTION
                Route::get('/modalContinueTransaction', function () {
                    return view('dashboard/modalContinueTransaction');
                });
                Route::get(
                    '/dashboard/get_all_states_for_transaction/{id}',
                    'DashboardController@getStatesFromTransaction'
                );


                // João Mendes - BI Management

                // Api for BiElement
                Route::get(
                    '/biManagement/get_all_bielements_detail',
                    'BiElementController@getAllBiElements');
                Route::get(
                    '/biManagement/get_bielement_detail/{biElementId}',
                    'BiElementController@getBiElementDetail');
                Route::get(
                    '/biManagement/get_all_bielements_detail',
                    'BiElementController@getAllBiElementsDetail');
                Route::get(
                    '/biManagement/get_biuser_collection',
                    'BiElementController@getBiUserCollection');
                Route::get(
                    '/biManagement/get_bielement_type_slug',
                    'BiElementController@getBiElementTypeSlug');
                Route::get(
                    '/biManagement/get_all_bielement_types',
                    'BiElementController@getBiElementsTypes');
                Route::get(
                    '/biManagement/get_bielement_type_detail/{biElementTypeId}',
                    'BiElementController@getBiElementTypeDetail');
                Route::post(
                    '/biManagement/store_bielement',
                    'BiElementController@storeBiElement');
                Route::post(
                    '/biManagement/store_biuser_collection/{biElementId}',
                    'BiElementController@storeBiUserCollection');
                Route::post(
                    '/biManagement/store_bielement_type',
                    'BiElementController@storeBiElementType');
                Route::post(
                    '/biManagement/update_bielement/{biElementId}',
                    'BiElementController@updateBiElement');
                Route::post(
                    '/biManagement/update_bielement_type/{biElementTypeId}',
                    'BiElementController@updateBiElementType');
                Route::delete(
                    '/biManagement/delete_bielement/{biElementId}',
                    'BiElementController@deleteBiElement');
                Route::delete(
                    '/biManagement/delete_biuser_collection/{biElementId}',
                    'BiElementController@deleteBiUserCollection');
                Route::delete(
                    '/biManagement/delete_bielement_type/{biElementTypeId}',
                    'BiElementController@deleteBiElementType');

                // Api for Engine
                Route::get(
                    '/biManagement/get_all_engines',
                    'BiEngineController@getAllEngines');
                Route::get(
                    '/biManagement/getEngine/{biEngineId}',
                    'BiEngineController@getEngine');
                Route::post(
                    '/biManagement/store_biEngine',
                    'BiEngineController@storeBiEngine');
                Route::post(
                    '/biManagement/update_biEngine/{biEngineId}',
                    'BiEngineController@updateBiEngine');
                Route::delete(
                    '/biManagement/delete_biEngine/{biEngineId}',
                    'BiEngineController@deleteBiEngine');

                // Api for Knowage
                Route::get(
                    '/biManagement/get_all_biknowage',
                    'BiKnowageController@getAllBiKnowage');
                Route::get(
                    '/biManagement/get_biknowage_detail/{id}',
                    'BiKnowageController@getBiKnowageDetail');
                Route::get(
                    '/biManagement/get_all_biknowage_detail',
                    'BiKnowageController@getAllBiKnowageDetail');
                Route::post(
                    '/biManagement/store_biknowage',
                    'BiKnowageController@storeBiKnowage');
                Route::post(
                    '/biManagement/update_biknowage/{biKnowageId}',
                    'BiKnowageController@updateBiKnowage');
                Route::delete(
                    '/biManagement/delete_biknowage/{biKnowageId}',
                    'BiKnowageController@deleteBiKnowage');

            }
        );

        // Test Bi Management APIs
        Route::get(
            '/biManagement/get_all_bielements',
            'BiElementController@getAllBiElements');
        Route::get(
            '/biManagement/get_bielement_detail/{biElementId}',
            'BiElementController@getBiElementDetail');
        Route::get(
            '/biManagement/get_all_bielements_detail',
            'BiElementController@getAllBiElementsDetail');
        Route::get(
            '/biManagement/get_biuser_collection',
            'BiElementController@getBiUserCollection');
        Route::get(
            '/biManagement/get_bielement_type_slug',
            'BiElementController@getBiElementTypeSlug');
        Route::get(
            '/biManagement/get_all_bielement_types',
            'BiElementController@getBiElementsTypes');
        Route::get(
            '/biManagement/get_bielement_type_detail/{biElementTypeId}',
            'BiElementController@getBiElementTypeDetail');
        Route::post(
            '/biManagement/store_bielement',
            'BiElementController@storeBiElement');
        Route::post(
            '/biManagement/store_biuser_collection/{biElementId}',
            'BiElementController@storeBiUserCollection');
        Route::post(
            '/biManagement/store_bielement_type',
            'BiElementController@storeBiElementType');
        Route::post(
            '/biManagement/update_bielement/{biElementId}',
            'BiElementController@updateBiElement');
        Route::post(
            '/biManagement/update_bielement_type/{biElementTypeId}',
            'BiElementController@updateBiElementType');
        Route::delete(
            '/biManagement/delete_bielement/{biElementId}',
            'BiElementController@deleteBiElement');
        Route::delete(
            '/biManagement/delete_biuser_collection/{biElementId}',
            'BiElementController@deleteBiUserCollection');
        Route::delete(
            '/biManagement/delete_bielement_type/{biElementTypeId}',
            'BiElementController@deleteBiElementType');

        // Api for Engine
        Route::get(
            '/biManagement/get_all_engines',
            'BiEngineController@getAllEngines');
        Route::get(
            '/biManagement/get_eng_bielements/{biEngineId}',
            'BiEngineController@getEngBiElements');
        Route::post(
            '/biManagement/store_biengine',
            'BiEngineController@storeBiEngine');
        Route::post(
            '/biManagement/update_biengine/{biEngineId}',
            'BiEngineController@updateBiEngine');
        Route::delete(
            '/biManagement/delete_biengine/{biEngineId}',
            'BiEngineController@deleteBiEngine');

        // Api for Knowage
        Route::get(
            '/biManagement/get_all_biknowage',
            'BiKnowageController@getAllBiKnowage');
        Route::get(
            '/biManagement/get_biknowage_detail/{id}',
            'BiKnowageController@getBiKnowageDetail');
        Route::get(
            '/biManagement/get_all_biknowage_detail',
            'BiKnowageController@getAllBiKnowageDetail');
        Route::post(
            '/biManagement/store_biknowage',
            'BiKnowageController@storeBiKnowage');
        Route::post(
            '/biManagement/update_biknowage/{biKnowageId}',
            'BiKnowageController@updateBiKnowage');
        Route::delete(
            '/biManagement/delete_biknowage/{biKnowageId}',
            'BiKnowageController@deleteBiKnowage');
    }
);
//FIM TESTE

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

//Route::apiResource('languages', 'LanguageController');
//Route::apiResource('language_states', 'LanguageStateController');
