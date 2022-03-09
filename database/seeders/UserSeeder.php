<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //admin
        $user = new User();
        $user->name = 'Mr. Admin';
        $user->email = 'admin@gmail.com';
        $user->phone = '01700000000';
        $user->branch_id = 1;
        $user->password = Hash::make('12345');
        $user->status = 1;
        $user->user_type = 'admin'; //Admin user_type == 'admin'
        $user->save();

        $user->assignRole('admin');

        for ($i = 0; $i < 5; $i++) {

            $user = new User();
            $user->name = 'Mr. Branch Manager ' . $i;
            $user->email = 'branch-manager' . $i . '@gmail.com';
            $user->phone = $faker->phoneNumber();
            $user->branch_id = $faker->numberBetween(1, 4);
            $user->password = Hash::make('12345');
            $user->status = 1;
            $user->user_type = 'branch-manager'; // Branch Manager user_type == 'branch-manager'
            $user->save();
            $user->assignRole('branch-manager');
        }

        for ($i = 0; $i < 5; $i++) {

            $user = new User();
            $user->name = 'Mr. call center ' . $i;
            $user->email = 'call-center' . $i . '@gmail.com';
            $user->phone = $faker->phoneNumber();
            $user->branch_id = $faker->numberBetween(1, 5);
            $user->password = Hash::make('12345');
            $user->status = 1;
            $user->user_type = 'call-center'; // Call center user_type == 'call-center'
            $user->save();
            $user->assignRole('call-center');
        }

        for ($i = 0; $i < 5; $i++) {

            $user = new User();
            $user->name = 'Mr. account manager ' . $i;
            $user->email = 'account-manager' . $i . '@gmail.com';
            $user->phone = $faker->phoneNumber();
            $user->branch_id = $faker->numberBetween(1, 5);
            $user->password = Hash::make('12345');
            $user->status = 1;
            $user->user_type = 'account-manager'; // Account Manager user_type == 'account-manager'
            $user->save();
            $user->assignRole('account-manager');
        }

        for ($i = 0; $i < 5; $i++) {

            $user = new User();
            $user->name = 'Mr. data enterer ' . $i;
            $user->parent_id = 3;
            $user->email = 'data-enterer' . $i . '@gmail.com';
            $user->phone = $faker->phoneNumber();
            $user->branch_id = $faker->numberBetween(1, 4);
            $user->password = Hash::make('12345');
            $user->status = 1;
            $user->entry_status = 1;
            $user->user_type = 'data-enterer'; // Data Enterer user_type == 'data-enterer'
            $user->save();
            $user->assignRole('data-enterer');
        }

        $user = new User();
        $user->name = 'Embassy';
        $user->email = 'embassy@gmail.com';
        $user->phone = $faker->phoneNumber();
        $user->password = Hash::make('12345');
        $user->status = 1;
        $user->user_type = 'embassy'; //embassy user_type == 'embassy'
        $user->save();
        $user->assignRole('embassy');
    }
}
