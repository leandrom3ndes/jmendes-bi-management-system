<?php

use Illuminate\Database\Seeder;
use App\Users;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // `tese_rental`.`users`
		$users = array(
		  array('id' => '1','name' => 'Pedro','nif' => NULL,'email' => 'pedro@mail.com','password' => '$2y$10$4LzKs0hZlUU0Ox/P3gh0/e5MjRBg0wVf74R2DNrHlYHSXIAI4mska','user_name' => 'pedro','language_id' => '1','user_type' => 'internal','entity_id' => NULL,'remember_token' => 'AUUR94Z6cUHlrD4Vfup0bIgQ002ukD2woJjfK733UBpHJfSvL6yBF9kbueq6','created_at' => '2018-01-04 15:18:13','updated_at' => '2018-01-04 15:18:13','deleted_at' => NULL),
		  array('id' => '2','name' => 'John','nif' => NULL,'email' => 'john@mail.com','password' => '$2y$10$.eFnvAeKtd9yoMTt/08uQ.8hg37ARUNzsXmG9WkzTO.5VQRPflbdy','user_name' => 'john','language_id' => '2','user_type' => 'internal','entity_id' => NULL,'remember_token' => 'AImnDfn4AVvaYuPacsiHacoz8LqIMMBPJQnIx2DMNSG32K9SX615b3XLUe6U','created_at' => '2018-01-04 15:44:07','updated_at' => '2018-01-04 15:44:07','deleted_at' => NULL),
		  array('id' => '3','name' => 'Sara','nif' => NULL,'email' => 'sara@mail.com','password' => '$2y$10$.eFnvAeKtd9yoMTt/08uQ.8hg37ARUNzsXmG9WkzTO.5VQRPflbdy','user_name' => 'sara','language_id' => '2','user_type' => 'internal','entity_id' => NULL,'remember_token' => '2JBWSad58JNr18lCThonR5QgYkcm5Aoua15gfo3E0hdvoBcoHRqcqQ4fXMAa','created_at' => '2018-01-04 15:44:07','updated_at' => '2018-01-04 15:44:07','deleted_at' => NULL),
		  array('id' => '4','name' => 'Peter','nif' => NULL,'email' => 'peter@mail.com','password' => '$2y$10$.eFnvAeKtd9yoMTt/08uQ.8hg37ARUNzsXmG9WkzTO.5VQRPflbdy','user_name' => 'peter','language_id' => '2','user_type' => 'internal','entity_id' => NULL,'remember_token' => 'SZCzqKUMsdOcI4yzRcaqRXBgVZLWqr10SVJpmAy0INqp5Z2VA4IOnkcJH9z1','created_at' => '2018-01-04 15:44:07','updated_at' => '2018-01-04 15:44:07','deleted_at' => NULL),
		  array('id' => '5','name' => 'UserPT','nif' => NULL,'email' => 'PT@mail.com','password' => '$2y$10$.eFnvAeKtd9yoMTt/08uQ.8hg37ARUNzsXmG9WkzTO.5VQRPflbdy','user_name' => 'userPT','language_id' => '1','user_type' => 'internal','entity_id' => NULL,'remember_token' => 'SZCzqKUMsdOcI4yzRcaqRXBgVZLWqr10SVJpmAy0INqp5Z2VA4IOnkcJH9z1','created_at' => '2018-01-04 15:44:07','updated_at' => '2018-01-04 15:44:07','deleted_at' => NULL),
		  array('id' => '6','name' => 'UserEN','nif' => NULL,'email' => 'EN@mail.com','password' => '$2y$10$.eFnvAeKtd9yoMTt/08uQ.8hg37ARUNzsXmG9WkzTO.5VQRPflbdy','user_name' => 'userEN','language_id' => '2','user_type' => 'internal','entity_id' => NULL,'remember_token' => 'SZCzqKUMsdOcI4yzRcaqRXBgVZLWqr10SVJpmAy0INqp5Z2VA4IOnkcJH9z1','created_at' => '2018-01-04 15:44:07','updated_at' => '2018-01-04 15:44:07','deleted_at' => NULL),
		);

        Users::insert($users);
    }
}
