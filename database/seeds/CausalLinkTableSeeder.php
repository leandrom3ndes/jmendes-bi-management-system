<?php

use Illuminate\Database\Seeder;
use App\CausalLink;

class CausalLinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // `tese_rental`.`causal_link`
        $causal_link = array(
            array('id' => '2','causing_action' => '12','caused_action_rule' => '9','min' => '1','max' => '1','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-10-18 14:40:02','updated_at' => '2018-10-18 14:40:02','deleted_at' => NULL),
            array('id' => '3','causing_action' => '13','caused_action_rule' => '11','min' => '0','max' => '*','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-10-18 14:43:29','updated_at' => '2018-10-18 14:43:29','deleted_at' => NULL),
            array('id' => '4','causing_action' => '16','caused_action_rule' => '8','min' => '0','max' => '1','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-10-19 11:33:55','updated_at' => '2018-10-19 11:33:55','deleted_at' => NULL)
        );

        CausalLink::insert($causal_link);
    }
}
