<?php

use Illuminate\Database\Seeder;
use App\Language;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // `tese_rental`.`language`
		$language = array(
		  array('id' => '1','name' => 'Português','slug' => 'pt','state' => 'active','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
		  array('id' => '2','name' => 'English','slug' => 'en','state' => 'active','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL)
		);

        Language::insert($language);
    }
}
