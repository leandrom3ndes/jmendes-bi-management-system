<?php

use Illuminate\Database\Seeder;
use App\ActionRule;

class ActionRuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // `tese_rental`.`action_rule`
        $action_rule = array(
            array('id' => '2','t_state_id' => '1','transaction_type_id' => '1','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-08-29 16:11:05','updated_at' => '2018-08-29 16:11:05','deleted_at' => NULL),
            array('id' => '5','t_state_id' => '2','transaction_type_id' => '1','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-10-12 15:50:54','updated_at' => '2018-10-12 15:50:54','deleted_at' => NULL),
            array('id' => '8','t_state_id' => '1','transaction_type_id' => '5','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-10-18 14:38:53','updated_at' => '2018-10-18 14:38:53','deleted_at' => NULL),
            array('id' => '9','t_state_id' => '1','transaction_type_id' => '3','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-10-18 14:40:02','updated_at' => '2018-10-18 14:40:02','deleted_at' => NULL),
            array('id' => '10','t_state_id' => '2','transaction_type_id' => '10','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-10-18 14:40:34','updated_at' => '2018-10-18 14:40:34','deleted_at' => NULL),
            array('id' => '11','t_state_id' => '1','transaction_type_id' => '9','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-10-18 14:43:29','updated_at' => '2018-10-18 14:43:29','deleted_at' => NULL),
            array('id' => '12','t_state_id' => '4','transaction_type_id' => '4','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-10-19 11:30:08','updated_at' => '2018-10-19 11:30:08','deleted_at' => NULL),
            array('id' => '13','t_state_id' => '1','transaction_type_id' => '2','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-10-22 16:05:43','updated_at' => '2018-10-22 16:05:43','deleted_at' => NULL),
            array('id' => '14','t_state_id' => '3','transaction_type_id' => '3','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-10-22 16:11:19','updated_at' => '2018-10-22 16:11:19','deleted_at' => NULL),
            array('id' => '15','t_state_id' => '1','transaction_type_id' => '4','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-10-22 16:15:36','updated_at' => '2018-10-22 16:15:36','deleted_at' => NULL),
            array('id' => '16','t_state_id' => '3','transaction_type_id' => '6','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-10-22 16:23:15','updated_at' => '2018-10-22 16:23:15','deleted_at' => NULL),
            array('id' => '17','t_state_id' => '3','transaction_type_id' => '7','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-10-22 16:44:55','updated_at' => '2018-10-22 16:44:55','deleted_at' => NULL),
            array('id' => '18','t_state_id' => '3','transaction_type_id' => '8','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-10-22 16:47:55','updated_at' => '2018-10-22 16:47:55','deleted_at' => NULL),
            array('id' => '19','t_state_id' => '1','transaction_type_id' => '9','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-10-23 15:23:34','updated_at' => '2018-10-23 15:23:34','deleted_at' => NULL)
        );

        ActionRule::insert($action_rule);
    }
}
