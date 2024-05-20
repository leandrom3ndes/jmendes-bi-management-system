<?php

namespace App\Http\Controllers;

use App\Action;
use App\ActionName;
use App\Http\Resources\ActionResource;
use DB;

use Illuminate\Http\Request;
use App\Http\Traits\HTTPResponseTrait;
use App\Http\Traits\OutputTypeResponseTrait;

class ActionController extends Controller
{
    // Função que permite obter as ações existentes com base na linguagem do utilizador
    public function index(Request $request)
    {
        //return Action::all();

        $langId = $request->user()->language_id;

        $actions = DB::table('action')
            ->join('action_name', 'action.id', '=', 'action_name.action_id')
            ->join('language', 'action_name.language_id', '=', 'language.id')
            ->select('action_name.*', 'action.*')
            ->where('language.id', '=', $langId)->whereNull('action.deleted_at')
            ->get();

        return ActionResource::collection($actions);
    }

    public function store(Request $request)
    {
        $property = Action::create($request->all());

    }

    public function show($id)
    {
        return Action::findOrFail($id);
    }

    public function update(Request $request, $id)
    {

        $property_existent = Action::findOrFail($id);

        $property_existent->update($request->all());
    }

    public function destroy($id)
    {
        $property_existent = Action::findOrFail($id);

        $property_existent->delete();
    }
}
