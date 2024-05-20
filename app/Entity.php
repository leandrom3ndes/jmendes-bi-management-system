<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entity extends Model
{
    use SoftDeletes;

    protected $table = 'entity';

    public $timestamps = true;

    protected $fillable = [
        'ent_type_id',
        'state',
		'transaction_id',
		'updated_by',
        'deleted_by'
    ];

    protected $guarded = [];

    public function entType() {
        return $this->belongsTo('App\EntType', 'ent_type_id', 'id');
    }
	
	public function transaction() {
        return $this->belongsTo('App\Transaction', 'transaction_id', 'id');
    }

    public function values() {
        return $this->hasMany('App\Value', 'entity_id', 'id');
    }

    public function language() {
        return $this->belongsToMany('App\Language', 'entity_name', 'entity_id', 'language_id')->withPivot('name','created_at','updated_at','deleted_at');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }

    public function entityName() {
        return $this->hasMany('App\EntityName', 'entity_id', 'id');
    }

    public function users() {
        return $this->hasMany('App\User', 'entity_id', 'id');
    }

}
