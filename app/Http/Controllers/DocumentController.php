<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAPI\Client\Api\DocumentsApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\NewDocument;
use Response;


class DocumentController extends Controller
{

    public function index()
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $documentsAPI = new DocumentsApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $documentsAPI->documentsList();

        //Compose the results
        //Isto também poderia ser refactorizado para uma function auxiliar
        $results = collect($responseEDMS->getResults())->map(function ($document) {
            return $document->getContainer();
        });

        return Response::json($results, 200);

    }

    public function store(Request $request)
    {

        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $documentsAPI = new DocumentsApi(null, $config, null, 0);

        $newDocument = new NewDocument();
        $newDocument->setDescription($request->input("description"));
        $newDocument->setDocumentType($request->input("documentType"));
        $newDocument->setLabel($request->input("label"));
        $newDocument->setLanguage($request->input("language"));

        //Check and call EDMS API
        if (!$newDocument->valid())
            return response()->json($newDocument->listInvalidProperties(), 500);
        else $responseEDMS = $documentsAPI->documentsCreate($newDocument);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function show($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $DocumentsAPI = new DocumentsApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $DocumentsAPI->documentsRead($id);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function update(Request $request, $id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $documentsAPI = new DocumentsApi(null, $config, null, 0);

        $updatedDocument = new WritableDocument();
        $updatedDocument->setDescription($request->input("description"));
        $updatedDocument->setLabel($request->input("label"));
        $updatedDocument->setLanguage($request->input("language"));

        //Check and call EDMS API
        if (!$updatedDocument->valid())
            return response()->json($updatedDocument->listInvalidProperties(), 500);
        else $responseEDMS = $documentsAPI->documentsUpdate($id, $updatedDocument);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function destroy($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $documentsAPI = new DocumentsApi(null, $config, null, 0);

        //Call EDMS API
        $documentsAPI->documentsDelete($id);

        return Response::json(null, 200);

    }

}
