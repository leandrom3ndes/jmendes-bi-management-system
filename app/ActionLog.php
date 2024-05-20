<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class ActionLog extends Model
{
    use SoftDeletes;

    protected $table = 'action_log';

    public $timestamps = true;

    protected $fillable = [
        'state',
        'action_id',
        'transaction_id'
    ];

    public function action() {

        return $this->belongsTo('App\Action','action_id', 'id');
    }

    public function transaction() {

        return $this->belongsTo('App\Transaction','transaction_id', 'id');
    }

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
