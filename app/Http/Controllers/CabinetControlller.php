<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAPI\Client\Api\CabinetsApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\WritableCabinet;
use Response;


class CabinetController extends Controller
{

    public function index()
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $cabinetsAPI = new CabinetsApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $cabinetsAPI->cabinetsList();

        //Compose the results
        //Isto também poderia ser refactorizado para uma function auxiliar
        $results = collect($responseEDMS->getResults())->map(function ($cabinet) {
            return $cabinet->getContainer();
        });

        return Response::json($results, 200);

    }

    public function store(Request $request)
    {

        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $cabinetsAPI = new CabinetsApi(null, $config, null, 0);

        $newCabinet = new WritableCabinet();
        $newCabinet->setDeleteTimePeriod($request->input("delete_time_period"));
        $newCabinet->setDeleteTimeUnit($request->input("delete_time_unit"));
        $newCabinet->setLabel($request->input("label"));
        $newCabinet->setTrashTimePeriod($request->input("trash_time_period"));
        $newCabinet->setTrashTimeUnit($request->input("trash_time_unit"));

        //Check and call EDMS API
        if (!$newCabinet->valid())
            return response()->json($newCabinet->listInvalidProperties(), 500);
        else $responseEDMS = $cabinetsAPI->cabinetsCreate($newCabinet);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function show($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $CabinetsAPI = new CabinetsApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $CabinetsAPI->cabinetsRead($id);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function update(Request $request, $id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $cabinetsAPI = new CabinetsApi(null, $config, null, 0);

        $updatedCabinet = new WritableCabinet();
        $updatedCabinet->setDeleteTimePeriod($request->input("delete_time_period"));
        $updatedCabinet->setDeleteTimeUnit($request->input("delete_time_unit"));
        $updatedCabinet->setLabel($request->input("label"));
        $updatedCabinet->setTrashTimePeriod($request->input("trash_time_period"));
        $updatedCabinet->setTrashTimeUnit($request->input("trash_time_unit"));

        //Check and call EDMS API
        if (!$updatedCabinet->valid())
            return response()->json($updatedCabinet->listInvalidProperties(), 500);
        else $responseEDMS = $cabinetsAPI->cabinetsUpdate($id, $updatedCabinet);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function destroy($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $cabinetsAPI = new CabinetsApi(null, $config, null, 0);

        //Call EDMS API
        $cabinetsAPI->cabinetsDelete($id);

        return Response::json(null, 200);

    }

}
