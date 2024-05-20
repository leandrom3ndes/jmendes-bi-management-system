<?php

use Illuminate\Database\Seeder;
use App\ActorIniciatesT;

class ActorIniciatesTTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // `tese_rental`.`actor_iniciates_t`
		$actor_iniciates_t = array(
		  array('transaction_type_id' => '1','actor_id' => '1','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
		  array('transaction_type_id' => '2','actor_id' => '2','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
		  array('transaction_type_id' => '3','actor_id' => '4','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
		  array('transaction_type_id' => '4','actor_id' => '5','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
		  array('transaction_type_id' => '5','actor_id' => '5','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
		  array('transaction_type_id' => '6','actor_id' => '8','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
		  array('transaction_type_id' => '7','actor_id' => '10','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
		  array('transaction_type_id' => '8','actor_id' => '12','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
		  array('transaction_type_id' => '9','actor_id' => '13','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
		  array('transaction_type_id' => '10','actor_id' => '13','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL)
		);

        ActorIniciatesT::insert($actor_iniciates_t);
    }
}
