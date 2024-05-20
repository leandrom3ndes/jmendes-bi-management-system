<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActorStateResource;
use App\Actor;
use App\ActorName;
use App\Http\Resources\ActorResource;
use DB;
use Illuminate\Http\Request;
use App\Http\Traits\HTTPResponseTrait;
use App\Http\Traits\OutputTypeResponseTrait;


class ActorController extends Controller
{

//    use HTTPResponseTrait, OutputTypeResponseTrait;
//    //
//    private $user_id;
//    private $lang_id;
////
//    public function __construct()
//    {
//        parent::__construct();
//        $this->middleware(function ($request, $next) {
//            $this->lang_id = $this->auth_user_actor_id;

//            $this->user_id = $this->auth_user_id;
//
//            return $next($request);
//        });
//    }

    public function index(Request $request)
    {
        //Não consigo puxar assim os actors porque quero os nomes e preciso de um join alem de agrafar os actors pela linguagem escolhida
        //$actors = Actor::get();

        $langId = $request->user()->language_id;
        /*$whatever = $request->user();
        $whatever = 1;*/

        $actors = DB::table('actor')
            ->join('actor_name', 'actor.id', '=', 'actor_name.actor_id')
            ->join('language', 'actor_name.language_id', '=', 'language.id')
            ->select('actor_name.*', 'actor.*')
            ->where('language.id', '=', $langId)->whereNull('actor.deleted_at')
            ->get();

        //dd($request->user());

        return ActorResource::collection($actors);
    }

    public function store(Request $request)
    {
//        $actor = Actor::create([
//            'name' => $request->input('name'),
//            'slug' => $request->input('slug'),
//            'state' => $request->input('state'),
//            'updated_by' => 1,
//        ]);

        $actor = new Actor;
        $actor_name = new ActorName;

//        $whatever = $request->user();
        $langId = $request->user()->language_id;
        $userId = $request->user()->id; //caçar o userId

        DB::beginTransaction();
        try {
            $actor->updated_by = $userId;
            $actor->save();

            $actor_name->actor_id = $actor->id;
            $actor_name->language_id = $langId;
            $actor_name->name = $request->input('name');
            $actor_name->updated_by = $userId;
            $actor_name->save();

            DB::commit();
            $success = true;
            // all good
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            // something went wrong
        }

    }

    public function show($id)
    {
//        $actor = Actor::where('id', $id)
//            ->first();

        $actor = Actor::where('id', $id)->first();
        if (auth()->user()) {
            $langid = auth()->user()->language_id;
        } else {
            $langid = 1;
        }
        if ($actor->actorName) {
            if ($actor->actorName->where('language_id', $langid)->first() != null) {
                $actor->name = $actor->actorName->where('language_id', $langid)->first()->name;
            } else {
                $actor->name = $actor->actorName->first()->name;
            }
        }
        if (!$actor->name) {
            $actor->name = "Undefined";
        }

        return new ActorResource($actor);
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
//        $actor_existent = Actor::find($id);
//
//        $actor_existent->name = $request->input('name');
//        $actor_existent->slug = $request->input('slug');
//        $actor_existent->state = $request->input('state');
//        $actor_existent->updated_by = 1;
//        $actor_existent->save();

        $actor = Actor::find($id);

        $langId = $request->user()->language_id;
        $userId = $request->user()->id; //caçar o userId

        DB::beginTransaction();
        try {
            $actor->update([
                'updated_by' => $userId
            ]);

//            $langid = $this->lang_id;

            $query = ['actor_id' => $actor->id, 'language_id' => $langId];
            $actor_name = ActorName::where($query)->first();

            if ($actor_name != null) {
                $actor_name = ActorName::where($query);
                $actor_name->update([
                    'name' => $request->input('name')
                ]);
                $actor_name->update([
                    'updated_by' => $userId
                ]);
            } else {
                $actor_name = new ActorName;

                $actor_name->actor_id = $actor->id;
                $actor_name->language_id = $langId;
                $actor_name->name = $request->input('name');
                $actor_name->updated_by = $userId;

                $actor_name->save();
            }
            //-------------------------------------------------------------
            DB::commit();
            $success = true;
            // all good
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            // something went wrong
        }

    }

    public function destroy($id)
    {
//        $actor_existent = Actor::find($id)->delete();
        $actor = Actor::find($id);

        DB::beginTransaction();
        try {
            $langid = 1;
            if (auth()->user()) {
                $langid = auth()->user()->language_id;
            }

            $actor->delete();

            DB::commit();
            $success = true;
            // all good
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
            // something went wrong
        }

        return response()->json(null, 204);
    }


//    public function getAll($id = null)
//    {
//        if ($id == null) {
//            $actors = DB::table('actor')
//                ->select('*')
//                ->whereNull('actor.deleted_at')
//                ->get();
//
//            /*foreach ($actors as $actor) {
//                if ($actor->updated_at) {
//                    $actor->updated_on = $actor->updated_at->format('d M Y');
//                } else {
//                    $actor->updated_on = "Undefined";
//                }
//            }*/
//
//            return response()->json($actors);
//        }else{
//            return $this->getSpec($id);
//        }
//    }
//
//    public function getSpec($id)
//    {
//        $actors = Actor::where('id',$id)->first();
//
//        return response()->json($actors);
//    }
//
//    public function insert(Request $request)
//    {
//        $actor = new Actor;
//
//        DB::beginTransaction();
//
//        try {
//            $actor->name = $request->input('name');
//            $actor->slug = $request->input('slug');
//            $actor->state = $request->input('state');
//            $actor->updated_by = $this->user_id;
//            $actor->save();
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
//        $actor = Actor::find($id);
//
//        DB::beginTransaction();
//
//        try {
//            $actor->update([
//                'name' => $request->input('name')
//            ]);
//            $actor->update([
//                'slug' => $request->input('slug')
//            ]);
//            $actor->update([
//                'state' => $request->input('state')
//            ]);
//            if (auth()->user()) {
//            $actor->update([
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
//            $actor = Actor::find($id)->delete();
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
