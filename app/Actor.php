<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actor extends Model
{

    use SoftDeletes;

    protected $table = 'actor';

    public $timestamps = true;

    //?
    protected $fillable = [
		'updated_by',
        'deleted_by'
	];

    protected $guarded = [];

    public function role() {

    	return $this->belongsToMany('App\Role', 'role_has_actor');
    }

    public function executaTransactionType() {

    	return $this->hasMany('App\TransactionType', 'executer', 'id');
    }

    public function iniciaTransactionType() {

    	return $this->belongsToMany('App\TransactionType', 'actor_iniciates_t')->withPivot('created_at','updated_at','deleted_at');
    }

	public function language() {

        return $this->belongsToMany('App\Language', 'actor_name', 'actor_id', 'language_id')->withPivot('name','created_at','updated_at','deleted_at');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }

    public function actorName() {
        return $this->hasMany('App\ActorName', 'actor_id', 'id');
    }

    public function actorRole() {
        return $this->hasMany('App\RoleHasActor', 'actor_id', 'id');
    }
}
