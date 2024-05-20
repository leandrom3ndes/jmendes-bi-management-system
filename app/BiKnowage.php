<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiKnowage extends Model
{
    protected $table = 'bi_knowage';
    /**
     * @var mixed
     */
    private $id;
    protected $fillable = [
        'label',
        'preview',
        'type',
        'role',
        'dataset_label'
    ];
}
