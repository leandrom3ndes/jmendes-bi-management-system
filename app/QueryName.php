<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QueryName extends Model
{
    use SoftDeletes;

    protected $table = 'query_name';

    public $timestamps = true;

    protected $primaryKey = ['query_id','language_id'];
    public $incrementing = false;

    protected $fillable = [
        'query_id',
        'language_id',
        'name',
        'updated_by',
        'deleted_by'
    ];

    public function queryId() {
        return $this->belongsTo('App\Query','query_id','id');
    }

    public function language() {
        return $this->belongsTo('App\Language','language_id','id');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
