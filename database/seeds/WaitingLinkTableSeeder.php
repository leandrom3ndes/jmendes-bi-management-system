<?php

use Illuminate\Database\Seeder;
use App\WaitingLink;

class WaitingLinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // `tese_rental`.`waiting_link`
		$waiting_link = array(
		  array('id' => '8','waited_t' => '2','waited_act' => '2','waiting_act' => '2','waiting_t' => '1','min' => '1','max' => '1','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-07-30 16:04:37','updated_at' => '2018-07-30 16:04:37','deleted_at' => NULL),
		  array('id' => '9','waited_t' => '2','waited_act' => '5','waiting_act' => '3','waiting_t' => '1','min' => '1','max' => '1','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-07-30 16:05:08','updated_at' => '2018-07-30 16:05:08','deleted_at' => NULL),
		  array('id' => '12','waited_t' => '9','waited_act' => '5','waiting_act' => '3','waiting_t' => '10','min' => '0','max' => '*','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-08-09 09:29:49','updated_at' => '2018-08-09 09:29:49','deleted_at' => NULL)
		);

        WaitingLink::insert($waiting_link);
    }
}
