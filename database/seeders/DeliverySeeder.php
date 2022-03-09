<?php

namespace Database\Seeders;

use App\Models\Delivery;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 2; $i++) {
            $delivery = new Delivery();
            $delivery->name = $faker->name;
            $delivery->status = 1;
            $delivery->save();
        }
    }
}
