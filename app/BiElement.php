<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiElement extends Model
{
    protected $table = 'bi_element';
    /**
     * @var mixed
     */
    private $id;
    protected $fillable = ['preview', 'embed'];

}
