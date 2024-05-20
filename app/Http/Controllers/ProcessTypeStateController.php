<?php


namespace App\Http\Controllers;

use App\Http\Resources\ProcessTypeResource;
use App\ProcessType;
use App\ActorName;
use App\Language;
use App\ProcessTypeName;
use DB;
use Illuminate\Http\Request;
use Config;

class ProcessTypeStateController extends Controller
{

    public function index()
    {
        $values = ProcessType::getPossibleStates('state');
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
