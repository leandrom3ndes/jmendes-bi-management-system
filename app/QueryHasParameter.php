<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QueryHasParameter extends Model
{
    use SoftDeletes;

    protected $table = 'query_has_parameter';

    public $timestamps = true;

    protected $primaryKey = ['query_id','property_id'];
    public $incrementing = false;

    protected $fillable = [
        'query_id',
        'property_id',
        'updated_by',
        'deleted_by'
    ];

    public function queryId() {
        return $this->belongsTo('App\Query','query_id','id');
    }

    public function property() {
        return $this->belongsTo('App\Property','property_id','id');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
