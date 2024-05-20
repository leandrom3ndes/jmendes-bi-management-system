<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\BiElement;
use App\BiElementText;
use App\BiElementType;
use App\BiElementTypeText;
use App\BiElementCollection;

class BiElementController extends Controller
{

    // Return ALL JSON for BiElement + text details
    public function getAllBiElements() {
        //Log::debug($request->user()->language_id);
        //$langId = $request->user()->language_id;

        $allBiElements = DB::table('bi_element')
            ->join('bi_element_text', 'bi_element.id', '=', 'bi_element_text.bi_element_id')
            ->join('language', 'bi_element_text.language_id', '=', 'language.id')
            ->select('bi_element.id',
                'bi_element.preview',
                'bi_element_text.language_id',
                'bi_element_text.name',
                'bi_element_text.description'
            )
            ->where('language.id', '=', 1)
            ->whereNull('bi_element.deleted_at')
            ->orderBy('id','desc')
            ->get();
        $totalBiElements=DB::table('bi_element')->count();
        return response()->json(['allBiElements'=>$allBiElements,'totalBiElements'=>$totalBiElements], 200);
    }

    // Return JSON for single BiElement + Text detail + Type + Engine
    public function getBiElementDetail($biElementId)
    {
        //$langId = $request->user()->language_id;
        $biElementsDetail = DB::table('bi_element')
            ->join('bi_element_text', 'bi_element.id', '=', 'bi_element_text.bi_element_id')
            ->join('bi_engine', 'bi_element.bi_engine_id', '=', 'bi_engine.id' )
            ->join('bi_element_type', 'bi_element.bi_element_type_id', '=', 'bi_element_type.id' )
            ->join('language', 'bi_element_text.language_id', '=', 'language.id')
            ->select('bi_element.*',
                'bi_element_text.language_id',
                'bi_element_text.name',
                'bi_element_text.description',
                'bi_element_type.slug AS type_slug',
                'bi_engine.name AS engine_name'
            )
            ->where([
                ['language.id', '=', 1],
                ['bi_element.id', '=', $biElementId]
            ])
            ->get();
        return response()->json(['biElementDetail'=>$biElementsDetail], 200);
    }

    // Return JSON all BiElement + Text detail + Type + Engine
    public function getAllBiElementsDetail()
    {
        //$langId = $request->user()->language_id;
        $allBiElementsDetail = DB::table('bi_element')
            ->join('bi_element_text', 'bi_element.id', '=', 'bi_element_text.bi_element_id')
            ->join('bi_engine', 'bi_element.bi_engine_id', '=', 'bi_engine.id' )
            ->join('bi_element_type', 'bi_element.bi_element_type_id', '=', 'bi_element_type.id' )
            ->join('language', 'bi_element_text.language_id', '=', 'language.id')
            ->select('bi_element.id',
                'bi_element.preview',
                'bi_element.created_at',
                'bi_element.updated_at',
                'bi_element_text.name',
                'bi_element_text.description',
                'bi_element_type.slug AS type_slug',
                'bi_engine.name AS engine_name'
            )
            ->where([
                ['language.id', '=', 1],
            ])
            ->get();
        return response()->json(['allBiElementsDetail'=>$allBiElementsDetail], 200);
    }

    // Return JSON for single BiElement + Text detail
    public function getBiUserCollection(Request $request)
    {
        //$langId = $request->user()->language_id;
        //$userId = $request->user()->id; //caçar o userId
        $biUserCollection = DB::table('bi_element')
            ->join('bi_element_collection', 'bi_element.id', '=', 'bi_element_collection.bi_element_id')
            ->join('users', 'users.id', '=', 'bi_element_collection.user_id' )
            ->join('bi_element_text', 'bi_element.id', '=', 'bi_element_text.bi_element_id')
            ->join('language', 'bi_element_text.language_id', '=', 'language.id')
            ->select(
                'bi_element.*',
                'users.id AS user_id',
                'bi_element_collection.user_id AS user_col_id',
                'bi_element_text.language_id',
                'bi_element_text.name',
                'bi_element_text.description'
            )
            ->where([
                ['language.id', '=', 1],
                ['users.id', '=', 7]
            ])
            ->get();
        return response()->json(['biUserCollection'=>$biUserCollection], 200);
    }

