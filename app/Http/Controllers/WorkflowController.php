<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAPI\Client\Api\WorkflowsApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\WritableWorkflow;
use OpenAPI\Client\Model\Workflow;
use Response;


class WorkflowController extends Controller
{

    public function index()
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $workflowsAPI = new WorkflowsApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $workflowsAPI->workflowsList();

        //Compose the results
        //Isto também poderia ser refactorizado para uma function auxiliar
        $results = collect($responseEDMS->getResults())->map(function ($workflow) {
            return $workflow->getContainer();
        });

        return Response::json($results, 200);

    }

    public function store(Request $request)
    {

        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $workflowsAPI = new WorkflowsApi(null, $config, null, 0);

        $newWorkflow = new WritableWorkflow();
        $newWorkflow->setDocumentTypesPkList($request->input("document_types_pk_list"));
        $newWorkflow->setLabel($request->input("label"));
        $newWorkflow->setInternalName($request->input("internal_name"));

        //Check and call EDMS API
        if (!$newWorkflow->valid())
            return response()->json($newWorkflow->listInvalidProperties(), 500);
        else $responseEDMS = $workflowsAPI->workflowsCreate($newWorkflow);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function show($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $WorkflowsAPI = new WorkflowsApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $WorkflowsAPI->workflowsRead($id);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function update(Request $request, $id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $workflowsAPI = new WorkflowsApi(null, $config, null, 0);

        $updatedWorkflow = new WritableWorkflow();
        $updatedWorkflow->setDocumentTypesPkList($request->input("document_types_pk_list"));
        $updatedWorkflow->setLabel($request->input("label"));
        $updatedWorkflow->setInternalName($request->input("internal_name"));

        //Check and call EDMS API
        if (!$updatedWorkflow->valid())
            return response()->json($updatedWorkflow->listInvalidProperties(), 500);
        else $responseEDMS = $workflowsAPI->workflowsUpdate($id, $updatedWorkflow);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function destroy($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $workflowsAPI = new WorkflowsApi(null, $config, null, 0);

        //Call EDMS API
        $workflowsAPI->workflowsDelete($id);

        return Response::json(null, 200);

    }

}
