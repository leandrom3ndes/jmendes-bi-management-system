<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiElementText extends Model
{
    protected $table = 'bi_element_text';
    protected $fillable = ['name', 'description'];
}
