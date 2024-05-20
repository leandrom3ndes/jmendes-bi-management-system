<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiEngine extends Model
{
    protected $table = 'bi_engine';
    protected $fillable = ['name', 'logo_preview'];
}
