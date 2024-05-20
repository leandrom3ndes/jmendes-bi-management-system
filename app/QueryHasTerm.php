<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QueryHasTerm extends Model
{
    use SoftDeletes;

    protected $table = 'query_has_term';

    public $timestamps = true;

    protected $primaryKey = ['term_has_query_id','term_id'];
    public $incrementing = false;

    protected $fillable = [
        'term_has_query_id',
        'term_id',
        'property_id',
        'updated_by',
        'deleted_by'
    ];

    public function termHasQuery() {
        return $this->belongsTo('App\TermHasQuery','term_has_query_id','id');
    }

    public function term() {
        return $this->belongsTo('App\Term','term_id','id');
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
