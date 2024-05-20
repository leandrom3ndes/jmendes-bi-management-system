<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntType extends Model
{
    use SoftDeletes;

    protected $table = 'ent_type';

    public $timestamps = true;

    protected $fillable = [
        'state',
        'transaction_type_id',
		'updated_by',
        'deleted_by'
    ];

    protected $guarded = [];

    public function transactionsType() {
        return $this->belongsTo('App\TransactionType', 'transaction_type_id', 'id');
    }

    public function entity() {
        return $this->hasMany('App\Entity', 'ent_type_id', 'id');
    }

    public function properties() {
        return $this->hasMany('App\Property', 'ent_type_id', 'id');
    }

    public function entTypeName() {
        return $this->hasMany('App\EntTypeName', 'ent_type_id', 'id');
    }

    public function providingEntTypes() {
        return $this->belongsToMany('App\Property', 'property_can_read_ent_type', 'providing_ent_type', 'reading_property')->withPivot('output_type','created_at','updated_at','deleted_at');
    }

    public function language() {
        return $this->belongsToMany('App\Language', 'ent_type_name', 'ent_type_id', 'language_id')->withPivot('name','created_at','updated_at','deleted_at');
    }

    public function queries() {
        return $this->hasMany('App\Query', 'ent_type_id', 'id');
    }

	public function external_integrations()
    {
        return $this->hasMany('App\ExternalIntegration');
    }
    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }

	public function scopeSearchPropsEnt($query, $id, $data) {
        if ($id != null) {
            $query->where('id', $id);
        }

        if (isset($data['entity']) && $data['entity'] != '') {
            $query->where('ent_type_name.name', 'LIKE', '%'.$data['entity'].'%');
        }

        if (isset($data['property']) && $data['property'] != '') {
            $query->where('property_name.name', 'LIKE', '%'.$data['property'].'%');
        }
    }
}
