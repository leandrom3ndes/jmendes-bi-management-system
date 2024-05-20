<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Condition extends Model
{
    use SoftDeletes;

    protected $table = 'condition';

    public $timestamps = true;

    protected $fillable = [
        'type',
        'parent_cond_id',
        'action_id',
		'updated_by',
        'deleted_by'
    ];

    public function parentCond() {
        return $this->belongsTo('App\Condition','parent_cond_id','id');
    }

    public function action() {
        return $this->belongsTo('App\Action','action_id','id');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }

    /*public function operator() {

        return $this->belongsTo('App\Operator','operator_id', 'id');
    }

    public function queries() {

        return $this->belongsTo('App\Query','query_id', 'id');
    }

    public function property() {

        return $this->belongsTo('App\Property','property_id', 'id');
    }

    public function value() {

        return $this->belongsTo('App\Value','value_id', 'id');
    }*/

    /**
     * Retrieves the acceptable enum fields for a column
     *
     * @param string $column Column name
     *
     * @return array
     */
    public static function getPossibleEnumValues ($column) {
        // Create an instance of the model to be able to get the table name
        $instance = new static;

        // Pulls column string from DB
        $enumStr = DB::select(DB::raw('SHOW COLUMNS FROM '.$instance->getTable().' WHERE Field = "'.$column.'"'))[0]->Type;

        // Parse string
        preg_match_all("/'([^']+)'/", $enumStr, $matches);

        // Return matches
        return isset($matches[1]) ? $matches[1] : [];
    }
}
