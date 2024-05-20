<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAPI\Client\Api\GroupsApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\Group;
use Response;


class GroupController extends Controller
{

    public function index()
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $groupsAPI = new GroupsApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $groupsAPI->groupsList();

        //Compose the results
        //Isto também poderia ser refactorizado para uma function auxiliar
        $results = collect($responseEDMS->getResults())->map(function ($group) {
            return $group->getContainer();
        });

        return Response::json($results, 200);

    }

    public function store(Request $request)
    {

        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $groupsAPI = new GroupsApi(null, $config, null, 0);

        $newGroup = new Group();
        $newGroup->setName($request->input("name"));

        //Check and call EDMS API
        if (!$newGroup->valid())
            return response()->json($newGroup->listInvalidProperties(), 500);
        else $responseEDMS = $groupsAPI->groupsCreate($newGroup);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function show($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $GroupsAPI = new GroupsApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $GroupsAPI->groupsRead($id);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function update(Request $request, $id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $groupsAPI = new GroupsApi(null, $config, null, 0);

        $updatedGroup = new Group();
        $updatedGroup->setName($request->input("name"));

        //Check and call EDMS API
        if (!$updatedGroup->valid())
            return response()->json($updatedGroup->listInvalidProperties(), 500);
        else $responseEDMS = $groupsAPI->groupsUpdate($id, $updatedGroup);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function destroy($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $groupsAPI = new GroupsApi(null, $config, null, 0);

        //Call EDMS API
        $groupsAPI->groupsDelete($id);

        return Response::json(null, 200);

    }

}
