<?php

use Illuminate\Database\Seeder;
use App\EntType;
use App\EntTypeName;

class EntTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // `tese_rental`.`ent_type`
		$ent_type = array(
		  array('id' => '7','state' => 'active','transaction_type_id' => '1','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-07-25 17:31:01','updated_at' => '2018-07-25 17:31:01','deleted_at' => NULL),
		  array('id' => '8','state' => 'active','transaction_type_id' => '2','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-07-25 17:40:44','updated_at' => '2018-07-25 17:40:44','deleted_at' => NULL),
		  array('id' => '9','state' => 'active','transaction_type_id' => '3','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-07-25 17:41:53','updated_at' => '2018-07-25 17:41:53','deleted_at' => NULL),
		  array('id' => '10','state' => 'active','transaction_type_id' => '4','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-07-25 17:42:38','updated_at' => '2018-07-25 17:42:38','deleted_at' => NULL),
		  array('id' => '11','state' => 'active','transaction_type_id' => '5','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-07-25 17:43:07','updated_at' => '2018-07-25 17:43:07','deleted_at' => NULL),
		  array('id' => '12','state' => 'active','transaction_type_id' => '6','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 10:09:29','updated_at' => '2018-07-30 10:09:29','deleted_at' => NULL),
		  array('id' => '13','state' => 'active','transaction_type_id' => '7','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 10:09:38','updated_at' => '2018-07-30 10:09:38','deleted_at' => NULL),
		  array('id' => '14','state' => 'active','transaction_type_id' => '8','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 10:09:54','updated_at' => '2018-07-30 10:09:54','deleted_at' => NULL),
		  array('id' => '15','state' => 'active','transaction_type_id' => '9','updated_by' => '4','deleted_by' => NULL,'created_at' => '2018-08-09 14:15:10','updated_at' => '2018-08-09 14:15:10','deleted_at' => NULL)
		);
		
		// `tese_rental`.`ent_type_name`
		$ent_type_name = array(
		  array('ent_type_id' => '7','language_id' => '1','name' => 'Aluguer','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-07-25 17:31:01','updated_at' => '2018-07-25 17:31:01','deleted_at' => NULL),
		  array('ent_type_id' => '7','language_id' => '2','name' => 'Rental','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
		  array('ent_type_id' => '8','language_id' => '2','name' => 'Paid Rental','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-07-25 17:40:44','updated_at' => '2018-07-25 17:40:44','deleted_at' => NULL),
		  array('ent_type_id' => '9','language_id' => '2','name' => 'Picked-up Rental','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-07-25 17:41:53','updated_at' => '2018-07-25 17:41:53','deleted_at' => NULL),
		  array('ent_type_id' => '10','language_id' => '2','name' => 'Dropped-off Rental','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-07-25 17:42:38','updated_at' => '2018-07-25 17:42:38','deleted_at' => NULL),
		  array('ent_type_id' => '11','language_id' => '2','name' => 'Paid Penalty Rental','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-07-25 17:43:07','updated_at' => '2018-07-25 17:43:07','deleted_at' => NULL),
		  array('ent_type_id' => '12','language_id' => '2','name' => 'Branch','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 10:09:29','updated_at' => '2018-07-30 10:09:29','deleted_at' => NULL),
		  array('ent_type_id' => '13','language_id' => '2','name' => 'Car','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 10:09:38','updated_at' => '2018-07-30 10:09:38','deleted_at' => NULL),
		  array('ent_type_id' => '14','language_id' => '2','name' => 'Car type','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 10:09:54','updated_at' => '2018-07-30 10:09:54','deleted_at' => NULL),
		  array('ent_type_id' => '15','language_id' => '2','name' => 'Transport','updated_by' => '4','deleted_by' => NULL,'created_at' => '2018-08-09 14:15:10','updated_at' => '2018-08-09 14:15:10','deleted_at' => NULL)
		);

        EntType::insert($ent_type);
        EntTypeName::insert($ent_type_name);
    }
}
