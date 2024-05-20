<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Value extends Model
{
    use SoftDeletes;

    protected $table = 'value';

    public $timestamps = true;

    protected $fillable = [
        'entity_id',
        'property_id',
        'value',
        'state',
		'updated_by',
        'deleted_by'
    ];

    protected $guarded = [];

    public function property() {
        return $this->belongsTo('App\Property', 'property_id', 'id');
    }

     public function entity() {
        return $this->belongsTo('App\Entity', 'entity_id', 'id');
    }

    public function language() {
        return $this->belongsToMany('App\Language', 'value_name', 'value_id', 'language_id')->withPivot('name','created_at','updated_at','deleted_at');
    }

    public function conditions() {

        return $this->hasMany('App\Condition', 'value_id', 'id');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
