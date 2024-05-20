<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropAllowedValue extends Model
{
    use SoftDeletes;

    protected $table = 'prop_allowed_value';

    public $timestamps = true;

    protected $fillable = [
        'property_id',
        'state',
		'updated_by',
        'deleted_by'
    ];

    protected $guarded = [];

    public function property() {
        return $this->belongsTo('App\Property', 'property_id', 'id');
    }

    public function language() {
        return $this->belongsToMany('App\Language', 'prop_allowed_value_name', 'p_a_v_id', 'language_id')->withPivot('name','created_at','updated_at','deleted_at');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
