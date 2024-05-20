<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TemplateToast extends Model
{
    use SoftDeletes;

    protected $table = 'template_toast';

    public $timestamps = true;

    protected $primaryKey = ['template_id','language_id'];
    public $incrementing = false;

    protected $fillable = [
        'template_id',
        'language_id',
        'class',
        'colour',
        'title_text',
        'updated_by',
        'deleted_by'
    ];

    public function template() {
        return $this->belongsTo('App\Template','template_id','id');
    }

    public function language() {
        return $this->belongsTo('App\Language','language_id','id');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
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

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery(Builder $query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }
}
