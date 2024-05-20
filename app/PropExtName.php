<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropExtName extends Model
{
    use SoftDeletes;

    protected $table = 'prop_ext_name';

    public $timestamps = true;

    protected $fillable = [
        'external_integration_id',
		'property_id',
		'name',
		'state',
		'updated_by',
        'deleted_by'
    ];

    protected $guarded = [];

	public function external_integration() {
        return $this->belongsTo('App\ExternalIntegration', 'external_integration_id', 'id');
    }
	
	public function property() {
        return $this->belongsTo('App\Property', 'property_id', 'id');
    }
	
    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
