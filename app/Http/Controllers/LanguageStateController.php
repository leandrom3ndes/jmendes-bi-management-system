<?php

namespace App\Http\Controllers;

use App\Http\Resources\LanguageStateResource;
use App\Language;
//use App\Http\Resources\LanguageResource;
use DB;
use Illuminate\Http\Request;
use App\Http\Traits\HTTPResponseTrait;
use App\Http\Traits\OutputTypeResponseTrait;


class LanguageStateController extends Controller{
    public function index()
    {
        $values = Language::getPossibleStates('state');
        $states = [];
        $i = 0;
        foreach($values as $value){
            $states[$i]['id'] = $i+1;
            $states[$i]['state'] = $value;
            $i++;
        }
        return $states;
    }
}
