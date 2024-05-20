<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssignExpression extends Model
{
    use SoftDeletes;

    protected $table = 'assign_expression';

    public $timestamps = true;

    protected $primaryKey = ['property_id','term_id'];
    public $incrementing = false;

    protected $fillable = [
        'property_id',
        'term_id',
        'action_id',
        'updated_by',
        'deleted_by'
    ];

    public function property() {
        return $this->belongsTo('App\Property','property_id','id');
    }

    public function term() {
        return $this->belongsTo('App\Term','term_id','id');
    }

    public function action() {
        return $this->belongsTo('App\Action','action_id','id');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
