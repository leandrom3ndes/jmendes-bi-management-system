<?php

use Illuminate\Database\Seeder;
use App\Action;
use App\ActionName;

class ActionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // `tese_rental`.`action`
        $action = array(
            array('id' => '12','action_rule_id' => '5','type' => 'causal_link','par_action_id' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-10-18 14:40:02','updated_at' => '2018-10-18 14:40:02','deleted_at' => NULL),
            array('id' => '13','action_rule_id' => '10','type' => 'causal_link','par_action_id' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-10-18 14:43:29','updated_at' => '2018-10-18 14:43:29','deleted_at' => NULL),
            array('id' => '14','action_rule_id' => '12','type' => 'if','par_action_id' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-10-19 11:31:23','updated_at' => '2019-01-10 11:54:57','deleted_at' => NULL),
            array('id' => '15','action_rule_id' => '12','type' => 'then','par_action_id' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-10-19 11:32:28','updated_at' => '2018-10-19 11:32:28','deleted_at' => NULL),
            array('id' => '16','action_rule_id' => '12','type' => 'causal_link','par_action_id' => '15','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-10-19 11:33:55','updated_at' => '2018-10-19 11:33:55','deleted_at' => NULL),
            array('id' => '19','action_rule_id' => '2','type' => 'user_input','par_action_id' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-23 14:13:42','deleted_at' => NULL),
            array('id' => '20','action_rule_id' => '13','type' => 'user_input','par_action_id' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '21','action_rule_id' => '14','type' => 'user_input','par_action_id' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '22','action_rule_id' => '15','type' => 'user_input','par_action_id' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '23','action_rule_id' => '8','type' => 'user_input','par_action_id' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '24','action_rule_id' => '16','type' => 'user_input','par_action_id' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '25','action_rule_id' => '17','type' => 'user_input','par_action_id' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '26','action_rule_id' => '18','type' => 'user_input','par_action_id' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '27','action_rule_id' => '19','type' => 'user_input','par_action_id' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '30','action_rule_id' => '12','type' => 'else','par_action_id' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-10 13:19:52','deleted_at' => NULL),
            array('id' => '31','action_rule_id' => '12','type' => 'user_input','par_action_id' => '30','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-10 13:19:52','deleted_at' => NULL),
            array('id' => '32','action_rule_id' => '12','type' => 'user_input','par_action_id' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2019-01-10 13:19:52','deleted_at' => NULL),
            array('id' => '36','action_rule_id' => '2','type' => 'produce_doc','par_action_id' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2019-01-10 16:36:41','updated_at' => '2019-01-23 14:13:42','deleted_at' => NULL),
            array('id' => '37','action_rule_id' => '2','type' => 'assign_expression','par_action_id' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2019-01-14 16:00:28','updated_at' => '2019-01-23 14:13:07','deleted_at' => NULL)
        );

        $action_name = array(
             array('action_id' => '19', 'language_id' => '1', 'name' => 'Arrendamento', 'description' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2019-01-14 16:00:28','updated_at' => '2019-01-23 14:13:07','deleted_at' => NULL),
             array('action_id' => '19', 'language_id' => '2', 'name' => 'Rental', 'description' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2019-01-14 16:00:28','updated_at' => '2019-01-23 14:13:07','deleted_at' => NULL)
        );

        $action_name = array(
             array('action_id' => '19', 'language_id' => '1', 'name' => 'Arrendamento', 'description' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2019-01-14 16:00:28','updated_at' => '2019-01-23 14:13:07','deleted_at' => NULL),
             array('action_id' => '19', 'language_id' => '2', 'name' => 'Rental', 'description' => NULL,'updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2019-01-14 16:00:28','updated_at' => '2019-01-23 14:13:07','deleted_at' => NULL)
        );

        Action::insert($action);
        ActionName::insert($action_name);
    }
}
