<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use DB;

class PropertyController extends Controller
{

    public function index(Request $request)
        {
            return Property::all();
        }

    public function store(Request $request)
    {
        $property = Property::create($request->all());

    }

    public function show($id)
    {
        return Property::findOrFail($id);
    }

    public function update(Request $request, $id)
    {

        $property_existent = Property::findOrFail($id);

        $property_existent->update($request->all());
    }

    public function destroy($id)
    {
        $property_existent = Property::findOrFail($id);

        $property_existent->delete();
    }

    // Função que permite obter os prop allowed values para um dado id de propriedade e da linguagem do utilizador
    public function getPropertyAllowedValues(Request $request, $id)
    {
        $langId = $request->user()->language_id;

        $values = DB::table('property')
                    ->join('prop_allowed_value', 'property.id', '=', 'prop_allowed_value.property_id')
                    ->join('prop_allowed_value_name', 'prop_allowed_value.id', '=', 'prop_allowed_value_name.p_a_v_id')
                    ->select('prop_allowed_value_name.name AS label', 'prop_allowed_value.id AS value')
                    ->where([['property.id', '=', $id], ['prop_allowed_value.state', '=', 'active'], ['prop_allowed_value_name.language_id', '=', $langId]])
                    ->get();

        return $values;
    }

    // Função que permite obter os prop ref para um dado id de propriedade e da linguagem do utilizador
    public function getPropRefValues(Request $request, $id)
    {
        $langId = $request->user()->language_id;

        $referencedPropertyID = DB::table('property')->select('fk_property_id')->where([['property.id', '=', $id]])->get()->first()->fk_property_id;
        $propertyType = DB::table('property')->select('value_type')->where([['property.id', '=', $referencedPropertyID]])->get()->first()->value_type;

        if ($propertyType == 'text') {
            $values = DB::table('property')
                    ->join('value', 'property.fk_property_id', '=', 'value.property_id')
                    ->join('value_name', 'value.id', '=', 'value_name.value_id')
                    ->select('value_name.name as label', 'value.id AS value')
                    ->where([['property.id', '=', $id], ['value_name.language_id', '=', $langId]])
                    ->get();
        } else {
            $values = DB::table('property')
                    ->join('value', 'property.fk_property_id', '=', 'value.property_id')
                    ->select('value.value as label', 'value.id AS value')
                    ->where([['property.id', '=', $id]])
                    ->get();
        }

        return $values;
    }

    public function getPropRefValuesOtherLang(Request $request, $id, $langId)
    {

        $referencedPropertyID = DB::table('property')->select('fk_property_id')->where([['property.id', '=', $id]])->get()->first()->fk_property_id;
        $propertyType = DB::table('property')->select('value_type')->where([['property.id', '=', $referencedPropertyID]])->get()->first()->value_type;

        if ($propertyType == 'text') {
            $values = DB::table('property')
                    ->join('value', 'property.fk_property_id', '=', 'value.property_id')
                    ->join('value_name', 'value.id', '=', 'value_name.value_id')
                    ->select('value_name.name as label', 'value.id AS value')
                    ->where([['property.id', '=', $id], ['value_name.language_id', '=', $langId]])
                    ->get();
        } else {
            $values = DB::table('property')
                    ->join('value', 'property.fk_property_id', '=', 'value.property_id')
                    ->select('value.value as label', 'value.id AS value')
                    ->where([['property.id', '=', $id]])
                    ->get();
        }

        return $values;
    }

    public function getPropertyAllowedValuesOtherLang(Request $request, $id, $langId)
    {

        $values = DB::table('property')
                    ->join('prop_allowed_value', 'property.id', '=', 'prop_allowed_value.property_id')
                    ->join('prop_allowed_value_name', 'prop_allowed_value.id', '=', 'prop_allowed_value_name.p_a_v_id')
                    ->select('prop_allowed_value_name.name AS label', 'prop_allowed_value.id AS value')
                    ->where([['property.id', '=', $id], ['prop_allowed_value.state', '=', 'active'], ['prop_allowed_value_name.language_id', '=', $langId]])
                    ->get();

        return $values;
    }
}
