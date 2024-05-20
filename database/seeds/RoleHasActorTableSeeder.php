<?php

use Illuminate\Database\Seeder;
use App\RoleHasActor;

class RoleHasActorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // `tese_rental`.`role_has_actor`
		$role_has_actor = array(
		  array('role_id' => '1','actor_id' => '1','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-23 16:06:58','updated_at' => '2018-07-23 16:06:58','deleted_at' => NULL),
		  array('role_id' => '1','actor_id' => '4','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-23 16:06:58','updated_at' => '2018-07-23 16:06:58','deleted_at' => NULL),
		  array('role_id' => '2','actor_id' => '2','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-08-09 09:30:16','updated_at' => '2018-08-09 09:30:16','deleted_at' => NULL),
		  array('role_id' => '2','actor_id' => '5','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-08-09 09:30:16','updated_at' => '2018-08-09 09:30:16','deleted_at' => NULL),
		  array('role_id' => '2','actor_id' => '7','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-08-09 09:30:16','updated_at' => '2018-08-09 09:30:16','deleted_at' => NULL),
		  array('role_id' => '2','actor_id' => '8','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-08-09 09:30:16','updated_at' => '2018-08-09 09:30:16','deleted_at' => NULL),
		  array('role_id' => '2','actor_id' => '9','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-08-09 09:30:16','updated_at' => '2018-08-09 09:30:16','deleted_at' => NULL),
		  array('role_id' => '2','actor_id' => '10','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-08-09 09:30:16','updated_at' => '2018-08-09 09:30:16','deleted_at' => NULL),
		  array('role_id' => '2','actor_id' => '11','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-08-09 09:30:16','updated_at' => '2018-08-09 09:30:16','deleted_at' => NULL),
		  array('role_id' => '2','actor_id' => '12','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-08-09 09:30:16','updated_at' => '2018-08-09 09:30:16','deleted_at' => NULL),
		  array('role_id' => '2','actor_id' => '13','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-08-09 09:30:16','updated_at' => '2018-08-09 09:30:16','deleted_at' => NULL),
		  array('role_id' => '2','actor_id' => '14','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-08-09 09:30:16','updated_at' => '2018-08-09 09:30:16','deleted_at' => NULL)
		);

        RoleHasActor::insert($role_has_actor);
    }
}
