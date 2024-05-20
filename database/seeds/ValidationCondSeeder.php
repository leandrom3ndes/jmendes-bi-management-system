<?php

use Illuminate\Database\Seeder;
use App\ValidationCond;
use App\ValidationCondHasTemplate;

class ValidationCondSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $validationCond = array(
            array('id' => '1', 'type' => 'required', 'action_prop_id' => '1', 'param_1' => NULL, 'param_2' => NULL, 'custom_validation' => NULL, 'negative' => 0, 'updated_by' => '4','deleted_by' => NULL,'created_at' => '2018-07-31 10:53:30','updated_at' => '2018-07-31 10:53:30','deleted_at' => NULL),
            array('id' => '2', 'type' => 'isNumber', 'action_prop_id' => '1', 'param_1' => NULL, 'param_2' => NULL, 'custom_validation' => NULL, 'negative' => 0, 'updated_by' => '4','deleted_by' => NULL,'created_at' => '2018-07-31 10:53:30','updated_at' => '2018-07-31 10:53:30','deleted_at' => NULL),
            array('id' => '3', 'type' => 'isInteger', 'action_prop_id' => '1', 'param_1' => NULL, 'param_2' => NULL, 'custom_validation' => NULL, 'negative' => 0, 'updated_by' => '4','deleted_by' => NULL,'created_at' => '2018-07-31 10:53:30','updated_at' => '2018-07-31 10:53:30','deleted_at' => NULL),
            array('id' => '4', 'type' => 'minLength', 'action_prop_id' => '1', 'param_1' => '3', 'param_2' => NULL, 'custom_validation' => NULL, 'negative' => 0, 'updated_by' => '4','deleted_by' => NULL,'created_at' => '2018-07-31 10:53:30','updated_at' => '2018-07-31 10:53:30','deleted_at' => NULL),
            array('id' => '5', 'type' => 'maxLength', 'action_prop_id' => '1', 'param_1' => '6', 'param_2' => NULL, 'custom_validation' => NULL, 'negative' => 0, 'updated_by' => '4','deleted_by' => NULL,'created_at' => '2018-07-31 10:53:30','updated_at' => '2018-07-31 10:53:30','deleted_at' => NULL),
            array('id' => '6', 'type' => 'required', 'action_prop_id' => '2', 'param_1' => NULL, 'param_2' => NULL, 'custom_validation' => NULL, 'negative' => 0, 'updated_by' => '4','deleted_by' => NULL,'created_at' => '2018-07-31 10:53:30','updated_at' => '2018-07-31 10:53:30','deleted_at' => NULL),
            array('id' => '7', 'type' => 'isNumber', 'action_prop_id' => '2', 'param_1' => NULL, 'param_2' => NULL, 'custom_validation' => NULL, 'negative' => 0, 'updated_by' => '4','deleted_by' => NULL,'created_at' => '2018-07-31 10:53:30','updated_at' => '2018-07-31 10:53:30','deleted_at' => NULL),
            array('id' => '8', 'type' => 'belongsRange', 'action_prop_id' => '2', 'param_1' => '6', 'param_2' => '9', 'custom_validation' => NULL, 'negative' => 1, 'updated_by' => '4','deleted_by' => NULL,'created_at' => '2018-07-31 10:53:30','updated_at' => '2018-07-31 10:53:30','deleted_at' => NULL),
            array('id' => '9', 'type' => 'higherThan', 'action_prop_id' => '2', 'param_1' => '2', 'param_2' => NULL, 'custom_validation' => NULL, 'negative' => 0, 'updated_by' => '4','deleted_by' => NULL,'created_at' => '2018-07-31 10:53:30','updated_at' => '2018-07-31 10:53:30','deleted_at' => NULL),
            array('id' => '10', 'type' => 'lessThan', 'action_prop_id' => '2', 'param_1' => '25', 'param_2' => NULL, 'custom_validation' => NULL, 'negative' => 0, 'updated_by' => '4','deleted_by' => NULL,'created_at' => '2018-07-31 10:53:30','updated_at' => '2018-07-31 10:53:30','deleted_at' => NULL),
            array('id' => '11', 'type' => 'required', 'action_prop_id' => '3', 'param_1' => NULL, 'param_2' => NULL, 'custom_validation' => NULL, 'negative' => 0, 'updated_by' => '4','deleted_by' => NULL,'created_at' => '2018-07-31 10:53:30','updated_at' => '2018-07-31 10:53:30','deleted_at' => NULL),
            array('id' => '12', 'type' => 'required', 'action_prop_id' => '4', 'param_1' => NULL, 'param_2' => NULL, 'custom_validation' => NULL, 'negative' => 0, 'updated_by' => '4','deleted_by' => NULL,'created_at' => '2018-07-31 10:53:30','updated_at' => '2018-07-31 10:53:30','deleted_at' => NULL),
            array('id' => '13', 'type' => 'required', 'action_prop_id' => '5', 'param_1' => NULL, 'param_2' => NULL, 'custom_validation' => NULL, 'negative' => 0, 'updated_by' => '4','deleted_by' => NULL,'created_at' => '2018-07-31 10:53:30','updated_at' => '2018-07-31 10:53:30','deleted_at' => NULL)
        );

        $validationCondHasTemplate = array(
            array('template_id' => '4', 'validation_cond_id' => '1', 'created_at' => '2018-01-04 15:18:13','updated_at' => '2018-01-04 15:18:13','deleted_at' => NULL),
            array('template_id' => '5', 'validation_cond_id' => '2', 'created_at' => '2018-01-04 15:18:13','updated_at' => '2018-01-04 15:18:13','deleted_at' => NULL),
            array('template_id' => '6', 'validation_cond_id' => '3', 'created_at' => '2018-01-04 15:18:13','updated_at' => '2018-01-04 15:18:13','deleted_at' => NULL),
            array('template_id' => '7', 'validation_cond_id' => '4', 'created_at' => '2018-01-04 15:18:13','updated_at' => '2018-01-04 15:18:13','deleted_at' => NULL),
            array('template_id' => '8', 'validation_cond_id' => '5', 'created_at' => '2018-01-04 15:18:13','updated_at' => '2018-01-04 15:18:13','deleted_at' => NULL),
            array('template_id' => '9', 'validation_cond_id' => '6', 'created_at' => '2018-01-04 15:18:13','updated_at' => '2018-01-04 15:18:13','deleted_at' => NULL),
            array('template_id' => '10', 'validation_cond_id' => '7', 'created_at' => '2018-01-04 15:18:13','updated_at' => '2018-01-04 15:18:13','deleted_at' => NULL),
            array('template_id' => '11', 'validation_cond_id' => '8', 'created_at' => '2018-01-04 15:18:13','updated_at' => '2018-01-04 15:18:13','deleted_at' => NULL),
            array('template_id' => '12', 'validation_cond_id' => '9', 'created_at' => '2018-01-04 15:18:13','updated_at' => '2018-01-04 15:18:13','deleted_at' => NULL),
            array('template_id' => '13', 'validation_cond_id' => '10', 'created_at' => '2018-01-04 15:18:13','updated_at' => '2018-01-04 15:18:13','deleted_at' => NULL),
            array('template_id' => '14', 'validation_cond_id' => '11', 'created_at' => '2018-01-04 15:18:13','updated_at' => '2018-01-04 15:18:13','deleted_at' => NULL),
            array('template_id' => '15', 'validation_cond_id' => '12', 'created_at' => '2018-01-04 15:18:13','updated_at' => '2018-01-04 15:18:13','deleted_at' => NULL),
            array('template_id' => '16', 'validation_cond_id' => '13', 'created_at' => '2018-01-04 15:18:13','updated_at' => '2018-01-04 15:18:13','deleted_at' => NULL)
        );

        ValidationCond::insert($validationCond);
        ValidationCondHasTemplate::insert($validationCondHasTemplate);
    }
}
