<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAPI\Client\Api\DocumentTypesApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\WritableDocumentType;
use Response;


class DocumentTypeController extends Controller
{

    public function index()
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $documentTypesAPI = new DocumentTypesApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $documentTypesAPI->documentTypesList();

        //Compose the results
        //Isto também poderia ser refactorizado para uma function auxiliar
        $results = collect($responseEDMS->getResults())->map(function ($documentType) {
            return $documentType->getContainer();
        });

        return Response::json($results,200);

    }

    public function store(Request $request)
    {

        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $documentTypesAPI = new DocumentTypesApi(null, $config, null, 0);

        $newDocType = new WritableDocumentType();
        $newDocType->setDeleteTimePeriod($request->input('delete_time_period'));
        $newDocType->setDeleteTimeUnit($request->input('delete_time_unit'));
        $newDocType->setLabel($request->input('label'));
        $newDocType->setTrashTimePeriod($request->input('trash_time_period'));
        $newDocType->setTrashTimeUnit($request->input('trash_time_unit'));

        //Check and call EDMS API
        if(!$newDocType->valid())
            //throw new Exception($newDocType->listInvalidProperties());
            return response()->json($newDocType->listInvalidProperties(), 500);
        else $responseEDMS = $documentTypesAPI->documentTypesCreate($newDocType);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function show($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $documentTypesAPI = new DocumentTypesApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $documentTypesAPI->documentTypesRead($id);

        return Response::json($responseEDMS->getContainer(),200);

    }

    public function update(Request $request, $id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $documentTypesAPI = new DocumentTypesApi(null, $config, null, 0);

        $updatedDocType = new WritableDocumentType();
        $updatedDocType->setDeleteTimePeriod($request->input('delete_time_period'));
        $updatedDocType->setDeleteTimeUnit($request->input('delete_time_unit'));
        $updatedDocType->setLabel($request->input('label'));
        $updatedDocType->setTrashTimePeriod($request->input('trash_time_period'));
        $updatedDocType->setTrashTimeUnit($request->input('trash_time_unit'));

        //Call EDMS API
        //$responseEDMS = $documentTypesAPI->documentTypesUpdate($id, $updatedDocType);

        //Check and call EDMS API
        if(!$updatedDocType->valid())
            //throw new Exception($newDocType->listInvalidProperties());
            return response()->json($updatedDocType->listInvalidProperties(), 500);
        else $responseEDMS = $documentTypesAPI->documentTypesUpdate($id, $updatedDocType);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function destroy($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $documentTypesAPI = new DocumentTypesApi(null, $config, null, 0);

        //Call EDMS API
        $documentTypesAPI->documentTypesDelete($id);

        //Compose the results
        //Isto também poderia ser refactorizado para uma function auxiliar
        /*$results = collect($responseEDMS->getResults())->map(function ($documentType) {
            return $documentType->getContainer();
        });*/

        return Response::json(null,200);

    }

}
