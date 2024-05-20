<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAPI\Client\Api\MessagesApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\Message;
use Response;


class MessageController extends Controller
{

    public function index()
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $messagesAPI = new MessagesApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $messagesAPI->messagesList();

        //Compose the results
        //Isto também poderia ser refactorizado para uma function auxiliar
        $results = collect($responseEDMS->getResults())->map(function ($message) {
            return $message->getContainer();
        });

        return Response::json($results, 200);

    }

    public function store(Request $request)
    {

        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $messagesAPI = new MessagesApi(null, $config, null, 0);

        $newMessage = new Message();
        $newMessage->setEndDatetime($request->input("end_datetime"));
        $newMessage->setEnabled($request->input("enabled"));
        $newMessage->setLabel($request->input("label"));
        $newMessage->setMessage($request->input("message"));
        $newMessage->setStartDatetime($request->input("start_datetime"));

        //Check and call EDMS API
        if (!$newMessage->valid())
            return response()->json($newMessage->listInvalidProperties(), 500);
        else $responseEDMS = $messagesAPI->messagesCreate($newMessage);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function show($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $MessagesAPI = new MessagesApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $MessagesAPI->messagesRead($id);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function update(Request $request, $id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $messagesAPI = new MessagesApi(null, $config, null, 0);

        $updatedMessage = new WritableMessage();
        $updatedMessage->setEndDatetime($request->input("end_datetime"));
        $updatedMessage->setEnabled($request->input("enabled"));
        $updatedMessage->setLabel($request->input("label"));
        $updatedMessage->setMessage($request->input("message"));
        $updatedMessage->setStartDatetime($request->input("start_datetime"));

        //Check and call EDMS API
        if (!$updatedMessage->valid())
            return response()->json($updatedMessage->listInvalidProperties(), 500);
        else $responseEDMS = $messagesAPI->messagesUpdate($id, $updatedMessage);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function destroy($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $messagesAPI = new MessagesApi(null, $config, null, 0);

        //Call EDMS API
        $messagesAPI->messagesDelete($id);

        return Response::json(null, 200);

    }

}
