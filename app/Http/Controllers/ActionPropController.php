<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActionProp;

class ActionPropController extends Controller
{
    public function index(Request $request)
    {
        return ActionProp::all();
    }

    public function store(Request $request)
    {
        $property = ActionProp::create($request->all());

    }

    public function show($id)
    {
        return ActionProp::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $property_existent = ActionProp::findOrFail($id);

        $property_existent->update($request->all());
    }

    public function destroy($id)
    {
        $property_existent = ActionProp::findOrFail($id);

        $property_existent->delete();
    }
}
