<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiKnowageSettings extends Model
{
    protected $table = 'bi_knowage_settings';
    protected $fillable = ['display_toolbar', 'display_sliders', 'reset_parameters'];

}
