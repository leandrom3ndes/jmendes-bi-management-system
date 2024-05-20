<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;


class ForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Updated by e Deleted by

        Schema::table('users', function(Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('language')->onDelete('no action')->onUpdate('no action');
            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('actor', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('actor_iniciates_t', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('causal_link', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('ent_type', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('entity', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('process', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('process_type', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('prop_allowed_value', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('prop_unit_type', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('property', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('role', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('role_has_actor', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('role_has_user', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('t_state', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('transaction', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('transaction_ack', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('transaction_state', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('transaction_type', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('value', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('waiting_link', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('language', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('actor_name', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('ent_type_name', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('entity_name', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('process_name', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('process_type_name', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('prop_allowed_value_name', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('prop_unit_type_name', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('property_name', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('role_name', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('t_state_name', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('transaction_type_name', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('value_name', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
		Schema::table('operator', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('query', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('condition', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
		Schema::table('external_integration', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
		Schema::table('prop_ext_name', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('action_rule', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('action', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('ar_condition', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('comp_evaluated_expression', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('user_evaluated_expression', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('action_log', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('action_template', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('action_template_name', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('delegation', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('action_name', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('cur_form_compute_code', function(Blueprint $table) {
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('actor_iniciates_t', function(Blueprint $table) {
            $table->foreign('transaction_type_id')->references('id')->on('transaction_type')->onDelete('no action')->onUpdate('no action');
            $table->foreign('actor_id')->references('id')->on('actor')->onDelete('no action')->onUpdate('no action');
            $table->primary(array('transaction_type_id', 'actor_id'));
        });

        Schema::table('causal_link', function(Blueprint $table) {
            $table->foreign('causing_action')->references('id')->on('action')->onDelete('no action')->onUpdate('no action');
            $table->foreign('caused_action_rule')->references('id')->on('action_rule')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('entity', function(Blueprint $table) {
            $table->foreign('ent_type_id')->references('id')->on('ent_type')->onDelete('no action')->onUpdate('no action');
			$table->foreign('transaction_id')->references('id')->on('transaction')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('prop_allowed_value', function(Blueprint $table) {
            $table->foreign('property_id')->references('id')->on('property')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('role_has_actor', function(Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('role')->onDelete('no action')->onUpdate('no action');
            $table->foreign('actor_id')->references('id')->on('actor')->onDelete('no action')->onUpdate('no action');
            $table->primary(array('role_id', 'actor_id'));
        });

        Schema::table('role_has_user', function(Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('role')->onDelete('no action')->onUpdate('no action');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->primary(array('role_id', 'user_id'));
        });

        Schema::table('transaction', function(Blueprint $table) {
            $table->foreign('process_id')->references('id')->on('process')->onDelete('no action')->onUpdate('no action');
            $table->foreign('transaction_type_id')->references('id')->on('transaction_type')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('transaction_ack', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('transaction_state_id')->references('id')->on('transaction_state')->onDelete('no action')->onUpdate('no action');

        });

        Schema::table('transaction_state', function(Blueprint $table) {
            $table->foreign('transaction_id')->references('id')->on('transaction')->onDelete('no action')->onUpdate('no action');
            $table->foreign('t_state_id')->references('id')->on('t_state')->onDelete('no action')->onUpdate('no action');
            $table->foreign('action_id')->references('id')->on('action')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('transaction_type', function(Blueprint $table) {
            $table->foreign('process_type_id')->references('id')->on('process_type')->onDelete('no action')->onUpdate('no action');
            $table->foreign('executer')->references('id')->on('actor')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('value', function(Blueprint $table) {
            $table->foreign('property_id')->references('id')->on('property')->onDelete('no action')->onUpdate('no action');
            $table->foreign('entity_id')->references('id')->on('entity')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('waiting_link', function(Blueprint $table) {
            $table->foreign('waited_t')->references('id')->on('transaction_type')->onDelete('no action')->onUpdate('no action');
            $table->foreign('waited_act')->references('id')->on('t_state')->onDelete('no action')->onUpdate('no action');
            $table->foreign('waiting_act')->references('id')->on('t_state')->onDelete('no action')->onUpdate('no action');
            $table->foreign('waiting_t')->references('id')->on('transaction_type')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('property', function (Blueprint $table) {
            $table->foreign('ent_type_id')->references('id')->on('ent_type')->onDelete('no action')->onUpdate('no action');
            $table->foreign('unit_type_id')->references('id')->on('prop_unit_type')->onDelete('no action')->onUpdate('no action');
            $table->foreign('fk_property_id')->references('id')->on('property')->onDelete('no action')->onUpdate('no action');
            $table->foreign('action_id')->references('id')->on('action')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('process', function (Blueprint $table) {
            $table->foreign('process_type_id')->references('id')->on('process_type')->onDelete('no action')->onUpdate('no action');
        });
        Schema::table('ent_type', function (Blueprint $table) {
            $table->foreign('transaction_type_id')->references('id')->on('transaction_type')->onDelete('no action')->onUpdate('no action');
        });

		Schema::table('condition', function (Blueprint $table) {
            $table->foreign('query_id')->references('id')->on('query')->onDelete('no action')->onUpdate('no action');
            $table->foreign('operator_id')->references('id')->on('operator')->onDelete('no action')->onUpdate('no action');
            $table->foreign('property_id')->references('id')->on('property')->onDelete('no action')->onUpdate('no action');
            $table->foreign('value_id')->references('id')->on('value')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('query', function (Blueprint $table) {
            $table->foreign('ent_type_id')->references('id')->on('ent_type')->onDelete('no action')->onUpdate('no action');
        });

		Schema::table('external_integration', function(Blueprint $table) {
            $table->foreign('ent_type_id')->references('id')->on('ent_type')->onDelete('no action')->onUpdate('no action');
            $table->foreign('t_state_id')->references('id')->on('t_state')->onDelete('no action')->onUpdate('no action');

        });

		Schema::table('prop_ext_name', function(Blueprint $table) {
            $table->foreign('external_integration_id')->references('id')->on('external_integration')->onDelete('no action')->onUpdate('no action');
            $table->foreign('property_id')->references('id')->on('property')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('action_rule', function(Blueprint $table) {
            $table->foreign('t_state_id')->references('id')->on('t_state')->onDelete('no action')->onUpdate('no action');
            $table->foreign('transaction_type_id')->references('id')->on('transaction_type')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('action', function(Blueprint $table) {
            $table->foreign('action_rule_id')->references('id')->on('action_rule')->onDelete('no action')->onUpdate('no action');
            $table->foreign('par_action_id')->references('id')->on('action')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('ar_condition', function(Blueprint $table) {
            $table->foreign('action_id')->references('id')->on('action')->onDelete('no action')->onUpdate('no action');
            $table->foreign('sub_ar_condition_id')->references('id')->on('ar_condition')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('comp_evaluated_expression', function(Blueprint $table) {
            $table->foreign('ar_condition_id')->references('id')->on('ar_condition')->onDelete('no action')->onUpdate('no action');
            $table->foreign('property_id1')->references('id')->on('property')->onDelete('no action')->onUpdate('no action');
            $table->foreign('value_id1')->references('id')->on('value')->onDelete('no action')->onUpdate('no action');
            $table->foreign('property_id2')->references('id')->on('property')->onDelete('no action')->onUpdate('no action');
            $table->foreign('action_id')->references('id')->on('action')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('user_evaluated_expression', function(Blueprint $table) {
            $table->foreign('ar_condition_id')->references('id')->on('ar_condition')->onDelete('no action')->onUpdate('no action');
            $table->foreign('action_id')->references('id')->on('action')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('action_log', function(Blueprint $table) {
            $table->foreign('action_id')->references('id')->on('action')->onDelete('no action')->onUpdate('no action');
            $table->foreign('transaction_id')->references('id')->on('transaction')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('action_template', function(Blueprint $table) {
            $table->foreign('action_id')->references('id')->on('action')->onDelete('no action')->onUpdate('no action');
            $table->foreign('property_id')->references('id')->on('property')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('delegation', function(Blueprint $table) {
            $table->foreign('delegates_role_id')->references('id')->on('role')->onDelete('no action')->onUpdate('no action');
            $table->foreign('delegated_role_id')->references('id')->on('role')->onDelete('no action')->onUpdate('no action');
            $table->foreign('t_state_id')->references('id')->on('t_state')->onDelete('no action')->onUpdate('no action');
        });

        Schema::table('cur_form_compute_code', function(Blueprint $table) {
            $table->foreign('ar_condition_id')->references('id')->on('ar_condition')->onDelete('no action')->onUpdate('no action');
        });
    }

    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign(['language_id']);
            $table->dropForeign(['entity_id']);
        });

        Schema::table('waiting_link', function (Blueprint $table) {
            $table->dropForeign(['waited_t']);
            $table->dropForeign(['waited_act']);
            $table->dropForeign(['waiting_act']);
            $table->dropForeign(['waiting_t']);
        });

        Schema::table('value', function (Blueprint $table) {
            $table->dropForeign(['property_id']);
            $table->dropForeign(['entity_id']);
        });

        Schema::table('transaction_type', function (Blueprint $table) {
            $table->dropForeign(['process_type_id']);
            $table->dropForeign(['executer']);
        });

        Schema::table('transaction_state', function (Blueprint $table) {
            $table->dropForeign(['transaction_id']);
            $table->dropForeign(['t_state_id']);
            $table->dropForeign(['action_id']);
        });

        Schema::table('transaction_ack', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['transaction_state_id']);
        });

        Schema::table('transaction', function (Blueprint $table) {
            $table->dropForeign(['process_id']);
            $table->dropForeign(['transaction_type_id']);
        });

        Schema::table('role_has_user', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('role_has_actor', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropForeign(['actor_id']);
        });

        Schema::table('property', function (Blueprint $table) {
            $table->dropForeign(['unit_type_id']);
            $table->dropForeign(['fk_property_id']);
            $table->dropForeign(['ent_type_id']);
            $table->dropForeign(['action_id']);
        });

        Schema::table('prop_allowed_value', function (Blueprint $table) {
            $table->dropForeign(['property_id']);
        });

        Schema::table('process', function (Blueprint $table) {
            $table->dropForeign(['process_type_id']);
        });

        Schema::table('entity', function (Blueprint $table) {
            $table->dropForeign(['ent_type_id']);
			$table->dropForeign(['transaction_id']);
        });

        Schema::table('ent_type', function (Blueprint $table) {
            $table->dropForeign(['transaction_type_id']);
        });

        Schema::table('actor_iniciates_t', function (Blueprint $table) {
            $table->dropForeign(['transaction_type_id']);
            $table->dropForeign(['actor_id']);
        });

        Schema::table('causal_link', function (Blueprint $table) {
            $table->dropForeign(['causing_action']);
            $table->dropForeign(['caused_action_rule']);
        });

        Schema::table('condition', function (Blueprint $table) {
            $table->dropForeign(['query_id']);
            $table->dropForeign(['operator_id']);
            $table->dropForeign(['property_id']);
            $table->dropForeign(['value_id']);
        });

        Schema::table('query', function (Blueprint $table) {
            $table->dropForeign(['ent_type_id']);
        });

		Schema::table('external_integration', function (Blueprint $table) {
            $table->dropForeign(['ent_type_id']);
			$table->dropForeign(['t_state_id']);
        });

		Schema::table('prop_ext_name', function (Blueprint $table) {
            $table->dropForeign(['property_id']);
			$table->dropForeign(['external_integration_id']);
        });

        Schema::table('action_rule', function(Blueprint $table) {
            $table->dropForeign(['t_state_id']);
            $table->dropForeign(['transaction_type_id']);
        });

        Schema::table('action', function(Blueprint $table) {
            $table->dropForeign(['action_rule_id']);
            $table->dropForeign(['par_action_id']);
        });

        Schema::table('ar_condition', function(Blueprint $table) {
            $table->dropForeign(['action_id']);
            $table->dropForeign(['sub_ar_condition_id']);
        });

        Schema::table('comp_evaluated_expression', function(Blueprint $table) {
            $table->dropForeign(['ar_condition_id']);
            $table->dropForeign(['property_id1']);
            $table->dropForeign(['value_id1']);
            $table->dropForeign(['property_id2']);
            $table->dropForeign(['action_id']);
        });

        Schema::table('user_evaluated_expression', function(Blueprint $table) {
            $table->dropForeign(['ar_condition_id']);
        });

        Schema::table('action_log', function (Blueprint $table) {
            $table->dropForeign(['action_id']);
            $table->dropForeign(['transaction_id']);
        });

        Schema::table('action_template', function (Blueprint $table) {
            $table->dropForeign(['action_id']);
            $table->dropForeign(['property_id']);
        });

        Schema::table('delegation', function (Blueprint $table) {
            $table->dropForeign(['delegates_role_id']);
            $table->dropForeign(['delegated_role_id']);
            $table->dropForeign(['t_state_id']);
        });

        Schema::table('cur_form_compute_code', function(Blueprint $table) {
            $table->dropForeign(['ar_condition_id']);
        });

        // Updated by e Deleted by

        Schema::table('actor', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('actor_iniciates_t', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('causal_link', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('ent_type', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });

        Schema::table('entity', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('process', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('process_type', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('prop_allowed_value', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('prop_unit_type', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('property', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('role', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('role_has_actor', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('role_has_user', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('t_state', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('transaction', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('transaction_ack', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('transaction_state', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('transaction_type', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('value', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('waiting_link', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('language', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('actor_name', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('ent_type_name', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('entity_name', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('process_name', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('process_type_name', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('prop_allowed_value_name', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('prop_unit_type_name', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('property_name', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('role_name', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('t_state_name', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('transaction_type_name', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('value_name', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('operator', function (Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('query', function (Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('condition', function (Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
		Schema::table('external_integration', function (Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
		Schema::table('prop_ext_name', function (Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('action_rule', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('action', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('ar_condition', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('comp_evaluated_expression', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('user_evaluated_expression', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('action_log', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('action_template', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('action_template_name', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('delegation', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('action_name', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
        Schema::table('cur_form_compute_code', function(Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropForeign(['deleted_by']);
        });
    }

}
