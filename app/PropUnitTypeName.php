<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropUnitTypeName extends Model
{
    use SoftDeletes;

    protected $table = 'prop_unit_type_name';

    public $timestamps = true;

    protected $fillable = [
        'prop_unit_type_id',
        'language_id',
        'name',
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
