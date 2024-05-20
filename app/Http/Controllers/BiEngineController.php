<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\BiEngine;

class BiEngineController extends Controller
{
    // Get All Engines
    public function getAllEngines(){
        $allEngines=DB::table('bi_engine')
            ->select('bi_engine.id',
                'bi_engine.name',
                'bi_engine.logo_preview'
            )
            ->orderBy('id','desc')
            ->get();
        $totalBiEngines=DB::table('bi_engine')->count();
        return response()->json(['allEngines'=>$allEngines,'totalBiEngines'=>$totalBiEngines]);
    }

    // Return JSON for all Engine - BiElements
    public function getEngBiElements($biEngineId){
        //$langId = $request->user()->language_id;
        $allEngBiElements = DB::table('bi_element')
            ->join('bi_element_text', 'bi_element.id', '=', 'bi_element_text.bi_element_id')
            ->join('bi_engine', 'bi_element.bi_engine_id', '=', 'bi_engine.id')
            ->join('language', 'bi_element_text.language_id', '=', 'language.id')
            ->select('bi_element.id',
                'bi_element.preview',
                'bi_element_text.language_id',
                'bi_element_text.name',
                'bi_element_text.description'
            )
            ->where([
                ['language.id', '=', 1],
                ['bi_element.bi_engine_id', '=', $biEngineId]
            ])
            ->orderBy('id','desc')
            ->get();
        $engineDetail=DB::table('bi_engine')
            ->where('id', $biEngineId)
            ->get();
        $countEngBiElements=DB::table('bi_element')
            ->where('bi_engine_id', $biEngineId)
            ->count();
        return response()->json(['allEngBiElements'=>$allEngBiElements,'totalEngBiElements'=>$countEngBiElements,'eng_name'=>$engineDetail[0]->name]);
    }

    public function storeBiEngine(Request $request) {
        // $langId = $request->user()->language_id;
        // $userId = $request->user()->id;

        DB::beginTransaction();
        try {
            // Create tuple - bi_engine Table
            $biEngine = new BiEngine;
            $biEngine->name = $request->input('name');
            $biEngine->logo_preview = $request->input('logo_preview');
            $biEngine->updated_by = 7; // $userId
            $biEngine->save();

            DB::commit();
            $success = true;
            // all good
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            // something went wrong
            header('Content-Type: application/json');
            echo json_encode($e);
        }
    }

    public function updateBiEngine(Request $request, $biEngineId) {
        // $langId = $request->user()->language_id;
        // $userId = $request->user()->id;
        $biEngine = BiEngine::find($biEngineId);

        DB::beginTransaction();
        try {
            $biEngine->name = $request->input('name');
            $biEngine->logo_preview = $request->input('logo_preview');
            $biEngine->updated_by = 7; // $userId
            $biEngine->save();

            DB::commit();
            $success = true;
            // all good
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            // something went wrong
            header('Content-Type: application/json');
            echo json_encode($e);
        }
        return response($request, 200);
    }

    public function deleteBiEngine(Request $request, $biEngineId) {

        // $userId = $request->user()->id;
        $biEngine = BiEngine::find($biEngineId);

        DB::beginTransaction();
        try {
            $biEngine->delete();

            DB::commit();
            $success = true;
            // all good
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            // something went wrong
            echo json_encode($e);
        }
        return response(null, 204);
    }

}
