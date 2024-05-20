<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TermHasPropAllowedValue extends Model
{
    use SoftDeletes;

    protected $table = 'term_has_prop_allowed_value';

    public $timestamps = true;

    protected $primaryKey = ['term_id','prop_allowed_value_id'];
    public $incrementing = false;

    protected $fillable = [
        'term_id',
        'prop_allowed_value_id',
        'updated_by',
        'deleted_by'
    ];

    public function term() {
        return $this->belongsTo('App\Term','term_id','id');
    }

    public function propAllowedValue() {
        return $this->belongsTo('App\PropAllowedValue','prop_allowed_value_id','id');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }

}
