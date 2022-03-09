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
            $lostPassport = new RenewPassport();
            $lostPassport->user_creator_id = $faker->numberBetween(1, 4);
            $lostPassport->name = $faker->name();
            $lostPassport->passport_number = $faker->phoneNumber();
            $lostPassport->emirates_id = $faker->phoneNumber();
            $lostPassport->govt_passport_id = $faker->phoneNumber();
            $lostPassport->mailing_address = $faker->email();
            $lostPassport->ems = $faker->text(10);
            // $lostPassport->profession_file = $faker->text(10);
            $lostPassport->kuwait_phone = '01777382007';
            $lostPassport->bd_phone = '01777382117';
            $lostPassport->delivery_date = Carbon::now()->addDay(-5);
            $lostPassport->profession_id = 1;
            $lostPassport->salary = $faker->numberBetween(1, 4);

            $lostPassport->delivery_branch = $faker->numberBetween(1, 5);
            // $lostPassport->is_delivered = $faker->numberBetween(0, 1);
            // $lostPassport->is_shifted = $faker->numberBetween(0, 1);
            // $lostPassport->is_received = $faker->numberBetween(0, 1);
            $lostPassport->r_id = 5;
            $lostPassport->ems = 'EP' . time() . 'Kuwait';
            $lostPassport->entry_person = $faker->numberBetween(17, 21);
            $lostPassport->remarks = $faker->numberBetween(100, 900);
            $lostPassport->save();
        }
    }
}
