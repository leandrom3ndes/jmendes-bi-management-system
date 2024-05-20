<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TStateName extends Model
{
    use SoftDeletes;

    protected $table = 't_state_name';

    public $timestamps = true;

    protected $fillable = [
        't_state_id',
        'language_id',
        'name',
		'slug',
		'updated_by',
        'deleted_by'
    ];

    protected $guarded = [];

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
