<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyName extends Model
{
    use SoftDeletes;

    protected $table = 'property_name';

    public $timestamps = true;

    protected $fillable = [
        'property_id',
        'language_id',
        'name',
        'form_field_name',
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
