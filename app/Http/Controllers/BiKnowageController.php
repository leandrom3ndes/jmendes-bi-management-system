<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\BiKnowage;
use App\BiKnowageText;
use App\BiKnowageSettings;

class BiKnowageController extends Controller
{
    // Return ALL JSON for BiKnowage + text + settings
    public function getAllBiKnowage()
    {
        //$request = json_decode(file_get_contents('php://input'));
        //Log::debug($request->user()->language_id);
        //$langId = $request->user()->language_id;

        $allBiKnowage = DB::table('bi_knowage')
            ->join('bi_knowage_text', 'bi_knowage.id', '=', 'bi_knowage_text.bi_knowage_id')
            ->join('language', 'bi_knowage_text.language_id', '=', 'language.id')
            ->select('bi_knowage.id',
                'bi_knowage.preview',
                'bi_knowage_text.language_id',
                'bi_knowage_text.name',
                'bi_knowage_text.description'
            )
            ->where('language.id', '=', 1)
            ->orderBy('id','desc')
            ->get();
        $totalBiKnowage=DB::table('bi_knowage')->count();
        return response()->json(['allBiKnowage'=>$allBiKnowage,'totalBiKnowage'=>$totalBiKnowage], 200);
    }

    // Return JSON for single BiElement + Text detail
    public function getBiKnowageDetail($biKnowageId)
    {
        //$langId = $request->user()->language_id;
        $biKnowageDetail = DB::table('bi_knowage')
            ->join('bi_knowage_text', 'bi_knowage.id', '=', 'bi_knowage_text.bi_knowage_id')
            ->join('bi_knowage_settings', 'bi_knowage.id', '=', 'bi_knowage_settings.bi_knowage_id' )
            ->join('language', 'bi_knowage_text.language_id', '=', 'language.id')
            ->select('bi_knowage.*',
                'bi_knowage_text.name',
                'bi_knowage_text.description',
                'bi_knowage_settings.display_toolbar AS toolbar',
                'bi_knowage_settings.display_sliders AS sliders',
                'bi_knowage_settings.reset_parameters AS parameters'
            )
            ->where([
                ['language.id', '=', 1],
                ['bi_knowage.id', '=', $biKnowageId]
            ])
            ->get();
        return response()->json(['biKnowageDetail'=>$biKnowageDetail], 200);
    }

    // Return JSON all BiKnowage + Text detail
    public function getAllBiKnowageDetail()
    {
        //$langId = $request->user()->language_id;
        $allBiKnowageDetail = DB::table('bi_knowage')
            ->join('bi_knowage_text', 'bi_knowage.id', '=', 'bi_knowage_text.bi_knowage_id')
            ->join('language', 'bi_knowage_text.language_id', '=', 'language.id')
            ->select('bi_knowage.id',
                'bi_knowage.label',
                'bi_knowage.preview',
                'bi_knowage.type',
                'bi_knowage.role',
                'bi_knowage.dataset_label',
                'bi_knowage_text.name',
                'bi_knowage_text.description',
                'bi_knowage.created_at',
                'bi_knowage.updated_at',
            )
            ->where([
                ['language.id', '=', 1]
            ])
            ->get();
        return response()->json(['allBiKnowageDetail'=>$allBiKnowageDetail], 200);
    }

    public function storeBiKnowage(Request $request) {
        // $langId = $request->user()->language_id;
        // $userId = $request->user()->id;

        DB::beginTransaction();
        try {
            // Create tuple - bi_knowage Table
            $biKnowage = new BiKnowage;
            $biKnowage->label = $request->input('label');
            $biKnowage->preview = $request->input('preview');
            $biKnowage->type = $request->input('type');
            $biKnowage->role = $request->input('role');
            $biKnowage->dataset_label = $request->input('dataset_label');
            $biKnowage->updated_by = 7;
            $biKnowage->save();
            // Create tuple - bi_knowage_text Table
            $biKnowageText = new BiKnowageText;
            $biKnowageText->bi_knowage_id = $biKnowage->id;
            $biKnowageText->language_id = 1;
            $biKnowageText->name = $request->input('name');
            $biKnowageText->description = $request->input('description');
            $biKnowageText->updated_by = 7; // $userId
            $biKnowageText->save();
            // Create tuple - bi_knowage_settings Table
            $biKnowageSettings = new BiKnowageSettings;
            $biKnowageSettings->bi_knowage_id = $biKnowage->id;
            $biKnowageSettings->display_toolbar = $request->input('display_toolbar');
            $biKnowageSettings->display_sliders = $request->input('display_sliders');
            $biKnowageSettings->reset_parameters = $request->input('reset_parameters');
            $biKnowageSettings->updated_by = 7; // $userId
            $biKnowageSettings->save();

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

    public function updateBiKnowage(Request $request, $biKnowageId) {
        // $langId = $request->user()->language_id;
        // $userId = $request->user()->id;
        $biKnowage = BiKnowage::find($biKnowageId);

        DB::beginTransaction();
        try {
            $biKnowage->label = $request->input('label');
            $biKnowage->preview = $request->input('preview');
            $biKnowage->type = $request->input('type');
            $biKnowage->role = $request->input('role');
            $biKnowage->dataset_label = $request->input('dataset_label');
            $biKnowage->updated_by = 7;
            $biKnowage->save();

            $queryText = ['bi_knowage_id' => $biKnowage->id, 'language_id' => 1];
            $querySettings = ['bi_knowage_id' => $biKnowage->id];

            $biKnowageText = BiKnowageText::where($queryText)->first();
            $biKnowageSettings = BiKnowageSettings::where($querySettings)->first();

            if ($biKnowageText != null || $biKnowageSettings != null) {
                $biKnowageText = BiKnowageText::where($queryText);
                $biKnowageText->update([
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'updated_by' => 7 // $userId
                ]);
                $biKnowageSettings = BiKnowageSettings::where($querySettings);
                $biKnowageSettings->update([
                    'display_toolbar' => $request->input('display_toolbar'),
                    'display_sliders' => $request->input('display_sliders'),
                    'reset_parameters' => $request->input('reset_parameters'),
                    'updated_by' => 7 // $userId
                ]);
            } else {
                $biKnowageText = new BiKnowageText;
                $biKnowageText->bi_knowage_id = $biKnowage->id;
                $biKnowageText->language_id = 1;
                $biKnowageText->name = $request->input('name');
                $biKnowageText->description = $request->input('description');
                $biKnowageText->updated_by = 7; // $userId
                $biKnowageText->save();

                $biKnowageSettings = new BiKnowageSettings;
                $biKnowageSettings->bi_knowage_id = $biKnowage->id;
                $biKnowageSettings->display_toolbar = $request->input('display_toolbar');
                $biKnowageSettings->display_sliders = $request->input('display_sliders');
                $biKnowageSettings->reset_parameters = $request->input('reset_parameters');
                $biKnowageSettings->updated_by = 7; // $userId
                $biKnowageSettings->save();
            }
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

    public function deleteBiKnowage(Request $request, $biElementId) {

        // $userId = $request->user()->id;
        $biKnowage = BiKnowage::find($biElementId);

        DB::beginTransaction();
        try {
            $biKnowage->delete();

            $queryText = ['bi_knowage_id' => $biKnowage->id, 'language_id' => 1];
            $querySettings = ['bi_knowage_id' => $biKnowage->id];

            $biKnowageText = BiKnowageText::where($queryText);
            $biKnowageSettings = BiKnowageSettings::where($querySettings);

            $biKnowageText->delete();
            $biKnowageSettings->delete();

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
