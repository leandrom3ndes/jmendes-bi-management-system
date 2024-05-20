<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActionHasTemplate extends Model
{
    use SoftDeletes;

    protected $table = 'action_has_template';

    public $timestamps = true;

    protected $primaryKey = ['action_id','template_id'];
    public $incrementing = false;

    protected $fillable = [
        'action_id',
        'template_id',
        'updated_by',
        'deleted_by'
    ];

    public function action() {
        return $this->belongsTo('App\Action','action_id','id');
    }

    public function template() {
        return $this->belongsTo('App\Template','template_id','id');
    }

    public function updatedBy() {

        return $this->belongsTo('App\Users', 'updated_by', 'id');
    }

    public function deletedBy() {

        return $this->belongsTo('App\Users', 'deleted_by', 'id');
    }
}
