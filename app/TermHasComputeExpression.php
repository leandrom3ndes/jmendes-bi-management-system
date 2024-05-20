<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TermHasComputeExpression extends Model
{
    use SoftDeletes;

    protected $table = 'term_has_compute_expression';

    public $timestamps = true;

    protected $primaryKey = ['term_id','compute_expression_id'];
    public $incrementing = false;

    protected $fillable = [
        'term_id',
        'compute_expression_id',
        'updated_by',
        'deleted_by'
    ];

    public function term() {
        return $this->belongsTo('App\Term','term_id','id');
    }

    public function computeExpression() {
        return $this->belongsTo('App\ComputeExpression','compute_expression_id','id');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
