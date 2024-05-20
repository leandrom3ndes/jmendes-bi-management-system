<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAPI\Client\Api\IndexesApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\IndexTemplateNode;
use Response;


class IndexTemplateController extends Controller
{

    public function index($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $indexTemplatesAPI = new IndexesApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $indexTemplatesAPI->indexesTemplateList($id);

        //Compose the results
        //Isto também poderia ser refactorizado para uma function auxiliar
        $results = collect($responseEDMS->getResults())->map(function ($indexTemplate) {
            return $indexTemplate->getContainer();
        });

        return Response::json($results, 200);

    }

/*    public function store(Request $request)
    {

        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $indexTemplatesAPI = new IndexesApi(null, $config, null, 0);

        $newIndexTemplate = new WritableIndexTemplate();
        $newIndexTemplate->setDeleteTimePeriod($request->input("delete_time_period"));
        $newIndexTemplate->setDeleteTimeUnit($request->input("delete_time_unit"));
        $newIndexTemplate->setLabel($request->input("label"));
        $newIndexTemplate->setTrashTimePeriod($request->input("trash_time_period"));
        $newIndexTemplate->setTrashTimeUnit($request->input("trash_time_unit"));

        //Check and call EDMS API
        if (!$newIndexTemplate->valid())
            return response()->json($newIndexTemplate->listInvalidProperties(), 500);
        else $responseEDMS = $indexTemplatesAPI->indexesTemplateCreate($newIndexTemplate);

        return Response::json($responseEDMS->getContainer(), 200);

    }*/

    public function show($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $indexTemplatesAPI = new IndexesApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $indexTemplatesAPI->indexesTemplateRead($id);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function update(Request $request, $id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $indexTemplatesAPI = new IndexesApi(null, $config, null, 0);

        $updatedIndexTemplate = new IndexTemplateNode();
        $updatedIndexTemplate->setEnabled($request->input("enabled"));
        $updatedIndexTemplate->setExpression($request->input("expression"));
        $updatedIndexTemplate->setIndex($request->input("index"));
        $updatedIndexTemplate->setLinkDocuments($request->input("link_documents"));
        $updatedIndexTemplate->setParent($request->input("parents"));

        //Check and call EDMS API
        if (!$updatedIndexTemplate->valid())
            return response()->json($updatedIndexTemplate->listInvalidProperties(), 500);
        else $responseEDMS = $indexTemplatesAPI->indexesTemplateUpdate($id, $updatedIndexTemplate);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function destroy($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $indexTemplatesAPI = new IndexesApi(null, $config, null, 0);

        //Call EDMS API
        $indexTemplatesAPI->indexesTemplateDelete($id);

        return Response::json(null, 200);

    }

}
