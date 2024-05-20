<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use SoftDeletes;

    protected $table = 'property';

    public $timestamps = true;

    protected $fillable = [
        'ent_type_id',
        'value_type',
        'scope',
        'unit_type_id',
        'state',
        'fk_property_id',
        'fk_ent_type_id',
        'requires_translation',
        'form_field_size',
		'updated_by',
        'deleted_by'
    ];

    public function entType() {
        return $this->belongsTo('App\EntType', 'ent_type_id', 'id');
    }

    public function fkProperty() {
        return $this->belongsTo('App\Property', 'fk_property_id', 'id');
    }

    public function associatedProperties() {
        return $this->hasMany('App\Property', 'fk_property_id', 'id');
    }

    public function values() {
        return $this->hasMany('App\Value', 'property_id', 'id');
    }

    public function units() {
        return $this->belongsTo('App\PropUnitType', 'unit_type_id', 'id');
    }

    public function propAllowedValues() {
        return $this->hasMany('App\PropAllowedValue', 'property_id', 'id');
    }

    public function language() {
        return $this->belongsToMany('App\Language', 'property_name', 'property_id', 'language_id')->withPivot('name','form_field_name','created_at','updated_at','deleted_at');
    }

	public function queries() {

        return $this->belongsToMany('App\Query', 'property_can_read_result', 'reading_property', 'providing_result')->withPivot('output_type','created_at','updated_at','deleted_at');
    }

    public function conditions() {

        return $this->hasMany('App\Condition', 'property_id', 'id');
    }

	public function prop_ext_names()
    {
        return $this->hasMany('App\PropExtName');
    }

    public function action() {
        return $this->belongsTo('App\Action', 'action_id', 'id');
    }

    public function curFormComputeCode() {
        return $this->belongsTo('App\CurFormComputeCode', 'cur_form_compute_code_id', 'id');
    }

	public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }

    //$name é o nome do campo do qual quero obter os valores enum
    public static function getValoresEnum($name, $table){
        $type = DB::select(DB::raw('SHOW COLUMNS FROM '.$table.' WHERE Field = "'.$name.'"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        return $values;
    }


}
