<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class CompEvaluatedExpression extends Model
{
    use SoftDeletes;

    protected $table = 'comp_evaluated_expression';

    public $timestamps = true;

    protected $fillable = [
        'parent_cond_id',
        'logical_operator',
        'term_1_id',
        'term_2_id',
		'updated_by',
        'deleted_by'
    ];

    public function parentCond() {
        return $this->belongsTo('App\Condition','parent_cond_id','id');
    }

    public function term1() {
        return $this->belongsTo('App\Term','term_1_id','id');
    }

    public function term2() {
        return $this->belongsTo('App\Term','term_2_id','id');
    }

    public function updatedBy() {
        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {
        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }

    /*public function arCondition() {

        return $this->belongsTo('App\ArCondition','ar_condition_id', 'id');
    }

    public function property1() {

        return $this->belongsTo('App\Property','property_id1', 'id');
    }

    public function values1() {

        return $this->belongsTo('App\Value','value_id1', 'id');
    }

    public function property2() {

        return $this->belongsTo('App\Property','property_id2', 'id');
    }

    public function action() {

        return $this->belongsTo('App\Action','action_id', 'id');
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
