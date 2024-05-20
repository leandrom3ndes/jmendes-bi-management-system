<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 03/07/2018
 * Time: 15:42
 */

namespace App\Http\Traits;

trait OutputTypeResponseTrait
{
    public function outputDataType($typeOutput = 'default', $data) {
        switch ($typeOutput) {
            case 'JSON': //output por defeito
                //return $data->toJson();
                return response()->json($data);
                break;
            default:
                return $data;
                break;
        }
    }
}