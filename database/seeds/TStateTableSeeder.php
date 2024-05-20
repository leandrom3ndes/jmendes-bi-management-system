<?php

use Illuminate\Database\Seeder;
use App\TState;
use App\TStateName;

class TStateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // `tese_rental`.`t_state`
        $t_state = array(
            array('id' => '0','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('id' => '1','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-05-30 08:32:50','updated_at' => '2018-08-09 10:32:41','deleted_at' => NULL),
            array('id' => '2','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-05-30 08:32:56','updated_at' => '2018-05-30 08:32:56','deleted_at' => NULL),
            array('id' => '3','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-05-30 08:33:01','updated_at' => '2018-05-30 08:33:01','deleted_at' => NULL),
            array('id' => '4','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-05-30 08:33:10','updated_at' => '2018-05-30 08:33:10','deleted_at' => NULL),
            array('id' => '5','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-05-30 08:33:18','updated_at' => '2018-05-30 08:33:18','deleted_at' => NULL),
            array('id' => '6','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2020-04-20 09:00:00','updated_at' => '2020-04-20 09:00:00','deleted_at' => NULL),
            array('id' => '7','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:39:31','updated_at' => '2020-04-20 09:00:00','deleted_at' => NULL),
            array('id' => '8','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:39:39','updated_at' => '2019-10-03 11:39:39','deleted_at' => NULL),
            array('id' => '9','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:40:00','updated_at' => '2019-10-03 11:40:00','deleted_at' => NULL),
            array('id' => '10','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:40:05','updated_at' => '2019-10-03 11:40:05','deleted_at' => NULL),
            array('id' => '11','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:40:12','updated_at' => '2019-10-03 11:40:12','deleted_at' => NULL),
            array('id' => '12','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:40:19','updated_at' => '2019-10-03 11:40:19','deleted_at' => NULL),
            array('id' => '13','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:40:25','updated_at' => '2019-10-03 11:40:25','deleted_at' => NULL),
            array('id' => '14','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:40:32','updated_at' => '2019-10-03 11:40:32','deleted_at' => NULL),
            array('id' => '15','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:40:39','updated_at' => '2019-10-03 11:40:39','deleted_at' => NULL),
            array('id' => '16','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:40:46','updated_at' => '2019-10-03 11:40:46','deleted_at' => NULL),
            array('id' => '17','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:40:54','updated_at' => '2019-10-03 11:40:54','deleted_at' => NULL),
            array('id' => '18','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:40:59','updated_at' => '2019-10-03 11:40:59','deleted_at' => NULL),
            array('id' => '19','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:41:10','updated_at' => '2019-10-03 11:41:10','deleted_at' => NULL),
            array('id' => '20','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:41:16','updated_at' => '2019-10-03 11:41:16','deleted_at' => NULL)
        );

        /* `tese_action_rules`.`t_state_name` */
        $t_state_name = array(
            array('t_state_id' => '0','language_id' => '1','name' => 'inicial','updated_by' => '1','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2018-08-09 10:32:53','deleted_at' => NULL),
            array('t_state_id' => '0','language_id' => '2','name' => 'initial','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-05-30 08:32:50','updated_at' => '2018-05-30 08:32:50','deleted_at' => NULL),
            array('t_state_id' => '1','language_id' => '1','name' => 'pedido','updated_by' => '1','deleted_by' => NULL,'created_at' => NULL,'updated_at' => '2018-08-09 10:32:53','deleted_at' => NULL),
            array('t_state_id' => '1','language_id' => '2','name' => 'requested','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-05-30 08:32:50','updated_at' => '2018-05-30 08:32:50','deleted_at' => NULL),
            array('t_state_id' => '2','language_id' => '1','name' => 'promessa','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('t_state_id' => '2','language_id' => '2','name' => 'promised','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-05-30 08:32:56','updated_at' => '2018-05-30 08:32:56','deleted_at' => NULL),
            array('t_state_id' => '3','language_id' => '1','name' => 'execução','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('t_state_id' => '3','language_id' => '2','name' => 'executed','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-05-30 08:33:01','updated_at' => '2018-05-30 08:33:01','deleted_at' => NULL),
            array('t_state_id' => '4','language_id' => '1','name' => 'declaração','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('t_state_id' => '4','language_id' => '2','name' => 'declared','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-05-30 08:33:10','updated_at' => '2020-04-10 09:55:10','deleted_at' => NULL),
            array('t_state_id' => '5','language_id' => '1','name' => 'aceitação','updated_by' => NULL,'deleted_by' => NULL,'created_at' => NULL,'updated_at' => NULL,'deleted_at' => NULL),
            array('t_state_id' => '5','language_id' => '2','name' => 'accepted','updated_by' => NULL,'deleted_by' => NULL,'created_at' => '2018-05-30 08:33:18','updated_at' => '2018-05-30 08:33:18','deleted_at' => NULL),
            array('t_state_id' => '6','language_id' => '2','name' => 'declined','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:41:16','updated_at' => '2020-04-20 09:00:00','deleted_at' => NULL),
            array('t_state_id' => '7','language_id' => '2','name' => 'rejected','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:41:10','updated_at' => '2020-04-20 09:00:00','deleted_at' => NULL),
            array('t_state_id' => '8','language_id' => '2','name' => 'revoke_request_requested','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:39:31','updated_at' => '2019-10-03 11:39:31','deleted_at' => NULL),
            array('t_state_id' => '9','language_id' => '2','name' => 'revoke_request_allowed','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:39:39','updated_at' => '2019-10-03 11:39:39','deleted_at' => NULL),
            array('t_state_id' => '10','language_id' => '2','name' => 'revoke_request_refused','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:40:00','updated_at' => '2019-10-03 11:40:00','deleted_at' => NULL),
            array('t_state_id' => '11','language_id' => '2','name' => 'revoke_promise_requested','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:40:05','updated_at' => '2019-10-03 11:40:05','deleted_at' => NULL),
            array('t_state_id' => '12','language_id' => '2','name' => 'revoke_promise_allowed','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:40:12','updated_at' => '2019-10-03 11:40:12','deleted_at' => NULL),
            array('t_state_id' => '13','language_id' => '2','name' => 'revoke_promise_refused','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:40:19','updated_at' => '2019-10-03 11:40:19','deleted_at' => NULL),
            array('t_state_id' => '14', 'language_id' => '2', 'name' => 'revoke_declare_requested', 'updated_by'=>'2','deleted_by'=> NULL, 'created_at' => '2019-10-03 11:40:25','updated_at' => '2020-04-10 09:57:00','deleted_at' => NULL),
            array('t_state_id' => '15','language_id' => '2','name' => 'revoke_declare_allowed','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:40:32','updated_at' => '2020-04-10 09:57:30','deleted_at' => NULL),
            array('t_state_id' => '16','language_id' => '2','name' => 'revoke_declare_refused','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:40:39','updated_at' => '2020-04-10 09:58:00','deleted_at' => NULL),
            array('t_state_id' => '17','language_id' => '2','name' => 'revoke_acceptance_requested','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:40:46','updated_at' => '2019-10-03 11:40:46','deleted_at' => NULL),
            array('t_state_id' => '18','language_id' => '2','name' => 'revoke_acceptance_allowed','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:40:54','updated_at' => '2019-10-03 11:40:54','deleted_at' => NULL),
            array('t_state_id' => '19','language_id' => '2','name' => 'revoke_acceptance_refused','updated_by' => '2','deleted_by' => NULL,'created_at' => '2019-10-03 11:40:59','updated_at' => '2019-10-03 11:40:59','deleted_at' => NULL),
            );

        TState::insert($t_state);
        TStateName::insert($t_state_name);
    }
}
