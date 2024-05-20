<?php

namespace App\Http\Controllers;

use App\Http\Traits\HTTPResponseTrait;
use DB;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SpreadsheetController extends Controller
{

    private $file_name = 'disme_bd_v_0001_import_file.xlsx';


    public function uploadSelectedSheets(Request $request)
    {

        try {

        //$whatever = $request->json();
            $payLoad = json_decode($request->getContent(),true);

            //print_r(json_decode($request->getContent(),true)['truncateTables']);
            //print_r('\n');
            //print_r($request->all());
            $truncateTable = $payLoad['truncateTables'];
        $selectedSpreadsheets = $payLoad['selectedSpreadsheets'];
        //$aquialiacola = $whatever1[0];

        //$whatever0 = $request->getContent();//json_decode($request->getContent(), true);
            //print_r($whatever0->truncateTables);
            //print_r(json_decode($whatever0));
            //print_r($whatever0['truncateTables']);
        //$whatever1 = $whatever0['truncateTables'];

        $spreadsheet = IOFactory::load(public_path("/spreadsheet/") . $this->file_name);



        //print_r($whatever1);
            //Because someone insisted in having a 0 as a PK on the t_state table


        //Get the sheet, get the data, transform the data according to laravel insert and insert
        foreach($selectedSpreadsheets as $selectedSheetName){

            $selectedSheet = $spreadsheet->getSheetByName($selectedSheetName);
            $sheetData = $selectedSheet->toArray(null, true, true, false);
            $insertArray = [];

            //Put the header data of the first line as the set of keys of an associative array with the rest of the data
            for($i = 1;$i<count($sheetData);++$i) {
                //print_r($sheetData[$i]);

                //replace "" with null
                $sheetData[$i] = array_map(function ($v) {
                    return empty($v) ? null : $v;
                }, $sheetData[$i]);

                array_push($insertArray, array_combine($sheetData[0], $sheetData[$i]));
                //$insertArray[0]["deleted_at"] = null;
                //if($insertArray[0]["deleted_at"] === "") print_r("é vazio");
}

            //$sheetData->array_map();
            //var_dump($insertArray);
                        //print_r($insertArray);
            //print_r(array(                array('id' => '2','t_state_id' => '1','transaction_type_id' => '1','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-08-29 16:11:05','updated_at' => '2018-08-29 16:11:05','deleted_at' => NULL)));
            //debugger_print($insertArray);
            //debug_zval_dump($insertArray);
            //var_export($insertArray);
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::statement('SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";');
            if($truncateTable) DB::table($selectedSheetName)->truncate();

            DB::table($selectedSheetName)->insert($insertArray);
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        }

        } catch (\Exception $e) {
            $success = false;
            return response()->json([$e->getMessage()], 500);
            // something went wrong
        }

        return response()->json(["Successfully imported the specified data tables."], 200);

    }

    public function uploadSpreadsheet(Request $request)
    {
        //Guardar ficheiro
        //$file_name = 'disme_bd_v_0001_import_file.xlsx';


            //By default the access key for the file is the file name with the extension . replaced by _
            if ($request->hasFile('disme_bd_v_0001_import_file_xlsx')) {

                $path = $request->file('disme_bd_v_0001_import_file_xlsx')
                    ->move(public_path("/spreadsheet/"), $this->file_name);
                $photoUrl = url('/', $this->file_name);

                //Get all the sheets in order to compose the multi-checkboxes
                $whatever = public_path("/spreadsheet/") . $this->file_name;
                $spreadsheet = IOFactory::load(public_path("/spreadsheet/") . $this->file_name);
                $sheets = $spreadsheet->getSheetNames();

                return response()->json($sheets, 200);
            } else {
                return response()->json(["No file in request."], 200);
            }

    }
}
