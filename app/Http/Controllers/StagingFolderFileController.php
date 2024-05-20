<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAPI\Client\Api\StagingFoldersApi;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\Model\StagingFolderFile;
use OpenAPI\Client\Model\StagingFolderFileUpload;
use Response;


class StagingFolderFileController extends Controller
{

    /*public function index()
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $stagingFolderFilesAPI = new StagingFoldersApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $stagingFolderFilesAPI->stagistagingFolderFilesList();

        //Compose the results
        //Isto também poderia ser refactorizado para uma function auxiliar
        $results = collect($responseEDMS->getResults())->map(function ($stagingFolderFile) {
            return $stagingFolderFile->getContainer();
        });

        return Response::json($results, 200);

    }*/

    public function store(Request $request, $staging_folder_pk, $encoded_filename)
    {

        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $stagingFolderFilesAPI = new StagingFoldersApi(null, $config, null, 0);

        $newStagingFolderFile = new StagingFolderFileUpload();
        $newStagingFolderFile->setDocumentType($request->input("document_type"));
        $newStagingFolderFile->setExpand($request->input("expand"));

        //Check and call EDMS API
        if (!$newStagingFolderFile->valid())
            return response()->json($newStagingFolderFile->listInvalidProperties(), 500);
        else $responseEDMS = $stagingFolderFilesAPI->stagingFoldersFileUploadCreate($staging_folder_pk, $encoded_filename, $newStagingFolderFile);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    public function show($id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $StagingFolderFilesAPI = new StagingFoldersApi(null, $config, null, 0);

        //Call EDMS API
        $responseEDMS = $StagingFolderFilesAPI->stagingFoldersRead($id);

        return Response::json($responseEDMS->getContainer(), 200);

    }

    /*public function update(Request $request, $id)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $stagingFolderFilesAPI = new StagingFoldersApi(null, $config, null, 0);

        $updatedStagingFolderFile = new WritableStagingFolderFile();
        $updatedStagingFolderFile->setDeleteTimePeriod($request->input("delete_time_period"));
        $updatedStagingFolderFile->setDeleteTimeUnit($request->input("delete_time_unit"));
        $updatedStagingFolderFile->setLabel($request->input("label"));
        $updatedStagingFolderFile->setTrashTimePeriod($request->input("trash_time_period"));
        $updatedStagingFolderFile->setTrashTimeUnit($request->input("trash_time_unit"));

        //Check and call EDMS API
        if (!$updatedStagingFolderFile->valid())
            return response()->json($updatedStagingFolderFile->listInvalidProperties(), 500);
        else $responseEDMS = $stagingFolderFilesAPI->stagingFolderFilesUpdate($id, $updatedStagingFolderFile);

        return Response::json($responseEDMS->getContainer(), 200);

    }*/

    public function destroy($staging_folder_pk, $encoded_filename)
    {

        //Configure EDMS API
        $config = new Configuration();
        $config->setAccessToken("Token 997a87b1e3d12e4daff460c4441af558995c1fa3");
        $stagingFolderFilesAPI = new StagingFoldersApi(null, $config, null, 0);

        //Call EDMS API
        $stagingFolderFilesAPI->stagingFoldersFileDelete($staging_folder_pk, $encoded_filename);

        return Response::json(null, 200);

    }

}
