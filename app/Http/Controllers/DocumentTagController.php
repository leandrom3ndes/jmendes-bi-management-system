<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAPI\Client\Api\DocumentsApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\DocumentTag;
use OpenAPI\Client\Model\NewDocumentTag;
use Response;


class DocumentTagController extends Controller
{

    public function index($document_pk)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $documentTagsAPI = new DocumentsApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $documentTagsAPI->documentsTagsList($document_pk);

        //Compose the results
        //Isto também poderia ser refactorizado para uma function auxiliar
        $results = collect($responseEDMS->getResults())->map(function ($documentTag) {
            return $documentTag->getContainer();
        });

        return Response::json($results, 200);

    }

    public function store(Request $request, $document_pk)
    {

        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $documentTagsAPI = new DocumentsApi(null, $config, null, 0);

        $newDocumentTag = new NewDocumentTag();
        $newDocumentTag->setTagPk($request->input("tag_pk"));

        //Check and call EDMS API
        if (!$newDocumentTag->valid())
            return response()->json($newDocumentTag->listInvalidProperties(), 500);
        else $responseEDMS = $documentTagsAPI->documentsTagsCreate($document_pk, $newDocumentTag);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function show($document_pk, $id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $documentTagsAPI = new DocumentsApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $documentTagsAPI->documentsTagsRead($document_pk, $id);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    /*public function update(Request $request, $id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $documentTagsAPI = new DocumentsApi(null, $config, null, 0);

        $updatedDocumentTag = new WritableDocumentTag();
        $updatedDocumentTag->setDeleteTimePeriod($request->input("delete_time_period"));
        $updatedDocumentTag->setDeleteTimeUnit($request->input("delete_time_unit"));
        $updatedDocumentTag->setLabel($request->input("label"));
        $updatedDocumentTag->setTrashTimePeriod($request->input("trash_time_period"));
        $updatedDocumentTag->setTrashTimeUnit($request->input("trash_time_unit"));

        //Check and call EDMS API
        if (!$updatedDocumentTag->valid())
            return response()->json($updatedDocumentTag->listInvalidProperties(), 500);
        else $responseEDMS = $documentTagsAPI->documentTagsUpdate($id, $updatedDocumentTag);

        return Response::json($responseEDMS->getContainer(), 200);

    }*/

    public function destroy($document_pk, $id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $documentTagsAPI = new DocumentsApi(null, $config, null, 0);

        //Call EDMS API
        $documentTagsAPI->documentsTagsDelete($document_pk, $id);

        return Response::json(null, 200);

    }

}
