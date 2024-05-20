<?php

use Illuminate\Database\Seeder;
use App\Actor;
use App\ActorName;

class ActorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // `tese_rental`.`actor`
		$actor = array(
		  array('id' => '1','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-23 15:10:05','updated_at' => '2018-07-23 15:10:05','deleted_at' => NULL),
		  array('id' => '2','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-23 15:10:50','updated_at' => '2018-07-23 15:49:25','deleted_at' => NULL),
		  array('id' => '4','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-23 15:15:30','updated_at' => '2018-07-23 15:15:30','deleted_at' => NULL),
		  array('id' => '5','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-23 15:15:30','updated_at' => '2018-07-23 15:15:30','deleted_at' => NULL),
		  array('id' => '7','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 09:56:50','updated_at' => '2018-07-30 09:56:50','deleted_at' => NULL),
		  array('id' => '8','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 09:57:27','updated_at' => '2018-07-30 09:57:27','deleted_at' => NULL),
		  array('id' => '9','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 09:57:34','updated_at' => '2018-07-30 09:57:34','deleted_at' => NULL),
		  array('id' => '10','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 09:57:42','updated_at' => '2018-07-30 09:57:42','deleted_at' => NULL),
		  array('id' => '11','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 09:58:20','updated_at' => '2018-07-30 09:58:20','deleted_at' => NULL),
		  array('id' => '12','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 09:58:26','updated_at' => '2018-07-30 09:58:26','deleted_at' => NULL),
		  array('id' => '13','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-08-09 09:21:42','updated_at' => '2018-08-09 09:21:42','deleted_at' => NULL),
		  array('id' => '14','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-08-09 09:21:58','updated_at' => '2018-08-09 09:21:58','deleted_at' => NULL)
		);
		
		// `tese_rental`.`actor_name`
		$actor_name = array(
		  array('actor_id' => '1','language_id' => '1','name' => 'Locatário','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-23 15:10:05','updated_at' => '2018-07-23 15:10:05','deleted_at' => NULL),
		  array('actor_id' => '1','language_id' => '2','name' => 'Renter','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
		  array('actor_id' => '2','language_id' => '1','name' => 'Iniciador de aluguer','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2018-07-23 15:49:25','deleted_at' => NULL),
		  array('actor_id' => '2','language_id' => '2','name' => 'Rental Contracter','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-23 15:10:50','updated_at' => '2018-07-23 15:10:50','deleted_at' => NULL),
		  array('actor_id' => '4','language_id' => '1','name' => 'Condutor','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
		  array('actor_id' => '4','language_id' => '2','name' => 'Driver','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-23 15:15:30','updated_at' => '2018-07-23 15:15:30','deleted_at' => NULL),
		  array('actor_id' => '5','language_id' => '1','name' => 'Emissor do carro','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
		  array('actor_id' => '5','language_id' => '2','name' => 'Car issuer','updated_by' => '2','deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
		  array('actor_id' => '7','language_id' => '2','name' => 'Branch creator','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 09:56:50','updated_at' => '2018-07-30 09:56:50','deleted_at' => NULL),
		  array('actor_id' => '8','language_id' => '2','name' => 'Branch manager','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 09:57:27','updated_at' => '2018-07-30 09:57:27','deleted_at' => NULL),
		  array('actor_id' => '9','language_id' => '2','name' => 'Car creator','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 09:57:34','updated_at' => '2018-07-30 09:57:34','deleted_at' => NULL),
		  array('actor_id' => '10','language_id' => '2','name' => 'Car manager','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 09:57:42','updated_at' => '2018-07-30 09:57:42','deleted_at' => NULL),
		  array('actor_id' => '11','language_id' => '2','name' => 'Car type creator','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 09:58:20','updated_at' => '2018-07-30 09:58:20','deleted_at' => NULL),
		  array('actor_id' => '12','language_id' => '2','name' => 'Car type manager','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 09:58:26','updated_at' => '2018-07-30 09:58:26','deleted_at' => NULL),
		  array('actor_id' => '13','language_id' => '2','name' => 'Transport Manager','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-08-09 09:21:42','updated_at' => '2018-08-09 09:21:42','deleted_at' => NULL),
		  array('actor_id' => '14','language_id' => '2','name' => 'Transporter','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-08-09 09:21:58','updated_at' => '2018-08-09 09:21:58','deleted_at' => NULL)
		);

        Actor::insert($actor);
        ActorName::insert($actor_name);
    }
}
