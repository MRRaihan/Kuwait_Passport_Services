<?php

namespace Database\Seeders;

use App\Models\PassportFee;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PassportFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 5; $i++) {
            $passportFee = new PassportFee();
            $passportFee->title = $faker->name;
            $passportFee->type = 'lost-passport';
            $passportFee->government_fee = $faker->numberBetween(4000, 5000);
            $passportFee->versatilo_fee = $faker->numberBetween(3000, 4000);
            $passportFee->status = $faker->boolean();
            $passportFee->save();
        }
        for ($i = 0; $i < 5; $i++) {
            $passportFee = new PassportFee();
            $passportFee->title = $faker->name;
            $passportFee->type = 'manual-passport';
            $passportFee->government_fee = $faker->numberBetween(4000, 5000);
            $passportFee->versatilo_fee = $faker->numberBetween(3000, 4000);
            $passportFee->status = $faker->boolean();
            $passportFee->save();
        }
        for ($i = 0; $i < 5; $i++) {
            $passportFee = new PassportFee();
            $passportFee->title = $faker->name;
            $passportFee->type = 'renew-passport';
            $passportFee->government_fee = $faker->numberBetween(4000, 5000);
            $passportFee->versatilo_fee = $faker->numberBetween(3000, 4000);
            $passportFee->status = $faker->boolean();
            $passportFee->save();
        }
        for ($i = 0; $i < 5; $i++) {
            $passportFee = new PassportFee();
            $passportFee->title = $faker->name;
            $passportFee->type = 'new-born-baby-passport';
            $passportFee->government_fee = $faker->numberBetween(4000, 5000);
            $passportFee->versatilo_fee = $faker->numberBetween(3000, 4000);
            $passportFee->status = $faker->boolean();
            $passportFee->save();
        }
    }
}
