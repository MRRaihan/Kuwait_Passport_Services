<?php

namespace Database\Seeders;

use App\Models\NewBornBabyPassport;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class NewBornBabyPassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 16; $i++) {
            $newBornBabyPassport = new NewBornBabyPassport();
            $newBornBabyPassport->user_creator_id = $faker->numberBetween(1, 4);
            $newBornBabyPassport->branch_id = $faker->numberBetween(1, 5);
            $newBornBabyPassport->name = $faker->name();
            $newBornBabyPassport->passport_number = $faker->phoneNumber();
            $newBornBabyPassport->emirates_id = $faker->phoneNumber();
            $newBornBabyPassport->govt_passport_id = $faker->phoneNumber();
            $newBornBabyPassport->mailing_address = $faker->email();
            $newBornBabyPassport->permanent_address = $faker->country();
            $newBornBabyPassport->ems = $faker->text(10);
            // $newBornBabyPassport->profession_file = $faker->text(10);
            // $newBornBabyPassport->passport_photocopy = $faker->text(10);
            $newBornBabyPassport->kuwait_phone = '01777382007';
            $newBornBabyPassport->bd_phone = '01777382007';
            $newBornBabyPassport->kuwait_phone = '01777382007';
            $newBornBabyPassport->special_skill = null;
            $newBornBabyPassport->residence = $faker->country();
            $newBornBabyPassport->delivery_date = Carbon::now()->addDay(-5);
            $newBornBabyPassport->profession_id = 1;
            $newBornBabyPassport->salary = $faker->numberBetween(1, 4);

            $newBornBabyPassport->delivery_branch = $faker->numberBetween(1, 4);
            $newBornBabyPassport->is_delivered = $faker->numberBetween(0, 1);
            $newBornBabyPassport->is_shifted = $faker->numberBetween(0, 1);
            $newBornBabyPassport->is_received = $faker->numberBetween(0, 1);
            $newBornBabyPassport->r_id = 5;
            $newBornBabyPassport->entry_person = $faker->numberBetween(17, 21);
            $newBornBabyPassport->remarks = $faker->numberBetween(100, 900);
            $newBornBabyPassport->save();
        }
    }
}
