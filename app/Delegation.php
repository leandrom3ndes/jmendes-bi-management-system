<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delegation extends \Illuminate\Database\Eloquent\Relations\Pivot
{
    use SoftDeletes;

    protected $table = 'delegation';

    public $timestamps = true;

    protected $fillable = [
        'delegates_role_id',
        'delegated_role_id',
        't_state_id',
        'start_time',
        'end_time',
        'state',
		'updated_by',
        'deleted_by'
    ];

    protected $guarded = [];

    public function delegates_role()
    {
        return $this->belongsTo('App\Role', 'delegates_role_id', 'id');
    }

    public function delegated_role()
    {
        return $this->belongsTo('App\Role', 'delegated_role_id', 'id');
    }

    public function t_state()
    {
        return $this->belongsTo('App\TState', 't_state_id', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy()
    {
        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
