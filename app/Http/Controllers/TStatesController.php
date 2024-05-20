<?php



namespace App\Http\Controllers;

use App\Http\Resources\ProcessTypeResource;
use App\Http\Resources\TStateResource;
use App\Http\Traits\HTTPResponseTrait;
use App\Http\Traits\OutputTypeResponseTrait;
use App\Language;
use App\TState;
use App\TStateName;
use DB;
use Illuminate\Http\Request;
use Config;
use App\Http\Requests\ValTState;


class TStatesController extends Controller
{

    use HTTPResponseTrait, OutputTypeResponseTrait;
    //
    private $user_id;
    private $lang_id;
    private $lang_id_fallback_locale;



    public function getAll(Request $request,$id = null)
    {
        if ($id == null)
        {
            $tstates = DB::table('t_state')
                ->join('t_state_name', 't_state.id', '=', 't_state_name.t_state_id')
                ->join('language as l1', 't_state_name.language_id', '=', 'l1.id')
                ->select('t_state.*', 't_state_name.*')
                ->where('l1.id','=', $this->lang_id)
                ->get();

            $tstates_other_langs = DB::table('t_state')
                ->join('t_state_name', 't_state.id', '=', 't_state_name.t_state_id')
                ->join('language as l1', 't_state_name.language_id', '=', 'l1.id')
                ->select('t_state.*', 't_state_name.*')
                ->where('l1.id','=', $this->lang_id_fallback_locale)
                ->whereNotIn('t_state.id', function ($query) {
                    $query->select('t_state_name.t_state_id')->from('t_state_name')
                        ->where('t_state_name.language_id', '=', $this->lang_id);
                })
                ->get();

            $merged = $tstates_other_langs->merge($tstates);

            return response()->json($merged);
        }
        else
        {
            return $this->outputDataType('JSON', $this->getSpec($id));
        }
    }

    public function index(Request $request)
    {

        $this->lang_id = $request->user()->language_id;

        $fallback_locale = Config::get('app.fallback_locale');
        $this->lang_id_fallback_locale = Language::where('slug', '=', $fallback_locale)->first();

        $tstates = DB::table('t_state')
            ->join('t_state_name', 't_state.id', '=', 't_state_name.t_state_id')
            ->join('language as l1', 't_state_name.language_id', '=', 'l1.id')
            ->select('t_state.*', 't_state_name.*')
            ->where('l1.id','=', $this->lang_id)
            ->get();

        $tstates_other_langs = DB::table('t_state')
            ->join('t_state_name', 't_state.id', '=', 't_state_name.t_state_id')
            ->join('language as l1', 't_state_name.language_id', '=', 'l1.id')
            ->select('t_state.*', 't_state_name.*')
            ->where('l1.id','=', $this->lang_id_fallback_locale)
            ->whereNotIn('t_state.id', function ($query) {
                $query->select('t_state_name.t_state_id')->from('t_state_name')
                    ->where('t_state_name.language_id', '=', $this->lang_id);
            })
            ->get();

        $merged = $tstates_other_langs->merge($tstates);

        return TStateResource::collection($merged);
    }

    private function arrDataTState($tstate, $request, $arrDataType)
    {
        if ($arrDataType === 'update')
        {
            $attributes = array(
                'name' => $request[0],
                'updated_by' => $this->user_id
            );
            $tstate->language()->updateExistingPivot($tstate->language->first()->id, $attributes);
        }

        $tstate->updated_by = $this->user_id;

        $tstate->save();

        return $tstate;
    }

    private function arrDataTStateName($request, $t_state)
    {
        $tstatename = new TStateName;

        $tstatename->name = $request[0];
        $tstatename->language_id = $this->lang_id;

        $tstatename->t_state_id = $t_state->id;
        $tstatename->updated_by = $this->user_id;

        $tstatename->save();
    }

    public function store(ValTState $request)
    {
        $t_state_new = new TState;
        $this->lang_id = $request->user()->language_id;
        $dataRequest = array(
            $request->input('name')
        );

        DB::beginTransaction();
        try {
            //Insere um novo t state na tabela, a função recebe o novo objecto vazio, o array com os inputs do request e
            //o tipo de operação insert ou update
            $t_state_inserted = $this->arrDataTState($t_state_new, $dataRequest, 'insert');

            //Insere o nome do transaction type na tabela transaction type name, a função recebe o array com os inputs do request e
            //o objecto transaction type que foi inserido na tabela com a função anterior
            $this->arrDataTStateName($dataRequest, $t_state_inserted);

            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
        }

        if ($success) {
            return $this->successResponse(1);
        }
        else
        {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }
    }

    public function update(ValTState $request, $id)
    {

        $this->lang_id = $request->user()->language_id;
        $tstate_existent = $this->getSpec($id);

        $dataRequest = array(
            //$request->input('name')
            $request->input('language.0.pivot.name')
        );

        DB::beginTransaction();
        try {
            $t_state_updated = $this->arrDataTState($tstate_existent, $dataRequest, 'update');

            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
        }

        if ($success) {
            return $this->successResponse(1);
        }
        else
        {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }
    }

    public function insertName(ValTState $request, $id)
    {
        $t_state_existent = TState::find($id);

        $dataRequest = array(
            $request->input('name')
        );

        DB::beginTransaction();
        try {
            $this->arrDataTStateName($dataRequest, $t_state_existent);

            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
        }

        if ($success) {
            return $this->successResponse(1);
        }
        else
        {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }
    }

    public function destroy(/*Request $request,*/ $id)
    {
        $tstate_existent = $this->getSpec($id);

        DB::beginTransaction();
        try {
            $tstate_existent->language()->detach();
            $tstate_existent->delete();

            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
        }

        if ($success) {
            return $this->successResponse(1);
        }
        else
        {
            return $this->errorResponse(3, isset($e) ? $e->getMessage() . ' | Code Line: ' . $e->getLine() : null);
        }
    }

    public function show($id){

        $this->lang_id = auth()->user()->language_id;

        $ret = $this->outputDataType('JSON', $this->getSpec($id));

        return $ret;
    }

    public function getSpec($id)
    {
        $tstates = TState::with(['language' => function($query) {
            $query->where('id', $this->lang_id);
        }])/*->whereHas('language', function ($query) {
            return $query->where('id', $this->lang_id);
        })*/->find($id);

        return $tstates;
    }

}
