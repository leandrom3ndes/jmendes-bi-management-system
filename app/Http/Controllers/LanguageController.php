<?php

namespace App\Http\Controllers;

use App\Http\Resources\LanguageStateResource;
use App\Language;
use App\Http\Resources\LanguageResource;
use DB;
use Illuminate\Http\Request;
use App\Http\Traits\HTTPResponseTrait;
use App\Http\Traits\OutputTypeResponseTrait;



class LanguageController extends Controller{

//    use HTTPResponseTrait, OutputTypeResponseTrait;
//    //
//    private $user_id;
//    private $lang_id;
////
//    public function __construct()
//    {
//        parent::__construct();
//        $this->middleware(function ($request, $next) {
//            $this->lang_id = $this->auth_user_language_id;

//            $this->user_id = $this->auth_user_id;
//
//            return $next($request);
//        });
//    }

    public function index(Request $request)
    {
        //$langId = $request->user()->language_id;
        //$langId++;
        $languages = Language::get();

//        dd($request->user());

        return LanguageResource::collection($languages);
    }

    public function store(Request $request)
    {
        $language = Language::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'state' => $request->input('state'),
            'updated_by' => 1,
        ]);

    }

    public function show($id)
    {
        $language = Language::where('id', $id)
            ->first();

        return new LanguageResource($language);
    }

    public function create()
    {
        //
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        $language_existent = Language::find($id);

        $language_existent->name = $request->input('name');
        $language_existent->slug = $request->input('slug');
        $language_existent->state = $request->input('state');
        $language_existent->updated_by = 1;
        $language_existent->save();
    }

    public function destroy($id)
    {
        $language_existent = Language::find($id)->delete();

        return response()->json(null, 204);
    }


//    public function getAll($id = null)
//    {
//        if ($id == null) {
//            $languages = DB::table('language')
//                ->select('*')
//                ->whereNull('language.deleted_at')
//                ->get();
//
//            /*foreach ($languages as $language) {
//                if ($language->updated_at) {
//                    $language->updated_on = $language->updated_at->format('d M Y');
//                } else {
//                    $language->updated_on = "Undefined";
//                }
//            }*/
//
//            return response()->json($languages);
//        }else{
//            return $this->getSpec($id);
//        }
//    }
//
//    public function getSpec($id)
//    {
//        $languages = Language::where('id',$id)->first();
//
//        return response()->json($languages);
//    }
//
//    public function insert(Request $request)
//    {
//        $language = new Language;
//
//        DB::beginTransaction();
//
//        try {
//            $language->name = $request->input('name');
//            $language->slug = $request->input('slug');
//            $language->state = $request->input('state');
//            $language->updated_by = $this->user_id;
//            $language->save();
//
//
//            DB::commit();
//            $success = true;
//            // all good
//        } catch (\Exception $e) {
//            $success = false;
//            DB::rollback();
//            // something went wrong
//        }
//
//        if ($success) {
//            return $this->successResponse(1);
//        }
//        else
//        {
//            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
//        }
//
//    }
//
//    public function update(Request $request, $id)
//    {
//        $language = Language::find($id);
//
//        DB::beginTransaction();
//
//        try {
//            $language->update([
//                'name' => $request->input('name')
//            ]);
//            $language->update([
//                'slug' => $request->input('slug')
//            ]);
//            $language->update([
//                'state' => $request->input('state')
//            ]);
//            if (auth()->user()) {
//            $language->update([
//                'updated_by' => $this->user_id
//            ]);
//            }
//
//            DB::commit();
//            $success = true;
//            // all good
//        } catch (\Exception $e) {
//            $success = false;
//            DB::rollback();
//            // something went wrong
//        }
//
//        if ($success) {
//            return $this->successResponse(1);
//        }
//        else
//        {
//            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
//        }
//    }
//
//
//    public function remove(Request $request, $id)
//    {
//        DB::beginTransaction();
//
//        try {
//            $language = Language::find($id)->delete();
//
//            DB::commit();
//            $success = true;
//            // all good
//        } catch (\Exception $e) {
//            $success = false;
//            DB::rollback();
//            // something went wrong
//        }
//
//        if ($success) {
//            return $this->successResponse(1);
//        }
//        else
//        {
//            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
//        }
//    }

}
