<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Process extends Model
{
    use SoftDeletes;

     protected $table = 'process';

    public $timestamps = true;

    protected $fillable = [
        'process_type_id',
		'proc_state',
        'state',
		'updated_by',
        'deleted_by'
    ];

    protected $guarded = [];

    public function processType() {
        return $this->belongsTo('App\ProcessType', 'process_type_id', 'id');
    }

    public function transactions() {
        return $this->hasMany('App\Transaction', 'process_id', 'id');
    }

    public function language() {
        return $this->belongsToMany('App\Language', 'process_name', 'process_id', 'language_id')->withPivot('name','created_at','updated_at','deleted_at');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
