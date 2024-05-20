<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $table = 'role';

    public $timestamps = true;

    protected $fillable = [
		'updated_by',
        'deleted_by'
	];

    protected $guarded = [];

    public function user() {

        return $this->belongsToMany('App\Users', 'role_has_user', 'role_id', 'user_id');
    }
    
    public function actor() {

    	return $this->belongsToMany('App\Actor', 'role_has_actor');
    }

    public function language() {
        return $this->belongsToMany('App\Language', 'role_name', 'role_id', 'language_id')->withPivot('name','created_at','updated_at','deleted_at');
    }


    public function delegates_role() {
        return $this->hasMany('App\Delegation', 'delegates_role_id', 'id');
    }

    public function delegated_role() {
        return $this->hasMany('App\Delegation', 'delegated_role_id', 'id');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }

    public function roleName() {
        return $this->hasMany('App\RoleName', 'role_id', 'id');
    }

    public function roleActor() {
        return $this->hasMany('App\RoleHasActor', 'role_id', 'id');
    }

    public function roleUser() {
        return $this->hasMany('App\RoleHasUser', 'role_id', 'id');
    }
}