    // Return JSON for BiElements Types
    public function getBiElementTypeSlug(Request $request)
    {
        //$langId = $request->user()->language_id;
        //$userId = $request->user()->id; //caçar o userId
        $biElementTypeSlug = DB::table('bi_element_type')
            ->select(
                'bi_element_type.id',
                'bi_element_type.slug'
            )
            ->get();
        return response()->json(['biElementTypeSlug'=>$biElementTypeSlug], 200);
    }

    // Return JSON for single BiElement type text detail and Slug
    public function getBiElementsTypes()
    {
        //$langId = $request->user()->language_id;
        $allBiElementType = DB::table('bi_element_type')
            ->join('bi_element_type_text', 'bi_element_type.id', '=', 'bi_element_type_text.bi_element_type_id')
            ->join('language', 'bi_element_type_text.language_id', '=', 'language.id')
            ->select(
                'bi_element_type.id',
                'bi_element_type.slug',
                'bi_element_type_text.type AS name',
                'bi_element_type_text.description',
                'bi_element_type.updated_at',
                'bi_element_type.created_at'
            )
            ->where([
                ['language.id', '=', 1] //$langId
            ])
            ->get();
        $totalBiElementTypes=DB::table('bi_element_type')->count();
        return response()->json(['allBiElementType'=>$allBiElementType,'totalBiElementTypes'=>$totalBiElementTypes], 200);
    }

    // Return JSON for single BiElement type + Text detail + slug
    public function getBiElementTypeDetail($biElementTypeId)
    {
        //$langId = $request->user()->language_id;
        $biElementTypeDetail = DB::table('bi_element_type')
            ->join('bi_element_type_text', 'bi_element_type.id', '=', 'bi_element_type_text.bi_element_type_id')
            ->join('language', 'bi_element_type_text.language_id', '=', 'language.id')
            ->select(
                'bi_element_type.id',
                'bi_element_type.slug',
                'bi_element_type_text.type AS name',
                'bi_element_type_text.description',
                'bi_element_type.updated_at',
                'bi_element_type.created_at'
            )
            ->where([
                ['language.id', '=', 1],
                ['bi_element_type.id', '=', $biElementTypeId]
            ])
            ->get();
        return response()->json(['biElementTypeDetail'=>$biElementTypeDetail], 200);
    }

