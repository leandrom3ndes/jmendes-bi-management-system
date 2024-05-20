<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAPI\Client\Api\TrashedDocumentsApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\tras;
use Response;


class TrashedDocumentController extends Controller
{

    public function index()
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $trashedDocumentsAPI = new TrashedDocumentsApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $trashedDocumentsAPI->trashedDocumentsList();

        //Compose the results
        //Isto também poderia ser refactorizado para uma function auxiliar
        $results = collect($responseEDMS->getResults())->map(function ($trashedDocument) {
            return $trashedDocument->getContainer();
        });

        return Response::json($results, 200);

    }

    //restore trashed document - special
    public function store($id)
    {

        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $trashedDocumentsAPI = new TrashedDocumentsApi(null, $config, null, 0);

        $trashedDocumentsAPI->trashedDocumentsRestoreCreate($id);

        return Response::json(null, 200);

    }

    public function show($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $TrashedDocumentsAPI = new TrashedDocumentsApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $TrashedDocumentsAPI->trashedDocumentsRead($id);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    /*public function update(Request $request, $id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $trashedDocumentsAPI = new TrashedDocumentsApi(null, $config, null, 0);

        $updatedTrashedDocument = new WritableTrashedDocument();
        $updatedTrashedDocument->setDeleteTimePeriod($request->input("delete_time_period"));
        $updatedTrashedDocument->setDeleteTimeUnit($request->input("delete_time_unit"));
        $updatedTrashedDocument->setLabel($request->input("label"));
        $updatedTrashedDocument->setTrashTimePeriod($request->input("trash_time_period"));
        $updatedTrashedDocument->setTrashTimeUnit($request->input("trash_time_unit"));

        //Check and call EDMS API
        if (!$updatedTrashedDocument->valid())
            return response()->json($updatedTrashedDocument->listInvalidProperties(), 500);
        else $responseEDMS = $trashedDocumentsAPI->trashedDocumentsUpdate($id, $updatedTrashedDocument);

        return Response::json($responseEDMS->getContainer(), 200);

    }*/

    public function destroy($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $trashedDocumentsAPI = new TrashedDocumentsApi(null, $config, null, 0);

        //Call EDMS API
        $trashedDocumentsAPI->trashedDocumentsDelete($id);

        return Response::json(null, 200);

    }

}
