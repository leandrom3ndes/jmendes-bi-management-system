<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConstantName extends Model
{
    use SoftDeletes;

    protected $table = 'constant_name';

    public $timestamps = true;

    protected $primaryKey = ['constant_id','language_id'];
    public $incrementing = false;

    protected $fillable = [
        'constant_id',
        'language_id',
        'name',
        'updated_by',
        'deleted_by'
    ];

    public function constant() {
        return $this->belongsTo('App\Constant','constant_id','id');
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
