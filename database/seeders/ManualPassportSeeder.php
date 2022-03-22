<?php

namespace Database\Seeders;

use App\Models\ManualPassport;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ManualPassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 16; $i++) {
            $manualPassport = new ManualPassport();
            $manualPassport->user_creator_id = $faker->numberBetween(1, 4);
            $manualPassport->name = $faker->name();
            $manualPassport->passport_number = $faker->phoneNumber();
            $manualPassport->civil_id = $faker->phoneNumber();
            $manualPassport->mailing_address = $faker->email();
            $manualPassport->ems = $faker->text(10);
            // $manualPassport->profession_file = $faker->text(10);
            $manualPassport->kuwait_phone = '01777382007';
            $manualPassport->bd_phone = '01777382007';
            $manualPassport->delivery_date = Carbon::now()->addDay(-5);
            $manualPassport->profession_id = 2;
            $manualPassport->salary = $faker->numberBetween(1, 4);

            $manualPassport->delivery_branch = $faker->numberBetween(1, 4);
            // $manualPassport->is_delivered = $faker->numberBetween(0, 1);
            // $manualPassport->is_shifted = $faker->numberBetween(0, 1);
            // $manualPassport->is_received = $faker->numberBetween(0, 1);
            $manualPassport->r_id = 5;
            $manualPassport->ems = 'MP' . time() . 'Kuwait';
            $manualPassport->entry_person = $faker->numberBetween(17, 21);
            $manualPassport->remarks = $faker->numberBetween(100, 900);
            $manualPassport->save();
        }
    }
}
