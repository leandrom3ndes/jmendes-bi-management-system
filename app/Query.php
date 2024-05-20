<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Query extends Model
{
    use SoftDeletes;

    protected $table = 'query';

    public $timestamps = true;

    protected $fillable = [
        'value_type',
        'name',
        'ent_type_id',
		'updated_by',
        'deleted_by'
    ];

    public function conditions() {

        return $this->hasMany('App\Condition', 'query_id', 'id');
    }

    public function properties() {

        return $this->belongToMany('App\Property', 'property_can_read_result', 'providing_result', 'reading_property')->withPivot('output_type','created_at','updated_at','deleted_at');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }

    public function entType() {

        return $this->belongsTo('App\EntType', 'ent_type_id', 'id');
    }

    public function scopeSearchSavedQueries($query, $id, $data) {
        if ($id != null) {
            $query->where('id', $id);
        }

        if (isset($data['query']) && $data['query'] != '') {
            $query->where('query.name', 'LIKE', '%'.$data['query'].'%');
        }

        if (isset($data['entity']) && $data['entity'] != '') {
            $query->where('ent_type_name.name', 'LIKE', '%'.$data['entity'].'%');
        }

        if (isset($data['property']) && $data['property'] != '') {
            $query->where('property_name.name', 'LIKE', '%'.$data['property'].'%');
        }
    }

}
