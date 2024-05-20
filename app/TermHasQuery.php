<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TermHasQuery extends Model
{
    use SoftDeletes;

    protected $table = 'term_has_query';

    public $timestamps = true;

    protected $fillable = [
        'term_id',
        'query_id',
        'updated_by',
        'deleted_by'
    ];

    public function term() {
        return $this->belongsTo('App\Term','term_id','id');
    }

    public function queryId() {
        return $this->belongsTo('App\Query','query_id','id');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }

}
