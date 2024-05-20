<?php



namespace App\Http\Controllers;

use App\Http\Resources\ProcessTypeResource;
use App\Http\Traits\HTTPResponseTrait;
use App\Http\Traits\OutputTypeResponseTrait;
use App\ProcessType;
use App\ActorName;
use App\Language;
use App\ProcessTypeName;
use DB;
use Illuminate\Http\Request;
use Config;


class ProcessTypeController extends Controller
{

    //Preciso disto porque senão consigo puxar o
    use HTTPResponseTrait, OutputTypeResponseTrait;

    //Preciso disto aqui senão não tenho acesso na function do WhereNotIn
    protected $langId;
    private $userId;

    public function index(Request $request)
    {
        //Não consigo puxar assim os actors porque quero os nomes e preciso de um join alem de agrafar os actors pela linguagem escolhida
        //$actors = Actor::get();

        $langId = $request->user()->language_id;

        $fallback_locale = Config::get('app.fallback_locale');
        $langid_fallback_locale = Language::where('slug', '=', $fallback_locale)->first();

        $procs_user_lang = DB::table('process_type')
            ->join('process_type_name', 'process_type.id', '=', 'process_type_name.process_type_id')
            ->join('language as l1', 'process_type_name.language_id', '=', 'l1.id')
            ->select('process_type.*', 'process_type_name.*', 'l1.name as language_name')
            ->where('l1.id', '=', $langId)
            ->get();

        $procs_other_langs = DB::table('process_type')
            ->join('process_type_name', 'process_type.id', '=', 'process_type_name.process_type_id')
            ->join('language as l1', 'process_type_name.language_id', '=', 'l1.id')
            ->select('process_type.*', 'process_type_name.*', 'l1.name as language_name')
            ->where('l1.id', '=', $langid_fallback_locale)
            ->whereNotIn('process_type.id', function ($query) {
                $query->select('process_type_name.process_type_id')->from('process_type_name')
                    ->where('process_type_name.language_id', '=', $this->langId);
            })
            ->get();

        $merged = $procs_other_langs->merge($procs_user_lang);

//        dd($request->user());

        return ProcessTypeResource::collection($merged);
    }

    private function arrDataProcessType($processtype, $request, $arrDataType)
    {


        if ($arrDataType === 'update') {
            $attributes = array(
                'name' => $request[0], //name
                'updated_by' => $this->userId
            );
            $processtype->language()->updateExistingPivot($processtype->language->first()->id, $attributes);
        }

        $processtype->state = $request[1]; //state
        $processtype->updated_by = $this->userId;

        $processtype->save();

        return $processtype;
    }

    private function arrDataProcessTypeName($request, $process_type)
    {

        /*$langId = $request->language()->id;
        $userId = $request->user()->id;*/

        $processtypename = new ProcessTypeName;

        $processtypename->name = $request[0];
        $processtypename->language_id = $this->langId;

        $processtypename->process_type_id = $process_type->id;
        $processtypename->updated_by = $this->userId;

        $processtypename->save();
    }

    public function store(Request $request)
    {

        $this->langId = $request->user()->language_id;
        $this->userId = $request->user()->id;

        $process_type_new = new ProcessType();

        $dataRequest = array(
            $request->input('name'),
            $request->input('state')
        );

        DB::beginTransaction();
        try {
            //Insere um novo process type na tabela, a função recebe o novo objecto vazio, o array com os inputs do request e
            //o tipo de operação insert ou update
            $process_type_inserted = $this->arrDataProcessType($process_type_new, $dataRequest, 'insert');

            //Insere o nome do process type na tabela process type name, a função recebe o array com os inputs do request e
            //o objecto process type que foi inserido na tabela com a função anterior
            $this->arrDataProcessTypeName($dataRequest, $process_type_inserted);

            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
        }


        /*
        //        $actor = Actor::create([
        //            'name' => $request->input('name'),
        //            'slug' => $request->input('slug'),
        //            'state' => $request->input('state'),
        //            'updated_by' => 1,
        //        ]);

                $process_types = new ProcessType;
                $$process_types_name = new ProcessTypeName;

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
                }*/

    }

    /*public function getProcessTypesStates()
    {
        $values = ProcessType::getPossibleStates('state');
        $states = [];
        $i = 0;
        foreach($values as $value){
            $states[$i]['id'] = $i+1;
            $states[$i]['state'] = $value;
            $i++;
        }
        return $states;
    }*/

    public function show($id)
    {

        $this->langId = auth()->user()->language_id;

        $procs = ProcessType::with(['language' => function ($query) {
            $query->where('id', $this->langId);
        }])->find($id);

        $ret = $this->outputDataType('JSON', $procs);

        return $ret;
        /*return new ProcessTypeResource($procs);*/


        /*
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

        return new ActorResource($actor);*/
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

        $this->langId = auth()->user()->language_id;
        $this->userId = $request->user()->id;

        $processtype_existent = ProcessType::with(['language' => function ($query) {
            $query->where('id', $this->langId);
        }])->find($id);

        $dataRequest = array(
            $request->input('language.0.pivot.name'),
            $request->input('state')
        );

        DB::beginTransaction();
        try {
            $process_type_updated = $this->arrDataProcessType($processtype_existent, $dataRequest, 'update');

            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
        }

        if ($success) {
            return $this->successResponse(1);
        } else {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }


        /*
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
        }*/

    }

    public function destroy($id)
    {

        $this->langId = auth()->user()->language_id;

        $processtype = ProcessType::with(['language' => function ($query) {
            $query->where('id', $this->langId);
        }])->find($id);

        DB::beginTransaction();
        try {
            $processtype->language()->detach(); //apaga todos os nomes deste process type, se for só um nome de um certo idioma colocar o id do language
            $processtype->delete();

            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
        }

        return response()->json(null, 204);

        /*if ($success) {
            return $this->successResponse(1);
        }
        else
        {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }*/

        /*//        $actor_existent = Actor::find($id)->delete();
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

                return response()->json(null, 204);*/
    }

}
