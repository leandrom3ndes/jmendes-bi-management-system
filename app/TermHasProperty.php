<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TermHasProperty extends Model
{
    use SoftDeletes;

    protected $table = 'term_has_property';

    public $timestamps = true;

    protected $primaryKey = ['term_id','property_id'];
    public $incrementing = false;

    protected $fillable = [
        'term_id',
        'property_id',
        'updated_by',
        'deleted_by'
    ];

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
