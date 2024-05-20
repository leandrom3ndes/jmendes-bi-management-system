<?php

use Illuminate\Database\Seeder;
use App\RoleHasUser;

class RoleHasUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // `tese_rental`.`role_has_user`
		$role_has_user = array(
		  array('role_id' => '1','user_id' => '1','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-23 16:15:18','updated_at' => '2018-07-23 16:15:18','deleted_at' => NULL),
		  array('role_id' => '1','user_id' => '2','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-23 16:06:17','updated_at' => '2018-07-23 16:06:17','deleted_at' => NULL),
		  array('role_id' => '2','user_id' => '3','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-30 11:26:45','updated_at' => '2018-07-30 11:26:45','deleted_at' => NULL),
		  array('role_id' => '2','user_id' => '4','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-30 11:26:45','updated_at' => '2018-07-30 11:26:45','deleted_at' => NULL)
		);

        RoleHasUser::insert($role_has_user);
    }
}
