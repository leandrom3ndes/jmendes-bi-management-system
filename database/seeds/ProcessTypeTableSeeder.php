<?php

use Illuminate\Database\Seeder;
use App\ProcessType;
use App\ProcessTypeName;

class ProcessTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // `tese_rental`.`process_type`
		$process_type = array(
		  array('id' => '1','state' => 'active','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-23 15:08:09','updated_at' => '2018-07-23 15:08:09','deleted_at' => NULL),
		  array('id' => '2','state' => 'active','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 09:55:05','updated_at' => '2018-07-30 09:55:05','deleted_at' => NULL),
		  array('id' => '3','state' => 'active','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 09:55:19','updated_at' => '2018-07-30 09:55:19','deleted_at' => NULL),
		  array('id' => '4','state' => 'active','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 09:58:37','updated_at' => '2018-07-30 09:58:37','deleted_at' => NULL),
		  array('id' => '5','state' => 'active','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-08-09 09:25:41','updated_at' => '2018-08-09 09:25:41','deleted_at' => NULL)
		);
		
		// `tese_rental`.`process_type_name`
		$process_type_name = array(
		  array('process_type_id' => '1','language_id' => '1','name' => 'Aluguer','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-23 15:08:09','updated_at' => '2018-07-23 15:08:09','deleted_at' => NULL),
		  array('process_type_id' => '1','language_id' => '2','name' => 'Rental','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-23 15:08:22','updated_at' => '2018-07-23 15:08:22','deleted_at' => NULL),
		  array('process_type_id' => '2','language_id' => '2','name' => 'Branch manage','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 09:55:05','updated_at' => '2018-07-30 09:57:12','deleted_at' => NULL),
		  array('process_type_id' => '3','language_id' => '2','name' => 'Car manage','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 09:55:19','updated_at' => '2018-07-30 09:57:17','deleted_at' => NULL),
		  array('process_type_id' => '4','language_id' => '2','name' => 'Car type manage','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 09:58:37','updated_at' => '2018-07-30 09:58:37','deleted_at' => NULL),
		  array('process_type_id' => '5','language_id' => '2','name' => 'Transport','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-08-09 09:25:41','updated_at' => '2018-08-09 09:25:41','deleted_at' => NULL)
		);

        ProcessType::insert($process_type);
        ProcessTypeName::insert($process_type_name);
    }
}
