<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiElementType extends Model
{
    protected $table = 'bi_element_type';
    /**
     * @var mixed
     */
    private $id;
    protected $fillable = ['slug'];
}
