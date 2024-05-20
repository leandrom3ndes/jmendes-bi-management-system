<?php

use Illuminate\Database\Seeder;
use App\PropAllowedValue;
use App\PropAllowedValueName;

class PropAllowedValueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // `tese_rental`.`prop_allowed_value`
		$prop_allowed_value = array(
		  array('id' => '1','property_id' => '7','state' => 'active','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-30 10:17:57','updated_at' => '2018-07-30 10:17:57','deleted_at' => NULL),
		  array('id' => '2','property_id' => '7','state' => 'active','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-30 10:19:06','updated_at' => '2018-07-30 10:19:06','deleted_at' => NULL),
		  array('id' => '3','property_id' => '7','state' => 'active','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-30 10:20:34','updated_at' => '2018-07-30 10:20:34','deleted_at' => NULL),
		  array('id' => '4','property_id' => '7','state' => 'active','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-30 10:22:21','updated_at' => '2018-07-30 10:22:21','deleted_at' => NULL),
		  array('id' => '5','property_id' => '7','state' => 'active','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-30 10:22:29','updated_at' => '2018-07-30 10:22:29','deleted_at' => NULL),
		  array('id' => '6','property_id' => '7','state' => 'active','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-30 10:23:01','updated_at' => '2018-07-30 10:23:01','deleted_at' => NULL),
		  array('id' => '7','property_id' => '7','state' => 'active','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-30 10:23:15','updated_at' => '2018-07-30 10:23:15','deleted_at' => NULL),
		  array('id' => '8','property_id' => '7','state' => 'active','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-30 10:23:22','updated_at' => '2018-07-30 10:23:22','deleted_at' => NULL)
		);

		// `tese_rental`.`prop_allowed_value_name`
		$prop_allowed_value_name = array(
		  array('p_a_v_id' => '1','language_id' => '1','name' => 'Mini','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-30 10:17:57','updated_at' => '2018-07-30 10:17:57','deleted_at' => NULL),
		  array('p_a_v_id' => '1','language_id' => '2','name' => 'Mini','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 10:17:57','updated_at' => '2018-07-30 10:17:57','deleted_at' => NULL),
		  array('p_a_v_id' => '2','language_id' => '1','name' => 'Económico','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-30 10:19:06','updated_at' => '2018-07-30 10:19:06','deleted_at' => NULL),
		  array('p_a_v_id' => '2','language_id' => '2','name' => 'Economy','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 10:19:06','updated_at' => '2018-07-30 10:19:06','deleted_at' => NULL),
		  array('p_a_v_id' => '3','language_id' => '1','name' => 'Compacto','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-30 10:20:34','updated_at' => '2018-07-30 10:20:34','deleted_at' => NULL),
		  array('p_a_v_id' => '3','language_id' => '2','name' => 'Compact','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 10:20:34','updated_at' => '2018-07-30 10:20:34','deleted_at' => NULL),
		  array('p_a_v_id' => '4','language_id' => '1','name' => 'Intermédio','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-30 10:22:21','updated_at' => '2018-07-30 10:22:21','deleted_at' => NULL),
		  array('p_a_v_id' => '4','language_id' => '2','name' => 'Intermediate','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 10:22:21','updated_at' => '2018-07-30 10:22:21','deleted_at' => NULL),
		  array('p_a_v_id' => '5','language_id' => '1','name' => 'Standard','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-30 10:22:29','updated_at' => '2018-07-30 10:22:29','deleted_at' => NULL),
		  array('p_a_v_id' => '5','language_id' => '2','name' => 'Standard','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 10:22:29','updated_at' => '2018-07-30 10:22:29','deleted_at' => NULL),
		  array('p_a_v_id' => '6','language_id' => '1','name' => 'Premium','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-30 10:23:01','updated_at' => '2018-07-30 10:23:01','deleted_at' => NULL),
		  array('p_a_v_id' => '6','language_id' => '2','name' => 'Premium','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 10:23:01','updated_at' => '2018-07-30 10:23:01','deleted_at' => NULL),
		  array('p_a_v_id' => '7','language_id' => '1','name' => 'Luxo','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-30 10:23:15','updated_at' => '2018-07-30 10:23:15','deleted_at' => NULL),
		  array('p_a_v_id' => '7','language_id' => '2','name' => 'Luxury','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 10:23:15','updated_at' => '2018-07-30 10:23:15','deleted_at' => NULL),
		  array('p_a_v_id' => '8','language_id' => '1','name' => 'Especial','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-30 10:23:22','updated_at' => '2018-07-30 10:23:22','deleted_at' => NULL),
		  array('p_a_v_id' => '8','language_id' => '2','name' => 'Special','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 10:23:22','updated_at' => '2018-07-30 10:23:22','deleted_at' => NULL)
		);

        PropAllowedValue::insert($prop_allowed_value);
        PropAllowedValueName::insert($prop_allowed_value_name);
    }
}
