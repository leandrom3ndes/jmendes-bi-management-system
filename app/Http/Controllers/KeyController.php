<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAPI\Client\Api\KeysApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\Key;
use Response;


class KeyController extends Controller
{

    public function index()
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $keysAPI = new KeysApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $keysAPI->keysList();

        //Compose the results
        //Isto também poderia ser refactorizado para uma function auxiliar
        $results = collect($responseEDMS->getResults())->map(function ($key) {
            return $key->getContainer();
        });

        return Response::json($results, 200);

    }

    public function store(Request $request)
    {

        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $keysAPI = new KeysApi(null, $config, null, 0);

        $newKey = new Key();
        $newKey->setKeyData()($request->input("key_data"));

        //Check and call EDMS API
        if (!$newKey->valid())
            return response()->json($newKey->listInvalidProperties(), 500);
        else $responseEDMS = $keysAPI->keysCreate($newKey);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function show($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $KeysAPI = new KeysApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $KeysAPI->keysRead($id);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    /*public function update(Request $request, $id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $keysAPI = new KeysApi(null, $config, null, 0);

        $updatedKey = new WritableKey();
        $updatedKey->setDeleteTimePeriod($request->input("delete_time_period"));
        $updatedKey->setDeleteTimeUnit($request->input("delete_time_unit"));
        $updatedKey->setLabel($request->input("label"));
        $updatedKey->setTrashTimePeriod($request->input("trash_time_period"));
        $updatedKey->setTrashTimeUnit($request->input("trash_time_unit"));

        //Check and call EDMS API
        if (!$updatedKey->valid())
            return response()->json($updatedKey->listInvalidProperties(), 500);
        else $responseEDMS = $keysAPI->keysUpdate($id, $updatedKey);

        return Response::json($responseEDMS->getContainer(), 200);

    }*/

    public function destroy($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $keysAPI = new KeysApi(null, $config, null, 0);

        //Call EDMS API
        $keysAPI->keysDelete($id);

        return Response::json(null, 200);

    }

}
