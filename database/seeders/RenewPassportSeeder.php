<?php

namespace Database\Seeders;

use App\Models\RenewPassport;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Generator as Faker;

class RenewPassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 16; $i++) {
            $renewPassport = new RenewPassport();
            $renewPassport->user_creator_id = $faker->numberBetween(1, 4);
            $renewPassport->name = $faker->name();
            $renewPassport->passport_number = $faker->phoneNumber();
            $renewPassport->civil_id = $faker->phoneNumber();
            $renewPassport->mailing_address = $faker->email();
            $renewPassport->ems = $faker->text(10);
            // $renewPassport->profession_file = $faker->text(10);
            $renewPassport->kuwait_phone = '01777382007';
            $renewPassport->bd_phone = '01777382117';
            $renewPassport->delivery_date = Carbon::now()->addDay(5);
            $renewPassport->profession_id = 1;
            $renewPassport->salary = $faker->numberBetween(1, 4);

            $renewPassport->delivery_branch = $faker->numberBetween(1, 5);
            // $renewPassport->is_delivered = $faker->numberBetween(0, 1);
            $renewPassport->r_id = 5;
            $renewPassport->ems = 'EP' . time() . 'Kuwait';
            $renewPassport->entry_person = $faker->numberBetween(17, 21);
            $renewPassport->remarks = $faker->numberBetween(100, 900);
            $renewPassport->save();
        }
    }
}
