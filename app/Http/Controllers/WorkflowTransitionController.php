<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAPI\Client\Api\WorkflowsApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\WorkflowTransition;
use OpenAPI\Client\Model\WritableWorkflowTransition;
use Response;


class WorkflowTransitionController extends Controller
{

    public function index($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $workflowTransitionsAPI = new WorkflowsApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $workflowTransitionsAPI->workflowsTransitionsList($id);

        //Compose the results
        //Isto também poderia ser refactorizado para uma function auxiliar
        $results = collect($responseEDMS->getResults())->map(function ($workflowTransition) {
            return $workflowTransition->getContainer();
        });

        return Response::json($results, 200);

    }

    public function store(Request $request, $id)
    {

        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $workflowTransitionsAPI = new WorkflowsApi(null, $config, null, 0);

        $newWorkflowTransition = new WritableWorkflowTransition();
        $newWorkflowTransition->setDestinationStatePk($request->input("destination_state_pk"));
        $newWorkflowTransition->setLabel($request->input("label"));
        $newWorkflowTransition->setOriginStatePk($request->input("origin_state_pk"));

        //Check and call EDMS API
        if (!$newWorkflowTransition->valid())
            return response()->json($newWorkflowTransition->listInvalidProperties(), 500);
        else $responseEDMS = $workflowTransitionsAPI->workflowsTransitionsCreate($id, $newWorkflowTransition);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function show($id, $transition_pk)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $WorkflowTransitionsAPI = new WorkflowsApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $WorkflowTransitionsAPI->workflowsTransitionsRead($id, $transition_pk);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function update(Request $request, $id, $transition_pk)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $workflowTransitionsAPI = new WorkflowsApi(null, $config, null, 0);

        $updatedWorkflowTransition = new WritableWorkflowTransition();
        $updatedWorkflowTransition->setDestinationStatePk($request->input("destination_state_pk"));
        $updatedWorkflowTransition->setLabel($request->input("label"));
        $updatedWorkflowTransition->setOriginStatePk($request->input("origin_state_pk"));

        //Check and call EDMS API
        if (!$updatedWorkflowTransition->valid())
            return response()->json($updatedWorkflowTransition->listInvalidProperties(), 500);
        else $responseEDMS = $workflowTransitionsAPI->workflowsTransitionsUpdate($id, $transition_pk, $updatedWorkflowTransition);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function destroy($id, $transition_pk)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $workflowTransitionsAPI = new WorkflowsApi(null, $config, null, 0);

        //Call EDMS API
        $workflowTransitionsAPI->workflowsTransitionsDelete($id, $transition_pk);

        return Response::json(null, 200);

    }

}
