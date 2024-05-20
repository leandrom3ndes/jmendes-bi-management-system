<?php

use Illuminate\Database\Seeder;
use App\TransactionType;
use App\TransactionTypeName;

class TransactionTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // `tese_rental`.`transaction_type`
		$transaction_type = array(
		  array('id' => '1','state' => 'active','process_type_id' => '1','init_proc' => '1','executer' => '2','auto_activate' => '0','freq_activate' => NULL,'when_activate' => NULL,'updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-23 15:32:12','updated_at' => '2018-07-23 15:32:12','deleted_at' => NULL),
		  array('id' => '2','state' => 'active','process_type_id' => '1','init_proc' => '0','executer' => '1','auto_activate' => '0','freq_activate' => NULL,'when_activate' => NULL,'updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-23 15:48:46','updated_at' => '2018-07-30 08:48:31','deleted_at' => NULL),
		  array('id' => '3','state' => 'active','process_type_id' => '1','init_proc' => '0','executer' => '5','auto_activate' => '0','freq_activate' => NULL,'when_activate' => NULL,'updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-23 15:52:32','updated_at' => '2018-07-30 08:54:43','deleted_at' => NULL),
		  array('id' => '4','state' => 'active','process_type_id' => '1','init_proc' => '0','executer' => '4','auto_activate' => '0','freq_activate' => NULL,'when_activate' => NULL,'updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-23 15:53:09','updated_at' => '2018-07-23 15:53:09','deleted_at' => NULL),
		  array('id' => '5','state' => 'active','process_type_id' => '1','init_proc' => '0','executer' => '4','auto_activate' => '0','freq_activate' => NULL,'when_activate' => NULL,'updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-23 15:55:17','updated_at' => '2018-07-30 08:57:00','deleted_at' => NULL),
		  array('id' => '6','state' => 'active','process_type_id' => '2','init_proc' => '1','executer' => '7','auto_activate' => '0','freq_activate' => NULL,'when_activate' => NULL,'updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 10:00:47','updated_at' => '2018-07-30 10:00:47','deleted_at' => NULL),
		  array('id' => '7','state' => 'active','process_type_id' => '3','init_proc' => '1','executer' => '9','auto_activate' => '0','freq_activate' => NULL,'when_activate' => NULL,'updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 10:01:25','updated_at' => '2018-07-30 10:01:25','deleted_at' => NULL),
		  array('id' => '8','state' => 'active','process_type_id' => '4','init_proc' => '1','executer' => '11','auto_activate' => '0','freq_activate' => NULL,'when_activate' => NULL,'updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 10:02:07','updated_at' => '2018-07-30 10:02:07','deleted_at' => NULL),
		  array('id' => '9','state' => 'active','process_type_id' => '5','init_proc' => '0','executer' => '14','auto_activate' => '0','freq_activate' => NULL,'when_activate' => NULL,'updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-08-09 09:26:35','updated_at' => '2018-08-09 09:26:35','deleted_at' => NULL),
		  array('id' => '10','state' => 'active','process_type_id' => '5','init_proc' => '1','executer' => '13','auto_activate' => '0','freq_activate' => NULL,'when_activate' => NULL,'updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-08-09 09:27:43','updated_at' => '2018-08-09 09:27:43','deleted_at' => NULL)
		);
		
		// `tese_rental`.`transaction_type_name`
		$transaction_type_name = array(
		  array('transaction_type_id' => '1','language_id' => '1','t_name' => 'Contratação de aluguer','rt_name' => 'Aluguer foi contratado','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-23 16:16:20','updated_at' => '2018-07-23 16:16:20','deleted_at' => NULL),
		  array('transaction_type_id' => '1','language_id' => '2','t_name' => 'Rental Contracting','rt_name' => 'Rental is contracted','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-23 15:32:12','updated_at' => '2018-07-30 08:45:54','deleted_at' => NULL),
		  array('transaction_type_id' => '2','language_id' => '1','t_name' => 'Pagamento de aluguer','rt_name' => 'O aluguer foi pago','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-23 16:17:36','updated_at' => '2018-07-23 16:17:36','deleted_at' => NULL),
		  array('transaction_type_id' => '2','language_id' => '2','t_name' => 'Rental Payment','rt_name' => 'The rent of Rental is paid','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-23 15:48:46','updated_at' => '2018-07-30 08:48:31','deleted_at' => NULL),
		  array('transaction_type_id' => '3','language_id' => '1','t_name' => 'Levantamento do carro','rt_name' => 'O carro de aluguer foi levantado','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-25 17:14:34','updated_at' => '2018-07-25 17:14:34','deleted_at' => NULL),
		  array('transaction_type_id' => '3','language_id' => '2','t_name' => 'Car pick-up','rt_name' => 'The car of Rental is picked up','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-23 15:52:32','updated_at' => '2018-07-30 08:54:43','deleted_at' => NULL),
		  array('transaction_type_id' => '4','language_id' => '1','t_name' => 'Devolução do carro','rt_name' => 'O carro de aluguer foi devolvido','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-25 17:15:23','updated_at' => '2018-07-25 17:15:23','deleted_at' => NULL),
		  array('transaction_type_id' => '4','language_id' => '2','t_name' => 'Car drop-off','rt_name' => 'The car of Rental is dropped off','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-23 15:53:09','updated_at' => '2018-07-30 08:52:25','deleted_at' => NULL),
		  array('transaction_type_id' => '5','language_id' => '1','t_name' => 'Pagamento de multa','rt_name' => 'A multa foi paga','updated_by' => '1','deleted_by' => NULL,'created_at' => '2018-07-25 17:15:38','updated_at' => '2018-07-25 17:15:38','deleted_at' => NULL),
		  array('transaction_type_id' => '5','language_id' => '2','t_name' => 'Penalty payment','rt_name' => 'The penalty of Rental is paid','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-23 15:55:17','updated_at' => '2018-07-30 08:57:00','deleted_at' => NULL),
		  array('transaction_type_id' => '6','language_id' => '2','t_name' => 'Creation of Branch','rt_name' => 'The Branch has been created','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 10:00:47','updated_at' => '2018-07-30 10:00:47','deleted_at' => NULL),
		  array('transaction_type_id' => '7','language_id' => '2','t_name' => 'Creation of Car','rt_name' => 'The Car has been created','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 10:01:25','updated_at' => '2018-07-30 10:01:25','deleted_at' => NULL),
		  array('transaction_type_id' => '8','language_id' => '2','t_name' => 'Creation of Car type','rt_name' => 'The Car type has been created','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-07-30 10:02:07','updated_at' => '2018-07-30 10:10:13','deleted_at' => NULL),
		  array('transaction_type_id' => '9','language_id' => '2','t_name' => 'Transport completion','rt_name' => 'Transport is completed','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-08-09 09:26:35','updated_at' => '2018-08-09 09:26:35','deleted_at' => NULL),
		  array('transaction_type_id' => '10','language_id' => '2','t_name' => 'Transport management','rt_name' => 'Transport management for Day is done','updated_by' => '2','deleted_by' => NULL,'created_at' => '2018-08-09 09:27:43','updated_at' => '2018-08-09 09:27:43','deleted_at' => NULL)
		);

        TransactionType::insert($transaction_type);
        TransactionTypeName::insert($transaction_type_name);
    }
}
