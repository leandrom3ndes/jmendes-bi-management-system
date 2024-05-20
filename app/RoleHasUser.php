<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleHasUser extends Model
{
    //use SoftDeletes;

    protected $table = 'role_has_user';

    public $timestamps = true;

    protected $fillable = [
        'role_id',
        'user_id',
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
