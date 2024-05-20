<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class Language extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'language';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'slug',
        'state',
		'updated_by',
        'deleted_by'
    ];

    protected $guarded = [];

    public function actor() {

    	return $this->belongsToMany('App\Actor', 'actor_name');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }

    public static function getPossibleStates(){
        $type = DB::select(DB::raw('SHOW COLUMNS FROM language WHERE Field = "state"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();

        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        return $values;
    }
}
