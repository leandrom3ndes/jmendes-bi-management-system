<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // $this->call(UsersTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        DB::statement('SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";');
        $this->call(TStateTableSeeder::class);
        $this->call(ActorTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(RoleHasActorTableSeeder::class);
		$this->call(RoleHasUserTableSeeder::class);

        $this->call(ProcessTypeTableSeeder::class);
        $this->call(TransactionTypeTableSeeder::class);

        $this->call(PropertyTableSeeder::class);
        $this->call(PropAllowedValueTableSeeder::class);

        $this->call(EntTypeTableSeeder::class);

        $this->call(ActorIniciatesTTableSeeder::class);

		$this->call(WaitingLinkTableSeeder::class);
		$this->call(CausalLinkTableSeeder::class);

        $this->call(ValuesTableSeeder::class);

        //Action Rules
        $this->call(ActionRuleTableSeeder::class);
        $this->call(ActionTableSeeder::class);
        $this->call(TemplateTableSeeder::class);

        //Form Builder Validations

        $this->call(ValidationCondSeeder::class);
        // supposed to only apply to a single connection and reset it's self
        // but I like to explicitly undo what I've done for clarity
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
