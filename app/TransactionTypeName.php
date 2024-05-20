<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionTypeName extends Model
{
    use SoftDeletes;

    protected $table = 'transaction_type_name';

    public $timestamps = true;

    protected $fillable = [
        'transaction_type_id',
        'language_id',
        't_name',
        'rt_name',
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
