<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiKnowageText extends Model
{
    protected $table = 'bi_knowage_text';
    protected $fillable = ['name', 'description'];
}
