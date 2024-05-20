<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAPI\Client\Api\UsersApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\User;
use Response;


class CurrentUserController extends Controller
{

    /*public function index()
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $currentUsersAPI = new UsersApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $currentUsersAPI->currentUsersList();

        //Compose the results
        //Isto também poderia ser refactorizado para uma function auxiliar
        $results = collect($responseEDMS->getResults())->map(function ($currentUser) {
            return $currentUser->getContainer();
        });

        return Response::json($results, 200);

    }*/

    /*public function store(Request $request)
    {

        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $currentUsersAPI = new CurrentUsersApi(null, $config, null, 0);

        $newCurrentUser = new WritableCurrentUser();
        $newCurrentUser->setDeleteTimePeriod($request->input("delete_time_period"));
        $newCurrentUser->setDeleteTimeUnit($request->input("delete_time_unit"));
        $newCurrentUser->setLabel($request->input("label"));
        $newCurrentUser->setTrashTimePeriod($request->input("trash_time_period"));
        $newCurrentUser->setTrashTimeUnit($request->input("trash_time_unit"));

        //Check and call EDMS API
        if (!$newCurrentUser->valid())
            return response()->json($newCurrentUser->listInvalidProperties(), 500);
        else $responseEDMS = $currentUsersAPI->currentUsersCreate($newCurrentUser);

        return Response::json($responseEDMS->getContainer(), 200);

    }*/

    public function show()
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $currentUsersAPI = new UsersApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $currentUsersAPI->usersCurrentRead();

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function update(Request $request)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $currentUsersAPI = new UsersApi(null, $config, null, 0);

        $updatedCurrentUser = new User();
        $updatedCurrentUser->setFirstName($request->input("first_name"));
        $updatedCurrentUser->setEmail($request->input("email"));
        $updatedCurrentUser->setGroupsPkList($request->input("groups_pk_list"));
        $updatedCurrentUser->setLastName($request->input("last_name"));
        $updatedCurrentUser->setPassword($request->input("password"));
        $updatedCurrentUser->setUsername($request->input("username"));

        //Check and call EDMS API
        if (!$updatedCurrentUser->valid())
            return response()->json($updatedCurrentUser->listInvalidProperties(), 500);
        else $responseEDMS = $currentUsersAPI->usersCurrentUpdate($updatedCurrentUser);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function destroy()
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $currentUsersAPI = new UsersApi(null, $config, null, 0);

        //Call EDMS API
        $currentUsersAPI->usersCurrentDelete();

        return Response::json(null, 200);

    }

}