    public function storeBiElement(Request $request) {
        // $langId = $request->user()->language_id;
        // $userId = $request->user()->id;

        DB::beginTransaction();
        try {
            // Create tuple - bi_element Table
            $biElement = new BiElement;
            $biElement->bi_engine_id = $request->input('bi_engine_id');
            $biElement->bi_element_type_id = $request->input('bi_element_type_id');
            $biElement->preview = $request->input('preview');
            $biElement->embed = $request->input('embed');
            $biElement->updated_by = 7;
            $biElement->save();
            // Create tuple - bi_element_text Table
            $biElementText = new BiElementText;
            $biElementText->bi_element_id = $biElement->id;
            $biElementText->language_id = 1;
            $biElementText->name = $request->input('name');
            $biElementText->description = $request->input('description');
            $biElementText->updated_by = 7; // $userId
            $biElementText->save();

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

    public function storeBiUserCollection(Request $request, $biElementId) {
        // $langId = $request->user()->language_id;
        // $userId = $request->user()->id;

        DB::beginTransaction();
        try {
            // Create tuple - bi_element_collection Table
            $biElementCollection = new BiElementCollection;
            $biElementCollection->user_id = 7; // $userId
            $biElementCollection->bi_element_id = $biElementId;
            $biElementCollection->updated_by = 7;
            $biElementCollection->save();

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

    public function storeBiElementType(Request $request) {
        // $langId = $request->user()->language_id;
        // $userId = $request->user()->id;

        DB::beginTransaction();
        try {
            // Create tuple - bi_element_type Table
            $biElementType = new BiElementType;
            $biElementType->slug = $request->input('slug');
            $biElementType->updated_by = 7;
            $biElementType->save();
            // Create tuple - bi_element_type_text Table
            $biElementTypeText = new BiElementTypeText;
            $biElementTypeText->bi_element_type_id = $biElementType->id;
            $biElementTypeText->language_id = 1;
            $biElementTypeText->type = $request->input('name');
            $biElementTypeText->description = $request->input('description');
            $biElementTypeText->updated_by = 7; // $userId
            $biElementTypeText->save();

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

    public function updateBiElement(Request $request, $biElementId) {
        // $langId = $request->user()->language_id;
        // $userId = $request->user()->id;
        $biElement = BiElement::find($biElementId);

        DB::beginTransaction();
        try {
            $biElement->bi_engine_id = $request->input('bi_engine_id');
            $biElement->bi_element_type_id = $request->input('bi_element_type_id');
            $biElement->preview = $request->input('preview');
            $biElement->embed = $request->input('embed');
            $biElement->updated_by = 7; // $userId
            $biElement->save();

            $query = ['bi_element_id' => $biElement->id, 'language_id' => 1];
            $biElement_text = BiElementText::where($query)->first();

            if ($biElement_text != null) {
                $biElement_text = BiElementText::where($query);
                $biElement_text->update([
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'updated_by' => 7 // $userId
                ]);
            } else {
                $biElement_text = new BiElementText;
                $biElement_text->bi_element_id = $biElement->id;
                $biElement_text->language_id = 1;
                $biElement_text->name = $request->input('name');
                $biElement_text->description = $request->input('description');
                $biElement_text->updated_by = 7; // $userId
                $biElement_text->save();
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

    public function updateBiElementType(Request $request, $biElementTypeId) {
        // $langId = $request->user()->language_id;
        // $userId = $request->user()->id;
        $biElementType = BiElementType::find($biElementTypeId);

        DB::beginTransaction();
        try {
            $biElementType->slug = $request->input('slug');
            $biElementType->updated_by = 7; // $userId
            $biElementType->save();

            $query = ['bi_element_type_id' => $biElementType->id, 'language_id' => 1];
            $biElement_type_text = BiElementTypeText::where($query)->first();

            if ($biElement_type_text != null) {
                $biElement_type_text = BiElementTypeText::where($query);
                $biElement_type_text->update([
                    'type' => $request->input('name'),
                    'description' => $request->input('description'),
                    'updated_by' => 7 // $userId
                ]);
            } else {
                $biElement_type_text = new BiElementTypeText;
                $biElement_type_text->bi_element_type_id = $biElementType->id;
                $biElement_type_text->language_id = 1;
                $biElement_type_text->type = $request->input('name');
                $biElement_type_text->description = $request->input('description');
                $biElement_type_text->updated_by = 7; // $userId
                $biElement_type_text->save();
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

    public function deleteBiElement(Request $request, $biElementId) {

        // $userId = $request->user()->id;
        $biElement = BiElement::find($biElementId);

        DB::beginTransaction();
        try {
            $biElement->delete();

            $query = ['bi_element_id' => $biElement->id, 'language_id' => 1];
            $biElement_text = BiElementText::where($query);

            $biElement_text->delete();

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

    public function deleteBiUserCollection(Request $request, $biElementId) {
        // $userId = $request->user()->id;
        DB::beginTransaction();
        try {

            $query = ['bi_element_id' => $biElementId, 'user_id' => 7];
            $biElementCollection = BiElementCollection::where($query);

            $biElementCollection->delete();

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

    public function deleteBiElementType(Request $request, $biElementTypeId) {

        // $userId = $request->user()->id;
        $biElementType = BiElementType::find($biElementTypeId);

        DB::beginTransaction();
        try {
            $biElementType->delete();

            $query = ['bi_element_type_id' => $biElementType->id, 'language_id' => 1];
            $biElement_type_text = BiElementTypeText::where($query);

            $biElement_type_text->delete();

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
