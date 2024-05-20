<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\RoleName;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // `tese_rental`.`role`
		$role = array(
		  array('id' => '1','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-23 16:02:11','updated_at' => '2018-07-23 16:02:11','deleted_at' => NULL),
		  array('id' => '2','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-23 16:04:50','updated_at' => '2018-07-23 16:04:50','deleted_at' => NULL)
		);
		
		// `tese_rental`.`role_name`
		$role_name = array(
		  array('role_id' => '1','language_id' => '1','name' => 'Cliente','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
		  array('role_id' => '1','language_id' => '2','name' => 'Client','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-23 16:02:11','updated_at' => '2018-07-23 16:02:11','deleted_at' => NULL),
		  array('role_id' => '2','language_id' => '1','name' => 'Funcionário','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
		  array('role_id' => '2','language_id' => '2','name' => 'Worker','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-23 16:04:50','updated_at' => '2018-07-23 16:04:50','deleted_at' => NULL)
		);

        Role::insert($role);
        RoleName::insert($role_name);
    }
}
