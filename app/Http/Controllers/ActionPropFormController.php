<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActionPropForm;

class ActionPropFormController extends Controller
{
    public function index(Request $request)
    {
        return ActionPropForm::all();
    }

    public function store(Request $request)
    {
        $property = ActionPropForm::create($request->all());

    }

    public function show($id)
    {
        return ActionPropForm::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $property_existent = ActionPropForm::findOrFail($id);

        $property_existent->update($request->all());
    }

    public function destroy($id)
    {
        $property_existent = ActionPropForm::findOrFail($id);

        $property_existent->delete();
    }
}
