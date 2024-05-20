<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiElementTypeText extends Model
{
    protected $table = 'bi_element_type_text';
    protected $fillable = ['type', 'description'];
}
